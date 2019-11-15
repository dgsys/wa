<style type="text/css">
.has-error .select2-selection {
        /*border: 1px solid #a94442;
        border-radius: 4px;*/
        border-color:rgb(185, 74, 72) !important;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h3>
        <?php echo $title; ?>
        
        <!-- <small>
        ]Example 2.0</small> -->
    </h3>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="<?php echo base_url(); ?>index.php/kp">INSIDEN BARU</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <form class="form-horizontal" id="formInsiden">
        <input type="hidden" name="insiden_cd" id="insiden_cd">
        <div class="box">
            <div class="box-header with-border">
                <i class="fa fa-wheelchair"></i>
                <h3 class="box-title">I. DATA PASIEN</h3>
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Nama&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control" id="NamaP" placeholder="Ketikan nama pasien ..." >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMR" class="col-sm-2 control-label">No.MR</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="no_rm" id="inputMR" placeholder="Ketikan No.MR ...">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="inputUmur" class="col-sm-2 control-label">Umur&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <div class="col-sm-6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="umur" class="" id="umur1" value="0 - 1 bln" checked="true"> 0 - 1 bln
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="umur" class="" id="umur2" value="> 1 bln - 1 th" > > 1 bln - 1 th
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="umur" class="" id="umur3" value="> 1 th - 5 th" > > 1 th - 5 th
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="umur" class="" id="umur4" value="> 5 th - 15 th" > > 5 th - 15 th
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="umur" class="" id="umur5" value="> 15 th - 30 th" > > 15 th - 30 th
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="umur" class="" id="umur6" value="> 30 th - 65 th" > > 30 th - 65 th
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="umur" class="" id="umur7" value="> 65 th" > > 65 th
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputGender" class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="L" class="" value="L"> Laki-laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="gender" id="P" class="" value="P"> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Jaminan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="asuransi">
                                <option value="-">-</option>
                                <option value="Umum" >Umum/Pribadi</option>
                                <option value="BPJS/ASKES">BPJS/ASKES</option>
                                <option value="JAMKESMAS/JAMKESOS/JAMKESTA">JAMKESMAS/JAMKESOS/JAMKESTA</option>
                                <option value="Asuransi Swasta">Asuransi Swasta</option>
                                <option value="Perusahan">Perusahaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTglMasuk" class="col-sm-2 control-label">Tgl.Masuk&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" id="tanggal_masuk" name="tanggal_masuk" class="form-control datepick" placeholder="dd-mm-yyyy hh:ii">
                        </div>
                    </div>      
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="box">
            <div class="box-header">
                <i class="fa fa-spinner"></i>

                <h3 class="box-title">II. RINCIAN KEJADIAN</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Tanggal Insiden&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" name="tgl_insiden" class="form-control datepick" id="tgl_insiden" placeholder="dd-mm-yyyy hh:ii">
                        </div>
                    </div>
                    <div class="form-group" id="prtInsiden">
                        <label class="col-sm-2 control-label">Insiden&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-10" >
                            <select name="insiden" class="form-control" id="insiden"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Kronologi&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <textarea name="kronologi" class="form-control rounded-0" rows="5" id="kronologi" style="resize:vertical; " placeholder="Ketikan kronologi kejadian insiden ...."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Jenis&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="jenis_insiden" id="jenis_insiden">
                                <option value="-">-</option>
                                <option value="KNC">Kejadian nyaris cidera / KNC (near miss)</option>
                                <option value="KTD">Kejadian tidak diharapkan / KTD (adverse event)</option>
                                <option value="KTC">Kejadian Tidak Cidera / KTC</option>
                                <option value="KPC">Kondisi Potensi Cidera / KPC</option>
                                <option value="SENTINEL">Kejadian Sentinel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Pelapor Pertama&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="pelapor1" id="pelapor1" onchange="ckPelapor()">
                                <option value="-">-</option>
                                <option value="Dokter">Dokter</option>
                                <option value="Perawat">Perawat</option>
                                <option value="Petugas lainya">Petugas lainya</option>
                                <option value="Pasien">Pasien</option>
                                <option value="Keluarga/Pendamping pasien">Keluarga/Pendamping pasien</option>
                                <option value="Pengunjung">Pengunjung</option>
                                <option value="">Lain-lain</option>
                            </select>
                            <input type="text" style="display: none;" name="pelapor1_lain" id="pelapor1_lain" class="form-control" placeholder="Ketikan pelapor pertama insiden ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Insiden terjadi pada?&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="terjadi_pada" id="terjadi_pada" onchange="ckKorban();">
                                <option value="-">-</option>
                                <option value="Pasien">Pasien</option>
                                <option value="Karyawan">Karyawan</option>
                                <option value="Keluarga/Pendamping pasien">Keluarga/Pendamping pasien</option>
                                <option value="Pengunjung">Pengunjung</option>
                                <option value="lain">Lain-lain</option>
                            </select>
                            <input type="text" style="display: none;" name="terjadipada_lain" id="terjadipada_lain" class="form-control" placeholder="Kepada siapa insiden terjadi?...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Lokasi Insiden&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="lokasi_insiden" class="form-control" placeholder="Ketikan lokasi insiden ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Kasus penyakit</label>
                        <div class="col-sm-5">
                            <select class="form-control"  name="kasusPenyakit" id="kasusPenyakit" >
                                <option value="-">-</option>
                                <?php
                                $data = $this->app_model->getPenyakit()->result();
                                foreach ($data as $value) {
                                    echo "<option value='" . $value->set_cd . "'>" . $value->set_nm . "</option> ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Unit Terkait&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" name="unit_terkait" class="form-control" placeholder="Ketikan unit terkait ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNama" class="col-sm-2 control-label">Akibat Insiden&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-5">
                            <select class="form-control" name="akibatInsiden" id="akibat_insiden">
                                <option value="-">-</option>
                                <?php
                                $data = $this->app_model->getAkibat()->result();
                                foreach ($data as $value) {
                                    echo "<option value='" . $value->set_cd . "'>" . $value->set_nm . "</option> ";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTindakan" class="col-sm-2 control-label">Tindakan dan hasilnya&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-10">
                            <textarea name="tindakan" id="tindakan" class="form-control rounded-0" rows="5" style="resize:vertical; " placeholder="Ketikan tindakan yang dilakukan segera setelah insiden, dan hasilnya ...."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTindakan" class="col-sm-2 control-label">Petugas Tindakan&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-5">
                            <select name="paramedis" id="petugasTindakan" class="form-control" onchange="ckParamedis()">
                                <option value="-">-</option>
                                <option value="dokter">Dokter</option>
                                <option value="perawat">Perawat</option>
                                <option value="lain">Lain-lain</option>
                            </select>
                            <input type="text" name="paramedisLain" id="petugasTindakanLain" class="form-control" placeholder="Ketikan lokasi insiden ..." style="display: none;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Kejadian sama pernah terjadi?</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="kejadianSama" class="radio-inline" onchange="myFunction();" id="Y" value="Y"> YA
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="kejadianSama" checked="checked" class="radio-inline" onchange="myFunction();" id="N" value="N"> TIDAK
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="UraianKejadianSamaYes" style="display: none;">
                        <div class="col-sm-10 col-sm-offset-2">
                            <textarea name="tindakanKejadianSama" class="form-control rounded-0" rows="5" style="resize:vertical; " placeholder="Kapan dan langkah apa yang telah diambil untuk mencegah terulangnya kejadian yang sama? ...."></textarea>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="box-footer clearfix">
                <!--  <button type="submit" class="pull-right btn btn-default">Send
                     <i class="fa fa-arrow-circle-right"></i>
                 </button> -->
             </div>
         </div>
         <div class="box">
            <div class="box-header">
                <i class="fa fa-envelope"></i>

                <h3 class="box-title">III. PELAPOR</h3>
                <!-- tools box -->
                <!-- <div class="pull-right box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            -->                <!-- /. tools -->
        </div>
        <div class="box">
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Pelapor&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="namaPelapor" class="form-control" placeholder="Ketikan nama lengkap pembuat laporan ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Grading&nbsp;<span class="text-red">*</span></label>
                        <div class="col-sm-4">
                            <ul class="fc-color-picker" id="color-chooser">
                                <li><a class="text-aqua" href="javascript::" id="gBiru" data="BIRU"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-yellow" href="javascript::" id="gKuning" data="KUNING"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-green" href="javascript::" id="gHijau" data="HIJAU"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-red" href="javascript::" id="gMerah" data="MERAH"><i class="fa fa-square"></i></a></li>
                            </ul>
                            <input type="text" name="grading" class="form-control" style="display: none;">
                            <span class="help-block text-red" id="notifGrading" style="display: none;">Pilih grading penilaian!</span>
                        </div>
                    </div>
                </div>   
                <div class="box-footer clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <a class="col-sm-12 btn btn-primary btn-lg" onclick="save_data();">KIRIM
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                </div
                >
            </div>
        </form>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>

        $(document).ready(function () {
            var status='<?php echo $status;?>';
            var id='<?php echo $id;?>';
            var url='';
            if(status=='edit'){
                if(id!=''){ 
                    edit_data();
                }else{
                    window.location = "<?php echo base_url('kp'); ?>";
                }
            }
            myFunction();
            ckPelapor();
            ckKorban();
            ckParamedis();
            $('#gBiru').click(function () {
                var id = $(this).attr('data');
                currColor = $(this).css('color')
                $('input[name=grading]').val(id);
                $('.box').attr('class', 'box box-info');
                $('.box-header').attr('class', 'box-header bg-blue');
            });
            $('#gKuning').click(function () {
                var id = $(this).attr('data');
                currColor = $(this).css('color')
                $('input[name=grading]').val(id);
                $('.box').attr('class', 'box box-warning');
                $('.box-header').attr('class', 'box-header bg-yellow');
            });
            $('#gHijau').click(function () {
                var id = $(this).attr('data');
                currColor = $(this).css('color')
                $('input[name=grading]').val(id);
                $('.box').attr('class', 'box box-success');
                $('.box-header').attr('class', 'box-header bg-green');
            });
            $('#gMerah').click(function () {
                var id = $(this).attr('data');
                currColor = $(this).css('color')
                $('input[name=grading]').val(id);
                $('.box').attr('class', 'box box-danger');
                $('.box-header').attr('class', 'box-header bg-red');
            });

            $('#insiden').select2({
                tags: true,
                minimumInputLength: 2,
                minimumResultsForSearch: 10,

                ajax: {
                    url: '<?php echo base_url('kp/ajax_get_insiden') ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return{
                            insiden: params.term
                        };
                    },
                    processResults: function (data) {
                        var results = [];
                        $.each(data, function (index, item) {
                            results.push({
                                id: item.i_title,
                                text: item.i_title
                            });
                        });
                        return {
                            results: results
                        };
                    },
                    cache: true
                }
            });

        });

        function myFunction() {
            var umur = $("input[name='kejadianSama']:checked").val();
            if (umur == 'Y') {
                document.getElementById('UraianKejadianSamaYes').style.display = 'block';
            } else {
                document.getElementById('UraianKejadianSamaYes').style.display = 'none';
                 $('[name="tindakanKejadianSama"]').val(''); 
            }
        }

        function ckPelapor() {
            var e = document.getElementById("pelapor1");
            var strUser = e.options[e.selectedIndex].value;
            if (strUser == '') {
                document.getElementById('pelapor1_lain').style.display = 'block';
                $('#pelapor1_lain').val(strUser);
            } else {
                document.getElementById('pelapor1_lain').style.display = 'none';
                $('#pelapor1_lain').val(strUser);
            }
        }

        function ckKorban() {
            var e = document.getElementById("terjadi_pada");
            var strUser = e.options[e.selectedIndex].value;
            if (strUser == 'lain') {
                document.getElementById('terjadipada_lain').style.display = 'block';
                $('#terjadipada_lain').val('');
            } else {
                document.getElementById('terjadipada_lain').style.display = 'none';
                $('#terjadipada_lain').val(strUser);
            }
        }

        function ckParamedis() {
            var e = document.getElementById("petugasTindakan");
            var strUser = e.options[e.selectedIndex].value;
            if (strUser == 'lain') {
                document.getElementById('petugasTindakanLain').style.display = 'block';
                $('#petugasTindakanLain').val('');
            } else {
                document.getElementById('petugasTindakanLain').style.display = 'none';
                $('#petugasTindakanLain').val(strUser);
            }
        }

        function pickGrading() {
            var id = $(this).attr('data');
            alert(id);
        }

        function save_data() 
        {
            var status='<?php echo $status;?>';
            if(status == 'add'){
                url = '<?php echo base_url("kp/ajax_add/"); ?>';
            }else if(status == 'edit'){
                url = '<?php echo base_url("kp/ajax_update/"); ?>';
            }
            // alert('save data');
            var nmPasien = $('input[name=nama]').val();
            var umur = $("input[name='umur']:checked").val();
            var gender = $("input[name='gender']:checked").val();
            var asuransi = $('input[name=asuransi]').val();
            var tgl_masuk = $('input[name=tanggal_masuk]').val();
            var tgl_insiden = $('input[name=tgl_insiden]').val();
            var pelapor1 = $('input[name=pelapor1_lain]').val();
            var terjadi_pada = $('input[name=terjadipada_lain]').val();
            var lokasi_insiden = $('input[name=lokasi_insiden]').val();
            var insiden = $('#insiden').val();
            var kronologi = $('#kronologi').val();
            var tindakan = $('#tindakan').val();
            var ji = document.getElementById("jenis_insiden");
            var jenis_insiden = ji.options[ji.selectedIndex].value;
            var ai = document.getElementById("akibat_insiden");
            var akibat_insiden = ai.options[ai.selectedIndex].value;
            var paramedis = $('input[name=paramedisLain]').val();
            var pelapor = $('input[name=namaPelapor]').val();
            var grading = $('input[name=grading]').val();

            if (nmPasien == '') {
               $('input[name=nama]').focus();
               $('input[name=nama]').parent().addClass('has-error');
           } else if (tgl_masuk == '') {
               $('input[name=tanggal_masuk]').focus();
               $('input[name=tanggal_masuk]').parent().addClass('has-error');
           } else if (tgl_insiden == '') {
               $('input[name=tgl_insiden]').focus();
               $('input[name=tgl_insiden]').parent().addClass('has-error');
           } else if (insiden == null) {
               $('#insiden').select2('focus');
               $('#insiden').select2('open');
               $('#prtInsiden').addClass('has-error');
           } else if (kronologi == '') {
               $('#kronologi').focus();
               $('#kronologi').parent().addClass('has-error');
           } else if (jenis_insiden == '-') {
               $('#jenis_insiden').focus();
               $('#jenis_insiden').parent().addClass('has-error');
           } else if (pelapor1 == '-') {
               $('#pelapor1').focus();
               $('#pelapor1').parent().addClass('has-error');
           } else if (terjadi_pada == '-') {
               $('#terjadi_pada').focus();
               $('#terjadi_pada').parent().addClass('has-error');
           } else if (lokasi_insiden == '') {
               $('input[name=lokasi_insiden]').focus();
               $('input[name=lokasi_insiden]').parent().addClass('has-error');
           } else if (akibat_insiden == '-') {
               $('#akibat_insiden').focus();
               $('#akibat_insiden').parent().addClass('has-error');
           } else if (tindakan == '') {
               $('#tindakan').focus();
               $('#tindakan').parent().addClass('has-error');
           } else if (paramedis == '-') {
               $('#petugasTindakan').focus();
               $('#petugasTindakan').parent().addClass('has-error');
           } else if (pelapor == '') {
               $('input[name=namaPelapor]').focus();
               $('input[name=namaPelapor]').parent().addClass('has-error');
           } else if (grading == '') {
            $('#color-chooser').focus();
            document.getElementById('notifGrading').style.display = 'block';
        } else {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: url,
                data: $('#formInsiden').serialize(),
                dataType: 'json',
                success: function (data) {
                    window.location = "<?php echo base_url('kp'); ?>";
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('gagal simpan');
                }
            });
        }
    }

    

    function edit_data()
    {
        var id='<?php echo $id;?>';
        $('#formInsiden')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $.ajax({
            url : "<?php echo site_url('kp/ajax_edit/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="insiden_cd"]').val(data.insiden_cd);
                $('[name="nama"]').val(data.p_nm);
                $('[name="jenis_insiden"]').val(data.i_tp);
                $('[name="pelapor1"]').val(data.i_pelapor);
                $('[name="pelapor1_lain"]').val(data.i_pelapor); 

                $('[name="kasusPenyakit"]').val(data.i_penyakit);
                $('[name="asuransi"]').val(data.p_asuransi);
                $('[name="akibatInsiden"]').val(data.i_dampak);
                $('[name="no_rm"]').val(data.p_rm);

                if(data.grading=="HIJAU"){
                    $('[name="grading"]').val(data.grading);
                    $('.box').attr('class', 'box box-success');
                    $('.box-header').attr('class', 'box-header bg-green');
                }else if(data.grading=="KUNING"){
                    $('[name="grading"]').val(data.grading);
                    $('.box').attr('class', 'box box-warning');
                    $('.box-header').attr('class', 'box-header bg-yellow');
                }else if(data.grading=="BIRU"){
                    $('[name="grading"]').val(data.grading);
                    $('.box').attr('class', 'box box-info');
                    $('.box-header').attr('class', 'box-header bg-blue');
                }else if(data.grading=="MERAH"){
                    $('[name="grading"]').val(data.grading);
                    $('.box').attr('class', 'box box-danger');
                    $('.box-header').attr('class', 'box-header bg-red');
                }
                
                // umur-------------------------
                var umur=data.p_age;
                if(umur=='0 - 1 bln'){
                    document.getElementById('umur1').checked=true;
                }else if(umur=='> 1 bln - 1 th'){
                    document.getElementById('umur2').checked=true;
                }else if(umur=='> 1 th - 5 th'){
                    document.getElementById('umur3').checked=true;
                }else if(umur=='> 5 th - 15 th'){
                    document.getElementById('umur4').checked=true;
                }else if(umur=='> 15 th - 30 th'){
                    document.getElementById('umur5').checked=true;
                }else if(umur=='> 30 th - 65 th'){
                    document.getElementById('umur6').checked=true;
                }else {
                    document.getElementById('umur7').checked=true;
                }


                // Insiden terjadi pada-------------------
                if((data.i_victim=='Pasien')||(data.i_victim=='Karyawan')||(data.i_victim=='Keluarga/Pendamping pasien')||(data.i_victim=='Pengunjung')){
                  $('[name="terjadi_pada"]').val(data.i_victim);
                  $('[name="terjadipada_lain"]').val(data.i_victim);
              }else{ 
                $('[name="terjadi_pada"]').val('lain');
                $('[name="terjadipada_lain"]').val(data.i_victim);
                document.getElementById('terjadipada_lain').style.display = 'block';
            }
                // ----------------------------

                // paramedis-------------------
                if((data.i_paramedis=='dokter')||(data.i_paramedis=='perawat')){
                   $('[name="paramedis"]').val(data.i_paramedis);
                   $('[name="paramedisLain"]').val(data.i_paramedis);
               }else{ 
                $('[name="paramedis"]').val('lain');
                $('[name="paramedisLain"]').val(data.i_paramedis);
                document.getElementById('petugasTindakanLain').style.display = 'block';
            }
                // ----------------------------

                if(data.i_duplicate=='Y'){ 
                    document.getElementById(data.i_duplicate).checked = true;
                    document.getElementById('UraianKejadianSamaYes').style.display = 'block';
                    $('[name="tindakanKejadianSama"]').val(data.i_solution);  
                }else{
                    document.getElementById(data.i_duplicate).checked = true;
                    $('[name="tindakanKejadianSama"]').val(''); 

                }

                document.getElementById(data.p_gender).checked = true;
                $('#insiden').select2('val',data.i_title);
                $('[name="tanggal_masuk"]').datetimepicker('update',data.p_date_in);
                $('[name="tgl_insiden"]').datetimepicker('update',data.i_date);
                $('[name="kronologi"]').val(data.i_kronologi);           
                $('[name="lokasi_insiden"]').val(data.i_lokasi);           
                $('[name="unit_terkait"]').val(data.i_unit_terkait);           
                $('[name="tindakan"]').val(data.i_hasil);           
                $('[name="tindakanKejadianSama"]').val(data.i_solution);           
                $('[name="namaPelapor"]').val(data.pelapor_nm);     

                var dataInsiden = [{ id:  data.i_title, text:  data.i_title }];      
                $('#insiden').select2({ data: dataInsiden });           
                document.getElementById(jenis_insiden).value=data.i_tp;

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
}
</script>
