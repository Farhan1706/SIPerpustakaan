<?php
    include '../../../database/koneksi.php';

    if(isset($_POST['nama'])){
        $Uinput = strtoupper($_POST['nama_pdk']);

        $sql_simpan = "INSERT INTO jurusan (nama,nama_pdk) VALUES (
        '".$_POST['nama']."',
        '".$Uinput."')";

        if (mysqli_query($koneksi, $sql_simpan)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($koneksi);
    }
?>