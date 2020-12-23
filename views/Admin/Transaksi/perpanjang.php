<?php
    include '../../../database/koneksi.php';
    
    if(isset($_POST['id'])){
        $sql_cek = "SELECT * FROM data_transaksi WHERE id='".$_POST['id']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $row = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
      }
    //menangkap tanggal
    $tgl_p=$row['tgl_pinjam'];

    //membuat tgl kembali
	$tgl_pp=date('Y-m-d', strtotime('+7 days', strtotime($tgl_p)));
    $tgl_kk=date('Y-m-d', strtotime('+14 days', strtotime($tgl_p)));

    $sql_ubah = "UPDATE data_transaksi SET
        tgl_pinjam='$tgl_pp',
        tgl_kembali='$tgl_kk'
        WHERE id='".$_POST['id']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    // if ($query_ubah) {
    //     echo "<script>
    //     Swal.fire({title: 'Perpanjang Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
    //     }).then((result) => {
    //         if (result.value) {
    //             window.location.href = 'index';
    //         }
    //     })</script>";
    //     }else{
    //     echo "<script>
    //     Swal.fire({title: 'Perpanjang Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
    //     }).then((result) => {
    //         if (result.value) {
    //             window.location.href = 'index';
    //         }
    //     })</script>";
    // }

