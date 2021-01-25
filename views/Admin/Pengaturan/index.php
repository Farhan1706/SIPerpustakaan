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
                          <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;" href="#">Pengaturan</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><span>Sistem</span></li>
                        </ol>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row grid-margin justify-content-center">
                      <h3>Denda</h3>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive table-hover">
                          <table class="table table-striped table-bordered" id="denda">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Pengaturan</th>
                                <th>Nilai</th>
                              </tr>
                            </thead>
                            <tbody id="tbdenda">
                            <!-- Query untuk tabel denda -->
                            <?php 
                            $stmt = $koneksi->prepare('SELECT * FROM settings WHERE id="1"');
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while($row = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?php echo($row['id']) ?></td>
                                    <td>Denda Keterlambatan</td>
                                    <td><?php echo($row['value']) ?></td>
                                </tr>
                            <?php 
                            }
                            ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row grid-margin justify-content-center">
                      <h3> Jenis Buku</h3>
                    </div>
                    <div class="row grid-margin">
                      <!-- <a type="button" title="Tambah Data" class="btn btn-inverse-info text-white" href="./form_anggota"> -->
                      <a type="button" data-toggle="modal" data-target="#tambahAnggota" title="Tambah Data" class="btn btn-inverse-info text-white">
                      <i class="mdi mdi-plus-circle-outline"></i> Tambah Data</a>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive table-hover">
                          <table id="genre" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Kode Buku</th>
                                  <th>Nama Jenis Buku</th>
                                </tr>
                              </thead>
                              <tbody id="tbgenre">
                                <!-- Query untuk tabel genre buku -->
                                <?php 
                                $stmt = $koneksi->prepare('SELECT * FROM settings WHERE id!="1"');
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()){
                                ?>
                                    <tr>
                                        <td><?php echo($row['id']) ?></td>
                                        <td><?php echo($row['kode_jenis']) ?></td>
                                        <td><?php echo($row['nama_jenis']) ?></td>
                                    </tr>
                                <?php 
                                }
                                ?>
                                </tbody>
                            </table>
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
                            <div class="form-group">
                              <label>Kode Buku</label>
                              <input class="form-control" type="text" name="kode_jenis" id="kode_jenis" maxlength="3" style="text-transform:uppercase" onkeypress="return /[a-z]/i.test(event.key)" placeholder="Contoh : XYZ" />
                              <small class="form-text text-muted">Masukan Kode Unik Buku Sebanyak 3 Karakter</small>
                            </div>
                            <div class="form-group">
                              <label>Nama Jenis Buku</label>
                              <input class="form-control" name="nama_jenis" id="nama_jenis" placeholder="Masukan Genre dari Buku">
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
  <script src="../../../public/js/kode_jenis.js"></script>
  <script src="../../../public/js/jquery.tabledit.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- End custom js for this page-->
  <!-- JS untuk Tabledit START -->
  <script type="text/javascript">
function refresh(){
  location.reload();
}

$(document).ready(function(){

$('#denda').Tabledit({
    url: 'proses-denda.php',
    deleteButton: false,
    hideIdentifier: true,
    buttons: {
              edit: {
                    class: 'btn btn-sm btn-warning',
                    html: '<i class="mdi mdi-pencil"></i>',
                    action: 'edit'
                },
                delete: {
                    class: 'btn btn-sm btn-danger',
                    html: '<i class="mdi mdi-trash-can"></i>',
                    action: 'delete'
                },
                save: {
                    class: 'btn btn-sm btn-success',
                    html: 'Save'
                },
                restore: {
                    class: 'btn btn-sm btn-warning',
                    html: 'Restore',
                    action: 'restore'
                },
                confirm: {
                    class: 'btn btn-sm btn-default',
                    html: '<i class="mdi mdi-check"></i>Hapus'
                }
            },
    columns: {
        identifier: [0, 'id'],
        editable: [[2, 'value']]
    }
    });
 
 
});
 
</script>
<script type="text/javascript">
$('#genre').DataTable();

$(document).ready(function(){
$('#genre').Tabledit({
    url: 'proses-genre.php',
    restoreButton : false,
    hideIdentifier: true,
    buttons: {
              edit: {
                    class: 'btn btn-sm btn-warning',
                    html: '<i class="mdi mdi-pencil"></i>',
                    action: 'edit'
                },
                delete: {
                    class: 'btn btn-sm btn-danger',
                    html: '<i class="mdi mdi-trash-can"></i>',
                    action: 'delete'
                },
                save: {
                    class: 'btn btn-sm btn-success',
                    html: '<i class="mdi mdi-check"></i>Save'
                },
                restore: {
                    class: 'btn btn-sm btn-warning',
                    html: 'Restore',
                    action: 'restore'
                },
                confirm: {
                    class: 'btn btn-sm btn-default',
                    html: '<i class="mdi mdi-minus"></i>Hapus'
                }
            },
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'kode_jenis'], [2, 'nama_jenis']]
    }
    });
 
 
});
 
</script>
  <!-- JS untuk Tabledit END -->
  <!-- Ajax Add Data Jenis START -->
<script>
$(document).ready(function() {
    $('#butsave').on('click', function() {
      $("#butsave").attr("disabled", "disabled");
      var kode_jenis  = $('#kode_jenis').val();
      var nama_jenis        = $('#nama_jenis').val();
      if(kode_jenis!="" && nama_jenis!=""){
        $.ajax({
          url: "proses-tambah.php",
          type: "POST",
          data: {
            kode_jenis: kode_jenis,
            nama_jenis: nama_jenis
          },
          cache: false,
          success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
            Swal.fire({title: 'Penambahan Berhasil',text: '',icon: 'success', showConfirmButton: false, timer: 1500
              }).then((result) => {
                window.location = '../Pengaturan';
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
                    window.location ='../Pengaturan';
                  }
                })
      }
    });
  });

</script>
  <!-- Ajax Add Data Jenis END -->
  
</body>

</html>