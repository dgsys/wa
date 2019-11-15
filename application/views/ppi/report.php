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
                      <button type="button" class="btn btn-block btn-primary" onclick="ppi_periode()">Tampilkan</button>
                    </div>
                    <!-- <div class="col-xs-2">
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
                    <th width="5%" rowspan="2" style="text-align: center;">NO</th>
                    <th width="10%" rowspan="2" style="text-align: center;">TANGGAL</th>
                    <th width="10%" rowspan="2" style="text-align: center;">JUMLAH PASIEN</th>
                    <th colspan="5" style="text-align: center;">JENIS ALAT YANG TERPASANG/TINDAKAN</th>
                    <th colspan="6" style="text-align: center;">JENIS INFEKSI YANG TERJADI</th>
                  </tr>
                  <tr>
                    <th style="text-align: center;">IVL</th>
                    <th style="text-align: center;">DC</th>
                    <th style="text-align: center;">NGT</th>
                    <th style="text-align: center;">BEDAH</th>
                    <th style="text-align: center;">TIRAH BARING</th>
                    <th style="text-align: center;">PHLEBITIS</th>
                    <th style="text-align: center;">ISK</th>
                    <th style="text-align: center;">ILO</th>
                    <th style="text-align: center;">PNEUMONIA</th>
                    <th style="text-align: center;">DEKUBITUS</th>
                    <th style="text-align: center;">SEPSIS</th>
                  </tr>
                </thead>
                 <tfoot>
                    <tr>
                      <th colspan="2" style="text-align:right">Total:</th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                      <th ></th>
                    </tr>        
                  </tfoot>
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

                      <!-- <div class="col-xs-2">
                          <button type="button" class="btn btn-block btn-primary" onclick="tampil_grafik()">Tampilkan</button>
                      </div> -->
                      <div class="col-xs-1">
                      <!-- <button type="button" class="btn btn-block btn-success" onclick="clear_grafik()">Clear</button> -->
                    </div>

                    <div class="col-xs-2">
                          <button type="button" class="btn btn-block btn-primary" onclick="tampil_grafik()">Tampilkan</button>
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
             <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Line Chart</h3> -->
            </div>
            <div class="box-body">
              <!-- <div class="chart"> -->
                <canvas id="mycanvas" style="height:250px"></canvas>
              <!-- </div> -->
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


   
       function ppi_periode(){
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
          "sAjaxSource"   : "<?php echo site_url('laporan_ppi/ppi_tabel_periode/');?>" ,
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
        { "data": "tanggal" },
        { "data": "pasien_qty" },
        { "data": "ivl" },
        { "data": "dc" },
        { "data": "ngt" },
        { "data": "bedah" },
        { "data": "tirah_baring" },
        { "data": "phlebitis" },
        { "data": "isk" },
        { "data": "ilo" },
        { "data": "pneumonia" },
        { "data": "dekubitus" },
        { "data": "sepsis" }
        ]
         ,
            "footerCallback": function ( row, data, start, end, display ) { 
              var api = this.api(), data;
       // Remove the formatting to get integer data for summation
                  var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 
            // Total over this page
                pasien_qty = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 
                 lvl = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 
                 dc = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                 ngt = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                 bedah = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );   
                 tirah_baring = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 
                 phlebitis = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 
                 isk = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                 ilo = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                 pneumonia = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );   
                 dekubitus = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                 sepsis = api
                .column( 13, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );   
            // Update footer
            $( api.column( 2 ).footer() ).html(
                pasien_qty  
            );
            $( api.column( 3 ).footer() ).html(
                lvl  
            );
           $( api.column( 4 ).footer() ).html(
                dc  
            );
           $( api.column( 5 ).footer() ).html(
                ngt  
            );
           $( api.column( 6 ).footer() ).html(
                bedah  
            );
            $( api.column( 7 ).footer() ).html(
                tirah_baring  
            );
           $( api.column( 8 ).footer() ).html(
                phlebitis  
            );
           $( api.column( 9 ).footer() ).html(
                isk  
            );
           $( api.column( 10 ).footer() ).html(
                ilo  
            );
            $( api.column( 11 ).footer() ).html(
                pneumonia  
            );
           $( api.column( 12 ).footer() ).html(
                dekubitus  
            );
           $( api.column( 13 ).footer() ).html(
                sepsis  
            );
           
             }     
        } );    
      };


    
        function tes(){
        var date = $('#datepicker1').datepicker('getDate'),
            day  = date.getDate(),  
            month = date.getMonth() + 1,              
            year =  date.getFullYear();
        alert(day + '-' + month + '-' + year);
           }

      function tampil_grafik()
        {
              $.ajax({
              method: 'POST',
              url: '<?php echo site_url('laporan_ppi/grafik_ppi/');?>',
              dataType: 'json',
              data:{
                        tanggal_awal: $("#datepicker3").val(),
                        tanggal_akhir : $("#datepicker4").val(),
                        unit: $("#state2").val()
                    },
              success: function (response) {
                var label = []
                var rate_phlebitis = []
                var rate_isk = []
                var rate_ilo = []
                var rate_pneumonia = []
                var rate_dekubitus = []
                var backcolor = []
                var bordercolor =[]
                //ambil data
                response.forEach(function (element) {
                  label.push(element.bulan)
                  rate_phlebitis.push(element.rate_phlebitis)
                  rate_isk.push(element.rate_isk)
                  rate_ilo.push(element.rate_ilo)
                  rate_pneumonia.push(element.rate_pneumonia)
                  rate_dekubitus.push(element.rate_dekubitus)
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
                    label: 'Rate Phlebitis',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: rate_phlebitis
                  },
                  {
                    label: 'Rate ISK',
                    backgroundColor: window.chartColors.yellow,
                    borderColor: window.chartColors.yellow,
                    data: rate_isk
                  }
                  ,{
                    label: 'Rate ILO',
                    backgroundColor: window.chartColors.green,
                    borderColor: window.chartColors.green,
                    data: rate_ilo
                  }
                  ,{
                    label: 'Rate Pneumonia',
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: rate_pneumonia
                  },{
                    label: 'Rate Dekubitus',
                    backgroundColor: window.chartColors.black,
                    borderColor: window.chartColors.black,
                    data: rate_dekubitus
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
                              text:  ['Laporan PPI','Periode ' + tgl1 +' sampai ' + tgl2]
                            }
                          }
                });
               // barGraph.destroy()
               barGraph.update()
              }
            });         
        }

      
</script>


