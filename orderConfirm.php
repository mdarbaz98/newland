<?php
    include('include/header.php'); 
    if(!isset($_SESSION['invoiceId'])){
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        echo "<script>window.location.replace('".$actual_link."');</script>";
    }else {
        $invid = $_SESSION['invoiceId'];
    }
?>
<?php include('include/sidenav.php'); ?>
<?php
    
    $selectOrderDetails=$conn->prepare("SELECT * FROM orderdetails  WHERE orderid='".$invid."'");
    $selectOrderDetails->execute();  
    // $row=$selectOrderDetails->rowCount();
    while($row=$selectOrderDetails->fetch(PDO::FETCH_ASSOC))
    {
        $subtotal = $row['subtotal'];
        $total = $row['total'];
        $dcharge = $row['dcharge'];
        $discountOrder = $row['discount'];
        $userid = $row['userid'];
        $name = $row['fname']." ".$row['lname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['addressline1']." ".$row['addressline2'];
        $state = $row['state'];
        $city = $row['city'];
        $country = $row['country'];
        $totalCartAmount = $row['ogtotal'];
        $pincode  = $row['postalcode'];
        $coupon = $row['coupon'];
    }
    $selectOrders=$conn->prepare("SELECT * FROM ogorderproduct  WHERE orderid='".$invid."' AND userid='".$userid."'");
    $selectOrders->execute();  
    $itemCount=$selectOrderDetails->rowCount();
?>
<main class="offcanvas-enabled" style="padding-top: 8rem;">
    <section class="ps-lg-4 pe-lg-3 pt-4">

        <!-- Omkar 21-09-2021 start-->
        
        <div class="container">
            <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card" style=" padding: 34px 11px; ">
                        <div class="product-cart" style="width:100%;">
                            <div class="order-product">
                                
                                <div class="row product-row text-center">
                                    <div class="col-12 col-lg-12 text-center">
                                        <img src="https://myglobal1.gumlet.io/images/delivery-box.png" class="order-info-img">
                                        <div class="order-info text-left">
                                            <h3 class="mt-5">Order placed For <?php echo $_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2); ?>!</h3>  
                                        </div>
                                    </div>
                                    <!--<div class="col-4 col-lg-4 text-center d-flex align-items-center order-short-link">-->
                                    <!--    <img src="images/box.png" class="order-info-img">-->
                                    <!--    <div class="order-info text-left" style="text-align:right;">-->
                                            <!--<h3>Why Call? Just Click!</h3>  -->
                                            <!--<p>Easily track all your Newlands Pharmacy orders</p>-->
                                            <?php
                                                // if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
                                            ?>
                                            <!--<a href="account" type="button" class="btn btn-orders">Go to My Orders</a>-->
                                            <?php
                                                // }else{
                                            ?>
                                            <!--<a href="#signin-modal" data-bs-toggle="modal" type="button" class="btn btn-orders">Go to My Orders</a>-->
                                            <?php 
                                            // } 
                                            ?>
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-12">
                                        <h1 class="text-center order-title mt-2" style=" font-size: 12px; color: black; font-weight: 500; ">ORDER ID: #<?php echo $invid; ?></h1>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-2 mt-lg-2">
                        <div class="card" style=" height: 100%; ">
                            <div class="product-cart" style=" width: 100%; ">
                            <div class="product-heading" style="font-size: 15px;font-weight: 700;padding: 3px 0;text-align: center;color: #fff;background: #2196f3;">Order Summary</div>
                            
                            
                            
                            <div class="order-product">
                                <?php
                                    $selectOrders=$conn->prepare("SELECT * FROM ogorderproduct  WHERE orderid='".$invid."' AND userid='".$userid."'");
                                    $selectOrders->execute();  
                                    $count=$selectOrderDetails->rowCount();
                                    while($row=$selectOrders->fetch(PDO::FETCH_ASSOC))
                                    {
                                        $productCode = $row['productCode'];
                                        $strengthCode = $row['strengthCode'];
                                        $productName = $row['productName'];
                                        $productCategory = $row['productCategory'];
                                        $quantityCode = $row['strengthCode'];
                                        $quantity = $row['quantity'];
                                        $quantityPrice = $row['quantityPrice'];
                                        $saveAmount  =$row['saveAmount'];
                                        $orgPrice = $row['orgPrice'];
                                        $discount = $row['discount'];

                                        $totalQuantity = $row['totalQuantity'];
                                        $toalPrice = $row['totalPrice'];
                                        $selectProduct=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='".$productCode."'");
                                        $selectProduct->execute();
                                        while($product=$selectProduct->fetch(PDO::FETCH_ASSOC)){
                                            $productImage = $product['productImage'];
                                            $productName = $product['productName'];
                                        }
                                        
                                        $selectStrength=$conn->prepare("SELECT * FROM ogstrength WHERE strengthCode='".$strengthCode."'");
                                        $selectStrength->execute();
                                        while($strength=$selectStrength->fetch(PDO::FETCH_ASSOC)){
                                            $strengthName = $strength['strengthName'];
                                        }
                                        
                                        
                                        
                                ?>
                                <div class="row py-3 product-row" style=" justify-content: center; ">
                                    <div class="col-4 col-lg-4 text-center d-flex align-items-center" style="width: 109px;height: 74px;">
                                        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>" alt="">
                                    </div>
                                    <div class="col-6 col-lg-6">
                                        <a class="product-title mb-2" style=" font-size: 12px; color: #000; "><?php echo $productName ?> (<?php echo $strengthName; ?>)
                                        <?php
                                            if($discount>0){
                                        ?>
                                            <small style="background: #e91e63 !important;color: #fff;font-size: 10px;font-weight: 500;padding: 0px 11px 0px 11px;border-radius: 7px;margin-left: 5px;"><?php echo $discount; ?>%Off</small>
                                        <?php 
                                            }
                                        ?>
                                    </a>
                                        <div class="product-data">
                                            <div class="product-delivery"><span class="font-weight-600">Quantity:
                                                </span><span class="delivery-alert"><?php echo $quantity; ?></span>
                                            </div>
                                            <div class="product-delivery"><span class="font-weight-600">Strength:
                                                </span><span class="delivery-alert"><?php echo $strengthName ?></span>
                                            </div>
                                        </div>
                                        <div class="product-pricing" style=" font-size: 13px; font-weight: 700; ">
                                        <?php echo $_SESSION["currency_symbol"].number_format(($toalPrice*$_SESSION["currency_rate"]),2); ?> <span class="quantity-count">x (<?php echo $totalQuantity; ?>)</span>
                                        </div>
                                    </div>
                                    <div class="col-2 col-lg-2" style="height: 70px;display: flex;align-items: center;padding-left: 0px;">
                                            <span style="color:#000; font-weight: 700; font-size: 16px;"><?php echo $_SESSION["currency_symbol"].number_format(($toalPrice*$_SESSION["currency_rate"]),2); ?></span>
                                            <?php if($saveAmount>0){ ?>
                                                <small style="color:red; font-weight: 700; font-size: 12px; padding-left:4px;"><del><?php echo $_SESSION["currency_symbol"].number_format(($orgPrice*$_SESSION["currency_rate"]),2); ?></del></small>
                                                
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="col-12">
                                        <?php
                                            if(strpos($productCategory,'Steroids')>0){
                                                echo '<p style=" text-align: center; font-size: 10px; background: #20c5be; color: #fff; ">Item will be delivered within 15 Days To 18 Days - <b style="background: #119385;padding: 0 11px;">Standard Shipping</b></p>';
                                            }
                                            elseif(strpos($productName,'USA to USA')>0) {
                                                echo '<p style=" text-align: center; font-size: 10px; background: #20c5be; color: #fff; ">Item will be delivered within 7 Days To 10 Days - <b style="background: #f34770;padding: 0 11px;">USA to USA Shipping</b></p>';
                                            }
                                            elseif(strpos($productName,'Express')>0) {
                                                echo '<p style=" text-align: center; font-size: 10px; background: #20c5be; color: #fff; ">Item will be delivered within 10 Days - <b style="background: #4e54c8;padding: 0 11px;">Express Shipping</b></p>';
                                            }
                                            else {
                                                echo '<p style=" text-align: center; font-size: 10px; background: #20c5be; color: #fff; ">Item will be delivered within 15 Days To 21 Days - <b style="background: #119385;padding: 0 11px;">Standard Shipping</b></p>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row mt-2">
                
                

                <div class="col-lg-6 col-md-5 col-12">
                    <div class="row">
                        
                        <div id="subtotal" class="col-lg-12">
                            <div class="card mb-2">
                                <div id="subtotal" class="col-lg-12" style=" width: 100%; ">
                            <div class="mb-3">
                                <div class="product-cart">
                                    <div class="product-heading" style=" font-size: 15px; font-weight: 700; ">BILLING DETAILS</div>
                                        <div class="product-cart-padding">
                                        <div class="price-cart-align">
                                            <p class="">Item Total (<?php echo $count; ?> Items)</p>
                                            <p><?php echo $_SESSION["currency_symbol"].number_format(($totalCartAmount*$_SESSION["currency_rate"]),2); ?></p>
                                        </div>
                                        <div class="price-cart-align">
                                            <p class="">Discount<?php
                                                    if(!empty($coupon)){
                                                        echo "(<span style='color:blue; font-weight:600;'><i class='ci-lable'></i>&nbsp;$coupon</span>)";
                                                    }
                                                ?></p>
                                            <p class='discount-rate' style='color:red; font-weight: 700; '><span style='font-weight: 700;'>-</span><?php echo $_SESSION["currency_symbol"].number_format((($discount)*$_SESSION["currency_rate"]),2) ?></p>
                                        </div>
                                        <div class="price-cart-align">
                                            <p class="">Delivery Charges</p>
                                            <?php
                                                if($dcharge==0){
                                            ?>
                                            <p><span style="color:green;">FREE</span></p>
                                            <?php
                                                }else {
                                            ?>
                                            <p><span style='color: #119385; font-weight: 700;'>+<?php echo $_SESSION["currency_symbol"].number_format(($dcharge*$_SESSION["currency_rate"]),2); ?></span></p>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="price-cart-align">
                                            <p class="">Subtotal</p>
                                            <p><?php echo $_SESSION["currency_symbol"].number_format(($subtotal*$_SESSION["currency_rate"]),2); ?></p>
                                        </div>
                                        <div class="price-cart-align">
                                            <p class="price-label">Total Amount <span class="text-danger">*</span></p>
                                            <p class="price-label-final"><?php echo $_SESSION["currency_symbol"].number_format(($total*$_SESSION["currency_rate"]),2); ?></p>
                                        </div>
                                        <!--<div class="mt-3">-->
                                        <!--    <a href="payment/<?php echo $invid; ?>" type="button" class="btn btn-proceed">Pay Now</a>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-2 col-12 mb-3">
                    <div class="card mb-3" style=" padding: 25px; padding-right: 42px !important; ">
                                <div style=" width: 100%; ">
                                    <div class="product-heading p-0 mb-2" style="color:#000; font-size: 15px; font-weight: 700; ">Customer Details</div>
                                    <div class="det-box mb-2">
                                        <p class=""><b>Name:</b></p>
                                        <p><?php echo $name; ?></p>
                                    </div>
                                    <div class="det-box mb-2">
                                        <p class=""><b>Email:</b></p>
                                        <p><?php echo $email; ?></p>
                                    </div>
                                    <div class="det-box mb-2">
                                        <p class=""><b>Phone:</b></p>
                                        <p><?php echo $phone; ?></p>
                                    </div>
                                    <div class="product-heading p-0 mb-2" style="color:#000; font-size: 15px; font-weight: 700; ">Shipping Details</div>
                                    <div class="det-box">
                                    <?php
                                        // $selectAddress=$conn->prepare("SELECT * FROM ogaddress  WHERE id='".$addressId."'");
                                        // $selectAddress->execute();  
                                        // while($row=$selectAddress->fetch(PDO::FETCH_ASSOC))
                                        // {
                                        //     $name = $row['fname']." ".$row['lname'];
                                        //     $address  =$row['addressline1']." ".$row['addressline2'];
                                        //     $state = $row['state'];
                                        //     $city = $row['city'];
                                        //     $country = $row['country'];
                                        // }
                                    ?>
                                    </div>
                                    <div class="det-box mb-2">
                                        <p class=""><b>Address:</b></p>
                                        <p><?php echo $address; ?></p>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="det-box mb-2">
                                            <p class=""><b>Country:</b></p>
                                            <p><?php echo $country; ?></p>
                                        </div>
                                        <div class="det-box mb-2">
                                            <p class=""><b>State:</b></p>
                                            <p><?php echo $state; ?></p>
                                        </div>
                                        <div class="det-box mb-2">
                                            <p class=""><b>City:</b></p>
                                            <p><?php echo $city; ?></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                </div>
            </div>
        </div>



        <!-- Omkar 21-09-2021 end-->

    </section>
    <!-- 
    <script>
    $.fn.followTo = function(pos) {
        var $this = this,
            $window = $(windw);

        $window.scroll(function(e) {
            if ($window.scrollTop() > pos) {
                $this.css({
                    position: 'absolute',
                    top: pos
                });
            } else {
                $this.css({
                    position: 'fixed',
                    top: 0
                });
            }
        });
    };

    $('#fixed-content').scrollTo(22);
    </script> -->

</main>
<?php include('include/footer.php'); ?>