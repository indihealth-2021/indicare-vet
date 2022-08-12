<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('all_controllers');
        $this->load->library('Key');
    }

    public function layanan(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Pembayaran Layanan Homecare",
            $view="admin/homecare/pembayaran_layanan"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_pembayaran = $("#table_pembayaran").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                });
                                $("#table_pembayaran_filter").remove();
                                $("#search").on("keyup", function(e){
                                    table_pembayaran.search($(this).val()).draw();
                                });
                            });
                            </script>
                        ';
        $data['list_pembayaran'] = $this->db->query('SELECT drh.kebutuhan, bplh.id_registrasi, bplh.foto, bplh.created_at as tanggal_upload, p.name as nama_pasien, GROUP_CONCAT(mph.nama SEPARATOR "|") as list_nama_pelayanan, GROUP_CONCAT(ddrh.harga SEPARATOR "|") as list_harga_pelayanan, GROUP_CONCAT(mph.gambar SEPARATOR "|") as list_gambar_pelayanan FROM bukti_pembayaran_layanan_homecare bplh INNER JOIN data_registrasi_homecare drh ON drh.id = bplh.id_registrasi INNER JOIN detail_data_registrasi_homecare ddrh ON ddrh.id_registrasi = bplh.id_registrasi INNER JOIN master_pelayanan_homecare mph ON mph.id = ddrh.id_pelayanan INNER JOIN master_user p ON drh.id_pasien = p.id WHERE bplh.diverifikasi = 0 GROUP BY ddrh.id_registrasi ORDER BY bplh.created_at')->result();
        foreach($data['list_pembayaran'] as $pembayaran){
            $pembayaran->foto = base_url("assets/images/bukti_pembayaran_layanan_homecare/".$pembayaran->foto);
            $pembayaran->tanggal_upload = (new DateTime($pembayaran->tanggal_upload))->format("d-m-Y");

            $pembayaran->nama_pelayanan = explode('|', $pembayaran->list_nama_pelayanan);
            $pembayaran->harga_pelayanan = explode('|', $pembayaran->list_harga_pelayanan);
            $pembayaran->gambar_pelayanan = explode('|', $pembayaran->list_gambar_pelayanan);
            $total_harga = 0;
            for($i = 0; $i < count($pembayaran->harga_pelayanan); $i++){
                $total_harga+=$pembayaran->harga_pelayanan[$i];
            }
            $pembayaran->total_harga = $total_harga;
        }

        $this->load->view('template', $data);
    }

    public function verif_layanan($id_registrasi){
        $this->all_controllers->check_user_admin();

        $this->db->where('id_registrasi', $id_registrasi);
        $this->db->update('bukti_pembayaran_layanan_homecare', array('diverifikasi' => 1, 'diverifikasi_oleh' => $this->session->userdata('id_user')));

        $data_registrasi = $this->db->query('SELECT tanggal_pelayanan_admin, waktu_mulai, id_pasien, id_dokter FROM data_registrasi_homecare WHERE id = ?', $id_registrasi)->row();
        $data_jadwal_pelayanan_homecare = [
            'id_registrasi' => $id_registrasi,
            'tanggal_mulai' => $data_registrasi->tanggal_pelayanan_admin,
            'waktu_mulai' => $data_registrasi->waktu_mulai
        ];
        $this->db->insert('jadwal_layanan_homecare', $data_jadwal_pelayanan_homecare);

        $notifikasi = 'Pembayaran Homecare anda telah diverifikasi!';
        $url_notif = base_url('pasien/homecare/pendaftaran');
        $target_user = $data_registrasi->id_pasien;
		$now = (new DateTime('now'))->format('Y-m-d H:i:s');
		$data_notif = array("id_user" => $target_user, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => $url_notif);
		$this->db->insert('data_notifikasi', $data_notif);
		$id_notif = $this->db->insert_id();
		$msg_notif = array(
			'name' => 'vp',
			'id_notif' => $id_notif,
			'keterangan' => $notifikasi,
			'tanggal' => $now,
			'id_user' => json_encode(array($target_user)),
			'direct_link' => $url_notif,
		);
		$msg_notif = json_encode($msg_notif);
		$this->key->_send_fcm($target_user, $msg_notif);
        
        $notifikasi = 'Ada Jadwal Homecare baru untuk anda!';
        $url_notif = base_url('dokter/homecare/JadwalPelayanan');
        $target_user = $data_registrasi_homecare->id_dokter;
		$now = (new DateTime('now'))->format('Y-m-d H:i:s');
		$data_notif = array("id_user" => $target_user, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => $url_notif);
		$this->db->insert('data_notifikasi', $data_notif);
		$id_notif = $this->db->insert_id();
		$msg_notif = array(
			'name' => 'vp',
			'id_notif' => $id_notif,
			'keterangan' => $notifikasi,
			'tanggal' => $now,
			'id_user' => json_encode(array($target_user)),
			'direct_link' => $url_notif,
		);
		$msg_notif = json_encode($msg_notif);
		$this->key->_send_fcm($target_user, $msg_notif);

        $this->session->set_flashdata('msg', 'Pembayaran berhasil diverifikasi!');
        redirect(base_url('admin/homecare/pembayaran/layanan'));
    }

    public function obat(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Pembayaran Obat Homecare",
            $view="admin/homecare/pembayaran_obat"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_pembayaran = $("#table_pembayaran").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                });
                                $("#table_pembayaran_filter").remove();
                                $("#search").on("keyup", function(e){
                                    table_pembayaran.search($(this).val()).draw();
                                });
                            });
                            </script>
                        ';
        $data['list_pembayaran'] = $this->db->query('SELECT drh.id as id_registrasi, d.name as nama_dokter, p.name as nama_pasien, bpoh.foto, bpoh.created_at as tanggal_upload, GROUP_CONCAT("<li>",mo.name, " ( ", rdh.jumlah_obat, " ",mo.unit ," )"," ( ", rdh.keterangan, " ) ", "</li>"  SEPARATOR "") as detail_obat, GROUP_CONCAT(rdh.harga SEPARATOR "|") as harga_obat, GROUP_CONCAT(rdh.harga_per_n_unit SEPARATOR "|") as harga_obat_per_n_unit, GROUP_CONCAT(rdh.jumlah_obat SEPARATOR "|") as jumlah_obat, poh.biaya as biaya_pengiriman FROM bukti_pembayaran_obat_homecare bpoh INNER JOIN data_registrasi_homecare drh ON bpoh.id_registrasi = drh.id INNER JOIN master_user d ON drh.id_dokter = d.id INNER JOIN master_user p ON drh.id_pasien = p.id INNER JOIN resep_dokter_homecare rdh ON drh.id = rdh.id_registrasi INNER JOIN master_obat mo ON rdh.id_obat = mo.id INNER JOIN pengiriman_obat_homecare poh ON poh.id_registrasi = drh.id WHERE bpoh.diverifikasi = 0 GROUP BY rdh.id_registrasi')->result();
        foreach($data['list_pembayaran'] as $pembayaran){
            $list_harga_obat = explode('|', $pembayaran->harga_obat);
            $list_harga_obat_per_n_unit = explode('|', $pembayaran->harga_obat_per_n_unit);
            $list_jumlah_obat = explode('|', $pembayaran->jumlah_obat);
            $jml_data = count($list_harga_obat);
            $list_total_harga = [];
            $total_harga = 0;
            for($i=0; $i<$jml_data; $i++){
                $list_total_harga[$i] = ( $list_jumlah_obat[$i] / $list_harga_obat_per_n_unit[$i] ) * $list_harga_obat[$i];
            }

            foreach($list_total_harga as $tot_harga){
                $total_harga+=$tot_harga;
            }
            $total_harga+=$pembayaran->biaya_pengiriman;

            $pembayaran->total_harga = $total_harga;
        }
        
        $this->load->view('template', $data);
    }

    public function verif_obat($id_registrasi){
        $this->all_controllers->check_user_admin();

        $data_bukti_pembayaran_obat_homecare_update = [
            'diverifikasi' => 1,
            'diverifikasi_oleh' => $this->session->userdata('id_user')
        ];
        $this->db->set($data_bukti_pembayaran_obat_homecare_update);
        $this->db->where('id_registrasi', $id_registrasi);
        $this->db->update('bukti_pembayaran_obat_homecare');

        $data_registrasi_homecare = $this->db->query('SELECT id_pasien FROM data_registrasi_homecare WHERE id = ?', $id_registrasi)->row();
        $notifikasi = 'Pembayaran Obat anda telah diverifikasi!';
        $url_notif = base_url('#');
        $target_user = $data_registrasi_homecare->id_pasien;
		$now = (new DateTime('now'))->format('Y-m-d H:i:s');
		$data_notif = array("id_user" => $target_user, "notifikasi" => $notifikasi, "tanggal" => $now, "direct_link" => $url_notif);
		$this->db->insert('data_notifikasi', $data_notif);
		$id_notif = $this->db->insert_id();
		$msg_notif = array(
			'name' => 'vp',
			'id_notif' => $id_notif,
			'keterangan' => $notifikasi,
			'tanggal' => $now,
			'id_user' => json_encode(array($target_user)),
			'direct_link' => $url_notif,
		);
		$msg_notif = json_encode($msg_notif);
		$this->key->_send_fcm($target_user, $msg_notif);

        redirect(base_url('admin/homecare/pembayaran/obat'));
    }

    public function riwayat_pembayaran_layanan(){
        $data['view'] = 'admin/homecare/riwayat_pembayaran_layanan';
	    $data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Riwayat Pembayaran Layanan Homecare';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_riwayat = $("#table_riwayat").DataTable({
                                        "responsive": true,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": true,
                                        "pageLength": 5,
                                      });
                                      $("#table_riwayat_filter").remove();
                                      $("#search").on("keyup", function(e){
                                        table_riwayat.search($(this).val()).draw();
                                      });
                                });
                                </script>
                        ';
        $data['list_pembayaran'] = $this->db->query('
            SELECT
                drh.id as id_registrasi,
                d.name as nama_dokter,
                p.name as nama_pasien,
                bplh.created_at as tanggal_upload,
                bplh.foto as foto_bukti,
                drh.alamat_pelayanan,
                drh.dimulai_pada as waktu_mulai,
                drh.diakhiri_pada as waktu_selesai,
                GROUP_CONCAT(mph.nama SEPARATOR ",") as list_pelayanan,
                GROUP_CONCAT(ddrh.harga SEPARATOR "|") as list_harga_pelayanan
                FROM bukti_pembayaran_layanan_homecare bplh
                    INNER JOIN data_registrasi_homecare drh ON bplh.id_registrasi = drh.id
                    INNER JOIN detail_data_registrasi_homecare ddrh ON ddrh.id_registrasi = drh.id
                    INNER JOIN master_pelayanan_homecare mph ON ddrh.id_pelayanan = mph.id
                    INNER JOIN master_user d ON drh.id_dokter = d.id
                    INNER JOIN master_user p ON drh.id_pasien = p.id
                        WHERE bplh.diverifikasi = 1
                            GROUP BY ddrh.id_registrasi
                                ORDER BY drh.dimulai_pada DESC
        ', $this->session->userdata('id_user'))->result();
        foreach($data['list_pembayaran'] as $pembayaran){
            $pembayaran->waktu_pelayanan = (new DateTime($pembayaran->waktu_mulai))->format('d-m-Y H:i').' s/d '.(new DateTime($pembayaran->waktu_selesai))->format('d-m-Y H:i');
            
            $total_harga_pelayanan = 0;
            $list_harga_pelayanan = explode('|', $pembayaran->list_harga_pelayanan);
            foreach($list_harga_pelayanan as $harga_pelayanan){
                $total_harga_pelayanan+=$harga_pelayanan;
            }
            $pembayaran->total_harga_pelayanan = "Rp " . number_format($total_harga_pelayanan,2,',','.');

            $pembayaran->tanggal_upload = (new DateTime($pembayaran->tanggal_upload))->format('d-m-Y H:i');
        }
        $this->load->view('template', $data);
    }

    public function riwayat_pembayaran_obat(){
        $data['view'] = 'admin/homecare/riwayat_pembayaran_obat';
	    $data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Riwayat Pembayaran Obat Homecare';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_riwayat = $("#table_riwayat").DataTable({
                                        "responsive": true,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": true,
                                        "pageLength": 5,
                                      });
                                      $("#table_riwayat_filter").remove();
                                      $("#search").on("keyup", function(e){
                                        table_riwayat.search($(this).val()).draw();
                                      });
                                });
                                </script>
                        ';
        $data['list_pembayaran'] = $this->db->query('
            SELECT
                d.name as nama_dokter,
                p.name as nama_pasien,
                (SELECT GROUP_CONCAT(mph.nama SEPARATOR ",") FROM detail_data_registrasi_homecare ddrh INNER JOIN master_pelayanan_homecare mph ON mph.id = ddrh.id_pelayanan WHERE ddrh.id_registrasi = bpoh.id_registrasi) as list_pelayanan,
                drh.dimulai_pada as waktu_mulai,
                drh.diakhiri_pada as waktu_selesai,
                poh.alamat as alamat_pengiriman,
                poh.biaya as biaya_pengiriman,
                bpoh.foto as foto_bukti,
                bpoh.order_status,
                bpoh.created_at as tanggal_upload,
                GROUP_CONCAT("<li>",master_obat.name, " ( ", rdh.jumlah_obat, " ",master_obat.unit ," )"," ( ", rdh.keterangan, " ) ", "</li>" SEPARATOR "") as detail_obat,
                GROUP_CONCAT(rdh.harga SEPARATOR ",") as harga_obat, 
                GROUP_CONCAT(rdh.harga_per_n_unit SEPARATOR ",") as harga_obat_per_n_unit, 
                GROUP_CONCAT(rdh.jumlah_obat SEPARATOR ",") as jumlah_obat 
                FROM bukti_pembayaran_obat_homecare bpoh
                    INNER JOIN data_registrasi_homecare drh ON bpoh.id_registrasi = drh.id
                    INNER JOIN resep_dokter_homecare rdh ON rdh.id_registrasi = drh.id
                    INNER JOIN master_obat ON rdh.id_obat = master_obat.id
                    INNER JOIN pengiriman_obat_homecare poh ON poh.id_registrasi = drh.id
                    INNER JOIN master_user d ON drh.id_dokter = d.id
                    INNER JOIN master_user p ON drh.id_pasien = p.id
                        WHERE bpoh.diverifikasi = 1
                            GROUP BY rdh.id_registrasi
                                ORDER BY drh.dimulai_pada
        ', $this->session->userdata('id_user'))->result();
        foreach($data['list_pembayaran'] as $pembayaran){
            $pembayaran->waktu_pelayanan = (new DateTime($pembayaran->waktu_mulai))->format('d-m-Y H:i').' s/d '.(new DateTime($pembayaran->waktu_selesai))->format('d-m-Y H:i');
            $pembayaran->order_status = $pembayaran->order_status ? 'DELIVERED':'PENDING';
            $pembayaran->tanggal_upload = (new DateTime($pembayaran->tanggal_upload))->format('d-m-Y H:i');
        }

        $this->load->view('template', $data);
    }
}