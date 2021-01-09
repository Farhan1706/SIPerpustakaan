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
// include '../../../database/database.php';

require_once ('../konten/component.php');


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
      // print_r($_SESSION['cart']);
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
        <!-- Search Start -->
        <div class="card">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Cari Buku..." aria-label="Recipient's username">
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-primary" type="button">Search</button>
                      </div>
                    </div>
            </li>
          </ul>
        </div>
        <!-- Search END -->
            <div class="row ml-1 mr-1">
              <div class="row text-center py-5">
                    <?php
                        // Numbering Untuk Pagination
                        // Cek apakah terdapat data pada page URL
                        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

                        $limit = 12; // Jumlah data per halamanya

                        // Buat query untuk menampilkan data ke berapa yang akan ditampilkan pada tabel yang ada di database
                        $limit_start = ($page - 1) * $limit;

                        // Buat query untuk menampilkan data buku sesuai limit yang ditentukan                        
                        $sql = "SELECT * FROM data_buku LIMIT $limit_start,$limit";
                        $stmt = $koneksi->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()){
                            component($row['judul_buku'], $row['item_image'], $row['id_buku']);
                        }
                    ?>
              </div>
                            <div class="card-body">
                            <nav>
                                <ul class="pagination d-flex flex-wrap justify-content-center pagination-primary">
                            <!-- Numbering Untuk Pagination Button -->
                            <?php 
                            if ($page == 1) { // Jika page adalah pake ke 1, maka disable link PREV
                            ?>
                                <li class="page-item" disabled><a class="page-link" href="#">First</a></li>
                                <li class="page-item" disabled><a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a></li>
                            <?php 
                            }else{ //Jika buka page ke 1
                              $link_prev = ($page>1) ? $page - 1 : 1;
                            ?>
                              <li class="page-item"><a class="page-link" href="index.php?page=1">First</a></li>
                              <li class="page-item"><a class="page-link" href="index.php?page<?php echo $link_prev; ?>"><i class="mdi mdi-chevron-left"></i></a></li>
                            <?php 
                            }
                            ?>
                                
                                <!-- Link Number -->
                                <?php
                                // Buat query untuk menghitung semua jumlah data
                                $sql2 = $koneksi->prepare("SELECT COUNT(*) AS jumlah FROM data_buku");
                                $sql2->execute();
                                $result = $sql2->get_result();
                                $get_jumlah = $result->fetch_assoc();

                                $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);//Hitung Jumlah halaman
                                $jumlah_number = 3; //Tentukan jumlah link number sebelum dan sesudah page yang aktif
                                $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link member
                                $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
                                // Perulangan Untuk Button
                                for ($i = $start_number; $i <= $end_number; $i++){
                                  $link_active = ($page == $i) ? 'active' : '';
                                ?>
                                  <li class="page-item <?php echo $link_active; ?>"> <a class="page-link" href="index.php?page=<?php echo $i; ?>"> <?php echo $i; ?></a></li>
                                <?php 
                                }
                                ?>

                                <!-- LINK NEXT AND LAST -->
                                <?php
                                // Jika page sama dengan jumlah page, maka disable link NEXT nya
                                // Artinya page tersebut adalah page terakhir
                                if ($page == $jumlah_page) { // Jika page terakhir
                                ?>
                                    <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">Last</a></li>
                                <?php
                                } else { // Jika bukan page terakhir
                                    $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
                                ?>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $link_next ?>"><i class="mdi mdi-chevron-right"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $jumlah_page ?>">Last</a></li>
                                <?php
                                }
                                ?>
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

if (isset($_GET['action'])){
  if ($_GET['action'] == 'proses'){
    unset($_SESSION['cart']);
    echo "
    <script>
    Swal.fire({
      icon: 'success',
      title: 'Peminjaman Telah Diajukan!',
      showConfirmButton: false,
      timer: 2000
      }).then((result) =>{
          window.location ='../Dashboard';
      })
    </script>
    ";
  }
}
?>