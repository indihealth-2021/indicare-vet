<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    var $menu = 9;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('master_jadwal_model');
        $this->load->model('pasien_model');
        $this->load->model('assesment_model');

        $this->load->library('all_controllers');
    }

    public function index()
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Manage Pasien",
            $view = "admin/manage_event"
        );

      
        // $data['list_pasien'] = $this->pasien_model->get_all();
        $this->load->view('template', $data);
    }

    public function monitoring($id,$room_id)
    {
        $this->all_controllers->check_user_admin();
        $data = $this->all_controllers->get_data_view(
            $title = "Manage Pasien",
            $view = "admin/event_proses"
        );

      
        // $data['list_pasien'] = $this->pasien_model->get_all();
        $this->load->view('template', $data);
    }

}
