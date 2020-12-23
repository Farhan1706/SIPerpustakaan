<div class="d-none">
<?php
include "database/koneksi.php";
require_once "UIDContainer.php";
if(!empty($UIDresult)){
	$rfid = $UIDresult;

    $sql = "SELECT * FROM akun WHERE rfid='$rfid';";
    $result = $koneksi -> query($sql);
    $row = $result -> fetch_assoc();
    if($row['status']=="Admin"){
        session_start();
        $_SESSION['email']=$row['email'];
        header("Location: views/Admin/Anggota/data_anggota.php");
    }elseif($row['status']=="Siswa"){
        session_start();
        $_SESSION['email']=$row['email'];
        header("Location: views/Siswa");
    }
}
?>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistem Perpustakaan</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="public/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="public/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="public/mdi/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="public/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="public/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="public/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="public/css/login-util.css">
	<link rel="stylesheet" type="text/css" href="public/css/login-main.css">
<!--===============================================================================================-->
</head>
<body>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic">
					<div class="js-tilt" data-tilt>
						<img src="public/images/auth/img-01.png" alt="IMG">
					</div>
					<span class="login100-form-title mt-4">
						Masuk Dengan Kartu? </br>Tekan Gambar Di bawah<a type="button" href="auth-rfid"> <img src="public/images/auth/login-rfid.gif" alt="IMG" height="70px"></a>
					</span>
				</div>
				<form class="login100-form validate-form" action="views/Auth/autentikasi.php" method="POST">
					<span class="login100-form-title">
						Masuk Dengan Akun
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Lupa
						</span>
						<a class="txt2" href="views/auth">
							Email / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
					<a target="_blank" class="txt2" href="https://wa.me/+6287827575920?text=Saya%20hendak%20membuat%20akun%20perpustakaan`">
							Belum Memiliki Akun ? </br> Hubungi Admin Sekarang
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
					
				</form>
			</div>
		</div>
	</div>

	</textarea>

	<!-- Modal Autentifikasi -->
	<div class="modal fade" id="5f4dcc3b5aa765d61d8327deb882cf99" tabindex="-1" aria-labelledby="password" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="5f4dcc3b5aa765d61d8327deb882cf99">Login</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Email atau Password yang Anda Masukan Salah!
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>
	<!-- END Modal Autentifikasi -->
	
	

	
<!--===============================================================================================-->	
	<script src="public/js/jquery-3.4.1.min.js"></script>
<!--===============================================================================================-->
	<script src="public/vendor/bootstrap/js/popper.js"></script>
	<script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="public/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="public/vendor/tilt/tilt.jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		$("#getUID").load("UIDContainer.php");
	setInterval(function() {
		$("#getUID").load("UIDContainer.php");	
	}, 500);
	});
	</script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script> -->
	<!-- <script type="text/javascript">
		var auto_refresh = setInterval(
		function () {
		$('#load_content').load('./test.php').fadeIn("slow");
		}, 10000); // refresh setiap 10000 milliseconds
		
	</script> -->
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<?php 
    if (isset($_GET['cb5e100e5a9a3e7f6d1fd97512215282'])){
        if($_GET['cb5e100e5a9a3e7f6d1fd97512215282']=="5f4dcc3b5aa765d61d8327deb882cf99"){
    echo('<script type="text/javascript">');
    echo('$(window).on("load",function(){');
    echo('    $("#5f4dcc3b5aa765d61d8327deb882cf99").modal("show");');
    echo('});');
    echo('</script>');
        }
    }
    ?>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>