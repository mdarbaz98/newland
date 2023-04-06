<?php 
    require_once "include/database.php";
    $strength = $_POST['strength'];
    $userid = $_COOKIE["userID"];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $totalPrice = $_POST['totalPrice'];
    $fship = $_POST['fship'];
    $dcharge = $_POST['dcharge'];
    $userId = $_COOKIE["userID"];
    $quantityCode = $_POST['quantityCode'];
    $qty=0;
    $select_stmt1=$conn->prepare("SELECT * FROM ogcart WHERE quantityCode='$quantityCode' AND userID='$userId'");
    $select_stmt1->execute();
    while($row1=$select_stmt1->fetch(PDO::FETCH_ASSOC)){
        $qty = $row1['totalQuantity'];
        
        $totalPrice = $row1['totalQuantity']*$row1['totalPrice'];
        if($totalPrice>=250){
          $fship = "FREE SHIPING";
          $dcharge = '';
        }
        else if($totalPrice<=0){
          $totalPrice = $price*$quantity;
        }
        else {
          $fship = "";
          $dcharge = '+$25';
        }
    }
    if($qty<1){ 
        $btn = "
        <div class='cart-button  btn btn-primary'>
        <span class='add-to-cart '>Add To Cart</span>
        <span class='added' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' data-value='{$qty}'></span>
        <i class='fa fa-shopping-cart'></i>
        </div>";
    }
    else {
        $btn = "<span class='pqt-minus btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='dec' data-price=' onclick='dec(this)'>-</span>
        <div class='cart-button  btn btn-primary'>
        <span class='add-to-cart '></span>
        <span class='added' data-value='{$qty}'>{$qty}</span>
        <i class='fa fa-shopping-cart'></i>
        </div>
        <span class='pqt-plus btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' onclick='inc(this)' id='inc'>+</span>";
    }
    if($qty<=0){
      $qty=1;
    }

    $stickycart = "
      <div class='container'>
        <div class='row d-flex align-items-center pb-2'>
          
          <div class='col-xl-7 col-lg-7 col-md-7 d-flex'>
            <div class='col-xl-6 col-md-6 cart-strenth'>
              <h4 class='strength-name-shop'>Strength: <span class='cart-bold' id='product_strenght'>{$strength}</span></h4>
              <h4 class='qauntity-name-shop'>Quantity: <span class='cart-bold' id='product_quantity'>{$quantity} X {$qty}</span></h4>
            </div>
            <div class='col-xl-6 col-md-6 cart-strenth d-flex flex-column text-center'>
              <small><b>Total</b></small>
              <h2 style='color:black; font-size:32px; margin-bottom:0px; font-weight:700;'>$<span id='product_total_price'>{$totalPrice}</span> 
              
              <small id='dcharge' style='color:black; font-size:12px; margin-bottom:0px; font-weight:700;'> {$dcharge}</small></h2>
              
              <!-- <small>Free Shipping</small> -->
              
              <small id='fship-tag' style='color:black; background-color: #ffd60a; text-align:center; padding:0 10px ;'>{$fship}</small>
            </div>
          </div>
          <div class='col-xl-5 col-lg-5 col-md-5 d-flex align-items-center justify-content-center'>
            <!-- <a href='#' class='btn d-block add-btn btn-secondary'>Add to Cart</a> -->
            
            <div class='container' style='display:flex; justify-content:center;'>
                    ".$btn."
            </div>
          </div>

        </div>
      </div>
    ";
    echo $stickycart;


?>