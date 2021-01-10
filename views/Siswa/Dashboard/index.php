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
  <link rel="stylesheet" href="../../../public/css/select2.min.css">
  <link rel="stylesheet" href="../../../public/css/select2-bootstrap.min.css">
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
                        <input type="text" name="s_keyword" id="s_keyword" class="form-control" placeholder="Cari Buku..." aria-label="Recipient's username">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-primary" type="button"><i class="mdi mdi-magnify"></i></button>
                        </div>
                      </div>
              </li>
            </ul>
          </div>
          <!-- Search END -->
            <div class="data"></div>
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
  <!-- inject:js -->
  <script src="../../../public/js/off-canvas.js"></script>
  <script src="../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../../public/js/jquery.inputmask.bundle.js"></script>
  <script src="../../../public/js/inputmask.binding.js"></script>
  <script src="../../../public/js/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../../../public/js/select2.js"></script>
  <!-- End custom js for this page-->
  <script>
		$(document).ready(function(){
			load_data();
			function load_data(keyword)
			{
				$.ajax({
					method:"POST",
					url:"data.php",
					data: {keyword:keyword},
					success:function(hasil)
					{
						$('.data').html(hasil);
					}
				});
		 	}
			$('#s_keyword').keyup(function(){
	    		var keyword = $("#s_keyword").val();
				load_data(keyword);
			});
		});
	</script>
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
  if ($_GET['action'] == 'dilarang'){
    unset($_SESSION['cart']);
    echo "
    <script>
    Swal.fire({
      icon: 'error',
      title: 'Tidak Bisa Meminjam!',
      text: 'Anda Tidak Memiliki Izin Meminjam!',
      showConfirmButton: true,
      timer: 2000
      }).then((result) =>{
          window.location ='../Dashboard';
      })
    </script>
    ";
  }
}
?>