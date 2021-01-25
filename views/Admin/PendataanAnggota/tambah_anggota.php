<?php
    include '../../../database/koneksi.php';

    if(isset($_POST['email'])){
        $today    = date("Y-m-d h:i:s");

        $options = [
            'cost' => 11,
        ];
        // Get the password from post
        $passwordFromPost = $_POST['password'];
        
        $hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $options);

        $kelas = $_POST['tingkat'].' ' .$_POST['jurusan']. ' ' .$_POST['kelompok'];

        $sql_simpan = "INSERT INTO akun (id_anggota,email,password,rfid,no_hp,nama,jekel,kelas,level) VALUES (
        '".$_POST['id_anggota']."',
        '".$_POST['email']."',
        '".$hash."',
        '".$_POST['rfid']."',
        '".$_POST['no_hp']."',
        '".$_POST['nama']."',
        '".$_POST['jekel']."',
        '".$kelas."',
        '".$_POST['level']."')";
        $sql_log = "INSERT INTO log_akun(id_anggota,tgl_pembuatan) VALUES (
            '".$_POST['id_anggota']."',
            '".$today."')";

        if (mysqli_query($koneksi, $sql_simpan)) {
            $koneksi->query($sql_log);
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
        mysqli_close($koneksi);
    }
?>