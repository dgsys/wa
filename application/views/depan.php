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

    function apiwatgl() {
      $('#watgl').dataTable().fnDestroy();
      var tanggal = $("#datepicker1").val();
      var string = "tanggal=" + tanggal;

      $('#watgl').DataTable({
        "bProcessing": true,
        "scrollY": 350,
        "scrollX": true,
        "scrollCollapse": true,
        "bServerside": true,
        "sAjaxSource": "<?php echo site_url('depan/apiantrianwatgl'); ?>",
        "fnServerData": function(sSource, aoData, fnCallback) {
          $.ajax({
            "dataType": 'json',
            "type": "POST",
            "url": sSource,
            "data": string,
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

      //fungsi combogrid
      jadwal();
      kosongkan();
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

      $('#watgl').DataTable();
      apiwa();
      jadwal();

    });

    function jadwal() {
      $(function() {
        var tanggal = $("#datepicker1").val();
        var string = "tanggal=" + tanggal;
        $('#cg').combogrid({
          panelWidth: 650,
          url: '<?php echo site_url('depan/apijadwal'); ?>/' + tanggal,
          idField: 'myfieldid',
          textField: 'nama',
          mode: 'remote',
          fitColumns: true,
          columns: [
            [{
                field: 'day_nm',
                title: 'Hari',
                width: 45
              },
              {
                field: 'medunit_nm',
                title: 'Poliklinik',
                width: 100
              },
              {
                field: 'dr_nm',
                title: 'Dokter',
                width: 130
              },
              // {field:'unitcost',title:'Unit Cost',align:'right',width:60},
              // {field:'attr1',title:'Attribute',width:150},
              // {field:'status',title:'Stauts',align:'center',width:60}
            ]
          ],
          loadFilter: function(data) {
            if ($.isArray(data)) {
              data = {
                total: data.length,
                rows: data
              };
            }
            $.map(data.rows, function(row) {
              row.myfieldid = row.medunit_cd + '/' + row.dr_cd;
              row.nama = row.medunit_nm + '  -  ' + row.dr_nm;
            });
            return data;
          }
        });
      });
    };

    function buka() {
      var detail = document.getElementById('detail');
      detail.style.display = 'block';
      // $('#pasien_nm').val('eko prasetyo');
    }

    function tutup() {
      var detail = document.getElementById('detail');
      detail.style.display = 'none';
      // $('#pasien_nm').val('eko prasetyo');
    }

    function getpasien() {
      var no_rm = $('#no_rm').val();
      //Ajax Load data from ajax
      $.ajax({
        url: '<?php echo site_url('depan/apipasien'); ?>/' + no_rm,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          if (!$.trim(data)) {
            alert('Data tidak ditemukan');
            kosongkan();
          } else {
            buka();
            var alamat = data[0]['alamat'] + ',' + data[0]['kelurahan'] + ',' + data[0]['kec'] + ',' + data[0]['Kota'];
            $('#pasien_cd').val(data[0]['pasien_cd']);
            $('#pasien_nm').val(data[0]['pasien_nm']);
            $('#alamat').val(alamat);
          }
          // alert(data[0]['pasien_nm']);
          // console.log(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error get data from ajax');
        }
      });
    }

    function kosongkan() {
      $('#form_wa')[0].reset();
      tutup();
    }

    function save_wa() {
      var poli = $('#cg').next().find('input').val();
      var pasien_cd = $('#pasien_cd').val();
      var no_wa = $('#no_wa').val();

      if (pasien_cd == '') {
        alert("Maaf,Silahkan isi no RM dan Klik tombol cari");
        $('#no_rm').focus();
        return false;
      }

      if (poli == '') {
        alert("Maaf, Pilih Poli");
        $('#tindakan_cd').next().find('input').focus();
        return false;
      }
      if (no_wa == '') {
        alert("Maaf,Silahkan isi No WA");
        $('#no_wa').focus();
        return false;
      }


      $('#btn_tindakan').text('saving...'); //change button text
      $('#btn_tindakan').attr('disabled', true); //set button disable 
      url = "<?php echo site_url('depan/ajax_add_wa') ?>";
      var tanggal = $("#datepicker1").val();
      var $form = $('form');
      var data = {
        'tanggal': tanggal
      };

      data = $form.serialize() + '&' + $.param(data);
      $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        success: function(data) {
          if (!$.trim(data)) {
            alert('Data tidak ditemukan');
            kosongkan();
            apiwatgl();
          } else {
            var antri = data[0]['no_antrian_tpp'];
            var pesan = 'Sukses Reservasi WA untuk :<br>' + 'Tanggal : ' + tanggal + '</br>Nomor Antrian TPP :' + antri;
            $.messager.show({
              title: 'INFO',
              msg: pesan,
              timeout: 7000,
              showType: 'slide',
              style: {
                left: '',
                right: 0,
                bottom: ''
              }
            });
          }
          kosongkan();
          apiwatgl();
          // console.log(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $.messager.show({
            title: 'ERROR',
            msg: 'gagal simpan data',
            timeout: 2000,
            showType: 'slide',
            style: {
              left: '',
              right: 0,
              bottom: ''
            }
          });
          kosongkan();
          apiwatgl();
          // console.log(data);
        }
      });
    }
  </script>
  <div class="row">

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-wheelchair"></i>
          <h3 class="box-title"> Booking Pendaftaran WA <b></b></h3><br /><br />
        </div>

        <div class="box-body">

          <div class="form-group">
            <div class="col-xs-2">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right date-picker" id="datepicker1" name="datepicker1">
              </div>
            </div>
            <div class="col-xs-2">
              <button type="button" class="btn btn-block btn-primary" onclick="apiwatgl()">Reservasi</button>
            </div>
          </div>
        </div>
        <hr>
        </hr>

        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pasien </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- <form class="form-horizontal"> -->
            <form action="#" id="form_wa" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="no_rm" class="col-sm-2 control-label">No RM</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="no_rm" placeholder="ketik No RM">
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-default" onclick="getpasien()">Cari</button>
                  </div>
                </div>

                <div id="detail" style="display:none;">
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="pasien_cd" name="pasien_cd" readonly>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="pasien_nm" name="pasien_nm" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                      <!-- <input type="text" class="form-control" id="alamat" readonly="readonly"> -->
                      <textarea class="form-control" rows="3" id="alamat" name="alamat" placeholder="" disabled></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="cg" class="col-sm-2 control-label">Poliklinik</label>
                  <div class="col-sm-10">
                    <input id="cg" name="cg" style="width:480px;height: 30px" class="form-control" type="text">
                  </div>
                </div>

                <div class="form-group">
                  <label for="no_rm" class="col-sm-2 control-label">No WA</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="no_wa" name="no_wa" placeholder="">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="margin pull-right">
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger" onclick="kosongkan()">Batal</button>
                  </div>
                  <div class="btn-group">
                    <button type="button" class="btn btn-info" id="btn_simpan" onclick="save_wa()">Simpan</button>
                  </div>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>



          <br />
          <hr>
          </hr>
          <table id="watgl" class="table table-bordered table-striped">
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

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-wheelchair"></i>
          <h3 class="box-title"> Antrian Pendaftaran WA hari ini <b></b></h3><br /><br />

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