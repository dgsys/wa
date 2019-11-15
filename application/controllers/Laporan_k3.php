<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_k3 extends CI_Controller {

	public function index()
	{
		 $logged_in = $this->session->userdata('user_nm');
        if(!$logged_in) {
            redirect('login');
        } else{
		$data=array(
			'title' => 'Report Insiden K3',
			'contents' => 'kp/report_k3',
			'unit_' => $this->app_model->get_unit()
		);
		$this->load->view('template',$data);
		}
	}


	public function ikp_tabel()//ok
	{
		echo $this->app_model->ikp_tabel();
	}

	public function k3_tabel_periode()//ok
	{
		$tanggala= $this->input->post('tanggal_awal');
		$tanggalb = $this->input->post('tanggal_akhir');
		$tanggal1 = date('Y-m-d', strtotime($tanggala));
		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
		$unit= $this->input->post('unit');
		// $unit='';
		// $tanggal1 = '2018-12-19';
		// $tanggal2 = '2019-03-19';
		echo $this->app_model->k3_tabel_periode($tanggal1,$tanggal2,$unit);
	}

	public function grafik_k3_kategory()//ok
	{
		$tanggala= $this->input->post('tanggal_awal');
		$tanggalb = $this->input->post('tanggal_akhir');
		$tanggal1 = date('Y-m-d', strtotime($tanggala));
		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
		$unit= $this->input->post('unit');
		// $unit='';
		// $tanggal1 = '2018-10-01';
		// $tanggal2 = '2019-04-11';
		echo $this->app_model->grafik_k3_kategory($tanggal1,$tanggal2,$unit);
	}
	
// public function grafik_k3_gradding()//ok
// 	{
// 		$tanggala= $this->input->post('tanggal_awal');
// 		$tanggalb = $this->input->post('tanggal_akhir');
// 		$tanggal1 = date('Y-m-d', strtotime($tanggala));
// 		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
// 		$unit= $this->input->post('unit');
// 		// $unit='';
// 		// $tanggal1 = '2018-10-01';
// 		// $tanggal2 = '2019-01-11';
// 		echo $this->app_model->grafik_ikp_gradding($tanggal1,$tanggal2,$unit);
// 	}

public function grafik_k3_type()//ok
	{
		$tanggala= $this->input->post('tanggal_awal');
		$tanggalb = $this->input->post('tanggal_akhir');
		$tanggal1 = date('Y-m-d', strtotime($tanggala));
		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
		$unit= $this->input->post('unit');
		// $unit='';
		// $tanggal1 = '2018-10-01';
		// $tanggal2 = '2019-06-11';
		echo $this->app_model->grafik_k3_type($tanggal1,$tanggal2,$unit);
	}
	

}
