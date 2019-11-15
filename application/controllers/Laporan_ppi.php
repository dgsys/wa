<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_ppi extends CI_Controller {

	public function index()
	{
		 $logged_in = $this->session->userdata('user_nm');
        if(!$logged_in) {
            redirect('login');
        } else{
		$data=array(
			'title' => 'Report PPI',
			'contents' => 'ppi/report',
			'unit_' => $this->app_model->get_unit()
		);
		$this->load->view('template',$data);
		}
	}


	// public function ikp_tabel()//ok
	// {
	// 	echo $this->app_model->ikp_tabel();
	// }

	public function ppi_tabel_periode()//ok
	{
		$tanggala= $this->input->post('tanggal_awal');
		$tanggalb = $this->input->post('tanggal_akhir');
		$tanggal1 = date('Y-m-d', strtotime($tanggala));
		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
		$unit= $this->input->post('unit');
		// $unit = '';
		// $tanggal1 = '2019-01-01';
		// $tanggal2 = '2019-02-20';
		echo $this->app_model->ppi_tabel_periode($tanggal1,$tanggal2,$unit);
	}

	public function grafik_ppi()//ok
	{
		$tanggala= $this->input->post('tanggal_awal');
		$tanggalb = $this->input->post('tanggal_akhir');
		$tanggal1 = date('Y-m-d', strtotime($tanggala));
		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
		$unit= $this->input->post('unit');
		// $unit='';
		// $tanggal1 = '2019-01-01';
		// $tanggal2 = '2019-02-20';
		echo $this->app_model->grafik_ppi($tanggal1,$tanggal2,$unit);
	}

	

}
