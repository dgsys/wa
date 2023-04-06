<?php

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use function GuzzleHttp\json_encode;

class Api_model extends CI_model
{
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            // 'base_uri' => 'http://192.168.132.75:8080/restfull-api/',
            'base_uri' => 'http://localhost/restfull-api/',
            'auth' => ['lis', 'lis123']
        ]);
    }

    public function getapiantrianwa()
    {
        $response = $this->_client->request('GET', 'antrian/listantrian');
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        // $result1 = $response->getBody()->getContents();
        $no = 1;
        foreach ($result2 as $data) {
            $row[] = array(
                'no' => $no++,
                'pasien_cd' => $data['pasien_cd'],
                'no_rm' => $data['no_rm'],
                'pasien_nm' => $data['pasien_nm'],
                'alamat' => $data['alamat'],
                'medunit_nm' => $data['medunit_nm'],
                'dr_nm' => $data['dr_nm'],
                'tgl_daftar' => $this->app_model->tgl_indo_jam_api($data['tgl_daftar']),
                'no_antrian_tpp' => $data['no_antrian_tpp'],
                'no_wa' => $data['no_wa']
            );
        }
        $result = array('aaData' => $row);
        echo  json_encode($result);
    }

    public function getapiantrianwatgl($tgl)
    {
        $response = $this->_client->request('GET', 'antrian/listantrian', [
            'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        // $result1 = $response->getBody()->getContents();
        $stat = $result1['status'];
        $no = 1;
        $row = array();
        foreach ($result2 as $data) {
            $status_p = $data['proses_st'];
            $ubah = 'ubah';
            $batal = 'batal';
            if ($status_p == '0') {
                $aksi = '<div align="center">
                        <a href="#"" class="btn btn-success btn-xs" onclick="ubah(' . "'" . $data['trx_seqno'] . "'" . ',' . "'" .  $data['no_rm'] . "'" . '
                        ,' . "'" .  $data['pasien_cd'] . "'" . ',' . "'" .  $data['pasien_nm'] . "'" . ',' . "'" .  $data['alamat'] . "'" . '
                        ,' . "'" .  $data['dr_cd'] . "'" . ',' . "'" .  $data['medunit_cd'] . "'" . ',' . "'" .  $data['no_wa'] . "'" . ',' . "'" .  $ubah . "'" . ')">
                        <i class="fa fa-edit">&nbsp;</i>Ubah</a>		
                        <a href="#"" class="btn btn-danger btn-xs" onclick="batal(' . "'" . $data['trx_seqno'] . "'" . ',' . "'" . $batal . "'" . ')"><i class="fa fa-close">&nbsp;</i>Batal</a>		
                        </div>';
            } else {
                $aksi = '';
            }
            $row[] = array(
                'no' => $no++,
                'pasien_cd' => $data['pasien_cd'],
                'no_rm' => $data['no_rm'],
                'pasien_nm' => $data['pasien_nm'],
                'alamat' => $data['alamat'],
                'medunit_nm' => $data['medunit_nm'],
                'dr_nm' => $data['dr_nm'],
                // 'tgl_daftar'=>$data['tgl_daftar'],
                'tgl_daftar' => $this->app_model->tgl_indo_jam_api($data['tgl_daftar']),
                'no_antrian_tpp' => $data['no_antrian_tpp'],
                'no_wa' => $data['no_wa'],
                'aksi' => $aksi
            );
        }
        $result = array('aaData' => $row);
        echo  json_encode($result);
    }

    public function getapijadwal($tgl)
    {
        $response = $this->_client->request('GET', 'antrian/jadwal', [
            'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapipasien($rm)
    {
        $response = $this->_client->request('GET', 'antrian/pasiendata', [
            'query' => ['rm' => $rm]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }
   
    public function saveapiwa($data)
    {
        $response = $this->_client->request('POST', 'antrian/listantrian', [
            'form_params' => $data
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        // $result2 = $result1['data'];        
        // return $result1;
        $row = array();
        foreach ($result1 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function update_wa($data)
    {
        $response = $this->_client->request('PUT', 'antrian/listantrian', [
            'form_params' => $data
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        // $result2 = $result1['data'];        
        // return $result1;
        $row = array();
        foreach ($result1 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapipoli()
    {
        $response = $this->_client->request('GET', 'antrian/poliklinik');
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $no = 1;
        foreach ($result2 as $data) {
            $row[] = array(
                'no' => $no++,
                'medunit_cd' => $data['medunit_cd'],
                'medunit_nm' => $data['medunit_nm'],
                'batas_wa' => $data['batas_wa'],
                'aksi' => '<div align="center">
                        <a href="#"" class="btn btn-success btn-xs" onclick="ubah(' . "'" . $data['medunit_cd'] . "'" . ',' . "'" .  $data['medunit_nm'] . "'" . ',' . "'" .  $data['batas_wa'] . "'" . ')">
                        <i class="fa fa-edit">&nbsp;</i>Ubah</a>		
                        </div>'
            );
        }
        $result = array('aaData' => $row);
        echo  json_encode($result);
    }
    
    public function update_batas_poli($data)
    {
        $response = $this->_client->request('PUT', 'antrian/poliklinik', [
            'form_params' => $data
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $row = array();
        foreach ($result1 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }


    public function antrian_wa_cetak($tgl) //ok
    {
        $response = $this->_client->request('GET', 'antrian/listantrian', [
            'query' => ['tanggal' => $tgl]
        ]);

        $result1 = json_decode($response->getBody()->getContents(), true);
        return $result1['data'];
    }

    public function getapipropinsi()
    {
        $response = $this->_client->request('GET', 'pasien/propinsi', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapikabupaten($id)
    {
        $response = $this->_client->request('GET', 'pasien/kabupaten', [
            'query' => ['idprop' => $id]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapikecamatan($id)
    {
        $response = $this->_client->request('GET', 'pasien/kecamatan', [
            'query' => ['idkab' => $id]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapikelurahan($id)
    {
        $response = $this->_client->request('GET', 'pasien/kelurahan', [
            'query' => ['idkec' => $id]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapipasiennik($nik)
    {
        $response = $this->_client->request('GET', 'pasien/ceknik', [
            'query' => ['nik' => $nik]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
        // var_dump($result2);
        
    }

    public function getapiasuransi()
    {
        $response = $this->_client->request('GET', 'pasien/asuransi', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }
    public function getapipendidikan()
    {
        $response = $this->_client->request('GET', 'pasien/pendidikan', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }
    public function getapipekerjaan()
    {
        $response = $this->_client->request('GET', 'pasien/pekerjaan', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }
    public function getapisuku()
    {
        $response = $this->_client->request('GET', 'pasien/suku', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapiagama()
    {
        $response = $this->_client->request('GET', 'pasien/agama', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapiidentitas()
    {
        $response = $this->_client->request('GET', 'pasien/identitas', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapigoldarah()
    {
        $response = $this->_client->request('GET', 'pasien/goldarah', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function getapihubungan()
    {
        $response = $this->_client->request('GET', 'pasien/hubungan', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }
    
    public function getapikelas()
    {
        $response = $this->_client->request('GET', 'pasien/kelas', [
            // 'query' => ['tanggal' => $tgl]
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        $result2 = $result1['data'];
        $row = array();
        foreach ($result2 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }

    public function saveapipasien($data)
    {
        $response = $this->_client->request('POST', 'pasien/pasienadd', [
            'form_params' => $data
        ]);
        $result1 = json_decode($response->getBody()->getContents(), true);
        // $result2 = $result1['data'];        
        // return $result1;
        $row = array();
        foreach ($result1 as $data) {
            $row[] = $data;
        }
        echo  json_encode($row);
    }
}
