<?php

include "../../../database/koneksi.php";

$input = filter_input_array(INPUT_POST);
$Uinput = strtoupper($input['nama_pdk']);
 
if ($input['action'] === 'edit') 
{   
    $sql = "UPDATE jurusan SET nama ='" . $input['nama'] . "', nama_pdk='" . $Uinput . "'" ." WHERE nama_pdk='" . $input['kode'] . "'";
    
    mysqli_query($koneksi,$sql);
} 
if ($input['action'] === 'delete') 
{
    mysqli_query($koneksi,"DELETE FROM jurusan WHERE nama_pdk='" . $input['kode'] . "'");
} 
 
 
mysqli_close($mysqli);
 
echo json_encode($input);

?>