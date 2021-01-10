<table id="sh-req" class="table" style="width:100%">
    <thead>
        <tr class="bg-primary text-white">
            <td>No</td>
            <td>Nama</td>
            <td>Kelas</td>
            <td>Pembuatan</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include '../../../../database/koneksi.php';
            $no     = 1;
            $query  = "SELECT * FROM akun WHERE level='NSiswa'";
            $data   = $koneksi->prepare($query);
            $data->execute();
            $result = $data->get_result();


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stmt = $koneksi->prepare("SELECT DATE(tanggal_pembuatan) as selisih FROM log_akun WHERE id_anggota='".$row['id_anggota']."'");
                    $stmt->execute();
                    $hasil = $stmt->get_result();
                    $loghp = $hasil->fetch_assoc();

                    $nama   = $row['nama'];
                    $kelas  = $row['kelas'];
                    $id     = $row['id_anggota'];

                    // Inisiasi Hari
                    $tgl1 = date("Y-m-d");
                    $tgl2 = $loghp['selisih'];

                    $pecah1 = explode("-", $tgl1);
                    $date1 = $pecah1[2];
                    $month1 = $pecah1[1];
                    $year1 = $pecah1[0];

                    $pecah2 = explode("-", $tgl2);
                    $date2 = $pecah2[2];
                    $month2 = $pecah2[1];
                    $year2 =  $pecah2[0];

                    $jd1 = GregorianToJD($month1, $date1, $year1);
                    $jd2 = GregorianToJD($month2, $date2, $year2);

                    $selisih = $jd1 - $jd2;

                    
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama; ?></td>
                <td><?php echo $kelas; ?></td>
                <td>
                <?php
                if($selisih>0){
                    echo "".$selisih." Hari yang Lalu";
                }else{
                    echo "Hari Ini";
                }
                ?>
                
                </td>
                <td class="">
                    <button id="<?php echo $id; ?>" class="btn btn-light rubah"> <i class="mdi mdi-eye text-primary"></i> Rubah Akun! </button>
                    <button id="<?php echo $id; ?>" class="btn btn-light hapus_data"> <i class="mdi mdi-close text-danger"></i> Hapus Akun! </button>
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

    $(document).on('click', '.rubah', function(){
        Swal.fire({
					  title: 'Rubah Status Akun!',
					  text: "Apakah Anda Yakin Akan Merubah Akun Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Rubah!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "ra.php",
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Rubah Data!',
                    text: 'Data Berhasil Dirubah dari Daftar Akun',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
						window.location ='../Nonsiswa';
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

    $(document).on('click', '.hapus_data', function(){
        Swal.fire({
					  title: 'Hapus Akun!',
					  text: "Apakah Anda Yakin Akan Menghapus Akun Ini?",
					  icon: 'warning',
					  showCancelButton: true,
                      cancelButtonText: 'Batal',
					  confirmButtonText: 'Hapus Akun!'
        }).then((result) => {
        if (result.value){
            var id = $(this).attr('id');

            $.ajax({
            type: 'POST',
            url: "ha.php",
            data: {id:id},
            success: function(response) {
                Swal.fire({
                    title: 'Proses Hapus Data!',
                    text: 'Data Berhasil Dihapus dari Daftar Akun',
                    icon :'success',
                    showConfirmButton: false,
                    timer: 1500
                    }).then((result) => {
						window.location ='../Nonsiswa';
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