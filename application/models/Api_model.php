<?php 
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use function GuzzleHttp\json_encode;

class Api_model extends CI_model {
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            // 'base_uri' => 'http://192.168.132.75:8080/restfull-api/lab/',
            'base_uri' => 'http://localhost/restfull-api/lab/',
            'auth' => ['lis','lis123']
        ]);
    }
    
    public function getapiranap()
    {
        $response = $this->_client->request('GET','ranap');
        $result1 = json_decode($response->getBody()->getContents(),true);
        $result2 = $result1['data'];
        // $result1 = $response->getBody()->getContents();
        $no=1;
        foreach($result2 as $data)
    		{   
    			$row[] = array(
    				'no'=>$no++,
                    'medical_cd'=>$data['medical_cd'],
                    'kelas_cd'=>$data['kelas_cd'],
                    'kelas_nm'=>$data['kelas_nm'],
                    'ruang_cd'=>$data['ruang_cd'],
                    'ruang_nm'=>$data['ruang_nm'],
                    'pasien_cd'=>$data['pasien_cd'],
                    'no_rm'=>$data['no_rm'],
                    'pasien_nm'=>$data['pasien_nm'],
                    'birth_date'=>$data['birth_date'],
                    'datetime_in'=>$data['datetime_in'],
                    'address'=>$data['address'],
                    'dr_cd'=>$data['dr_cd'],
                    'dr_nm'=>$data['dr_nm'],
                    'pasien_type'=>$data['pasien_type']
    			);                                      
    		}
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function getapirajal($tgl)
    {       
        $response = $this->_client->request('GET','rajal',[
            'query' =>['date' => $tgl] 
        ]);
        
        $result1 = json_decode($response->getBody()->getContents(),true);
        $result2 = $result1['data'];
        // $result1 = $response->getBody()->getContents();
        $stat = $result1['status'];
        $no=1;
        $row=array();
         foreach($result2 as $data)
    		{   
    			$row[] = array(
    				'no'=>$no++,
                    'medical_cd'=>$data['medical_cd'],
                    'medunit_cd'=>$data['medunit_cd'],
                    'medunit_nm'=>$data['medunit_nm'],
                    'pasien_cd'=>$data['pasien_cd'],
                    'no_rm'=>$data['no_rm'],
                    'pasien_nm'=>$data['pasien_nm'],
                    'birth_date'=>$data['birth_date'],
                    'address'=>$data['address'],
                    'dr_cd'=>$data['dr_cd'],
                    'dr_nm'=>$data['dr_nm'],
                    'queue_no'=>$data['queue_no'],
                    'proses_st'=>$data['proses_st'],
                    'pasien_type'=>$data['pasien_type']
    			);                                      
    		}
        $result=array('aaData'=>$row);
        echo  json_encode($result);
    
    }


    public function rajaltes()
    {       
        $tgl = '2019-10-18';
        $response = $this->_client->request('GET','rajal',[
            'query' =>['date' => $tgl] 
        ]);
        
        $result1 = json_decode($response->getBody()->getContents(),true);
        $result2 = $result1['data'];
        $stat = $result1['status'];
    // var_dump(  $response->getBody()->getContents());
       foreach ($result2 as $key => $value) {
            echo $value["medical_cd"]."<br/>";
           # code...
       }
       if ($stat == true){      
       foreach($result2 as $data)
            {   
                $row[] = array(
                    'medical_cd'=>$data['medical_cd'],
                    'medunit_cd'=>$data['medunit_cd'],
                    'medunit_nm'=>$data['medunit_nm'],
                    'pasien_cd'=>$data['pasien_cd'],
                    'no_rm'=>$data['no_rm'],
                    'pasien_nm'=>$data['pasien_nm'],
                    'birth_date'=>$data['birth_date'],
                    'address'=>$data['address'],
                    'dr_cd'=>$data['dr_cd'],
                    'dr_nm'=>$data['dr_nm'],
                    'queue_no'=>$data['queue_no'],
                    'proses_st'=>$data['proses_st'],
                    'pasien_type'=>$data['pasien_type']
                );                  
            } }else{
                $row=array();
            }
        $result=array('aaData'=>$row);
        echo  json_encode($result);    
    }

    

    public function getapitindakan()
    {
        $response = $this->_client->request('GET','tindakan');
        $result1 = json_decode($response->getBody()->getContents(),true);
        $result2 = $result1['data'];
        // $result1 = $response->getBody()->getContents();
        $no=1;
        foreach($result2 as $data)
    		{   
    			$row[] = array(
                    'medicalunit_cd'=>$data['medicalunit_cd'],
                    'medicalunit_nm'=>$data['medicalunit_nm']
    			);                                      
    		}
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function getapilabhistory($no_rm)
    {
        $response = $this->_client->request('GET','labhistory',[
            'query' =>['no_rm' => $no_rm] 
        ]);
        $result1 = json_decode($response->getBody()->getContents(),true);
        $result2 = $result1['data'];
        // $result1 = $response->getBody()->getContents();
        $no=1;
        foreach($result2 as $data)
    		{   
    			$row[] = array(
    				'no'=>$no++,
                    'medical_cd'=>$data['medical_cd'],
                    'datetime_trx'=>$data['datetime_trx'],
                    'dr_nm'=>$data['dr_nm'],
                    'medicalunit_cd'=>$data['medicalunit_cd'],
                    'medicalunit_nm'=>$data['medicalunit_nm']
    			);                                      
    		}
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function getapitindakanbykunjungan($medical_cd)
    {
        $response = $this->_client->request('GET','tindakanbykunjungan',[
            'query' =>['medical_cd' => $medical_cd] 
        ]);
        $result1 = json_decode($response->getBody()->getContents(),true);
        $result2 = $result1['data'];
        // $result1 = $response->getBody()->getContents();
        $no=1;
        foreach($result2 as $data)
    		{   
    			$row[] = array(
    				'no'=>$no++,
                    'medical_cd'=>$data['medical_cd'],
                    'medical_unit_seqno'=>$data['medical_unit_seqno'],
                    'group_no'=>$data['group_no'],
                    'date_trx'=>$data['date_trx'],
                    'dr_nm'=>$data['dr_nm'],
                    'medicalunit_cd'=>$data['medicalunit_cd'],
                    'medicalunit_nm'=>$data['medicalunit_nm'],
                    'file_report'=>$data['file_report'],
                    'medical_note'=>$data['medical_note'],
                    'dr2_cd'=>$data['dr2_cd'],
                    'dr2_nm'=>$data['dr2_nm']
    			);                                      
    		}
    	$result=array('aaData'=>$row);
    	echo  json_encode($result);
    }

    public function saveapitindakan($data)
    {
        $response = $this->_client->request('POST','tindakanbykunjungan',[
            'form_params' =>$data 
        ]);
        $result1 = json_decode($response->getBody()->getContents(),true);
        // $result2 = $result1['data'];        
        return $result1;
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];

        $this->db->insert('mahasiswa', $data);
    }

    public function hapusDataMahasiswa($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('mahasiswa', ['id' => $id]);
    }

    public function getMahasiswaById($id)
    {
        return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('mahasiswa', $data);
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}