<?php

require "../Bootstap/dbuser.php";
$order_id=$_REQUEST["order_id"];
$all_products=$dbOrder->getProductsOfOrder($order_id);
foreach($all_products as $product){
    echo '
    
    
    <div class="col mt-3">
    <div class="position-relative d-inline-block">
        <div class="card p-1" style="width: 10rem;">
            <img class="card-img-top"
                src="../public/images/products_images/'.$product["image"].'"
                alt="">
            <h5 class="card-title text-center">'.$product["name"].'</h5>
            <div class="card-foorer">
                Count : <span>'.$product["count"].'</span>
            </div>
        </div>
        <span
            class=" p-2 m-2 start-100 translate-middle badge badge-info  " style="position:absolute;top:-15px; left:88%;">'.$product["price"] .' LE
        </span>
    </div>
</div>

';
}