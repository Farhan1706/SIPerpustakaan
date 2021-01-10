<table id="sh-req" class="table" style="width:100%">
    <thead>
        <tr class="bg-primary text-white">
            <td>No</td>
            <td>ID Peminjaman</td>
            <td>Peminjam</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include '../../../../database/koneksi.php';
            $no     = 1;
            $query  = "SELECT * FROM data_transaksi WHERE status ='PES' GROUP BY id_sk";
            $data   = $koneksi->prepare($query);
            $data->execute();
            $result = $data->get_result();

            

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stmt = $koneksi->prepare("SELECT nama from akun WHERE id_anggota='".$row['id_anggota']."'");
                    $stmt->execute();
                    $hasil = $stmt->get_result();
                    $agt = $hasil->fetch_assoc();

                    $id         = $row['id_sk'];
                    $peminjam   = $agt['nama'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $id; ?></td>
                <td><?php echo $peminjam; ?></td>
                <td class="">
                    <button id="<?php echo $id; ?>" class="btn btn-light detail"> <i class="mdi mdi-eye text-primary"></i> Lihat Detail! </button>
                    <button id="<?php echo $id; ?>" class="btn btn-light hapus_data"> <i class="mdi mdi-close text-danger"></i> Tolak Peminjaman! </button>
                </td>
            </tr>
        <?php } } else { ?> 
            <tr class="text-center">
                <td colspan='7'>Belum Ada Permintaan Peminjaman!</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sh-req').DataTable();
    } );

    $(document).on('click', '.detail', function(){
            var id = $(this).attr('id');
            window.location='./det/?id='+ id;
    });

    $(document).on('click', '.hapus_data', function(){
        Swal.fire({
					  title: 'Tolak Permintaan Peminjaman!',
					  text: "Apakah Anda Yakin Akan Menolak Peminjaman Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Hapus Permintaan!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "req/hb.php",
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Hapus Data!',
                    text: 'Data Berhasil Dihapus dari Daftar Buku',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
						window.location ='req-buku';
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