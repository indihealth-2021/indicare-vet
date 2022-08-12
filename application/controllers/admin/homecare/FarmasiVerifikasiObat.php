<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FarmasiVerifikasiObat extends CI_Controller
{
    var $menu = 6;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library(array('Key'));
        $this->load->library('session');
        $this->load->library('all_controllers');
        $this->load->library('mypagination');
    }

    public function index()
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Verifikasi Obat",
            $view = "admin/homecare/farmasi_manage_verifikasi_obat"
        );

        $where = $this->input->get('nama_pasien');
        $where = $where ? ' AND p.name LIKE "%'.$where.'%"':'';

        $count_rows = count($this->db->query("SELECT drh.dimulai_pada, d.name as nama_dokter, p.name as nama_pasien, master_kelurahan.name as nama_kelurahan, master_kecamatan.name as nama_kecamatan, master_kota.name as nama_kota, master_provinsi.name as nama_provinsi, p.alamat_jalan, p.kode_pos, GROUP_CONCAT('<li>',master_obat.name, ' ( ', rdh.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', rdh.keterangan, ' ) ', IF(master_obat.active, '', '<span class=\"badge badge-danger\">Nonaktif</span>') ,'</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(rdh.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(rdh.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(rdh.jumlah_obat SEPARATOR ',') as jumlah_obat FROM resep_dokter_homecare rdh INNER JOIN master_obat ON rdh.id_obat = master_obat.id INNER JOIN data_registrasi_homecare drh ON rdh.id_registrasi = drh.id INNER JOIN master_user d ON drh.id_dokter = d.id INNER JOIN master_user p ON drh.id_pasien = p.id LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id WHERE rdh.dibatalkan = 0 AND rdh.dirilis = 0 AND rdh.diverifikasi = 0".$where." GROUP BY rdh.id_registrasi ORDER BY drh.dimulai_pada ASC")->result());
        $config = $this->mypagination->paginate(5, 4, $count_rows, base_url('admin/homecare/FarmasiVerifikasiObat/index'));
 
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['uri_segment'] = $this->uri->segment(4);
        $limit = ' LIMIT '.$config['per_page'].' OFFSET '.$data['page'];

        $data['list_resep'] = $this->db->query("SELECT drh.dimulai_pada, drh.diakhiri_pada, drh.id as id_registrasi, d.name as nama_dokter, p.name as nama_pasien, master_kelurahan.name as nama_kelurahan, master_kecamatan.name as nama_kecamatan, master_kota.name as nama_kota, master_provinsi.name as nama_provinsi, p.alamat_jalan, p.kode_pos, GROUP_CONCAT('<li>',master_obat.name, ' ( ', rdh.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', rdh.keterangan, ' ) ', IF(master_obat.active, '', '<span class=\"badge badge-danger\">Nonaktif</span>') ,'</li>'  SEPARATOR '') as detail_obat, GROUP_CONCAT(rdh.harga SEPARATOR ',') as harga_obat, GROUP_CONCAT(rdh.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, GROUP_CONCAT(rdh.jumlah_obat SEPARATOR ',') as jumlah_obat FROM resep_dokter_homecare rdh INNER JOIN master_obat ON rdh.id_obat = master_obat.id INNER JOIN data_registrasi_homecare drh ON rdh.id_registrasi = drh.id INNER JOIN master_user d ON drh.id_dokter = d.id INNER JOIN master_user p ON drh.id_pasien = p.id LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan LEFT JOIN master_kota ON master_kota.id = p.alamat_kota LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id WHERE rdh.dibatalkan = 0 AND rdh.dirilis = 0 AND rdh.diverifikasi = 0".$where." GROUP BY rdh.id_registrasi ORDER BY drh.dimulai_pada ASC".$limit)->result();
        foreach($data['list_resep'] as $resep){
            $resep->waktu_pelayanan = (new DateTime($resep->dimulai_pada))->format('d-m-Y H:i').' s/d '.(new DateTime($resep->diakhiri_pada))->format('d-m-Y H:i');
        }
        $data['pagination'] = $this->pagination->create_links();

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(function () {
                                    $("#table_obat").DataTable({
                                        "paging": true,
                                        "lengthChange": true,
                                        "searching": true,
                                        "ordering": true,
                                        "info": false,
                                        "autoWidth": false,
                                        "responsive": false,
                                    });
                                    $("#search").keypress(function(e){
                                        if(e.keyCode === 13){
                                            $("#searchForm").submit();
                                        }
                                    });
                                    $("#searchButton").click(function(){
                                        $("#searchForm").submit();
                                    });
                                });
                            </script>';
        $this->load->view('template', $data);
    }

    public function form_edit_resep($id_registrasi)
    {
        $this->all_controllers->check_user_farmasi();
        $data = $this->all_controllers->get_data_view(
            $title = "Edit Resep Obat",
            $view = "admin/homecare/farmasi_form_edit_resep"
        );

        $data['list_obat'] = $this->db->query("SELECT master_obat.name as nama_obat, master_obat.unit as nama_unit, master_obat.active, rdh.keterangan as aturan_pakai, rdh.jumlah_obat, rdh.id, rdh.id_obat, drh.id_pasien, drh.id_dokter FROM resep_dokter_homecare rdh INNER JOIN data_registrasi_homecare drh ON rdh.id_registrasi = drh.id INNER JOIN master_obat ON master_obat.id = rdh.id_obat WHERE rdh.id_registrasi = ?", $id_registrasi)->result();
        $data['list_master_obat'] = $this->db->query("SELECT * FROM master_obat WHERE active=1")->result();
        $data['id_registrasi'] = $id_registrasi;

        $data['css_addons'] = '
        <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
        <style>
            .input-like-text{
                background-color:transparent;
                border: 0;
                font-size: 1em;
                width: 100%;                    
            }
        </style>
        ';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(document).ready(function() {
                                    var table_farmasi = $("#table_farmasi").DataTable({
                                                            "paging": true,
                                                            "lengthChange": false,
                                                            "searching": false,
                                                            "ordering": true,
                                                            "info": true,
                                                            "autoWidth": true,
                                                            "responsive": false,
                                                        });

                                    $(".hapusObat").click(function(e){
                                        $(e.target).parents("tr").remove();
                                    });

                                    $("#ModalResep").on("shown.bs.modal", function (e) {
                                        $("#formResepDokter").trigger("reset");
                                        $("#formResepDokter").find("#unit").attr("placeholder","Jml");
                                    });

                                    $("#formResepDokter").submit(function(e){
                                        e.preventDefault();
                                        var dataResep = $(this).serializeArray();
                                        var namaObat = $("select[name=id_obat] option:selected").text();
                                        var listResep = $("#listResep");


                                        var templateResep = "<tr><td>"+namaObat+"</td><input type=\'hidden\' name=\'id_obat[]\' value=\'"+dataResep[0].value+"\'><td>"+dataResep[1].value+" "+dataResep[3].value+"</td><input type=\'hidden\' name=\'jumlah_obat[]\' value=\'"+dataResep[1].value+"\'><td>"+dataResep[2].value+"</td><input type=\'hidden\' name=\'keterangan[]\' value=\'"+dataResep[2].value+"\'><td><button class=\'btn btn-secondary\' onclick=\'return (this.parentNode).parentNode.remove();\'><i class=\'fas fa-trash-alt\'></i></button></td></tr>";

                                        listResep.append(templateResep);
                                        alert("Resep telah ditambahkan!");
                                        $("#ModalResep").modal("hide");
                                    });
                                });
                            </script>';
        $this->load->view('template', $data);
    }

    public function hapus_obat($id)
    {
        $this->all_controllers->check_user_farmasi();

        $obat = $this->db->query('SELECT id_jadwal_konsultasi FROM resep_dokter WHERE id = ' . $id)->row();
        if (!$obat) {
            show_404();
        }
        $this->db->delete('resep_dokter_homecare', array('id' => $id));
        $this->session->set_flashdata('msg_hapus_obat', 'Hapus Obat berhasil!');
        redirect(base_url('admin/homecare/FarmasiVerifikasiObat/form_edit_resep/' . $obat->id_jadwal_konsultasi));
    }

    public function tambah_obat($id_registrasi)
    {
        $this->all_controllers->check_user_farmasi();

        $data_obat = array(
            'id_obat' => $this->input->post('id_obat'),
            'jumlah_obat' => $this->input->post('jumlah_obat'),
            'keterangan' => $this->input->post('aturan_pakai'),
            'id_registrasi' => $id_registrasi,
        );
        $this->db->insert('resep_dokter', $data_obat);
    }

    public function submit_resep($id_registrasi)
    {
        $this->all_controllers->check_user_farmasi();

        $post_data = $this->input->post();

        $list_resep = $this->db->query('SELECT id FROM resep_dokter_homecare WHERE id_registrasi = ?', $id_registrasi)->result();

        foreach ($list_resep as $resep) {
            $this->db->delete('resep_dokter_homecare', array('id' => $resep->id));
        }

        $jmlData = count($post_data['keterangan']);
        for ($i = 0; $i < $jmlData; $i++) {
            $resep = $this->db->query('SELECT harga, harga_per_n_unit FROM master_obat WHERE id = '.$post_data['id_obat'][$i])->row();
            $data_resep = array(
                "id_registrasi" => $id_registrasi,
                "id_obat" => $post_data['id_obat'][$i],
                "jumlah_obat" => $post_data['jumlah_obat'][$i],
                "harga" => $resep->harga,
                "harga_per_n_unit" => $resep->harga_per_n_unit,
                "keterangan" => $post_data['keterangan'][$i]
            );
            $this->db->insert('resep_dokter_homecare', $data_resep);
        }
        $this->session->set_flashdata('msg_simpan_resep', "Resep Obat telah disimpan!");
        redirect(base_url('admin/homecare/FarmasiVerifikasiObat'));
    }

    public function verifikasi($id_registrasi)
    {
        $this->all_controllers->check_user_farmasi();

        $list_resep = $this->db->query('SELECT id FROM resep_dokter_homecare WHERE id_registrasi = ' . $id_registrasi)->result();
        foreach ($list_resep as $resep) {
            $data_resep_update = array("diverifikasi" => 1);
            $this->all_model->update('resep_dokter_homecare', $data_resep_update, array('id' => $resep->id));
        }

        $this->session->set_flashdata('msg_verif_resep', 'Resep Obat telah diverifikasi!');
        redirect(base_url('admin/homecare/FarmasiVerifikasiObat'));
    }
}
