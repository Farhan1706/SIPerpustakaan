<?php
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../database/koneksi.php';

if(isset($_GET['id'])){
  $sql_cek = "SELECT * FROM data_buku WHERE id_buku='".$_GET['id']."'";
  $query_cek = mysqli_query($koneksi, $sql_cek);
  $data_check = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
}
$nomor_buku = substr($_GET['id'], 0, 1);
$format = $nomor_buku;
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
  <!-- base:css -->
  <link rel="stylesheet" href="../../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../../public/css/select2.min.css">
  <link rel="stylesheet" href="../../../public/css/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- Data Table CSS Bs4 -->
  <link rel="stylesheet" href="../../../public/css/dataTables.bootstrap4.css">
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
    
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial:../../../../Partials/_navbar.html -->
      <?php include '../Partials/_navbar.php'; ?>
      
      <div class="main-panel">          
        <div class="content-wrapper">
          <div class="row">
            <div class="col grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="template-demo">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb breadcrumb-custom bg-primary">
                        <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;">Pendataan</a></li>
                        <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;" href="./data_buku">Data Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Edit Buku</span></li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" action="" method="POST">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-primary text-white font-weight-bold">ID Buku</span>
                      </div>
                      <input readonly="readonly" type="text" class="form-control" name="id_buku" id="id_buku" value="<?php echo $data_check['id_buku'];?>">
                    </div>
                    <div class="form-group">
                        <label for="jenis-buku" class="col-form-label">Jenis Buku</label></br>
                        <select class="jenis-buku" style="width : 100%">
                          <option value=""></option>
                          <option value="ABC">ABECE</option>
                          <option value="DEF">DeEF</option>
                          <option value="GHI">GeHaI</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label>Judul Buku:</label>
                      <input type="text" class="form-control" name="judul_buku" value="<?php echo $data_check['judul_buku']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Pengarang:</label>
                      <input type="text" class="form-control" name="pengarang" value="<?php echo $data_check['pengarang']; ?>" required>
                    </div>
                    <div class="form-group row">
                      <div class="col">
                        <label>Penerbit:</label>
                        <input type="text" class="form-control" name="penerbit" value="<?php echo $data_check['penerbit']; ?>" required>
                      </div>
                      <div class="col">
                        <label>Tahun Terbit:</label>
                        <input class="form-control" name="th_terbit" data-inputmask="'alias': '****','placeholder': '*'" value="<?php echo $data_check['th_terbit']; ?>" required>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="edit_buku">Ubah</button>
                    <a class="btn btn-light" href="./data_buku">Batal</a>
                  </form>
                </div>
                </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
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
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../../public/js/off-canvas.js"></script>
  <script src="../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../../public/js/select2.min.js"></script>
  <script src="../../../public/js/jquery.inputmask.bundle.js"></script>
  <script src="../../../public/js/inputmask.binding.js"></script>
  <script src="../../../public/js/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/todolist.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  
  <?php 
  echo ("<script>
  $(function(){
  $(document).ready(function() {
  $('.jenis-buku').select2();
  });
  $('.jenis-buku').on('change', function() {
  var data = ".$format." + $('.jenis-buku option:selected').val();
  var blank = '';
  if($('.jenis-buku option:selected').val()==''){
  $('#id_buku').val(blank);
  }else{
  $('#id_buku').val(data);
  }
  })
  });
  </script>");
  ?>
  
  <!-- End custom js for this page-->
</body>

<!-- PHP INSERT DATA -->

<?php
if (isset ($_POST['edit_buku'])){
  //mulai proses ubah
    $sql_ubah = "UPDATE data_buku SET
        id_buku='".$_POST['id_buku']."',
        judul_buku='".$_POST['judul_buku']."',
        pengarang='".$_POST['pengarang']."',
        penerbit='".$_POST['penerbit']."',
        th_terbit='".$_POST['th_terbit']."'
        WHERE id_buku='".$data_check['id_buku']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo("<script>
          Swal.fire({
            title: 'Mengganti Data Buku!',
            text: 'Data Berhasil Dirubah dari Item yang dipilih',
            icon :'success',
            showConfirmButton: false,
            timer: 1500
            }).then((result) => {
            window.location.href='./data_buku';
            });
          </script>");
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
              window.location = './data_buku';
            }
        })</script>";
    }
  }
  ?>
</html>