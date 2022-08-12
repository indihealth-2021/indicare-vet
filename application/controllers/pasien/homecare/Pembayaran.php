<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

	public function __construct() {
        parent::__construct();       
    }

    public function bayar($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }

        $config['upload_path']          = './assets/images/bukti_pembayaran_layanan_homecare';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
        $config['max_size']             = 10024;
        $config['file_name']            = $id_registrasi;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name');
            $data_bukti_pembayaran = [
                'id_registrasi' => $id_registrasi,
                'foto' => $foto,
            ];
            $this->db->insert('bukti_pembayaran_layanan_homecare', $data_bukti_pembayaran);

            $detail_pasien = $this->db->query('SELECT id FROM detail_pasien WHERE id_pasien = ' . $this->session->userdata('id_user'))->row();

            $last_medrek = $this->db->query('SELECT no_medrec FROM detail_pasien ORDER BY no_medrec DESC')->row();
            $last_medrek = (int) ltrim($last_medrek->no_medrec, "0");
            $last_medrek += 1;
            $no_medrek = str_pad($last_medrek, 8, "0", STR_PAD_LEFT);

            if (!$detail_pasien) {

                $data_detail_pasien = array(
                    'id_pasien' => $this->session->userdata('id_user'),
                    'no_medrec' => $no_medrek,
                );

                $this->db->insert('detail_pasien', $data_detail_pasien);
            } else {
                $this->all_model->update('detail_pasien', array('no_medrec' => $no_medrek), array('id_pasien' => $this->session->userdata('id_user')));
            }

            $this->session->set_flashdata("msg", "Bukti pembayaran berhasil diupload!");
            redirect(base_url('pasien/homecare/pendaftaran'));
        }else{
            $this->session->set_flashdata("msg", "Bukti pembayaran gagal diupload!");
            redirect(base_url('pasien/homecare/pendaftaran'));
        }
    }

    public function bayar_obat($id_registrasi){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 0){
            if($valid->id_user_kategori == 2){
                redirect(base_url('dokter/Dashboard'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }

        $config['upload_path']          = './assets/images/bukti_pembayaran_obat_homecare';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
        $config['max_size']             = 10024;
        $config['file_name']            = $id_registrasi;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name');
            $data_bukti_pembayaran = [
                'id_registrasi' => $id_registrasi,
                'foto' => $foto,
            ];
            $this->db->insert('bukti_pembayaran_obat_homecare', $data_bukti_pembayaran);

            $this->session->set_flashdata("msg", "Bukti pembayaran berhasil diupload!");
            redirect(base_url('pasien/homecare/ResepDokter'));
        }else{
            $this->session->set_flashdata("msg", "Bukti pembayaran gagal diupload!");
            redirect(base_url('pasien/homecare/ResepDokter'));
        }
    }

    public function riwayat_pembayaran_layanan(){
        $data['view'] = 'pasien/homecare/riwayat_pembayaran_layanan';
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
                        WHERE drh.id_pasien = ?
                        AND bplh.diverifikasi = 1
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
        $data['view'] = 'pasien/homecare/riwayat_pembayaran_obat';
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
                (SELECT GROUP_CONCAT(mph.nama SEPARATOR ",") FROM detail_data_registrasi_homecare ddrh INNER JOIN master_pelayanan_homecare mph ON mph.id WHERE ddrh.id_registrasi = drh.id) as list_pelayanan,
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
                        WHERE drh.id_pasien = ?
                        AND bpoh.diverifikasi = 1
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