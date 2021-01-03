<?php 
$database = new mysqli("localhost","root","","productdb");
if (isset($_SESSION['cart'])){
    $product_id = array_column($_SESSION['cart'], 'product_id');
    $query="INSER INTO masuk VALUES";
}
?>