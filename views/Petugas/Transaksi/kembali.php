<?php
include '../../../database/koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d');

    if(isset($_POST['id'])){
    $sql_ubah = "UPDATE data_transaksi SET status='KEM', tgl_kembali='".$date."' WHERE id='".$_POST['id']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    // if ($query_ubah) {
        //     echo "<script>
    //     Swal.fire({title: 'Kembalikan Buku Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        //     }).then((result) => {
            //         if (result.value) {
    //             window.location.href = 'index';
    //         }
    //     })</script>";
    //     }else{
    //     echo "<script>
    //     Swal.fire({title: 'Kembalikan Buku Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    //     }).then((result) => {
        //         if (result.value) {
    //             window.location.href = 'index';
    //         }
    //     })</script>";
    // }
    header("Location: index");
    }
