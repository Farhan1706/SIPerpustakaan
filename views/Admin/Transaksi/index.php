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
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row grid-margin">
                    <a href="./peminjaman" title="Tambah Data" class="btn btn-inverse-info text-white">
                    <i class="mdi mdi-plus-circle-outline"></i> Tambah Data</a>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive table-hover">
                        <table id="order-listing" class="table">
                          <thead>
                            <tr class="bg-primary text-white">
                                <th>No</th>
                                <th>ID SKL</th>
                                <th>Buku</th>
                                <th>Peminjam</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Denda</th>
                                <th>Kelola</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                              $no = 1;
                              $sql = $koneksi->query("SELECT s.id, s.id_sk, b.judul_buku, a.id_anggota, a.nama, s.tgl_pinjam, s.tgl_kembali FROM data_transaksi s INNER JOIN data_buku b ON s.id_buku=b.id_buku INNER JOIN akun a ON s.id_anggota=a.id_anggota WHERE status='PIN' ORDER BY tgl_pinjam DESC");
                              while ($data= $sql->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['id_sk']; ?></td>
                                <td><?php echo $data['judul_buku']; ?></td>
                                <td><?php echo $data['id_anggota']; ?> - <?php echo $data['nama']; ?></td>
                                <td><?php  $tgl = $data['tgl_pinjam']; echo date("d/M/Y", strtotime($tgl))?></td>
                                <td><?php  $tgl = $data['tgl_kembali']; echo date("d/M/Y", strtotime($tgl))?></td>
                                <td>
                                <?php
                                  $u_denda = 1000;

                                  $tgl1 = date("Y-m-d");
                                  $tgl2 = $data['tgl_kembali'];

                                  $pecah1 = explode("-", $tgl1);
                                  $date1 = $pecah1[2];
                                  $month1 = $pecah1[1];
                                  $year1 = $pecah1[0];

                                  $pecah2 = explode("-", $tgl2);
                                  $date2 = $pecah2[2];
                                  $month2 = $pecah2[1];
                                  $year2 =  $pecah2[0];

                                  $jd1 = GregorianToJD($month1, $date1, $year1);
                                  $jd2 = GregorianToJD($month2, $date2, $year2);

                                  $selisih = $jd1 - $jd2;
                                  $denda = $selisih * $u_denda;
                                ?>
                                <?php if ($selisih <= 0) { ?>
                                <span class="label label-primary">Masa Peminjaman</span>
                                <?php } elseif ($selisih > 0) { ?>
                                <span class="label label-danger">
                                  Rp.
                                  <?=$denda?>
                                </span>
                                <br> Terlambat :
                                <?=$selisih?>
                                Hari
                                </td>
                                <?php } ?>

                                <td class="text-right">
                                <button id="<?php echo $data['id']; ?>" class="btn btn-light perpanjang"> <i class="mdi mdi-book-plus text-info"></i> </button>
                                <button id="<?php echo $data['id']; ?>" class="btn btn-light kembali"> <i class="mdi mdi-bookmark-check text-success"></i> </button>
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
  <script src="../../../public/js/select2.js"></script>
  <script src="../../../public/js/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/todolist.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="../../../public/js/data-table.js"></script>
  <script>
  $(document).on('click', '.perpanjang', function(){
        Swal.fire({
					  title: 'Proses Perpanjangan Buku!',
					  text: "Apakah Anda Yakin Akan Memperpanjang Masa Pinjam Buku Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Perpanjang'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "perpanjang.php",
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Perpanjangan Buku!',
                    text: 'Masa Peminjaman Diperpanjang',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
                      window.location.href="index";
					});
            },error: function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal Memperpanjang Masa Pinjam!'
                });
            }
            });
        }
        })
    });

    $(document).on('click', '.kembali', function(){
        Swal.fire({
					  title: 'Proses Pengembalian Buku!',
					  text: "Apakah Anda Yakin Akan Melanjutkan Proses Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Kembalikan Buku!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "kembali.php",
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Pengembalian Buku!',
                    text: 'Buku Dikembalikan',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
                      window.location.href="index";
					});
            },error: function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal Memproses Pengembalian Buku!'
                });
            }
            });
        }
        })
    });
  </script>
  <!-- End custom js for this page-->
</body>

</html>