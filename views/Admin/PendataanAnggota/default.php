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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
  <?php
  if(isset($_GET['id'])){
    $sql_cek = "SELECT * FROM akun WHERE id_anggota='".$_GET['id']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_check = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
  }
  ?>
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
                        <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;" href="./data_buku">Data Anggota</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Edit Anggota</span></li>
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
                            <div class="form-group input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white font-weight-bold" style="width: 130px;">ID Anggota</span>
                              </div>
                              <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $data_check['id_anggota']; ?>" readonly required>
                            </div>
                            <div class="form-group input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white font-weight-bold" style="width: 130px;">RFID Anggota</span>
                              </div>
                              <input type="text" class="form-control" id="rfid" name="rfid" value="<?php echo $data_check['rfid']; ?>" readonly required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Nama Anggota</label>
                              <input type="text" class="form-control" id="nama" value="<?php echo $data_check['nama']; ?>" name="nama" placeholder="Nama...">
                            </div>
                            <div class="form-group">
                            <label for="exampleSelectGender">Jenis Kelamin</label>
                              <select class="form-control" id="jekel" name="jekel">
                                <option value="LK" <?php if($data_check['jekel'] == "LK"){echo("selected");} ?>>Laki-Laki</option>
                                <option value="PR" <?php if($data_check['jekel'] == "PR"){echo("selected");} ?>>Perempuan</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Kelas</label>
                              <input type="text" class="form-control" id="kelas" value="<?php echo $data_check['kelas']; ?>" name="kelas" placeholder="Nama...">
                            </div>
                            <div class="form-group">
                              <label>No HP:</label>
                              <input class="form-control" id="no_hp" name="no_hp" value="<?php echo $data_check['no_hp']; ?>" data-inputmask="'alias': 'phoneid'">
                            </div>
                            <div class="form-group">
                            <label for="exampleSelectGender">Status Akun</label>
                              <select class="form-control" id="level" name="level">
                                <option value="Petugas" <?php if($data_check['level'] == "Petugas"){echo("selected");} ?>>Petugas Perpustakaan</option>
                                <option value="Siswa" <?php if($data_check['level'] == "Siswa"){echo("selected");} ?>>Siswa/Siswi</option>
                              </select>
                            </div>
                    <button type="submit" class="btn btn-primary mr-2" name="edit_buku">Ubah</button>
                    <a class="btn btn-light" href="./data_anggota">Batal</a>
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
  <script src="../../../public/js/phone-id.js"></script>
  <script src="../../../public/js/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/todolist.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


  <!-- <script>
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var user_id = urlParams.get('id');
    var data = CryptoJS.AES.decrypt(user_id,'Edit Anggota');
    console.log(data);
  </script> -->
  
  <!-- End custom js for this page-->
</body>

<!-- PHP INSERT DATA -->

<?php
if (isset ($_POST['edit_buku'])){
  //mulai proses ubah
    $sql_ubah = "UPDATE akun SET
        id_anggota='".$_POST['id_anggota']."',
        rfid='".$_POST['rfid']."',
        nama='".$_POST['nama']."',
        jekel='".$_POST['jekel']."',
        kelas='".$_POST['kelas']."',
        no_hp='".$_POST['no_hp']."',
        level='".$_POST['level']."'
        WHERE id_anggota='".$data_check['id_anggota']."'";
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
            window.location.href='./data_anggota';
            });
          </script>");
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
              window.location = './data_anggota';
            }
        })</script>";
    }
  }
  ?>
</html>