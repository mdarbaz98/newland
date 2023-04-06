<?php
    session_start();
    error_reporting(0);
    $productSeoTitle = $_SESSION['invoiceId'];
    $productSeoDescription = $_SESSION['invoiceId'];
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
        $orderStatus = $row['orderStatus'];
        $country = $row['country'];
        $totalCartAmount = $row['ogtotal'];
        $pincode  = $row['postalcode'];
        $coupon = $row['coupon'];
        $date = $row['offsetDate'];
        $dt = new DateTime($utc);
        $dt->format('M d, Y at h:i a');
    }
    $selectOrders=$conn->prepare("SELECT * FROM ogorderproduct  WHERE orderid='".$invid."' AND userid='".$userid."'");
    $selectOrders->execute();  
    $itemCount=$selectOrderDetails->rowCount();
?>
<main class="offcanvas-enabled" style="padding-top: 78px;padding-bottom: 35px;">
    <input type="hidden" id="finalInvId" value="<?php echo $orderStatus ?>">
    <section class="ps-lg-4 pe-lg-3 pt-4">

        <!-- Omkar 21-09-2021 start-->
        
        <div class="container">
            <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="card" style="padding: 17px 11px 34px 11px; display:block;padding-right: 11px !important;">
                            <div class="card-info">
                                <?php
                                    $dt = new DateTime('2016-12-12 12:12:12', new DateTimeZone('UTC'));
                                    $dt->setTimezone(new DateTimeZone('America/Denver'));

                                ?>
                                <h2 class="orderHead"><i class="fa-solid fa-circle-check"></i> Order Placed</h2>
                                <p class="orderTime"><?php echo $_SESSION['invoiceId']; ?></p>
                            </div>
                            <hr>
                            <div class="order-product">
                                <div class="row product-row product-table-head" style="padding: 0 24px 11px 24px;border-bottom: 1px dashed #c9c9c9;margin: 13px auto 0 auto;width: 94%;">
                                    <div class="col-8 col-lg-9">
                                        <p>Product Details</p>
                                    </div>
                                    <div class="col-4 col-lg-3">
                                        <p>Subtotal</p>
                                    </div>
                                </div>
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
                                <div class="row py-3 product-row" style=" padding: 0 15px; ">
                                    <div class="col-4 col-lg-4 text-center d-flex align-items-center" style="width: 109px;height: 74px;">
                                        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>" alt="" style=" border: 1px solid #d9d9d9; border-radius: 7px; ">
                                    </div>
                                    <div class="col-6 col-lg-6" style="display: flex;flex-direction: column;justify-content: center;">
                                        <a class="product-title" style=" font-size: 12px; color: #000; "><?php echo $productName ?> (<?php echo $strengthName; ?>)
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
                                            <div class="product-delivery"><span class="font-weight-600"> Strength:
                                                </span><span class="delivery-alert"><?php echo $strengthName ?></span>
                                            </div>
                                        </div>
                                        <div class="product-pricing" style=" font-size: 13px; font-weight: 700; ">
                                        <?php echo $_SESSION["currency_symbol"].number_format(($toalPrice*$_SESSION["currency_rate"]),2); ?> <span class="quantity-count">x (<?php echo $totalQuantity; ?>)</span>
                                        </div>
                                    </div>
                                    <div class="col-2 col-lg-2" style="height: 70px;display: flex;align-items: center;padding-left: 0px; flex-direction: column;     justify-content: center;">
                                            <span style="color:#000; font-weight: 700; font-size: 16px;"><?php echo $_SESSION["currency_symbol"].number_format(($toalPrice*$_SESSION["currency_rate"]),2); ?></span>
                                            <?php if($saveAmount>0){ ?>
                                                <p><del><?php echo $_SESSION["currency_symbol"].number_format(($orgPrice*$_SESSION["currency_rate"]),2); ?></del></p>
                                                
                                            <?php
                                                }
                                            ?>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="row">
                        
                                <div id="subtotal" class="col-lg-12">
                                    <div class="card mb-2">
                                        <div id="subtotal" class="col-lg-12" style=" width: 100%; ">
                                    <div class="mb-3">
                                        <div class="product-cart">
                                            <div class="card-info" style="margin-bottom: 4px; ">
                                            <h2 class="CustomerHead" style=" width: 100%; text-align: center; padding: 13px 0; ">Bill Details</h2>
                                            </div>
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
                                                    <p class='discount-rate' style='color:red; font-weight: 700; '><span style='font-weight: 700;'>-</span><?php echo $_SESSION["currency_symbol"].number_format((($discountOrder)*$_SESSION["currency_rate"]),2) ?></p>
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
                    </div>
                    <div class="col-12 col-lg-5 mt-2 mt-lg-0">
                        <div class="card" style="padding: 17px 11px 34px 11px; display:block;padding-right: 11px !important;">
                            <div class="card-info">
                                <h2 class="CustomerHead">Customer</h2>
                                <!-- <a class="btn-market btn-apple hello-btn" data-bs-toggle="modal" data-bs-target="#TermsCondition" role="button">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                    <p class="btn-market-subtitle">Note to our valued</p>
                                    <p class="btn-market-title">CUSTOMER</p>
                                </a> -->
                            </div>
                            <hr>
                            <div class="customer-info mt-2">
                                <div class="" style="padding: 2px 22px;background: #20c5be;color: #fff;width: fit-content;border-radius: 32px;font-size: 43px;font-weight: 500;margin: 0 auto;">
                                S</div>
                                
                                <h2 class="customer-name"><?php echo $name; ?></h2>
                                <a href="" class="customer-email"><?php echo $email; ?></a>
                                <p class="phone"><?php echo $phone; ?></p>
                            </div>
                            <hr>
                            <div class="card-info" style=" margin-top: 19px;margin-bottom: 4px; ">
                                <h2 class="CustomerHead">Shipping Details</h2>
                            </div>
                            <p><?php echo $address; ?></p>
                            <p><?php echo $city; ?>, <?php echo $state; ?>, <?php echo $country; ?>,  <?php echo $pincode; ?></p>

                            <div class="card-info" style=" margin-top: 19px;margin-bottom: 4px; ">
                                <h2 class="CustomerHead" >Billing Details</h2>
                            </div>
                            <p><?php echo $address; ?></p>
                            <p><?php echo $city; ?>, <?php echo $state; ?>, <?php echo $country; ?>,  <?php echo $pincode; ?></p>
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