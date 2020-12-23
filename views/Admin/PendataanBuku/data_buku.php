<?php
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../database/koneksi.php';

$carikode = mysqli_query($koneksi,"SELECT id_buku FROM data_buku order by id_buku desc");
  $datakode = mysqli_fetch_array($carikode);
  $kode = $datakode['id_buku'];
  $urut = substr($kode, 0, 1);
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
                        <div class="show_buku"></div>
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
            <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="ModalLabel">Tambah Buku</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="upload_form" name="form1" method="POST">
                            <div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-primary text-white">ID Buku</span>
                              </div>
                              <input type="text" class="form-control" id="id_buku" name="id_buku" readonly required>
                            </div>
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
                              <label>Foto Buku</label>
                              <input type="file" id="file" name="file" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" placeholder="Upload Gambar Buku" readonly>
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                              </div>
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
   $('.show_buku').load("show_buku.php");

  });

  $(document).ready(function() {
    $('#butsave').on('click', function() {
      $("#butsave").attr("disabled", "disabled");

      var formData = new FormData($('#upload_form')[0]);

      if(id_buku!="" && judul_buku!="" && pengarang!="" && penerbit!="" && th_terbit!=""){
        formData.append('tax_file', $('input[type=file]')[0].files[0]);
        $.ajax({
          url: "tambah_buku.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
            Swal.fire({title: 'Buku Berhasil Ditambahkan',text: '',icon: 'success', showConfirmButton: false, timer: 1500
              }).then((result) => {
                window.location = './data_buku';
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
                    window.location ='./data_buku';
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
  echo("<script>");
  echo("$(function(){");
  echo("$('.jenis-buku').select2({");
  echo("dropdownParent: $('#tambahBuku')");
  echo("});");
  echo("$('.jenis-buku').on('change', function() {");
  echo("var data = ".$format." + $('.jenis-buku option:selected').val() ;");
  echo("var blank = '';");
  echo("if($('.jenis-buku option:selected').val()==''){");
  echo("$('#id_buku').val(blank);");
  echo("}else{");
  echo("$('#id_buku').val(data);");
  echo("}");
  echo("})");
  echo("});");
  echo("</script>");
  ?>
  <!-- End custom js for this page-->
</body>

</html>