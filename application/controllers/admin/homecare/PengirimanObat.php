<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengirimanObat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('all_controllers');
        $this->load->library('Key');
    }

    public function index(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Pengiriman Obat Homecare",
            $view="admin/homecare/pengiriman_obat"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_pengiriman = $("#table_pengiriman").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                });
                                $("#table_pengiriman_filter").remove();
                                $("#search").on("keyup", function(e){
                                    table_pengiriman.search($(this).val()).draw();
                                });
                            });
                            </script>
                        ';
        $data['list_pembayaran'] = $this->db->query("
            SELECT
                drh.id as id_registrasi,
                p.name as nama_pasien,
                d.name as nama_dokter,
                poh.alamat as alamat_pengiriman,
                poh.biaya as biaya_pengiriman,
                drh.dimulai_pada as waktu_mulai,
                drh.diakhiri_pada as waktu_selesai,
                GROUP_CONCAT(rdh.harga SEPARATOR '|') as harga_obat, 
                GROUP_CONCAT(rdh.harga_per_n_unit SEPARATOR '|') as harga_obat_per_n_unit, 
                GROUP_CONCAT(rdh.jumlah_obat SEPARATOR '|') as jumlah_obat,
                GROUP_CONCAT('<li>',master_obat.name, ' ( ', rdh.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', rdh.keterangan, ' ) ','</li>'  SEPARATOR '') as detail_obat
                FROM bukti_pembayaran_obat_homecare bpoh
                    INNER JOIN data_registrasi_homecare drh ON bpoh.id_registrasi = drh.id
                    INNER JOIN resep_dokter_homecare rdh ON rdh.id_registrasi = drh.id
                    INNER JOIN master_obat ON rdh.id_obat = master_obat.id
                    INNER JOIN master_user d ON drh.id_dokter = d.id
                    INNER JOIN master_user p ON drh.id_pasien = p.id
                    INNER JOIN pengiriman_obat_homecare poh ON poh.id_registrasi = drh.id
                        WHERE bpoh.order_status = 0
                        AND bpoh.diverifikasi = 1
                            GROUP BY rdh.id_registrasi
                                ORDER BY drh.waktu_mulai
        ")->result();
        foreach($data['list_pembayaran'] as $pembayaran){
            $pembayaran->waktu_pelayanan = (new DateTime($pembayaran->waktu_mulai))->format('d-m-Y H:i').' s/d '.(new DateTime($pembayaran->waktu_selesai))->format('d-m-Y H:i');
        }
        $this->load->view('template', $data);
    }

    public function biaya(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Biaya Pengiriman Obat",
            $view="admin/homecare/biaya_pengiriman_obat"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_obat = $("#table_obat").DataTable({
                                    "responsive": true,
                                    "autoWidth": false,
                                    "lengthChange": false,
                                    "searching": true,
                                    "pageLength": 5,
                                });
                                $("#table_obat_filter").remove();
                                $("#search").on("keyup", function(e){
                                    table_obat.search($(this).val()).draw();
                                });

                                $("#modalBiayaPengiriman").on("show.bs.modal", function (e) {
                                    var button = $(e.relatedTarget);
                                    var modal = $(e.currentTarget);

                                    modal.find("#biaya-pengiriman").val("");

                                    modal.find("#nama-pasien").val(button.data("nama-pasien"));
                                    modal.find("#telp").val(button.data("telp-pasien"));
                                    modal.find("#email-pasien").val(button.data("email-pasien"));

                                    modal.find("#alamat").val(button.data("alamat"));
                                    modal.find("#id_registrasi").val(button.data("id-registrasi"));
                                    modal.find("#biaya-pengiriman").val(button.data("biaya-pengiriman"));
                                    var biaya_pengiriman_rp = button.data("biaya-pengiriman-rp");
                                    biaya_pengiriman_rp = biaya_pengiriman_rp.replace(",00","");
                                    modal.find("#biayaPengirimanHelp").html(biaya_pengiriman_rp);
                                    if(button.data("tipe") == "edit"){
                                        $(".submit-form").hide();
                                        $(".edit-form").show();
                                        modal.find("#saveBiayaPengiriman").attr("type", "button");
                                        modal.find("#biaya-pengiriman").removeAttr("readonly");
                                        var alamat = button.data("alamat");

                                        $("#alamat").prop("required",true);

                                        $("#saveBiayaPengiriman").html("Simpan");
                                        $("#saveBiayaPengiriman").off("click");
                                        $("#saveBiayaPengiriman").click(function(e){
                                            if(modal.find("textarea[name=alamat]").val()){
                                                $.ajax({
                                                    method : "POST",
                                                    url    : baseUrl+"admin/homecare/PengirimanObat/submit_biaya_pengiriman",
                                                    data   : {biaya_pengiriman:modal.find("#biaya-pengiriman").val(), alamat:modal.find("#alamat").val(), _csrf:modal.find("input[name=_csrf]").val(), id_registrasi:modal.find("input[name=id_registrasi]").val()},
                                                    success : function(data){
                                                        console.log(data);
                                                        data = JSON.parse(data);
                                                        if(data.status == "OK"){
                                                            var biaya_pengiriman_rp = formatRupiah(modal.find("#biaya-pengiriman").val(), "Rp. ");
                                                            biaya_pengiriman_rp = biaya_pengiriman_rp.replace(",00","");
                                                            var total_harga = parseInt(modal.find("#biaya-pengiriman").val())+parseInt(button.parent().find(".btnSubmit").data("harga-obat"));
                                                            var total_harga_rp = formatRupiah(total_harga.toString(), "Rp. ");
                                                            total_harga_rp = total_harga_rp.replace(",00","");
                                                            document.getElementById("biaya-pengiriman-"+modal.find("#id_registrasi").val()).innerHTML = modal.find("#biayaPengirimanHelp").html()+",00";
                                                            
                                                            button.parent().find(".btnSubmit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());
                                                            button.parent().find(".btnEdit").data("biaya-pengiriman", modal.find("#biaya-pengiriman").val());

                                                            button.parent().find(".btnSubmit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);
                                                            button.parent().find(".btnEdit").data("biaya-pengiriman-rp", biaya_pengiriman_rp);

                                                            button.parent().find(".btnSubmit").data("alamat", modal.find("#alamat").val());

                                                            if(modal.find("input[name=alamat_kustom]:checked").val() == 1){
                                                                button.parent().find(".btnEdit").data("alamat-kustom", modal.find("#alamat").val());
                                                                button.parent().find(".btnEdit").data("is-alamat-kustom", 1);
                                                            }
                                                            else{
                                                                button.parent().find(".btnEdit").data("is-alamat-kustom", 0);
                                                            }

                                                            button.parent().find(".btnSubmit").data("total-harga", total_harga);
                                                            button.parent().find(".btnSubmit").data("total-harga-rp", total_harga_rp);
                                                            modal.modal("hide");
                                                            alert("Data telah disimpan");
                                                        }   
                                                        else{
                                                            alert("GAGAL: Pastikan data yang anda isi lengkap!");
                                                        }          
                                                    },
                                                    error : function(data){
                                                            alert("Terjadi kesalahan sistem, silahkan hubungi administrator."+JSON.stringify(data));
                                                    }
                                                });
                                            }
                                            else{
                                                alert("GAGAL: Data Tidak Lengkap!");
                                            }
                                        });
                                    }
                                    else{
                                        $(".submit-form").show();
                                        $(".edit-form").hide();

                                        modal.find("#alamat").removeAttr("required");
                                        modal.find("#biaya-pengiriman").removeAttr("required");

                                        modal.find("#harga-obat").val(button.data("harga-obat"));
                                        modal.find("#hargaObatHelp").html(button.data("harga-obat-rp"));

                                        modal.find("#total-harga").val(button.data("total-harga"));
                                        modal.find("#totalHargaHelp").html(button.data("total-harga-rp"));

                                        modal.find("#alamat").attr("readonly","readonly");
                                        modal.find("#biaya-pengiriman").attr("readonly","readonly");

                                        $("#saveBiayaPengiriman").off("click");
                                        $("#saveBiayaPengiriman").html("Submit");         
                                        $("#saveBiayaPengiriman").attr("type", "submit");
                                    }
                                });
                            });
                            </script>
                        ';
        $data['list_resep'] = $this->db->query("
            SELECT drh.dimulai_pada as waktu_mulai,
            drh.diakhiri_pada as waktu_selesai, 
            poh.biaya as biaya_pengiriman, 
            poh.alamat as alamat_pengiriman,
            rdh.id, 
            rdh.created_at, 
            drh.id as id_registrasi, 
            d.name as nama_dokter, 
            p.name as nama_pasien, 
            p.telp as telp_pasien, 
            p.email as email_pasien, 
            master_kelurahan.name as nama_kelurahan, 
            master_kecamatan.name as nama_kecamatan, 
            master_kota.name as nama_kota, 
            master_provinsi.name as nama_provinsi, 
            p.alamat_jalan, 
            p.kode_pos, 
            GROUP_CONCAT('<li>',master_obat.name, ' ( ', rdh.jumlah_obat, ' ',master_obat.unit ,' )',' ( ', rdh.keterangan, ' ) ', '</li>'  SEPARATOR '') as detail_obat, 
            GROUP_CONCAT(rdh.harga SEPARATOR ',') as harga_obat, 
            GROUP_CONCAT(rdh.harga_per_n_unit SEPARATOR ',') as harga_obat_per_n_unit, 
            GROUP_CONCAT(rdh.jumlah_obat SEPARATOR ',') as jumlah_obat 
                FROM resep_dokter_homecare rdh  
                    INNER JOIN data_registrasi_homecare drh ON rdh.id_registrasi = drh.id 
                    INNER JOIN master_obat ON rdh.id_obat = master_obat.id 
                    INNER JOIN master_user d ON drh.id_dokter = d.id 
                    INNER JOIN master_user p ON drh.id_pasien = p.id 
                    LEFT JOIN master_kecamatan ON master_kecamatan.id = p.alamat_kecamatan 
                    LEFT JOIN master_kelurahan ON master_kelurahan.id = p.alamat_kelurahan 
                    LEFT JOIN master_kota ON master_kota.id = p.alamat_kota 
                    LEFT JOIN master_provinsi ON master_provinsi.id = p.alamat_provinsi 
                    LEFT JOIN master_kategori_obat mko ON master_obat.id_kategori_obat = mko.id 
                    LEFT JOIN pengiriman_obat_homecare poh ON poh.id_registrasi = drh.id 
                        WHERE rdh.dibatalkan = 0 
                            AND rdh.dirilis = 0 
                            AND rdh.diverifikasi = 1 
                                GROUP BY rdh.id_registrasi 
                                    ORDER BY drh.dimulai_pada")->result();
        foreach($data['list_resep'] as $resep){
            $resep->waktu_pelayanan = (new DateTime($resep->waktu_mulai))->format('d-m-Y H:i').' s/d '.(new DateTime($resep->waktu_selesai))->format('d-m-Y H:i');
        }

        $this->load->view('template', $data);
    }

    public function submit_biaya_pengiriman(){
        $this->all_controllers->check_user_admin();
    
        $id_registrasi = $this->input->post('id_registrasi');
        $biaya_pengiriman = $this->input->post('biaya_pengiriman');
        $alamat = $this->input->post('alamat');

        if(!$id_registrasi || $biaya_pengiriman == null || !$alamat){
            echo "FAILED";
            die;
        }

        $data_biaya_pengiriman = array(
            'id_registrasi'=>$id_registrasi,
            'biaya'=>$biaya_pengiriman,
            'alamat'=>$alamat
        );

        $biaya_pengiriman_isExists = $this->db->query("SELECT id,alamat FROM pengiriman_obat_homecare WHERE id_registrasi = ?", $id_registrasi)->row();
        if(!$biaya_pengiriman_isExists){
            $this->db->insert('pengiriman_obat_homecare', $data_biaya_pengiriman);
        }
        else{
            $this->all_model->update('pengiriman_obat_homecare', array('biaya'=>$biaya_pengiriman, 'alamat'=>$alamat), array('id'=>$biaya_pengiriman_isExists->id));
        }

        echo json_encode(array('status'=>'OK'));
    }

    public function rilis_obat(){
		$this->all_controllers->check_user_admin();

        // $biaya_pengiriman = $this->input->post('biaya_pengiriman');
        $id_registrasi = $this->input->post('id_registrasi');
        $biaya_pengiriman = $this->input->post('biaya_pengiriman');
        $alamat = $this->input->post('alamat');

        if(!$id_registrasi || !$biaya_pengiriman || !$alamat){
            $this->session->set_flashdata('msg_biaya_pengiriman', 'GAGAL: Data Tidak Lengkap!');
            redirect(base_url('admin/homecare/PengirimanObat/biaya'));
        }

        $data_biaya_pengiriman = array(
            'id_registrasi'=>$id_registrasi,
            'biaya'=>$biaya_pengiriman,
            'alamat'=>$alamat
        );

        $biaya_pengiriman_isExists = $this->db->query("SELECT id FROM pengiriman_obat_homecare WHERE id_registrasi = ?", $id_registrasi)->row();
        if(!$biaya_pengiriman_isExists){
            $this->db->insert('pengiriman_obat_homecare', $data_biaya_pengiriman);
        }
        else{
            $this->all_model->update('pengiriman_obat_homecare', array('biaya_pengiriman'=>$biaya_pengiriman, 'alamat'=>$alamat), array('id'=>$biaya_pengiriman_isExists->id));
        }

        $list_resep = $this->db->query('SELECT rdh.id, drh.id_pasien, rdh.jumlah_obat FROM resep_dokter_homecare rdh INNER JOIN data_registrasi_homecare drh ON rdh.id_registrasi = drh.id WHERE rdh.id_registrasi = ? AND rdh.diverifikasi = 1', $id_registrasi)->result();
        foreach($list_resep as $resep){
            $this->all_model->update('resep_dokter_homecare', array('dirilis'=>1), array('id'=>$resep->id));
        }

        $pasien = $this->db->query('SELECT id,email,name,reg_id FROM master_user WHERE id = ?', $list_resep[0]->id_pasien)->row();
        $verifier = $this->db->query('SELECT name FROM master_user WHERE id = ?', $this->session->userdata('id_user'))->row();

        // $notifikasi = 'Resep Obat anda telah dirilis! dengan total harga Rp. '.number_format($total_harga,2,',','.');
        $notifikasi = 'Salah satu Resep Obat anda telah dirilis!';
        $now = (new DateTime('now'))->format('Y-m-d H:i:s');
        
        $data_notif = array("id_user"=>$pasien->id, "notifikasi"=>$notifikasi, "tanggal"=>$now, "direct_link"=>base_url('pasien/homecare/ResepDokter'));
        $this->db->insert('data_notifikasi', $data_notif);
        $id_notif = $this->db->insert_id();
        
        $msg_notif = array(
            'name'=>'universal',
            'judul'=>'Resep Obat',
            'id_notif'=>$id_notif,
            'keterangan'=>$notifikasi,
            'tanggal'=>$now,
            'id_user'=>json_encode(array($pasien->id)),
            'direct_link'=>base_url('pasien/homecare/ResepDokter'),
        );
        $msg_notif = json_encode($msg_notif);

        $this->key->_send_fcm($pasien->reg_id, $msg_notif);

        $this->session->set_flashdata('msg_biaya_pengiriman', 'SUKSES: Resep Obat telah dirilis!');
        redirect(base_url('admin/homecare/PengirimanObat/biaya'));
    }

    public function kirim($id_registrasi){
        $this->all_controllers->check_user_admin();
        $data_bpoh_update = [
            'order_status' => 1
        ];
        $this->db->set($data_bpoh_update);
        $this->db->where('id_registrasi', $id_registrasi);
        $this->db->update('bukti_pembayaran_obat_homecare');

        $this->session->set_flashdata('msg_biaya_pengiriman', 'SUKSES: Resep Obat telah dikirim!');
        redirect(base_url('admin/homecare/PengirimanObat/'));
    }
}