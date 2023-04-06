<?php

use function GuzzleHttp\json_encode;

defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		// $this->load->helper('terbilang');
		define('FPDF_FONTPATH', $this->config->item('fonts_path'));
		$this->load->model('Api_model');
		$logged_in = $this->session->userdata('logged_in');
		if (!$logged_in) {
			redirect('login');
		};
	}

	public function index()
	{
		$query = $this->db->query("select batas from tbl_batas limit 1");
		$row = $query->row();
		if (isset($row)) {
			$aa= $row->batas;
		};

		$logged_in = $this->session->userdata('logged_in');
		if (!$logged_in) {
			redirect('login');
		} else {
			$data = array(
				'batas' => $aa,
				'title' => 'Halaman Reservasi Periksa lewat WA',
				'contents' => 'pasienadd'
			);
			$this->load->view('template', $data);
		}
	}

    public function apipropinsi()
	{
		// $tgl = '2019-11-24';
		// $tgl1= $this->input->post('tanggal');
		// $tgl = date('Y-m-d', strtotime($tanggal));
		echo $this->Api_model->getapipropinsi();
    }
    public function apikabupaten($id)
	{
		$q = isset($_POST['q']) ? strval($_POST['q']) : '';
		echo $this->Api_model->getapikabupaten($id);
	}
	public function apikecamatan($id)
	{
		echo $this->Api_model->getapikecamatan($id);
	}
	public function apikelurahan($id)
	{
	echo $this->Api_model->getapikelurahan($id);
    }
	public function apiasuransi()
	{
		echo $this->Api_model->getapiasuransi();
	}
	public function apipendidikan()
	{
		echo $this->Api_model->getapipendidikan();
	}
	public function apipekerjaan()
	{
		echo $this->Api_model->getapipekerjaan();
	}
	public function apisuku()
	{
		echo $this->Api_model->getapisuku();
	}
	public function apiagama()
	{
		echo $this->Api_model->getapiagama();
	}
	public function apiidentitas()
	{
		echo $this->Api_model->getapiidentitas();
	}
	public function apigoldarah()
	{
		echo $this->Api_model->getapigoldarah();
	}
	public function apihubungan()
	{
		echo $this->Api_model->getapihubungan();
	}
	public function apikelas()
	{
		echo $this->Api_model->getapikelas();
	}
	



	public function apiantrianwa()
	{
		// $tgl = '2019-03-11';
		// $tgl1= $this->input->post('tanggal');
		$tgl = date('Y-m-d');
		echo $this->Api_model->getapiantrianwatgl($tgl);
	}

	public function apiantrianwatgl()
	{
		// $tgl = '2019-03-11';
		$tgl1 = $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tgl1));
		echo $this->Api_model->getapiantrianwatgl($tgl);
	}

	public function apijadwal($tanggal)
	{
		// $tgl = '2019-11-24';
		// $tgl1= $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tanggal));
		echo $this->Api_model->getapijadwal($tgl);
	}

	public function apipasien($nik)
	{
		// $rm = '00481923';
		// $tgl1= $this->input->post('tanggal');
		// $tgl = date('Y-m-d', strtotime($tgl1));
		// $no_rm= $this->input->post('no_rm');
		echo $this->Api_model->getapipasiennik($nik);
	}

	public function ajax_add_wa()
	{
		$pecah = $this->input->post('cg');
		$pisah = explode('/', $pecah);
		$medunit_cd = $pisah[0];
		$dr_cd = $pisah[1];
		$no_wa = $this->input->post('no_wa');
		$pasien_cd = $this->input->post('pasien_cd');
		$tgl1 = $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tgl1));
		$data = array(
			'pasien_cd' => $this->input->post('pasien_cd'),
			'dr_cd' => $dr_cd,
			'tgl_periksa' => $tgl,
			'medunit_cd' => $medunit_cd,
			'no_wa' => $this->input->post('no_wa')
		);
		echo $this->Api_model->saveapiwa($data);
		// echo json_encode(array("status" => TRUE));
		// echo json_encode(array("pasien_cd"=>$pasien_cd,"no_wa"=>$no_wa,"tgl_periksa"=>$tgl1,"medunit_cd"=>$medunit_cd));
	}

	public function update_wa()
	{
		$pecah = $this->input->post('cg');
		$pisah = explode('/', $pecah);
		$medunit_cd = $pisah[0];
		$dr_cd = $pisah[1];
		$no_wa = $this->input->post('no_wa');
		$trx_seqno = $this->input->post('trx_seqno');
		$status = $this->input->post('status');
		// if ($status == 'ubah') {
		$data = array(
			'trx_seqno' => $trx_seqno,
			'status' => $status,
			'dr_cd' => $dr_cd,
			'medunit_cd' => $medunit_cd,
			'no_wa' => $no_wa
		);
		// } else {
		// 	$data = array(
		// 		'trx_seqno' => $trx_seqno,
		// 		'status' => $status
		// 	);
		// }
		echo $this->Api_model->update_wa($data);
	}

	public function batal_wa()
	{
		$trx_seqno = $this->input->post('trx_seqno');
		$status = $this->input->post('status');
		$data = array(
			'trx_seqno' => $trx_seqno,
			'status' => $status
		);
		echo $this->Api_model->update_wa($data);
	}

	public function antrian_wa_cetak($tgl) //ok
	{
		$tgl1 = date('Y-m-d', strtotime($tgl));
		$d['tgl'] = $tgl;
		$d['wa'] = $this->Api_model->antrian_wa_cetak($tgl1);
		$this->load->view('wa_cetak', $d);
	}

	public function ajax_add_pasien()
	{
		// $pecah = $this->input->post('cg');
		// $pisah = explode('/', $pecah);
		// $medunit_cd = $pisah[0];
		// $dr_cd = $pisah[1];
		// $no_wa = $this->input->post('no_wa');
		// $pasien_cd = $this->input->post('pasien_cd');

		$tgl1 = $this->input->post('tanggal');
		$tgl = date('Y-m-d', strtotime($tgl1));
		$nikk = $this->input->post('nikk');
		$data = array(
			'pstrPasienNm' => $this->input->post('pasien_nm'),
            'pstrNoRM' => $this->input->post('no_rm'),
            'pstrPasienTp' => $this->input->post('tipepasien'),
            'pstrAddress' => $this->input->post('alamat'),
            'pstrProp' => $this->input->post('propinsi'),
            'pstrKab' => $this->input->post('kabupaten'),
            'pstrKec' => $this->input->post('kecamatan'),
            'pstrKel' => $this->input->post('kelurahan'),
            'pdtBirthDate' => $tgl,
            'pstrMobile' => $this->input->post('no_hp'),
            'pstrBloodTp' => $this->input->post('goldarah'),
            'pstrGenderTp' => $this->input->post('jenis_kelamin'),
            'pstrMaritalTp' => $this->input->post('status'),
            'pstrAgamaCd' => $this->input->post('agama'),
            'pstrPekerjaanCd' => $this->input->post('pekerjaan'),
            'pstrPendidikanCd' => $this->input->post('pendidikan'),
            'pstrRasCd' => $this->input->post('suku'),
            'pstrIdNo' => $nikk,
            'pstrAsuransiCd' => $this->input->post('asuransi'),
            'pstrAsuransiNo' => $this->input->post('no_asuransi'),
            'pstrAsrKelasCd' => $this->input->post('kelas'),
            'pstrAyahNm' => $this->input->post('ayah'),
            'pstrIbuNm' => $this->input->post('ibu'),
            'pstrPenanggungNm' => $this->input->post('namapj'),
            'pstrPenanggungTp' => $this->input->post('hubungan'),
            'pstrPenanggungAddress' => $this->input->post('alamatpj'),
            'pstrPenanggungPhone' => $this->input->post('telppj')
		);
		echo $this->Api_model->saveapipasien($data);
		// echo json_encode(array("status" => TRUE));
		// echo json_encode(array("pasien_cd"=>$pasien_cd,"no_wa"=>$no_wa,"tgl_periksa"=>$tgl1,"medunit_cd"=>$medunit_cd));
	}
	
}
