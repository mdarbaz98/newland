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
        $btn = "<a href='cart' class='cart-button  btn btn-accent'>
                Go to cart
        </a>
        
        ";
    }
    if($qty<=0){
      $qty=1;
    }

    $stickycart = "
      <div class='container'>
        <div class='row d-flex align-items-center'>
          <div class='close'><i class='ci-close'></i></div>
          <div class='col-xl-5 col-lg-5 col-md-4'>
            <div class='row d-flex align-items-center'>
              <div class='col-xl-3 col-lg-3 prdt-cart-sticky-img'>
                <img src='../onglobaladmincrm/{$image}' alt='' class='rounded-3'>
              </div>
              <div class='col-xl-9 col-lg-9'>
                <h3>{$name}</h3>
                <div class='h4 fw-normal mt-1 mb-0' class='cart-bold'><span class='cart-bold'>$</span><span id='product_price' class='cart-bold'>{$price}</span><small class='cart-bold' style='font-size:12px;'>/{$type}</small></div>
              </div>
            </div>
          </div>
          <div class='col-xl-4 col-lg-4 col-md-4 d-flex justify-content-center align-items-center'>
            <div class='col-xl-4 col-md-4 cart-strenth text-center'>
              <h4>Strength</h4>
              <p class='cart-bold' id='product_strenght'>{$strength}</p>
            </div>
            <div class='col-xl-4 col-md-4 cart-strenth  text-center'>
              <h4>Quantity</h4>
              <p class='cart-bold' id='product_quantity'>{$quantity} X {$qty}</p>
            </div>
            <div class='col-xl-4 col-md-4 cart-strenth d-flex flex-column justify-content-center align-items-center  text-center'>
              <small><b>Total</b></small>
              <h2 style='color:black; font-size:32px; margin-bottom:0px; font-weight:700;'>$<span id='product_total_price'>{$totalPrice}</span> 
              
              <small id='dcharge' style='color:black; font-size:12px; margin-bottom:0px; font-weight:700;'> {$dcharge}</small></h2>
              
              <!-- <small>Free Shipping</small> -->
              
              <small id='fship-tag' style='color:black; background-color: #ffd60a; text-align:center; padding:0 10px ;'>{$fship}</small>
            </div>
          </div>
          <div class='col-xl-3 col-lg-3 col-md-3'>
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