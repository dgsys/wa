<!--  <section class="content-header">
<h4>
<?php echo $title; ?>
<small></small>
</h4>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>index.php/depan"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active"><a href="#"></a></li>
</ol>
</section> -->

<br>&nbsp;</br>
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom tab-info">

      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Tabel</a></li>
        <li><a href="#tab_2" data-toggle="tab">Grafik</a></li>
      </ul>

      <div class="tab-content">

        <div class="tab-pane active" id="tab_1">
          <div class="box">
            <div class="box-header">
              <div class="box box-danger">            
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-1">
                      <label  class="col-sm-2 control-label">Periode</label>
                    </div>
                    <div class="col-xs-2">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right date-picker" id="datepicker1" name="datepicker1">
                      </div>
                    </div>
                    <div class="col-xs-1 ">
                      <label  class="col-sm-1 control-label">hingga</label>
                    </div>
                    <div class="col-xs-2">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right date-picker"  id="datepicker2" name="datepicker2">
                      </div>
                    </div>
                    <div class="col-xs-2">
                      <select class="easyui-combobox" name="state" id="state" label="" labelPosition="top" style="width:100%;">
                        <?php if($this->session->userdata('unit_cd') == null){ ?>
                        <option value="">Semua</option> <?php }else{    }?>
                        <?php foreach($unit_->result() as $row):?>
                          <option value="<?php echo $row->unit_cd;?>"><?php echo $row->unit_nm;?></option>
                        <?php endforeach;?>             
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-block btn-primary" onclick="ikp_periode()">Tampilkan</button>
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-block btn-success" onclick="tampil()">Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>              <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="10%">Grade</th>
                    <th width="10%">Jenis</th>
                    <th>Tanggal</th>
                    <th>Insiden</th>
                    <th>Pelapor</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
          <!-- /.tab-pane 1-->

          <div class="tab-pane" id="tab_2">
            <div class="row">
              <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <div class="box box-success">            
                  <div class="box-body">
                    <div class="row">
                      <div class="col-xs-1">
                        <label  class="col-sm-2 control-label">Periode</label>
                      </div>
                      <div class="col-xs-2">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right date-picker" id="datepicker3" name="datepicker3">
                        </div>
                      </div>
                      <div class="col-xs-1 ">
                      <label  class="col-sm-1 control-label">hingga</label>
                      </div>
                      <div class="col-xs-2">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right date-picker" id="datepicker4" name="datepicker4">
                        </div>
                      </div>
                      <div class="col-xs-2">
                        <select class="easyui-combobox" name="state2" id="state2" label="" labelPosition="top" style="width:auto;">
                            <?php if($this->session->userdata('unit_cd') == null){ ?>
                            <option value="">Semua</option> <?php }else{    }?>
                            <?php foreach($unit_->result() as $row):?>
                              <option value="<?php echo $row->unit_cd;?>"><?php echo $row->unit_nm;?></option>
                            <?php endforeach;?>             
                          </select>
                          <!-- </div> -->
                        </div>

                    
                      <div class="col-xs-1">
                      <!-- <button type="button" class="btn btn-block btn-success" onclick="clear_grafik()">Clear</button> -->
                    </div>

                    <div class="col-xs-2">
                          <button type="button" class="btn btn-block btn-primary" onclick="tampil_grafik_all()">Tampilkan</button>
                      </div> 

                    </div>
                  </div>
                </div>
              </div>
                    <!-- /.box-header -->
                    <!-- <div class="box-body">
                <canvas id="mycanvas"></canvas>          
                    </div> -->


            </div>
          </div>
                             <!-- JENIS   -->
          <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Jenis Kejadian</h3> 
            </div>
            <div class="box-body">
                <canvas id="mycanvas" style="height:250px"></canvas>
             </div>
            <!-- /.box-body -->
          </div>
          </div>
         
                            <!-- GRADE   -->
          <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Berdasarkan Grade</h3> 
            </div>
            <div class="box-body">
                <canvas id="mycanvas2" style="height:250px"></canvas>
             </div>
            <!-- /.box-body -->
          </div>
          </div>
                            
                             <!-- INSIDEN   -->
          <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Insiden</h3> 
            </div>
            <div class="box-body">
                <canvas id="mycanvas3" style="height:250px"></canvas>
             </div>
            <!-- /.box-body -->
          </div>
          </div>


          

          </div>
          </div><!-- /.tab-pane 2 -->
      </div>
    </div>
  </div>
</div>

 

<!-- Bootstrap 3.3.7 -->
<script type="text/javascript">
  $(document).ready(function () {
 $('.date-picker').datepicker({
  autoclose: true,
  responsive : true,
  format: "dd-mm-yyyy",
  todayHighlight: true,
  todayBtn: true,
  todayHighlight: true,
      });
  $(".date-picker").datepicker("update", new Date());

 $('#example1').DataTable();

 
});//akir doc ready


   
       function ikp_periode(){
        $('#example1').dataTable().fnDestroy();
        var tanggal_awal    = $("#datepicker1").val();
        var tanggal_akhir   = $("#datepicker2").val();
        var unit = $("#state").val();
        var string  = "tanggal_awal="+tanggal_awal+"& tanggal_akhir="+tanggal_akhir+"& unit="+unit;

        $('#example1').DataTable( {
          "bProcessing"   : true,
          "scrollY"       :  350,
          "scrollX" :        true,
          "scrollCollapse": true,
          "bServerside":true,
          "sAjaxSource"   : "<?php echo site_url('laporan/ikp_tabel_periode/');?>" ,
          "fnServerData": function ( sSource, aoData, fnCallback ) {
            $.ajax( {
            "dataType": 'json',
            "type": "POST",
            "url": sSource,
            "data": string,
            "success": fnCallback
          } );
         },
         "columns": [
        { "data": "no" },
        { "data": "warna" },
        { "data": "i_tp" },
        { "data": "i_date" },
        { "data": "i_title" },
        { "data": "i_pelapor" }
        ]
         ,
            "footerCallback": function ( row, data, start, end, display ) {  }     
        } );    
      };


    
        function tes(){
        var date = $('#datepicker1').datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
        alert(day + '-' + month + '-' + year);
           }
 function tampil_grafik_all(){
 tampil_grafik();
 tampil_grafik_gradding();
 tampil_grafik_insiden();
 }
      function tampil_grafik()
        {
              $.ajax({
              method: 'POST',
              url: '<?php echo site_url('laporan/grafik_ikp/');?>',
              dataType: 'json',
              data:{
                        tanggal_awal: $("#datepicker3").val(),
                        tanggal_akhir : $("#datepicker4").val(),
                        unit: $("#state2").val()
                    },
              success: function (response) {
                var label = []
                var KTD = []
                var KNC = []
                var KTC = []
                var KPC = []
                var Sentinel = []
                var backcolor = []
                var bordercolor =[]
                //ambil data
                response.forEach(function (element) {
                  label.push(element.bulan)
                  KTD.push(element.KTD)
                  KNC.push(element.KNC)
                  KTC.push(element.KTC)
                  KPC.push(element.KPC)
                  Sentinel.push(element.Sentinel)
                  var r = Math.random() * 255;
                  r = Math.round(r);
                  var g = Math.random() * 255;
                  g = Math.round(g);
                  var b = Math.random() * 255;
                  b = Math.round(b);
                  backcolor.push('rgba('+r+','+g+','+b+',0.3)');
                  bordercolor.push('rgba('+r+','+g+','+b+',1)');
                })
                // bikin vriabel data
                var chartdata = {
                  labels: label,
                  datasets: [
                  {
                    label: 'KTD',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: KTD
                  },
                  {
                    label: 'KNC',
                    backgroundColor: window.chartColors.yellow,
                    borderColor: window.chartColors.yellow,
                    data: KNC
                  }
                  ,{
                    label: 'KTC',
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    data: KTC
                  }
                  ,{
                    label: 'KPC',
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: KPC
                  },{
                    label: 'Sentinel',
                    backgroundColor: window.chartColors.black,
                    borderColor: window.chartColors.black,
                    data: Sentinel
                  }
                  ]
                };

                var graphTarget =  document.getElementById('mycanvas').getContext('2d');
                var tgl1 = $('#datepicker3').val();
               var tgl2 = $('#datepicker4').val();

                if(window.barGraph != undefined)
                  window.barGraph.destroy();
                window.barGraph = new Chart(graphTarget, {
                  // responsive : true,
                  type: 'bar',
                  data: chartdata,
                  options: {
                            responsive: true,
                            legend: {
                              position: 'top',
                            },
                            title: {
                              display: true,
                              text:  ['Laporan IKP Per Jenis ','Periode ' + tgl1 +' sampai ' + tgl2]
                            }
                          }
                });
						Chart.scaleService.updateScaleDefaults('linear', {
						ticks: {
						min: 0,
						autoSkip: false
						}
						});

               // barGraph.destroy()
               barGraph.update()
              }
            });         
        }

function tampil_grafik_gradding()
        {
              $.ajax({
              method: 'POST',
              url: '<?php echo site_url('laporan/grafik_ikp_gradding/');?>',
              dataType: 'json',
              data:{
                        tanggal_awal: $("#datepicker3").val(),
                        tanggal_akhir : $("#datepicker4").val(),
                        unit: $("#state2").val()
                    },
              success: function (response) {
                var label = []
                var MERAH = []
                var KUNING = []
                var HIJAU = []
                var BIRU = []
                var backcolor = []
                var bordercolor =[]
                //ambil data
                response.forEach(function (element) {
                  label.push(element.bulan)
                  MERAH.push(element.MERAH)
                  KUNING.push(element.KUNING)
                  HIJAU.push(element.HIJAU)
                  BIRU.push(element.BIRU)
                  var r = Math.random() * 255;
                  r = Math.round(r);
                  var g = Math.random() * 255;
                  g = Math.round(g);
                  var b = Math.random() * 255;
                  b = Math.round(b);
                  backcolor.push('rgba('+r+','+g+','+b+',0.3)');
                  bordercolor.push('rgba('+r+','+g+','+b+',1)');
                })
                // bikin vriabel data
                var chartdata = {
                  labels: label,
                  datasets: [
                  {
                    label: 'MERAH',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: MERAH
                  },
                  {
                    label: 'KUNING',
                    backgroundColor: window.chartColors.yellow,
                    borderColor: window.chartColors.yellow,
                    data: KUNING
                  }
                  ,{
                    label: 'HIJAU',
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    data: HIJAU
                  }
                  ,{
                    label: 'BIRU',
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: BIRU
                  }
                  ]
                };

                var graphTarget =  document.getElementById('mycanvas2').getContext('2d');
                var tgl1 = $('#datepicker3').val();
               var tgl2 = $('#datepicker4').val();

                if(window.barGraph2 != undefined)
                  window.barGraph2.destroy();
                window.barGraph2 = new Chart(graphTarget, {
                  // responsive : true,
                  type: 'bar',
                  data: chartdata,
                  options: {
                            responsive: true,
                            legend: {
                              position: 'top',
                            },
                            title: {
                              display: true,
                              text:  ['Laporan IKP Per Gradding ','Periode ' + tgl1 +' sampai ' + tgl2]
                            }
                          }
                });
               // barGraph.destroy()
               Chart.scaleService.updateScaleDefaults('linear', {
						ticks: {
						min: 0
						}
						});
               barGraph2.update()
              }
            });         
        }
function tampil_grafik_insiden()
        {
              $.ajax({
              method: 'POST',
              url: '<?php echo site_url('laporan/grafik_ikp_insiden/');?>',
              dataType: 'json',
              data:{
                        tanggal_awal: $("#datepicker3").val(),
                        tanggal_akhir : $("#datepicker4").val(),
                        unit: $("#state2").val()
                    },
              success: function (response) {
                var label = []
                var i_title = []
                var jumlah = []
                var backcolor = []
                var bordercolor =[]
                //ambil data
                response.forEach(function (element) {
                  label.push(element.bulan)
                  i_title.push(element.i_title)
                  jumlah.push(element.jumlah)
                  var r = Math.random() * 255;
                  r = Math.round(r);
                  var g = Math.random() * 255;
                  g = Math.round(g);
                  var b = Math.random() * 255;
                  b = Math.round(b);
                  backcolor.push('rgba('+r+','+g+','+b+',0.3)');
                  bordercolor.push('rgba('+r+','+g+','+b+',1)');
                })
                // bikin vriabel data
                var chartdata = {
                  labels: i_title,
                  datasets: [
                  {
                    label: '',
                    backgroundColor: backcolor,
                    borderColor: bordercolor,
                    data:jumlah
                  }
                  ]
                };

                var graphTarget =  document.getElementById('mycanvas3').getContext('2d');
                var tgl1 = $('#datepicker3').val();
               var tgl2 = $('#datepicker4').val();

                if(window.barGraph3 != undefined)
                  window.barGraph3.destroy();
                window.barGraph3 = new Chart(graphTarget, {
                  responsive : true,
                  type: 'bar',
                  data: chartdata,
                  options: {
                            responsive: true,
                            legend: {
                              position: 'top',
                            },
                            title: {
                              display: true,
                              text:  ['Laporan IKP Per Insiden','Periode ' + tgl1 +' sampai ' + tgl2]
                            }
                          }
                });
						Chart.scaleService.updateScaleDefaults('linear', {
						ticks: {
						min: 0
						}
						});
              Chart.defaults.global.maintainAspectRatio = false;
               // barGraph.destroy()
               barGraph3.update()
              }
            });         
        }

      
</script>

