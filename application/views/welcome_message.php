<html >
<head>
<title>SIM MUTU</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/home1.png" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/font-awesome/4.1.0/css/font-awesome.min.css">
<link href="<?php echo base_url();?>assets/login/css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/login/js/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/login/js/jquery.backstretch.min.js"></script>	
	
		

</head>
<body>
	<div class="preloader">
		<div class="box">
			<h2>Selamat Datang <small>di</small></h2>
			<h1>SIM MUTU</h1>
			<div class="hr"></div>
			<div class="loading"></div>
			<img src="<?php echo base_url();?>assets/login/images/login/logo.png" alt="" height="80"/>
		</div>
	</div>

    <div class="login-container">
        <div class="login-bg"></div>
        <div class="login-fg">
			<div class="login-left"></div>
			<div class="login-form-bg"></div>
		</div>
        
        <div class="login-fg">
			<div class="login-left"></div>
			<div class="login-form">
				<h1>SIM MUTU</h1>
				<div id='notification' class='information'>
					<h2>Sistem Informasi Manajemen Mutu<br/>
					RSUD Wonosari Gunungkidul</h2>
					<hr>
					<p>
					   Silahkan masukkan username dan password anda!..
					</p>					
                </div>
				<form id="loginform" action="<?php echo base_url();?>index.php/login/validasi" method="post">
					<?php
        				if (validation_errors() || $this->session->flashdata('result_login')) {
        			?>
        		<script>alert('User dan Password tidak cocok !!')</script>
        			<?php } ?>
					
					<input type="hidden" name="guest" value="0"/>
					<div class="control">
						<input type="text" name="username" class="inputbox" placeholder="Username.."/>
					</div>
					<div class="control">
						<input type="password" name="password" class="inputbox" placeholder="Password.."/>
					</div>
					<div class="buttonset">
						<button type="submit" class="button" style="background:green">Login</button>
					</div>
				</form>
				<!--  -->
				<div id="logo">
					<img id="logo-img" src="<?php echo base_url();?>assets/login/images/login/login-logo.png" alt=""/>
					<div id="stamp">
						<label><b>PEMERINTAH DAERAH</b></label></br>
						<label><b>KABUPATEN GUNUNGKIDUL</b></label></br>
						<p><i>RSUD Wonosari Gunungkidul 2018</i></p>
					</div>
				</div>   
				             
			</div>			
		</div>
    </div>
    
   
  
    
	<script type="text/javascript">
    	$(function(){
	       	$.backstretch([
		        "<?php echo base_url();?>assets/login/bg/wisata2.jpg",
		        "<?php echo base_url();?>assets/login/bg/gv.jpg",
		        "<?php echo base_url();?>assets/login/bg/baron.jpg",
		        "<?php echo base_url();?>assets/login/bg/indrayanti.jpeg",
		        ],{fade: 2000,duration: 6000
		    });
			$(window).load(function(){
								$('.preloader').show().delay(2000).fadeIn(function(){$(this).addClass('pull')});
							});
	
			$('[data-toggle="modal"]').click(function(){
				var el = $(this).data('target');

				if($('.overlay').hasClass('active')){
					document.getElementById("video").pause();
					$('.overlay').removeClass('active').hide();
				} else {
					$(el).show().addClass('active in');
				}
				setTimeout(function() { $(".inputbox[name=username]").focus(); }, 400);  
			});

			// $('[data-toggle="modal-video"]').click(function(){
			// 	var el = $(this).data('target');

			// 	if($('.overlay').hasClass('active')){
			// 		$('.overlay').removeClass('active').hide();
			// 	} else {
			// 		$(el).show().addClass('active in');
			// 		document.getElementById("video").play();
			// 	}
			// 	setTimeout(function() { $(".inputbox[name=username]").focus(); }, 400);  
			// });

			// $('.overlay').click(function(){
			// 	$(this).removeClass('active');
			// 	document.getElementById("video").pause();
			// });
			// $('.overlay .box').click(function(e){
			// 	e.stopPropagation();     
			// });
			// $('.overlay .close').click(function(){
			// 	$(this).parents('.overlay').removeClass('active');
			// 	document.getElementById("video").pause();
			// });
			
			function showOver(target){
				$(target).show().addClass('active in');
				setTimeout(function() { $(".inputbox[name=username]").focus(); }, 400);
			}
			});
	</script>
</body>
</html>