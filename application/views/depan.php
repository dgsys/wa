<script type="text/javascript">
  function apiwa() {
    $('#wahariini').DataTable({
      "bProcessing": true,
      "scrollY": 350,
      "scrollX": true,
      "scrollCollapse": true,
      "bServerside": true,
      "sAjaxSource": "<?php echo site_url('depan/apiantrianwa'); ?>",
      "fnServerData": function(sSource, aoData, fnCallback) {
        $.ajax({
          "dataType": 'json',
          "type": "POST",
          "url": sSource,
          "success": fnCallback
        });
      },
      "columns": [{
          "data": "no"
        },
        {
          "data": "no_rm"
        },
        {
          "data": "pasien_nm"
        },
        {
          "data": "alamat"
        },
        {
          "data": "medunit_nm"
        },
        {
          "data": "dr_nm"
        },
        {
          "data": "tgl_daftar"
        },
        {
          "data": "no_antrian_tpp"
        },
        {
          "data": "no_wa"
        }
      ],
      "footerCallback": function(row, data, start, end, display) {}
    });
  };


  $(document).ready(function() {
    var esok = new Date();
    esok.setDate(esok.getDate() + 1);
    // alert(d);
    var esok2 = new Date();
    esok2.setDate(esok2.getDate() + 2);
    $('.date-picker').datepicker({
      autoclose: true,
      responsive: true,
      format: "dd-mm-yyyy",
      todayHighlight: true,
      todayBtn: true,
      todayHighlight: true,
      startDate: esok,
      endDate: esok2
    });
    $(".date-picker").datepicker("update", esok);
    apiwa();
  });

  function reload_table() {
    $('#wahariini').dataTable().fnDestroy();
    apiwa();
  }

  function wa_cetak() {
          // var tanggal = $("#datepicker1").val();
          window.open('<?php echo site_url('depan/antrian_wa_cetak'); ?>/' );
      }
</script>
<div class="row">
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <i class="fa fa-wheelchair"></i>
        <h3 class="box-title"> Antrian Pendaftaran WA hari ini <b></b></h3>
        <div class="margin pull-right">
          <div class="btn-group">
            <button type="button" class="btn btn-info" onclick="reload_table()"><i class="fa fa-refresh">&nbsp;</i>Refresh Tabel</button>
          </div>
          <div class="btn-group">
            <button type="button" class="btn btn-warning" id="btn_simpan" onclick="wa_cetak()"><i class="fa fa-print">&nbsp;</i>Cetak</button>
          </div>
        </div>
      </div>
      <div class="box-body">

        <table id="wahariini" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>No RM</th>
              <th>Nama</th>
              <th width="20%">Alamat</th>
              <th>Klinik</th>
              <th>Dokter</th>
              <th>Tanggal Daftar</th>
              <th width="10%">Antrian TPP</th>
              <th>No WA</th>
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

</div>
<br />



<!-- <h2>Basic Form</h2>
  <p>Fill the form and submit it.</p>
  <div style="margin:20px 0;"></div>
  <div class="easyui-panel" title="New Topic" style="width:100%;max-width:400px;padding:30px 60px;">
    <form id="ff" method="post">
      <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="name" style="width:100%" data-options="label:'Name:',required:true">
      </div>
      <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="email" style="width:100%" data-options="label:'Email:',required:true,validType:'email'">
      </div>
      <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="subject" style="width:100%" data-options="label:'Subject:',required:true">
      </div>
      <div style="margin-bottom:20px">
        <input class="easyui-textbox" name="message" style="width:100%;height:60px" data-options="label:'Message:',multiline:true">
      </div>
      <div style="margin-bottom:20px">
        <select class="easyui-combobox" name="language" label="Language" style="width:100%"><option value="ar">Arabic</option><option value="bg">Bulgarian</option><option value="ca">Catalan</option><option value="zh-cht">Chinese Traditional</option><option value="cs">Czech</option><option value="da">Danish</option><option value="nl">Dutch</option><option value="en" selected="selected">English</option><option value="et">Estonian</option><option value="fi">Finnish</option><option value="fr">French</option><option value="de">German</option><option value="el">Greek</option><option value="ht">Haitian Creole</option><option value="he">Hebrew</option><option value="hi">Hindi</option><option value="mww">Hmong Daw</option><option value="hu">Hungarian</option><option value="id">Indonesian</option><option value="it">Italian</option><option value="ja">Japanese</option><option value="ko">Korean</option><option value="lv">Latvian</option><option value="lt">Lithuanian</option><option value="no">Norwegian</option><option value="fa">Persian</option><option value="pl">Polish</option><option value="pt">Portuguese</option><option value="ro">Romanian</option><option value="ru">Russian</option><option value="sk">Slovak</option><option value="sl">Slovenian</option><option value="es">Spanish</option><option value="sv">Swedish</option><option value="th">Thai</option><option value="tr">Turkish</option><option value="uk">Ukrainian</option><option value="vi">Vietnamese</option></select>
      </div>
    </form>
    <div style="text-align:center;padding:5px 0">
      <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()" style="width:80px">Submit</a>
      <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()" style="width:80px">Clear</a>
    </div>
  </div>
  <script>
   
    function submitForm(){
      $('#ff').form('submit');
    }
    function clearForm(){
      $('#ff').form('clear');
    }
  </script> -->