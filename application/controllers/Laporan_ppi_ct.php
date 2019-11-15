<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_ppi_ct extends CI_Controller {

	function index()
	{
		 $logged_in = $this->session->userdata('user_nm');
        if(!$logged_in) {
            redirect('login');
        } else{
		$data=array(
			'title' => 'Report Cucitangan',
			'contents' => 'ppi/laporan_cuci_tangan',
			'unit_' => $this->app_model->get_unit()
		);
		$this->load->view('template',$data);
		}
	}

	function ct_tabel_periode()//ok
	{
		$tanggala= $this->input->post('tanggal_awal');
		$tanggalb = $this->input->post('tanggal_akhir');
		$tanggal1 = date('Y-m-d', strtotime($tanggala));
		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
		$unit= $this->input->post('unit');
		// $unit = '';
		// $tanggal1 = '2019-01-01';
		// $tanggal2 = '2019-03-20';
		echo $this->app_model->ct_tabel_periode($tanggal1,$tanggal2,$unit);
	}

	function grafik_ct()//ok
	{
		$tanggala= $this->input->post('tanggal_awal');
		$tanggalb = $this->input->post('tanggal_akhir');
		$tanggal1 = date('Y-m-d', strtotime($tanggala));
		$tanggal2 = date('Y-m-d', strtotime($tanggalb));
		$unit= $this->input->post('unit');
		// $unit='2';
		// $tanggal1 = '2019-01-01';
		// $tanggal2 = '2019-03-20';
		echo $this->app_model->grafik_ct($tanggal1,$tanggal2,$unit);
	}

	

}
