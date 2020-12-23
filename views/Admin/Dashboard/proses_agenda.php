<?php
    include '../../../database/koneksi.php';
    $sql_simpan = "INSERT INTO agenda VALUES (' ', 0,
       '".$_POST['item']."')";
	if (mysqli_query($koneksi, $sql_simpan)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($koneksi);
?>