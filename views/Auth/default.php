<?php
session_start();
include '../../database/koneksi.php';
 
if(!empty($_POST)){
     
    $email = $_POST['email'];
    $password = md5($_POST['password']);
 
    $sql = "SELECT * FROM akun WHERE email='".$email."' and password='".$password."'";
    #echo $sql."<br />";	
    $query = mysqli_query($koneksi,$sql);
 
    // pengecekan query valid atau tidak
    if($query){
			$row = mysqli_num_rows($query);
			 
			// jika $row > 0 atau email dan password ditemukan
		if($row > 0){
				$level=mysqli_fetch_assoc($query);
					//Multi Level
					if($level['level']=="Admin"){
						session_start();
						$_SESSION['email']=$email;
						$_SESSION['level']="Admin";
						header('Location: ../Admin/Dashboard');
					}

					if($level['level']=="Siswa"){
						session_start();
						$_SESSION['email']=$email;
						$_SESSION['level']="Siswa";
						header('Location: ../Siswa/Dashboard');
						}
		}else{
			header("Location: ../../auth?cb5e100e5a9a3e7f6d1fd97512215282=5f4dcc3b5aa765d61d8327deb882cf99");
		}
}
}