<section class="content-header"><br/>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="#">IKP</a></li>
  </ol>
</section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">
      <i class="fa fa-wheelchair"></i>
      <h3 class="box-title"> <?php echo $title; ?> unit <b></b></h3><br/><br/>
      <!-- <div class="pull-left box-tools"> -->
        <?php if(($this->session->userdata('user_lv')=='3')){ ;?>
          <a href="<?php echo base_url('kp/add');?>" class="btn btn-success">ADD</a>
          <a href="javascript:void(0)" onclick="send_data()" class="btn btn-primary">SEND</a>
        <?php }elseif($this->session->userdata('user_lv')=='2'){ ;?>
         <a href="javascript:void(0)" onclick="send_data()" class="btn btn-primary">VERIFY</a>
       <?php } ;?>
       <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
       <!-- </div> -->
     </div>
     <div class="box-body">

       <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><input type='checkbox' id="checkAll"></th>
            <th>Grading</th>
            <th>Jenis</th>
            <th>Tanggal</th>
            <th>Insiden</th>
            <th>Pelapor</th>
            <th>Event</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div class="box-footer clearfix">

    </div>
  </div>
</section>

<div class="modal fade" id="modal-insiden">
  <div class="modal-dialog" style="width:1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Default Modal</h4>
        </div>
        <div class="modal-body">
          <div class="content">
            <table class="table table-striped table-bordered">
              <tr>
                <td colspan="6" class="h5 headDetail"><b>DATA PASIEN</b></td>
              </tr>
              <tr>
                <td width="10%" class="text text-bold">Nama</td>
                <td width="1%">:</td>
                <td width="39%"><span id="nama_pasien"></span></td>
                <td width="15%" class="text text-bold">Gender</td>
                <td width="1%">:</td>
                <td width="34%"><span id="gender"></span></td>

              </tr>
              <tr>
                <td width="10%" class="text text-bold">No.RM</td>
                <td width="1%">:</td>
                <td width="39%"><span id="no_rm"></span></td>
                <td width="10%" class="text text-bold">Jaminan</td>
                <td width="1%">:</td>
                <td width="39%"><span id="jaminan"></span></td>
              </tr>
              <tr>
                <td width="10%" class="text text-bold">Umur</td>
                <td width="1%">:</td>
                <td width="39%"><span id="umur"></span></td>
                <td width="10%" class="text text-bold">Tanggal Masuk</td>
                <td width="1%">:</td>
                <td width="39%"><span id="tanggalMasuk"></span></td>
              </tr>
            </table>
            <hr/>
            <table class="table table-striped table-bordered">
             <tr>
              <td colspan="3" class="h5 headDetail"><b>DATA INSIDEN</b></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Tanggal Insiden</td>
              <td width="1%">:</td>
              <td width="79%"><span id="tanggalInsiden"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Insiden</td>
              <td width="1%">:</td>
              <td width="79%"><span id="insiden"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Kronologi</td>
              <td width="1%">:</td>
              <td width="79%"><span id="kronologi"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Jenis Insiden</td>
              <td width="1%">:</td>
              <td width="79%"><span id="jenis"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Pelapor Pertama</td>
              <td width="1%">:</td>
              <td width="79%"><span id="pelaporPertama"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Insiden Terjadi pada?</td>
              <td width="1%">:</td>
              <td width="79%"><span id="terjadiPada"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Lokasi Insiden</td>
              <td width="1%">:</td>
              <td width="79%"><span id="lokasiInsiden"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Kasus Penyakit</td>
              <td width="1%">:</td>
              <td width="79%"><span id="kasusPenyakit"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Unit Terkait</td>
              <td width="1%">:</td>
              <td width="79%"><span id="unitTerkait"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Akibat Insiden</td>
              <td width="1%">:</td>
              <td width="79%"><span id="akibatInsiden"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Tindakan dan Hasil</td>
              <td width="1%">:</td>
              <td width="79%"><span id="tindaknDanhasil"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Petugas Tindakan</td>
              <td width="1%">:</td>
              <td width="79%"><span id="petugasTindakan"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Kejadian sama pernah terjadi?</td>
              <td width="1%">:</td>
              <td width="79%"><span id="kejadianSama"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Nama Pelapor</td>
              <td width="1%">:</td>
              <td width="79%"><span id="pelapor"></span></td>
            </tr>
            <tr>
              <td width="20%" class="text text-bold">Grading</td>
              <td width="1%">:</td>
              <td width="79%"><span id="warna">
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-aqua" href="javascript::" id="gBiru" data="BIRU" style="display: none;"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-yellow" href="javascript::" id="gKuning" data="KUNING" style="display: none;"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-green" href="javascript::" id="gHijau" data="HIJAU" style="display: none;"><i class="fa fa-square"></i></a></li>
                  <li><a class="text-red" href="javascript::" id="gMerah" data="MERAH" style="display: none;"><i class="fa fa-square"></i></a></li>
                </ul>
              </span></td>
            </tr>
          </table>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-notify-master/bootstrap-notify.min.js"></script> -->
  <script>

    $(document).ready(function () {
      show();

      $("#checkAll").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
      });
    });

    function show(){
      $('#example1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "ajax": {
          url : "<?php echo site_url('kp/ajax_get_data');?>",
          type : 'GET'
        },
        "columnDefs": [
        {"width": "5%", "targets": 0},
        {"width": "5%", "targets": 1},
        {"width": "10%", "targets": 2},
        {"width": "15%", "targets": 3},
        {"width": "30%", "targets": 4},
        {"width": "20%", "targets": 5},
        {"width": "15%", "targets": 6},
        { 
          "targets": [ 0,1,-1 ],
          "orderable": false, 
        }],
        "columns": [
        { "data": "chk" },
        { "data": "grade" },
        { "data": "jenis" },
        { "data": "tanggal" },
        { "data": "insiden" },
        { "data": "pelapor" },
        { "data": "event" }
        ]
        

      });
    }

    function reshow(){
      $('#example1').dataTable().fnDestroy();
      show();
    }

    function delete_dt(id)
    {
      if(confirm('yakin akan menghapus data ini?'))
      {
       $.ajax({
        url : "<?php echo base_url('kp/ajax_delete/')?>"+id,
        type: "POST",
        success: function(data){
          console.log(data);
          reshow();
        },
        error: function(a,b,c){
          console.log(a,b,c);
        }
      });
     }
   }

   function detail_show(id){
    $('#modal-insiden').modal('show');
    $('.modal-title').text('Detail Insiden Keselamatan Pasien');
    $.ajax({
      url : "<?php echo site_url('kp/ajax_edit/')?>" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        var grd=data.grading;
        if(grd=='KUNING'){
          document.getElementById('gKuning').style.display = 'block';
          document.getElementById('gMerah').style.display = 'none';
          document.getElementById('gHijau').style.display = 'none';
          document.getElementById('gBiru').style.display = 'none';
        }else if(grd=='MERAH'){
          document.getElementById('gKuning').style.display = 'none';
          document.getElementById('gMerah').style.display = 'block';
          document.getElementById('gHijau').style.display = 'none';
          document.getElementById('gBiru').style.display = 'none';
        }else if(grd=='HIJAU'){
          document.getElementById('gKuning').style.display = 'none';
          document.getElementById('gMerah').style.display = 'none';
          document.getElementById('gHijau').style.display = 'block';
          document.getElementById('gBiru').style.display = 'none';
        }else if(grd=='BIRU'){
          document.getElementById('gKuning').style.display = 'none';
          document.getElementById('gMerah').style.display = 'none';
          document.getElementById('gHijau').style.display = 'none';
          document.getElementById('gBiru').style.display = 'block';
        }

        $('#nama_pasien').text(data.p_nm);
        $('#no_rm').text(data.p_rm);
        $('#umur').text(data.p_age);
        $('#gender').text(data.p_gender);
        $('#jaminan').text(data.p_asuransi);
        $('#tanggalMasuk').text(data.p_date_in);
        $('#tanggalInsiden').text(data.i_date);
        $('#insiden').text(data.i_title);
        $('#kronologi').text(data.i_kronologi);
        $('#jenis').text(data.i_tp);
        $('#pelaporPertama').text(data.i_pelapor);
        $('#terjadiPada').text(data.i_victim);
        $('#lokasiInsiden').text(data.i_lokasi);
        $('#unitTerkait').text(data.i_unit_terkait);
        $('#kasusPenyakit').text(data.penyakit);
        $('#akibatInsiden').text(data.dampak);
        $('#tindaknDanhasil').text(data.i_hasil);
        $('#petugasTindakan').text(data.i_paramedis);
        $('#kejadianSama').text(data.i_solution);
        $('#pelapor').text(data.pelapor_nm);
        // $('#warna').text(data.grading);
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error get data from ajax');
      }
    });
  }

  function send_data()
  {
    var user_lv='<?php echo $this->session->userdata('user_lv'); ?>';
    var list_id = [];
    $(".data-check:checked").each(function() {
      list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
      // alert(user_lv);
      if(confirm('Are you sure to send this '+list_id.length+' data?'))
      {
        $.ajax({
          type: "POST",
          data: {id:list_id,lv:user_lv},
          url: "<?php echo site_url('kp/ajax_send')?>",
          dataType: "JSON",
          success: function(data)
          {
            if(data.status)
            {
              reshow();
            }
            else
            {
              alert('Failed.');
            }

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Oops...!!! Error sending data');
          }
        });
      }
    } 
    else
    {
      alert('no data selected');
    }
  }

</script>
