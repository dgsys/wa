<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MUTU | Keselamatan Pasien</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
   <!-- iCheck for checkboxes and radio inputs -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/all.css">
   <!-- daterange picker -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- bootstrap datepicker -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Select2 -->
   <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav fixed">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo base_url();?>assets/index2.html" class="navbar-brand"><b>Aplikasi</b> MUTU</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <?php
            $user_lv=$this->session->userdata('user_lv'); 
            $user_group=$this->session->userdata('user_group'); 
            if(($user_lv=='1') || ($user_lv=='3')){ 
              ?>
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">IKP <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('kp/add');?>">Baru</a></li>
                    <li><a href="<?php echo base_url('kp'); ?>">List</a></li>
                    <li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">PPI <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('ppi/rekap_ppi'); ?>">Pemakaian Alat/Tindakan dan Infeksi</a></li>
                    <li><a href="<?php echo base_url('laporan_ppi'); ?>">Laporan</a></li>
                    <li><a href="<?php echo base_url('laporan_ppi_ct'); ?>">Laporan Cuci Tangan</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">K3 <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                   
                  </ul>
                </li>
              </ul>
            <?php }else{ 
              if($user_group=='1'){
                ?>
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">SASARAN KESELAMATAN PASIEN  <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('kp'); ?>">List</a></li>
                    <li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
                  </ul>
                </li>
                  <!-- <li class=""><a href="<?php echo base_url('kp'); ?>">SASARAN KESELAMATAN PASIEN <span class="sr-only">(current)</span></a></li> -->
                </ul>
              <?php }elseif($user_group=='2'){ ?>
               <ul class="nav navbar-nav">
                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">PPI <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url('ppi/ct_ppi'); ?>">Kepatuhan Cuci Tangan</a></li>
                    <li><a href="<?php echo base_url('Laporan_ppi'); ?>">Laporan</a></li>
                  </ul>
                </li>
              </ul>
              <?php }elseif($user_group=='3'){?>
               <ul class="nav navbar-nav">
                <li class=""><a href="<?php echo base_url('kp'); ?>">PMKP <span class="sr-only">(current)</span></a></li>

              </ul>

              <?php
            }else{

            }}?>
            
          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <a href="<?php echo base_url();?>index.php/login/logout" id="logout" onClick="return confirm('Apakah Anda yakin akan keluar sistem?')">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo base_url();?>assets/dist/img/avatar04.png" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Log Out</span>
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
      <div class="container">
       <?php $this->load->view($contents);?>
     </div>
     <!-- /.container -->
   </div>
   <!-- /.content-wrapper -->
   <footer class="main-footer navbar-fixed-bottom">
    <div class="container">
      <div class="pull-right hidden-xs">

      </div>
      <strong>Copyright &copy; 2018 <a href="#">Team IT</a>.</strong> RSUD Wonosari
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script> 
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script> -->
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script> -->
<script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
});
 $('.datepick').datetimepicker({
  format: "dd MM yyyy hh:ii",
  autoclose: true,
  todayBtn: true
});
</script>
</body>
</html>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">