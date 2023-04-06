<?php 
   // $productSeoTitle = "About Us";
   // $productSeoDescription = "About Us";
    include( 'include/header.php'); 
?>
<?php 
    include( 'include/sidenav.php'); 
    include('functions.php');

    // $product_slug =   $_GET['product_slug'];
    // $productInfo = getProductInfo($conn,$product_slug);

    $product_slug =   $_GET['product_slug'];
    $productInfo = getProductInfo($conn,$product_slug);
    $count = $productInfo['active'];
    $Productcode = $productInfo['code'];
    if($count>0){

?>
<div class="modal fade" id="deliveryIns" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Newlands Pharmacy is accurate with the delivery of your order. The <b>Arrival Date</b> 
            is exact date of delivery and <b>Expected Date</b> of delivery is buffer time taken to 
            deliver your order. We have a proven track record of delivering on exact arrival 
            date. Happy to Deliver!!
        </p>
        <div class="close-del-mod"  type="button" data-bs-dismiss="modal" aria-label="Close"> <i class="fa-solid fa-circle-xmark"></i> Close</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="defaultQuantityModal" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <h2 class='text-center confirm-text'><span class="mx-3"><img src="image/productPageImg/Icon.png" alt="" width="25" class="me-3"> Please check the default selection below</span></h2>
            <div class="default-product-info">
                <div class="pills-info">
                    <h3 class="count-box-title">Selected Number of pills</h3>
                    <div class="count-box">
                        600
                    </div>
                </div>
                <div class="strength-info">
                    <h3 class="count-box-title">Selected Strength</h3>
                    <div class="count-box">
                        30mg
                    </div>
                </div>
            </div>
            <div class="debox">
                <div class="cancel-box">
                    <h3 class="cancel-title" type="button" data-bs-dismiss="modal" aria-label="Close">Go back</h3>
                </div>
                <div class="success-box">
                <h3 class="success-title">Confirm</h3>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>


<main class="offcanvas-enabled product-page-main-container">
    <input type="hidden" name="productCode" id="productCode" value="<?php echo $productInfo['code']; ?>">
    <div class="single-product-section">
        <div class="bread-crumb">
            <div class="home-link">
                <a href=""><img src="image/home-bread.png" srcset=""></a>
            </div>
            <div class="category-link">
                <img src="image/category-bread.png" alt="" srcset="">
                <p style="width:85px;" class="text-placeholder placeholder"></p>
            </div>
            <div class="product-link">
                <img src="image/medicine-bread.png" alt="" srcset="">
                <p style="width:85px;" class="text-placeholder placeholder">
                    
                </p>
            </div>
        </div>

        <div class="container-fluid m-0 p-0 main-product-data">
            <div class="row m-0">
                <div class="col-lg-4 col-12 p-0 product-data-left order-md-2 order-lg-1">
                    <div class="product-strength">
                        <div class="title"><img src="image/strength.png">Select Strength</div>
                        <!-- Nav tabs -->
                        
                        <ul class="nav nav-tabs strength-slider-wrap" role="tablist">
                            <li class="nav-item strength-slider-inner scroll" id="strength-slider-inner">
                                <a href="#home1" draggable="false" class="nav-link active" data-bs-toggle="tab" role="tab">
                                    <span>30mg</span>
                                </a>
                                <a data-target="#profile1" draggable="false" class="nav-link" data-bs-toggle="tab" role="tab">
                                    <span>100mg</span>
                                </a>
                                <a href="#profile1 " draggable="false" class="nav-link" data-bs-toggle="tab" role="tab">
                                    <span>300mg</span>
                                </a>
                                <a href="#profile1" class="nav-link" draggable="false" data-bs-toggle="tab" role="tab">
                                    <span>350mg</span>
                                </a>
                                <a href="#profile1" class="nav-link" draggable="false" data-bs-toggle="tab" role="tab">
                                    <span>450mg</span>
                                </a>
                                <a href="#profile1" class="nav-link" draggable="false" data-bs-toggle="tab" role="tab">
                                    <span>500mg</span>
                                </a>
                                <a href="#profile1" class="nav-link"  draggable="false" data-bs-toggle="tab" role="tab">
                                    <span>600mg</span>
                                </a>
                            </li>
                        </ul>
                        
                        <div class="product-desc-label">
                             
                        </div>
                        
                        <div class="title title-mob pills-label"><img src="image/quantity.png"> Select Quantity Of Pills</div>
                    </div>
                    <div class="custom-pills">
                        <div class="title pills-label"><img src="image/quantity.png"> Select Quantity Of Pills</div>
                        <button class="custome-pill-button"><img src="image/customize.png">Create Your Own</button>
                        <div class="custome-input-ins">
                            <div class="input-section">
                                <div class="quantity-input">
                                    <input type="tel" placeholder='0' name="productQuantityCustome" id="productQuantityCustome">
                                </div>
                                <div class="quantity-price">
                                    $0.89
                                </div>
                            </div>
                            <div class="custome-instruction">
                                Note: Multiple of 10 or 100 only
                            </div>
                            <div class="button-custome">
                                <button class="add-cart-button" data-dis="0">
                                    <span class="button__text">Calculate</span>
                            </button>
                            </div>
                        </div>
                        <!-- <div class="social_share_wrap">
                                <div class="ss_wrap ss_wrap_1">
                                    <div class="ss_btn">
                                        <span class="">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </span>
                                    </div>

                                    <div class="dd_list">
                                        <ul>
                                            <li>
                                                <a href="https://wa.me/?text=Limited-deal: <?php echo $productName; ?> <?php echo $actual_link  ?>">
                                                    <span class="icon">
                                                        <img src="social/whatsapp.png"  alt="">
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="mailto:?body=Limited-deal:" class="twitter">
                                                    <span class="icon">
                                                        <img src="social/email.png" alt="">
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="sms-desk">
                                                <a href="sms:?body=Limited-deal:" class="instagram ">
                                                    <span class="icon">
                                                    <img src="social/message.png" alt="">
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="window.print()" class="reddit">
                                                    <span class="icon">
                                                    <img src="social/print.png" alt="">
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="shareURL('<?php echo $productName; ?>','<?php echo $actual_link  ?>')" class="reddit">
                                                    <span class="icon">
                                                    <img src="social/copy.png" alt="">
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                        </div> -->
                    </div>
                    <div class="sale-ends-note-mob">
                        <!-- Sale End on <b class="time" id="countdown">02:51 Hrs</b> -->
                        <!-- Sale End on <b class="time">31st December 2022</b> -->

                    </div>
                    <div class="shipping-note">
                        <div class="icon"><img src="image/shipping.png" alt="" srcset=""></div>
                        <div class="note">Free Shipping on order above $199</div>
                    </div>
                    <div class="tab-content product-quantity">
                        <div class="tab-pane quantity-list fade show active placeholder" id="home1" role="tabpanel">
                            <!-- <div class="quantity-item">
                                <div class="quantity-pricing active">
                                    <div class="quantity-pill">
                                        600
                                    </div>
                                    <div class="price">
                                        $0.31
                                    </div>
                                </div>
                                <div class="quantity-pricing-calculation">
                                    <div class="quantity-pricing-calculation-data">
                                        Total
                                        <div class="quantity-total">
                                            $234.1
                                        </div>
                                    </div>
                                    <div class="quantity-offer">
                                            15% Off
                                    </div>
                                </div>
                            </div>
                            <div class="quantity-item">
                                <div class="quantity-pricing">
                                    <div class="quantity-pill">
                                        600
                                    </div>
                                    <div class="price">
                                        $0.31
                                    </div>
                                </div>
                                <div class="quantity-pricing-calculation">
                                    <div class="quantity-pricing-calculation-data">
                                        Total
                                        <div class="quantity-total">
                                            $234.1
                                        </div>
                                    </div>
                                    <div class="quantity-offer">
                                            15% Off
                                    </div>
                                </div>
                            </div>
                            <div class="quantity-item">
                                <div class="quantity-pricing">
                                    <div class="quantity-pill">
                                        600
                                    </div>
                                    <div class="price">
                                        $0.31
                                    </div>
                                </div>
                                <div class="quantity-pricing-calculation">
                                    <div class="quantity-pricing-calculation-data">
                                        Total
                                        <div class="quantity-total">
                                            $234.1
                                        </div>
                                    </div>
                                    <div class="quantity-offer">
                                            15% Off
                                    </div>
                                </div>
                            </div>
                            <div class="quantity-item">
                                <div class="quantity-pricing">
                                    <div class="quantity-pill">
                                        600
                                    </div>
                                    <div class="price">
                                        $0.31
                                    </div>
                                </div>
                                <div class="quantity-pricing-calculation">
                                    <div class="quantity-pricing-calculation-data">
                                        Total
                                        <div class="quantity-total">
                                            $234.1
                                        </div>
                                    </div>
                                    <div class="quantity-offer">
                                            15% Off
                                    </div>
                                </div>
                            </div>
                            <div class="quantity-item">
                                <div class="quantity-pricing">
                                    <div class="quantity-pill">
                                        600
                                    </div>
                                    <div class="price">
                                        $0.31
                                    </div>
                                </div>
                                <div class="quantity-pricing-calculation">
                                    <div class="quantity-pricing-calculation-data">
                                        Total
                                        <div class="quantity-total">
                                            $234.1
                                        </div>
                                    </div>
                                    <div class="quantity-offer">
                                            15% Off
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="tab-pane fade" id="profile1" role="tabpanel">
                                <p class="fs-sm">40MG</p>
                        </div>
                        <div class="tab-pane fade" id="messages1" role="tabpanel">
                                <p class="fs-sm">message</p>
                        </div>
                        <div class="tab-pane fade" id="settings1" role="tabpanel">
                                <p class="fs-sm">set</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 p-0 product-meta-section order-md-2 order-lg-2">

                    <div class="shipping-toggle">
                        <input type="checkbox" id="checkbox" class="checkbox" />
                        <label for="checkbox" class="switch_bg">
                            <div class="switch_button"></div>
                        </label>
                        <div class="ship-name first">Global Shipping</div>
                        <div class="ship-name second">USA Premium Shipping</div>
                    </div>
                    
                    <div class="product-meta-info">
                        <div class="product-name">
                            <h2><span class="name"><div style="width:120px" class="text-placeholder placeholder"></div></span>
                            <!-- -<span class="str">30</span> -->
                        </h2>
                            <p class="ingredient"></p>
                        </div>
                        <div class="product-price">
                            <span class="price"><span style="width: 85px !important;height: 28px;display: inline-block;" class="text-placeholder placeholder"></span></span>
                            <span class="divide">/</span>
                            <span class="product-type"><span style="width: 85px !important;height: 28px;display: inline-block;" class="text-placeholder placeholder"></span></span>
                        </div>
                    </div>
                    <div class="product-calculation">
                        <img src="image/cris-offer-tag.png" class="cris-offer-tag">
                        <div class="round-shape-right">
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                        </div>
                        <div class="round-shape-left">
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                        </div>
                        <div class="logo dashed-line">
                            <img src="https://myglobal1.gumlet.io/images/newland-logo-sub1.PNG?w=128">
                        </div>
                        <div class="offer-applied dashed-line">
                            <span class="flat me-2">Flat</span>
                            <span class="discount">15% OFF</span>
                            <p class="dis-text">
                                Applied <span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>
                            </p>
                        </div>
                        <div class="calculation dashed-line">
                            <div class="list">
                                <span class="title">Quantity</span>
                                <span class="value ogPill"><div style="width:85px" class="text-placeholder placeholder"></div></span>
                            </div>
                            <div class="list">
                                <span class="title">Actual Price</span>
                                <span class="value ogprice"><div style="width:85px" class="text-placeholder placeholder"></div></span>
                            </div>
                            <div class="list">
                                <span class="title">Shipping Charges</span>
                                <span class="value shippingCharges"><div style="width:65px" class="text-placeholder placeholder"></div></span>
                            </div>
                            <div class="list">
                                <span class="title">Total Saving</span>
                                <span class="value save-value"><div style="width:55px" class="text-placeholder placeholder"></div></span>
                            </div>
                            <div class="list">
                                <span class="title">Total Price</span>
                                <span class="value totalprice"><div style="width:95px" class="text-placeholder placeholder"></div></span>
                            </div>
                        </div>
                        <div class="action-button">
                            <div style="width:159px" class="button-placeholder placeholder"></div>
                            <div style="width:159px" class="button-placeholder placeholder"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 p-0 position-relative product-image order-md-1 order-lg-3">
                <div class="social_share_wrap">
                        <div class="ss_wrap ss_wrap_1">
                            <div class="ss_btn">
                            <span class="">
                                <i class="fa-solid fa-share-nodes"></i>
                            </span>
                            </div>

                            <div class="dd_list">
                                <ul>
                                    <li>
                                        <a href="https://wa.me/?text=Limited-deal: <?php echo $productName; ?> <?php echo $actual_link  ?>">
                                            <span class="icon">
                                                <img src="social/whatsapp.png"  alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:?body=Limited-deal:" class="twitter">
                                            <span class="icon">
                                                <img src="social/email.png" alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li class="sms-desk">
                                        <a href="sms:?body=Limited-deal:" class="instagram ">
                                            <span class="icon">
                                            <img src="social/message.png" alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="window.print()" class="reddit">
                                            <span class="icon">
                                            <img src="social/print.png" alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="shareURL('<?php echo $productName; ?>','<?php echo $actual_link  ?>')" class="reddit">
                                            <span class="icon">
                                            <img src="social/copy.png" alt="">
                                            </span>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="image-slider-box">
                        <img src="https://myglobal1.gumlet.io/images/Ribbon.png" class="tag-stick">
                        <img src="https://myglobal1.gumlet.io/images/Ring.png" class="tag-stick1">

                        <!-- <img src="image/chris-cap.png" class="chris-cap"> -->
                        <h2 class="cat-stick">Anxiety & Depression</h2>
                        <div class="owl-carousel custome_slide" id="product-image-slider">
                               <div class="image-placeholder placeholder"></div>
                        </div>
                        <div class="customNavigation prev_next">
                            <a class="prev">
                                <i class="fa-solid fa-share"></i>
                            </a>
                            <a class="next">
                                <i class="fa-solid fa-share"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-meta-info">
                        <div class="product-name">
                            <h2 class="name"><div style="width:85px" class="text-placeholder placeholder"></div></h2>
                            <p class="ingredient"></p>
                        </div>
                        <div class="product-price">
                            <span class="price"><span style="width: 85px !important;height: 28px;display: inline-block;" class="text-placeholder placeholder"></span></span>
                            <span class="divide">/</span>
                            <span class="product-type">Pill</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid m-0 p-0">
            <div class="row m-0 main-box-ship product-shipping-data">
                <div class="col-lg-4 col-12 sale-share">
                    <!-- <div class="social_share_wrap">
                        <div class="ss_wrap ss_wrap_1">
                            <div class="ss_btn">
                            <span class="">
                                <i class="fa-solid fa-share-nodes"></i>
                            </span>
                            </div>

                            <div class="dd_list">
                                <ul>
                                    <li>
                                        <a href="https://wa.me/?text=Limited-deal: <?php echo $productName; ?> <?php echo $actual_link  ?>">
                                            <span class="icon">
                                                <img src="social/whatsapp.png"  alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:?body=Limited-deal:" class="twitter">
                                            <span class="icon">
                                                <img src="social/email.png" alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li class="sms-desk">
                                        <a href="sms:?body=Limited-deal:" class="instagram ">
                                            <span class="icon">
                                            <img src="social/message.png" alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="window.print()" class="reddit">
                                            <span class="icon">
                                            <img src="social/print.png" alt="">
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="shareURL('<?php echo $productName; ?>','<?php echo $actual_link  ?>')" class="reddit">
                                            <span class="icon">
                                            <img src="social/copy.png" alt="">
                                            </span>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div> -->
                    <div class="sale-ends-note">
                        <!-- Sale End in <b class="time" id="progressBar">02:51 Hrs</b> -->
                        <!-- Sale End on <b class="time">31st December 2022</b> -->
                    </div>
                </div>
                <div class="col-lg-5 col-12 shipping-info">
                    
                    <div class="expected-dates">
                        <div class="round-right"></div>
                        <div class="round-left"></div>
                        <div class="border-insert"></div>
                        <div class="list" style=" border-bottom: 1px dashed #cfcfcf;">
                            <div class="image"><img src="image/arrive.png"></div>
                            <div class="text-details">Arriving On</div>
                            <div class="date date-a">05-15-2023 WED</div>
                        </div>
                        <div class="list">
                            <div class="image"><img src="image/Flight.png"></div>
                            <div class="text-details">Expected On</div>
                            <div class="date date-e">05-17-2023 FRI</div>
                        </div>
                    </div>
                    <div class="delivery-instruction mob" type="button" data-bs-toggle="modal" data-bs-target="#deliveryIns">What’s the difference?</div>
                </div>
                <div class="col-lg-3 col-12 ship-section-product">
                    <div class="shipping-note">
                        <div class="icon"><img src="image/shipping.png" alt="" srcset=""></div>
                        <div class="note">Free Shipping on order above <span>$199</span></div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="product-info">
                        <div class="image-title">
                            <img src="image/product-board.png" alt="">
                            <h2>Product Details</h2>
                        </div>
                        <div class="info-list">
                            <div class="list brand">
                                <div class="left-bar"></div>
                                <div class="first-round"></div>
                                <div class="second-round"></div>
                                <div class="logo">
                                    <img src="image/brand.png">
                                </div>
                                <div class="info">
                                    <p class="name">Brand Names</p>
                                    <p class="value">Manufacture_Name1, Manufacture_Name</p>
                                </div>
                            </div>
                            <div class="list manufacture">
                                <div class="left-bar"></div>
                                <div class="first-round"></div>
                                <div class="second-round"></div>
                                <div class="logo">
                                    <img src="image/manufacture.png">
                                </div>
                                <div class="info">
                                    <p class="name">Manufactured From</p>
                                    <p class="value"><span></span></p>
                                </div>
                            </div>
                            <div class="list package">
                                <div class="left-bar"></div>
                                <div class="first-round"></div>
                                <div class="second-round"></div>
                                <div class="logo">
                                    <img src="image/manufacture.png" style=" width: 102px; ">
                                </div>
                                <div class="info" style=" margin-left: 3px; ">
                                    <p class="name">Packaging Details</p>
                                    <p class="value">Your order will be packaged in factory-sealed blister packs and sealed in bubble wrap envelopes to keep it safe and discreet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <img src="image/cris-tree.png" class="product-image-tree"> -->

                </div>
                <div class="col-lg-8 col-12 product-use">
                    <div class="use-division">
                        <div class="expected-dates">
                            <div class="round-right"></div>
                            <div class="round-left"></div>
                            <div class="border-insert"></div>
                            <div class="list" style="border-bottom: 1px dashed #cfcfcf;">
                                <div class="image"><img src="image/arrive.png"></div>
                                <div class="text-details">Arriving On</div>
                                <div class="date date-a">05-15-2023 WED</div>
                            </div>
                            <div class="list">
                                <div class="image"><img src="image/Flight.png"></div>
                                <div class="text-details">Expected On</div>
                                <div class="date date-e">05-17-2023 FRI</div>
                            </div>
                        </div>
                        <div class="cris-image">
                            <!-- <img src="image/santa.png"> -->
                        </div>
                    </div>
                    <div class="delivery-instruction desk" type="button" data-bs-toggle="modal" data-bs-target="#deliveryIns">What’s the difference?</div>
                    <!-- Basic accordion -->
                    <div class="accordion" id="accordionExample">

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#description" aria-expanded="true" aria-controls="collapseOne"><img src="image/description.png"> Product description</button>
                            </h2>
                            <div class="accordion-collapse collapse show" id="description" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#use" aria-expanded="false" aria-controls="collapseTwo"><img src="image/use.png"> How To Use</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="use" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#abuse" aria-expanded="false" aria-controls="collapseTwo"><img src="image/drug-abuse.png"> Drug Abuse</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="abuse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#symptoms" aria-expanded="false" aria-controls="collapseTwo"><img src="image/symptoms.png"> withdrawal Symptoms</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="symptoms" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sideeffects" aria-expanded="false" aria-controls="collapseTwo"><img src="image/sideeffects.png"> Side Effects</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="sideeffects" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#warningprecautions" aria-expanded="false" aria-controls="collapseTwo"><img src="image/warning.png"> Warning and Precautions</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="warningprecautions" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#storage" aria-expanded="false" aria-controls="collapseTwo"><img src="image/storage.png"> Storage</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="storage" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#druginteractions" aria-expanded="false" aria-controls="collapseTwo"><img src="image/drug.png"> Drug Interactions</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="druginteractions" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">Tadalafil is used to treat male sexual function problems (impotence or erectile dysfunction-ED). In combination with sexual stimulation, tadalafil works by increasing blood flow to the penis to help a man get and keep an erection. Tadalafil is also used to treat the symptoms of an enlarged prostate (benign prostatic hyperplasia-BPH). It helps to relieve symptoms of BPH such as difficulty in beginning the flow of urine, a weak stream, and the need to urinate frequently or urgently</div>
                            </div>
                        </div>

                    </div>                    
                    
                </div>
            </div>
        </div>
        <div class="container-fluid suggest-product-container m-0 p-0">
            <h2 class="suggest-head">Suggested Medicines</h2>
            <div class="row suggested-product">
                
            </div>
            <div class="customNavigation prev_next">
                <a class="prev">
                    <i class="fa-solid fa-share"></i>
                </a>
                <a class="next">
                    <i class="fa-solid fa-share"></i>
                </a>
            </div>
        </div>
        <div class="container-fluid one-touch-info-panel">
            <h1 class="text-center">One Touch Info</h1>
            <div class="row">
                <div class="col-12 one-touch-info">
                    <a href="?data=2&info=no-prescription-needed" class="info-item-list">
                        <div class="left-element">
                            <img src="cat-image/icon/prescription-related-faqs.png"alt=""/>
                            <p>No prescription needed</p>
                        </div>
                        <i class="fa-solid fa-right-long" style="color:#8389FE !important;"></i>
                    </a>
                    <a href="?data=2&info=about-medicines-manufacturers" class="info-item-list">
                        <div class="left-element">
                            <img src="cat-image/icon/medicines-&-manufacturers-related-faqs.png"alt=""/>
                            <p>About medicines & manufacturers</p>
                        </div>
                        <i class="fa-solid fa-right-long" style="color:#FFBC3C !important;"></i>
                    </a>
                    <a href="?data=2&info=discreet-shipping" class="info-item-list">
                        <div class="left-element">
                            <img src="cat-image/icon/Discreet shipping.png"alt=""/>
                            <p>Discreet Shipping</p>
                        </div>
                        <i class="fa-solid fa-right-long" style="color:#3F75D8 !important;"></i>
                    </a>
                </div>
            </div>
        </div>
        <section class="product-faq-section pt-md-3 pb-0 px-md-5 px-3">
            <h2 class="text-center mt-4 mt-md-0 mb-md-3" <?php echo $Productcode ?>>Product FAQs</h2>
            <div class="accordion" id="accordionExample">
            <?php
                 $i=1;
                $selectFaq = $conn->prepare('SELECT * from ogProductQna WHERE productCode=?');
                $selectFaq->execute([$Productcode]);
                while($row=$selectFaq->fetch(PDO::FETCH_ASSOC)){  
                      if($i==1){
                        $active_class= "show";
                        $btn_icon = "";
                      }else{
                        $active_class= "";
                        $btn_icon = "collapsed";
                      }  
                 ?>   

                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $i; ?>">
                    <button class="accordion-button <?php echo $btn_icon ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                    <?php echo $row['question']; ?>
                    </button>
                    </h2>
                    <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $active_class ?>" aria-labelledby="heading<?php echo $i; ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <?php echo $row['answer']; ?>
                     </div>
                    </div>
                </div>

                <?php $i++; } ?>



            </div>
        </section>
        <h2 class="text-center mt-4 mt-md-0 mb-md-3">General FAQs</h2>
        <div class="container-fluid product-pag-faq home-faq1 faq-desk">
            <div class="accordion accordion-flush" id="accordionFlushExample">

                <?php
                $i=0;
                            $selectCat = $conn->prepare('SELECT * from faqscategories WHERE primacy=0 AND id IN (28,44,57,59)');
                            $selectCat->execute();
                            while($row=$selectCat->fetch(PDO::FETCH_ASSOC)){
                    ++$i;
                                $name = $row['name'];
                                $id = $row['id'];
                                $image = $row['image'];
                            $slug = $row['slug'];
                    if($i==1){
                    $bsta = '';
                    $bodysta = 'show';
                    }else {
                    $bsta = 'collapsed';
                    $bodysta = '';
                    }
                    $selectSubCat1 = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                    $selectSubCat1->execute();
                    $countSub = $selectSubCat1->rowCount();
                    if($countSub>0){
                        ?>        
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
                    <button class="accordion-button <?php echo $bsta;?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i ?>" aria-expanded="true" aria-controls="flush-collapse<?php echo $i ?>">
                    <img src="cat-image/faq-tab-desk.png" style="width:100%;">
                    <img src="https://myglobal1.gumlet.io/cat-image/icon/<?php echo $image; ?>?w=36" class="faq-icon">
                    <h3 class="accord-title"><?php echo $name; ?></h3>
                    </button>
                </h2>
                <div class="accordion-collapse collapse <?php echo $bodysta;?>" id="flush-collapse<?php echo $i ?>" aria-labelledby="flush-heading<?php echo $i ?>" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    <?php
                    $selectSubCat = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                    $selectSubCat->execute();
                    while($rowSub=$selectSubCat->fetch(PDO::FETCH_ASSOC)){
                        $names = $rowSub['name'];
                        $ids = $rowSub['id'];
                        $slugs = $rowSub['slug'];
                    ?>
                    <a class="accord-link" href="faq/<?php echo $slug.'/'.$slugs; ?>">
                    <img src="cat-image/faq-tab-desk.png" style="width:100%;">
                    <h3 class="accord-title"><?php echo $names; ?></h3>
                    <i class="fa-solid fa-arrow-right sub-arrow"></i>
                    </a>
                    <?php
                    }
                    ?>
                    </div>
                </div>
                </div>
                <?php
                }else {
                ?>
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
                    <a class="accordion-button <?php echo $bsta;?>" href="faq/<?php echo $slug; ?>">
                    <img src="cat-image/faq-tab-desk.png" style="width:100%;">
                    <img src="https://myglobal1.gumlet.io/cat-image/icon/<?php echo $image; ?>?w=36" class="faq-icon">
                    <h3 class="accord-title"><?php echo $name; ?></h3>
                    </a>
                </h2>
                </div>
                <?php }
                }
                ?>

            </div>
            </div>
            <div class="container-fluid product-pag-faq home-faq1 faq-mob">
            <div class="accordion accordion-flush" id="accordionFlushExample">

                <?php
                $i=0;
                            $selectCat = $conn->prepare('SELECT * from faqscategories WHERE primacy=0  AND id IN (28,44,57,59)');
                            $selectCat->execute();
                            while($row=$selectCat->fetch(PDO::FETCH_ASSOC)){
                    ++$i;
                                $name = $row['name'];
                                $id = $row['id'];
                                $image = $row['image'];
                            $slug = $row['slug'];
                    if($i==1){
                    $bsta = '';
                    $bodysta = 'show';
                    }else {
                    $bsta = 'collapsed';
                    $bodysta = '';
                    }
                    $selectSubCat1 = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                    $selectSubCat1->execute();
                    $countSub = $selectSubCat1->rowCount();
                    if($countSub>0){
                        ?>        
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
                    <button class="accordion-button <?php echo $bsta;?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i ?>" aria-expanded="true" aria-controls="flush-collapse<?php echo $i ?>">
                    <img src="cat-image/faq-tag.png" style="width:100%;">
                    <img src="https://myglobal1.gumlet.io/cat-image/icon/<?php echo $image; ?>?w=36" class="faq-icon">
                    <h3 class="accord-title"><?php echo $name; ?></h3>
                    </button>
                </h2>
                <div class="accordion-collapse collapse <?php echo $bodysta;?>" id="flush-collapse<?php echo $i ?>" aria-labelledby="flush-heading<?php echo $i ?>" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                    <?php
                    $selectSubCat = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                    $selectSubCat->execute();
                    while($rowSub=$selectSubCat->fetch(PDO::FETCH_ASSOC)){
                        $names = $rowSub['name'];
                        $ids = $rowSub['id'];
                        $slugs = $rowSub['slug'];
                    ?>
                    <a class="accord-link" href="faq/<?php echo $slug.'/'.$slugs; ?>">
                    <img src="cat-image/faq-tag.png" style="width:100%;">
                    <h3 class="accord-title"><?php echo $names; ?></h3>
                    <i class="fa-solid fa-arrow-right sub-arrow"></i>
                    </a>
                    <?php
                    }
                    ?>
                    </div>
                </div>
                </div>
                <?php
                }else {
                ?>
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
                    <a class="accordion-button <?php echo $bsta;?>" href="faq/<?php echo $slug; ?>">
                    <img src="cat-image/faq-tag.png" style="width:100%;">
                    <img src="https://myglobal1.gumlet.io/cat-image/icon/<?php echo $image; ?>?w=36" class="faq-icon">
                    <h3 class="accord-title"><?php echo $name; ?></h3>
                    </a>
                </h2>
                </div>
                <?php }
                }
                ?>

            </div>
            
            </div>
</main>
<?php include( 'include/footer.php'); }else{
    echo "<script> window.location = 'https://newlandpharmacy.co.uk/notfound.php'</script>";
} ?>
<!-- <script>
      $('.ag-smoke-block').hide();
      $(window).on('load', function() {
        $('#halloween-modal').modal('show');
        // $('.ag-smoke-block').show();
        $(document).on('hide.bs.modal','#halloween-modal', function () {
          $('.ag-smoke-block').hide();
        });
      });
    </script>  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.1.2/flickity.pkgd.min.js"></script>

    <script type="text/javascript">
        
        
        
        $(window).on('load', function() {
            if(<?php echo $_SESSION['offerseen'] ?>==0){
                setTimeout(() => {
                    $('#offerPopup').modal('show');
                }, 1000);
            }
        });
        
        $('.offerbox').on('click', function() {
            $(this).addClass('active');
            <?php $_SESSION['offerseen']=1 ?>
        });
    </script>