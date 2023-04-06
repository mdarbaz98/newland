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
    $dcharge = '+$25';
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
          $dcharge = '+ $25';
        }
    }
    if($qty==0){ 
        $btn = "
        <div class='container' style='display:flex;align-items: center;flex-direction: row;column-gap: 11px;'>
            <div class='cart-button1  btn btn-primary'>
            <span class='add-to-cart1'>Add To Cart</span>
            <span class='added1' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' data-value='{$qty}'></span>
            <i class='fa fa-shopping-cart'></i>
            </div>
            <button class='btn btn-icon btn-secondary mb-0' type='submit' data-bs-toggle='tooltip' title='Add to Wishlist'><i class='fa-solid fa-heart fs-lg'></i></button>
        </div>
        ";
        
    }
    else {
        $btn = "
        <div class='container' style='display:flex;align-items: center;flex-direction: row;column-gap: 11px;'>
        <span class='pqt-minus1 btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' id='dec' data-price=' onclick='dec(this)'>-</span>
        <div class='cart-button1  btn btn-primary'>
        <span class='add-to-cart1'></span>
        <span class='added1' data-value='{$qty}'>{$qty}</span>
        <i class='fa fa-shopping-cart'></i>
        </div>
        <span class='pqt-plus1 btn d-block btn-light' data-qty='{$quantity}' data-qty-code={$quantityCode} data-user='{$userid}' onclick='inc(this)' id='inc'>+</span>
        <button class='btn btn-icon btn-secondary mb-0' type='submit' data-bs-toggle='tooltip' title='Add to Wishlist'><i class='fa-solid fa-heart fs-lg'></i></button>
        </div>
        ";
    }

    echo $btn;


?>