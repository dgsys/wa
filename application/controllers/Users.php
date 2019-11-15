<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	var $tbl = 'users';
	var $tbl_id = 'user_cd';

	public function __construct()
    {
        parent::__construct();
       	$this->load->model('setting_model');	
    } 

	public function index()
	{
		 $logged_in = $this->session->userdata('user_nm');
        if(!$logged_in) {
            redirect('login');
        } else{
        	if($this->session->userdata('user_lv') !== '1'){
        		redirect('depan');
        	}else{
		$data=array(
			'title' => 'Seting User',
			'contents' => 'users',
			'unit_' => $this->app_model->get_unit(),
			'group_' => $this->app_model->get_group()
		);
		$this->load->view('kp/template',$data);
		};
		}
	}

	//Gelombang crud
	public function user_tabel()//ok
	{
		echo $this->setting_model->view_user();
	}

	public function ajax_edit_user($id)
	{
		$tbl = 'users';
		$id_tabel = 'user_cd';
		$data = $this->setting_model->get_by_id($tbl,$id_tabel,$id);
		echo json_encode($data);
	}

	public function ajax_add_user()
	{
			// $tanggala= $this->input->post('periode');
			// $periode = date('Y-m-d',strtotime($tanggala));

			$data = array(
			'full_nm'=>$this->input->post('full_nama'),
			'user_nm'=>$this->input->post('user_nama'),
			'user_pass'=>$this->input->post('user_password'),
			'user_lv'=>$this->input->post('user_level'),
			'user_unit'=>$this->input->post('user_unit'),
			'user_group'=>$this->input->post('user_group')
			);

			// $tanggal = date('d', strtotime($periode));
			// $bulan = date('m', strtotime($periode));
			// $tahun = date('Y', strtotime($periode));
			// $setoran = $this->input->post('setoran');
			// $putaran= $this->input->post('putaran');
			// $gelombang= $this->input->post('gelombang');			
			// for ($i=1; $i<= $putaran ; $i++) { 
			// $nextN3 = mktime(0, 0, 0, date($bulan-1)+ $i , date($tanggal) , date($tahun));
			// $jumlah= $i * $setoran;
			// $tgl = date("Y-m-d",$nextN3);
			// $data2  = array(
			// 	'tgl_putaran' => $tgl,
			// 	'putaran_ke' => $i,
			// 	'jumlah_seharusnya' =>$jumlah , 
			// 	);
			// $this->app_model->insertData('tbl_putaran',$data2);
			// }
			
		$insert = $this->setting_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_user()
	{
		$tanggala= $this->input->post('periode');
			$periode = date('Y-m-d',strtotime($tanggala));
			$data = array(
			'periode'=>$tanggala,
			'gelombang'=>$this->input->post('gelombang'),
			'setoran'=>$this->input->post('setoran'),
			'putaran'=>$this->input->post('putaran')
			);
		$this->setting_model->update_gelombang(array('id_gelombang' => $this->input->post('id_gelombang')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_user($id)
	{
		$this->setting_model->delete_by_id_gelombang($id);
		echo json_encode(array("status" => TRUE));
	}

	

	function group(){
		$this->setting_model->cari_group();
	}

}
