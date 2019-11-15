<?php
/**
 * 
 */
class Ppi_model extends CI_Model
{
	
	var $tb="ppi";

	function __construct()
	{
		parent::__construct();
	}

	function get_data($unit,$mt,$yr){
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM ppi where month(tanggal)=$mt and year(tanggal)=$yr and unit_cd=$unit")->num_rows();
		$row = array();
		$criteria = $this->db->query("SELECT * FROM ppi where month(tanggal)=$mt and year(tanggal)=$yr and unit_cd=$unit order by tanggal desc");
		
		foreach($criteria->result_array() as $data)
		{
			$row[] = array(
				'ppi_cd'=>$data['ppi_cd'],
				'tanggal'=>$data['tanggal'],
				'pasien_qty'=>$data['pasien_qty'],
				'lvl'=>$data['lvl'],
				'dc'=>$data['dc'],
				'ngt'=>$data['ngt'],
				'bedah'=>$data['bedah'],
				'irah_baring'=>$data['irah_baring'],
				'phlebitis'=>$data['phlebitis'],
				'isk'=>$data['isk'],
				'ilo'=>$data['ilo'],
				'pneumonia'=>$data['pneumonia'],
				'dekubitus'=>$data['dekubitus'],
				'sepsis'=>$data['sepsis'],
				'unit_cd'=>$data['unit_cd']
			);
		}
		
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}


	function get_data_ct($mt,$yr){
		$result = array();
		$result['total'] = $this->db->query("SELECT * FROM ppi_ct ct join unit u on ct.ppi_unit_cd=u.unit_cd where month(date)=$mt and year(date)=$yr")->num_rows();
		$row = array();
		$criteria = $this->db->query("SELECT * FROM ppi_ct ct join unit u on ct.ppi_unit_cd=u.unit_cd where month(date)=$mt and year(date)=$yr");
		$no=0;
		foreach($criteria->result_array() as $data)
		{
			$row[] = array(
				'no'=>$no+1,
				'id_ct'=>$data['id_ct'],
				'ppi_unit_cd'=>$data['ppi_unit_cd'],
				'rate'=>$data['rate'],
				'date'=>$data['date'],
				'unit_nm'=>$data['unit_nm']
			);
		}
		
		$result=array('aaData'=>$row);
		echo  json_encode($result);
	}


	function max_id() {
		$this->db->select_max('ppi_cd','id');
		return $this->db->get($this->tb);
	}

	function insert($dt) {
		return $this->db->insert($this->tb, $dt);
	}

	public function view($unit,$mt,$yr) 
	{
		$query = $this->db->query("SELECT * FROM ppi where month(tanggal)=$mt and year(tanggal)=$yr and unit_cd=$unit order by tanggal asc");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}


	function update($where, $data, $tabel)
	{
		$this->db->update($tabel, $data, $where);
		return $this->db->affected_rows();
	}

	// kepatuhan cuci tangan ----------------------------------------------------------------------------------------------------------------

	public function view_ct($mt,$yr) 
	{
		$query = $this->db->query("SELECT * FROM ppi_ct ct join unit u on ct.ppi_unit_cd=u.unit_cd where month(date)=$mt and year(date)=$yr order by unit_nm");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	function update_ct($where, $data)
	{
		$this->db->update($this->tb, $data, $where);
		return $this->db->affected_rows();
	}
	// ---------------------------------------------------------------------------------------------------------------------------------------

}