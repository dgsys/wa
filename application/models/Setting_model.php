<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting_model extends CI_Model {

	var $tbl_group = 'tbl_group';
	var $tbl_unit = 'unit';
	var $tbl_users = 'users';	
	var $tbl_setting = 'setting';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Users
	public function get_by_id($tbl,$id_tabel,$id)
	{
		$this->db->from($tbl);
		$this->db->where($id_tabel,$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	
	public function save($tbl,$data)
	{
		$this->db->insert($tbl, $data);
		return $this->db->insert_id();
	}
	
	
	public function update($tbl,$where, $data)
	{
		$this->db->update($tbl, $data, $where);
		return $this->db->affected_rows();
	}

	
	public function delete_by_id($tbl,$id_tabel,$id)
	{
		$this->db->where($id_tabel, $id);
		$this->db->delete($tbl);
	}
	

			//VIEW ADMIN
	public function view_user()
	{	
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM users ")->num_rows();
		$row = array();	
		$criteria = $this->db->query("
			SELECT
			a.*, b.unit_nm,
			c.nama_group
			FROM
			users a
			LEFT JOIN unit b ON a.unit_cd = b.unit_cd
			LEFT JOIN tbl_group c ON a.user_group = c.id_group
			ORDER BY
			a.user_cd
		 ");
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
			 	if($data['user_lv'] == '1'){
			 		$user_lv = 'Super Admin';
			 	}elseif ($data['user_lv'] == '2') {
			 		$user_lv = 'Admin';
			 	}else{
			 		$user_lv = 'User';
			 	}
							$row[] = array(
							'no'=>$no++,
							'user_cd'=>$data['user_cd'],
							'full_nm'=>$data['full_nm'],
							'user_nm'=>$data['user_nm'],
							'user_lv'=>$user_lv,
							'unit_cd'=>$data['unit_cd'],
							'user_group'=>$data['user_group'],
							'unit_nm'=>$data['unit_nm'],
							'nama_group'=>$data['nama_group'],
							'aksi'=>'<div align="center">
						<a class="green" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$data['user_cd']."'".')">
							<i class="ace-icon fa fa-pencil bigger-130"></i>						
							</a>	
							<a class="red" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$data['user_cd']."'".')"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>							
  						</div>' 
							);										
		}
		//$result=array_merge($result,array('rows'=>$row));
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}

	public function cari_unit(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("select unit_cd,unit_nm from unit where  unit_nm like '%$q%'");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}

	public function cari_group(){
	$q = isset($_POST['q']) ? strval($_POST['q']) : ''; 
    $rs = $this->db->query("select id_group,nama_group from tbl_group where  nama_group like '%$q%'");
    $rows = array();
    foreach($rs->result_array() as $row){
        $rows[] = $row;
    }
    echo json_encode($rows);
	}


}
