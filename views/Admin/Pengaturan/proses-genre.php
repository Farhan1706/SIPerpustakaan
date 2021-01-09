<?php

include "../../../database/koneksi.php";

$input = filter_input_array(INPUT_POST);
$Uinput = strtoupper($input['kode_jenis']);
 
if ($input['action'] === 'edit') 
{   
    $sql = "UPDATE settings SET kode_jenis ='" . $Uinput . "', nama_jenis='" . $input['nama_jenis'] . "'" ." WHERE id='" . $input['id'] . "'";
    
    mysqli_query($koneksi,$sql);
} 
if ($input['action'] === 'delete') 
{
    mysqli_query($koneksi,"DELETE FROM settings   WHERE id='" . $input['id'] . "'");
} 
 
 
mysqli_close($mysqli);
 
echo json_encode($input);

?>