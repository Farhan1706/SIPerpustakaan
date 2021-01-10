<?php
error_reporting(0);
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
 $rfid = $_SESSION['rfid'];
};
include '../../../database/koneksi.php';
// include '../../../database/database.php';

// Inisiasi Untuk Info Akun
$sql = "SELECT * FROM akun WHERE email='$email';";
   $result = $koneksi -> query($sql);
   $akun = $result -> fetch_assoc(); 

if (isset($_POST['add'])){
  
  if($akun['level']=="NSiswa"){
    header("Location:?action=dilarang");
  }else{
    if(isset($_SESSION['cart'])){

      $item_array_id = array_column($_SESSION['cart'], "product_id");

      if(in_array($_POST['product_id'], $item_array_id)){
          echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Opps...',
            text: 'Buku Telah Ada di Daftar Peminjaman!'
            }).then((result) =>{
              if(result.value){
                
              }
            })
          </script>";
      }else{

          $count = count($_SESSION['cart']);
          $item_array = array(
              'product_id' => $_POST['product_id']
          );

          $_SESSION['cart'][$count] = $item_array;
      }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
    }
  }
}

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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <!-- END Data Table CSS Bs4 -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../../public/css/vertical-style.css">
  <link rel="stylesheet" href="../../../public/css/Custom.css">
  <link rel="stylesheet" href="../../../public/css/cart.css">
  <!-- endinject -->
</head>
<body>
  <div class="container-scroller d-flex">

    <!-- partial:../../../../Partials/_sidebar.html -->
    <?php include '../Partials/_sidebar.php'; ?>
    <!-- partial -->
    
    <div class="container-fluid page-body-wrapper">
      
      <!-- partial:../../../../Partials/_navbar.html -->
      <?php include '../Partials/_navbar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-md-6">
              <div class="row">
                <div class="col-12 grid-margin ">
                  <div class="card">
                    <div class="faq-block card-body">
                      <div class="container-fluid py-2">
                        <h5 class="mb-0">LAYANAN YANG TERSEDIA</h5>
                      </div>
                      <div id="accordion-4" class="accordion">
                        <div class="card">
                          <div class="card-header" id="headingOne-4">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseOne-4" aria-expanded="true" aria-controls="collapseOne-4">
                                Koleksi apa saja yang tersedia?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOne-4" class="collapse show" aria-labelledby="headingOne-4" data-parent="#accordion-4">
                            <div class="card-body">
                              <p class="mb-0">Buku teks,
                                Buku Referensi,
                                Jurnal Ilmiah,
                                IPBana,
                                Laporan Penelitian,
                                Prosiding,
                                Tugas Akhir : Skripsi, Tesis dan Proposal
                                Koleksi SNI,
                                Koleksi BI,</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo-4">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseTwo-4" aria-expanded="false" aria-controls="collapseTwo-4">
                                Jam Buka Perpustakaan?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseTwo-4" class="collapse" aria-labelledby="headingTwo-4" data-parent="#accordion-4">
                            <div class="card-body">
                              <p class="mb-0">Senin s.d Jum'at : 08:00 S.d. 15.00 WIB</p>
                              <p class="mb-0">Online : 7 hari/24 Jam</p>
                              <p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree-4">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseThree-4" aria-expanded="false" aria-controls="collapseThree-4">
                                Layanan Sistem yang Tersedia
                              </a>
                            </h5>
                          </div>
                          <div id="collapseThree-4" class="collapse" aria-labelledby="headingThree-4" data-parent="#accordion-4">
                            <div class="card-body">
                              <p class="mb-0">Keanggotaan Perpustakaan</p><p>
                              <p class="mb-0">Peminjaman dan Pengenbalian Buku</p><p>
                              <p class="mb-0">Penelusuran Koleksi Buku</p><p>
                              <p class="mb-0">Baca Online Koleksi Buku</p><p>
                            </p></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 grid-margin grid-margin-md-0">
                  <div class="card">
                    <div class="faq-block card-body">
                      <div class="container-fluid py-2">
                        <h5 class="mb-0">AKSES SUMBER DAYA ELEKTRONIK (E-RESOURCES)</h5>
                      </div>
                      <div id="accordion-1" class="accordion">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Apakah yang dimaksud dengan E-Resources?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion-1">
                            <div class="card-body">
                              <p class="mb-0">E-Resources atau sumber daya elektronik adalah segala macam sumber informasi dan publikasi yang disediakan dan diakses secara elektronik (online), contohnya e-journal (jurnal elektronik), e-book (buku elektronik), e-datasheet (datasheet elektronik), dan sejenisnya.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                               Bagaimana cara mengakses E-Resources dilaman SiPus?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion-1">
                            <div class="card-body">
                              <p class="mb-0">Pengaksesan dapat dilakukan dengan menggunakan fasilitas Direct Access yakni <a href='http://localhost/sipus'>Website Sistem Informasi Perpustakaan</a> dengan menggunakan akun Perpustakaan.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apakah Pengguna Dapat Mengunduh E-Sourcess?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion-1">
                            <div class="card-body">
                              <p class="mb-0">Pengguna Dapat Melakukan Pengundungan Sumber Daya Elektronik Pada Bagian:</p> 
                              <p>Lihat Detail → Baca Online → Download (Terdapat Pada Pojok Kanan Atas)</p> <p>
                            </p></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- sub col -->
            <div class="col-12 col-md-6">
              <div class="row">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="faq-block card-body">
                      <div class="container-fluid py-2">
                        <h5 class="mb-0">PEMINJAMAN & PENGEMBALIAN KOLEKSI PERPUSTAKAAN (FISIK)</h5>
                      </div>
                      <div id="accordion-3" class="accordion">
                        <div class="card">
                          <div class="card-header" id="headingOne-3">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseOne-3" aria-expanded="true" aria-controls="collapseOne-3">
                              Berapa banyak koleksi buku yang dapat dipinjam?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOne-3" class="collapse show" aria-labelledby="headingOne-3" data-parent="#accordion-3">
                            <div class="card-body">
                              <p class="mb-0">Pengguna diperbolehkan meminjam buku hingga 5 judul buku.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo-3">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseTwo-3" aria-expanded="false" aria-controls="collapseTwo-3">
                              Berapa lama waktu peminjaman koleksi?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseTwo-3" class="collapse" aria-labelledby="headingTwo-3" data-parent="#accordion-3">
                            <div class="card-body">
                              <p class="mb-0">Pengguna hanya diperbolehkan meminjam selama 7 Hari.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingThree-3">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseThree-3" aria-expanded="false" aria-controls="collapseThree-3">
                              Berapa kali dapat dilakukan perpanjangan peminjaman koleksi?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseThree-3" class="collapse" aria-labelledby="headingThree-3" data-parent="#accordion-3">
                            <div class="card-body">
                              <p class="mb-0">Proses perpanjangan masa peminjaman tidak dibatasi, tetapi pengguna diharuskan menghubungi petugas perpustakaan untuk memperpanjang masa peminjaman.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingFour-4">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseFour-4" aria-expanded="false" aria-controls="collapseFour-4">
                              Apakah dapat dilakukan perpanjangan secara online?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseFour-4" class="collapse" aria-labelledby="headingFour-4" data-parent="#accordion-4">
                            <div class="card-body">
                              <p class="mb-0">Untuk saat ini proses perpanjangan secara online belum tersedia.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingFive-5">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseFive-5" aria-expanded="false" aria-controls="collapseFive-5">
                              Berapa besar denda keterlambatan pengembalian koleksi?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseFive-5" class="collapse" aria-labelledby="headingFive-5" data-parent="#accordion-4">
                            <div class="card-body">
                            <p class="mb-0">Rp 2000/hari, denda tersebut dikenakan setiap satu judul buku yang terlambat.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingSix-6">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseSix-6" aria-expanded="false" aria-controls="collapseSix-6">
                              Kemana pembayaran denda dapat dilakukan?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseSix-6" class="collapse" aria-labelledby="headingSix-6" data-parent="#accordion-4">
                            <div class="card-body">
                            <p class="mb-0">Pembayaran dibayarkan langsung ke bagian layanan sirkulasi di Ruang Perpustakaan. Saat ini perpustakaan belum menggunakan pembayaran secara online/elektronik.</p><p>
                            </p></div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="faq-block card-body">
                      <div class="container-fluid py-2">
                        <h5 class="mb-0">PENGUNA LUAR SMKN 1 CIMAHI</h5>
                      </div>
                      <div id="accordion-2" class="accordion">
                        <div class="card">
                          <div class="card-header" id="headingOne-2">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseOne-2" aria-expanded="true" aria-controls="collapseOne-2">
                                Apakah Pengguna Luar SMKN 1 Cimahi Dapat Meminjam Buku Fisik?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseOne-2" class="collapse show" aria-labelledby="headingOne-2" data-parent="#accordion-2">
                            <div class="card-body">
                              <p class="mb-0">TIDAK, Hanya pengguna dengan status siswa/siswi aktif di SMK Negeri 1 Cimahi saja yang dapat meminjam buku fisik.</p><p>
                            </p></div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="headingTwo-2">
                            <h5 class="mb-0">
                              <a data-toggle="collapse" data-target="#collapseTwo-2" aria-expanded="false" aria-controls="collapseTwo-2">
                                Apakah Pengguna Luar Dapat Mengakses E-Resourcess?
                              </a>
                            </h5>
                          </div>
                          <div id="collapseTwo-2" class="collapse" aria-labelledby="headingTwo-2" data-parent="#accordion-2">
                            <div class="card-body">
                              <p class="mb-0">YA, seluruh pengguna yang terdaftar pada sistem dapat mengakses informasi buku dalam bentuk digital.</p><p>
                            </p></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../../../Partials/_footer -->
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
  <!-- End custom js for this page-->
</body>

</html>