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

$id = $_GET['id'];
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
            <!-- Konten Start -->
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                        <?php 
                            // Inisiasi Kueri
                            $stmt = $koneksi->prepare("SELECT * FROM data_buku WHERE id_buku='$id'");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row1 = $result->fetch_assoc();

                            ?>
                        <div class="border-bottom text-center pb-4">
                            <img src="../../../public/images/public_images/<?php echo $row1['item_image'] ?>" alt="profile" class="img-fluid mb-3">
                            <div class="mb-3">
                            <h3><?php echo $row1['judul_buku'] ?></h3>
                            </div>
                            
                        </div>
                        <div class="border-bottom py-4">
                            <p>Jenis Buku</p>
                            <div>
                            <?php
                            $unik = $id;
                            $Punik = substr($unik, 0, 3);
                            $stmt = $koneksi->prepare("SELECT * FROM settings WHERE kode_jenis='$Punik'");
                            $stmt->execute();
                            $result =  $stmt->get_result();
                            $row2 = $result->fetch_assoc();
                            ?>
                            <label class="badge badge-outline-dark"><?php echo $row2['nama_jenis'] ?></label>
                            </div>                                                               
                        </div>
                        <div class="py-4">
                            <p class="clearfix">
                            <span class="float-left">
                                Pengarang
                            </span>
                            <span class="float-right text-muted">
                            <?php echo $row1['pengarang'] ?>
                            </span>
                            </p>
                            <p class="clearfix">
                            <span class="float-left">
                                Penerbit
                            </span>
                            <span class="float-right text-muted">
                            <?php echo $row1['penerbit'] ?>
                            </span>
                            </p>
                            <p class="clearfix">
                            <span class="float-left">
                                Tahun Terbit
                            </span>
                            <span class="float-right text-muted">
                            <?php echo $row1['th_terbit'] ?>
                            </span>
                            </p>
                        </div>
                        <?php 
                        if($row1['item_document']==null){
                            echo "<button class='btn btn-primary btn-block mb-2'>Tidak Tersedia Baca Online!</button>";
                        }else{
                            echo "<a class='btn btn-primary btn-block mb-2' href='../ebook/external/read/web/dokumen?file=".$row1['item_document']."' target='_blank'>Baca Online!</a>";
                        }
                        ?>
                        </div>
                        <div class="col-lg-8">
                        <div class="d-block d-md-flex justify-content-between mt-4 mt-md-0">
                            <div class="text-center mt-4 mt-md-0">
                            <form action="./detail?id=<?php echo $id; ?>" method="POST">
                                <button type="submit" name="add" class="btn btn-outline-primary btn-icon-text"><i class="mdi mdi-plus"></i>Tambah Ke Keranjang</button>
                                <button type="button" class="btn btn-primary btn-icon-text" onclick="goBack()">Kembali <i class="mdi mdi-backup-restore"></i></button>
                                <input type='hidden' name='product_id' value='<?php echo $id; ?>'>
                            </form>
                            </div>
                        </div>
                        <div class="mt-4 py-2 border-top border-bottom">
                            <ul class="nav profile-navbar">
                            <li class="nav-item">
                                <i class="mdi mdi-attachment"></i>
                                Sinopsis Buku :
                                </a>
                            </li>
                            </ul>
                        </div>
                        <div class="profile-feed">
                        <?php echo $row1['sinopsis'] ?>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Konten END -->
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
  <script>
  function goBack() {
    window.location = "../Dashboard";
  }
  </script>
</body>
<?php 
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
            echo "<script>
            Swal.fire({title: 'Penambahan Buku Berhasil',text: '',icon: 'success', showConfirmButton: false, timer: 1500
            }).then((result) => {
              window.location = '../Dashboard';
            })
            </script>";
        }
  
    }else{
  
        $item_array = array(
                'product_id' => $_POST['product_id']
        );
  
        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        echo "<script>
            Swal.fire({title: 'Penambahan Buku Berhasil',text: '',icon: 'success', showConfirmButton: false, timer: 1500
            }).then((result) => {
              window.location = '../Dashboard';
            })
            </script>";
    }
  }
?>
</html>