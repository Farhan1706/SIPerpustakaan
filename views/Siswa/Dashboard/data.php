<div class="ml-1 mr-1">
  <div class="row text-center py-5">
        <?php
            include '../../../database/koneksi.php';
            include ('../konten/component.php');
          // Inisiasi Search
          $s_keyword="";
          if (isset($_POST['keyword'])) {
              $s_keyword = $_POST['keyword'];
          }
          $search_keyword = '%'. $s_keyword .'%';


          // Numbering Untuk Pagination
            // Cek apakah terdapat data pada page URL
            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

            $limit = 12; // Jumlah data per halamanya

            // Buat query untuk menampilkan data ke berapa yang akan ditampilkan pada tabel yang ada di database
            $limit_start = ($page - 1) * $limit;

            // Buat query untuk menampilkan data buku sesuai limit yang ditentukan
            $sql = "SELECT * FROM data_buku WHERE judul_buku LIKE ? OR pengarang  LIKE ? OR penerbit  LIKE ? LIMIT $limit_start,$limit";     
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("sss", $search_keyword,$search_keyword,$search_keyword);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()){
              component($row['judul_buku'], $row['item_image'], $row['id_buku']);
            }
        ?>
  </div>
</div>
<div class="card-body">
  <nav>
      <ul class="pagination d-flex flex-wrap justify-content-center pagination-primary">
  <!-- Numbering Untuk Pagination Button -->
  <?php 
  if ($page == 1) { // Jika page adalah pake ke 1, maka disable link PREV
  ?>
      <li class="page-item" disabled><a class="page-link" href="#">First</a></li>
      <li class="page-item" disabled><a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a></li>
  <?php 
  }else{ //Jika buka page ke 1
    $link_prev = ($page>1) ? $page - 1 : 1;
  ?>
    <li class="page-item"><a class="page-link" href="?page=1">First</a></li>
    <li class="page-item"><a class="page-link" href="?page<?php echo $link_prev; ?>"><i class="mdi mdi-chevron-left"></i></a></li>
  <?php 
  }
  ?>
      
      <!-- Link Number -->
      <?php
      // Buat query untuk menghitung semua jumlah data
      $sql2 = $koneksi->prepare("SELECT COUNT(*) AS jumlah FROM data_buku");
      $sql2->execute();
      $result = $sql2->get_result();
      $get_jumlah = $result->fetch_assoc();

      $jumlah_page = ceil($get_jumlah['jumlah'] / $limit);//Hitung Jumlah halaman
      $jumlah_number = 3; //Tentukan jumlah link number sebelum dan sesudah page yang aktif
      $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link member
      $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
      // Perulangan Untuk Button
      for ($i = $start_number; $i <= $end_number; $i++){
        $link_active = ($page == $i) ? 'active' : '';
      ?>
        <li class="page-item <?php echo $link_active; ?>"> <a class="page-link" href="?page=<?php echo $i; ?>"> <?php echo $i; ?></a></li>
      <?php 
      }
      ?>

      <!-- LINK NEXT AND LAST -->
      <?php
      // Jika page sama dengan jumlah page, maka disable link NEXT nya
      // Artinya page tersebut adalah page terakhir
      if ($page == $jumlah_page) { // Jika page terakhir
      ?>
          <li class="page-item"><a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a></li>
          <li class="page-item"><a class="page-link" href="#">Last</a></li>
      <?php
      } else { // Jika bukan page terakhir
          $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
      ?>
          <li class="page-item"><a class="page-link" href="?page=<?php echo $link_next ?>"><i class="mdi mdi-chevron-right"></i></a></li>
          <li class="page-item"><a class="page-link" href="?page=<?php echo $jumlah_page ?>">Last</a></li>
      <?php
      }
      ?>
      </ul>
  </nav>
</div>