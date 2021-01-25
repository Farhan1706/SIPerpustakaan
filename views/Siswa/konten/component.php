<?php


function component($judul_buku, $item_image, $id_buku){
    $out = strlen($judul_buku) > 50 ? substr($judul_buku,0,50)."..." : $judul_buku;
    $element = "
    <div class='col-md-3 col-sm-6 col-lg-3 col-xl-3'>
                <form action='../Dashboard/' method='post'>
                    <div class='card shadow col mt-4'>
                            <img src='../../../public/images/public_images/".$item_image."' class='mt-3' height='300px' alt='Gambar Produk'>
                        <div class='card-body konten'>
                            <h5 class='card-title'>$out</h5>
                        </div>
                        <div class='btn-group' role='group' aria-label='Basic example'>
                            <button type='submit' class='btn btn-primary my-3' name='add'><i class='mdi mdi-plus '></i>Tambah</button>
                            <a class='btn btn-info my-3' href='../konten/detail?id=$id_buku'><i class='mdi mdi-magnify '></i>Lihat Detail</a>
                        </div>
                        <input type='hidden' name='product_id' value='$id_buku'>
                    </div>
                </form>
    </div>
    ";
    echo $element;
}

function cartElement($item_image, $judul_buku, $pengarang, $id_buku){
    $element = "
                    <div class=\"col border rounded\">
                        <div class=\"row bg-white mb-3\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=../../../public/images/public_images/$item_image class=\"img-fluid\" alt=\"Gambar Produk\">
                            </div>
                            <div class=\"col-md-6 mt-5\">
                                <h5 class=\"pt-2\">$judul_buku</h5>
                                <small class=\"text-secondary\">Pengarang : </small>
                                <h5 class=\"pt-2\">$pengarang</h5>
                            </div>
                            <div class=\"col-md-3 py-5 align-items-center\">
                                <a class=\"btn btn-danger mt-5 mr-2 col\" href=\"cart_buku.php?action=remove&id=$id_buku\">Hapus</a>
                            </div>
                        </div>
                    </div>
    ";
    echo  $element;
}

















