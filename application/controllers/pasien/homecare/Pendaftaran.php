<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct() {
        parent::__construct();       
    }

    public function index(){
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

        $data['view'] = 'pasien/homecare/pendaftaran';
	    $data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Pendaftaran Homecare';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_pendaftaran = $("#table_pendaftaran").DataTable({
                                        "responsive": true,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": true,
                                        "pageLength": 5,
                                      });
                                      $("#table_pendaftaran_filter").remove();
                                      $("#search").on("keyup", function(e){
                                        table_pendaftaran.search($(this).val()).draw();
                                      });

                                    $("#modalPendaftaranHomecare").on("shown.bs.modal", function(e){
                                        const modal = $(e.currentTarget);
                                        const button = $(e.relatedTarget);

                                        $("#formPendaftaranHomecare").trigger("reset");
                                        modal.find("input[name=nama_pasien]").val(button.data("nama"));
                                        modal.find("input[name=no_hp]").val(button.data("no-hp"));
                                        modal.find("textarea[name=alamat_pelayanan]").html(button.data("alamat"));
                                        modal.find("textarea[name=alamat_pengiriman_obat]").html(button.data("alamat"));
                                    });
                                    $(".pelayanan").change(function(){
                                        let total_harga = 0;
                                        let checked_pelayanan = $(".pelayanan:checked");
                                        for(let i = 0; i < checked_pelayanan.length; i++){
                                            const harga = $(checked_pelayanan[i]).data("harga");
                                            total_harga+=harga;
                                        }
                                        $(".total-harga-pelayanan").html(formatRupiah(total_harga.toString(), "Rp. ")+",00");
                                    });

                                    $("#modalPembayaran").on("shown.bs.modal", function(e){
                                        const modal = $(e.currentTarget);
                                        const button = $(e.relatedTarget);

                                        modal.find("#formPembayaran").attr("action", `${baseUrl}pasien/homecare/pembayaran/bayar/${button.data("id-registrasi")}`);

                                        modal.find(".visitor").html(button.data("visitor"));
                                        modal.find(".waktu-pelayanan").html(button.data("waktu-pelayanan"));
                                        modal.find(".total-harga").html(formatRupiah(button.data("total-harga").toString(), "Rp. "));

                                        const list_pelayanan = button.data("list-pelayanan").split("|");
                                        let list_pelayanan_template = "<ul>";
                                        for(let i = 0; i < list_pelayanan.length; i++){
                                            const template = `
                                                <li>${list_pelayanan[i]}</li>
                                            `
                                            list_pelayanan_template+=template;
                                        }
                                        list_pelayanan_template+="</ul>";

                                        modal.find(".list-pelayanan").html(list_pelayanan_template);
                                    });

                                    $("#file_upload").change(function() {
                                        var file = $("#file_upload")[0].files[0].name;
                                        var file_substr = file.length > 40 ? file.substr(0, 60)+"...":file;
                                        $("#filename").html("<span title=\'" + file + "\'>" + file_substr + "</span>");
                                    }); 
                                });
                              </script>';

        $data['list_pelayanan'] = $this->db->query('SELECT * FROM master_pelayanan_homecare WHERE aktif = 1')->result();
        $data['data_registrasi'] = $this->db->query('SELECT 
                                                        bplh.diverifikasi as pembayaran_verif, 
                                                        dokter.name as nama_dokter, 
                                                        drh.id, 
                                                        drh.kebutuhan, 
                                                        drh.waktu_mulai, 
                                                        drh.tanggal_pelayanan_pasien, 
                                                        drh.tanggal_pelayanan_admin, 
                                                        drh.alamat_pelayanan, 
                                                        drh.status as status_registrasi, 
                                                        (SELECT GROUP_CONCAT(mph.nama SEPARATOR "|") FROM detail_data_registrasi_homecare ddrh INNER JOIN master_pelayanan_homecare mph ON ddrh.id_pelayanan = mph.id WHERE ddrh.id_registrasi = drh.id) as list_nama_pelayanan, 
                                                        (SELECT GROUP_CONCAT(ddrh.harga SEPARATOR "|") FROM detail_data_registrasi_homecare ddrh WHERE ddrh.id_registrasi = drh.id) as list_harga_pelayanan 
                                                        FROM data_registrasi_homecare drh 
                                                            LEFT JOIN master_user dokter ON drh.id_dokter = dokter.id 
                                                            LEFT JOIN master_user adm ON drh.id_admin = adm.id 
                                                            LEFT JOIN bukti_pembayaran_layanan_homecare bplh ON bplh.id_registrasi = drh.id 
                                                                WHERE drh.id_pasien = ? 
                                                                AND (bplh.diverifikasi IS NULL OR bplh.diverifikasi = 0) 
                                                                    ORDER BY drh.status DESC, drh.created_at', $this->session->userdata('id_user'))->result();
        foreach($data['data_registrasi'] as $dr){
            $dr->nama_pelayanan = explode('|', $dr->list_nama_pelayanan);
            $dr->harga_pelayanan = explode('|', $dr->list_harga_pelayanan);
            $total_harga = 0;
            for($i = 0; $i < count($dr->harga_pelayanan); $i++){
                $total_harga+=$dr->harga_pelayanan[$i];
            }
            $dr->total_harga = $total_harga;

            $dr->tanggal_pelayanan_pasien = (new DateTime($dr->tanggal_pelayanan_pasien))->format('d-m-Y');
            $dr->tanggal_pelayanan_admin = $dr->tanggal_pelayanan_admin ? (new DateTime($dr->tanggal_pelayanan_admin))->format('d-m-Y'):NULL;
            $dr->waktu_mulai = $dr->waktu_mulai ? (new DateTime($dr->waktu_mulai))->format('H:i'):NULL;
        }

        $this->load->view('template', $data);
    }

    public function daftar(){
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

        $data = $this->input->post();
        $id_pasien = $this->session->userdata('id_user');
        $nama_pasien = $data['nama_pasien'];
        $no_hp = $data['no_hp'];
        $alamat_pelayanan = $data['alamat_pelayanan'];
        $pelayanan = $data['pelayanan'];
        $tanggal_pelayanan = $data['tanggal_pelayanan'];
        $kebutuhan = $data['kebutuhan'];
        $alamat_pengiriman_obat = $data['alamat_pengiriman_obat'];
        if(!$nama_pasien || !$no_hp || !$alamat_pelayanan || !$pelayanan || !$tanggal_pelayanan || !$alamat_pengiriman_obat){
            $this->session->set_flashdata('error', 'Pendaftaran tidak dapat dilakukan saat ini!');
            redirect(base_url('pasien/homecare/pendaftaran'));
        }

        $last_registrasi = $this->db->query('SELECT id FROM data_registrasi_homecare WHERE created_at >= CURRENT_DATE() ORDER BY created_at DESC LIMIT 1')->row();
        if(!$last_registrasi){
            $new_num_regid = "001";
        }else{
            $last_num_regid = end(str_split($last_registrasi->id, 3));
            $last_num_regid = ltrim($last_num_regid, "0");
            $last_num_regid = (int) $last_num_regid + 1;
            $new_num_regid = str_pad((string) $last_num_regid, 3, "0", STR_PAD_LEFT);
        }

        $now = (new DateTime('now'))->format('ymdHi');
        $id_registrasi = $now.$new_num_regid;

        $data_registrasi_homecare = [
            'id' => $id_registrasi,
            'id_pasien' => $id_pasien,
            'nama_pasien' => $nama_pasien,
            'no_hp' => $no_hp,
            'alamat_pelayanan' => $alamat_pelayanan,
            'tanggal_pelayanan_pasien' => $tanggal_pelayanan,
            'kebutuhan' => $kebutuhan,
        ];
        if($this->db->insert('data_registrasi_homecare', $data_registrasi_homecare)){
            for($i = 0; $i < count($pelayanan); $i++){
                $master_pelayanan = $this->db->query('SELECT harga FROM master_pelayanan_homecare WHERE id = ?', $pelayanan[$i])->row();
                if(!$master_pelayanan){
                    $this->db->delete('data_registrasi_homecare', array('id' => $id_registrasi));
                    $this->session->set_flashdata('error', 'Pendaftaran tidak dapat dilakukan saat ini!');
                    redirect(base_url('pasien/homecare/pendaftaran'));
                }

                $detail_data_registrasi_homecare = [
                    'id_registrasi' => $id_registrasi,
                    'id_pelayanan' => $pelayanan[$i],
                    'harga' => $master_pelayanan->harga
                ];

                $this->db->insert('detail_data_registrasi_homecare', $detail_data_registrasi_homecare);

                $data_pengiriman_obat = [
                    'id_registrasi' => $id_registrasi,
                    'alamat' => $alamat_pengiriman_obat,
                ];
                $this->db->insert('pengiriman_obat_homecare', $data_pengiriman_obat);
            }
            redirect(base_url('pasien/homecare/pendaftaran'));
        }else{
            $this->session->set_flashdata('error', 'Pendaftaran tidak dapat dilakukan saat ini!');
            var_dump('test');
            die;
            redirect(base_url('pasien/homecare/pendaftaran'));
        }
        
    }

}