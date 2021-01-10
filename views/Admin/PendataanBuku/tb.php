<?php 
echo date("Y-m-d h:i:s");
if(isset($_POST['save'])){
  include '../../../database/koneksi.php';
  $id_buku    = $_POST['id_buku'];
  $judul_buku = $_POST['judul_buku'];
  $pengarang  = $_POST['pengarang'];
  $penerbit   = $_POST['penerbit'];
  $ISBN        = $_POST['ISBN'];
  $th_terbit  = $_POST['th_terbit'];
  $sinopsis   = $_POST['sinopsis'];
  $tanggal    = date("Y-m-d h:i:s");

  if($sinopsis==null){
      $sinopsis="Sinopsis Belum Tersedia Untuk Buku Ini";
  }

  //Mendapatkan File Gambar
  if($_FILES['cover']['name']!=null){
    // Mendapatkan File Gambar
    $imgFile = $_FILES['cover']['name'];
    $tmp_dir = $_FILES['cover']['tmp_name'];
    $imgSize = $_FILES['cover']['size'];
  
    // setting file gambar
    $upload_dir = '../../../public/images/public_images/';
    $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
    $itempic = rand(1000,1000000).".".$imgExt;
  }

  //Mendapatkan File PDF
  if($_FILES['salinan']['name']!=null){
    // Mendapatkan File PDF
    $pdfFile = $_FILES['salinan']['name'];
    $tmp_pdf = $_FILES['salinan']['tmp_name'];
    $pdfSize = $_FILES['salinan']['size'];
    $pdfExt = strtolower(pathinfo($pdfFile,PATHINFO_EXTENSION));
    
    // setting file PDF
    if($pdfExt == "pdf"){
      // setting file PDF
      $pdf_dir = '../../Siswa/ebook/external/read/web/';
      $itempdf = rand(1000,1000000).".".$pdfExt;
    }else{
            echo "
            <script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'File Harus Berupa PDF'
              })
            </script>
          ";
          header("Location:./data_buku");
          exit;
    }
    
  }

  if(($_FILES['cover']['name']!=null)&&($_FILES['salinan']['name'])!=null){ 

    // queri
    $sql_buku = "INSERT INTO data_buku (id_buku,judul_buku,pengarang,penerbit,th_terbit,ISBN,item_image,item_document,sinopsis) VALUES (
        '".$id_buku."',
        '".$judul_buku."',
        '".$pengarang."',
        '".$penerbit."',
        '".$th_terbit."',
        '".$ISBN."',
        '".$itempic."',
        '".$itempdf."',
        '".$sinopsis."')";
    $sql_log = "INSERT INTO log_buku(id_buku,tanggal_pembuatan) VALUES (
        '".$id_buku."',
        '".$tanggal."')";

    /* Check file extension */
    if(in_array($imgExt, $valid_extensions)){
            /* Upload file */
            if($koneksi->query($sql_buku)){
                $koneksi->query($sql_log);
                move_uploaded_file($tmp_pdf,$pdf_dir.$itempdf);
                move_uploaded_file($tmp_dir,$upload_dir.$itempic);
                
          header("Location:./data_buku");
          exit;
            }
    }else{
      echo "
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'File Harus Berupa JPEG, JPG, PNG, GIF'
        })
      </script>
          ";
    }

  }elseif(($_FILES['cover']['name']!=null)&&($_FILES['salinan']['name'])==null){

    // queri
    $sql_buku = "INSERT INTO data_buku (id_buku,judul_buku,pengarang,penerbit,th_terbit,ISBN,item_image,sinopsis) VALUES (
        '".$id_buku."',
        '".$judul_buku."',
        '".$pengarang."',
        '".$penerbit."',
        '".$th_terbit."',
        '".$ISBN."',
        '".$itempic."',
        '".$sinopsis."')";
    $sql_log = "INSERT INTO log_buku(id_buku,tanggal_pembuatan) VALUES (
      '".$id_buku."',
      '".$tanggal."')";

    /* Check file extension */
    if(in_array($imgExt, $valid_extensions)){
            /* Upload file */
            if($koneksi->query($sql_buku)){
                $koneksi->query($sql_log);                
                move_uploaded_file($tmp_dir,$upload_dir.$itempic);
                
          header("Location:./data_buku");
          exit;
            }
    }else{
      echo "
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'File Harus Berupa JPEG, JPG, PNG, GIF'
        })
      </script>
          ";
    }

  }elseif(($_FILES['salinan']['name']!=null)&&($_FILES['cover']['name'])==null){

    // queri
    $sql_buku = "INSERT INTO data_buku (id_buku,judul_buku,pengarang,penerbit,th_terbit,ISBN,item_document,sinopsis) VALUES (
        '".$id_buku."',
        '".$judul_buku."',
        '".$pengarang."',
        '".$penerbit."',
        '".$th_terbit."',
        '".$ISBN."',
        '".$itempdf."',
        '".$sinopsis."')";
    $sql_log = "INSERT INTO log_buku(id_buku,tanggal_pembuatan) VALUES (
      '".$id_buku."',
      '".$tanggal."')";

            /* Upload file */
            if($koneksi->query($sql_buku)){
                $koneksi->query($sql_log);
                move_uploaded_file($tmp_pdf,$pdf_dir.$itempdf);
                
          header("Location:./data_buku");
          exit;
            }
  }else{
    $sql_buku = "INSERT INTO data_buku (id_buku,judul_buku,pengarang,penerbit,th_terbit,ISBN,sinopsis) VALUES (
        '".$id_buku."',
        '".$judul_buku."',
        '".$pengarang."',
        '".$penerbit."',
        '".$th_terbit."',
        '".$ISBN."',
        '".$sinopsis."')";
    $sql_log = "INSERT INTO log_buku(id_buku,tanggal_pembuatan) VALUES (
      '".$id_buku."',
      '".$tanggal."')";
      
    if($koneksi->query($sql_buku)){
          $koneksi->query($sql_log);
          header("Location:./data_buku");
          exit;
    }
  }
  echo "
  <script>
  Swal.fire({
    icon: 'error',
    title: 'Oops..BRUHH.',
    text: 'Terjadi Kesalahan!'
    })
  </script>
  ";
}
?>