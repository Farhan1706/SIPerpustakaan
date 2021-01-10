<!DOCTYPE html>
<?php 
include "../../database/koneksi.php";
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
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- base:css -->
  <link rel="stylesheet" href="../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../public/css/vertical-style.css">
  <!-- endinject -->
  <style>
      body{
          background-color:#f6f7fb;
      }
  </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="container">
            <div class="card-body">
                <form id="fupForm" name="form1" method="POST">
                            <div class="form-group input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white font-weight-bold">ID Anggota</span>
                              </div>
                              <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $format; ?>" readonly required>
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
    </div>
    <!-- page-body-wrapper ends -->
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../public/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../public/js/off-canvas.js"></script>
  <script src="../../public/js/hoverable-collapse.js"></script>
  <script src="../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../public/js/jquery.inputmask.bundle.js"></script>
  <script src="../../public/js/inputmask.binding.js"></script>
  <script src="../../public/js/phone-id.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../public/js/wizard.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- End custom js for this page-->
  <script>
  $(document).ready(function() {
    $('#butsave').on('click', function() {
      $("#butsave").attr("disabled", "disabled");
      var id_anggota     = $('#id_anggota').val();
      var email          = $('#email').val();
      var password       = $('#password').val();
      var nama           = $('#nama').val();
      var jekel          = $('#jekel').val();
      var tingkat        = $('#tingkat').val();
      var jurusan        = $('#jurusan').val();
      var kelompok       = $('#kelompok').val();
      var no_hp          = $('#no_hp').val();
      if(id_anggota!="" && email!="" && password!="" && nama!="" && jekel!="" && no_hp!=""){
        $.ajax({
          url: "tambah_anggota.php",
          type: "POST",
          data: {
            id_anggota: id_anggota,
            email: email,
            password: password,
            nama: nama,
            jekel: jekel,
            tingkat: tingkat,
            jurusan: jurusan,
            kelompok: kelompok,
            no_hp: no_hp
          },
          cache: false,
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
            Swal.fire({title: 'Penambahan Anggota Berhasil',text: '',icon: 'success', showConfirmButton: false, timer: 1500
              }).then((result) => {
                window.location = '/sipus/auth';
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
                    window.location ='./anggota-baru';
                  }
                })
      }
    });
  });
  </script>
</body>

</html>
