<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config extends CI_Controller
{
    var $menu = 11;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->library('all_controllers');
    }

    public function poli()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Manage Poli",
            $view="admin/manage_poli"
        );

        $data['poli'] = $this->db->query('SELECT nominal.poli as name_poli, nominal.id, nominal.harga, nominal.biaya_adm, nominal.aktif FROM nominal ORDER BY nominal.poli')->result();
        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                            <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                            <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                            <script>
                            $(document).ready(function () {
                                var table_poli = $("#table_poli").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                "lengthChange": false,
                                "searching": true,
                                "pageLength": 5,
                                });
                                $("#table_poli_filter").remove();
                                $("#search").on("keyup", function(e){
                                  table_poli.search($(this).val()).draw();
                                });

                                $("#modalHapus").on("show.bs.modal", function(e) {
                                    var nama = $(e.relatedTarget).data("nama");
                                    $(e.currentTarget).find("#nama").html(nama);

                                    var href_input = $(e.relatedTarget).data("href");
                                    $(e.currentTarget).find("#buttonHapus").attr("href", href_input);
                                });

                                $("#modalStatusPoli").on("show.bs.modal", function(e){
                                    var modal = $(e.currentTarget);
                                    var button = $(e.relatedTarget);

                                    var nama = button.data("nama-poli");
                                    var id = button.data("id-poli");
                                    var status = button.data("status-poli");

                                    if(status == "aktif"){
                                        var status = "menonaktifkan";
                                        var status_val = 0;
                                    }
                                    else{
                                        var status = "mengaktifkan";
                                        var status_val = 1;
                                    }
                                    var link = "'.base_url('admin/Config/update_status_poli/').'"+id+"/"+status_val;

                                    modal.find(".nama-poli").html(nama);
                                    modal.find(".delete-btn").attr("href", link);
                                    modal.find(".status-poli").html(status);
                                });
                            });
                            </script>';
        $this->load->view('template', $data);
    }


    private function _get_json_data($status = FALSE, $message = '', $data = NULL)
    {
        $result = new stdClass();

        $result->status = $status;
        $result->message = $message;
        $result->data = $data;

        return $result;
    }

    public function formAddPoli()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Tambah Poli",
            $view="admin/form_poli"
        );
        
        $kategori['id_user_kategori'] = 2;
        $data['dokter'] = $this->all_model->select('master_user', 'tabel', $kategori);

        $this->load->view('template', $data);
    }

    public function formEditPoli($id)
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Edit Poli",
            $view="admin/form_edit_poli"
        );

        $kategori['id_user_kategori'] = 2;
        $data['dokter'] = $this->all_model->select('master_user', 'tabel', $kategori);
        $data['data'] = $this->db->query('SELECT n.id, n.poli as name_poli, n.harga, n.biaya_adm, n.aktif FROM nominal n WHERE n.id = ' . $id)->row();

        $this->load->view('template', $data);
    }


    public function addPoli()
    {
        $this->all_controllers->check_user_admin();

        $data = $this->input->post();
        $data['biaya_adm'] = $data['biaya_adm'] == '' ? null:$data['biaya_adm'];
        // $data['name'] = strtoupper($data['name']);
        $data_nominal = array(
            'poli' => $data['name'], 
            'harga' => $data['harga'], 
            'aktif'=>$data['aktif'], 
            'biaya_adm'=>$data['biaya_adm']
        );
        $new_poli = $this->db->insert('nominal', $data_nominal);
        if ($new_poli > 0) {
            $this->session->set_flashdata('msg_poli', 'Poli Berhasil Ditambahkan!');
            redirect(base_url('admin/Config/poli'));
        } else {
            $this->session->set_flashdata('msg_poli', 'Nama Poli Sudah Tersedia');
            redirect(base_url('admin/Config/formAddPoli'));
        }
    }

    public function updatePoli($id)
    {
        $this->all_controllers->check_user_admin();

        $result = $this->_get_json_data();
        $data = $this->input->post();
        // var_dump($data);
        $data['biaya_adm'] = $data['biaya_adm'] == '' ? null:$data['biaya_adm'];
        // var_dump($data['biaya_adm']);
        // die;
        // $data['name'] = strtoupper($data['name']);
        $data_nominal = array('harga' => $data['harga'], 'poli' => $data['name'], 'aktif'=>$data['aktif'], 'biaya_adm'=>$data['biaya_adm']);
        $poli = $this->db->query('SELECT poli as name FROM nominal WHERE id = ' . $id)->row();
        $poli_2 = $this->db->query('SELECT poli as name FROM nominal WHERE poli = "' . $data['name'] .'"')->row();
         if($poli->name != $data['name'] && $poli_2){
             $result->message = 'Nama Poli sudah digunakan!';
             $this->session->set_flashdata('msg_poli', $result->message);
             redirect(base_url('admin/Config/formEditPoli/'.$id));
         }

        $jadwal_dokter_same_poli = $this->db->query('SELECT * FROM jadwal_dokter WHERE poli = "' . $poli->name . '"')->result();
        foreach ($jadwal_dokter_same_poli as $jd) {
            $this->all_model->update('jadwal_dokter', array('poli' => $data['name']), array('id' => $jd->id));
        }

        $where = array('poli' => $poli->name);
        $this->all_model->update('nominal', $data_nominal, $where);
        $result->status = TRUE;
        $result->message = 'Poli berhasil diubah';

        $this->session->set_flashdata('msg_poli', $result->message);
        redirect(base_url('admin/Config/poli'));
    }


    public function deletePoli($id)
    {
        $this->all_controllers->check_user_admin();

        $where = array('id' => $id);
        $poli = $this->db->query('SELECT poli FROM nominal WHERE id = '.$id)->row();
        if(!$poli){
            redirect(base_url('admin/Config/poli'));
        }
        $jadwal_dokter = $this->db->query('SELECT id FROM jadwal_dokter WHERE poli = "'.$poli->poli.'"')->row();
        if($jadwal_dokter){
            $result->message = 'GAGAL: Poli ini masih terkait dengan dokter!';
            $this->session->set_flashdata('msg_poli', $result->message);
            redirect(base_url('admin/Config/poli'));
        }

        if ($this->all_model->delete('nominal', $where) > 0) {
            $result->message =  "Poli berhasil dihapus";
        } else {
            $result->message = "Poli gagal dihapus";
        }

        $this->session->set_flashdata('msg_poli', $result->message);
        redirect(base_url('admin/Config/poli'));
    }

    public function update_status_poli($id, $status){
        $this->all_controllers->check_user_admin();

        if(!isset($status) || !isset($id)){
            show_404();
        }

        $data_update = array(
            'aktif'=>$status
        );
        $data_registrasi = $this->db->query('SELECT nominal.id, nominal.poli FROM data_registrasi INNER JOIN jadwal_dokter ON data_registrasi.id_jadwal = jadwal_dokter.id INNER JOIN master_user dokter ON jadwal_dokter.id_dokter = dokter.id INNER JOIN detail_dokter ON detail_dokter.id_dokter = dokter.id INNER JOIN nominal ON detail_dokter.id_poli = nominal.id WHERE nominal.id = '.$id)->result();
        
        if(count($data_registrasi) > 0){
            $message = 'GAGAL: Masih Ada '.count($data_registrasi).' Proses Telekonsultasi Yang Berjalan Di Poli Ini!';
            $this->session->set_flashdata('msg_poli', $message);
            redirect(base_url('admin/Config/poli'));
        }else{
            $this->all_model->update('nominal', $data_update, array('id'=>$id));

            $message = 'BERHASIL: Poli Telah Dinonaktifkan!';
            $this->session->set_flashdata('msg_poli', $message);
            redirect(base_url('admin/Config/poli'));
        }
    }

    public function resep_obat()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Config Resep",
            $view="admin/config_resep"
        );
        $resep =  $this->db->where('id','RD001')->get('kop_resep_dokter')->row();
        if(empty($resep))
        {
            $this->db->insert('kop_resep_dokter',['id' => 'RD001','nama_faskes' => 'Telecare by Indihealth','logo' => 'default','alamat'=> 'Jalan Ganesha no 12 (Gedung STP lt.4), Kota Bandung, Jawa Barat, 40132','email'=>'info@indihealth.com','website'=>'indihealth.com','no_telp'=>null,'fax'=>null,'no_wa' => '+62 896-0299-0020','activated' => true,'updated_by' => $this->session->userdata('id_user')]);
            $resep =  $this->db->where('id','RD001')->get('kop_resep_dokter')->row();
        }
        $data['resep'] = $resep;
        $this->load->view('template', $data);
    } 

    public function resep_obat_update()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title="Config Resep",
            $view="admin/config_resep"
        );
        if(!empty($this->input->post('logo')))
        {
            $file_name= md5("logo_resep-".time());
            $folder_nm = 'assets/img/logo/resep_obat');
            $path = FCPATH . $folder_nm;
            // var_dump($path);
            if(!is_dir($path)){
                        mkdir($path, 0777, TRUE);
                    }
                    $config['upload_path']          = FCPATH.'assets/files/resep/'.md5($this->input->post('id_jadwal_konsultasi').$this->session->userdata('id_user'));
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '60%';
                    $config['max_size']             = 100000;
                    $config['file_name'] = $file_name;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload('file'))
                    {
                            $error = array('error' => $this->upload->display_errors(),'status' => false);
                           return $this->output
                            ->set_content_type('application/json')
                            ->set_status_header(200)
                            ->set_output(json_encode($error));
                    }
                    $fnm = $file_name.$ext;
        }else{
            $fnm = 'default.jpg';
        }

                $ext = $this->upload->data('file_ext');

            $resep =  $this->db->where('id','RD001')->update('kop_resep_dokter',
            [
                'nama_faskes' => $this->input->post('nama_faskes'),
                'logo' => $fnm,
                'alamat'=> $this->input->post('alamat'),
                'email'=>$this->input->post('email'),
                'website'=>$this->input->post('website'),
                'no_telp'=>$this->input->post('no_telp'),
                'fax'=>$this->input->post('fax'),
                'no_wa' => $this->input->post('no_wa'),
                'activated' => true,
                'updated_by' => $this->session->userdata('id_user')
        ]);
       
        $data['resep'] = $resep;
        redirect(base_url('admin/Config/resep_obat'));
    }
}


