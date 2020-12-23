<?php
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
};
if(isset($_SESSION['rfid'])){
    $rfid = $_SESSION['rfid'];
};

include "../../../database/koneksi.php";
$sql = "SELECT * FROM akun WHERE email='$email';";
$result = $koneksi -> query($sql);
$row = $result -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../../public/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../../public/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../../public/css/vertical-style.css">
  <link rel="stylesheet" href="../../../public/css/Custom.css">
  <!-- endinject -->
</head>

<body>
  <div class="container-scroller d-flex">
    <!-- partial:../../partials/_sidebar.html -->
    <?php include '../Partials/_sidebar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial -->
      <!-- partial:../../partials/_navbar.html -->
      <?php include '../Partials/_navbar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
              <div class="col-12 grid-margin">
                  <div class="card">
                      <div class="card-body">
                      <div class="template-demo">
                          <nav aria-label="breadcrumb">
                          <ol class="breadcrumb breadcrumb-custom bg-primary">
                              <li class="breadcrumb-item"><a style="color: black; font-weight:bold; text-decoration: none;" href="#">Profil</a></li>
                              <li class="breadcrumb-item active" aria-current="page"><span>Pengaturan</span></li>
                          </ol>
                          </nav>
                      </div>
                      </div>
                  </div>
                  <div class="card">
                <div class="card-body">
                  <form id="example-vertical-wizard" action="#">
                    <div>
                      <h3>Profil Akun</h3>
                      <section>
                        <h3>Informasi Akun</h3>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input id="email" name="email" type="text" class="required form-control" value="<?php echo($email); ?>" disabled>
                        </div>
                        <div class="form-group">
                          <label for="Nama">Nama</label>
                          <input id="Nama" name="Nama" type="text" class="required form-control" value="<?php echo($row['Nama']); ?>" disabled>
                        </div>
                        <div class="form-group">
                          <label for="mobile">Kontak Telepon</label>
                          <input id="mobile" name="mobile" type="text" class="required form-control" value="<?php echo($row['mobile']); ?>" disabled>
                        </div>
                      </section>
                      <h3>Profile</h3>
                      <section>
                        <h3>Profile</h3>
                        <div class="form-group">
                          <label for="name">First name *</label>
                          <input id="name" name="name" type="text" class="required form-control">
                        </div>
                        <div class="form-group">
                          <label for="surname">Last name *</label>
                          <input id="surname" name="surname" type="text" class="required form-control">
                        </div>
                        <div class="form-group">
                          <label for="email">Email *</label>
                          <input id="email" name="email" type="text" class="required email form-control">
                        </div>
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input id="address" name="address" type="text" class="form-control">
                          <small>(*) Mandatory</small>
                        </div>
                      </section>
                      <h3>Finish</h3>
                      <section>
                        <h3>Finish</h3>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            I agree with the Terms and Conditions.
                          </label>
                        </div>
                      </section>
                    </div>
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
  <!-- Custom js for this page-->
  <script src="../../../public/js/Custom.js"></script>
  <script src="../../../public/js/jquery.steps.min.js"></script>
  <script src="../../../public/js/jquery.validate.min.js"></script>
  <script src="../../../public/js/profile.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
