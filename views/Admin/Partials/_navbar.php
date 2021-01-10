
<nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown mr-2">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-email-open mx-0"></i>
                <?php
                $today = date("Y-m-d");
                $kueri = $koneksi->query("SELECT id_anggota FROM akun WHERE level='NSiswa'");
                $DSiswa = $kueri->fetch_assoc();
                $NSiswa = $kueri->num_rows;
  
                $notifikasi = "SELECT DATE(l.tanggal_pembuatan) as tanggal FROM log_akun l INNER JOIN akun a ON l.id_anggota=a.id_anggota WHERE l.tanggal_pembuatan LIKE '%".$today."%' AND a.level='NSiswa'";
                $notifikasi = $koneksi->query($notifikasi);
                $combine = $notifikasi->num_rows;
                if($combine>0){
                  echo("<span class='count bg-danger'>!</span>");
                }else{
                  echo("");
                }
                ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifikasi</p>
                
                  <?php 
                  if($NSiswa>0){
                    echo("
                    <a class='dropdown-item preview-item' href='/sipus/views/Admin/PendataanAnggota/Nonsiswa'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-info'>
                        <i class='mdi mdi-account-box mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                    <h6 class='preview-subject font-weight-normal'>".$NSiswa." Anggota Bukan Siswa</h6>
                    <p class='font-weight-light small-text mb-0 text-muted'>
                      Lihat Lebih Lanjut
                    </p>
                    </div>
                    </a>
                    ");
                  }else{
                    echo("
                    <a class='dropdown-item preview-item'>
                    <div class='preview-thumbnail'>
                      <div class='preview-icon bg-info'>
                        <i class='mdi mdi-account-box mx-0'></i>
                      </div>
                    </div>
                    <div class='preview-item-content'>
                    <h6 class='preview-subject font-weight-normal'>Tidak Ada Anggota Baru</h6>
                    <p class='font-weight-light small-text mb-0 text-muted'>
                      Belum Ada Anggota Baru
                    </p>
                    </div>
                    </a>
                    ");
                  }
                  ?>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <div id="MyClockDisplay" class="clock font-weight-bold d-none d-xl-block" onload="showTime()"></div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <span class="nav-profile-name"> Selamat Datang!
                  <b>
                <?php 
                $sql = "SELECT * FROM akun WHERE email='$email';";
                $result = $koneksi -> query($sql);
                $row = $result -> fetch_assoc();          
                echo($row["nama"]);
                ?>
                  </b> 
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="/sipus/views/Admin//Profile">
                  <i class="mdi mdi-settings text-primary"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="/sipus/views/Admin/destroy.php">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>