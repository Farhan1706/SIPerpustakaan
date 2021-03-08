<table id="order-listing" class="table">
    <thead>
      <tr class="bg-primary text-white">
          <th>No</th>
          <th>Id Anggota</th>
          <th>Nama</th>
          <th>J.Kelamin</th>
          <th>Kelas</th>
          <th>No HP</th>
          <th>Status</th>
          <th>Kelola</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include '../../../database/koneksi.php';
    $no     = 1;
    $query  = "SELECT * FROM akun ORDER BY id_anggota ASC";
    $data   = $koneksi->prepare($query);
    $data->execute();
    $result = $data->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id     = $row['id_anggota'];
            $nama   = $row['nama'];
            $jekel  = $row['jekel'];
            $kelas  = $row['kelas'];
            $no_hp  = $row['no_hp'];
            $level  = $row['level'];
    ?>
      <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $id; ?></td>
          <td><?php echo $nama; ?></td>
          <td><?php if ($jekel == "LK"){echo ("Laki-Laki");}else{echo ("Perempuan");}?></td>
          <td><?php echo $kelas; ?></td>
          <td><?php echo $no_hp; ?></td>
          <td><?php echo $level; ?></td>
          <td class="text-right">
            <button id="<?php echo $id; ?>" class="btn btn-light edit_data"> <i class="mdi mdi-eye text-primary"></i> Sunting </button>
            <button id="<?php echo $id; ?>" class="btn btn-light hapus_data"> <i class="mdi mdi-close text-danger"></i> Hapus </button>
          </td>
      </tr>
      <?php } } else { ?> 
        <tr class="text-center">
            <td colspan='7'>Belum Ada Anggota yang Ditambahkan!</td>
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
					  title: 'Proses Sunting Anggota!',
					  text: "Apakah Anda Yakin Akan Menyunting Data Ini?",
					  icon: 'question',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Sunting Data!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');
            // window.location='./edit_anggota?id='+ CryptoJS.AES.encrypt(id, "Edit Anggota");
            window.location='./edit_anggota?id='+ id;
        }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        Swal.fire({
					  title: 'Proses Hapus Anggota!',
					  text: "Apakah Anda Yakin Akan Menghapus Anggota Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Hapus Anggota!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');
            
            $.ajax({
            type: 'POST',
            url: "hapus_anggota.php",
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Hapus Data!',
                    text: 'Data Berhasil Dihapus dari Daftar Anggota',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
						$('.show_anggota').load("show_anggota.php");
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