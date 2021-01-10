<nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>Utama</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sipus/views/Petugas/Dashboard">
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
              <li class="nav-item"> <a class="nav-link" href="/sipus/views/Petugas/PendataanBuku/data_buku">Data Buku</a></li>
              <li class="nav-item"> <a class="nav-link" href="/sipus/views/Petugas/PendataanAnggota/data_anggota">Data Anggota</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/sipus/views/Petugas/Transaksi">
            <i class="mdi mdi-rotate-3d menu-icon"></i>
            <span class="menu-title">Transaksi</span>
            <!-- <div class="badge badge-info badge-pill"></div> -->
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" data-toggle="collapse" href="#cttdata" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-script menu-icon"></i>
            <span class="menu-title">Catatan Data</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="cttdata" style="">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="/sipus/views/Petugas/Pencatatan/peminjaman">Peminjaman</a></li>
              <li class="nav-item"> <a class="nav-link" href="/sipus/views/Petugas/Pencatatan/pengembalian">Pengembalian</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>