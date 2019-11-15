<?php
/**
 *
 */
class Ppi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Ppi_model');
    }

    function index()
    {
        $logged_in = $this->session->userdata('user_nm');
        $user_group = $this->session->userdata('user_group');
        if(!$logged_in) {
            redirect('login');
        }elseif(($user_group=='2') & ($user_group=='')){
            $data = array(
                'title' => 'Daftar Laporan Kepatuhan Cuci Tangan',
                'contents' => 'ppi/home'
            );
            $this->load->view('template', $data);
        }else{
            redirect('login');
        }
    }

    function rekap_ppi()
    {
        $logged_in = $this->session->userdata('user_nm');
        $user_group = $this->session->userdata('user_group');
        if(!$logged_in) {
            redirect('login');
        }elseif(($user_group=='2')||($user_group=='')){
            $data = array(
                'title' => 'REKAPITULASI DATA PEMAKAIAN ALAT/TINDAKAN DATA INFEKSI',
                'contents' => 'ppi/home'
            );
            $this->load->view('template', $data);
        }else{
            redirect('login');
        }
    }

    function ct_ppi()
    {
        $logged_in = $this->session->userdata('user_nm');
        $user_group = $this->session->userdata('user_group');
        if(!$logged_in) {
            redirect('login');
        }elseif(($user_group=='2')){
            $data = array(
                'title' => 'ANGKA KEPATUHAN CUCI TANGAN',
                'contents' => 'ppi/ct'
            );
            $this->load->view('template', $data);
        }else{
            redirect('login');
        }
    }

    function get_ajax($mt,$yr)
    {
        $unit=$this->session->userdata('unit_cd');
        $criteria = $this->db->query("SELECT * FROM ppi where month(tanggal)=$mt and year(tanggal)=$yr and unit_cd=$unit");
        if($criteria->num_rows() == 0 )
        {
            $tanggal = cal_days_in_month(CAL_GREGORIAN, $mt, $yr);
            $id=$this->Ppi_model->max_id()->row('id');
            for ($i=1; $i < $tanggal+1; $i++) {
                $id=$id+1;
                $dt = array(
                    'ppi_cd'=>$id,
                    'tanggal'=>date('Y-m-d',strtotime($yr.'/'.$mt.'/'.$i)),
                    'unit_cd'=>$unit
                );
                $this->Ppi_model->insert($dt);
            }
        }
        echo $this->Ppi_model->get_data($unit,$mt,$yr);
    }

    function get_ajax_ct($mt,$yr)
    {
      $this->Ppi_model->get_data_ct($mt,$yr);
  }

  function showAlldata($mt,$yr)
  {
    $unit=$this->session->userdata('unit_cd');
    $criteria = $this->db->query("SELECT * FROM ppi where month(tanggal)=$mt and year(tanggal)=$yr and unit_cd=$unit");
    if($criteria->num_rows() == 0 )
    {
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $mt, $yr);
        $id=$this->Ppi_model->max_id()->row('id');
        for ($i=1; $i < $tanggal+1; $i++) {
            $id=$id+1;
            $dt = array(
                'ppi_cd'=>$id,
                'tanggal'=>date('Y-m-d',strtotime($yr.'/'.$mt.'/'.$i)),
                'pasien_qty'=>'',
                'lvl'=>'',
                'dc'=>'',
                'ngt'=>'',
                'bedah'=>'',
                'irah_baring'=>'',
                'phlebitis'=>'',
                'isk'=>'',
                'ilo'=>'',
                'pneumonia'=>'',
                'dekubitus'=>'',
                'sepsis'=>'',
                'unit_cd'=>$unit
            );
            $this->Ppi_model->insert($dt);
        }
    }
    $result = $this->Ppi_model->view($unit,$mt,$yr);
    echo json_encode($result);
}

function update()
{
    $column=$this->input->post('column');
    $editval=$this->input->post('editval');
    $id=$this->input->post('id');
    $data = array(
        $column=>$editval
    );
    return $this->Ppi_model->update(array('ppi_cd' => $id),$data,'ppi');

}



function showAlldata_ct($mt,$yr){
    $tgl=date('Y-m-d',strtotime($yr.'/'.$mt.'/01'));
    $query = $this->db->query("SELECT * FROM ppi_ct ct join unit u on ct.ppi_unit_cd=u.unit_cd where month(date)=$mt and year(date)=$yr");
    if ($query->num_rows() <= 0) {
        $this->db->query("insert INTO ppi_ct (ppi_unit_cd, rate, date) select unit_cd, 0 , '".$tgl."' from unit");
    }
    $result = $this->Ppi_model->view_ct($mt,$yr);
    echo json_encode($result);
}

function update_ct()
{
    $column=$this->input->post('column');
    $editval=$this->input->post('editval');
    $id=$this->input->post('id');
    $data = array(
        $column=>$editval
    );
    return $this->Ppi_model->update(array('id_ct' => $id),$data,'ppi_ct');

}
}
