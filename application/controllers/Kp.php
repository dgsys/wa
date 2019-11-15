<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kp extends CI_Controller {

    function __construct() {
        parent::__construct();
        // $this->load->model('kp/app_model');
        $this->load->model('kp/Kp_model');
    }

    public function index() {
       $logged_in = $this->session->userdata('user_nm');
       $user_group = $this->session->userdata('user_group');
       if(!$logged_in) {
        redirect('login');
    }else{
     //    if(($user_group!='1') || ($user_group!=null)){
     //     redirect('login'); 
     // }else{ 
        $data = array(
            'title' => 'Daftar Laporan Insiden Keselamatan Pasien',
            'contents' => 'kp/home'
        );

        $this->load->view('template', $data);
    // }
    }
}

public function add() {
    if($this->session->userdata('user_lv')=='3'){ 
        $data = array(
            'title' => 'Form Pelaporan Insiden',
            'contents' => 'kp/new_event',
            'status' => 'add',
            'id'=>'',
            'rowData'=>''
        );

        $this->load->view('template', $data);
    }else{
        redirect('kp');
    }
}

public function laporan() {
    $data = array(
        'title' => 'Form Pelaporan Insiden',
        'contents' => 'kp/report'
    );

    $this->load->view('template', $data);
}

function max_id() {
    $id = $this->Kp_model->max_id()->row('id');
    if ($id == '') {
        $newId = 1;
    } else {
        $newId = $id + 1;
    }
    echo $newId;
}

function ajax_add() {
    $nama = $this->input->post('nama');
    $no_rm = $this->input->post('no_rm');
    $umur = $this->input->post('umur');
    $gender = $this->input->post('gender');
    $asuransi = $this->input->post('asuransi');
    $tanggal_masuk = $this->input->post('tanggal_masuk');
    $date_masuk = new DateTime($tanggal_masuk);
    $new_date_masuk = $date_masuk->format('Y-m-d H:i:s');
    $tgl_insiden = $this->input->post('tgl_insiden');
    $date_insiden = new DateTime($tanggal_masuk);
    $new_date_insiden = $date_insiden->format('Y-m-d H:i:s');
    $insiden = $this->input->post('insiden');
    $kronologi = $this->input->post('kronologi');
    $jenis_insiden = $this->input->post('jenis_insiden');
    $pelapor = $this->input->post('pelapor1_lain');
    $terjadiPada = $this->input->post('terjadipada_lain');
    $lokasi_insiden = $this->input->post('lokasi_insiden');
    $kasusPenyakit = $this->input->post('kasusPenyakit');
    $unit_terkait = $this->input->post('unit_terkait');
    $akibatInsiden = $this->input->post('akibatInsiden');
    $tindakan = $this->input->post('tindakan');
    $paramedis = $this->input->post('paramedisLain');
    $kejadianSama = $this->input->post('kejadianSama');
    $tindakanKejadianSama = $this->input->post('tindakanKejadianSama');
    $namaPelapor = $this->input->post('namaPelapor');
    $grading = $this->input->post('grading');
    $id = $this->Kp_model->max_id()->row('id');
    $unit=$this->session->userdata('unit_cd');
    if(!$unit) {
        $unit='';
    }
    if ($id == '') {
        $newId = 1;
    } else {
        $newId = $id + 1;
    }
    $data = array(
            // 'insiden_cd' => $newId,
        'p_nm' => $nama,
        'p_rm' => $no_rm,
        'p_age' => $umur,
        'p_gender' => $gender,
        'p_asuransi' => $asuransi,
        'p_date_in' => $new_date_masuk,
        'i_date' => $new_date_insiden,
        'i_title' => $insiden,
        'i_kronologi' => $kronologi,
        'i_tp' => $jenis_insiden,
        'i_pelapor' => $pelapor,
        'i_victim' => $terjadiPada,
        'i_terkait' => '',
        'i_lokasi' => $lokasi_insiden,
        'i_penyakit' => $kasusPenyakit,
        'i_unit_terkait' => $unit_terkait,
        'i_dampak' => $akibatInsiden,
        'i_hasil' => $tindakan,
        'i_paramedis' => $paramedis,
        'i_duplicate' => $kejadianSama,
        'i_solution' => $tindakanKejadianSama,
        'pelapor_nm' => $namaPelapor,
        'grading' => $grading,
        'unit_cd' => $unit
    );
    $insert = $this->Kp_model->insert($data);
    echo json_encode(array("status" => TRUE));
}

function ajax_update(){
    $id = $this->input->post('insiden_cd');
    $nama = $this->input->post('nama');
    $no_rm = $this->input->post('no_rm');
    $umur = $this->input->post('umur');
    $gender = $this->input->post('gender');
    $asuransi = $this->input->post('asuransi');
    $tanggal_masuk = $this->input->post('tanggal_masuk');
    $date_masuk = new DateTime($tanggal_masuk);
    $new_date_masuk = $date_masuk->format('Y-m-d H:i:s');
    $tgl_insiden = $this->input->post('tgl_insiden');
    $date_insiden = new DateTime($tanggal_masuk);
    $new_date_insiden = $date_insiden->format('Y-m-d H:i:s');
    $insiden = $this->input->post('insiden');
    $kronologi = $this->input->post('kronologi');
    $jenis_insiden = $this->input->post('jenis_insiden');
    $pelapor = $this->input->post('pelapor1_lain');
    $terjadiPada = $this->input->post('terjadipada_lain');
    $lokasi_insiden = $this->input->post('lokasi_insiden');
    $kasusPenyakit = $this->input->post('kasusPenyakit');
    $unit_terkait = $this->input->post('unit_terkait');
    $akibatInsiden = $this->input->post('akibatInsiden');
    $tindakan = $this->input->post('tindakan');
    $paramedis = $this->input->post('paramedisLain');
    $kejadianSama = $this->input->post('kejadianSama');
    $tindakanKejadianSama = $this->input->post('tindakanKejadianSama');
    $namaPelapor = $this->input->post('namaPelapor');
    $grading = $this->input->post('grading');
    $unit=$this->session->userdata('unit_cd');
    if(!$unit) {
        $unit='';
    }
    if ($id == '') {
        $newId = 1;
    } else {
        $newId = $id + 1;
    }
    $data = array(
        'p_nm' => $nama,
        'p_rm' => $no_rm,
        'p_age' => $umur,
        'p_gender' => $gender,
        'p_asuransi' => $asuransi,
        'p_date_in' => $new_date_masuk,
        'i_date' => $new_date_insiden,
        'i_title' => $insiden,
        'i_kronologi' => $kronologi,
        'i_tp' => $jenis_insiden,
        'i_pelapor' => $pelapor,
        'i_victim' => $terjadiPada,
        'i_terkait' => '',
        'i_lokasi' => $lokasi_insiden,
        'i_penyakit' => $kasusPenyakit,
        'i_unit_terkait' => $unit_terkait,
        'i_dampak' => $akibatInsiden,
        'i_hasil' => $tindakan,
        'i_paramedis' => $paramedis,
        'i_duplicate' => $kejadianSama,
        'i_solution' => $tindakanKejadianSama,
        'pelapor_nm' => $namaPelapor,
        'grading' => $grading
    );
    $this->Kp_model->update(array('insiden_cd' => $id), $data);
    echo json_encode(array("status" => TRUE));
}

function ajax_get_insiden(){
    $ins=$this->input->get('insiden');
    $query=$this->Kp_model->get_insiden($ins);
    echo json_encode($query);
}

function ajax_get_data(){
    $unit=$this->session->userdata('unit_cd');
    $lv=$this->session->userdata('user_lv');

    if(!$unit) {
        $unit='';
    }
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    if($lv=='1'){ 
        $query = $this->db->query("SELECT * from insiden i join unit u on i.unit_cd=u.unit_cd where status=3 order by i.i_date desc");
    }elseif($lv=='2'){ 
        $query = $this->db->query("SELECT * from insiden i join unit u on i.unit_cd=u.unit_cd where status=2 ");
    }else{
        $query = $this->db->query("SELECT * from insiden i join unit u on i.unit_cd=u.unit_cd where status=1 and i.unit_cd=".$unit." order by i.i_date desc");
    }
    $data = [];
    $no=1;
    foreach($query->result() as $r) {
        if($r->grading=="BIRU"){
            $grd="<i class='fa fa-square text-aqua fa-2x'></i>";
        }else if($r->grading=="HIJAU"){
            $grd="<i class='fa fa-square text-green fa-2x'></i>";
        }else if($r->grading=="MERAH"){
            $grd="<i class='fa fa-square text-red fa-2x'></i>";
        }else if($r->grading=="KUNING"){
            $grd="<i class='fa fa-square text-orange fa-2x'></i>";
        }else{
            $grd="<i class='fa fa-square fa-2x'></i>";
        }

        if($r->status=='1'){
            $st="<p class='label label-warning'>pending</p>";
        }elseif($r->status=="2"){
            $st="<p class='label label-info'>process</p>";
        }else{
            $st="<p class='label label-info'>verified</p>";
        }

        if($r->status=='1'){
            $evnt="<a href='".base_url('kp/edit/'.$r->insiden_cd)."' class='btn btn-success btn-xs'>edit</a>&nbsp<a href='#' class='btn btn-primary btn-xs' onclick='detail_show(".$r->insiden_cd.")'>detail</a>&nbsp<a href='#' class='btn btn-danger btn-xs' onclick='delete_dt(".$r->insiden_cd.")'>remove</a>";
            $chk="<input type='checkbox' class='data-check' id='chkSend[]' name='chkSend' value='".$r->insiden_cd."'>";
        }elseif ($r->status=='2') {
         $evnt="<a href='".base_url('kp/edit/'.$r->insiden_cd)."' class='btn btn-success btn-xs'>edit</a>&nbsp<a href='#' class='btn btn-primary btn-xs' onclick='detail_show(".$r->insiden_cd.")'>detail</a>";
         $chk="<input type='checkbox' class='data-check' id='chkSend[]' name='chkSend' value='".$r->insiden_cd."'>";
     }else{
       $evnt="<a href='#' class='btn btn-primary btn-xs' onclick='detail_show(".$r->insiden_cd.")'>detail</a>";
       $chk="<input type='checkbox' class='data-check' disabled='disabled' id='chkSend[]' name='chkSend' value='".$r->insiden_cd."'>";
   }


   $data[] = array(
    // 'chk' => "<input type='checkbox' class='data-check' id='chkSend[]' name='chkSend' value='".$r->insiden_cd."'>",
    'chk' => $chk,
    'no' => $no,
    'grade' => $grd,
    'jenis' => $r->i_tp."<br><small>".$st."</small>",
    'tanggal' => $this->app_model->tgl_indo_jam($r->i_date),
    'insiden' => $r->i_title,
    'pelapor' => "<b>".$r->pelapor_nm."</b><p>".$r->unit_nm."</p>",
    'event' => $evnt
);
   $no=$no+1;
}

$result = array(
 "draw" => $draw,
 "recordsTotal" => $query->num_rows(),
 "recordsFiltered" => $query->num_rows(),
 "data" => $data
);

echo json_encode($result);
exit();
}

function ajax_delete($id){
    if($id)
        return $this->Kp_model->delete_data($id);
    return false;
}

public function ajax_send()
{
    $list_id = $this->input->post('id');
    $user_lv = $this->input->post('lv');
    if($user_lv=='3')
    {
        $st='2';
    }elseif ($user_lv=='2') {
     $st='3';
 }
 foreach ($list_id as $id) {
    $data = array(
        'status' => $st
    );
    $this->Kp_model->update(array('insiden_cd' => $id), $data);
}
echo json_encode(array("status" => TRUE));
}


function ajax_edit($id){
    $data = $this->Kp_model->get_by_id($id);
    echo json_encode($data);
}

public function edit($id){
  $data = array(
    'title' => 'Form Pelaporan Insiden',
    'contents' => 'kp/new_event',
    'status' => 'edit',
    'id' => $id,
    'rowData' => $this->Kp_model->get_by_id($id)
);

  $this->load->view('kp/template', $data);
}

}
