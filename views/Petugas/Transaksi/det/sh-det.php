<?php 
 $id_sk = $_GET['id'];
 include '../../../../database/koneksi.php';
 $no     = 1;
 $query  = "SELECT * FROM data_transaksi WHERE status ='PES' AND id_sk='".$id_sk."'";
 $data   = $koneksi->prepare($query);
 $data->execute();
 $result = $data->get_result();
if($result->num_rows > 0){
    echo"
    <div class='grid-margin'>
        <button id='".$id_sk."' class='btn btn-inverse-info text-white pinjam'>
        <i class='mdi mdi-check'></i> Setujui Permintaan Peminjaman</button>
    </div>
    ";
}else{
    echo"";
}
?>
<table id="sh-req" class="table" style="width:100%">
    <thead>
        <tr class="bg-primary text-white">
            <td>No</td>
            <td>ID Peminjam</td>
            <td>Nama Peminjam</td>
            <td>Nama Buku</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stmt = $koneksi->prepare("SELECT nama from akun WHERE id_anggota='".$row['id_anggota']."'");
                    $stmt->execute();
                    $hasil = $stmt->get_result();
                    $agt = $hasil->fetch_assoc();

                    $stmt = $koneksi->prepare("SELECT judul_buku from data_buku WHERE id_buku='".$row['id_buku']."'");
                    $stmt->execute();
                    $hasil = $stmt->get_result();
                    $bk = $hasil->fetch_assoc();

                    $id_agt         = $row['id_anggota'];
                    $peminjam       = $agt['nama'];
                    $buku           = $bk['judul_buku'];

        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $id_agt; ?></td>
                <td><?php echo $peminjam; ?></td>
                <td><?php echo $buku; ?></td>
                <td >
                    <button id="<?php echo $row['id'] ?>" class="btn btn-light hapus_data"> <i class="mdi mdi-close text-danger"></i> Hapus </button>
                </td>
            </tr>
        <?php } } else { ?> 
            <tr class="text-center">
                <td colspan='7'>Belum Ada Buku yang Ditambahkan!</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sh-req').DataTable();
    } );

    $(document).on('click', '.hapus_data', function(){
        Swal.fire({
					  title: 'Hapus Permintaan Peminjaman!',
					  text: "Apakah Anda Yakin Akan Menghapus Buku Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Hapus Permintaan!'
        }).then((result) => {
        if (result.value){
            var id_hapus = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "hd.php",
            data: {id_hapus:id_hapus},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Hapus Data!',
                    text: 'Data Berhasil Dihapus dari Daftar Buku',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
						location.reload()
					});
            },error: function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal Menghapus!'
                });
            }
            });
        }
        })
    });

    $(document).on('click', '.pinjam', function(){
        Swal.fire({
					  title: 'Proses Persetujuan!',
					  text: "Apakah Anda Yakin Akan Menyetujui Peminjaman Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Setujui Permintaan!'
        }).then((result) => {
        if (result.value){
            var id_pinjam = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "pj.php",
            data: {id_pinjam:id_pinjam},
            success: function(response) {
                Swal.fire({
                    title: 'Peminjaman!',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
						location.reload()
					});
            },error: function(response){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal Menghapus!'
                });
            }
            });
        }
        })
    });
</script>