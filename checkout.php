<?php 
$productSeoTitle = "Checkout | Newlands Pharmacy";
$productSeoDescription = "Checkout | Newlands Pharmacy";
include('include/header.php'); 
?>
<?php include('include/sidenav.php'); ?>
<main class="offcanvas-enabled" style="padding-top: 5rem;">
    <section class="ps-lg-4 pe-lg-3 pt-4">

        <!-- Omkar 28-09-2021 start-->
    <form action="action.php" id="checkoutForm" method="post">
        <input type="hidden" value="orderNow" name="btn">
        <div class="container cartData">
            <div id="main-card" class="card my-3" style="border: 0px !important; background-color: transparent !important; box-shadow: none !important;">
                <div class="card-style">
                    <div class="row">
                        
                        
                        <div class="col-lg-6 col-md-6 col-12 ">

                                    <div id="productlisting">
                                        
                                        <div class="product-cart">
                                            <div>
                                                <div class="checkout-main-cart">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        
                        <div id="checkoutlisting" class="col-lg-6 col-md-6 col-12 pt-2">
                            
                            <div class="customerAddress">
                            <!--<h1 class="text-center py-2 pb-4">Delivery Address</h1>-->
                            <?php
                                $checkAddress=$conn->prepare("SELECT * FROM ogaddress WHERE userid='".$_SESSION['USER_ID']."' limit 1");
                                $checkAddress->execute();
                                $isAddress = $checkAddress->rowCount();
                                $i=0;
                                if($isAddress>0){
                                    $show = "none";
                                    while($row=$checkAddress->fetch(PDO::FETCH_ASSOC)){
                                        ++$i;
                                        if($i==1){
                                            $status = "checked";
                                        }else {
                                            $status = "";
                                        }
                                        $addressId = $row['id'];
                                        $name = $row['fname'].' '.$row['lname'];
                                        $address = $row['addressline1'].' '.['addressline2'];
                                        $city = $row['city'];
                                        $state = $row['state'];
                                        $country = $row['country'];
                                        $postalcode  =$row['postalcode'];
                                        $phone = $row['phone'];
                                    
                            ?>
                                <label for="address<?php echo $addressId; ?>" class="address">
                                    <div class="row addressCheck">
                                        <div class="col-lg-8 col-12">
                                            <h1 class="mt-0">Delivered To: <?php echo $postalcode.", ".$city ?></h1>
                                            <p><?php echo $row['addressline1']." ".$row['addressline2']; ?></p>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <a class="btn btn-primary btn-sm d-lg-inline-block changeAddress" href="#checkoutAddressList" onclick="editUserAddress('.$id.')" data-bs-toggle="modal"><i class="fa-solid fa-right-from-bracket me-2"></i>Change Address</a>
                                        </div>
                                    </div>
                                </label>
                            <?php } ?>
                                <!--<p style="color: #1c1c1e;border: 1px solid #1e1e20;width: fit-content;margin: 10px 0px;cursor: pointer;padding: 3px 10px;border-radius: 1px;" class='showAddressFil'>+Add New Address</p>-->
                                <input type="submit" class="btn btn-proceed btn-success" value="Place Your Order" style="background: #42d697;margin-bottom: 14px;">
                            <?php }else {
                                $show = "block";
                            ?>
                                <label for="address" class="address">
                                    <div class="row addressCheck">
                                        <div class="col-8">
                                            <h1 class="mt-0">Delivered To: 400072</h1>
                                            <p>Chandivali Farm Road, 21-F-704 Shivdham Hou Soc Sangharsh Nagar, Mumbai (Bombay), Mumbai</p>
                                        </div>
                                        <div class="col-3">
                                            <a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="#addUserAddress" onclick="editUserAddress('.$id.')" data-bs-toggle="modal"><i class="fa-solid fa-right-from-bracket me-2"></i>Add Shipping Details</a>
                                        </div>
                                    </div>
                                </label>
                            <?php
                                }
                            ?>
                            </div>
                            <div id="payment-subtotal" class="">
                                                <div class="product-heading">Payment Details</div>
                                                <hr>
                                                <div class="row py-3">
                                                  <div class="product-cart-padding">
                                                      <div class="total-amout-to-pay">
                                                          
                                                      </div>
                                                      
                                                  </div>
                                                </div>

                                            </div>
                            
                            <!--<div class="product-cart">-->
                            <!--    <div class="product-heading billing">Billing Details</div>-->
                            <!--    <div class="product-heading shipping">Shipping Details</div>-->
                            <!--</div>-->
                            <!--<hr>-->
                            <?php
                                $checkUser=$conn->prepare("SELECT * FROM ogcustomer WHERE userid='".$_COOKIE["userID"]."'");
                                $checkUser->execute();
                                while($row=$checkUser->fetch(PDO::FETCH_ASSOC)){
                                    $email = $row['email'];
                                }
                                if(strlen($email)==0){
                            ?>
                            <?php 
                                } 
                            ?>
                            <div class="form-padding">
                                <div class="row">
                                    <div class="col-lg-12" id="subtotal">
                                        <input type="submit" class="btn btn-proceed btn-success" value="proceed to pay" style="background: #42d697;margin-bottom: 14px;">
                                    </div>
                                </div>
                            </div>
                            <div class="addressFill d-none" style="display:<?php echo $show;?>">
                                
                                <!--<p style="color:blue;" class='pb-2 showSaveAddress'>< Back</p>-->
                                <div class="step1">
                                    <h1 class="text-center py-2" style=" font-size: 16px; font-weight: 700; ">Billing Details</h1>
                                    <div class="form-padding">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="">First Name*</label>
                                                    <input type="text" name="first-name" id="fnames" class="form-control">
                                                    <small class="fname-error error">Name Required</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="">Last Name*</label>
                                                    <input type="text" name="last-name" id="lnames" class="form-control">
                                                    <small class="lname-error error"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-padding">
                                        <div>
                                            <label for="">Email*</label>
                                            <input type="email" name="email" id="emails" class="form-control">
                                            <small class="email-error error"></small>
                                        </div>
                                    </div>
                                    <div class="form-group form-padding phone-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control tel" type="tel" id="phones" name="phone" inputmode="tel" value=""/>
                                        <small class="phone-error error"></small>
                                    </div>
                                    <div style="text-align: center;padding-top: 14px;">
                                        <button type="button" class="btn btn-proceed ship-details bnt-block" style="background-color: #20c5be;color:#fff;padding: 6px 57px;width: fit-content;margin: 0 auto;border-radius: 0px;">
                                            Shipping Info
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="step2">
                                    
                                    <div class="form-padding pt-3">
                                        <div>
                                            <label for="">Address Line 1*</label>
                                            <input type="text" name="addressLine1" id="address" class="form-control address">
                                            <small class="address-error error"></small>
                                        </div>
                                    </div>
                                    <div class="form-padding">
                                        <div>
                                            <label for="">Address Line 2</label>
                                            <input type="text" name="addressLine2" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-padding">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="">Country*</label>
                                                    <?php
                                                        $select_country=$conn->prepare("SELECT * FROM countries  ORDER BY country_name ASC");
                                                        $select_country->execute();
                                                        $count = $select_country->rowCount();
                                                    ?>
                                                    <select class="form-select form-control" name="country" id="country">
                                                        <?php
                                                            if($count > 0){
                                                                while($row=$select_country->fetch(PDO::FETCH_ASSOC)){
                                                    				$country_id=$row['country_id'];
                                                    				$country_name=$row['country_name'];
                                                                    echo "<option data-cid='$country_id' value='$country_id'>$country_name</option>";
                                                                }
                                                            }else{
                                                                echo '<option value="">Country not available</option>';
                                                            }
                                                            ?>
                                                    </select>
                                                    <small class="country-error error"></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="">State*</label>
                                                    <select class="form-select form-control" name="state" id="state">
                                                      <option>Select State</option>
                                                    </select>
                                                    <small class="state-error error"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-padding">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="">City*</label>
                                                    <select class="form-select form-control" name="city" id="city">
                                                        <option>Select City</option>
                                                    </select>
                                                    <small class="city-error error"></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="">Postal Code*</label>
                                                    <input type="text" name="postalCode" id="code" class="form-control">
                                                    <small class="code-error error"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <?php  ?>
                        </div>
                        
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <div class="container emptyCartData">
            <div class="row">
                <div class="col-12">
                    <section id="shopbycat" class="ps-lg-4 pe-lg-3 product-carousel-card" style="padding-top: 21px !important;">
    
                        <div class="container-fluid">
                            <div class="row text-center cartEBox">
                                <div class="cartBox">
                                    <lord-icon src="https://assets5.lottiefiles.com/temp/lf20_Celp8h.json" trigger="loop" colors="primary:#121331,secondary:#08a88a"></lord-icon>
                                </div>
                                <h2>Cart Is  Empty</h2>
                                <a href="bestseller">Continue Shopping</a>
                            </div>
                        </div>
                    </section>
                    
            </div>
        </div>
        <!-- Omkar 28-09-2021 end-->
    </section>
    </main>
<?php include('include/footer.php'); ?>