<?php
require "../Bootstap/dbuser.php";
$user_id = $_REQUEST["user_id"];
$all_orders = $dbOrder->selectUserOrders($user_id);
foreach ($all_orders as $Order) {
    $id = $Order["id"];
    echo '
    
<tr  onclick="getProducts(this)" class="products py-0 px-2"  
orderid="' . $id . '"  val="order' . $id . '"  style="cursor:pointer">
<td>' . $Order["created_at"] . '</td>
<td>' . $Order["totalPrice"] . '</td>
</tr>
<tr id="order' . $id . '" class="hide" >
<td colspan="2">
<div class="accordion-body">
<div class="container">
  <div class="row row1">

  </div>
  
  </div>
</div>
</td>
</tr>

';
}
