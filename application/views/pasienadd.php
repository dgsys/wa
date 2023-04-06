  <script type="text/javascript">
      var seqno;
      var url;
      var save_method;
      var stat;

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
              "sAjaxSource": "<?php echo site_url('reservasi/apiantrianwatgl'); ?>",
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
                  },
                  {
                      "data": "aksi"
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
          esok.setDate(esok.getDate());
          // alert(d);
          var bts = '<?= $batas; ?>';
          var esok2 = new Date();
          //   console.log(bts);
          esok2.setDate(esok2.getDate() + parseInt(bts));
          $('#datepicker').datepicker({
              autoclose: true,
              responsive: true,
              format: "dd-mm-yyyy",
              todayHighlight: true,
              todayBtn: true,
              todayHighlight: true,
              endDate: esok
          });
          //   $('#watgl').DataTable();
          //   jadwal();

          $('#datepicker').datepicker('update', esok);
          kosongkan();
          $(".angka").keypress(function(e) {
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                  //$("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
              }
          });
          apiwatgl();
          propinsi();
          asuransi();
          pendidikan();
          pekerjaan();
          suku();
          agama();
          identitas();
          cekasuransi();
          goldarah();
          hubungan();
          kelas();

          //   var radios = document.querySelectorAll('input[type=radio][name="tipepasien"]');

          //   function changeHandler(event) {
          //       if (this.value === 'PASIEN_TP_01') {
          //           alert("alot");
          //       } else if (this.value === 'PASIEN_TP_02') {
          //           alert("transfer");
          //       }
          //   }

          //   Array.prototype.forEach.call(radios, function(radio) {
          //       radio.addEventListener('change', changeHandler);
          //   });
          //   $('#kelurahan').combogrid({})      ;   

      });

      function propinsi() {
          $('#propinsi').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apipropinsi'); ?>',
              idField: 'region_cd',
              textField: 'region_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'region_nm',
                      title: 'Provinsi',
                      width: 100
                  }]
              ],
              onSelect: function(rowIndex, rowData) {
                  //tampilkan kab ke combo kabupaten
                  var id = rowData.region_cd;
                  kabupaten(id);
                  kecamatan(null);
                  kelurahan(null);
              }
          });
          $('#kabupaten').combogrid({
              onSelect: function(rowIndex, rowData) {
                  //tampilkan kab ke combo kabupaten
                  var id = rowData.region_cd;
                  kecamatan(id);
                  kelurahan(null);
              }
          });

          $('#kecamatan').combogrid({
              onSelect: function(rowIndex, rowData) {
                  //tampilkan kab ke combo kabupaten
                  var id = rowData.region_cd;
                  kelurahan(id);
              }

          });
      }

      function kabupaten(idprop) {
          $('#kabupaten').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apikabupaten'); ?>/' + idprop,
              idField: 'region_cd',
              textField: 'region_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'region_nm',
                      title: 'Kabupaten',
                      width: 100
                  }]
              ]
          });
      }

      function kecamatan(idkab) {
          $('#kecamatan').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apikecamatan'); ?>/' + idkab,
              idField: 'region_cd',
              textField: 'region_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'region_nm',
                      title: 'Kecamatan',
                      width: 100
                  }]
              ]
          });
      }

      function kelurahan(idkec) {
          $('#kelurahan').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apikelurahan'); ?>/' + idkec,
              idField: 'region_cd',
              textField: 'region_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'region_nm',
                      title: 'Kelurahan',
                      width: 100
                  }]
              ]
          });
      }

      function asuransi() {
          $('#asuransi').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apiasuransi'); ?>',
              idField: 'insurance_cd',
              textField: 'insurance_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'insurance_nm',
                      title: 'Asuransi',
                      width: 100
                  }]
              ]
          });
      }

      function pendidikan() {
          $('#pendidikan').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apipendidikan'); ?>',
              idField: 'com_cd',
              textField: 'code_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'code_nm',
                      title: 'Pendidikan',
                      width: 100
                  }]
              ]
          });
      }

      function pekerjaan() {
          $('#pekerjaan').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apipekerjaan'); ?>',
              idField: 'com_cd',
              textField: 'code_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'code_nm',
                      title: 'Pekerjaan',
                      width: 100
                  }]
              ]
          });
      }

      function suku() {
          $('#suku').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apisuku'); ?>',
              idField: 'com_cd',
              textField: 'code_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'code_nm',
                      title: 'Suku',
                      width: 100
                  }]
              ]
          });
      }

      function agama() {
          $('#agama').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apiagama'); ?>',
              idField: 'com_cd',
              textField: 'code_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'code_nm',
                      title: 'Agama',
                      width: 100
                  }]
              ]
          });
      }

      function identitas() {
          $('#identitas').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apiidentitas'); ?>',
              idField: 'com_cd',
              textField: 'code_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'code_nm',
                      title: 'Identitas',
                      width: 100
                  }]
              ]
          });
      }

      function goldarah() {
          $('#goldarah').combogrid({
              panelWidth: 180,
              url: '<?php echo site_url('pasien/apigoldarah'); ?>',
              idField: 'com_cd',
              textField: 'code_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'code_nm',
                      title: 'Gol Darah',
                      width: 100
                  }]
              ]
          });
      }

      function hubungan() {
          $('#hubungan').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apihubungan'); ?>',
              idField: 'com_cd',
              textField: 'code_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'code_nm',
                      title: 'Hubungan Keluarga',
                      width: 100
                  }]
              ]
          });
      }

      function kelas() {
          $('#kelas').combogrid({
              panelWidth: 250,
              url: '<?php echo site_url('pasien/apikelas'); ?>',
              idField: 'kelas_cd',
              textField: 'kelas_nm',
              mode: 'remote',
              fitColumns: true,
              columns: [
                  [{
                      field: 'kelas_nm',
                      title: 'Kelas Asuransi',
                      width: 100
                  }]
              ]
          });
      }

      function jadwal() {
          $(function() {
              var tanggal = $("#datepicker1").val();
              var string = "tanggal=" + tanggal;
              $('#cg').combogrid({
                  panelWidth: 650,
                  url: '<?php echo site_url('reservasi/apijadwal'); ?>/' + tanggal,
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
                  onSelect: function(index, row) {
                      var doktertujuan = row.dr_nm; // the product's description
                      var politujuan = row.medunit_nm;
                      //   console.log(doktertujuan+'---'+politujuan);
                  },
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
          var nik = $('#nik').val();
          //Ajax Load data from ajax
          $.ajax({
              url: '<?php echo site_url('pasien/apipasien'); ?>/' + nik,
              type: "GET",
              dataType: "JSON",
              success: function(data) {
                  if (!$.trim(data)) {
                      //   alert('Data tidak ditemukan');
                      var pesan = 'Belum terdaftar sebagai pasien RSUD .';
                      $.messager.show({
                          height: 150,
                          width: 400,
                          title: 'INFO',
                          msg: pesan,
                          timeout: 3000,
                          showType: 'slide',
                          style: {
                              right: '',
                              bottom: ''
                          }
                      });
                      $('#no_rm').focus();
                  } else {
                      //   buka();
                      var alamat = data[0]['alamat'] + ',' + data[0]['kelurahan'] + ',' + data[0]['kec'] + ',' + data[0]['Kota'];
                      if ((data[0]['tgllahir']) == null) {
                          var lahir = "-";
                      } else {
                          var lahir = data[0]['tgllahir'];
                      };
                      var pesan = 'NIK sudah terdaftar sebagai pasien :</br>' + 'No Rekam Medis :' + data[0]['no_rm'] +
                          '</br>Nama :' + data[0]['pasien_nm'] +
                          '</br>Tanggal lahir : ' + lahir +
                          '</br>Alamat :' + alamat;
                      $.messager.show({
                          height: 250,
                          width: 500,
                          title: 'INFO',
                          msg: pesan,
                          timeout: 7000,
                          showType: 'slide',
                          style: {
                              right: '',
                              bottom: ''
                          }
                      });
                      kosongkan();
                      $('#nik').focus();
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
          seqno = '';
          stat = '';
          save_method = 'add';
          $("input[name='no_rm']").attr("readonly", false);
      }


      function save_pasien() {
          //   save_method = 'add';
          var nik = $('#nik').val();
          var no_rm = $('#no_rm').val();
          var pasien_nm = $('#pasien_nm').val();
          var tgllahir = $('#datepicker').val();
          var jk = $('#jenis_kelamin').val();
          var alamat = $('#alamat').val();
          var propinsi = $('#propinsi').next().find('input').val();
          var kabupaten = $('#kabupaten').next().find('input').val();
          var kecamatan = $('#kecamatan').next().find('input').val();
          var kelurahan = $('#kelurahan').next().find('input').val();
          var no_hp = $('#no_hp').val();
          var tipepasien = $('#tipepasien').val();
          var asuransi = $('#asuransi').next().find('input').val();
          var noasuransi = $('#noasuransi').val();
          var kelasasuransi = $('#kelasasuransi').next().find('input').val();
          var status = $('#status').val();
          var pendidikan = $('#pendidikan').next().find('input').val();
          var pekerjaan = $('#pekerjaan').next().find('input').val();
          var suku = $('#suku').next().find('input').val();
          var agama = $('#agama').next().find('input').val();
          var goldarah = $('#goldarah').next().find('input').val();
          var ayah = $('#ayah').val();
          var ibu = $('#ibu').val();
          var namapj = $('#namapj').val();
          var hubungan = $('#hubungan').next().find('input').val();
          var alamatpj = $('#alamatpj').val();
          var telppj = $('#telppj').val();



          if (nik == '') {
              alert("Maaf,Silahkan isi NIK ");
              $('#nik').focus();
              return false;
          }
          if (no_rm == '') {
              alert("Maaf,Silahkan isi no RM ");
              $('#no_rm').focus();
              return false;
          }
          if (pasien_nm == '') {
              alert("Maaf,Silahkan isi nama pasien");
              $('#pasien_nm').focus();
              return false;
          }
          if (tgllahir == '') {
              alert("Maaf,Silahkan isi tanggal lahir");
              $('#datepicker').focus();
              return false;
          }
          //   if (poli == '') {
          //       alert("Maaf, Pilih Poli");
          //       $('#tindakan_cd').next().find('input').focus();
          //       return false;
          //   }
          if (alamat == '') {
              alert("Maaf,Silahkan isi Alamat");
              $('#alamat').focus();
              return false;
          }
          $('#btn_tindakan').text('saving...'); //change button text
          $('#btn_tindakan').attr('disabled', true); //set button disable 
          if (save_method == 'add') {
              url = "<?php echo site_url('pasien/ajax_add_pasien') ?>";
              var tanggal = $("#datepicker").val();
              var nikk = $('#nik').val();
              var $form = $('form');
              var data = {
                  'tanggal': tanggal,
                  'nikk':nikk
              };
          } else {
              //   url = "<?php echo site_url('reservasi/update_wa') ?>";
              //   var tanggal = $("#datepicker").val();
              //   var $form = $('form');
              //   var data = {
              //       'trx_seqno': seqno,
              //       'status': stat
              //   };
          }
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
                      //   apiwatgl();
                  } else {
                      if (save_method == 'add') {
                          var st = data[0]['status'];
                          var ket = data[0]['keterangan'];
                          if (st == 'fail') {
                              var pesan = 'Pendaftaran tidak berhasil. </br>';
                          } else {
                              var pesan = 'Pendaftaran berhasil :</br>' +
                                  'NIK :' + $('#nik').val() +
                                  '</br>No Rekam Medis :' + $('#no_rm').val() +
                                  '</br>Nama :' + $('#pasien_nm').val() +
                                  '<br/>Alamat :' + $('#alamat').val();
                          }
                      } else {
                          var pesan = 'Berhasil Merubah data';
                      };

                      $.messager.show({
                          height: 250,
                          width: 500,
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
                  //   apiwatgl();
                  //   console.log(ket);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  $.messager.show({
                      title: 'ERROR',
                      msg: 'gagal simpan data',
                      timeout: 4000,
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

      function wa_cetak() {
          var tanggal = $("#datepicker1").val();
          window.open('<?php echo site_url('reservasi/antrian_wa_cetak'); ?>/' + tanggal);
      }

      function ubah(id, no_rm, pasien_cd, nama, alamat, dr_cd, unit, wa, ubah) {
          save_method = 'edit';
          seqno = id;
          stat = ubah;
          buka();
          $("input[name='no_rm']").attr("readonly", true);
          $('#form_wa')[0].reset(); // reset form on modals
          $('.form-group').removeClass('has-error'); // clear error class
          $('.help-block').empty(); // clear error string
          $('[name="no_rm"]').val(no_rm);
          $('[name="pasien_cd"]').val(pasien_cd);
          $('[name="pasien_nm"]').val(nama);
          $('[name="alamat"]').val(alamat);
          $('#cg').combogrid('clear');
          $('#cg').combogrid('setValue', unit + '/' + dr_cd);
          $('[name="no_wa"]').val(wa);
          //   $('[name="seharusnya"]').val(format_angka(seharusnya));
      }

      function batal(id, batal) {
          var datanya = {
              'trx_seqno': id,
              'status': batal
          };
          if (confirm('yakin akan membatalkan jadwal periksa !! ')) {
              // ajax delete data to database
              $.ajax({
                  url: "<?php echo site_url('reservasi/batal_wa') ?>",
                  type: "POST",
                  data: datanya,
                  dataType: "JSON",
                  success: function(data) {
                      $.messager.show({
                          title: 'INFO',
                          msg: 'Pembatalan Sukses',
                          timeout: 7000,
                          showType: 'slide',
                          style: {
                              left: '',
                              right: 0,
                              bottom: ''
                          }
                      });
                      kosongkan();
                      apiwatgl();
                      //   console.log(data);
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      $.messager.show({
                          title: 'INFO',
                          msg: 'Gagal Membatalkan',
                          timeout: 1500,
                          showType: 'slide',
                          style: {
                              left: '',
                              right: 0,
                              bottom: ''
                          }
                      });
                      kosongkan();
                      apiwatgl();
                      //   console.log(data);
                  }
              });
          }
      }

      function tes() {
          var poli = $('#cg').next().find('input').val();
          alert(save_method + ' - ' + seqno + ' - ' + stat);
      }

      function cekasuransi() {
          $('input:radio[name="tipepasien"]').change(
              function() {
                  if ($(this).is(':checked') && $(this).val() == 'PASIEN_TP_02') {
                      $('#asuransi').combogrid('enable');
                      document.getElementById("no_asuransi").disabled = false;
                      $('#kelas').combogrid('enable');
                  } else {
                      $('#asuransi').combogrid('setValue', '');
                      $('#asuransi').combogrid('disable');
                      document.getElementById("no_asuransi").disabled = true;
                      $('#no_asuransi').val('');
                      $('#kelas').combogrid('setValue', '');
                      $('#kelas').combogrid('disable');
                  }
              });
      }
  </script>



  <!-- Main content -->
  <div class="row">

      <section class="content">
          <div class="box">
              <div class="box-header with-border">
                  <i class="fa fa-wheelchair"></i>
                  <h3 class="box-title"> Pendaftaran Pasien Baru <b></b></h3><br /><br />
              </div>
              <!-- <div class="col-md-6">
                  <div class="box-body ">
                      <div class="form-group">
                          <div class="col-md-4">
                              <div class="input-group date">
                                  <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right date-picker" id="datepicker1" name="datepicker1">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="btn-group">
                                  <button type="button" class="btn btn-primary" onclick="apiwatgl()"><i class="fa fa-refresh">&nbsp;</i>Tampilkan</button>
                              </div>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-warning" onclick="wa_cetak()"><i class="fa fa-print">&nbsp;</i>Cetak</button>
                              </div>                             
                          </div>
                      </div>

                      <hr>&nbsp;</hr>
                  </div> <div class="box-body ">
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
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
              </div> -->

              <form action="#" id="form_wa" class="form-horizontal">
                  <div class="box-body">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="nik" class="col-sm-3 control-label">NIK</label>
                              <div class="col-sm-9">
                                  <!-- <input type="text" class="form-control angka" id="nik" name="nik" placeholder="ketik NIK"> -->
                                  <div class="input-group">
                                      <input type="text" name="message" placeholder="Ketik NIK ..." class="form-control angka" id="nik" name="nik">
                                      <span class="input-group-btn">
                                          <button type="button" class="btn btn-warning btn-flat" onclick="getpasien()">Cek</button>
                                      </span>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="no_rm" class="col-sm-3 control-label">No RM</label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control angka" id="no_rm" name="no_rm" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="pasien_nm" class="col-sm-3 control-label">Nama</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control " id="pasien_nm" name="pasien_nm" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="datepicker1" class="col-sm-3 control-label">Tanggal Lahir</label>
                              <div class="col-sm-5">
                                  <div class="input-group date">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" id="datepicker" name="datepicker">
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="jenis_kelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
                              <div class="col-md-6">
                                  <span class="input-group-addon">
                                      <input type="radio" name="jenis_kelamin" value="GENDER_TP_01" id="GENDER_TP_01" checked="checked" class="minimal">
                                      <label for="jenis_kelamin">Laki-laki</label>
                                  </span>
                                  <span class="input-group-addon">
                                      <input type="radio" name="jenis_kelamin" value="GENDER_TP_02" id="GENDER_TP_02" class="minimal">
                                      <label for="jenis_kelamin">Perempuan</label>
                                  </span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                              <div class="col-sm-9">
                                  <!-- <input type="text" class="form-control " id="alamat" name="alamat" placeholder=""> -->
                                  <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder=""></textarea>
                              </div>
                          </div>
                          <div id="detail" style="display:none;">

                          </div>
                          <!-- <div class="form-group">
                              <label for="cg" class="col-sm-3 control-label">Poliklinik</label>
                              <div class="col-sm-8">
                                  <input id="cg" name="cg" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div> -->
                          <div class="form-group">
                              <label for="propinsi" class="col-sm-3 control-label">Provinsi</label>
                              <div class="col-sm-8">
                                  <input id="propinsi" name="propinsi" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="kabupaten" class="col-sm-3 control-label">Kabupaten</label>
                              <div class="col-sm-8">
                                  <input id="kabupaten" name="kabupaten" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="kecamatan" class="col-sm-3 control-label">Kecamatan</label>
                              <div class="col-sm-8">
                                  <input id="kecamatan" name="kecamatan" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="kelurahan" class="col-sm-3 control-label">Kelurahan</label>
                              <div class="col-sm-8">
                                  <input id="kelurahan" name="kelurahan" style="width:185px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                      </div>
                      <!-- kolom ke2 -->
                      <div class="col-md-5">
                          <div class="form-group">
                              <label for="no_hp" class="col-sm-3 control-label">No HP</label>
                              <div class="col-sm-7">
                                  <input type="text" class="form-control angka" id="no_hp" name="no_hp" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="tipepasien" class="col-sm-3 control-label">Tipe Pasien </label>
                              <div class="col-sm-6">
                                  <span class="input-group-addon">
                                      <input type="radio" name="tipepasien" value="PASIEN_TP_01" id="pu" checked="checked">
                                      <label for="tipepasien">Pasien Umum</label>
                                  </span>
                                  <span class="input-group-addon">
                                      <input type="radio" name="tipepasien" value="PASIEN_TP_02" id="pj">
                                      <label for="tipepasien">Pasien Jaminan</label>
                                  </span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="asuransi" class="col-sm-3 control-label">Asuransi</label>
                              <div class="col-sm-8">
                                  <input id="asuransi" name="asuransi" style="width:210px;height: 30px" class="form-control" type="text" disabled>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="no_asuransi" class="col-sm-3 control-label">No Asuransi</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control" id="no_asuransi" name="no_asuransi" placeholder="" disabled>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="kelas" class="col-sm-3 control-label">Kelas Asuransi</label>
                              <div class="col-sm-8">
                                  <input id="kelas" name="kelas" style="width:210px;height: 30px" class="form-control" type="text" disabled>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="status" class="col-sm-3 control-label">Status</label>
                              <div class="col-md-6">
                                  <span class="input-group-addon">
                                      <input type="radio" name="status" value="MARITAL_TP_1" id="sgl" checked="checked" class="minimal">
                                      <label for="status">Single</label>
                                  </span>
                                  <span class="input-group-addon">
                                      <input type="radio" name="status" value="MARITAL_TP_2" id="nikah" class="minimal">
                                      <label for="status">Menikah</label>
                                  </span>
                                  <span class="input-group-addon">
                                      <input type="radio" name="status" value="MARITAL_TP_3" id="jd" class="minimal">
                                      <label for="status">Janda/Duda</label>
                                  </span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="pendidikan" class="col-sm-3 control-label">Pendidikan</label>
                              <div class="col-sm-8">
                                  <input id="pendidikan" name="pendidikan" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="pekerjaan" class="col-sm-3 control-label">Pekerjaan</label>
                              <div class="col-sm-8">
                                  <input id="pekerjaan" name="pekerjaan" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="suku" class="col-sm-3 control-label">Suku</label>
                              <div class="col-sm-8">
                                  <input id="suku" name="suku" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="agama" class="col-sm-3 control-label">Agama</label>
                              <div class="col-sm-8">
                                  <input id="agama" name="agama" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <!-- <div class="form-group">
                              <label for="cg" class="col-sm-3 control-label">Identitas</label>
                              <div class="col-sm-8">
                                  <input id="identitas" name="identitas" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="no_rm" class="col-sm-3 control-label">No Identitas</label>
                              <div class="col-sm-4">
                                  <input type="text" class="form-control angka" id="no_identitas" name="no_identitas" placeholder="">
                              </div>
                          </div> -->

                      </div>
                      <!-- kolom ke3 -->
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="goldarah" class="col-sm-4 control-label">Gol Darah</label>
                              <div class="col-sm-8">
                                  <input id="goldarah" name="goldarah" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="ayah" class="col-sm-4 control-label">Nama Ayah</label>
                              <div class="col-sm-8">
                                  <input type="text" class="form-control  " id="ayah" name="ayah" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="ibu" class="col-sm-4 control-label">Nama Ibu</label>
                              <div class="col-sm-8">
                                  <input type="text" class="form-control an gka" id="ibu" name="ibu" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-9 control-label">Penanggung Jawab</label>
                              <!-- <div class="col-sm-4">
                                  <input type="text" class="form-control an gka" id="ibu" name="ibu" placeholder="">
                              </div> -->
                          </div>
                          <div class="form-group">
                              <label for="namapj" class="col-sm-4 control-label">Nama </label>
                              <div class="col-sm-8">
                                  <input type="text" class="form-control " id="namapj" name="namapj" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="hubungan" class="col-sm-4 control-label">Hubungan</label>
                              <div class="col-sm-8">
                                  <input id="hubungan" name="hubungan" style="width:180px;height: 30px" class="form-control" type="text">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="alamatpj" class="col-sm-4 control-label">Alamat</label>
                              <div class="col-sm-8">
                                  <!-- <input type="text" class="form-control " id="alamat" name="alamat" placeholder=""> -->
                                  <textarea class="form-control" id="alamatpj" name="alamatpj" rows="3" placeholder=""></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="telppj" class="col-sm-4 control-label">Telepon </label>
                              <div class="col-sm-8">
                                  <input type="text" class="form-control angka " id="telppj" name="telppj" placeholder="">
                              </div>
                          </div>
                      </div>
                  </div><!-- akhir content -->
                  <div class="box-footer">
                      <div class="margin pull-right">
                          <div class="btn-group">
                              <button type="button" class="btn btn-danger" onclick="kosongkan()">Batal</button>
                          </div>
                          <div class="btn-group">
                              <button type="button" class="btn btn-info" id="btn_simpan" onclick="save_pasien()">Simpan</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </section>
  </div>