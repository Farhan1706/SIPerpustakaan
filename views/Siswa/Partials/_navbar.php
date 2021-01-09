
<nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
              <h4 id="TampilTanggal" class="mb-0 font-weight-bold d-none d-xl-block"></h4>
            </li>
            <li class="nav-item dropdown mr-1">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" href="../Dashboard/">
                <i class="mdi mdi-home mx-0"></i>
              </a>
            </li>
            <li class="nav-item dropdown mr-2">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="../konten/cart_buku">
                <i class="mdi mdi-cart-outline mx-0"></i>
                <?php
                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            if($count > 0){
                              echo " <span class='count bg-danger'> $count";
                            }
                        }else{
                            echo " ";
                        }

                        ?>
                </span>
              </a>
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
                $akun = $result -> fetch_assoc();          
                echo($akun["nama"]);
                ?>
                  </b> 
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="../Profile">
                  <i class="mdi mdi-settings text-primary"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="../destroy.php">
                  <i class="mdi mdi-logout text-primary"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>