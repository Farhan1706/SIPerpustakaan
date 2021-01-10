<?php
session_start();
include '../../database/koneksi.php';
 
if(!empty($_POST)){

    $email = $_POST['email'];
 
	$stmt = $koneksi->prepare("SELECT * FROM akun WHERE email=?");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc(); 
	
	// Pencocokan Hash
	$passwordFromPost = $_POST['password'];
	$hashedPasswordFromDB = $row['password'];

	if (password_verify($passwordFromPost, $hashedPasswordFromDB)) {
		if($row['level']=="Admin"){
			session_start();
			$_SESSION['email']=$email;
			$_SESSION['level']="Admin";
			header('Location: ../Admin/Dashboard');
		}

		if($row['level']=="Petugas"){
			session_start();
			$_SESSION['email']=$email;
			$_SESSION['level']="Petugas";
			header('Location: ../Petugas/Dashboard');
		}

		if($row['level']=="Siswa" || $row['level']=="NSiswa"){
			session_start();
			$_SESSION['email']=$email;
			$_SESSION['level']="Siswa";
			header('Location: ../Siswa/Dashboard');
			}
	} else {
		header("Location: ../../auth?cb5e100e5a9a3e7f6d1fd97512215282=5f4dcc3b5aa765d61d8327deb882cf99");
	}
}