<!-- Bootstrap 3.3.7 -->
<script type="text/javascript">
    var url;
    var save_method; //for save method string



    function edit_user(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('users/ajax_edit_hari/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_batas"]').val(data.id_batas);
                $('[name="batas"]').val(data.batas);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Batas Hari Reservasi'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Gagal ambil data dari Database');
            }
        });
    }


    function save() {
        var batas = $('#batas').val();


        if (batas == '') {
            alert("Maaf, Batas hari harus diisi !!");
            $('#hari').focus();
            return false;
        }

        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 

        if (save_method == 'add') {
            url = "<?php echo site_url('') ?>";
        } else {
            url = "<?php echo site_url('users/ajax_update_hari') ?>";
        }
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    $('#notice').show();
                    $('#status').text('Berhasil simpan data')
                    setTimeout(function() {
                        $('#notice').fadeOut();
                    }, 1200);
                    reload_table();
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //alert('Error adding / update data');
                $('#notice').show();
                $('#status').text('Gagal simpan data')
                setTimeout(function() {
                    $('#notice').fadeOut();
                }, 1200);
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
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
        $('#notice').hide();
    }) //akhir doc ready



    function tampil_user() {
        $('#example1').dataTable({
            "bProcessing": true,
            "scrollY": 350,
            "scrollCollapse": true,
            "bServerside": true,
            "sAjaxSource": "<?php echo site_url('users/hari_tabel'); ?>",
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "batas"
                },
                {
                    "data": "aksi"
                }
            ]
        });
    };
</script>


<!-- <section class="content-header">
    <h1>
        <?php echo $title; ?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="#">INSIDEN BARU</a></li> 
    </ol>
</section> -->
<div class="row">
    <div class="col-md-3 pull-right">
        <div id="notice" class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-info"></i> Info </h4>
            <!-- Silahkan ambil nomor antrian anda. -->
            <label id="status"></label>
        </div>
    </div>
</div>
<div class="col-md-6">
    <section class="content">
        <div class="row">

            <div class="box">
                <!-- <div class="box-header">
                <div class="col-xs-2">
                    <button type="button" class="btn btn-block btn-primary" onclick="add_user()">Tambah</button>
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-block btn-success" onclick="reload_table()">Reload</button>
                </div>
            </div> -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th class="text-center">Batas Hari Reservasi</th>
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
                        <input type="hidden" value="" name="id_batas" />

                        <div class="form-group">
                            <label class="control-label col-md-6">Batas Hari Untuk Reservasi</label>
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