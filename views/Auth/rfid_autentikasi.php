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
        header("Location: ../Admin");
    }elseif($row['status']=="Siswa"){
        session_start();
        $_SESSION['email']=$row['email'];
        header("Location: ../Siswa");
    }
    else{
        header("Location: ./destroy.php");
    }
?>