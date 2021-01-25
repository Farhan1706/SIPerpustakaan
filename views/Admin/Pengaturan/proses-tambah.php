<?php
    include '../../../database/koneksi.php';

    if(isset($_POST['kode_jenis'])){
        $Uinput = strtoupper($_POST['kode_jenis']);

        $sql_simpan = "INSERT INTO settings (kode_jenis,nama_jenis) VALUES (
        '".$Uinput."',
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