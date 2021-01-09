<?php
session_start();
include '../../../database/koneksi.php';

$id = $_POST['id'];

$image = "SELECT * FROM data_buku WHERE id_buku='$id'";
$query = mysqli_query($koneksi, $image);
$after = mysqli_fetch_assoc($query);

if ($after['item_image'] != 'default.png') {
    unlink('../../../public/images/public_images/'.$after['item_image']);
    unlink('../../Siswa/ebook/external/read/web/'.$after['item_document']);
}

$query1 = "DELETE FROM data_buku WHERE id_buku=?";
$data1 = $koneksi->prepare($query1);
$data1->bind_param("s", $id);
$data1->execute();

echo json_encode(['success' => 'Sukses']);

$koneksi->close();
?>