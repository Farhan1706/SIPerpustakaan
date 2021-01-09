<?php
session_start();
include '../../../../database/koneksi.php';

$id = $_POST['id_pinjam'];
$tgl_pinjam = date('Y-m-d');
$tgl_kembali= date('Y-m-d', strtotime('+7 days', strtotime($tgl_pinjam))); //membuat tanggal pengembalian buku + 7 hari
$status = 'PIN';

$tgl_jam = date('Y-m-d ');

// Update Data Buku
$stmt = $koneksi->prepare("UPDATE data_transaksi SET tgl_pinjam=?, tgl_kembali=?, status=? WHERE id_sk=?");
$stmt->bind_param("ssss", $tgl_pinjam, $tgl_kembali, $status, $id);
$stmt->execute();

// Mencari Data Untuk Log
$stmt = $koneksi->prepare("INSERT INTO log_pinjam(id_buku,id_anggota,tgl_pinjam) SELECT id_buku,id_anggota,tgl_pinjam FROM data_transaksi WHERE id_sk=?");
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->close();

?>