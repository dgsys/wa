<?php

use function GuzzleHttp\json_encode;

defined('BASEPATH') or exit('No direct script access allowed');

class Reservasi extends CI_Controller
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
				'title' => 'Halaman Reservasi Periksa lewat WA',
				'contents' => 'reservasi'
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

	public function apiantrianwatgl()
	{
		// $tgl = '2019-03-11';
		$tgl1 = $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tgl1));
		echo $this->Api_model->getapiantrianwatgl($tgl);
	}

	public function apijadwal($tanggal)
	{
		// $tgl = '2019-11-24';
		// $tgl1= $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tanggal));
		echo $this->Api_model->getapijadwal($tgl);
	}

	public function apipasien($no_rm)
	{
		// $rm = '00481923';
		// $tgl1= $this->input->post('tanggal');
		// $tgl = date('Y-m-d', strtotime($tgl1));
		// $no_rm= $this->input->post('no_rm');
		echo $this->Api_model->getapipasien($no_rm);
	}

	public function ajax_add_wa()
	{
		$pecah = $this->input->post('cg');
		$pisah = explode('/', $pecah);
		$medunit_cd = $pisah[0];
		$dr_cd = $pisah[1];
		$no_wa = $this->input->post('no_wa');
		$pasien_cd = $this->input->post('pasien_cd');
		$tgl1 = $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tgl1));
		$data = array(
			'pasien_cd' => $this->input->post('pasien_cd'),
			'dr_cd' => $dr_cd,
			'tgl_periksa' => $tgl,
			'medunit_cd' => $medunit_cd,
			'no_wa' => $this->input->post('no_wa')
		);
		echo $this->Api_model->saveapiwa($data);
		// echo json_encode(array("status" => TRUE));
		// echo json_encode(array("pasien_cd"=>$pasien_cd,"no_wa"=>$no_wa,"tgl_periksa"=>$tgl1,"medunit_cd"=>$medunit_cd));
	}

	public function antrian_wa_cetak($tgl) //ok
	{
		$tgl1 = date('Y-m-d', strtotime($tgl));
		$d['tgl']=$tgl;
		$d['wa'] = $this->Api_model->antrian_wa_cetak($tgl1);
		$this->load->view('wa_cetak', $d);
	}
}
