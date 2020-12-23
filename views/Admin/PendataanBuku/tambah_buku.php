<?php
    include '../../../database/koneksi.php';
if(isset($_FILES['file']['name'])){

    // Mendapatkan file
    $imgFile = $_FILES['file']['name'];
    $tmp_dir = $_FILES['file']['tmp_name'];
    $imgSize = $_FILES['file']['size'];

    // setting file
    $upload_dir = '../../../public/images/public_images/';
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
    $itempic = rand(1000,1000000).".".$imgExt;

    // queri
    $sql_simpan = "INSERT INTO data_buku (id_buku,judul_buku,pengarang,penerbit,th_terbit,item_image) VALUES (
        '".$_POST['id_buku']."',
       '".$_POST['judul_buku']."',
       '".$_POST['pengarang']."',
       '".$_POST['penerbit']."',
       '".$_POST['th_terbit']."',
       '".$itempic."')";

    /* Check file extension */
    if(in_array($imgExt, $valid_extensions)){
            /* Upload file */
            if(mysqli_query($koneksi,$sql_simpan)){
                // move_uploaded_file($_FILES['file']['tmp_name'],$location);
                move_uploaded_file($tmp_dir,$upload_dir.$itempic);
                echo json_encode(array("statusCode"=>200));
                exit;
            }
    }
}
echo json_encode(array("statusCode"=>201));