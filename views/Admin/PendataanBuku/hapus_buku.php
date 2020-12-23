<?php
session_start();
include '../../../database/koneksi.php';

$id = $_POST['id'];

$image = "SELECT * FROM data_buku WHERE id_buku='$id'";
$query = mysqli_query($koneksi, $image);
$after = mysqli_fetch_assoc($query);

if ($after['image'] != 'default.png') {
    unlink('../../../public/images/public_images/'.$after['item_image']);
}

$query1 = "DELETE FROM data_buku WHERE id_buku=?";
$data1 = $koneksi->prepare($query1);
$data1->bind_param("i", $id);
$data1->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>