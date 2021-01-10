<?php
session_start();
include '../../../database/koneksi.php';

$id = $_POST['id'];

$query = "DELETE FROM akun WHERE id_anggota=?";
$data = $koneksi->prepare($query);
$data->bind_param("s", $id);
$data->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>