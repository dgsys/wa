<!-- Bootstrap 3.3.7 -->
<script type="text/javascript">
    var url;
    var save_method; //for save method string
    var seqno;


    function ubah(id, nama, jumlah) {
        save_method = 'update';
        seqno = id;
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('[name="poli_nm"]').val(nama);
        $('[name="batas"]').val(jumlah);
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Edit Batas Pasien Per Poli'); // Set title to Bootstrap modal title
    }


    function save() {
        var batas = $('#batas').val();
         if (batas == '') {
            alert("Maaf,Jumlah harus diisi !!");
            $('#batas').focus();
            return false;
        }      
        $('#btn_tindakan').text('saving...'); //change button text
        $('#btn_tindakan').attr('disabled', true); //set button disable        
            url = "<?php echo site_url('batas/update_batas') ?>";            
            var $form = $('form');
            var data = {
                'medunit_cd': seqno
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
                    reload_table();
                } else {
                       var st = data[0];
                        var pesan = data[1];                       
                    $.messager.show({
                        // height: 300,
                        // width: 400,
                        title: 'INFO',
                        msg: pesan,
                        timeout: 3000,
                        showType: 'slide',
                        style: {
                            left: '',
                            right: 0,
                            bottom: ''
                        }
                    });
                }
                $('#modal_form').modal('hide');
                reload_table();
                  console.log(data);
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
                $('#modal_form').modal('hide');
                reload_table();
            }
        });
    }


    function reload_table() {
        $('#example1').dataTable().fnDestroy();
        tampil_user();
    }



    $(document).ready(function() {
        $('.date-picker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            todayBtn: true,
            todayHighlight: true,
        });
        $(".date-picker").datepicker("update", new Date());
        $(".angka").keypress(function(e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //$("#errmsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
        tampil_user();
        // $('#notice').hide();
    }) //akhir doc ready



    function tampil_user() {
        $('#example1').dataTable({
            "bProcessing": true,
            "scrollY": 350,
            "scrollCollapse": true,
            "bServerside": true,
            "sAjaxSource": "<?php echo site_url('batas/apibataspoli'); ?>",
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "medunit_nm"
                },
                {
                    "data": "batas_wa"
                },
                {
                    "data": "aksi"
                }
            ]
        });
    };
</script>


<!-- <div class="row">
    <div class="col-md-3 pull-right">
        <div id="notice" class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Info </h4>
            <label id="status"></label>
        </div>
    </div>
</div>
-->
<div class="row">
    <div class="col-xs-2">
        <button type="button" class="btn btn-block btn-success" onclick="reload_table()">Reload</button>
    </div>
</div>
<div class="col-md-6">
    <section class="content">
        <div class="row">

            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th class="text-center">Poliklinik</th>
                                <th class="text-center">Batas Pasien</th>
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
                         <div class="form-group">
                            <label class="control-label col-md-4">Poliklinik</label>
                            <div class="col-sm-6">
                                <input type="text" name="poli_nm" id="poli_nm" placeholder=" " class="form-control  " readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Batas Jumlah Pasien</label>
                            <div class="col-sm-2">
                                <input type="text" name="batas" id="batas" placeholder=" " class="form-control angka ">
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
</div>