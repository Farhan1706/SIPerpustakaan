<?php
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../database/koneksi.php';

$sql_cari = mysqli_query($koneksi,"SELECT id_anggota FROM akun ORDER BY id_anggota DESC");
$result = mysqli_fetch_array($sql_cari);
$kode = $result['id_anggota'];
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1){
$format = "A"."00".$tambah;
 	}else if (strlen($tambah) == 2){
 	$format = "A"."0".$tambah;
			}else (strlen($tambah) == 3){
			$format = "A".$tambah
				}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- base:css -->
  <link rel="stylesheet" href="../../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../../public/css/vertical-style.css">
  <link rel="stylesheet" href="../../../public/css/Custom.css">
  <link rel="stylesheet" href="../../../public/css/scroll-to-accept.css">
  <!-- endinject -->
  
  <style>
      body{
          background-color:#f6f7fb;
      }
  </style>
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
                                    <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;" href="#">Pendataan</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><span>Daftar Anggota</span></li>
                                </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title mb-5 text-center">Daftar Akun</h1>
                            <form id="example-form" method="POST">
                                <div>
                                    <h3>Akun</h3>
                                    <section>
                                        <h3>Data Akun</h3>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white font-weight-bold">ID Anggota</span>
                                            </div>
                                            <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $format; ?>" readonly required>
                                        </div>
                                        <div class="form-group">
                                        <label>Alamat Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email...">
                                        </div>
                                        <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi...">
                                        </div>
                                    </section>
                                    <h3>Profil Anggota</h3>
                                    <section>
                                        <h3>Profil</h3>
                                        <div class="form-group">
                                        <label>Kode RFID</label>
                                        <input type="text" class="form-control" id="rfid" name="rfid" value="<?php echo $format; ?>" readonly required>
                                        <small class="form-text text-muted">Tempelkan Kartu RFID Anda Bila Melakukan Pendaftaran di Perpustakaan. *Biarkan Kosong Bila Tidak Tersedia Mesin Scanner RFID.</small>
                                        </div>
                                        <div class="form-group">
                                        <label>Nomor HP</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" data-inputmask="'alias': 'phoneid'">
                                        </div>
                                        <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama...">
                                        </div>
                                    </section>
                                    <h3>Status</h3>
                                    <section>
                                        <h3>Informasi Tambahan</h3>
                                        <div class="form-group">
                                        <label for="exampleSelectGender">Jenis Kelamin</label>
                                            <select class="form-control" id="jekel" name="jekel">
                                                <option value="LK">Laki-Laki</option>
                                                <option value="PR">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label for="exampleSelectClass">Kelas</label>
                                            <select class="form-control" id="kelas" name="kelas">
                                                <option value="null"></option>
                                                <?php
                                                // ambil data dari database
                                                $query = "select * from jurusan";
                                                $hasil = mysqli_query($koneksi, $query);
                                                while ($row = mysqli_fetch_array($hasil)) {
                                                ?>
                                                <option value="<?php echo $row['nama']; ?>">
                                                <?php echo $row['nama_pdk']; ?>
                                                </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" id="level" name="level">
                                            <option value="Petugas">Petugas Perpustakaan</option>
                                            <option value="Siswa">Siswa</option>
                                        </select>
                                        </div>
                                    </section>
                                    <h3>Persetujuan</h3>
                                    <section>
                                        <!-- <h3>Buat Akun Sekarang</h3> -->
                                        <center>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <div class="wrapper-all" >
                                                        <div class="wrapper">
                                                            <div class="terms-and-conditions">
                                                                <h1>Syarat dan Ketentuan di Perpustakaan SMKN 1 Cimahi</h1>
                                                                <p>Syaratnya Adalah...
                                                                Menghafalkan
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <p>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                </p>
                                                                <hr>
                                                            </div>
                                                        <button class="accept" disabled autocomplete="off">Menyetujui Peraturan</button>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </center>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../Partials/_footer.php'; ?>
      </div>
    </div>
</div>
    <!-- page-body-wrapper ends -->
  <!-- container-scroller -->
  <!-- Kueri Tambah Anggota -->


  <!-- END Kueri Tambah Anggota -->
  <!-- base:js -->
  <script src="../../../public/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../../public/js/off-canvas.js"></script>
  <script src="../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../../public/js/jquery.steps.min.js"></script>
  <script src="../../../public/js/jquery.validate.min.js"></script>
  <script src="../../../public/js/jquery.inputmask.bundle.js"></script>
  <script src="../../../public/js/inputmask.binding.js"></script>
  <script src="../../../public/js/phone-id.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!-- <script src="../../../public/js/tambah_anggota.js"></script> -->
<script>
      //   var myform = document.getElementById("example-form");
$(document).ready(function()  {
'use strict';
    var form = $("#example-form");
    
    var id_anggota  = $('#id_anggota').val();
    var email       = $('#email').val();
    var password    = $('#password').val();
    var rfid        = $('#rfid').val();
    var no_hp       = $('#no_hp').val();
    var nama        = $('#nama').val();
    var jekel       = $('#jekel').val();
    var kelas       = $('#kelas').val();
    var level       = $('#level').val();
    // var fd = new FormData('#example-form');
    
    form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onFinished: function(event, currentIndex) {
      $.ajax({
          url         : 'tambah_anggota.php', 
          type        : 'POST', 
          data: {
            id_anggota: id_anggota,
            rfid: rfid,
            email: email,
            password: password,
            nama: nama,
            jekel: jekel,
            kelas: kelas,
            no_hp: no_hp,
            level: level
          }, 
          cache    : false,
          success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              if(dataResult.statusCode==200){
              Swal.fire({title: 'Penambahan Anggota Berhasil',text: '',icon: 'success', showConfirmButton: false, timer: 1500
                }).then((result) => {
                  window.location = './data_anggota';
                })					
              }
              else if(dataResult.statusCode==201){
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Terjadi Kesalahan!'
                  })
              }
              
            }
      });
    }
  });
  
})(jQuery);
</script>
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/todolist.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../../../public/js/scroll-to-accept.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
