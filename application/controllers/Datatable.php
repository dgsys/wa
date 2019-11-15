<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

	public function index()
	{
		$data=array(
			'title' => 'Report Insiden Keselamatan Pasien'
			// 'contents' => 'kp/report'
		);

		$this->load->view('data',$data);
	}
}
