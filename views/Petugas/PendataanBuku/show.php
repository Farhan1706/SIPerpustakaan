<table id="order-listing" class="table" style="width:100%">
    <thead>
        <tr class="bg-primary text-white">
            <td>No</td>
            <td>ID Buku</td>
            <td>Judul Buku</td>
            <td>Pengarang</td>
            <td>Penerbit</td>
            <td>Nomor ISBN</td>
            <td>Kelola</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include '../../../database/koneksi.php';
            $no     = 1;
            $query  = "SELECT * FROM data_buku ORDER BY id_buku ASC";
            $data   = $koneksi->prepare($query);
            $data->execute();
            $result = $data->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id         = $row['id_buku'];
                    $judul_buku = $row['judul_buku'];
                    $pengarang  = $row['pengarang'];
                    $penerbit   = $row['penerbit'];
                    $ISBN       = $row['ISBN'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $id; ?></td>
                <td><?php echo $judul_buku; ?></td>
                <td><?php echo $pengarang; ?></td>
                <td><?php echo $penerbit; ?></td>
                <td><?php echo $ISBN; ?></td>
                <td class="text-right">
                    <button id="<?php echo $id; ?>" class="btn btn-light edit_data"> <i class="mdi mdi-eye text-primary"></i> Sunting </button>
                    <button id="<?php echo $id; ?>" class="btn btn-light hapus_data"> <i class="mdi mdi-close text-danger"></i> Hapus </button>
                </td>
            </tr>
        <?php } } else { ?> 
            <tr class="text-center">
                <td colspan='7'>Belum Ada Buku yang Ditambahkan!</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#order-listing').DataTable();
    } );

    $(document).on('click', '.edit_data', function(){
        Swal.fire({
					  title: 'Proses Sunting Buku!',
					  text: "Apakah Anda Yakin Akan Menyunting Buku Ini?",
					  icon: 'question',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Sunting Buku!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');

            window.location='./edit?id='+ id;
        }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        Swal.fire({
					  title: 'Proses Hapus Buku!',
					  text: "Apakah Anda Yakin Akan Menghapus Buku Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Hapus Buku!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "hb.php",
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Hapus Data!',
                    text: 'Data Berhasil Dihapus dari Daftar Buku',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
						$('.sb').load("show.php");
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