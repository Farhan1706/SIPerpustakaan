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

// Inisiasi Untuk Info Akun
$sql = "SELECT * FROM akun WHERE email='$email';";
   $result = $koneksi -> query($sql);
   $akun = $result -> fetch_assoc(); 

if (isset($_POST['add'])){
  
  if($akun['level']=="NSiswa"){
    header("Location:?action=dilarang");
  }else{
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
    }
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
  <link rel="stylesheet" href="../../../public/css/owl.carousel.min.css">
  <link rel="stylesheet" href="../../../public/css/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- Data Table CSS Bs4 -->
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
          <div class="row">
          <div class="col alert alert-fill-primary" role="alert">
              <i class="mdi mdi-alert-circle" data-toggle="tooltip" data-placement="top" title data-original-title="Pengumuman Terkini!"></i>
              <marquee>
              <?php
              $stmt = $koneksi->prepare("SELECT * FROM pengumuman");
              $stmt->execute();
              $hp = $stmt->get_result();
              while($p = $hp->fetch_assoc()){
                echo "<div class='badge badge-pill badge-primary '><i class='mdi mdi-bullhorn'></i>".$p['keterangan']."</div>";
              }
              ?>
              </marquee>
            </div>
            <div class="col grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="owl-carousel owl-theme full-width">
                    <div class="item">
                      <div class="card text-white">
                        <img class="card-img" src="../../../public/images/carousel/lg1.jpg" alt="Card image">
                        <div class="card-img-overlay d-flex">
                          <div class="mt-auto text-center w-100">
                            <h3>Perpustakaan SMKN 1 Cimahi</h3>
                            <h6 class="card-text mb-4 font-weight-normal">Pintu Masuk Perpustakaan</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="card text-white">
                        <img class="card-img" src="../../../public/images/carousel/lg2.jpg" alt="Card image">
                        <div class="card-img-overlay d-flex">
                          <div class="mt-auto text-center w-100">
                            <h3>Perpustakaan SMKN 1 Cimahi</h3>
                            <h6 class="card-text mb-4 font-weight-normal">Tempat Membaca</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="card text-white">
                        <img class="card-img" src="../../../public/images/carousel/lg3.jpg" alt="Card image">
                        <div class="card-img-overlay d-flex">
                          <div class="mt-auto text-center w-100">
                            <h3>Perpustakaan SMKN 1 Cimahi</h3>
                            <h6 class="card-text mb-4 font-weight-normal">Rak Koleksi Buku</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="card text-white">
                        <img class="card-img" src="../../../public/images/carousel/lg4.jpg" alt="Card image">
                        <div class="card-img-overlay d-flex">
                          <div class="mt-auto text-center w-100">
                            <h3>Perpustakaan SMKN 1 Cimahi</h3>
                            <h6 class="card-text mb-4 font-weight-normal">Tempat Membaca</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="owl-carousel owl-theme loop">
                    <div class="item">
                      <img src="../../../public/images/carousel/lg1.jpg" alt="image"/>
                    </div>
                    <div class="item">
                      <img src="../../../public/images/carousel/lg2.jpg" alt="image"/>
                    </div>
                    <div class="item">
                      <img src="../../../public/images/carousel/lg3.jpg" alt="image"/>
                    </div>
                    <div class="item">
                      <img src="../../../public/images/carousel/lg4.jpg" alt="image"/>
                    </div>
                    <div class="item">
                      <img src="../../../public/images/carousel/img7.jpg" alt="image"/>
                    </div>
                    <div class="item">
                      <img src="../../../public/images/carousel/img6.jpg" alt="image"/>
                    </div>
                    <div class="item">
                      <img src="../../../public/images/carousel/img4.jpg" alt="image"/>
                    </div>
                    <div class="item">
                      <img src="../../../public/images/carousel/img5.jpg" alt="image"/>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                    <div class="iframe-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.2252150464717!2d107.53801696707123!3d-6.902458424853561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e5a529094097%3A0x5d638aee4fd75b1d!2sSMK%20Negeri%201%20Cimahi!5e0!3m2!1sid!2sid!4v1610278571749!5m2!1sid!2sid" width="1200" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../../public/Partials/_footer -->
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
  <!-- inject:js -->
  <script src="../../../public/js/off-canvas.js"></script>
  <script src="../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../../../public/js/owl.carousel.min.js"></script>
  <!-- END Plugin js for this page-->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/owl-carousel.js"></script>
  <!-- End custom js for this page-->
</body>

</html>