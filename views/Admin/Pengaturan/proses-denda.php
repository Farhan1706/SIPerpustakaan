<?php

include "../../../database/koneksi.php";

$input = filter_input_array(INPUT_POST);
 
if ($input['action'] === 'edit') 
{   
    $sql = "UPDATE settings SET value='" . $input['value'] . "'" ." WHERE id='" . $input['id'] . "'";
    
    mysqli_query($koneksi,$sql);
}
 
 
mysqli_close($mysqli);
 
echo json_encode($input);

?>