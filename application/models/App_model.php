<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	
	public function getAkibat() {
        $this->db->where('set_group', 'akibat');
        return $this->db->get('setting');
    }
    
    public function getPenyakit() {
        $this->db->where('set_group', 'penyakit');
        return $this->db->get('setting');
    }
	
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
	
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//QUERY table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}


	
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln2($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $bln;
		//return $hasil;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		//return $bln;
		return $hasil;
	}
	
	public function tgl_indo($tgl){
		$jam = substr($tgl,11,10);
		$tgl = substr($tgl,0,10);
		$tanggal = substr($tgl,8,2);
		$bulan = $this->app_model->getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;		 
	}

	public function tgl_indo_jam($tgl){
		$jam = substr($tgl,11,10);
		$tgl = substr($tgl,0,10);
		$tanggal = substr($tgl,8,2);
		$bulan = $this->app_model->getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun.'&nbsp;&nbsp;<p><b>'.$jam.'</b></p>';		 
	}
	
	public function tgl_indo_jam_api($tgl){
		$jam = substr($tgl,11,5);
		$tgl = substr($tgl,0,10);
		$tanggal = substr($tgl,8,2);
		// $bulan = $this->app_model->getBulan(substr($tgl,5,2));
		$bulan = substr($tgl,5,2);
		$tahun = substr($tgl,0,4);
		return $tanggal.'-'.$bulan.'-'.$tahun.'&nbsp;&nbsp;<b>'.$jam.'</b>';		 
	}

	public function hari_api(){
		$tanggal = '2015-06-03';
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		echo "Tanggal {$tanggal} adalah hari : " . $dayList[$day];
	}

	public function tgl_bulan($tgl){
		$jam = substr($tgl,11,10);
		$tgl = substr($tgl,0,10);
		$tanggal = substr($tgl,8,2);
		$bulan = $this->app_model->getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
			return "Januari";
			break;
			case 2:
			return "Februari";
			break;
			case 3:
			return "Maret";
			break;
			case 4:
			return "April";
			break;
			case 5:
			return "Mei";
			break;
			case 6:
			return "Juni";
			break;
			case 7:
			return "Juli";
			break;
			case 8:
			return "Agustus";
			break;
			case 9:
			return "September";
			break;
			case 10:
			return "Oktober";
			break;
			case 11:
			return "November";
			break;
			case 12:
			return "Desember";
			break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	

	public function terbilang($satuan){
		$huruf = array ("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh","sebelas"); 					
		if ($satuan < 12) return " ".$huruf[$satuan];
		elseif ($satuan < 20) return terbilang($satuan - 10)." belas ";
		elseif ($satuan < 100) return terbilang($satuan / 10)." puluh ".terbilang($satuan % 10);
		elseif ($satuan < 200) return "seratus".terbilang($satuan - 100);
		elseif ($satuan < 1000) return terbilang($satuan / 100)." ratus ".terbilang($satuan % 100);
		elseif ($satuan < 2000) return "seribu".terbilang($satuan - 1000);
		elseif ($satuan < 1000000) return terbilang($satuan / 1000)." ribu ".terbilang($satuan % 1000);
		elseif ($satuan < 1000000000) return terbilang($satuan / 1000000)." juta ".terbilang($satuan % 1000000);
		elseif ($satuan >= 1000000000) echo "Angka yang Anda masukkan terlalu besar"; 
	}
	
	
	public  function datediff($tgl1, $tgl2){
		$tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1);
		$tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2);
		$diff_secs = abs($tgl1 - $tgl2);
		$base_year = min(date("Y", $tgl1), date("Y", $tgl2));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array( "years" => date("Y", $diff) - $base_year,
			"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
			"months" => date("n", $diff) - 1,
			"days_total" => floor($diff_secs / (3600 * 24)),
			"days" => date("j", $diff) - 1,
			"hours_total" => floor($diff_secs / 3600),
			"hours" => date("G", $diff),
			"minutes_total" => floor($diff_secs / 60),
			"minutes" => (int) date("i", $diff),
			"seconds_total" => $diff_secs,
			"seconds" => (int) date("s", $diff)  );
	}
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$u = $usr;
		$p = md5($psw);
		$query="SELECT * from users  where user_nm='".$u."' and user_pass='".$p."'";
		// $q_cek_login = $this->db->get_where('users', array('user_nm' => $u, 'user_pass' => $p));
		$q_cek_login = $this->db->query($query);
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				foreach($q_cek_login->result() as $qad)
				{
					$sess_data['logged_in'] = 'mlebu_coy';
					$sess_data['isLog'] = TRUE;
					$sess_data['user_cd'] = $qad->user_cd;
					$sess_data['user_nm'] = $qad->user_nm;
					$sess_data['unit_cd'] = $qad->unit_cd;
					$sess_data['user_lv'] = $qad->user_lv;
					$sess_data['unit_nm'] = $qad->unit_nm;
                	$sess_data['full_nm'] = $qad->full_nm;
					$sess_data['user_group'] = $qad->user_group;
					$this->session->set_userdata($sess_data);
				}
				header('location:'.base_url('depan'));
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
				Username atau Password yang anda masukkan salah.</div>');
			header('location:'.base_url().'index.php/login');
		}
	}

	function logged_id()
	{
		return $this->session->userdata('id_user');
	}
	
	public  function rp($angka){
		$angka = number_format($angka);	
		$angka = str_replace(',', '.', $angka);
		$angka ="Rp"."$angka".",00";	
		return $angka;
	}

	public  function rp_ind	($angka){
		$angka = number_format($angka,2,',','.');	
		$angka ="Rp ".$angka;	
		return $angka;
	}
	
	function get_unit(){
	$level = $this->session->userdata('user_lv');
	$unit_cd = $this->session->userdata('unit_cd');
	if($unit_cd==''){
		$hasil=$this->db->query("SELECT * FROM unit ");
	}else{
        $hasil=$this->db->query("SELECT * FROM unit where unit_cd='$unit_cd' ");
        }
        return $hasil;
    }

	function get_group(){
        $hasil=$this->db->query("SELECT * FROM tbl_group ");
        return $hasil;
    }
	//IKP
	public function ikp_tabel()
    {	
    	$result = array();
    	$result['total'] = $this->db->query("SELECT * FROM insiden ")->num_rows();
    	$row = array(); 
    	$criteria = $this->db->query("SELECT * from insiden ");
    	$no=1;
    	foreach($criteria->result_array() as $data)
    	{   
    		$row[] = array(
    			'no'=>$no++,
    			'insiden_cd'=>$data['insiden_cd'],
    			'p_nm'=>$data['p_nm'],
    			'p_rm'=>$data['p_rm'],
    			'p_age'=>$data['p_age'],
    			'p_gender'=>$data['p_gender'],
    			'p_date_in'=>$data['p_date_in'],
    			'i_date'=>$data['i_date'],
    			'grading'=>$data['grading']
    		);                                      
    	}
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }
	
 public function ikp_tabel_periode($tanggal1,$tanggal2,$unit)
    {	
    	$result = array();
    	$result['total'] = $this->db->query("SELECT * FROM insiden  ")->num_rows();
    	$row = array(); 
    	$nama_unit = $unit;
    	if ($nama_unit == ''){
    		$criteria = $this->db->query("SELECT * from insiden where (date(i_date) BETWEEN  '$tanggal1' and '$tanggal2') and status='3'  order by insiden_cd ");
    	}else{
    		$criteria = $this->db->query("SELECT * from insiden where (date(i_date) BETWEEN  '$tanggal1' and '$tanggal2') and unit_cd='$nama_unit' and status='3' order by insiden_cd ");
    	}
    	$no=1;
    	$total = 0;       
    	foreach($criteria->result_array() as $data)
    	{   
    		if($data['grading'] == 'MERAH'){
    			$warna = '<span class="label label-danger"> MERAH </span>';
    		}else if($data['grading'] == 'KUNING'){
    			$warna =  '<span class="label label-warning"> KUNING </span>';
    		}else if($data['grading'] == 'HIJAU'){
    			$warna =  '<span class="label label-success"> HIJAU </span>';
    		}else{
    			$warna =  '<span class="label label-primary"> BIRU </span>';
    		};
    		$row[] = array(
    			'no'=>$no++,
    			'insiden_cd'=>$data['insiden_cd'],
    			'p_nm'=>$data['p_nm'],
    			'p_rm'=>$data['p_rm'],
    			'p_age'=>$data['p_age'],
    			'p_gender'=>$data['p_gender'],
    			'p_asuransi'=>$data['p_asuransi'],
    			'p_date_in'=>$data['p_date_in'],
    			'i_date'=>$this->tgl_indo_jam($data['i_date']),
    			'i_title'=>$data['i_title'],
    			'i_kronologi'=>$data['i_kronologi'],
    			'i_tp'=>$data['i_tp'],
    			'i_pelapor'=>$data['i_pelapor'],
    			'i_victim'=>$data['i_victim'],
    			'i_terkait'=>$data['i_terkait'],
    			'i_lokasi'=>$data['i_lokasi'],
    			'i_penyakit'=>$data['i_penyakit'],
    			'i_unit_terkait'=>$data['i_unit_terkait'],
    			'i_dampak'=>$data['i_dampak'],
    			'i_hasil'=>$data['i_hasil'],
    			'i_paramedis'=>$data['i_paramedis'],
    			'i_duplicate'=>$data['i_duplicate'],
    			'i_solution'=>$data['i_solution'],
    			'pelapor_nm'=>$data['pelapor_nm'],
    			'grading'=>$data['grading'],
    			'unit_cd'=>$data['unit_cd'],
    			'status'=>$data['status'],
    			'warna' => $warna
    		);                                      
    	}
        //$result=array_merge($result,array('rows'=>$row));
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function grafik_ikp($tanggal1,$tanggal2,$unit)//ok
	{			
		$result = array();
		$row = array();	
		$nama_unit = $unit;
		if ($nama_unit == ''){
			$criteria = $this->db->query("
				SELECT
				Year(i_date) AS tahun,
				MONTH(i_date) AS bulan,
				COUNT(IF(i_tp = 'KTD', 1, NULL)) 'KTD',
				COUNT(IF(i_tp = 'KNC', 1, NULL)) 'KNC',
				COUNT(IF(i_tp = 'KTC', 1, NULL)) 'KTC',
				COUNT(IF(i_tp = 'KPC', 1, NULL)) 'KPC',
				COUNT(IF(i_tp = 'Sentinel', 1, NULL)) 'Sentinel'
				FROM
				insiden 
				WHERE
				(i_date BETWEEN '$tanggal1'	AND '$tanggal2') and status='3'
				GROUP BY
				Year(i_date),MONTH(i_date)
				HAVING bulan 
				order by tahun,bulan asc
				");
		}else{
			$criteria = $this->db->query("
				SELECT
				Year(i_date) AS tahun,
				MONTH (i_date) AS bulan,
				COUNT(IF(i_tp = 'KTD', 1, NULL)) 'KTD',
				COUNT(IF(i_tp = 'KNC', 1, NULL)) 'KNC',
				COUNT(IF(i_tp = 'KTC', 1, NULL)) 'KTC',
				COUNT(IF(i_tp = 'KPC', 1, NULL)) 'KPC',
				COUNT(IF(i_tp = 'Sentinel', 1, NULL)) 'Sentinel'
				FROM
				insiden 
				WHERE
				(i_date BETWEEN '$tanggal1'	AND '$tanggal2') and unit_cd='$nama_unit' and status='3'
				GROUP BY
				Year(i_date) ,MONTH(i_date)
				HAVING bulan 
				order by tahun,bulan asc
				");
		}
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'KTD'=>$data['KTD'],
				'KNC'=>$data['KNC'],
				'KTC'=>$data['KTC'],
				'KPC'=>$data['KPC'],
				'Sentinel'=>$data['Sentinel'],
				'bulan'=>$this->getBulan($data['bulan'])
			);												
		}
		echo  json_encode($row);
	}

	public function grafik_ikp_gradding($tanggal1,$tanggal2,$unit)//ok
	{			
		$result = array();
		$row = array();	
		$nama_unit = $unit;
		if ($nama_unit == ''){
			$criteria = $this->db->query("
				SELECT
				YEAR (i_date) AS tahun,
				MONTH (i_date) AS bulan,
				COUNT(IF(grading = 'MERAH', 1, NULL)) 'MERAH',
				COUNT(IF (grading = 'KUNING', 1, NULL)) 'KUNING',
				COUNT(IF(grading = 'HIJAU', 1, NULL)) 'HIJAU',
				COUNT(IF(grading = 'BIRU', 1, NULL)) 'BIRU'
				FROM
				insiden
				WHERE
				(i_date BETWEEN '$tanggal1'	AND '$tanggal2')  and status='3'
				GROUP BY
				YEAR (i_date),
				MONTH (i_date)
				HAVING
				bulan
				ORDER BY
				tahun,
				bulan ASC
				");
		}else{
			$criteria = $this->db->query("
				SELECT
				YEAR (i_date) AS tahun,
				MONTH (i_date) AS bulan,
				COUNT(IF(grading = 'MERAH', 1, NULL)) 'MERAH',
				COUNT(IF (grading = 'KUNING', 1, NULL)) 'KUNING',
				COUNT(IF(grading = 'HIJAU', 1, NULL)) 'HIJAU',
				COUNT(IF(grading = 'BIRU', 1, NULL)) 'BIRU'
				FROM
				insiden
				WHERE
				(i_date BETWEEN '$tanggal1'	AND '$tanggal2') and unit_cd='$nama_unit' and status='3'
				GROUP BY
				YEAR (i_date),
				MONTH (i_date)
				HAVING
				bulan
				ORDER BY
				tahun,
				bulan ASC
				");
		}
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'MERAH'=>$data['MERAH'],
				'KUNING'=>$data['KUNING'],
				'HIJAU'=>$data['HIJAU'],
				'BIRU'=>$data['BIRU'],
				'bulan'=>$this->getBulan($data['bulan'])
			);												
		}
		echo  json_encode($row);
	}

 public function grafik_ikp_insiden($tanggal1,$tanggal2,$unit)//ok
	{			
		$result = array();
		$row = array();	
		$nama_unit = $unit;
		if ($nama_unit == ''){
			$criteria = $this->db->query("
				SELECT
				YEAR (i_date) AS tahun,
				MONTH (i_date) AS bulan,
				i_title,
				count(i_title) AS jumlah
				FROM
				insiden
				WHERE
				(i_date BETWEEN '$tanggal1'	AND '$tanggal2')  and status='3'
				AND STATUS = '3'
				GROUP BY
				i_title,
				YEAR (i_date),
				MONTH (i_date)
				HAVING
				bulan
				ORDER BY
				tahun,
				bulan,
				i_title ASC
				");
		}else{
			$criteria = $this->db->query("
				SELECT
				YEAR (i_date) AS tahun,
				MONTH (i_date) AS bulan,
				i_title,
				count(i_title) AS jumlah
				FROM
				insiden
				WHERE
				(i_date BETWEEN '$tanggal1'	AND '$tanggal2') and unit_cd='$nama_unit' and status='3'
				AND STATUS = '3'
				GROUP BY
				i_title,
				YEAR (i_date),
				MONTH (i_date)
				HAVING
				bulan
				ORDER BY
				tahun,
				bulan,
				i_title ASC
				");
		}
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'i_title'=>$data['i_title'],
				'jumlah'=>$data['jumlah'],
				'bulan'=>$this->getBulan($data['bulan'])
			);												
		}
		echo  json_encode($row);
	}
	
	//PPI
	public function ppi_tabel_periode($tanggal1,$tanggal2,$unit)
    {	
    	$result = array();
       // $result['total'] = $this->db->query("SELECT * FROM ppi  ")->num_rows();
    	$row = array(); 
    	$nama_unit = $unit;
    	$no=1;
    	if ($nama_unit == ''){
    		$criteria = $this->db->query(" SELECT
    			tanggal,
    			sum(pasien_qty) as pasien_qty,
    			sum(lvl) as lvl,
    			sum(dc) as dc,
    			sum(ngt) as ngt,
    			sum(bedah) as bedah,
    			sum(irah_baring) as irah_baring,
    			sum(phlebitis) as phlebitis,
    			sum(isk) as isk,
    			sum(ilo) as ilo,
    			sum(pneumonia) as pneumonia,
    			sum(dekubitus) as dekubitus,
    			sum(sepsis) as sepsis
    			from
    			ppi
    			where (tanggal BETWEEN  '$tanggal1' and '$tanggal2')   GROUP by	tanggal
    			having tanggal
    			order by	tanggal asc");
    		$result['total'] = $this->db->query("SELECT
    			*
    			from
    			ppi
    			where (tanggal BETWEEN  '$tanggal1' and '$tanggal2')   
    			order by	tanggal asc ")->num_rows();
    		foreach($criteria->result_array() as $data)
    		{   
    			$row[] = array(
    				'no'=>$no++,
    				'tanggal'=>$this->tgl_indo($data['tanggal']),
    				'pasien_qty'=>$data['pasien_qty'],
    				'ivl'=>$data['lvl'],
    				'dc'=>$data['dc'],
    				'ngt'=>$data['ngt'],
    				'bedah'=>$data['bedah'],
    				'tirah_baring'=>$data['irah_baring'],
    				'phlebitis'=>$data['phlebitis'],
    				'isk'=>$data['isk'],
    				'ilo'=>$data['ilo'],
    				'pneumonia'=>$data['pneumonia'],
    				'dekubitus'=>$data['dekubitus'],
    				'sepsis'=>$data['sepsis']
    			);                                      
    		}
    	}else{
    		$criteria = $this->db->query("SELECT * from ppi where (tanggal BETWEEN  '$tanggal1' and '$tanggal2') and unit_cd='$nama_unit' order by ppi_cd asc ");
    		$result['total'] = $this->db->query("SELECT * from ppi where (tanggal BETWEEN  '$tanggal1' and '$tanggal2') and unit_cd='$nama_unit' ")->num_rows();
    		foreach($criteria->result_array() as $data)
    		{   
    			$row[] = array(
    				'no'=>$no++,
    				'ppi_cd'=>$data['ppi_cd'],
    				'tanggal'=>$this->tgl_indo($data['tanggal']),
    				'pasien_qty'=>$data['pasien_qty'],
    				'ivl'=>$data['lvl'],
    				'dc'=>$data['dc'],
    				'ngt'=>$data['ngt'],
    				'bedah'=>$data['bedah'],
    				'tirah_baring'=>$data['irah_baring'],
    				'phlebitis'=>$data['phlebitis'],
    				'isk'=>$data['isk'],
    				'ilo'=>$data['ilo'],
    				'pneumonia'=>$data['pneumonia'],
    				'dekubitus'=>$data['dekubitus'],
    				'sepsis'=>$data['sepsis'],
    				'unit_cd'=>$data['unit_cd']
    			);                                      
    		}
    	}
    	$no=1;
    	$total = 0;
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function grafik_ppi($tanggal1,$tanggal2,$unit)//ok
	{			
		$result = array();
		$row = array();	
		$nama_unit = $unit;
       if ($nama_unit == ''){
		$criteria = $this->db->query("
				SELECT
                	YEAR(tanggal) as tahun,
					MONTH(tanggal) as bulan,
					sum(lvl) as ivl,
					sum(dc) as dc,
					sum(ngt) as ngt,
					sum(bedah) as bedah,
					sum(irah_baring) as tirah_baring,
					sum(phlebitis) as phlebitis,
					sum(isk) as isk,
					sum(ilo) as ilo,
					sum(pneumonia) as pneumonia,
					sum(dekubitus) as dekubitus,
					sum(sepsis) as sepsis,
					ROUND((sum(phlebitis)/ sum(lvl))* 10, 2) as rate_phlebitis,
					ROUND((sum(isk)/ sum(dc))* 10, 2) as rate_isk,
					ROUND((sum(ilo)/ sum(bedah))* 1, 2) as rate_ilo,
					ROUND((sum(pneumonia)/ sum(ngt))* 10, 2) as rate_pneumonia,
					ROUND((sum(dekubitus)/ sum(irah_baring))* 1, 2) as rate_dekubitus
				FROM
					ppi
				WHERE
						(tanggal BETWEEN '$tanggal1' AND '$tanggal2') 
					GROUP BY
                    	YEAR(tanggal),
						MONTH (tanggal)
                        having bulan
						order by tahun,bulan asc
			");
		}else{
			$criteria = $this->db->query("
				SELECT
                	YEAR(tanggal) as tahun,
					MONTH(tanggal) as bulan,
					sum(lvl) as ivl,
					sum(dc) as dc,
					sum(ngt) as ngt,
					sum(bedah) as bedah,
					sum(irah_baring) as tirah_baring,
					sum(phlebitis) as phlebitis,
					sum(isk) as isk,
					sum(ilo) as ilo,
					sum(pneumonia) as pneumonia,
					sum(dekubitus) as dekubitus,
					sum(sepsis) as sepsis,
					ROUND((sum(phlebitis)/ sum(lvl))* 10, 2) as rate_phlebitis,
					ROUND((sum(isk)/ sum(dc))* 10, 2) as rate_isk,
					ROUND((sum(ilo)/ sum(bedah))* 1, 2) as rate_ilo,
					ROUND((sum(pneumonia)/ sum(ngt))* 10, 2) as rate_pneumonia,
					ROUND((sum(dekubitus)/ sum(irah_baring))* 1, 2) as rate_dekubitus
				FROM
					ppi
					WHERE
						(tanggal BETWEEN '$tanggal1'	AND '$tanggal2') and unit_cd='$nama_unit'
					GROUP BY
						YEAR(tanggal),
						MONTH (tanggal)
                        having bulan
						order by tahun,bulan asc
			");
		}
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
							$row[] = array(
							'rate_phlebitis'=>$data['rate_phlebitis'],
							'rate_isk'=>$data['rate_isk'],
							'rate_ilo'=>$data['rate_ilo'],
							'rate_pneumonia'=>$data['rate_pneumonia'],
							'rate_dekubitus'=>$data['rate_dekubitus'],
							'bulan'=>$this->getBulan($data['bulan'])
							);												
		}
		echo  json_encode($row);
	}

	//PPI CUCI TANGAN
	public function ct_tabel_periode($tanggal1,$tanggal2,$unit)
    {	
    	$result = array();
    	$row = array(); 
    	$nama_unit = $unit;
    	if ($nama_unit == ''){
    		$criteria = $this->db->query(" SELECT
    			MONTH(a.date) as bulan,
    			Year(a.date) as tahun,
    			b.unit_nm,
    			b.unit_cd,
    			a.rate
    			from
    			ppi_ct a
    			join unit b on
    			a.ppi_unit_cd = b.unit_cd
    			where (date BETWEEN  '$tanggal1' and '$tanggal2')   
    			ORDER by bulan,b.unit_nm
    			");
    		$result['total'] = $this->db->query("SELECT
    			MONTH(a.date) as bulan,
    			Year(a.date) as tahun,
    			b.unit_nm,
    			b.unit_cd,
    			a.rate
    			from
    			ppi_ct a
    			join unit b on
    			a.ppi_unit_cd = b.unit_cd
    			where (date BETWEEN  '$tanggal1' and '$tanggal2')   
    			ORDER by bulan,b.unit_nm
    			")->num_rows();
    	}else{
    		$criteria = $this->db->query("
    			SELECT
    			MONTH(a.date) as bulan,
    			Year(a.date) as tahun,
    			b.unit_nm,
    			b.unit_cd,
    			a.rate
    			from
    			ppi_ct a
    			join unit b on
    			a.ppi_unit_cd = b.unit_cd
    			where (date BETWEEN  '$tanggal1' and '$tanggal2')  and unit_cd='$nama_unit' 
    			");
    		$result['total'] = $this->db->query("SELECT
    			MONTH(a.date) as bulan,
    			Year(a.date) as tahun,
    			b.unit_nm,
    			b.unit_cd,
    			a.rate
    			from
    			ppi_ct a
    			join unit b on
    			a.ppi_unit_cd = b.unit_cd
    			where (date BETWEEN  '$tanggal1' and '$tanggal2')  and unit_cd='$nama_unit'  ")->num_rows();
    	}
    	$no=1;
    	$total = 0;       
    	foreach($criteria->result_array() as $data)
    	{   
    		$row[] = array(
    			'no'=>$no++,
    			'bulan'=>$this->getBulan($data['bulan']).' '.$data['tahun'],
    			'unit_nm'=>$data['unit_nm'],
    			'rate'=>$data['rate'].' %'
    		);                                      
    	}
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function grafik_ct($tanggal1,$tanggal2,$unit)//ok
	{			
		$result = array();
		$row = array();	
		$nama_unit = $unit;
		if ($nama_unit == ''){
			$criteria = $this->db->query("
				SELECT
				MONTH(a.date) as bulan,
				b.unit_nm,
				a.rate
				from
				ppi_ct a
				join unit b on
				a.ppi_unit_cd = b.unit_cd
				where (a.date BETWEEN  '$tanggal1' and '$tanggal2')   
				ORDER by bulan,b.unit_nm
				");
		}else{
			$criteria = $this->db->query("
				SELECT
				MONTH(a.date) as bulan,
				b.unit_nm,
				a.rate
				from
				ppi_ct a
				join unit b on
				a.ppi_unit_cd = b.unit_cd
				where (date BETWEEN  '$tanggal1' and '$tanggal2')  and unit_cd='$nama_unit'
				");
		}
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'unit_nm'=>$data['unit_nm'],
				'rate'=>$data['rate'],
				'bulan'=>$this->getBulan($data['bulan'])
			);												
		}
		echo  json_encode($row);
	}

	// K3
	 public function k3_tabel_periode($tanggal1,$tanggal2,$unit)
    {	
    	$result = array();
    	$result['total'] = $this->db->query("SELECT * FROM k3_incident  ")->num_rows();
    	$row = array(); 
    	$nama_unit = $unit;
    	if ($nama_unit == ''){
    		$criteria = $this->db->query("SELECT * from k3_incident where (date(accident_date) BETWEEN  '$tanggal1' and '$tanggal2')   order by incident_cd ");
    	}else{
    		$criteria = $this->db->query("SELECT * from k3_incident where (date(accident_date) BETWEEN  '$tanggal1' and '$tanggal2') and unit_cd='$nama_unit'  order by incident_cd ");
    	}
    	$no=1;
    	$total = 0;       
    	foreach($criteria->result_array() as $data)
    	{   
    		if($data['category'] == 'accident'){
    			$warna = '<span class="label label-danger"> Accident </span>';
    		}else if($data['category'] == 'incident'){
    			$warna =  '<span class="label label-warning"> Incident </span>';
    		}else{
    			$warna =  '<span class="label label-primary"> Nearmiss </span>';
    		};
    		$row[] = array(
    			'no'=>$no++,
    			'incident_cd'=>$data['incident_cd'],
    			'accident_date'=>$this->tgl_indo_jam($data['accident_date']),
    			'activity_date'=>$this->tgl_indo_jam($data['activity_date']),
    			'name'=>$data['name'],
    			'status'=>$data['status'],
    			'type'=>$data['type'],
    			'category'=>$data['category'],
    			'cause'=>$data['cause'],
    			'action'=>$data['action'],
    			'summary'=>$data['summary'],
    			'unit_cd'=>$data['unit_cd'],
    			'warna_category' => $warna
    		);                                      
    	}
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function grafik_k3_kategory($tanggal1,$tanggal2,$unit)//ok
	{			
		$result = array();
		$row = array();	
		$nama_unit = $unit;
		if ($nama_unit == ''){
			$criteria = $this->db->query("
				SELECT
				Year(accident_date) AS tahun,
				MONTH(accident_date) AS bulan,
				COUNT(IF(category = 'accident', 1, NULL)) 'Accident',
				COUNT(IF(category = 'insident', 1, NULL)) 'Insident',
				COUNT(IF(category = 'nearmiss', 1, NULL)) 'Nearmiss'
				FROM
				k3_incident
				WHERE
				(accident_date BETWEEN '$tanggal1' AND '$tanggal2') 
				GROUP BY
				Year(accident_date),
				MONTH(accident_date)
				HAVING
				bulan
				order by
				tahun,
				bulan asc
				");
		}else{
			$criteria = $this->db->query("
				SELECT
				Year(accident_date) AS tahun,
				MONTH(accident_date) AS bulan,
				COUNT(IF(category = 'accident', 1, NULL)) 'Accident',
				COUNT(IF(category = 'insident', 1, NULL)) 'Insident',
				COUNT(IF(category = 'nearmiss', 1, NULL)) 'Nearmiss'
				FROM
				k3_incident
				WHERE
				(accident_date BETWEEN '$tanggal1' AND '$tanggal2') and unit_cd='$nama_unit'
				GROUP BY
				Year(accident_date),
				MONTH(accident_date)
				HAVING
				bulan
				order by
				tahun,
				bulan asc
				");
		}
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'Accident'=>$data['Accident'],
				'Insident'=>$data['Insident'],
				'Nearmiss'=>$data['Nearmiss'],
				'bulan'=>$this->getBulan($data['bulan'])
			);												
		}
		echo  json_encode($row);
	}

	
 public function grafik_k3_type($tanggal1,$tanggal2,$unit)//ok
	{			
		$result = array();
		$row = array();	
		$nama_unit = $unit;
		if ($nama_unit == ''){
			$criteria = $this->db->query("
				SELECT
				YEAR (accident_date) AS tahun,
				MONTH (accident_date) AS bulan,
				type,
				count(type) AS jumlah
				FROM
				k3_incident
				WHERE
				(accident_date BETWEEN '$tanggal1'	AND '$tanggal2') 
				GROUP BY
				type,
				YEAR (accident_date),
				MONTH (accident_date)
				HAVING
				bulan
				ORDER BY
				tahun,
				bulan,
				type ASC
				");
		}else{
			$criteria = $this->db->query("
				SELECT
				YEAR (accident_date) AS tahun,
				MONTH (accident_date) AS bulan,
				type,
				count(type) AS jumlah
				FROM
				k3_incident
				WHERE
				(accident_date BETWEEN '$tanggal1'	AND '$tanggal2') and unit_cd='$nama_unit' 
				GROUP BY
				type,
				YEAR (accident_date),
				MONTH (accident_date)
				HAVING
				bulan
				ORDER BY
				tahun,
				bulan,
				type ASC
				");
		}
		$no=1;
		foreach($criteria->result_array() as $data)
		{	
			$row[] = array(
				'tipe'=>$data['type'],
				'jumlah'=>$data['jumlah'],
				'bulan'=>$this->getBulan($data['bulan'])
			);												
		}
		echo  json_encode($row);
	}
	

}

/* End of file app_model.php */
/* Location: ./application/models/app_model.php */

