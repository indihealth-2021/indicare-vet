<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalPelayanan extends CI_Controller {

	public function __construct() {
        parent::__construct();       
    }

    public function index(){
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }
        $data['view'] = 'dokter/homecare/jadwal_pelayanan';
	    $data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Jadwal Pelayanan Homecare';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_jadwal = $("#table_jadwal").DataTable({
                                        "responsive": true,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": true,
                                        "pageLength": 5,
                                      });
                                      $("#table_jadwal_filter").remove();
                                      $("#search").on("keyup", function(e){
                                        table_jadwal.search($(this).val()).draw();
                                      });
                                });
                                </script>
                        ';
        $data['list_jadwal_pelayanan'] = $this->db->query('SELECT drh.id as id_registrasi, p.name as nama_pasien, drh.alamat_pelayanan, drh.tanggal_pelayanan_admin, drh.waktu_mulai, GROUP_CONCAT(mph.nama SEPARATOR ",") as list_nama_pelayanan  FROM jadwal_layanan_homecare jlh INNER JOIN data_registrasi_homecare drh ON drh.id = jlh.id_registrasi INNER JOIN detail_data_registrasi_homecare ddrh ON ddrh.id_registrasi = jlh.id_registrasi INNER JOIN master_pelayanan_homecare mph ON ddrh.id_pelayanan = mph.id INNER JOIN master_user p ON p.id = drh.id_pasien WHERE drh.id_dokter = ? GROUP BY ddrh.id_registrasi ORDER BY drh.tanggal_pelayanan_pasien, drh.waktu_mulai', $this->session->userdata('id_user'))->result();
        foreach($data['list_jadwal_pelayanan'] as $jadwal_pelayanan){
            $jadwal_pelayanan->waktu_pelayanan = (new DateTime($jadwal_pelayanan->tanggal_pelayanan_admin.' '.$jadwal_pelayanan->waktu_mulai))->format('d-m-Y H:i');
        }

        $this->load->view('template', $data);
    }

}