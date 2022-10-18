<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CetakResep extends CI_Controller {
	var $menu = 2;

	public function __construct() {
        parent::__construct();   
        $this->load->model('all_model');
		$this->load->model('master_jadwal_model'); 
        $this->load->library('pdf');     
    }
    public function cetak($id_jadwal_konsultasi,$id_pasien)
    {
        if(!$this->session->userdata('is_login')){
            redirect(base_url('Login'));
        }
        $valid = $this->db->query('SELECT id_user_kategori FROM master_user WHERE id = '.$this->session->userdata('id_user'))->row();
        if($valid->id_user_kategori != 2){
            if($valid->id_user_kategori == 0){
                redirect(base_url('pasien/Pasien'));
            }
            else{
                redirect(base_url('admin/Admin'));
            }
        }

    	if($this->session->userdata('is_login')){
            $data['view'] = 'pdf/resep_dokter';
            $data['title'] = 'Resep Dokter';
            $data['head_resep'] =  $this->db->where('id','RD001')->get('kop_resep_dokter')->row();
            $data['rekam_medis'] = $this->db->query('SELECT bukti_pembayaran.selesai_konsultasi as tanggal_konsultasi, bukti_pembayaran_obat.order_status, md.nama as diagnosis, md.id as diagnosis_code, diagnosis_dokter.id_registrasi, diagnosis_dokter.created_at, assesment.keluhan, GROUP_CONCAT("<li>",master_obat.name, " ( ",resep_dokter.jumlah_obat, " ",master_obat.unit," ) " , " ( ",resep_dokter.keterangan," ) </li>" SEPARATOR "") as list_obat, p.name as nama_pasien, p.lahir_tanggal as tanggal_lahir_pasien, p.lahir_tempat as tempat_lahir_pasien, p.jenis_kelamin as jk_pasien,d.name as nama_dokter, nominal.poli, dp.no_medrec FROM (diagnosis_dokter, assesment) LEFT JOIN resep_dokter ON resep_dokter.id_jadwal_konsultasi = assesment.id_jadwal_konsultasi LEFT JOIN master_obat ON resep_dokter.id_obat = master_obat.id INNER JOIN master_user p ON assesment.id_pasien = p.id INNER JOIN master_user d ON assesment.id_dokter = d.id LEFT JOIN detail_dokter ddr ON d.id = ddr.id_dokter LEFT JOIN nominal ON ddr.id_poli = nominal.id LEFT JOIN detail_pasien dp ON p.id = dp.id_pasien LEFT JOIN master_diagnosa md ON md.id = diagnosis_dokter.diagnosis LEFT JOIN bukti_pembayaran_obat ON bukti_pembayaran_obat.id_jadwal_konsultasi = assesment.id_jadwal_konsultasi LEFT JOIN bukti_pembayaran ON bukti_pembayaran.id_registrasi = diagnosis_dokter.id_registrasi WHERE diagnosis_dokter.id_jadwal_konsultasi = ? AND assesment.id_jadwal_konsultasi = ? AND diagnosis_dokter.id_pasien = ? AND assesment.id_pasien = ?',[$id_jadwal_konsultasi,$id_jadwal_konsultasi,$id_pasien,$id_pasien])->row();
            $this->db->select('rd.id_jadwal_konsultasi,rd.id_pasien,rd.id_dokter,rd.jumlah_obat,mo.name,mo.unit,rd.keterangan');
        $this->db->from('resep_dokter as rd');
        $this->db->join('master_obat as mo', ' rd.id_obat = mo.id');
        $this->db->where('rd.id_jadwal_konsultasi', $id_jadwal_konsultasi);
        $this->db->where('rd.id_pasien', $id_pasien);
        $data['umur'] = date_diff(date_create($data['rekam_medis']->tanggal_lahir_pasien), date_create(date('Y-m-d')))->format('%y');
        $data['resep_obat']  = $this->db->get()->result();
            // $this->pdf->setPaper('A4', 'landscape');
            // $this->pdf->filename = date('Ymd')."_ResepObatTelecare.pdf";
            // $this->pdf->load_view('template_invoice', $data);
             $this->load->view('template_resep',$data);
        } else {
      		redirect('Login');
    	}
    }
}