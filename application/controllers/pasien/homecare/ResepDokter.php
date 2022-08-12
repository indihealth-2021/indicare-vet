<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResepDokter extends CI_Controller {

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

        $data['view'] = 'pasien/homecare/resep_dokter';
	    $data['user'] = $this->db->query('SELECT master_user.*, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Resep Obat';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_resep = $("#table_resep").DataTable({
                                        "responsive": true,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": true,
                                        "pageLength": 5,
                                      });
                                      $("#table_resep_filter").remove();
                                      $("#search").on("keyup", function(e){
                                        table_resep.search($(this).val()).draw();
                                      });

                                      $("#modalPembayaran").on("shown.bs.modal", function(e){
                                        const modal = $(e.currentTarget);
                                        const button = $(e.relatedTarget);

                                        modal.find("#formPembayaran").attr("action", `${baseUrl}pasien/homecare/pembayaran/bayar_obat/${button.data("id-registrasi")}`);

                                        modal.find(".visitor").html(button.data("visitor"));
                                        modal.find(".waktu-pelayanan").html(button.data("waktu-pelayanan"));
                                        modal.find(".total-harga").html(formatRupiah(button.data("total-harga").toString(), "Rp. "));

                                        modal.find(".list-resep").html(button.data("list-resep"));
                                    });

                                    $("#file_upload").change(function() {
                                        var file = $("#file_upload")[0].files[0].name;
                                        var file_substr = file.length > 40 ? file.substr(0, 60)+"...":file;
                                        $("#filename").html("<span title=\'" + file + "\'>" + file_substr + "</span>");
                                    }); 
                                });
                                </script>
        ';
        $data['list_resep'] = $this->db->query("
            SELECT 
                drh.dimulai_pada as waktu_mulai, 
                drh.diakhiri_pada as waktu_selesai, 
                rdh.id, 
                rdh.created_at, 
                drh.id as id_registrasi, 
                d.name as nama_dokter,
                poh.biaya as biaya_pengiriman,
                poh.alamat as alamat_pengiriman,
                bpoh.diverifikasi,
                GROUP_CONCAT('<li>',master_obat.name, ' ( ', rdh.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', rdh.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, 
                GROUP_CONCAT(rdh.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(rdh.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, 
                GROUP_CONCAT(rdh.jumlah_obat SEPARATOR ',') as jumlah_obat 
                    FROM resep_dokter_homecare rdh 
                        INNER JOIN data_registrasi_homecare drh ON rdh.id_registrasi = drh.id 
                        INNER JOIN pengiriman_obat_homecare poh ON poh.id_registrasi = drh.id 
                        LEFT JOIN bukti_pembayaran_obat_homecare bpoh ON bpoh.id_registrasi = drh.id 
                        INNER JOIN master_obat ON rdh.id_obat = master_obat.id 
                        INNER JOIN master_user d ON drh.id_dokter = d.id 
                        LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id 
                            WHERE drh.id_pasien = ? 
                            AND (bpoh.diverifikasi = 0 OR bpoh.diverifikasi IS NULL) 
                            AND rdh.dibatalkan = 0 
                            AND rdh.dirilis = 1 
                            AND (rdh.diverifikasi = 1 OR rdh.diverifikasi IS NULL) 
                                GROUP BY rdh.id_registrasi 
                                    ORDER BY rdh.created_at DESC", $this->session->userdata('id_user'))->result();
        foreach($data['list_resep'] as $resep){
            $resep->waktu_pelayanan = (new DateTime($resep->waktu_mulai))->format('d-m-Y H:i').' s/d '.(new DateTime($resep->waktu_selesai))->format('d-m-Y H:i');
        }

        $this->load->view('template', $data);
    }
}