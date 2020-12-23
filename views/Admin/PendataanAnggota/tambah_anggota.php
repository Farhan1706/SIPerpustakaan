<?php
    include '../../../database/koneksi.php';

    if(isset($_POST['email'])){
        $sql_simpan = "INSERT INTO akun (id_anggota,email,password,rfid,no_hp,nama,jekel,kelas,level) VALUES (
        '".$_POST['id_anggota']."',
        '".$_POST['email']."',
        MD5('".$_POST['password']."'),
        '".$_POST['rfid']."',
        '".$_POST['no_hp']."',
        '".$_POST['nama']."',
        '".$_POST['jekel']."',
        '".$_POST['kelas']."',
        '".$_POST['level']."')";

        if (mysqli_query($koneksi, $sql_simpan)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($koneksi);
    }
?>