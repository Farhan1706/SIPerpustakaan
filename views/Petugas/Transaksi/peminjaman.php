<?php
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../database/koneksi.php';

$sql_cari = "SELECT id_sk FROM data_transaksi ORDER BY id_sk DESC";
$result = $koneksi -> query($sql_cari);
$row = $result -> fetch_array(MYSQLI_BOTH);
$kode = $row['id_sk'];
$urut = substr($kode, 1, 3);
$remodel = (int) $urut + 1;

if (strlen($remodel) == 1){
    $format = "S"."00".$remodel;
         }else if (strlen($remodel) == 2){
         $format = "S"."0".$remodel;
                }else (strlen($remodel) == 3){
                $format = "S".$remodel
                    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Perpustakaan</title> 
  <link rel="stylesheet" href="../../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../../public/css/bootstrap-datepicker.min.css">
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
                        <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;">Transaksi</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Pinjam Buku</span></li>
                      </ol>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="POST">
                    <div class="form-group input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text bg-primary text-white font-weight-bold">ID Peminjaman</span>
                      </div>
                      <input type="text" name="id_sk" class="form-control" value="<?php echo $format; ?>" readonly>
                    </div>
                        <div class="form-group">
                            <label>Nama Peminjam:</label>
                            <select name="id_anggota" class="js-example-basic-single w-100">
                                <option value="null"></option>
                                <?php
                                // ambil data dari database
                                $query = "SELECT * from akun where level='Siswa' OR level='Petugas'";
                                $hasil = mysqli_query($koneksi, $query);
                                while ($row = mysqli_fetch_array($hasil)) {
                                ?>
                                <option value="<?php echo $row['id_anggota']; ?>">
                                  <?php echo $row['id_anggota']; ?>
                                  -
                                  <?php echo $row['nama']; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    <div class="form-group">
                    <label>Buku:</label>
                        <select id="id_buku" name="id_buku[]" class="js-example-basic-multiple w-100" multiple="multiple" >
                        <!-- <select multiple name="id_buku[]"> -->
                            <?php
                            // ambil data dari database
                            $query = "SELECT * from data_buku";
                            $hasil = mysqli_query($koneksi, $query);
                            while ($row = mysqli_fetch_array($hasil)) {
                            ?>
                            <option value="<?php echo $row['id_buku']; ?>">
                              <?php echo $row['id_buku']; ?>
                              -
                              <?php echo $row['judul_buku']; ?>
                            </option>
                            <?php
                            }
                          ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Tanggal Pinjam:</label>
                      <div id="datepicker-popup" class="input-group date datepicker">
                        <input type="text" name="tgl_pinjam" class="form-control" data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="*" inputmode="numeric">
                        <span class="input-group-addon input-group-append border-left">
                          <span class="mdi mdi-calendar input-group-text"></span>
                        </span>
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Pinjam</button>
                    <a class="btn btn-light" href="../Transaksi">Batal</a>
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
  <!-- inject:js -->
  <script src="../../../public/js/off-canvas.js"></script>
  <script src="../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="../../../public/js/bootstrap-datepicker.min.js"></script>
  <script src="../../../public/js/jquery.inputmask.bundle.js"></script>
  <script src="../../../public/js/inputmask.binding.js"></script>
  <script src="../../../public/js/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/formpickers.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/todolist.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../../../public/js/select2.js"></script>
  <script type="text/javascript">
  	// function format (option) {
		// 	console.log(option);
		// 	if (!option.id) { return option.text; }
		// 	var ob = "<table><tr><th class='col'>" + option.text + "</th>" + "<th><img src='https://lh4.ggpht.com/wKrDLLmmxjfRG2-E-k5L5BUuHWpCOe4lWRF7oVs1Gzdn5e5yvr8fj-ORTlBF43U47yI=w64' /></th></tr></table>";	// replace image source with option.img (available in JSON)
		// 	return ob;
		// };
  $("#id_buku").select2({
  		placeholder: "Pilih Buku",
      allowClear: true,
	    templateResult: format,
	    templateSelection: function (option) {
	        if (option.id.length > 0 ) {
	            return option.text;
	        } else {
	            return option.text;
	        }
	    },
      escapeMarkup: function (m) {
				return m;
			}
	});
  </script>
</html>
<?php
if(isset($_POST['submit'])){
  $id_sk      = $_POST['id_sk'];
  $id_anggota = $_POST['id_anggota'];
  $id_buku    = $_POST['id_buku'];
  $tgl_pinjam = date('Y-m-d', strtotime(str_replace("/","-",$_POST['tgl_pinjam'])));
  $tgl_kembali= date('Y-m-d', strtotime('+7 days', strtotime($tgl_pinjam))); //membuat tanggal pengembalian buku + 7 hari
  $status     = "PIN";
  foreach($id_buku as $buku){
    $query = "INSERT INTO data_transaksi (id_sk,id_buku,id_anggota,tgl_pinjam,tgl_kembali,status) VALUES (?,?,?,?,?,?);";
    $proses = $koneksi->prepare($query);
    $proses->bind_param('ssssss', $id_sk, $buku, $id_anggota, $tgl_pinjam, $tgl_kembali, $status);
    $result = $proses->execute();
  }
  foreach($id_buku as $buku){
    mysqli_query($koneksi,$querylog);
    $query = "INSERT INTO log_pinjam (id_buku,id_anggota,tgl_pinjam) VALUES (?,?,?);";
    $proses = $koneksi->prepare($query);
    $proses->bind_param('sss', $buku, $id_anggota, $tgl_pinjam);
    $result = $proses->execute();
  }
  if ($result == FALSE){
        echo("
        <script>
        Swal.fire({
          title: 'Tambah Peminjaman!',
          text: 'Data Gagal Ditambahkan',
          icon :'error',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location.href='index';
          });
          </script>
        ");
      }else{
        echo("
        <script>
        Swal.fire({
          title: 'Tambah Peminjaman!',
          text: 'Data Berhasil Ditambahkan',
          icon :'success',
          showConfirmButton: false,
          timer: 1500
        }).then((result) => {
          window.location.href='index';
        });
        </script>
        ");
      }
      $proses->close();   
      $koneksi->close();
}
?>