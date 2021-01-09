<?php
session_start();
include '../../../../database/koneksi.php';

$id = $_POST['id_hapus'];

$query1 = "DELETE FROM data_transaksi WHERE id=?";
$data1 = $koneksi->prepare($query1);
$data1->bind_param("i", $id);
$data1->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>