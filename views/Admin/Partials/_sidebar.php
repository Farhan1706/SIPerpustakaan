<nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>Utama</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sipus/views/Admin/Dashboard">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            <!-- <div class="badge badge-info badge-pill"></div> -->
          </a>
        </li>
        <li class="nav-item sidebar-category">
          <p>Kontrol Data</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" data-toggle="collapse" href="#pendataan" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-book-multiple-variant menu-icon"></i>
            <span class="menu-title">Pendataan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="pendataan" style="">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="/sipus/views/Admin/PendataanBuku/data_buku">Data Buku</a></li>
              <li class="nav-item"> <a class="nav-link" href="/sipus/views/Admin/PendataanAnggota/data_anggota">Data Anggota</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item sidebar-category">
          <p>Pengaturan</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Pengaturan/">
            <i class="mdi mdi-settings menu-icon"></i>
            <span class="menu-title">Sistem</span>
            <!-- <div class="badge badge-info badge-pill"></div> -->
          </a>
        </li>
      </ul>
    </nav>