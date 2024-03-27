<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {
	public $data;

	public function __construct() {
        parent::__construct();     
        
        $this->load->library('send_email');
    }

    public function index(){
        $this->load->view('forgot_password.php');
    }

    public function send_request(){
        $password = substr(md5(mt_rand()), 0, 8);
    
        if(!empty($this->input->post('email'))){
            $this->db->where('email', $this->input->post('email'));
            $check = $this->db->get('master_user');

            if($check->num_rows() > 0){
                
                // $data['email'] = $this->input->post('email');
                $data_message['password'] = $password;
                $data_message['logo'] = base_url("assets/telemedicine/img/logo.png");
                // Set to, from, message, etc.
                $this->send_email->send(
					$this->input->post('email'), 
					'Forgot Password', 
					$data_message, 
					'forgot'
				);

                $datapwd = array(
                    'password' => password_hash($password, PASSWORD_ARGON2ID,  ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3])
                );
                $this->db->where('email', $this->input->post('email'));
                $this->db->update('master_user', $datapwd);

                $response['status'] = true;
                $this->session->set_flashdata('msg_forgot_pass', 'Password baru telah dikirim ke email anda!');
                redirect(base_url('login'));
                
            }else{
                $response['status'] = false;
                $response['msg'] = 'Email yang anda masukan tidak terdaftar';
                $this->session->set_flashdata('msg_forgot_pass', $response['msg']);
                redirect(base_url('ForgotPassword'));
            }
        }else {
			$response['msg'] = 'Masukan Email';
            $this->session->set_flashdata('msg_forgot_pass', $response['msg']);
            redirect(base_url('ForgotPassword'));
		}
    }
}