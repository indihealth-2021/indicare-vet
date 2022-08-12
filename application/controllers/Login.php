<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {	
	public function __construct() {
        parent::__construct();
        $this->data = new stdClass();
		 $this->result = new stdClass();
		 $this->load->library('session');
	     $this->load->library(array('Key'));   
	 }   

	 public function test_email(){
		$data = array(
			'mail'      => 'horor@abyssmail.com',
			'pesan' => 'testemail',
			'subjek' => 'Test Emailing'
		);

		$data_string = json_encode($data);

		$curl = curl_init('http://indihealth.com/api/Send');

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data_string))
		);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

		// Send the request
		$result = curl_exec($curl);

		// Free up the resources $curl is using
		curl_close($curl);

		echo 'ok';
	 }
	 
	public function index(){
		if(!$this->session->has_userdata('web_token')){
			if(get_cookie('cookielogin[is_login]')){
				$this->db->select('*');
				$this->db->from('master_user');
				$this->db->group_start();
				$this->db->where('username', get_cookie('cookielogin[user]'));
				$this->db->or_where('email', get_cookie('cookielogin[user]'));
				$this->db->group_end();
				$this->db->where('password', md5(get_cookie('cookielogin[password]')));
				$user = $this->db->get()->row();

				if($user){
					$this->session->set_userdata(array(
						'web_token'=> md5(uniqid()),
						'id_user'  => $user->id,
						'is_login' => true
					));
					$this->_category_check($user);
				}
			}
			$data['menu_landing'] = 2;
			$this->load->view('login', $data);
		}
		else{
			$this->data = $this->all_model->select('master_user', 'row', 'web_token = "'.$this->session->userdata('web_token').'"');	
			if(!is_null($this->data))
			{
				$this->_category_check($this->data);
			} else {
				redirect('login');
			}
		}
	}

	public function login() {		
		//$this->data = $this->all_model->select('master_user', 'row', 'email = "' . $this->input->post('email') . '" or username = "' . $this->input->post('email') .'"');
		$this->db->select('*');
		$this->db->from('master_user');
		$this->db->where('email', $this->input->post('email'));
		$this->db->or_where('username', $this->input->post('email'));
		$this->data = $this->db->get()->row();
		if (!is_null($this->data)) {
			if (password_verify($this->input->post('password'), $this->data->password)) {
				if ($this->data->aktif != 0) {
					//$this->_fasyankes_auth();

					$token = md5(uniqid());
					$is_update = $this->all_model->update(
						'master_user', 
						array('web_token' => $token), 
						array('id' => $this->data->id)
					);
					if ($is_update == 1) {				
						$this->result->status = true;
						$this->result->data = $this->data;
						$this->session->set_userdata(array(
							'web_token'=> $token,
							'id_user'  => $this->data->id,
							'is_login' => true
						));
						// echo var_dump($this->session->userdata());
						// die;
						// TAMBAH KE ACTIVITY LOG DENGAN NAMA ACTIVITY = Login
						$this->load->library('user_agent');

						if ($this->agent->is_browser())
						{
								$agent = $this->agent->browser().' '.$this->agent->version();
						}
						elseif ($this->agent->is_robot())
						{
								$agent = $this->agent->robot();
						}
						elseif ($this->agent->is_mobile())
						{
								$agent = $this->agent->mobile();
						}
						else
						{
								$agent = 'Unidentified User Agent';
						}
				
						$ip_address = $this->input->ip_address();
				
						$data = array(
							"id_user"=>$this->session->userdata('id_user'),
							"ip"=>$ip_address,
							"user_agent"=>$agent,
							"activity"=>'Login'
						);
				
						$this->db->insert('log_activity', $data);
						// ============================================================ //
						if($this->input->post('remember_me')){
							set_cookie('cookielogin[is_login]', true, time()+3600);
							set_cookie('cookielogin[user]', $this->input->post('email'), time()+3600);
							set_cookie('cookielogin[pass]', $this->input->post('password'), time()+3600);
						}
						$this->_category_check($this->data);
					} else {
						$this->result->status = false;
						$this->result->message = 'Login gagal, silahkan coba lagi';
						$this->session->set_flashdata('msg_login',$this->result->message);
						redirect('Login');
					}
				} else {
					$this->result->status = false;
					$this->result->message = 'Akun yang dimaksud telah dinonaktifkan oleh admin / Akun yang dimaksud belum aktif!';
					$this->session->set_flashdata('msg_login',$this->result->message);
					redirect('Login');
				}
			} else {
				$this->result->status = false;
				$this->result->message = 'Username/password yang dimasukkan salah';
				$this->session->set_flashdata('msg_login',$this->result->message);
				redirect('Login');
			}
		} else {
			$this->result->status = false;
			$this->result->message = 'User tidak ditemukan';
			$this->session->set_flashdata('msg_login',$this->result->message);
			redirect('Login');
		}
		
	}
	private function _category_check($userdata) {
		switch ($userdata->id_user_kategori) {
			case '0':
				redirect(base_url('pasien/Pasien'));
				break;
			case '2' : 
				redirect(base_url('dokter/Dashboard')); 
				break;
			case '5':
				if($userdata->id_user_level == 1){
					redirect(base_url('admin/Admin'));
				}
				else if($userdata->id_user_level == 2){
					redirect(base_url('admin/FarmasiVerifikasiObat'));
				}
				break;
			case '6':
				if($userdata->id_user_level == 1){
					redirect(base_url('diampu/Diampu/list_pengampu'));
				}else{
					redirect(base_url('pengampu/Pengampu'));
				}
				break;
		}
	}

    private function _fasyankes_auth() {
    	if (! is_null($this->data->id_fasyankes)) {
    		$where = array(
	    		'id' => $this->data->id_fasyankes,
	    		'aktif' => 1
	    	);

	    	$this->data->fasyankes = $this->all_model->select('master_fasyankes', 'row', $where);

	    	if (! $this->data->fasyankes) {
	    		$this->result->message = 'Fasyankes dari akun yang dimaksud telah dinonaktifkan, silahkan hubungi Admin';
				$this->session->set_flashdata('msg',$this->result->message);
				redirect('Login');
	    	}

	    	$this->_kota_auth($this->data->fasyankes->id_kota);
    	}
    }

    private function _kota_auth($id_kota) {
    	$where = array(
    		'id' => $id_kota,
    		'aktif' => 1
    	);

    	$this->data->kota = $this->all_model->select('master_kota', 'row', $where);
		// echo var_dump($this->db->error());
		// die;

    	if (! $this->data->kota) {
    		$result->message = 'Kota dari fasyankes telah dinonaktifkan, silahkan hubungi Admin';
			$this->session->set_flashdata('msg',$this->result->message);
			redirect('Login');
    	}

    	$this->_provinsi_auth($this->data->kota->id_provinsi);
    }

    private function _provinsi_auth($id_provinsi) {
    	$where = array(
    		'id' => $id_provinsi,
    		'aktif' => 1
    	);

    	$this->data->provinsi = $this->all_model->select('master_provinsi', 'row', $where);

    	if (! $this->data->provinsi) {
    		$this->result->message = 'Provinsi dari fasyankes telah dinonaktifkan, silahkan hubungi Admin';
			$this->session->set_flashdata('msg',$this->result->message);
			redirect('Login');
    	}
    }	
}
