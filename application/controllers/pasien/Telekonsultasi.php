<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telekonsultasi extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();   
        $this->load->model('all_model');
        $this->load->model('jadwal_telekonsultasi_model');

         $this->load->library(array('Key'));          
    }
    
    public function jadwal(){
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
        $data['title'] = 'Jadwal Telekonsultasi';
        $data['view'] = 'pasien/jadwal_telekonsultasi';
	      $data['user'] = $this->db->query('SELECT id, name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();        
        //$data['list_jadwal_konsultasi'] = $this->db->query('SELECT jk.tanggal, jk.jam, d.name as nama_dokter, d.id as id_dokter, n.poli FROM jadwal_konsultasi jk INNER JOIN master_user d ON jk.id_dokter = d.id INNER JOIN detail_dokter dd ON dd.id_dokter = d.id INNER JOIN nominal n ON dd.id_poli = n.id WHERE id_pasien = '.$this->session->userdata('id_user'))->result();
        $data['list_jadwal_konsultasi'] = $this->jadwal_telekonsultasi_model->get_all_by_id_pasien($this->session->userdata('id_user'));
        $data['css_addons'] = '<link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css').'"><link rel="stylesheet" href="'.base_url('assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css').'">';
        $data['js_addons'] = '
                                <script src="'.base_url('assets/adminLTE/plugins/datatables/jquery.dataTables.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js').'"></script>
                                <script src="'.base_url('assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js').'"></script>
                                <script>
                                $(document).ready(function () {
                                    var table_jadwal_telekonsultasi = $("#table_jadwal_telekonsultasi").DataTable({
                                                    "responsive": true,
                                                    "autoWidth": false,
                                                    "lengthChange": false,
                                                    "searching": true,
                                                    "pageLength": 5,
                                                });
                                    $("#table_jadwal_telekonsultasi_filter").remove();
                                    $("#search").on("keyup", function(e){
                                        table_jadwal_telekonsultasi.search($(this).val()).draw();
                                    });
                                });

                              </script>';
        $this->load->view('template', $data);
    }

    public function submitAssesment(){
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
        $data['name'] = 'unshow';
        $data['sub_name'] = 'submit_assesment_pasien';
        $data['id_user'] = json_encode(array($data['id_dokter']));
        $dokter = $this->db->query('SELECT reg_id FROM master_user WHERE id_user_kategori = 2 AND id = '.$data['id_dokter'])->row();
        $msg_notif = json_encode($data);
        $this->key->_send_fcm($dokter->reg_id, $msg_notif);

	unset($data['name']);
	unset($data['sub_name']);
	unset($data['id_user']);

	$data['id_pasien'] = $this->session->userdata('id_user');

	$assesment = $this->db->query('SELECT id FROM assesment WHERE id_jadwal_konsultasi = '.$data['id_jadwal_konsultasi'].' AND id_pasien = '.$this->session->userdata('id_user'))->row();
	if(!$assesment){
		$this->db->insert('assesment', $data);
	}
	else{
		$this->all_model->update('assesment', $data, array('id_jadwal_konsultasi'=>$data['id_jadwal_konsultasi']));
	}

        echo "OK";
    }

    public function konsultasi($id_dokter=null, $id_jadwal_konsultasi=null,$roomName=null){
        if(!$id_dokter || !$id_jadwal_konsultasi){
            show_404();
        }
        $jadwal_konsultasi = $this->db->query('SELECT id FROM jadwal_konsultasi WHERE id = '.$id_jadwal_konsultasi)->row();
        if(!$jadwal_konsultasi){

            show_404();
        }
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
      $post_data = $this->input->get();
    //   echo var_dump($post_data);
    //   die;
      if(!isset($roomName)){
          show_404();
      }
      $roomName = $roomName;

      $data['title'] = 'Telekonsultasi';
      $data['roomName'] = $roomName;
      $data['view'] = 'pasien/proses_telekonsultasi';
      $data['user'] = $this->db->query('SELECT id,name, foto FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        $data['list_notifikasi'] = $this->db->query('SELECT * FROM data_notifikasi WHERE find_in_set("'.$this->session->userdata('id_user').'", id_user) <> 0 AND status = 0 ORDER BY tanggal DESC')->result();      
      $data['pasien'] = $this->db->query('SELECT * FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
      $data['dokter'] = $this->db->query('SELECT * FROM master_user WHERE id = '.$id_dokter)->row();
      $data['assesment'] = $this->db->query('SELECT * FROM assesment WHERE id_pasien = '.$this->session->userdata('id_user').' AND id_jadwal_konsultasi = '.$id_jadwal_konsultasi)->row();
        if($data['assesment']){
            $data['assesment'] = $data['assesment'];
            $data['old_assesment'] = false;
        }  
        else{
            $data['old_assesment'] = true;
            $data['assesment'] = $this->db->query('SELECT a.id, a.berat_badan, a.tinggi_badan, a.tekanan_darah, a.suhu, a.merokok, a.alkohol, a.kecelakaan, a.operasi, a.dirawat, a.keluhan FROM assesment a WHERE id_pasien = '.$this->session->userdata('id_user')." ORDER BY a.created_at DESC")->row();
        }
    $data['css_addons'] = "<script src='https://meet.jit.si/external_api.js'></script>";
      if(!$data['old_assesment']){
        $data['js_addons'] = "
        <script>
        $(document).ready(function(){
            $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
        });
        // $('#formAssesment').find(':radio:not(:checked)').attr('disabled', true);
        </script>
        <script src='".base_url('assets/js/message.js')."'></script>
        ";
      }
      else{
        $data['js_addons'] = "
        <script>
        $(document).ready(function(){
            $('.chat-wrap-inner').scrollTop($('.chat-wrap-inner')[0].scrollHeight);
            alert('Isi assesment terlebih dahulu!');
            $('#ModalAssesment').modal({backdrop: 'static', keyboard: false});
            $('#ModalAssesment').modal('show');

            $('#formModalAssesment').on('submit', function(e){
				e.preventDefault();
                $.ajax({
                    method : 'POST',
                    url    : baseUrl+'pasien/Telekonsultasi/submitAssesment',
                    data   : $('#formModalAssesment').serialize()+'&csrfName=".$this->security->get_csrf_token_name()."&csrfHash=".$this->security->get_csrf_hash()."',
                    success : function(data){ 
                    firebase
                          .database()
                          .ref('assesment/".md5($this->session->userdata('id_user')."_".$id_jadwal_konsultasi)."')
                          .update({ 
                           
                            inputed: 1,
                            berat_badan: $('#formModalAssesment input[name=berat_badan]').val(),
                            tinggi_badan: $('#formModalAssesment input[name=tinggi_badan]').val(),
                            suhu: $('#formModalAssesment input[name=suhu]').val(),
                            tekanan_darah: $('#formModalAssesment input[name=tekanan_darah]').val(),
                            merokok: $('#formModalAssesment input[name=merokok]').val(),
                            alkohol: $('#formModalAssesment input[name=alkohol]').val(),
                            kecelakaan: $('#formModalAssesment input[name=kecelakaan]').val(),
                            dirawat: $('#formModalAssesment input[name=dirawat]').val(),
                            operasi: $('#formModalAssesment input[name=operasi]').val(),
                            keluhan: $('#formModalAssesment textarea[name=keluhan]').val(),
                          });                                          
                        $('#formAssesment input[name=berat_badan]').val($('#formModalAssesment input[name=berat_badan]').val());
                        $('#formAssesment input[name=tinggi_badan]').val($('#formModalAssesment input[name=tinggi_badan]').val());
                        $('#formAssesment input[name=suhu]').val($('#formModalAssesment input[name=suhu]').val());
                        $('#formAssesment input[name=tekanan_darah]').val($('#formModalAssesment input[name=tekanan_darah]').val());
                        $('#formAssesment input[name=merokok]').val($('#formModalAssesment input[name=merokok]').val());
						
						$('#formAssesment .'+$('#formModalAssesment input[name=merokok]:checked').attr('class')).prop('checked', true);
						$('#formAssesment .'+$('#formModalAssesment input[name=merokok]:checked').attr('class')).prop('disabled', false);
						$('#formAssesment .'+$('#formModalAssesment input[name=merokok]:not(:checked)').attr('class')).prop('disabled', true);
						
						$('#formAssesment .'+$('#formModalAssesment input[name=alkohol]:checked').attr('class')).prop('checked', true);
						$('#formAssesment .'+$('#formModalAssesment input[name=alkohol]:checked').attr('class')).prop('disabled', false);
						$('#formAssesment .'+$('#formModalAssesment input[name=alkohol]:not(:checked)').attr('class')).prop('disabled', true);
						
						$('#formAssesment .'+$('#formModalAssesment input[name=kecelakaan]:checked').attr('class')).prop('checked', true);
						$('#formAssesment .'+$('#formModalAssesment input[name=kecelakaan]:checked').attr('class')).prop('disabled', false);
						$('#formAssesment .'+$('#formModalAssesment input[name=kecelakaan]:not(:checked)').attr('class')).prop('disabled', true);
						
						$('#formAssesment .'+$('#formModalAssesment input[name=dirawat]:checked').attr('class')).prop('checked', true);
						$('#formAssesment .'+$('#formModalAssesment input[name=dirawat]:checked').attr('class')).prop('disabled', false);
						$('#formAssesment .'+$('#formModalAssesment input[name=dirawat]:not(:checked)').attr('class')).prop('disabled', true);
						
						$('#formAssesment .'+$('#formModalAssesment input[name=operasi]:checked').attr('class')).prop('checked', true);
						$('#formAssesment .'+$('#formModalAssesment input[name=operasi]:checked').attr('class')).prop('disabled', false);
						$('#formAssesment .'+$('#formModalAssesment input[name=operasi]:not(:checked)').attr('class')).prop('disabled', true);
						
                        $('#formAssesment textarea[name=keluhan]').val($('#formModalAssesment textarea[name=keluhan]').val());
                        $('#ModalAssesment').modal('hide');
                    },
                    error : function(data){
                        alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
                    }
                }); 
            });
        });
        // $('#formAssesment').find(':radio:not(:checked)').attr('disabled', true);
        </script>
        <script src='".base_url('assets/js/message.js')."'></script>
        ";
      }
      $birthDate = new DateTime($data['pasien']->lahir_tanggal);
      $now = new DateTime('today');
      $data['pasien']->age = $birthDate->diff($now)->y;
      $data['id_jadwal_konsultasi'] = $id_jadwal_konsultasi;
      $this->load->view('template', $data);
    }    
    
}
