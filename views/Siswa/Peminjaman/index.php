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
                      <h3>Pengajuan</h3>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive table-hover">
                          <table class="table table-striped table-bordered" id="denda">
                            <thead>
                              <tr>
                                <th>ID Peminjaman</th>
                                <th>Buku</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody id="tbdenda">
                            <!-- Query untuk tabel denda -->
                            <?php 
                            $stmt = $koneksi->prepare("SELECT * FROM data_transaksi WHERE id_anggota='".$akun['id_anggota']."' AND status='PES';");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while($datapes = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?php echo($datapes['id_sk']) ?></td>
                                    <td><?php echo $datapes['id_buku'] ?></td>
                                    <td><?php 
                                    if($datapes['status']==='PES'){
                                        echo "Buku Sedang Dipesan";
                                    }
                                     ?></td>
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
                      <h3> Catatan Peminjaman</h3>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive table-hover">
                          <table id="genre" class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>ID Buku</th>
                                  <th>Nama Buku</th>
                                  <th>Tanggal Peminjaman</th>
                                  <th>Tenggat Waktu Pengembalian</th>
                                  <th>Status Peminjaman</th>
                                </tr>
                              </thead>
                              <tbody id="tbgenre">
                                <!-- Query untuk tabel genre buku -->
                                <?php
                                // Inisiasi tanggal kembali dari data sirkulasi
                                  $stmt = $koneksi->prepare("SELECT * FROM data_transaksi WHERE id_anggota='".$akun['id_anggota']."' AND status!='PES'");
                                  $stmt->execute();
                                  $rst = $stmt->get_result();
                                while($st = $rst->fetch_assoc()){
                                // Inisiasi nama dari data buku
                                  $stmt = $koneksi->prepare("SELECT * FROM data_buku WHERE id_buku='".$st['id_buku']."'");
                                  $stmt->execute();
                                  $rbuku = $stmt->get_result();
                                  $bukuRow = $rbuku->fetch_assoc();

                                
                                
                                // Mencari Masa Peminjaman
                                  $stmt = $koneksi->prepare("SELECT value FROM settings where id=1");
                                  $stmt->execute();
                                  $rdenda = $stmt->get_result();
                                  $denda = $rdenda->fetch_assoc();
                                
                                  $u_denda = $denda['value'];

                                  $tgl1 = date("Y-m-d");
                                  $tgl2 = $st['tgl_kembali'];

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
                                    <tr>
                                        <td><?php echo($st['id_buku']) ?></td>
                                        <td><?php echo($bukuRow['judul_buku']) ?></td>
                                        <td><?php echo date("d/M/Y", strtotime($st['tgl_pinjam'])) ?></td>
                                        <td><?php echo date("d/M/Y", strtotime($st['tgl_kembali'])) ?></td>
                                        <td>
                                        <?php if ($st['status']=='KEM') { ?>
                                        <span class="label label-primary">Telah Dikembalikan</span>
                                        <?php } elseif ($selisih <= 0) { ?>
                                          <span class="label label-primary">Masa Peminjaman</span>
                                        </td>
                                        <?php }elseif($selisih > 0){ ?>
                                          <span class="label label-danger">
                                          Rp.
                                          <?=$denda?>
                                          </span>
                                          <br> Terlambat :
                                          <?=$selisih?>
                                          Hari
                                        <?php } ?>
                                        </td>
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
  <!-- inject:js -->
  <script src="../../../public/js/off-canvas.js"></script>
  <script src="../../../public/js/hoverable-collapse.js"></script>
  <script src="../../../public/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../../public/js/dashboard.js"></script>
  <script src="../../../public/js/Custom.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <!-- End custom js for this page-->
  <!-- JS untuk Tabledit START -->
  <script type="text/javascript">
  $('#genre').DataTable();
  $('#denda').DataTable();
  </script>
  
</body>

</html>