<?php

class Kp_model extends CI_Model {

    var $tabel = 'insiden';

    function __construct() {
        parent::__construct();
    }

    function insert($dt) {
        return $this->db->insert($this->tabel, $dt);
    }

    function max_id() {
        $this->db->select_max('insiden_cd','id');
        return $this->db->get($this->tabel);
    }   

    function get_insiden($val){
        $query= $this->db->query("SELECT DISTINCT(i_title) FROM insiden where i_title like '%".$val."%'");
        return $query->result_array();
    }

    function get_by_id($id){
        $this->db->select('*, s.set_nm as penyakit, ss.set_nm as dampak');
        $this->db->from('insiden i'); 
        $this->db->join('setting s', 's.set_cd=i.i_penyakit', 'left');
        $this->db->join('setting ss', 'ss.set_cd=i.i_dampak', 'left');
        $this->db->where('i.insiden_cd',$id);
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
        // return $this->db->get_where($this->tabel,array('insiden_cd'=>$id))->row();
        // $query=$this->db->get_where($this->tabel,array('insiden_cd'=>$id));
        // $row = array(); 
        // foreach($query->result_array() as $data)
        // {   
        //     $row[] = array(
        //         'insiden_cd'=>$data['insiden_cd'],
        //         'p_nm'=>$data['p_nm'],
        //         'p_rm'=>$data['p_rm'],
        //         'p_age'=>$data['p_age'],
        //         'p_gender'=>$data['p_gender'],
        //         'p_date_in'=>$data['p_date_in'],
        //         'i_date'=>$data['i_date'],
        //         'grading'=>$data['grading'],
        //         'i_tp'=>$data['i_tp'],
        //         'i_title'=>$data['i_title'],
        //         'pelapor_nm'=>$data['pelapor_nm']
        //     );                                      
        // }
        // $result=array('Data'=>$row);
        // echo  json_encode($result);
    }

    public function get_data($unit){   
       $result = array();
       $result['total'] = $this->db->query("SELECT * FROM insiden ")->num_rows();
       $row = array(); 
       $criteria = $this->db->query("SELECT * from insiden where unit_cd=".$unit."");
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
            'grading'=>$data['grading'],
            'i_tp'=>$data['i_tp'],
            'i_title'=>$data['i_title'],
            'pelapor_nm'=>$data['pelapor_nm']
        );                                      
    }
    $result=array('aaData'=>$row);
    echo  json_encode($result);
}

public function delete_data($id)
{
 $this->db->delete($this->tabel, array('insiden_cd' => $id));
 return $this->db->affected_rows() > 1 ? true:false;
}

public function update($where, $data)
{
    $this->db->update($this->tabel, $data, $where);
    return $this->db->affected_rows();
}
}
