<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pendaftaran WA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/demo.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!--  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/pnotify/pnotify.custom.min.css'); ?>"> -->

  <script src="<?php echo base_url(); ?>assets/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/easyui/jquery.easyui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/chartjs/Chart.bundle.js"></script>
  <script src="<?php echo base_url(); ?>assets/chartjs/utils.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- <script src="<?php echo base_url(); ?>assets/bower_components/pnotify/pnotify.custom.min.js"></script> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-green layout-top-nav fixed">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo base_url('Depan'); ?>" class="navbar-brand"><b><i class="fa fa-whatsapp">&nbsp;</i>Pendaftaran</b> WA</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <?php
            $user_lv = $this->session->userdata('user_lv');
            if ($user_lv == '1') {
              ?>
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Antrian Sekarang <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('depan'); ?>"><i class="ace-icon fa fa-list-alt bigger-130"></i>Lihat</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reservasi <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('reservasi'); ?>"><i class="ace-icon fa fa-edit bigger-130"></i>Daftar</a></li>
                    <li><a href="<?php echo base_url('pasien'); ?>"><i class="ace-icon fa  fa-user-md bigger-130"></i>Pasien Baru</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('users'); ?>"><i class="ace-icon fa fa-users bigger-130"></i>Pengguna</a></li>
                    <li><a href="<?php echo base_url('users/index_hari'); ?>"><i class="ace-icon fa fa-calendar-plus-o bigger-130"></i>Batas Hari</a></li>
                    <li><a href="<?php echo base_url('batas'); ?>"><i class="ace-icon fa fa-medkit bigger-130"></i>Batas Pasien Per Poli</a></li>
                  </ul>
                </li>

              </ul>
            <?php } else { ?>
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Antrian Sekarang <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('depan'); ?>">Lihat</a></li>
                  </ul>
                </li>
              </ul>
            <?php } ?>
          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="<?php echo base_url(); ?>index.php/login/logout" id="logout" onClick="return confirm('Apakah Anda yakin akan keluar sistem?')">
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar04.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata('full_nm'); ?></span>
                  <!-- <span class="hidden-xs">Log Out</span> -->
                </a>
              </li>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <!-- <div class="container"> -->
      <?php $this->load->view($contents); ?>
      <!-- </div> -->
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer navbar-fixed-bottom">
      <div class="container">
        <div class="pull-right hidden-xs">

        </div>
        <strong>Copyright &copy; 2019 <a href="#">Team IT</a>.</strong> RSUD Wonosari
      </div>
      <!-- /.container -->
    </footer>
  </div>
  <!-- ./wrapper -->

  <script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    $('.datepick').datetimepicker({
      format: "dd MM yyyy hh:ii",
      autoclose: true,
      todayBtn: true
    });
  </script>
</body>

</html>