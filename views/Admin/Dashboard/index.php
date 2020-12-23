<?php
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
	$sql = $koneksi->query("SELECT count(id_buku) as buku from data_buku");
	while ($data= $sql->fetch_assoc()) {
	
		$buku=$data['buku'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_anggota) as agt from akun");
	while ($data= $sql->fetch_assoc()) {
	
		$agt=$data['agt'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_sk) as pin from data_transaksi where status='PIN'");
	while ($data= $sql->fetch_assoc()) {
	
		$pin=$data['pin'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_sk) as kem from data_transaksi where status='KEM'");
	while ($data= $sql->fetch_assoc()) {
	
		$kem=$data['kem'];
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
          <div class="card mb-2">
            <div class="alert alert-fill-primary" role="alert">
              <i class="mdi mdi-alert-circle" data-toggle="tooltip" data-placement="top" title data-original-title="Pengumuman Terkini!"></i>
              <div class="dropdown float-right">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuIconButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-settings"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton6" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 46px, 0px);">
                  <h6 class="dropdown-header">Tampilkan Data:</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Hari Ini</a>
                  <a class="dropdown-item" href="#">Minggu Ini</a>
                  <a class="dropdown-item" href="#">Bulan Ini</a>
                </div>
                </div>
            </div>
            <div class="row ml-1 mr-1">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-facebook d-flex align-items-center">
                  <div class="card-body py-5">
                    <div class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                      <i class="mdi mdi-book text-white icon-lg"></i>
                      <div class="ml-3 ml-md-0 ml-xl-3">
                        <h5 class="text-white font-weight-bold">Peminjaman</h5>
                        <p class="mt-2 text-white card-text">
                        <?php
                        $total_peminjaman = $pin;
                        if ($total_peminjaman==0){
                          echo("Tidak Ada Peminjaman");
                        }else{
                          echo("Total ".$total_peminjaman." Peminjaman");
                        }
                        ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-linkedin d-flex align-items-center">
                  <div class="card-body py-5">
                    <div class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                      <i class="mdi mdi-account-plus text-white icon-lg"></i>
                      <div class="ml-3 ml-md-0 ml-xl-3">
                        <h5 class="text-white font-weight-bold">Anggota</h5>
                        <p class="mt-2 text-white card-text">
                        <?php 
                        if ($agt==0){
                          echo("Tidak Ada Anggota Baru");
                        }else{
                          echo("Total ".$agt." Anggota");
                        }
                        ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-twitter d-flex align-items-center">
                  <div class="card-body py-5">
                    <div class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                      <i class="mdi mdi-book-plus text-white icon-lg"></i>
                      <div class="ml-3 ml-md-0 ml-xl-3">
                        <h5 class="text-white font-weight-bold">Buku</h5>
                        <p class="mt-2 text-white card-text">
                        <?php 
                        if ($buku==0){
                          echo("Tidak Ada Buku Baru");
                        }else{
                          echo("".$buku." Buku Tersedia");
                        }
                        ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Akhir Row Data Dashboard -->
          </div>
          <div class="card px-3">
								<div class="card-body">
									<h4 class="card-title">Agenda Hari Ini</h4>
									<div class="add-items d-flex">
										<input type="text" class="form-control todo-list-input" placeholder="Tambahkan Agenda?">
										<button class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button>
									</div>
									<div class="list-wrapper">
										<ul class="d-flex flex-column-reverse todo-list">
                      <div class="tampil_todolist"></div>
										</ul>
									</div>
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
  <script src="../../../public/js/alerts.js"></script>
  <!-- End custom js for this page-->
  <!-- Todolist -->
  <script>
  function doRefresh(){
        $(".tampil_todolist").load("tampil_todolist.php");
    }
    $(function() {
        setInterval(doRefresh, 1500);
    });


  (function($) {
  'use strict';
  $(function() {
    var todoListItem = $('.todo-list');
    var todoListInput = $('.todo-list-input');
    $('.todo-list-add-btn').on("click", function(event) {
      event.preventDefault();

      var item = $(this).prevAll('.todo-list-input').val();

      if (item != null) {
        $.ajax({
          url: "proses_agenda.php",
          type: "POST",
          data: {
            item:item	
          },
          cache: false,
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            $('.todo-list-input').each(function(){
              $('input').val('')
            });
          }
        });
      }

    });

    todoListItem.on('click', '.remove', function() {
		  var id = $(this).attr('id');
		  $.ajax({
			  url: "hapus_agenda.php",
			  type: "POST",
			  data: {id:id},
			  cache: false
			});
		});

  });
})(jQuery);
  </script>
  <!-- END Todolist -->
</body>

</html>