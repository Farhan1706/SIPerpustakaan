<?php
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../database/koneksi.php';

$carikode = mysqli_query($koneksi,"SELECT l.id_buku,l.tanggal_pembuatan FROM data_buku d INNER JOIN log_buku l ON l.id_buku=d.id_buku ORDER BY tanggal_pembuatan DESC");
  $datakode = mysqli_fetch_array($carikode);
  $kode = $datakode['id_buku'];
  $urut = substr($kode, 3);
  $tambah = (int) $urut + 1;
  $format = $tambah;
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
                        <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;" href="#">Pendataan</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Data Buku</span></li>
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
                  <a type="button" data-toggle="modal" data-target="#tambahBuku" title="Tambah Data" class="btn btn-inverse-info text-white">
                    <i class="mdi mdi-plus-circle-outline"></i> Tambah Data</a>
                  </div>
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

<!-- Modal START -->
          <!-- Modal Tambah & Edit Data Start -->
          <div class="modal fade" id="tambahBuku" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                    <div class="modal-body">
                    <form id="upload_form" action="tb.php"  method="POST" enctype="multipart/form-data">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    	<div class="row">
                    		<div class="col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text bg-primary text-white">ID Buku</span>
                                </div>
                                <input type="text" class="form-control" id="id_buku" name="id_buku" readonly required>
                                
                              </div>
                              <div class="form-group">
                              <label for="jenis-buku" class="col-form-label">Jenis Buku</label></br>
                                <select class="jenis-buku" style="width : 100%" required>
                                  <option value=""></option>
                                  <!-- Kueri untuk jenis buku -->
                                  <?php 
                                  $stmt = $koneksi->prepare("SELECT * FROM settings where id!=1");
                                  $stmt->execute();
                                  $result = $stmt->get_result();
                                  while($row = $result->fetch_assoc()){
                                  ?>
                                  <option value="<?php echo($row['kode_jenis']); ?>"><?php echo($row['nama_jenis']); ?></option>
                                  <?php 
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="form-group row">
                                <div class="col">
                                  <label>Judul Buku</label>
                                  <div>
                                  <input type="text" id="judul_buku" name="judul_buku" class="form-control" placeholder="Judul Buku..." required>
                                  </div>
                                </div>
                                <div class="col">
                                  <label>Pengarang</label>
                                  <div>
                                    <input type="text" id="pengarang" name="pengarang" class="form-control" placeholder="Pengarang..." required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col">
                                  <label>Penerbit</label>
                                  <div>
                                  <input type="text" id="penerbit" name="penerbit" class="form-control" placeholder="Penerbit..." required>
                                  </div>
                                </div>
                                <div class="col">
                                  <label>Tahun Terbit</label>
                                  <div>
                                  <input type="number" id="th_terbit" name="th_terbit" class="form-control" placeholder="Tahun Terbit..." required>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Nomor ISBN</label>
                                <input type="text" id="ISBN" name="ISBN" class="form-control" placeholder="Nomor ISBN..." required>
                              </div>
                              <div class="form-group">
                                <label>Cover Buku</label>
                                <input type="file" id="cover" name="cover" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" placeholder="Upload Cover Buku" readonly>
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Salinan Buku</label>
                                <input type="file" id="salinan" name="salinan" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                  <input type="text" class="form-control file-upload-info" placeholder="Upload Salinan Buku Berupa PDF" readonly>
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                  </span>
                                </div>
                              </div>
                          </div>
                          <div class="col-sm-6">
                              <div class="form-group">
                                <label>Sinopsis</label>
                                <textarea type="text" class="form-control ckeditor" id='sinopsis' name='sinopsis'></textarea>
                                <!-- <input type="text" id="sinopsis" name="sinopsis" class="form-control" placeholder="Penerbit..." required> -->
                              </div>
                            </div>
                          </div>
                        
                          <div class="form-group">
                            <button type="submit" name="save" class="btn btn-success btn-icon-text" value="Save to database" id="butsave">
                                  <i class="mdi mdi-plus btn-icon-prepend"></i>           
                                  Tambah
                                </button>
                            <button type="button" class="btn btn-outline-warning btn-icon-text" data-dismiss="modal">
                                  <i class="mdi mdi-close btn-icon-prepend"></i>                                                    
                                  Tutup
                            </button>
                          </div>
                        </form>
                      </div>
                      </div>
                    </div>
            </div>
            <!-- Modal Tambah & Edit Data END -->
<!-- Modal End -->
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
<!-- Query Proses Buku START -->
  <script type="text/javascript">
  $(document).ready(function(){
   $('.sb').load("show.php");

  });
  </script>
  <!-- Query Proses Buku END -->

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
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/todolist.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../../../public/js/data-table.js"></script>
  <script src="../../../public/js/file-upload.js"></script>

<?php
echo("<script>
$(function(){
$('.jenis-buku').select2({
dropdownParent: $('#tambahBuku')
});
$('.jenis-buku').on('change', function() {
var data =  $('.jenis-buku option:selected').val() + ".$format." ;
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

</html>