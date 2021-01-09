<?php
session_start();
include '../../../database/koneksi.php';

$id = $_POST['id'];

$query = "DELETE FROM pengumuman WHERE id=?";
$data = $koneksi->prepare($query);
$data->bind_param("i", $id);
$data->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>