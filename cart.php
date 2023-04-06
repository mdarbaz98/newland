
<?php 
    $productSeoTitle = "Cart | Newlands Pharmacy";
    $productSeoDescription = "Cart | Newlands Pharmacy";
    include('include/header.php'); 
?>
<?php include('include/sidenav.php'); ?>
<main class="offcanvas-enabled cart-page-box">
    <section class="ps-lg-4 pe-lg-3">

        <!-- Omkar 21-09-2021 start-->
        
        
        <div class="container cartData">
            <div class="row">
                <div id="productlisting" class="col-lg-8 col-md-6 col-12">
                    <div class="cart-main-product">
        
                    </div>
                  

                    <!-- <div class="add-items">Add More Items</div> -->
                    <div id="productlisting" class="customer-help col-lg-12 col-md-12 col-12">
                        <p class="noted">Still not in budget? Click here</p>
                        <div class="action-button">

                            <a href="tel:+13155154364" class="call-now-cart">
                                <lord-icon src="https://assets4.lottiefiles.com/packages/lf20_u3ascu0i.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 51px;height: 39px;"></lord-icon> 
                                Call Now
                            </a>

                            <button class="chat-now-cart" data-userid="<?php echo $_COOKIE['userID'] ?>">
                                <div class="icon-lord">
                                <lord-icon src="https://lottie.host/793d2612-6a24-4138-b85c-64118121246d/aRKVZUqjKQ.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 258px !important;height: 258px;display: block;transform: scale(1.3);"></lord-icon> 
                                </div>
                                Chat With Us
                            </button>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="row fixed-content">
                        <div class="main-promo">
                            <div class="confirm-lot">
                                <iframe src="lottie/second.html"></iframe>
                            </div>
                            <div id="promo" class="col-lg-12">
                                
                            </div>
                        </div>
                        <div id="subtotal" class="col-lg-12">
                            <div class="card mb-3">
                                <div class="product-cart total-cart-details" style="padding:0 10px !important;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-12" style="width: -webkit-fill-available;">
                    <div id="productlisting" class="customer-help col-lg-12 col-md-12 col-12" style="width: 100%;display: block;height: auto;margin-top: 10px;">
                        
                        <h3 style="font-size: 16px;font-weight: 600;margin-bottom: 0;margin-left: 20px;">Explainer Notes</h3>
                        <div class="action-button">

                            <a data-bs-toggle="modal" data-bs-target="#cheapRate" class="call-now-cart" style="height: 49px;">
                                <img src="https://newlandpharmacy.co.uk/cat-image/icon/Cheap%20Rates.png" style="width: 25px;padding: 2px;margin: 0 9px;">
                                Cheap Rates
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#securedPayment" class="call-now-cart" style="height: 49px;">
                                <img src="https://newlandpharmacy.co.uk/cat-image/icon/Secured%20payment.png" style="width: 25px;padding: 2px;margin: 0 9px;">
                                Secured Payment
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#delLoc" class="call-now-cart" style="height: 49px;">
                                <img src="https://newlandpharmacy.co.uk/cat-image/icon/Secured%20payment.png" style="width: 25px;padding: 2px;margin: 0 9px;">
                                Delivery Locations
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="width: -webkit-fill-available;">
                    <div id="productlisting" class="customer-help col-lg-12 col-md-12 col-12" style="width: 100%;display: block;height: auto;margin-top: 10px;">
                        
                        <h3 style="font-size: 16px;font-weight: 600;margin-bottom: 0;margin-left: 20px;">Explainer Notes</h3>
                        <div class="action-button">

                            <a href="tel:+13155154364" class="call-now-cart" style="height: 49px;">
                                <img src="https://newlandpharmacy.co.uk/cat-image/icon/Cheap%20Rates.png" style="width: 25px;padding: 2px;margin: 0 9px;">
                                Cheap Rates
                            </a>
                            
                            <a href="tel:+13155154364" class="call-now-cart" style="height: 49px;">
                                <img src="https://newlandpharmacy.co.uk/cat-image/icon/Secured%20payment.png" style="width: 25px;padding: 2px;margin: 0 9px;">
                                Secured Payment
                            </a>
                            <a href="tel:+13155154364" class="call-now-cart" style="height: 49px;">
                                <img src="https://newlandpharmacy.co.uk/cat-image/icon/Secured%20payment.png" style="width: 25px;padding: 2px;margin: 0 9px;">
                                Secured Payment
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="col-12">
                    <section class="ps-lg-4 pe-lg-3 product-carousel-card bestseller-carousel" style=" background: #fff;border: 1px solid #eeebf2;border-radius: 0px;">
                        <!-- Heading-->
                        <div class="home-product-heading text-center">
                            <h2 class="category-home-page-heading text-center" style="">Wishlist</h2>
                        </div>
                        <div class="tns-carousel tns-controls-static tns-controls-outside tns-nav-disabled wishcartprod">
                          
                        </div>
                        
                    </section>
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
                            </div>
                        </div>
                    </section>
                    
                    
                    <section class="ps-lg-4 pe-lg-3 product-carousel-card bestseller-carousel" style=" background: #fff;">
                        <!-- Heading-->
                        <div class="home-product-heading">
                            <h2 class="category-home-page-heading text-center" style="">Wishlist</h2>
                        </div>
                        <div class="tns-carousel tns-controls-static tns-controls-outside tns-nav-disabled wishcartprod">
                          
                        </div>
                        
                    </section>
                    <section id="shopbycat" class="ps-lg-4 pe-lg-3 product-carousel-card" style="padding-top: 21px !important;">
    
                        <div class="container-fluid">
                              <div class="row">
                            <div class="col-12">
                                <h2 class="category-home-page-heading" style="font-size: 17px; width: 100%; padding-bottom: 16px; text-align: center; margin: 0; line-height: initial; position: relative; letter-spacing: 0; text-transform: uppercase; font-weight: 700;">
                                    Shop By Category
                                </h2>
                            </div>
                             
                            <div class="col-lg-1 col-3">
                                <a href="allergy-medications">  
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/AllergyMedications.jpg)"></div>
                              <p>Allergy</p>
                            </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="arthritis-medication">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/ArthritisMedication.jpg)"></div>
                              <p>Arthritis</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="anxiety-and-depression">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/anxiety.jpg)"></div>
                              <p>Anxiety</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="injectable-steroids">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/InjectableSteroids.jpg)"></div>
                              <p>Injectable</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="anxiety-and-depression">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/depression.jpg)"></div>
                              <p>Depression</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="sleeping-pills">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/SleepingPills.jpg)"></div>
                              <p>Sleeping</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="diabeties-medication">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/DiabetiesMedication.jpg)"></div>
                              <p>Diabeties</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="antibiotics">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/antibiotic.jpg)"></div>
                              <p>Antibiotics</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="womens-health-care">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/women-health.jpg)"></div>
                              <p>Women's Health</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="heart-medication">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/HeartMedication.jpg)"></div>
                              <p>Heart</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="pain-medication">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/PainMedication.jpg)"></div>
                              <p>Pain</p>
                              </a>
                            </div>
                            <div class="col-lg-1 col-3">
                                <a href="mens-health-care">
                              <div class="card-img-top" style="background-image: url(https://myglobal1.gumlet.io/images/small-cat/MenHealth-Care.jpg)"></div>
                              <p>Men's Health</p>
                              </a>
                            </div>
                            
                            
                            
                            
                          </div>
                        </div>
                    
                    </section>
                    <section class="ps-lg-4 pe-lg-3 product-carousel-card bestseller-carousel" style=" background: #fff;">
                        <!-- Heading-->
                        <div class="home-product-heading">
                            <h2 class="category-home-page-heading" style="">Bestseller</h2>
                            <a href="bestseller" class="view-more-btn">View All</a>
                        </div>
                        <div class="tns-carousel tns-controls-static tns-controls-outside tns-nav-disabled">
                          <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;loop&quot;: true, &quot;controls&quot;: true, &quot;autoHeight&quot;: false, &quot;margin&quot;: 15, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1}, &quot;480&quot;:{&quot;items&quot;:1}, &quot;720&quot;:{&quot;items&quot;:1}, &quot;991&quot;:{&quot;items&quot;:2}, &quot;1140&quot;:{&quot;items&quot;:3}, &quot;1300&quot;:{&quot;items&quot;:3}, &quot;1500&quot;:{&quot;items&quot;:3}}}">
                            <!-- Product-->
                            
                            <?php
                            $select_product=$conn->prepare("SELECT * FROM ogproduct where bestseller='Bestseller' AND productImage!='assets/images/products/' limit 6 ");
                            $select_product->execute();  
                            $row=$select_product->rowCount();
                            while($row=$select_product->fetch(PDO::FETCH_ASSOC))
                            {
                                $productName = $row['productName'];
                                $productCode = $row['productCode'];
                                $productCategory = $row['productCategory'];
                                $productlower = strtolower($productCategory);
                                $prductcategoryslug = str_replace(" ","-",$productlower);
                                $productDetails = $row['productDescription'];
                                $productImage = $row['productImage'];
                                if(strlen($productImage)>2 AND $productImage!='assets/images/products/'){
                                  $productImage = $row['productImage'];
                                }else {
                                  $productImage = 'defaultMed.png';
                                }
                                $productImageAlt = $row['productImageAlt'];
                                $productImageTitle = $row['productImageTitle'];
                                $productType = $row['productType'];
                                $productSlug = $row['productSlug'];
                                $select_product_price=$conn->prepare("SELECT price FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                                $select_product_price->execute();
                                while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                                {
                                    $price = $row['price']; 
                                }
                            ?>
                                <div class="">
                                        <a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                                        <div class="card product-card" style=" position: relative; ">
                                            <p class="besttag" style=" position: absolute; bottom: 0px; right: 0; z-index: 5; font-size: 10px; background: #42d697; padding: 0px 4px; color: #fff; ">Bestseller</p>
                                            <div class="card-img-top d-block overflow-hidden">
                                                <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>?w=208" alt="<?php echo $productImageAlt; ?>" title="<?php echo $productImageTitle; ?>">
                                            </div>
                                            <div class="card-body">
                                                <small><?php echo $productCategory; ?></small>
                                                <h3 class="product-title fs-sm"><?php echo $productName; ?></h3>
                                                <p class="product-description d-flex justify-content-between">
                                                  <?php
                                                    if(strpos($productCategory,'Steroids')>0){
                                                        echo '<span>12 to 18 Days Standard Delivery</sapn>';
                                                    }
                                                    elseif(strpos($productName,'USA to USA')>0) {
                                                        echo '<span>5 to 7 Days USA to USA Shipping</sapn>';
                                                    }
                                                    else {
                                                        echo '<span>12 to 18 Days Standard Delivery</sapn>';
                                                    }
                                                  ?>
                                                </p>
                                                <p class="product-price">
                                                  $<?php echo $price; ?>/<small><?php echo $productType; ?></small>*
                                                  <span class="dis"></span>
                                                </p>
                                             </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                
                          </div>
                        </div>
                        
                    </section>
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