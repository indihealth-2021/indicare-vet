<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_email{
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('email');
    }

    public function send($to, $subject, $data = null, $template = null){
        // $config['protocol'] = "smtp";
        // $config['smtp_host'] = "mail.telemedicine.lintasarta.net";
        // $config['smtp_port'] = 465;
        // $config['smtp_user'] = "telemedicine@telemedicine.lintasarta.net"; 
        // $config['smtp_pass'] = "P@ssw0rd123*#";
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "telemedicine-internal.indihealth.com";
        $config['smtp_port'] = 465;
        $config['smtp_user'] = "telemedicine@telemedicine-internal.indihealth.com"; 
        $config['smtp_pass'] = "G]YGh;Rh+bI4";
        $config['smtp_crypto'] = 'ssl';
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->CI->email->initialize($config);

        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from($config['smtp_user'], 'Telemedicine Indihealth');
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        
        if($template != null){
            $body = $this->CI->load->view($template, $data, TRUE);
        }else{
            $body = 'Tidak ada pesan!';
        }
        $this->CI->email->message($body);

        echo $this->CI->email->send();
    }
}
