<?php

function component($productname, $productprice, $productimg, $productid){
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-5 my-md-4\">
                <form action=\"index\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=../../../public/images/public_images/".$productimg." alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body konten\">
                        <h5 class=\"card-title\">$productname</h5>
                        </div>
                        <div class='card-footer'>
                                <button type=\"submit\" class=\"btn btn-outline-dark my-3\" name=\"add\"><i class=\"mdi mdi-plus mdi-24px col-sm-5\"></i></button>
                                <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
                    <div class=\"col border rounded\">
                        <div class=\"row bg-white mb-3\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=../../../public/images/public_images/$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6 mt-5\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$$productprice</h5>
                            </div>
                            <div class=\"col-md-3 py-5 align-items-center\">
                                <a class=\"btn btn-danger mt-5 mr-2 col\" href=\"cart_buku.php?action=remove&id=$productid\">Remove</a>
                            </div>
                        </div>
                    </div>
    ";
    echo  $element;
}

















