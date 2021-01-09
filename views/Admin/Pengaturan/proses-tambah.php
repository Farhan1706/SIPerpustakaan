<?php
    include '../../../database/koneksi.php';

    if(isset($_POST['kode_jenis'])){
        $sql_simpan = "INSERT INTO settings (kode_jenis,nama_jenis) VALUES (
        '".$_POST['kode_jenis']."',
        '".$_POST['nama_jenis']."')";

        if (mysqli_query($koneksi, $sql_simpan)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($koneksi);
    }
?>