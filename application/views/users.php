<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery-3.3.1.min.js"></script>


<!-- Bootstrap 3.3.7 -->
<script type="text/javascript">
 var url;
  var save_method; //for save method string


 function add_user()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data User'); // Set Title to Bootstrap modal title
    // $(".date-picker").datepicker("setDate", new Date());
}

function edit_user(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('users/ajax_edit_user/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="user_cd"]').val(data.user_cd);
            // $('[name="periode"]').datepicker('update',data.periode);
            // document.getElementById(data.jenis_kelamin).checked = true;
            $('[name="full_nama"]').val(data.full_nm);
            $('[name="user_nama"]').val(data.user_nm);
            $('[name="user_level"]').val(data.user_lv);
            $('[name="user_unit"]').val(data.unit_cd);
            $('[name="user_group"]').val(data.user_group);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data User'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Gagal ambil data dari Database');
        }
    });
}

function delete_user(id)
{
    if(confirm('yakin akan menghapus data ini?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('gelombang/ajax_delete_gelombang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
               $('#notice').show();
               $('#status').text('Berhasil Hapus data')
                setTimeout(function() { 
                $('#notice').fadeOut(); 
                }, 1200);
               
      reload_table();
        },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $('#notice').show();
               $('#status').text('Gagal Hapus data')
                setTimeout(function() { 
                $('#notice').fadeOut(); 
                }, 1200);
      reload_table();
        }
        });

    }
}

function save()
{  
  // var full_nama =$('#full_nama').val();
  // var user_nama =$('#user_nama').val();
  // var full_nama =$('#full_nama').val();
  // var full_nama =$('#full_nama').val();


  // if(nama == ''){
  //   alert("Maaf, Nama tidak boleh kosong");
  //   $('#gelombang').focus();
  //   return false;
  // }

$('#btnSave').text('saving...'); //change button text
$('#btnSave').attr('disabled',true); //set button disable 

if(save_method == 'add') {
  url = "<?php echo site_url('users/ajax_add_users')?>";
} else {
  url = "<?php echo site_url('users/ajax_update_users')?>";
}
// ajax adding data to database
$.ajax({
  url : url,
  type: "POST",
  data: $('#form').serialize(),
  dataType: "JSON",
  success: function(data)
  {
if(data.status) //if success close modal and reload ajax table
{
  $('#modal_form').modal('hide');
  $('#notice').show();
  $('#status').text('Berhasil simpan data')
  setTimeout(function() { 
    $('#notice').fadeOut(); 
  }, 1200);
  reload_table();
}
$('#btnSave').text('save'); //change button text
$('#btnSave').attr('disabled',false); //set button enable 
},
error: function (jqXHR, textStatus, errorThrown)
{
//alert('Error adding / update data');
$('#notice').show();
$('#status').text('Gagal simpan data')
setTimeout(function() { 
  $('#notice').fadeOut(); 
}, 1200);
$('#btnSave').text('save'); //change button text
$('#btnSave').attr('disabled',false); //set button enable 
$('#modal_form').modal('hide');
reload_table();
}
});
}

function reload_table()
{
$('#example1').dataTable().fnDestroy();
tampil_user();
}

 

$(document).ready(function () {
  $('.date-picker').datepicker({
    autoclose: true,
    format: "yyyy-mm-dd",
    todayHighlight: true,
    todayBtn: true,
    todayHighlight: true,
  });
  $(".date-picker").datepicker("update", new Date());
  $(".angka").keypress(function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//$("#errmsg").html("Digits Only").show().fadeOut("slow");
return false;
}
});
tampil_user();
$('#notice').hide();

$('#id_group').prop("disabled", true);
$('#user_unit').prop("disabled", true);
})//akhir doc ready

function pilih_level(){
  var isi = $('#user_level').val();

  if(isi == '1'){
    $('#id_group').prop("disabled", true);
    $('#user_unit').prop("disabled", true);
  }else if(isi == '2'){
    $('#id_group').prop("disabled", false);
    $('#user_unit').prop("disabled", true);
  }else{
    $('#id_group').prop("disabled", true);
    $('#user_unit').prop("disabled", false);
  }
}
  function tampil_user(){
    $('#example1').dataTable( {
      "bProcessing"   : true,
      "scrollY"       :  350,
      "scrollCollapse": true,
      "bServerside":true,
      "sAjaxSource"   : "<?php echo site_url('users/user_tabel');?>",
      "columns": [
      { "data": "no" },
      { "data": "full_nm" },
      { "data": "user_nm" },
      { "data": "user_lv" },
      { "data": "unit_nm" },
      { "data": "nama_group" },
      { "data": "aksi" }
      ]
    });
  };



</script>


<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li class="active"><a href="#">INSIDEN BARU</a></li> -->
    </ol>
</section>
<div class="row">
 <div class="col-md-3 pull-right"> 
              <div id="notice" class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Info </h4>
                <!-- Silahkan ambil nomor antrian anda. -->
                <label id="status"></label>
              </div>
            </div>
          </div>
<section class="content">  
<div class="row">
  
  <div class="box">
     <div class="box-header">
        <div class="col-xs-2">
                      <button type="button" class="btn btn-block btn-primary" onclick="add_user()" >Tambah</button>
                    </div>
                     <div class="col-xs-2">
                      <button type="button" class="btn btn-block btn-success" onclick="reload_table()" >Reload</button>
                    </div>
     </div>
   <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%" class="text-center">No</th>
                      <th width="20%" class="text-center">Nama</th>
                      <th width="10%" class="text-center">Username</th>
                      <th class="text-center">Level</th>
                      <th class="text-center">Unit</th>
                      <th class="text-center">Group</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
</div>
</section>

<!-- modal -->
<div class="modal fade" id="modal_form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                  <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="user_cd"/>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3">Nama</label>
                      <div class="col-sm-6">
                       <input type="text" name="full_nama" id="full_nama" placeholder=" " class="form-control  ">
                     </div>
                   </div>
                   <div class="form-group">
                      <label class="control-label col-md-3">Username</label>
                      <div class="col-sm-5">
                       <input type="text" name="user_nama" id="user_nama" placeholder=" "  class="form-control  ">
                     </div>
                   </div>
                    <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-sm-5">
                            <input type="password"  name="user_password" id="user_password"  placeholder="" class="form-control ">
                            </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3">Level</label>
                      <div class="col-sm-3">
                      <select class="form-control" name="user_level" id="user_level" label="" labelPosition="top" onchange="pilih_level()" >
                       <option value="1" selected="selected">Super Admin</option> 
                       <option value="2">Admin</option> 
                       <option value="3" >User</option>                                    
                      </select>
                     
                    </div>
                  </div>
                    <div class="form-group">
                            <label class="control-label col-md-3">Unit</label>
                      <div class="col-sm-3">
                      <select class="form-control" name="user_unit" id="user_unit" label="" labelPosition="top" data-options="editable:false" >
                       <option value="" selected="true">Semua</option> 
                        <?php foreach($unit_->result() as $row):?>
                          <option value="<?php echo $row->unit_cd;?>"><?php echo $row->unit_nm;?></option>
                        <?php endforeach;?>             
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                            <label class="control-label col-md-3">Group</label>
                      <div class="col-sm-3">
                      <select class="form-control" name="id_group" id="id_group" label="" labelPosition="top" >
                       <option value="" >Admin</option> 
                        <?php foreach($group_->result() as $row):?>
                          <option value="<?php echo $row->id_group;?>"><?php echo $row->nama_group;?></option>
                        <?php endforeach;?>             
                      </select>
                    </div>
                  </div>

                </form>
                <!-- <p>One fine body&hellip;</p> -->
              </div>
              <div class="modal-footer alert">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

       

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>easyui/demo.css">
<script type="text/javascript" src="<?php echo base_url();?>easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>easyui/jquery.min.js"></script>

<script src="<?php echo base_url(); ?>chartjs/Chart.bundle.js"></script>
<script src="<?php echo base_url(); ?>chartjs/utils.js"></script>

