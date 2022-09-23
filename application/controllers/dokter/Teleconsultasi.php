<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teleconsultasi extends CI_Controller
{
    var $menu = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
        $this->load->model('jadwal_telekonsultasi_model');

        $this->load->library(array('Key'));
        $this->load->library('session');
    }
    public function deleteResep()
    {
         header('Content-Type: application/json');
         $this->load->library('form_validation');
        $this->form_validation->set_rules('resep_id', 'ID Jadwal Konsultasi', 'required');
        if(!$this->form_validation->run())
          {
            $array = array(
                'error'   => true,
               );
              echo json_encode($array);
              exit();
          }

          $this->db->where('id', $this->input->post('resep_id'));
          $this->db->where('id_dokter', $this->session->userdata('id_user'));
          $this->db->delete('resep_obat_cart');

          // var_dump($this->db->last_query());

          echo json_encode(['error' => false, 'message' => "Berhasil menghapus resep"]);
          
    }

    public function cartResep()
    {   
        
         $this->load->library('form_validation');
          $this->form_validation->set_rules('id_jadwal_konsultasi', 'ID Jadwal Konsultasi', 'required');
          $this->form_validation->set_rules('id_pasien', 'Pasien', 'required');
          $this->form_validation->set_rules('id_dokter', 'Dokter', 'required');
          $this->form_validation->set_rules('id_obat', 'Obat', 'required');
          $this->form_validation->set_rules('jumlah_obat', 'Jumlah Obat', 'required');
          $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
          if(!$this->form_validation->run())
          {
            $array = array(
                'error'   => true,
                'name_error' => form_error('name'),
                'email_error' => form_error('email'),
                'subject_error' => form_error('subject'),
                'message_error' => form_error('message')
               );
              echo json_encode($array);
              exit();
          }                   
        $data = array(
                'id_jadwal_konsultasi' => $this->input->post('id_jadwal_konsultasi'),
                'id_pasien' => $this->input->post('id_pasien'),
                'id_dokter' => $this->session->userdata('id_user'),
                'id_obat' => $this->input->post('id_obat'),
                'jumlah_obat' => $this->input->post('jumlah_obat'),
                'keterangan' => $this->input->post('keterangan'),
        );
        // var_dump($this->input->post());
        // exit();
        $this->db->insert('resep_obat_cart', $data);
        $id = $this->db->insert_id();
        $this->db->select(' master_obat.id as master_id,
                            resep_obat_cart.id as resep_id,
                            master_obat.name as name,
                            master_obat.unit as satuan_obat,
                            resep_obat_cart.jumlah_obat as jumlah_obat,
                            resep_obat_cart.keterangan as keterangan'
                        );
        $this->db->from('resep_obat_cart');
        $this->db->join('master_obat', 'master_obat.id = resep_obat_cart.id_obat');
        $q = $this->db->where(array('resep_obat_cart.id' => $id))->get();


        $arr = $q->row();
        // var_dump($arr); exit();
        $obj = ['id' => $arr->resep_id,'name' => $arr->name,'jumlah_obat' => number_format($arr->jumlah_obat),'keterangan' =>$arr->keterangan,'satuan_obat' => $arr->satuan_obat];
         header('Content-Type: application/json');
        
        echo json_encode( $obj);
    }
    public function index()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/jadwal_konsultasi';
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['title'] = 'Jadwal Telekonsultasi';
        $data['list_jadwal_konsultasi'] = $this->jadwal_telekonsultasi_model->get_all_by_id_dokter($this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();


        $data['css_addons'] = '<link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">';
        $data['js_addons'] = '
                                <script src="' . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . '"></script>
                                <script src="' . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . '"></script>
                                <script>
                                $(function () {
                                  var table_jadwal_telekonsultasi = $("#table_jadwal_telekonsultasi").DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "pageLength": 5,
                                    "searching": true,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": true,
                                    "responsive": true,
                                  });
                                  $("#table_jadwal_telekonsultasi_filter").remove();
                                  $("#search").on("keyup", function(e){
                                    table_jadwal_telekonsultasi.search($(this).val()).draw();
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
    private function _get_user($username)
    {
        $where = array('username' => $username);

        return $this->all_model->select('master_user', 'row', $where);
    }
    public function teleconsultasi_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/teleconsultasi_pasien';
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['title'] = 'Telekonsultasi';
        $this->load->view('template', $data);
    }

    public function get_active_diagnoses()
    {
        $searchTerm = $this->input->get('searchTerm');

        $pglm = $this->input->get("page_limit");
        $page_lim = (empty($pglm) ? 10 : $pglm);
        $pg = $this->input->get("page");
        $page =  (empty($pg) ? 0 : $pg);
        $limit = $page * $page_lim;
        $cnt = $this->db->query("select id from master_diagnosa WHERE aktif = 1")->result();
        $filteredValues = $this->db->query("select id, concat('(',id,') ',nama) as text FROM master_diagnosa WHERE aktif = 1 AND nama LIKE '%" . $searchTerm . "%' OR id LIKE '".$searchTerm."%' LIMIT $limit , $page_lim ;")->result_array();

        echo json_encode(array(
            'incomplete_results' => false,
            'items' => $filteredValues,
            'total' => count($cnt) // Total rows without LIMIT on SQL query
        ));
    }

    public function update_diagnose_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $data['id_dokter'] = $this->session->userdata('id_user');

        $diagnosis = $this->db->query('SELECT diagnosis FROM diagnosis_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'] . ' AND id_pasien = ' . $data['id_pasien'])->row();
        if ($diagnosis) {
            $update = $this->all_model->update('diagnosis_dokter', $data, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $new_diagnosis = $this->db->insert('diagnosis_dokter', $data);
            echo 'berhasil';
        }

        $data_history = array("activity" => "Diagnosis", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);
    }
    public function update_assesment_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $data['id_dokter'] = $this->session->userdata('id_user');
        $assesment = $this->db->query('SELECT * FROM assesment WHERE id_pasien = ' . $this->input->post('id_pasien') . ' AND id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'])->row();
        if ($assesment) {
            $update = $this->all_model->update('assesment', $data, array('id_pasien' => $this->input->post('id_pasien'), 'id_jadwal_konsultasi' => $data['id_jadwal_konsultasi']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $data['id_pasien'] = $this->input->post('id_pasien');
            $new_assesment = $this->db->insert('assesment', $data);
            echo 'berhasil';
        }

        $data_history = array("activity" => "Assesment Pasien", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $this->input->post('id_pasien'));
        $this->db->insert('data_history_log_dokter', $data_history);
    }
    public function update_resep_dokter_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data = $this->input->post();
        $jml_data = count($data['keterangan']);
        for ($i = 0; $i < $jml_data; $i++) {
            $data_resep = array(
                "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
                "id_pasien" => $data['id_pasien'],
                "id_dokter" => $this->session->userdata('id_user'),
                "id_obat" => $data['id_obat'][$i],
                "jumlah_obat" => $data['jumlah_obat'][$i],
                "keterangan" => $data['keterangan'][$i]
            );
            $this->db->insert('resep_dokter', $data_resep);
        }
        $data_history = array("activity" => "Resep Dokter", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);
    }

    public function data_pasien()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/data_pasien';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $this->load->view('template', $data);
    }

    public function send_data_konsultasi()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $id_dokter = $this->session->userdata('id_user');
        $data = $this->input->post();

        $data['tekanan_darah'] = isset($data['tekanan_darah']) ? $data['tekanan_darah'] : '-';
        $data['suhu'] = isset($data['suhu']) ? $data['suhu'] : '-';
        $data['merokok'] = isset($data['merokok']) ? $data['merokok'] : '0';
        $data['alkohol'] = isset($data['alkohol']) ? $data['alkohol'] : '0';
        $data['kecelakaan'] = isset($data['kecelakaan']) ? $data['kecelakaan'] : '0';
        $data['operasi'] = isset($data['operasi']) ? $data['operasi'] : '0';
        $data['dirawat'] = isset($data['dirawat']) ? $data['dirawat'] : '0';
        $data['keluhan'] = isset($data['keluhan']) ? $data['keluhan'] : '0';

        $data_assesment = array(
            "id_pasien" => $data['id_pasien'],
            "id_dokter" => $id_dokter,
            "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
            "berat_badan" => $data['berat_badan'],
            "tinggi_badan" => $data['tinggi_badan'],
            "tekanan_darah" => $data['tekanan_darah'],
            "suhu" => $data['suhu'],
            "merokok" => $data['merokok'],
            "alkohol" => $data['alkohol'],
            "kecelakaan" => $data['kecelakaan'],
            "operasi" => $data['operasi'],
            "dirawat" => $data['dirawat'],
            "keluhan" => $data['keluhan']
        );

        $assesment = $this->db->query('SELECT * FROM assesment WHERE id_pasien = ' . $data['id_pasien'] . ' AND id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'])->row();
        if ($assesment) {
            $update = $this->all_model->update('assesment', $data_assesment, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi'], 'id_pasien' => $data['id_pasien']));
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $new_assesment = $this->db->insert('assesment', $data_assesment);
            echo 'berhasil';
        }

        $data_history = array("activity" => "Assesment", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        $data_diagnosis_dokter = array(
            "id_dokter" => $id_dokter,
            "id_pasien" => $data['id_pasien'],
            "id_jadwal_konsultasi" => $data['id_jadwal_konsultasi'],
            "id_registrasi" => $data['id_registrasi'],
            "diagnosis" => $data['diagnosis'],
        );
        $diagnosis = $this->db->query('SELECT diagnosis,id_registrasi FROM diagnosis_dokter WHERE id_jadwal_konsultasi = ' . $data['id_jadwal_konsultasi'] . ' AND id_pasien = ' . $data['id_pasien'])->row();
        if ($diagnosis) {
            $update = $this->all_model->update('diagnosis_dokter', $data_diagnosis_dokter, array('id_jadwal_konsultasi' => $data['id_jadwal_konsultasi'], 'id_pasien' => $data['id_pasien']));
            $id_registrasi = $diagnosis->id_registrasi;
            if ($update != 0) {
                if ($update == -1) {
                    echo 'gagal';
                } else {
                    echo 'berhasil';
                }
            } else {
                echo 'tidak ada yang disimpan';
            }
        } else {
            $new_diagnosis = $this->db->insert('diagnosis_dokter', $data_diagnosis_dokter);
            $new_diagnosis = $this->db->query('SELECT id_registrasi FROM diagnosis_dokter WHERE id = ' . $this->db->insert_id())->row();
            $id_registrasi = $new_diagnosis->id_registrasi;
            echo 'berhasil';
        }

        $bukti_pembayaran = $this->db->query('SELECT id FROM bukti_pembayaran WHERE id_registrasi = "' . $id_registrasi . '"')->row();
        $this->all_model->update('bukti_pembayaran', array('selesai_konsultasi' => (new DateTime('now'))->format('Y/m/d H:i:s')), array('id' => $bukti_pembayaran->id));

        $data_history = array("activity" => "Diagnosis", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);
        $this->db->select('master_obat.id as master_id,
                            resep_obat_cart.id as resep_id,
                            resep_obat_cart.id_dokter as id_dokter,
                            resep_obat_cart.id_pasien as id_pasien,
                            master_obat.name as name,
                            master_obat.unit as satuan_obat,
                            resep_obat_cart.jumlah_obat as jumlah_obat,
                            resep_obat_cart.keterangan as keterangan,
                            resep_obat_cart.id_jadwal_konsultasi as id_jadwal_konsultasi,
                            master_obat.harga_per_n_unit as harga_per_n_unit,
                            master_obat.harga as harga,
                            resep_obat_cart.keterangan as keterangan,
                            ');
        $this->db->from('resep_obat_cart');
        $this->db->join('master_obat', 'master_obat.id = resep_obat_cart.id_obat');
        $resep = $this->db->where(array('id_jadwal_konsultasi' =>  $data['id_jadwal_konsultasi']))->get()->result();
        foreach($resep as $r){
            
            $data_resep = array(
                "id_jadwal_konsultasi" => $r->id_jadwal_konsultasi,
                "id_pasien" => $r->id_pasien,
                "id_dokter" => $r->id_dokter,
                "id_obat" => $r->master_id,
                "jumlah_obat" => $r->jumlah_obat,
                "harga_per_n_unit" => $r->harga_per_n_unit,
                "harga" => $r->harga,
                "keterangan" => $r->keterangan,
            );
            $this->db->insert('resep_dokter', $data_resep);
        }
        $data_history = array("activity" => "Resep Dokter", "id_user" => $this->session->userdata('id_user'), "target_id_user" => $data['id_pasien']);
        $this->db->insert('data_history_log_dokter', $data_history);

        echo "OK";
    }

    public function proses_teleconsultasi()
    {
        if (!$this->session->userdata('is_login')) {
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = ' . $this->session->userdata('id_user'))->row();
        if ($valid->id_user_kategori != 2) {
            if ($valid->id_user_kategori == 0) {
                redirect(base_url('pasien/Pasien'));
            } else {
                redirect(base_url('admin/Admin'));
            }
        }
        $id_pasien = $this->input->get('id_pasien');
        $id_jadwal_konsultasi = $this->input->get('id_jadwal_konsultasi');
        // var_dump($id_jadwal_konsultasi);exit();
        $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
        $jadwal_konsultasi = $this->db->query('SELECT id,id_registrasi FROM jadwal_konsultasi WHERE id = ' . $id_jadwal_konsultasi)->row();
        $data['id_registrasi'] = $jadwal_konsultasi->id_registrasi;
        if (!$jadwal_konsultasi) {
            show_404();
        }
        $data['menu'] = $this->menu;
        $data['view'] = 'dokter/proses_teleconsultasi';
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("' . $this->session->userdata('id_user') . '", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();

        $data['pasien'] = $this->db->query('SELECT * FROM master_user WHERE id = ' . $id_pasien)->row();
        $data['assesment'] = $this->db->query('SELECT a.id, a.berat_badan, a.tinggi_badan, a.tekanan_darah, a.suhu, a.merokok, a.alkohol, a.kecelakaan, a.operasi, a.dirawat, a.keluhan FROM assesment a WHERE id_pasien = ' . $id_pasien . ' AND id_jadwal_konsultasi = ' . $id_jadwal_konsultasi)->row();
        if ($data['assesment']) {
            $data['assesment'] = $data['assesment'];
            $data['old_assesment'] = false;
        } else {
            $data['old_assesment'] = true;
            $data['assesment'] = $this->db->query('SELECT a.id, a.berat_badan, a.tinggi_badan, a.tekanan_darah, a.suhu, a.merokok, a.alkohol, a.kecelakaan, a.operasi, a.dirawat, a.keluhan FROM assesment a WHERE id_pasien = ' . $id_pasien . " ORDER BY a.created_at DESC")->row();
        }
        $data['list_obat'] = $this->db->query('SELECT id, name, unit FROM master_obat WHERE active = 1 ORDER BY name')->result();
        $data['diagnosis'] = $this->db->query('SELECT master_diagnosa.id as id_diagnosa, master_diagnosa.nama as nama_diagnosa FROM diagnosis_dokter INNER JOIN master_diagnosa ON diagnosis_dokter.diagnosis = master_diagnosa.id WHERE id_jadwal_konsultasi = ' . $id_jadwal_konsultasi . ' AND id_pasien = ' . $id_pasien)->row();

        $birthDate = new DateTime($data['pasien']->lahir_tanggal);
        $now = new DateTime('today');
        $data['pasien']->age = $birthDate->diff($now)->y;
        $data['user'] = $this->all_model->select('master_user', 'row', 'id = ' . $this->session->userdata('id_user'));
        $data['title'] = 'Telekonsultasi';
        $this->db->select('master_obat.id as master_id,
                            resep_obat_cart.id as resep_id,
                            master_obat.name as name,
                            master_obat.unit as satuan_obat,
                            resep_obat_cart.jumlah_obat as jumlah_obat,
                            resep_obat_cart.keterangan as keterangan
                            ');
        $this->db->from('resep_obat_cart');
        $this->db->join('master_obat', 'master_obat.id = resep_obat_cart.id_obat');
        $data['resep_obat_cart'] = $this->db->where(array('id_jadwal_konsultasi' =>  $id_jadwal_konsultasi))->get()->result();
        // echo $this->db->last_query(); exit();
        $data['css_addons'] = '
          <link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') . '"><link rel="stylesheet" href="' . base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') . '">
          <script src="https://meet.jit.si/external_api.js"></script>
          ';
        $data['js_addons'] = "
<script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js'></script> 

    
    <script src='" . base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') . "'></script>
                                <script src='" . base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') . "'></script>
                                <script>
                                $(function () {
                                  $('#table_resep').DataTable({
                                    'paging': true,
                                    'lengthChange': true,
                                    'searching': true,
                                    'ordering': true,
                                    'info': false,
                                    'autoWidth': true,
                                    'responsive': true,
                                  });
                                });

function checkRemove() {
    if ($('div.resep-dokter').length == 1) {
        $('#remove').hide();
    } else {
        $('#remove').show();
    }
};
$(document).ready(function() {

    $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
    checkRemove();
    $('#add').click(function() {
        $('div.resep-dokter:last').after($('div.resep-dokter:first').clone());
        $('div.resep-dokter:last').find('input').val('');
        checkRemove();

    });
    $('#remove').click(function() {
        $('div.resep-dokter:last').remove();
        checkRemove();
    });
    $('[hapus-obat]').click(function(e){
        alert('aa');
        })
        dataobat_ls =[];
    // $('#formResepDokter').submit(function(e){
    //      e.preventDefault();
    //     var dataResep = $(this).serializeArray();
    //     var namaObat = $('select[name=id_obat] option:selected').text();
    //     var listResep = $('#listResep');
    //     var countTr = $('#listResep tr');
    //     countTr = countTr.length;
    //     if(countTr == null){
    //         countTr = 0;
    //     }
    //     countTr+=1;
    //     var templateListResep = '<tr><td>'+namaObat+'</td><td>'+dataResep[2].value+' '+dataResep[4].value+'</td><td>'+dataResep[3].value+'</td><td><button class=\'btn btn-secondary\' type=\'button\' hapus-obat onclick=\'return (this.parentNode).parentNode.remove();\' ><i class=\'fas fa-trash-alt\'></i></button></td><input type=\'hidden\' name=\''+dataResep[0].name+'[]\' value=\''+dataResep[0].value+'\'><input type=\'hidden\' name=\''+dataResep[1].name+'[]\' value=\''+dataResep[1].value+'\'><input type=\'hidden\' name=\''+dataResep[2].name+'[]\' value=\''+dataResep[2].value+'\'><input type=\'hidden\' name=\''+dataResep[3].name+'[]\' value=\''+dataResep[3].value+'\'></tr>';
    //     listResep.append(templateListResep);
    //     $(this)[0].reset();
    //     $('#ModalResep').modal('hide');
    //     alert('Resep telah ditambahkan!');
    //     dataobat_ls.push(dataResep)
    //     console.log(dataobat_ls);
       
    // });
   
    $('select[name=diagnosis]').select2({
          ajax: {
            url: '" . base_url('dokter/Teleconsultasi/get_active_diagnoses') . "',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term, // search term
                    page_limit: 50,
                    page: params.page || 0
                };
            },
            processResults: function (data, params) {
                // console.log(params.page);
                // console.log(data.total);
                // console.log((params.page * 50) < data.total);
                params.page = params.page || 0; 
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 50) < data.total
                      }
                };
            },
            cache: true
        }
    });
});
</script>
<script src='" . base_url('assets/js/message.js') . "'></script>
		";
        $data['teleconsul_admin_js'] = "
if(JSON.parse(JSON.parse(payload.data.body).id_user).includes(userid.toString())){
    if(JSON.parse(JSON.parse(payload.data.body).name == 'panggilan_konsultasi_berakhir_dokter')){
            console.log(JSON.parse(payload.data.body).chat_id);
            $.ajax({
                method : 'POST',
                url    : baseUrl+'dokter/Teleconsultasi/send_data_konsultasi',
                data   : JSON.parse(payload.data.body).data_konsultasi,
                success : function(data){
                    console.log('test');
                    console.log(data);
                    firebase.auth().signInAnonymously().catch(function(error) {
                    // Handle Errors here.
                        var errorCode = error.code;
                        var errorMessage = error.message;
                    // ...
                    });
                    firebase.auth().onAuthStateChanged(function(user) {
                        if (user) {
                                firebase.database()
                                .ref(JSON.parse(payload.data.body).chat_id)
                                .remove().then(function() {
										console.log('SUKSES Hapus Chat');
										location.href = '" . base_url('dokter/Teleconsultasi') . "';
										api.executeCommand('stopRecording', {
											mode: 'file' //recording mode to stop, `stream` or `file`
										});
									}).catch(function(error) {
										console.error('Error removing document: ', error);
								});
                        }
                    });      
                },
                error : function(request, status, error){
                    console.log(request);
                    console.log(status);
                    console.log(error);
                }
            }); 
        }
    }   
        ";
        $data['diagnoses'] = $this->db->query('SELECT * FROM master_diagnosa WHERE aktif = 1')->result();
        $this->load->view('template', $data);
    }
}
