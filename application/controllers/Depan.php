<?php

use function GuzzleHttp\json_encode;

defined('BASEPATH') or exit('No direct script access allowed');

class Depan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		// $this->load->helper('terbilang');

		define('FPDF_FONTPATH', $this->config->item('fonts_path'));

		// $this->load->model('kp/app_model');
		$this->load->model('Api_model');
	}

	public function index()
	{
		$logged_in = $this->session->userdata('user_nm');
		if (!$logged_in) {
			redirect('login');
		} else {
			$data = array(
				'title' => 'Halaman Beranda',
				'contents' => 'depan'
			);
			$this->load->view('template', $data);
		}
	}


	public function apiantrianwa()
	{
		// $tgl = '2019-03-11';
		// $tgl1= $this->input->post('tanggal');
		$tgl = date('Y-m-d');
		echo $this->Api_model->getapiantrianwatgl($tgl);
	}

	public function antrian_wa_cetak() //ok
	{
		$tgl = date('Y-m-d');
		$tgl1 = date('d-m-Y', strtotime($tgl));
		$d['tgl']=$tgl1;
		$d['wa'] = $this->Api_model->antrian_wa_cetak($tgl);
		$this->load->view('wa_cetak', $d);
	}

	
}
