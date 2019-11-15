<!-- <br>&nbsp;</br> -->
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
                      <button type="button" class="btn btn-block btn-primary" onclick="k3_periode()">Tampilkan</button>
                    </div>
                   <!--  <div class="col-xs-2">
                      <button type="button" class="btn btn-block btn-success" onclick="tampil()">Excel</button>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>              <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                   <tr>
                    <th width="5%" rowspan="2" style="text-align: center;vertical-align: top;" >No</th>
                    <th colspan="2" style="text-align: center;">Waktu</th>
                    <th colspan="2" style="text-align: center;">Karyawan</th>
                    <th colspan="2" style="text-align: center;">Kejadian</th>
                     <th rowspan="2" style="text-align: center;vertical-align: top;" >Penyebab</th>
                      <th rowspan="2" style="text-align: center;vertical-align: top;">Tindakan yang dilakukan</th>
                       <th rowspan="2" style="text-align: center;vertical-align: top;">Keterangan</th>
                  </tr>
                  <tr>
                    <th style="text-align: center;">Tanggal </th>
                    <th style="text-align: center;">Jam Mulai Kerja</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Jenis</th>
                    <th style="text-align: center;">Kategori</th>
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
              <h3 class="box-title">Berdasarkan Kategori</h3> 
            </div>
            <div class="box-body">
                <canvas id="mycanvas" style="height:250px"></canvas>
             </div>
            <!-- /.box-body -->
          </div>
          </div>
         
                            <!-- GRADE   -->
          <!-- <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Berdasarkan Grade</h3> 
            </div>
            <div class="box-body">
                <canvas id="mycanvas2" style="height:250px"></canvas>
             </div>
          </div>
          </div> -->
                            
                             <!-- INSIDEN   -->
          <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Berdasarkan Jenis</h3> 
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
   
  function k3_periode()
  {
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
      "sAjaxSource"   : "<?php echo site_url('laporan_k3/k3_tabel_periode/');?>" ,
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
      { "data": "accident_date" },
      { "data": "activity_date" },
      { "data": "name" },
      { "data": "status" },
      { "data": "type" },
      { "data": "warna_category" },
      { "data": "cause" },
      { "data": "action" },
      { "data": "summary" }
      ]
      ,
      "footerCallback": function ( row, data, start, end, display ) {  }     
    } );    
  };


 function tampil_grafik_all(){
 tampil_grafik();
 // tampil_grafik_gradding();
 tampil_k3_type();
 }
      function tampil_grafik()
        {
          $.ajax({
            method: 'POST',
            url: '<?php echo site_url('laporan_k3/grafik_k3_kategory/');?>',
            dataType: 'json',
            data:{
              tanggal_awal: $("#datepicker3").val(),
              tanggal_akhir : $("#datepicker4").val(),
              unit: $("#state2").val()
            },
            success: function (response) {
              var label = []
              var Accident = []
              var Incident = []
              var Nearmiss = []
              var backcolor = []
              var bordercolor =[]
                //ambil data
                response.forEach(function (element) {
                  label.push(element.bulan)
                  Accident.push(element.Accident)
                  Incident.push(element.Incident)
                  Nearmiss.push(element.Nearmiss)
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
                    label: 'Accident',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: Accident
                  },
                  {
                    label: 'Incident',
                    backgroundColor: window.chartColors.yellow,
                    borderColor: window.chartColors.yellow,
                    data: Incident
                  }
                  ,{
                    label: 'Nearmiss',
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    data: Nearmiss
                  }
                  ]
                };
                var graphTarget =  document.getElementById('mycanvas').getContext('2d');
                var tgl1 = $('#datepicker3').val();
                var tgl2 = $('#datepicker4').val();
                 var nama = $("#state2 option:selected").text();
              if (nama == 'Semua') {
                nama = 'RSUD';
              }else{
                nama = nama;
              };
                if(window.barGraph != undefined)
                  window.barGraph.destroy();
                window.barGraph = new Chart(graphTarget, {
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
                      text:  ['Laporan K3 Per Kategori ','Periode ' + tgl1 +' sampai ' + tgl2,'Unit '+nama]
                    }
                  }
                });
                Chart.scaleService.updateScaleDefaults('linear', {
                  ticks: {
                    min: 0,
                    autoSkip: false
                  }
						});               // barGraph.destroy()
                barGraph.update()
              }
            });         
        }

        // function tampil_grafik_gradding()
        // {
        //   $.ajax({
        //     method: 'POST',
        //     url: '<?php echo site_url('laporan/grafik_ikp_gradding/');?>',
        //     dataType: 'json',
        //     data:{
        //       tanggal_awal: $("#datepicker3").val(),
        //       tanggal_akhir : $("#datepicker4").val(),
        //       unit: $("#state2").val()
        //     },
        //     success: function (response) {
        //       var label = []
        //       var MERAH = []
        //       var KUNING = []
        //       var HIJAU = []
        //       var BIRU = []
        //       var backcolor = []
        //       var bordercolor =[]
        //         //ambil data
        //         response.forEach(function (element) {
        //           label.push(element.bulan)
        //           MERAH.push(element.MERAH)
        //           KUNING.push(element.KUNING)
        //           HIJAU.push(element.HIJAU)
        //           BIRU.push(element.BIRU)
        //           var r = Math.random() * 255;
        //           r = Math.round(r);
        //           var g = Math.random() * 255;
        //           g = Math.round(g);
        //           var b = Math.random() * 255;
        //           b = Math.round(b);
        //           backcolor.push('rgba('+r+','+g+','+b+',0.3)');
        //           bordercolor.push('rgba('+r+','+g+','+b+',1)');
        //         })
        //         var chartdata = {
        //           labels: label,
        //           datasets: [
        //           {
        //             label: 'MERAH',
        //             backgroundColor: window.chartColors.red,
        //             borderColor: window.chartColors.red,
        //             data: MERAH
        //           },
        //           {
        //             label: 'KUNING',
        //             backgroundColor: window.chartColors.yellow,
        //             borderColor: window.chartColors.yellow,
        //             data: KUNING
        //           }
        //           ,{
        //             label: 'HIJAU',
        //             backgroundColor: window.chartColors.green,
        //             borderColor: window.chartColors.green,
        //             data: HIJAU
        //           }
        //           ,{
        //             label: 'BIRU',
        //             backgroundColor: window.chartColors.blue,
        //             borderColor: window.chartColors.blue,
        //             data: BIRU
        //           }
        //           ]
        //         };
        //         var graphTarget =  document.getElementById('mycanvas2').getContext('2d');
        //         var tgl1 = $('#datepicker3').val();
        //         var tgl2 = $('#datepicker4').val();
        //         if(window.barGraph2 != undefined)
        //           window.barGraph2.destroy();
        //         window.barGraph2 = new Chart(graphTarget, {
        //           responsive : true,
        //           type: 'bar',
        //           data: chartdata,
        //           options: {
        //             responsive: true,
        //             legend: {
        //               position: 'top',
        //             },
        //             title: {
        //               display: true,
        //               text:  ['Laporan IKP Per Gradding ','Periode ' + tgl1 +' sampai ' + tgl2]
        //             }
        //           }
        //         });
        //         Chart.scaleService.updateScaleDefaults('linear', {
        //           ticks: {
        //             min: 0
        //           }
        //         });
        //         barGraph2.update()
        //       }
        //     });         
        // }

        function tampil_k3_type()
        {
          $.ajax({
            method: 'POST',
            url: '<?php echo site_url('laporan_k3/grafik_k3_type/');?>',
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
              response.forEach(function (element) {
                label.push(element.bulan)
                i_title.push(element.tipe)
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
              var nama = $("#state2 option:selected").text();
              if (nama == 'Semua') {
                nama = 'RSUD';
              }else{
                nama = nama;
              };
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
                    text:  ['Laporan K3 Per tipe','Periode ' + tgl1 +' sampai ' + tgl2 ,' Unit ' + nama]
                  }
                }
              });
              Chart.scaleService.updateScaleDefaults('linear', {
                ticks: {
                  min: 0
                }
              });
              Chart.defaults.global.maintainAspectRatio = false;
              barGraph3.update()
            }
          });         
        }

      
</script>

