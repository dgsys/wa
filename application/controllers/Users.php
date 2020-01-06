<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
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
		if (!$logged_in) {
			redirect('login');
		} else {
			if ($this->session->userdata('user_lv') !== '1') {
				redirect('depan');
			} else {
				$data = array(
					'title' => 'Seting User',
					'contents' => 'users'
				);
				$this->load->view('template', $data);
			};
		}
	}

	public function index_hari()
	{
		$logged_in = $this->session->userdata('user_nm');
		if (!$logged_in) {
			redirect('login');
		} else {
			if ($this->session->userdata('user_lv') !== '1') {
				redirect('depan');
			} else {
				$data = array(
					'title' => 'Seting Batas Hari',
					'contents' => 'hari'
				);
				$this->load->view('template', $data);
			};
		}
	}


	//User
	public function user_tabel() //ok
	{
		echo $this->setting_model->view_user();
	}

	public function ajax_edit_user($id)
	{
		$data = $this->setting_model->get_by_id('users', 'user_cd', $id);
		echo json_encode($data);
	}

	public function ajax_add_user()
	{
		$data = array(
			'full_nm' => $this->input->post('full_nama'),
			'user_nm' => $this->input->post('user_nama'),
			'user_pass' => md5($this->input->post('user_password')),
			'user_lv' => $this->input->post('user_level')
		);

		$insert = $this->setting_model->save('users', $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_user()
	{
		$id_user = $this->input->post('user_cd');
		if ($this->input->post('user_password') == '') {
			$data = array(
				'full_nm' => $this->input->post('full_nama'),
				'user_nm' => $this->input->post('user_nama'),
				'user_lv' => $this->input->post('user_level')
			);
		} else {
			$data = array(
				'full_nm' => $this->input->post('full_nama'),
				'user_nm' => $this->input->post('user_nama'),
				'user_pass' => md5($this->input->post('user_password')),
				'user_lv' => $this->input->post('user_level')
			);
		};
		$this->setting_model->update('users', array('user_cd' => $id_user), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete_user($id)
	{
		// $kode = $id;
		$this->setting_model->delete_by_id('users', 'user_cd', $id);
		echo json_encode(array("status" => TRUE));
	}

	//hari
	public function hari_tabel() //ok
	{
		echo $this->setting_model->view_hari();
	}

	public function ajax_edit_hari($id)
	{
		$data = $this->setting_model->get_by_id('tbl_batas', 'id_batas', $id);
		echo json_encode($data);
	}

	public function ajax_update_hari()
	{
		$id_batas = $this->input->post('id_batas');
		$data = array(
			'batas' => $this->input->post('batas')
		);
		$this->setting_model->update('tbl_batas', array('id_batas' => $id_batas), $data);
		echo json_encode(array("status" => TRUE));
	}

	//group
	function group()
	{
		$this->setting_model->cari_group();
	}

	public function reset_pass()
	{
		$logged_in = $this->session->userdata('user_nm');
		$data = array(
			'title' => 'Ganti Password',
			'contents' => 'reset_pass'
		);
		$this->load->view('template', $data);
	}

	public function proses_reset_pass()
	{
		$pass = md5($this->input->post('pass'));
		$id = $this->session->userdata('user_cd');
		$data = array(
			'user_pass' => $pass
		);
		$updateData = $this->setting_model->update('users', array('user_cd' => $id), $data);
		$sess_data['user_pass'] = $pass;
		$this->session->set_userdata($sess_data);
		echo json_encode(array("status" => true));
	}
}
