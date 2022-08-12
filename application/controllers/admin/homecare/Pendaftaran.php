<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('all_controllers');
        $this->load->model('dokter_model');
        $this->load->library('Key');
    }

    public function index(){
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Data Pendaftaran Homecare",
            $view="admin/homecare/pendaftaran"
        );

        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
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

                                $("#modalPendaftaranHomecare").on("show.bs.modal", function(e) {
                                    const modal = $(e.currentTarget);
                                    const button = $(e.relatedTarget);

                                    let list_pelayanan_modal = modal.find(".list-pelayanan");
                                    list_pelayanan_modal.html("");
                                    const list_nama_pelayanan = button.data("list-nama-pelayanan").split("|");
                                    const list_harga_pelayanan = button.data("list-harga-pelayanan").toString().split("|");
                                    const list_gambar_pelayanan = button.data("list-gambar-pelayanan").split("|");
                                    let pelayanan_template = ""
                                    for(let i = 0; i < list_nama_pelayanan.length; i++){
                                        let template = `
                                                <div class="col-12">
                                                    <div class="dash-box" style="padding: 13px">
                                                        <div class="d-inline-flex">
                                                            <!-- <div class="dash-icon mx-auto my-auto">
                                                            <i class="fas fa-stethoscope font-26 mx-1 my-1 text-white"></i>
                                                            </div> -->
                                                            <div class="my-auto">
                                                                <img src="${baseUrl}assets/images/pelayanan/${list_gambar_pelayanan[i]}">
                                                            </div>
                                                            <div class="mx-3 mt-2">
                                                            <p class="font-16 my-2 text-black">${list_nama_pelayanan[i]}</p>
                                                            <p class="font-14 text-dash">${formatRupiah(list_harga_pelayanan[i].toString(), "Rp. ")+",00"}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        `;

                                        pelayanan_template+=template
                                    }
                                    list_pelayanan_modal.html(pelayanan_template);

                                    let nama_pasien = modal.find(".nama-pasien");
                                    nama_pasien.html(button.data("nama-pasien"));

                                    let no_hp = modal.find(".no-hp");
                                    no_hp.html(button.data("no-hp"));

                                    let alamat_pelayanan = modal.find(".alamat-pelayanan");
                                    alamat_pelayanan.html(button.data("alamat-pelayanan"));

                                    let total_harga = modal.find(".total-harga");
                                    total_harga.html(formatRupiah(button.data("total-harga").toString(), "Rp. ")+",00");

                                    let kebutuhan = modal.find(".kebutuhan");
                                    kebutuhan.html(button.data("kebutuhan"));

                                    let tanggal_pelayanan = modal.find(".tanggal-pelayanan");
                                    tanggal_pelayanan.html(button.data("tanggal-pelayanan"));

                                    let input_tanggal_pelayanan = modal.find("input[name=tanggal_pelayanan]");
                                    input_tanggal_pelayanan.val("");

                                    let form_verif = modal.find("#formVerifPendaftaran");
                                    form_verif.trigger("reset");
                                    let id_registrasi = button.data("id-registrasi");
                                    form_verif.attr("action", baseUrl+"admin/homecare/pendaftaran/verif/"+id_registrasi);
                                });
                            });
                            </script>
        ';

        $data['list_dokter'] = $this->dokter_model->get_all(1, null, 1);
        $data['data_registrasi'] = $this->db->query('SELECT drh.id, pasien.name as nama_pasien, dokter.name as nama_dokter, drh.kebutuhan, drh.no_hp, drh.tanggal_pelayanan_pasien, drh.tanggal_pelayanan_admin, drh.alamat_pelayanan, drh.status as status_registrasi, GROUP_CONCAT(mph.nama SEPARATOR "|") as list_nama_pelayanan, GROUP_CONCAT(mph.harga SEPARATOR "|") as list_harga_pelayanan, GROUP_CONCAT(mph.gambar SEPARATOR "|") as list_gambar_pelayanan FROM data_registrasi_homecare drh INNER JOIN detail_data_registrasi_homecare ddrh ON drh.id = ddrh.id_registrasi INNER JOIN master_pelayanan_homecare mph ON ddrh.id_pelayanan = mph.id LEFT JOIN master_user dokter ON drh.id_dokter = dokter.id LEFT JOIN master_user adm ON drh.id_admin = adm.id LEFT JOIN master_user pasien ON drh.id_pasien = pasien.id WHERE drh.status = 0 GROUP BY ddrh.id_registrasi ORDER BY drh.created_at')->result();
        foreach($data['data_registrasi'] as $dr){
            $dr->nama_pelayanan = explode('|', $dr->list_nama_pelayanan);
            $dr->harga_pelayanan = explode('|', $dr->list_harga_pelayanan);
            $dr->gambar_pelayanan = explode('|', $dr->list_gambar_pelayanan);
            $total_harga = 0;
            for($i = 0; $i < count($dr->harga_pelayanan); $i++){
                $total_harga+=$dr->harga_pelayanan[$i];
            }
            $dr->total_harga = $total_harga;

            $dr->tanggal_pelayanan_pasien = (new DateTime($dr->tanggal_pelayanan_pasien))->format('d-m-Y');
            $dr->tanggal_pelayanan_admin = $dr->tanggal_pelayanan_admin ? (new DateTime($dr->tanggal_pelayanan_admin))->format('d-m-Y'):NULL;
        }

        $this->load->view('template', $data);
    }

    public function verif($id_registrasi){
        $this->all_controllers->check_user_admin();
        $data = $this->input->post();
        $id_dokter = $data['id_dokter'];
        $waktu_pelayanan = $data['waktu_pelayanan'];
        if(!$id_dokter || !$waktu_pelayanan){
            $this->session->set_flashdata("msg", "Verifikasi tidak dapat dilakukan, karena data tidak lengkap!");
            redirect(base_url('admin/homecare/pendaftaran'));
        }
        $tanggal_pelayanan = (new DateTime($waktu_pelayanan))->format("Y-m-d");
        $jam_pelayanan = (new DateTime($waktu_pelayanan))->format("H:i:s");

        $data_registrasi_homecare = $this->db->query('SELECT id_pasien FROM data_registrasi_homecare WHERE id = ?', $id_registrasi)->row();
        $data_registrasi_homecare_update = [
            "id_dokter" => $id_dokter,
            "tanggal_pelayanan_admin" => $tanggal_pelayanan,
            "waktu_mulai" => $jam_pelayanan,
            "status" => 1,
            "id_admin" => $this->session->userdata('id_user')
        ];
        $this->db->where("id", $id_registrasi);
        $this->db->update("data_registrasi_homecare", $data_registrasi_homecare_update);

        $notifikasi = 'Dokter dan Jadwal Homecare anda telah ditentukan!';
        $url_notif = base_url('pasien/homecare/pendaftaran');
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

        $this->session->set_flashdata("msg", "Verifikasi berhasil!");
        redirect(base_url('admin/homecare/pendaftaran'));
    }
}