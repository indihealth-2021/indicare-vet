<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekamMedis extends CI_Controller {

	public function __construct() {
        parent::__construct();       
    }

    public function index(){
        $data['view'] = 'pasien/homecare/rekam_medis';
	    $data['user'] = $this->db->query('SELECT master_user.*, detail_pasien.no_medrec, master_provinsi.id as id_provinsi, master_provinsi.name as nama_provinsi, master_kota.id as id_kota, master_kota.name as nama_kota, master_kecamatan.id as id_kecamatan, master_kecamatan.name as nama_kecamatan, master_kelurahan.id as id_kelurahan, master_kelurahan.name as nama_kelurahan FROM master_user INNER JOIN detail_pasien ON detail_pasien.id_pasien = master_user.id LEFT JOIN master_provinsi ON master_user.alamat_provinsi = master_provinsi.id LEFT JOIN master_kota ON master_user.alamat_kota = master_kota.id LEFT JOIN master_kecamatan ON master_user.alamat_kecamatan = master_kecamatan.id LEFT JOIN master_kelurahan ON master_user.alamat_kelurahan = master_kelurahan.id WHERE master_user.id = '.$this->session->userdata('id_user'))->row();
        $data['title'] = 'Rekam Medis';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_rm = $("#table_rm").DataTable({
                                        "responsive": true,
                                        "autoWidth": false,
                                        "lengthChange": false,
                                        "searching": true,
                                        "pageLength": 5,
                                      });
                                      $("#table_rm_filter").remove();
                                      $("#search").on("keyup", function(e){
                                        table_rm.search($(this).val()).draw();
                                      });

                                    $("#modalRekamMedis").on("shown.bs.modal", function(e){
                                        const modal = $(e.currentTarget);
                                        const button = $(e.relatedTarget);

                                        modal.find(".no-rm").html(button.data("no-rm"));
                                        modal.find(".pasien").html(button.data("pasien"));
                                        modal.find(".visitor").html(button.data("visitor"));

                                        modal.find(".tinggi-badan").html(button.data("tinggi-badan")+" cm");
                                        modal.find(".berat-badan").html(button.data("berat-badan")+" kg");
                                        modal.find(".suhu").html(button.data("suhu")+"&#176;C");
                                        modal.find(".tekanan-darah").html(button.data("tekanan-darah"));
                                        modal.find(".merokok").html(button.data("merokok"));
                                        modal.find(".alkohol").html(button.data("alkohol"));
                                        modal.find(".kecelakaan").html(button.data("kecelakaan"));
                                        modal.find(".operasi").html(button.data("operasi"));

                                        modal.find(".waktu-pelayanan").html(button.data("waktu-pelayanan"));
                                        const list_nama_pelayanan = button.data("list-nama-pelayanan").toString().split("|");
                                        let template_pelayanan = "";
                                        for(let i = 0; i < list_nama_pelayanan.length; i++){
                                            template_pelayanan+=`${i+1}. ${list_nama_pelayanan[i]}<br/>`
                                        }
                                        const modal_list_pelayanan = modal.find(".list-pelayanan");
                                        modal_list_pelayanan.html(template_pelayanan);

                                        const list_nama_obat = button.data("list-nama-obat").toString().split("|");
                                        const list_keterangan_obat = button.data("list-keterangan-obat").toString().split("|");
                                        const list_satuan_obat = button.data("list-satuan-obat").toString().split("|");
                                        const list_jumlah_obat = button.data("list-jumlah-obat").toString().split("|");
                                        let template_obat = "";
                                        console.log(list_nama_obat.length);
                                        if(list_nama_obat.length > 0){
                                            if(list_nama_obat[0] == ""){
                                                template_obat = "-"
                                            }else{
                                                for(let i = 0; i < list_nama_obat.length; i++){
                                                    template_obat+=`${i+1}. ${list_nama_obat[i]} ( ${list_jumlah_obat[i]} ${list_satuan_obat[i]} ) ( ${list_keterangan_obat[i]} )<br/>`
                                                }
                                            }
                                        }else{
                                            template_obat = "-";
                                        }
                                        const modal_list_resep_obat = modal.find(".list-resep-obat");
                                        modal_list_resep_obat.html(template_obat);

                                        const list_nama_kegiatan = button.data("list-nama-kegiatan").split("|");
                                        const list_foto_kegiatan = button.data("list-foto-kegiatan").split("|");
                                        let template_kegiatan = "";
                                        for(let i = 0; i < list_nama_kegiatan.length; i++){
                                            const template = `
                                                <div class=\"card mt-4\" style="width: 100%;\">
                                                    <img class=\"card-img-top\" src=\"${baseUrl+"assets/images/kegiatan_homecare/"+list_foto_kegiatan[i]}\" alt=\"Card image cap\">
                                                    <div class=\"card-body\">
                                                        <a href=\"#\" class=\"btn btn-block bg-tele text-light\">${list_nama_kegiatan[i]}</a>
                                                    </div>
                                                </div>
                                            `;
                                            template_kegiatan+=template;
                                        }
                                        const modal_list_kegiatan = modal.find(".list-kegiatan");
                                        modal_list_kegiatan.html(template_kegiatan);
                                    })
                                });
                                </script>
                        ';
        $data['list_rm'] = $this->db->query('SELECT 
                                                drh.id as id_registrasi, 
                                                d.name as nama_dokter, 
                                                ah.tinggi_badan,
                                                ah.berat_badan,
                                                ah.suhu,
                                                ah.tekanan_darah,
                                                ah.merokok,
                                                ah.alkohol,
                                                ah.kecelakaan,
                                                ah.operasi,
                                                drh.dimulai_pada as waktu_mulai_pelayanan,
                                                drh.diakhiri_pada as waktu_selesai_pelayanan, 
                                                drh.kebutuhan as kebutuhan_pasien,
                                                (SELECT GROUP_CONCAT(kh.nama SEPARATOR "|") FROM kegiatan_homecare kh WHERE kh.id_registrasi = drh.id) as list_nama_kegiatan,
                                                (SELECT GROUP_CONCAT(kh.foto SEPARATOR "|") FROM kegiatan_homecare kh WHERE kh.id_registrasi = drh.id) as list_foto_kegiatan,
                                                (SELECT GROUP_CONCAT(mo.name SEPARATOR "|") FROM resep_dokter_homecare rdh INNER JOIN master_obat mo ON rdh.id_obat = mo.id WHERE rdh.id_registrasi = drh.id) as list_nama_obat,
                                                (SELECT GROUP_CONCAT(rdh.jumlah_obat SEPARATOR "|") FROM resep_dokter_homecare rdh WHERE rdh.id_registrasi = drh.id) as list_jumlah_obat,
                                                (SELECT GROUP_CONCAT(rdh.keterangan SEPARATOR "|") FROM resep_dokter_homecare rdh WHERE rdh.id_registrasi = drh.id) as list_keterangan_obat,
                                                (SELECT GROUP_CONCAT(mo.unit SEPARATOR "|") FROM resep_dokter_homecare rdh INNER JOIN master_obat mo ON rdh.id_obat = mo.id WHERE rdh.id_registrasi = drh.id) as list_satuan_obat,
                                                (SELECT GROUP_CONCAT(rdh.harga SEPARATOR "|") FROM resep_dokter_homecare rdh WHERE rdh.id_registrasi = drh.id) as list_harga_obat,
                                                (SELECT GROUP_CONCAT(mph.nama SEPARATOR "|") FROM detail_data_registrasi_homecare ddrh INNER JOIN master_pelayanan_homecare mph ON ddrh.id_pelayanan = mph.id WHERE ddrh.id_registrasi = drh.id) as list_nama_pelayanan, 
                                                (SELECT GROUP_CONCAT(ddrh.harga SEPARATOR "|") FROM detail_data_registrasi_homecare ddrh INNER JOIN master_pelayanan_homecare mph ON ddrh.id_pelayanan = mph.id WHERE ddrh.id_registrasi = drh.id) as list_harga_pelayanan 
                                                FROM data_registrasi_homecare drh 
                                                    INNER JOIN master_user d ON drh.id_dokter = d.id 
                                                    INNER JOIN assesment_homecare ah ON ah.id_registrasi = drh.id 
                                                        WHERE drh.id_pasien = ? 
                                                        AND drh.status = 1 
                                                        AND drh.selesai = 1 
                                                            ORDER BY drh.dimulai_pada DESC', $this->session->userdata('id_user'))->result();
        foreach($data['list_rm'] as $rm){
            $rm->waktu_pelayanan = (new DateTime($rm->waktu_mulai_pelayanan))->format('d-m-Y H:i').' s/d '.(new DateTime($rm->waktu_selesai_pelayanan))->format('d-m-Y H:i');
        }
        $data['user']->no_medrec = str_split($data['user']->no_medrec, 2);
        $data['user']->no_medrec = implode('.', $data['user']->no_medrec);
        $this->load->view('template', $data);
    }
}