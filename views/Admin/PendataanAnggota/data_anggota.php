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
  <title>Perpustakaan</title>
  <!-- AJAX untuk Form -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
			$(document).ready(function(){
				 $("#rfid").load("../../../UIDContainer.php");
				setInterval(function() {
					$("#rfid").load("../../../UIDContainer.php");
				}, 500);
			});
	</script>
  <!-- base:css -->
  <!-- base:css -->
  <link rel="stylesheet" href="../../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
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
                  <div class="row grid-margin">
                    <!-- <a type="button" title="Tambah Data" class="btn btn-inverse-info text-white" href="./form_anggota"> -->
                    <a type="button" data-toggle="modal" data-target="#tambahAnggota" title="Tambah Data" class="btn btn-inverse-info text-white">
                    <i class="mdi mdi-plus-circle-outline"></i> Tambah Data</a>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive table-hover">
                        <div class="show_anggota"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal Tambah & Edit Data Start -->
          <div class="modal fade" id="tambahAnggota" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ModalLabel">Tambah Anggota</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="fupForm" name="form1" method="POST">
                            <div class="form-group input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white font-weight-bold">ID Anggota</span>
                              </div>
                              <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $format; ?>" readonly required>
                            </div>
                            <div class="form-group input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white font-weight-bold">Kode RFID</span>
                              </div>
                              <!-- <input type="text" class="form-control" id="rfid" name="rfid" readonly required> -->
                              <textarea class="form-control" name="rfid" id="rfid" rows="1" cols="1" readonly required></textarea>
                              <small class="form-text text-muted">Tempelkan Kartu RFID Anda Bila Melakukan Pendaftaran di Perpustakaan. *Biarkan Kosong Bila Tidak Tersedia Mesin Scanner RFID.</small>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Email</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email...">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Password</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi...">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Nama Anggota</label>
                              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama...">
                            </div>
                            <div class="form-group">
                            <label for="exampleSelectGender">Jenis Kelamin</label>
                              <select class="form-control" id="jekel" name="jekel">
                                <option value="LK">Laki-Laki</option>
                                <option value="PR">Perempuan</option>
                              </select>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                  <label>Tingkat</label>
                                  <select class="form-control" id="tingkat" name="tingkat">
                                  <option value="null"></option>
                                  <option value="10">X</option>
                                  <option value="11">XI</option>
                                  <option value="12">XII</option>
                                  <option value="13">XIII</option>
                                  </select>
                                </div>
                                <div class="col">
                                <label for="exampleSelectClass">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan">
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
                                <div class="col">
                                  <label>Kelompok Belajar</label>
                                  <select class="form-control" id="kelompok" name="kelompok">
                                  <option value="null"></option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="C">C</option>
                                  <option value="D">D</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                              <label>No HP:</label>
                              <input class="form-control" id="no_hp" name="no_hp" data-inputmask="'alias': 'phoneid'">
                            </div>
                            <div class="form-group">
                            <label for="exampleSelectGender">Status</label>
                              <select class="form-control" id="level" name="level">
                                <option value="Petugas">Petugas Perpustakaan</option>
                                <option value="Siswa">Siswa</option>
                              </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" name="save" class="btn btn-success btn-icon-text" value="Save to database" id="butsave">
                            <i class="mdi mdi-plus btn-icon-prepend"></i>           
                            Tambah
                          </button>
                          <button type="button" class="btn btn-outline-warning btn-icon-text" data-dismiss="modal">
                            <i class="mdi mdi-close btn-icon-prepend"></i>                                                    
                            Tutup
                        </button>
                        </div>
                      </div>
                      </form>
                    </div>
          </div>
          <!-- Modal Tambah & Edit Data END -->


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
  
  <!-- Query Proses Anggota START -->
  <script type="text/javascript">
  $(document).ready(function(){
   $('.show_anggota').load("show_anggota.php");

  });

  $(document).ready(function() {
    $('#butsave').on('click', function() {
      $("#butsave").attr("disabled", "disabled");
      var id_anggota     = $('#id_anggota').val();
      var rfid           = $('#rfid').val();
      var email          = $('#email').val();
      var password       = $('#password').val();
      var nama           = $('#nama').val();
      var jekel          = $('#jekel').val();
      var tingkat        = $('#tingkat').val();
      var jurusan        = $('#jurusan').val();
      var kelompok       = $('#kelompok').val();
      var no_hp          = $('#no_hp').val();
      var level          = $('#level').val();
      if(id_anggota!="" && email!="" && password!="" && nama!="" && jekel!="" && no_hp!="" && level!=""){
        $.ajax({
          url: "tambah_anggota.php",
          type: "POST",
          data: {
            id_anggota: id_anggota,
            rfid: rfid,
            email: email,
            password: password,
            nama: nama,
            jekel: jekel,
            tingkat: tingkat,
            jurusan: jurusan,
            kelompok: kelompok,
            no_hp: no_hp,
            level: level
          },
          cache: false,
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
      else{
        Swal.fire({
                icon: 'info',
                title: 'Data Kosong',
                text: 'Lengkapi Data Terlebih Dahulu!'
                }).then((result) =>{
                  if(result.value){
                    window.location ='./data_anggota';
                  }
                })
      }
    });
  });
  </script>
  <!-- Query Proses Buku END -->

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
  <script src="../../../public/js/phone-id.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/todolist.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../../public/js/alerts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../../../public/js/data-table.js"></script>
  <!-- End custom js for this page-->
</body>

</html>