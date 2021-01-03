<?php
error_reporting(0);
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../database/koneksi.php';

// require_once ('../konten/CreateDB.php');
require_once ('../konten/component.php');

// $db = new CreateDb("Productdb", "Producttb");
$database = new mysqli("localhost","root","","productdb");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Perpustakaan</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- Data Table CSS Bs4 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <!-- END Data Table CSS Bs4 -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../../public/css/vertical-style.css">
  <link rel="stylesheet" href="../../../public/css/Custom.css">
  <!-- endinject -->
</head>
<body>
  <div class="container-scroller d-flex">

    <!-- partial:../../../../Partials/_sidebar.html -->
    <?php include '../Partials/_sidebar.php'; ?>
    <!-- partial -->
    
    <div class="container-fluid page-body-wrapper">
      
    <!-- partial:../../../../Partials/_navbar.html -->
    <?php include '../Partials/_navbar.php'; ?>
    <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row ml-1 mr-1">
              <div class="col">
                <div class="shopping-cart">
                  <?php
                      if (isset($_SESSION['cart'])){
                          $product_id = array_column($_SESSION['cart'], 'product_id');
                          $count = count($_SESSION['cart']);
                          if($count>0){
                            echo "
                            <div class='col-12 grid-margin stretch-card'>
                                    <div class='row col'>
                                      <a class='btn btn-primary btn-icon-text shadow' href='#'>
                                          Ajukan Peminjaman
                                          <i class='mdi mdi-check btn-icon-prepend'></i>
                                      </a>
                                    </div>
                            </div>
                            ";
                            $sql = "SELECT * FROM producttb";
                            $result = $database->query($sql);
                            while ($row = mysqli_fetch_assoc($result)){
                                foreach ($product_id as $id){
                                    if ($row['id'] == $id){
                                        cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
                                        
                                    }
                                }
                            }
                          }else{
                            echo "
                            <div class='card col'>
                              <div class='card-body'>
                                <blockquote class='blockquote blockquote-primary'>
                                  <p>Belum ada Buku yang Ditambahkan Menuju Keranjang!</p>
                                  <footer class='blockquote-footer'>Anda Dapat Menambahkan Buku pada <a style='text-decoration:none' href='../Dashboard'>Halaman Utama Peminjaman <i class='mdi mdi-home'></i> </a></footer>
                                </blockquote>
                              </div>
                            </div>
                            ";
                          }

                          
                      }else{
                          echo "<h5>Cart is Empty</h5>";
                      }

                  ?>
                </div>
                <!-- END CART -->
              </div>
            </div>
        </div>
          <!-- content-wrapper ends -->
      <!-- partial:../../../../Partials/_footer -->
      <?php include '../Partials/_footer.php'; ?>
      <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="../../../public/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../../../public/js/Chart.min.js"></script>
  <script src="../../../public/js/chart.js"></script>
  <script src="../../../public/js/sweetalert.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../../public/js/off-canvas.js"></script>
  <script src="../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <!-- <script src="../../../public/js/todolist.js"></script> -->
  <script src="../../../public/js/tooltips.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- End custom js for this page-->
</body>

</html>

<?php 
if (isset($_GET['action'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["product_id"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>
              Swal.fire({
                icon: 'success',
                title: 'Menghapus Buku dari Daftar Peminjaman!',
                showConfirmButton: false,
                timer: 2000
                }).then((result) =>{
                    window.location ='./cart_buku';
                })
              </script>";
          }
      }
  }
}

if (isset($_POST['cart_pinjam'])){
  if ($_GET['action'] == 'cart_pinjam'){
      foreach ($_SESSION['cart'] as $value){
          $stmt = $database->prepare("INSERT INTO masuk VALUES ('','".$value[product_name]."')");
          $stmt->execute();
      }
  }
}
?>