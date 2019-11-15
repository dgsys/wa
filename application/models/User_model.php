<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Master_model extends CI_Model {

	var $tbl_user = 'users';
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_by_id_user($id)
	{
		$this->db->from($this->tbl_user);
		$this->db->where('id_user',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	
	public function save_user($data)
	{
		$this->db->insert($this->tbl_user, $data);
		return $this->db->insert_id();
	}
	
		
	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_user, $data, $where);
		return $this->db->affected_rows();
	}

	
	public function delete_by_id_user($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_user);
	}
	

	public  function rp($angka){
		$angka = number_format($angka);	
		$angka = str_replace(',', '.', $angka);
		$angka ="Rp "."$angka".",00";	
		return $angka;
	}

	function backup(){
		$this->load->dbutil();
        $prefs = array(     
                'format'      => 'sql',             
              );
        $backup =& $this->dbutil->backup($prefs); 
        $db_name = 'backup-dios-on-'. date("Y-m-d-H-i-s") .'.sql';
        $save = base_url().$db_name;
        $this->load->helper('file');
        write_file($save, $backup); 
		$backup .= "i'); #END;";
		$this->load->helper('download');
        force_download($db_name, $backup); 
		if($backup) $_SESSION['success']=1;
		else $_SESSION['success']=-1;
	}		

function restore(){
		$sql   = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='dios-ci'";
		$query = $this->db->query($sql);
		$data=$query->result_array();
		
		foreach($data AS $dat){
			$tbl = $dat["TABLE_NAME"];
			mysql_query("DROP TABLE $tbl");
		}
		$data = "";
		$in = "";
		$outp = "";
		$filename = $_FILES['nama_file']['tmp_name'];
		if ($filename!=''){	
			$lines = file($filename);
		$query = "";
		foreach($lines as $sql_line){
		  if(trim($sql_line) != "" && strpos($sql_line, "--") === false){
			$query .= $sql_line;
			if (substr(rtrim($query), -1) == ';'){
			  echo $query;
			  $result = mysql_query($query)or die(mysql_error());
			  $query = "";
			}
		  }
		 }
			
		$outp= mysql_query($data);
			echo $data;
		}
		if($outp) $_SESSION['success']=1;
		else $_SESSION['success']=-1;
	}


	public function tampil_user()
    {	
       $result = array();
       $result['total'] = $this->db->query("SELECT * FROM users ")->num_rows();
       $row = array(); 
       $criteria = $this->db->query("SELECT * from users ");
       $no=1;
       foreach($criteria->result_array() as $data)
       {   
        $row[] = array(
            'no'=>$no++,
            'user_cd'=>$data['user_cd'],
            'user_nm'=>$data['user_nm'],
            // 'user_pass'=>$data['p_rm'],
            'user_lv'=>$data['user_lv'],
            // 'date_stamp'=>$data['p_gender'],
            'unit_cd'=>$data['unit_cd'],
            // 'i_date'=>$data['i_date'],
            'group_user'=>$data['group_user']
        );                                      
    }
        //$result=array_merge($result,array('rows'=>$row));
    $result=array('aaData'=>$row);
    echo  json_encode($result);
    }

		
}
