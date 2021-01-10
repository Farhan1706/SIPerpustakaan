<?php
session_start();
include '../../../../database/koneksi.php';

$id = $_POST['id'];

$query1 = "DELETE FROM data_transaksi WHERE id_sk=?";
$data1 = $koneksi->prepare($query1);
$data1->bind_param("s", $id);
$data1->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>