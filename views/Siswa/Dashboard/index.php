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

?>
<?php
// require_once ('../konten/CreateDB.php');
require_once ('../konten/component.php');


// create instance of Createdb class
// $database = new CreateDb("Productdb", "Producttb");
$database = new mysqli("localhost","root","","productdb");

if (isset($_POST['add'])){
  /// print_r($_POST['product_id']);
  if(isset($_SESSION['cart'])){

      $item_array_id = array_column($_SESSION['cart'], "product_id");

      if(in_array($_POST['product_id'], $item_array_id)){
          echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Opps...',
            text: 'Buku Telah Ada di Daftar Peminjaman!'
            }).then((result) =>{
              if(result.value){
                
              }
            })
          </script>";
      }else{

          $count = count($_SESSION['cart']);
          $item_array = array(
              'product_id' => $_POST['product_id']
          );

          $_SESSION['cart'][$count] = $item_array;
      }

  }else{

      $item_array = array(
              'product_id' => $_POST['product_id']
      );

      // Create new session variable
      $_SESSION['cart'][0] = $item_array;
      print_r($_SESSION['cart']);
  }
}

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
  <link rel="stylesheet" href="../../../public/css/cart.css">
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
              <div class="row text-center py-5">
                    <?php
                        $sql = "SELECT * FROM producttb";
                        $result = $database->query($sql);
                        while ($row = mysqli_fetch_assoc($result)){
                            component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                        }
                    ?>
              </div>
                        
                            <div class="card-body">
                            <nav>
                                <ul class="pagination d-flex flex-wrap justify-content-center pagination-primary">
                                <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </nav>
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
if(in_array($_POST['product_id'], $item_array_id)){
  echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Opps...',
    text: 'Buku Telah Ada di Daftar Peminjaman!'
    }).then((result) =>{
      if(result.value){
        
      }
    })
  </script>";
}
?>