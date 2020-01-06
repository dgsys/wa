<?php

use function GuzzleHttp\json_encode;

defined('BASEPATH') or exit('No direct script access allowed');

class Batas extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		// $this->load->helper('terbilang');
		define('FPDF_FONTPATH', $this->config->item('fonts_path'));
		$this->load->model('Api_model');
		$logged_in = $this->session->userdata('logged_in');
		if (!$logged_in) {
			redirect('login');
		};
	}

	public function index()
	{
		$logged_in = $this->session->userdata('user_nm');
		if (!$logged_in) {
			redirect('login');
		} else {
			$data = array(
				'title' => 'Halaman setting batasan Jumlah Pasien per Poli',
				'contents' => 'batas_poli'
			);
			$this->load->view('template', $data);
		}
	}


	public function apibataspoli()
	{
		echo $this->Api_model->getapipoli();
	}

	public function update_batas()
	{		
		$medunit_cd = $this->input->post('medunit_cd');
		$batas = $this->input->post('batas');
		$data = array(
			'medunit_cd' => $medunit_cd,
			'batas' => $batas
		);
		echo $this->Api_model->update_batas_poli($data);
	}

	
}
