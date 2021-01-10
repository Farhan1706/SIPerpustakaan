<?php
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../../database/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Perpustakaan</title>
  <!-- AJAX untuk Form -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
  <!-- base:css -->
  <link rel="stylesheet" href="../../../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Data Table CSS Bs4 -->
  <link rel="stylesheet" href="../../../../public/css/dataTables.bootstrap4.css">
  <!-- END Data Table CSS Bs4 -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../../../public/css/vertical-style.css">
  <link rel="stylesheet" href="../../../../public/css/Custom.css">
  <!-- endinject -->
</head>
<body>
  <div class="container-scroller d-flex">

    <!-- partial:../../../../../Partials/_sidebar.html -->
    <?php include '../../Partials/_sidebar.php'; ?>
    
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial:../../../../../Partials/_navbar.html -->
      <?php include '../../Partials/_navbar.php'; ?>
      
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="row">
            <div class="col grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="template-demo">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb breadcrumb-custom bg-primary">
                        <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;" href="#">Pendataan</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Data Anggota</span></li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive table-hover">
                        <div class="sb"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../../partials/_footer.html -->
        <?php include '../../Partials/_footer.php'; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
<!-- Query Proses Buku START -->
  <script type="text/javascript">
  $(document).ready(function(){
   $('.sb').load("sh-agt.php");

  });
  </script>
  <!-- Query Proses Buku END -->

  <!-- base:js -->
  <script src="../../../../public/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../../../public/js/off-canvas.js"></script>
  <script src="../../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../../../public/js/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../../public/js/dashboard.js"></script>
  <script src="../../../../public/js/Custom.js"></script>
  <script src="../../../../public/js/todolist.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../../../../public/js/data-table.js"></script>
  <script src="../../../../public/js/file-upload.js"></script>
  <!-- End custom js for this page-->
</body>

</html>