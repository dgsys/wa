<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depan extends CI_Controller {

	function __construct() {
        parent::__construct();
        // $this->load->model('kp/app_model');
        $this->load->model('Api_model');
    }

	public function index()
	{
		 $logged_in = $this->session->userdata('user_nm');
        if(!$logged_in) {
            redirect('login');
        } else{
		$data=array(
			'title' => 'Halaman Beranda',
			'contents' => 'depan'
		);
		$this->load->view('template',$data);
		}
	}

	
	public function apiantrianwa(){
		// $tgl = '2019-03-11';
		// $tgl1= $this->input->post('tanggal');
		 $tgl = date('Y-m-d');
		echo $this->Api_model->getapiantrianwatgl($tgl);
	}

	public function apiantrianwatgl(){
		// $tgl = '2019-03-11';
		$tgl1= $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tgl1));
		echo $this->Api_model->getapiantrianwatgl($tgl);
	}

	public function apitindakan(){
		echo $this->Api_model->getapitindakan();
	}

	public function apilabhistory(){
		$no_rm = '00660998';
		echo $this->Api_model->getapilabhistory($no_rm);
	}

	public function apitindakanbykunjungan(){
		$medical_cd = '19159797';
		echo $this->Api_model->getapitindakanbykunjungan($medical_cd);
	}

	public function apiaddtindakan()
	{
			$data = array(
			'medical_cd'=>'19159797',
			'medicalunit_cd'=>'LAB19006',
			'medical_note'=>'Tes Input API CI ke 5'
			);			
		$insert = $this->Api_model->saveapitindakan($data);
		echo json_encode(array("status" => TRUE));
	}

	
}
