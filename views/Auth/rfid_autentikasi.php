<?php
session_start();
    require '../../database/koneksi.php';
    $id = null;
    if ( !empty($_GET['rfid'])) {
        $id = $_REQUEST['rfid'];
    }

    $sql = "SELECT * FROM akun WHERE rfid='$id';";
    $result = $koneksi -> query($sql);
    $row = $result -> fetch_assoc();
    if($row['status']=="Admin"){
        session_start();
        $_SESSION['email']=$row['email'];
        header("Location: /sipus/views/Admin/Dashboard");
    }elseif($row['status']=="Petugas"){
        session_start();
        $_SESSION['email']=$row['email'];
        header("Location: /sipus/views/Petugas/Dashboard");
    }elseif($row['status']=="Siswa"){
        session_start();
        $_SESSION['email']=$row['email'];
        header("Location: /sipus/views/Siswa/Dashboard");
    }
    else{
        header("Location: ./destroy.php");
    }
?>

<?php
// include "database/koneksi.php";
// require_once "UIDContainer.php";
// if(!empty($UIDresult)){
// 	$rfid = $UIDresult;

//     $sql = "SELECT COUNT(*) FROM akun WHERE rfid='$rfid';";
// 	$result = $koneksi -> query($sql);
// 	if($result->mysqli_num_rows > 0){
// 		$row = $result -> fetch_assoc();
// 		if($row['level']=="Admin"){
// 			session_start();
// 			$_SESSION['email']=$row['email'];
// 			header("Location: views/Admin/Dashboard");
// 		}elseif($row['level']=="Siswa"){
// 			session_start();
// 			$_SESSION['email']=$row['email'];
// 			header("Location: views/Siswa");
// 		}
// 	}else{
// 		echo "<script>
//         Swal.fire({title: 'RFID Belum Terdaftar',text: '',icon: 'success', showConfirmButton: false, timer: 3500
//         }).then((result) => {
//           window.location = './auth-rfid';
//         })					
//         }
//         </script>";
// 	}
// }
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
    <script>
    $(document).ready(function(){
		$("#getUID").load("UIDContainer.php");
	setInterval(function() {
		$("#getUID").load("UIDContainer.php");	
	}, 500);
    });

    </script>
    
</head>
<body>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form">
					<span class="login100-form-title mt-8"></br>
						Masuk Dengan Kartu </br><img src="public/images/auth/tap_card.png" alt="IMG" height="200px"></a>
					</span>
                    <center>
                    <span class="text-justify">Tempelkan Kartu Anda Untuk Masuk Menuju Sistem</span>
                    </center>
				</div>
                <div class="login100-pic">
                <center>
                    <div class="js-tilt" data-tilt>
						<img src="public/images/auth/login-rfid.gif" alt="IMG" height="180px">
					</div>
					<span class="login100-form-title mt-4">
						Masuk Dengan Email? </br>Tekan Gambar Di bawah<a type="button" href="auth"> <img src="public/images/auth/img-01.png" alt="IMG" height="50px"></a>
					</span>
                </center>
                </div>
				
			</div>
		</div>
	</div>
	

	
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
    setTimeout(function(){
    window.location.reload(1);
    }, 2500);
	</script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script> -->
	<!-- <script type="text/javascript">
		var auto_refresh = setInterval(
		function () {
		$('#load_content').load('./test.php').fadeIn("slow");
		}, 1000); // refresh setiap 10000 milliseconds
		
	</script> -->
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>
</html>