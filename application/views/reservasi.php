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
          jadwal();
          kosongkan();
          $(".angka").keypress(function(e) {
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                  //$("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
              }
          });
      });

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
          var no_rm = $('#no_rm').val();
          //Ajax Load data from ajax
          $.ajax({
              url: '<?php echo site_url('reservasi/apipasien'); ?>/' + no_rm,
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
          seqno = '';
          stat = '';
          save_method = 'add';
          $("input[name='no_rm']").attr("readonly", false);
      }


      function save_wa() {
          //   save_method = 'add';
          var poli = $('#cg').next().find('input').val();
          var pasien_cd = $('#pasien_cd').val();
          var no_wa = $('#no_wa').val();
          //   var res = poli.split("/");
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
          if (save_method == 'add') {
              url = "<?php echo site_url('reservasi/ajax_add_wa') ?>";
              var tanggal = $("#datepicker1").val();
              var $form = $('form');
              var data = {
                  'tanggal': tanggal
              };
          } else {
              url = "<?php echo site_url('reservasi/update_wa') ?>";
              var tanggal = $("#datepicker1").val();
              var $form = $('form');
              var data = {
                  'trx_seqno': seqno,
                  'status': stat
              };
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
                      apiwatgl();
                  } else {
                      if (save_method == 'add') {
                          var antri = data[0]['no_antrian_tpp'];
                          var pesan = 'Sukses Reservasi WA untuk :<br>' + 'Tanggal : ' + tanggal + '</br>Nomor Antrian TPP :' + antri;
                      } else {
                          var pesan = 'Berhasil Merubah data';
                      };
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
  </script>



  <!-- Main content -->
  <div class="col-md-6">
      <section class="content">
          <div class="box">
              <div class="box-header with-border">
                  <i class="fa fa-wheelchair"></i>
                  <h3 class="box-title"> Booking Pendaftaran WA <b></b></h3><br /><br />
              </div>
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
                          <!-- <button type="button" class="btn btn-block btn-primary" onclick="apiwatgl()">Tampilkan </button> -->
                      </div>
                  </div>
              </div>
              <hr>&nbsp;</hr>
              <form action="#" id="form_wa" class="form-horizontal">
                  <div class="box-body">
                      <div class="form-group">
                          <label for="no_rm" class="col-sm-2 control-label">No RM</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control angka" id="no_rm" name="no_rm" placeholder="ketik No RM">
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
                              <input type="text" class="form-control angka" id="no_wa" name="no_wa" placeholder="">
                          </div>
                      </div>
                  </div>
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
              </form>
          </div>
      </section>
  </div>

  <div class="col-md-6">
      <section class="content">
          <div class="box">
              <div class="box-body ">
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
          </div>
      </section>
  </div>