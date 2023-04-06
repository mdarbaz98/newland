<?php
$productSeoTitle = "Newlands Pharmacy Medicine";
$productSeoDescription = "Newlands Pharmacy Medicine";
include('include/header.php');
?>
<?php include('include/sidenav.php'); ?>
<div class="modal fade" id="quantity-model" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div cl ass="modal-content">
      <div class="modal-header bg-secondary">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
          <li class="nav-item"><a class="nav-link fw-medium active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true" id="code"></a></li>
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body tab-content p-0">
        <div class="product-modal-quantity p-4">

        </div>
        <div class="cart-update">

        </div>
      </div>
    </div>
  </div>
</div>
<main class="offcanvas-enabled home-page">

  <section style="
    /* background-image: url('image/Bg.png');
    background-size: cover; */
">
    <div class="container-fluid header-section-web">
      <div class="row">
        <div class="col-12 header-left-section">
          <h2 class="header-title">
            EASY REAL
          </h2>
          <img src="cat-image/card/safe.png" class="safe-image">
          <div class="search-currency-section desk-searchss">

            <div class="search-header-input">
              <input type="text" id="search" class="form-control" onclick="onInputClick()" placeholder="Search products">
              <!-- <div class="input-text-container">
                <div class="wrapper">
                  <span>Search products</span>
                  <span>Search website reviews</span>
                  <span>Search FAQ queries</span>
                </div>
              </div> -->

              <img src="image/homesection/Pill.png" class="search-back-pill-img" alt="pill-img">
              <img src="image/homesection/Pill.png" class="search-back-pill-img second" alt="pill-img">
              <img src="image/homesection/Search_Icon.png" class="banner-search-icon" alt="search-icon">
              <div class="search-button">
                <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                Search
              </div>
              <div id="multidropdown" style=" position: absolute; top: 0; right: 0; left: 0; ">
                <div id="display-text" class="newDisplayText autocomplete-list" style=" position: absolute; z-index: 12; background-color: #fff; left: -1px; border: 2px solid #0c3072; right: -1px; border-top: 0px; margin: 0 1px; top: 49px; ">
                  <p id="realSearch" style="padding: 3px 37px; background: rgb(32, 197, 190); color: rgb(255, 255, 255); cursor: pointer; display: none;">Search For: <b><span id="searchKeyword"></span></b> <span href="#med-enq-modal" data-bs-toggle="modal" style="background: #ffc905; padding: 3px 11px 4px 11px; margin-left: 10px; color: #000000; text-transform: uppercase; font-weight: 600;">Enquiry</span></p>
                  <ul id="search-bar-item" class="list-group result">
                    <div class="defaultResult">
                      <p class="searchHeading">Bestseller Categories</p>
                      <div class="categoryListed">
                        <a href="antibiotics" class="cat_one searchLink">Antibiotics</a>
                        <a href="pain-medication" class="cat_two  searchLink">Pain Medication</a>
                        <a href="erectile-dysfunction" class="cat_three  searchLink">Erectile Dysfunction</a>
                        <a href="pain-medication" class="cat_four  searchLink">Pain Medication</a>
                        <a href="anxiety-and-depression" class="cat_one searchLink">Anxiety And Depression</a>
                        <a href="sleeping-pills" class="cat_two  searchLink">Sleeping Pills</a>
                        <a href="oral-steroids" class="cat_three  searchLink">Oral Sterioids</a>
                        <a href="injectable-steroids" class="cat_four  searchLink">Injectable Sterioids</a>
                      </div>
                      <p class="searchHeading pt-2">Bestseller Medication</p>
                      <div class="col-lg-12 col-md-12 shop-products col-12 px-0 px-lg-2" style="padding-top:7px;">
                        <section class="">
                          <!---->
                          <div class="row mx-n2">
                            <div class="col-lg-6 col-12 px-0 px-lg-2">
                              <div class="card product-card pb-0 my-0">
                                <div class="card-img-top d-block overflow-hidden" style=" display: flex !important; align-items: center; justify-content: center; padding: 0 !important; ">
                                  <a href="erectile-dysfunction/cialis">
                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/assets/images/products/Tadalafil.jpg" alt="Cialis" title="Cialis" style=" display: flex; width: 100%; align-items: center; justify-content: center; ">
                                  </a>
                                </div>
                                <div class="card-body py-2">
                                  <a class="product-meta d-block fs-xs pb-1"></a>
                                  <a href="erectile-dysfunction/cialis">
                                    <h3 class="product-title fs-sm">Tadalafil</h3>
                                    <p>Erectile Dysfunction</p>
                                    <p class="product-description d-flex justify-content-start  justify-lg-content-between">
                                      <span>12 to 18 Days Standard Delivery </span>
                                    </p>
                                  </a>
                                  <p class="product-price">
                                    $0.35/<small>tablet</small>*
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6 col-12 px-0 px-lg-2">
                              <div class="card product-card pb-0 my-0">
                                <div class="card-img-top d-block overflow-hidden" style=" display: flex !important; align-items: center; justify-content: center; padding: 0 !important; ">
                                  <a href="erectile-dysfunction/sildenafil">
                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/assets/images/products/sildenafil-50mg.jpg" alt="Viagra" title="Viagra" style=" display: flex; width: 100%; align-items: center; justify-content: center; ">
                                  </a>
                                </div>
                                <div class="card-body py-2">
                                  <a class="product-meta d-block fs-xs pb-1"></a>
                                  <a href="erectile-dysfunction/sildenafil">
                                    <h3 class="product-title fs-sm">Sildenafil</h3>
                                    <p>Erectile Dysfunction</p>
                                    <p class="product-description d-flex justify-content-start  justify-lg-content-between">
                                      <span>12 to 18 Days Standard Delivery </span>
                                    </p>
                                  </a>
                                  <p class="product-price">
                                    $0.31/<small>tablet</small>*
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                  </ul>
                </div>
              </div>


            </div>
            <!-- <div class="currency-header">
                    <div>
                      <i class="fa-solid fa-dollar"></i>
                      <p>USD</p>
                    </div>
                  </div> -->
          </div>
          <div class="search-currency-section mob-searchss">
            <img src="image/homesection/Pill.png" class="mob-search-pill first" alt="pill-img">
            <img src="image/homesection/Pill.png" class="mob-search-pill second" alt="pill-img">
            <img src="image/homesection/Pill.png" class="mob-search-pill third" alt="pill-img">
            <img src="image/homesection/Pill.png" class="mob-search-pill fourth" alt="pill-img">
            <div class="search-header-input">
              <input type="text" id="search" onclick="focusInput()" class="form-control" href="#searchBox" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox" placeholder="Search products">
              <!-- <div class="input-text-container">
                <div class="wrapper">
                  <span>Search website reviews</span>
                  <span>Search products</span>
                  <span>Search FAQ queries</span>
                </div>
              </div> -->
              <div class="search-button">
                <!-- <i class="fa-solid fa-magnifying-glass "></i> -->
                <img src="image/homesection/Search_Icon.png" class="banner-search-icon" alt="search-icon">
              </div>
              <div id="multidropdown" style=" position: absolute; top: 0; right: 0; left: 0; ">
                <div id="display-text" class="newDisplayText autocomplete-list" style=" position: absolute; z-index: 12; background-color: #fff; left: -1px; border: 2px solid #0c3072; right: -1px; border-top: 0px; margin: 0 1px; top: 49px; ">
                  <p id="realSearch" style="padding: 3px 37px; background: rgb(32, 197, 190); color: rgb(255, 255, 255); cursor: pointer; display: none;">Search For: <b><span id="searchKeyword"></span></b> <span href="#med-enq-modal" data-bs-toggle="modal" style="background: #ffc905; padding: 3px 11px 4px 11px; margin-left: 10px; color: #000000; text-transform: uppercase; font-weight: 600;">Enquiry</span></p>
                  <ul id="search-bar-item" class="list-group result">
                    <div class="defaultResult">
                      <p class="searchHeading">Bestseller Categories</p>
                      <div class="categoryListed">
                        <a href="antibiotics" class="cat_one searchLink">Antibiotics</a>
                        <a href="pain-medication" class="cat_two  searchLink">Pain Medication</a>
                        <a href="erectile-dysfunction" class="cat_three  searchLink">Erectile Dysfunction</a>
                        <a href="pain-medication" class="cat_four  searchLink">Pain Medication</a>
                        <a href="anxiety-and-depression" class="cat_one searchLink">Anxiety And Depression</a>
                        <a href="sleeping-pills" class="cat_two  searchLink">Sleeping Pills</a>
                        <a href="oral-steroids" class="cat_three  searchLink">Oral Sterioids</a>
                        <a href="injectable-steroids" class="cat_four  searchLink">Injectable Sterioids</a>
                      </div>
                      <p class="searchHeading pt-2">Bestseller Medication</p>
                      <div class="col-lg-12 col-md-12 shop-products col-12 px-0 px-lg-2" style="padding-top:7px;">
                        <section class="">
                          <!---->
                          <div class="row mx-n2">
                            <div class="col-lg-6 col-12 px-0 px-lg-2">
                              <div class="card product-card pb-0 my-0">
                                <div class="card-img-top d-block overflow-hidden" style=" display: flex !important; align-items: center; justify-content: center; padding: 0 !important; ">
                                  <a href="erectile-dysfunction/cialis">
                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/assets/images/products/Tadalafil.jpg" alt="Cialis" title="Cialis" style=" display: flex; width: 100%; align-items: center; justify-content: center; ">
                                  </a>
                                </div>
                                <div class="card-body py-2">
                                  <a class="product-meta d-block fs-xs pb-1"></a>
                                  <a href="erectile-dysfunction/cialis">
                                    <h3 class="product-title fs-sm">Tadalafil</h3>
                                    <p>Erectile Dysfunction</p>
                                    <p class="product-description d-flex justify-content-start  justify-lg-content-between">
                                      <span>12 to 18 Days Standard Delivery </span>
                                    </p>
                                  </a>
                                  <p class="product-price">
                                    $0.35/<small>tablet</small>*
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6 col-12 px-0 px-lg-2">
                              <div class="card product-card pb-0 my-0">
                                <div class="card-img-top d-block overflow-hidden" style=" display: flex !important; align-items: center; justify-content: center; padding: 0 !important; ">
                                  <a href="erectile-dysfunction/sildenafil">
                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/assets/images/products/sildenafil-50mg.jpg" alt="Viagra" title="Viagra" style=" display: flex; width: 100%; align-items: center; justify-content: center; ">
                                  </a>
                                </div>
                                <div class="card-body py-2">
                                  <a class="product-meta d-block fs-xs pb-1"></a>
                                  <a href="erectile-dysfunction/sildenafil">
                                    <h3 class="product-title fs-sm">Sildenafil</h3>
                                    <p>Erectile Dysfunction</p>
                                    <p class="product-description d-flex justify-content-start  justify-lg-content-between">
                                      <span>12 to 18 Days Standard Delivery </span>
                                    </p>
                                  </a>
                                  <p class="product-price">
                                    $0.31/<small>tablet</small>*
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                  </ul>
                </div>
              </div>


            </div>
            <!-- <div class="currency-header">
                    <div>
                      <i class="fa-solid fa-dollar"></i>
                      <p>USD</p>
                    </div>
                  </div> -->
          </div>
          <div class="recent-search">

            <?php
            $arrayNew = array_reverse($_SESSION['searchTerm']);
            if (count($arrayNew) > 0) {
              echo "<p style='font-weight: 600; padding-left: 10px; margin-top: -14px;'>Recent Searches</p>";
              foreach ($arrayNew as $x) {
            ?>
                <a href="search?keyword=<?php echo $x; ?>" class="searchTerm"><?php echo $x; ?></a>
              <?php
              }
            } else {
              echo "<p style='font-weight: 500; padding-left: 10px;'>Frequently purchased products:</p>";
              ?>
              <a href="p/viagra" class="searchTerm">Viagra</a>
              <a href="p/lorazepam-usa-to-usa" class="searchTerm">Lorazepam</a>
              <a href="p/xanax-usa-to-usa" class="searchTerm">Alprazolam</a>
              <a href="pn/Tramadol-USA-to-USA" class="searchTerm">Tramadol</a>
              <a href="p/pain-o-soma-us" class="searchTerm">Soma</a>
            <?php } ?>
          </div>
          <div class="short-intro d-block d-md-flex justify-content-center">
            <div class="text-center">
              <p class="mb-0">Number of happy customers:</p>
              <strong>732 <img src="image/homesection/graph-banner.gif" class="m-2" width="30"></strong>
            </div>
          </div>
          <a onclick="scrollToElement('homeTo');">
            <div class="scroll-down-sec text-center">
              <img src="image/homesection/scroll-arrow.png" class="arrow-down-img mb-1" alt="arrow-down">
              <p class="srl-dwn">Scroll Down</p>
            </div>
          </a>
        </div>
        <!-- <div class="col-lg-4 col-12 image-animate">
            <img src="image/tree.png" class="tree">
          </div> -->
      </div>
    </div>
  </section>
  <!-- steps section  -->
  <section class="steps-section py-md-5">
    <div class="container-fluid">
      <div class="steps-heading" id="homeTo">
        How we Work?
      </div>
      <p class="steps-desc text-center py-md-3 pb-4">Here are the 6 simple steps to order your medicines and get them delivered.

</p>
      <div class="tabs-section">
        <div class="nav nav-tabs mb-3 justify-content-between" id="nav-tab" role="tablist">
          <button class="nav-link d-flex flex-column justify-content-start align-items-center active" id="nav-step-1" data-bs-toggle="tab" data-bs-target="#nav-step1" type="button" role="tab" aria-controls="nav-step1" aria-selected="true"><span>Step 1</span>
            <p>Search Medicines You Need</p>
          </button>
          <button class="nav-link d-flex flex-column justify-content-start align-items-center" id="nav-step-2" data-bs-toggle="tab" data-bs-target="#nav-step2" type="button" role="tab" aria-controls="nav-step2" aria-selected="false"><span>Step 2</span>
            <p>Type In Your Address</p>
          </button>
          <button class="nav-link d-flex flex-column justify-content-start align-items-center" id="nav-step-3" data-bs-toggle="tab" data-bs-target="#nav-step3" type="button" role="tab" aria-controls="nav-step3" aria-selected="false"><span>Step 3</span>
            <p>Confirm Your Order</p>
          </button>
          <button class="nav-link d-flex flex-column justify-content-start align-items-center" id="nav-step-4" data-bs-toggle="tab" data-bs-target="#nav-step4" type="button" role="tab" aria-controls="nav-step4" aria-selected="false"><span>Step 4</span>
            <p>Process For Shipment</p>
          </button>
          <button class="nav-link d-flex flex-column justify-content-start align-items-center" id="nav-step-5" data-bs-toggle="tab" data-bs-target="#nav-step5" type="button" role="tab" aria-controls="nav-step5" aria-selected="false"><span>Step 5</span>
            <p>Live Tracking ID Generated</p>
          </button>
          <button class="nav-link d-flex flex-column justify-content-start align-items-center" id="nav-step-6" data-bs-toggle="tab" data-bs-target="#nav-step6" type="button" role="tab" aria-controls="nav-step6" aria-selected="false"><span>Step 6</span>
            <p>Delivery At Your Convenience</p>
          </button>
        </div>
        <div class="tab-content p-3 border" id="nav-tabContent">
          <div class="tab-pane fade active show" id="nav-step1" role="tabpanel" aria-labelledby="nav-step-1">
            <div class="inner-tab-div">
              <div class="left">
                <div class="tab-inner-heading">
                Search Medicines You Need
                </div>
                <p>The homepage will help you find medicine as per your need by scouting through the search bar. Search and Find.</p>
                <!-- <a class="tab-inner-link" href="">Next step <img src="image/icons/arrow_forward.png" class="ms-3" alt=""></</a> -->
              </div>
              <div class="right">
                <img src="image/homesection/step1.png" class="my-3 my-md-0 d-none d-md-block mx-auto" alt="">
                <img src="image/homesection/mobile-images/step1.svg" class="my-3 my-md-0 d-md-none" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade show" id="nav-step2" role="tabpanel" aria-labelledby="nav-step-2">
            <div class="row">
              <div class="col-md-6 d-md-flex flex-column justify-content-center">
                <h3 class="heading">Type In Your Address</h3>
                <p class="desc">Once the medicines are added to your cart, Get landed on the checkout page to type in your correct address. This will make medicines delivered hassle-free at your doorstep.</p>
              </div>
              <div class="col-md-6 right d-flex"><img src="image/homesection/step2.png" class="my-3 my-md-0 m-auto" alt=""></div>

            </div>
            <!-- <div class="">
              <div class="">
                <div class="">
                Choose your shipping address
                </div>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                <a class="tab-inner-link" href="">Next step <img src="image/icons/arrow_forward.png" class="ms-3" alt=""></a>
              </div>
              <div class="right">
                <img src="image/homesection/step2.png" class="my-3 my-md-0" alt="">
              </div>
            </div> -->
          </div>
          <div class="tab-pane fade show" id="nav-step3" role="tabpanel" aria-labelledby="nav-step-3">
            <div class="inner-tab-div">
              <div class="left">
                <div class="tab-inner-heading">
                Confirm Your Order
                </div>
                <p>After completion of your address details, Confirm your order by payment process. Once completed, now the medicines are on their way for shipment.</p>
                <!-- <a class="tab-inner-link" href="">Next step <img src="image/icons/arrow_forward.png" class="ms-3" alt=""></a> -->
              </div>
              <div class="right">
                <img src="image/homesection/step3.png" class="my-3 my-md-0 d-none d-md-block mx-auto" alt="">
                <img src="image/homesection/mobile-images/Step3.svg" class="my-3 my-md-0 d-md-none" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade show" id="nav-step4" role="tabpanel" aria-labelledby="nav-step-4">
            <div class="inner-tab-div">
              <div class="left">
                <div class="tab-inner-heading">
                Process For Shipment
                </div>
                <p>In the shipment process, medicines are packed by following safety procedures covering it with bubble wrap placed into an envelope. Then it gets on its way to clear customs and checkpoints.</p>
                <!-- <a class="tab-inner-link" href="">Next step <img src="image/icons/arrow_forward.png" class="ms-3" alt=""></a> -->
              </div>
              <div class="right">
                <img src="image/homesection/step4.png" class="my-3 my-md-0" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade show" id="nav-step5" role="tabpanel" aria-labelledby="nav-step-5">
            <div class="inner-tab-div">
              <div class="left">
                <div class="tab-inner-heading">
                  Live Tracking ID Generated
                </div>
                <p>Post 24 hours of order confirmation, a tracking ID will be generated; activated within 24-48 hours. You can track medicines at your own convenience.</p>
                <!-- <a class="tab-inner-link" href="">Next step <img src="image/icons/arrow_forward.png" class="ms-3" alt=""></a> -->
              </div>
              <div class="right">
              <img src="image/homesection/step5.png" class="my-3 my-md-0 d-none d-md-block mx-auto" alt="">
                <img src="image/homesection/mobile-images/Step5.svg" class="my-3 my-md-0 d-md-none" alt="">
              </div>
            </div>
          </div>
          <div class="tab-pane fade show" id="nav-step6" role="tabpanel" aria-labelledby="nav-step-6">
            <div class="inner-tab-div">
              <div class="left">
                <div class="tab-inner-heading">
                  Delivery At Your Convenience
                </div>
                <p>Once the order is dispatched, the tracking ID will help you with the live status. We will notify you with the current status through a message and you can choose the chat option available. Your package will be delivered discreetly.</p>
                <!-- <a class="tab-inner-link" href="">Next step <img src="image/icons/arrow_forward.png" class="ms-3" alt=""></a> -->
              </div>
              <div class="right">
              <img src="image/homesection/step6.png" class="my-3 my-md-0 d-none d-md-block mx-auto" alt="">
                <img src="image/homesection/mobile-images/Step6.svg" class="my-3 my-md-0 d-md-none" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- steps section  -->
  <section>
    <div class="container-fluid data-list">
      <h2 class="text-center blue-haeding">NLP Simplified, At One Click!</h2>
      <div class="row tns-carousel tns-nav-enabled">
        <div class="col-12">
          <div style="width: 100%;padding: 6px;" class="container-fluid">
            <div class="main-container">
              <div class="boxes 1-boxes" id="all-about-new-land-pharma">
                <img src="cat-image/icon/info.png" alt="" />
                <div class="content">
                  <h2>About NLP</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      NewLandPharma is a certified online pharmacy based in the UK which
                      provides quality and <span class="blur">genuine medicines all over</span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      NewLandPharma is a certified online pharmacy based in the UK which
                      <span class="blur">provides quality and genuine </span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      NewLandPharma is a certified online pharmacy based in the UK which
                      provides quality and genuine medicines all over the globe and has been working
                      hard for your better health since 2013.A wide range of medicines from various
                      registered manufactures are provided by us so you can get the specific product as
                      per your need.
                    </p>
                    <p>
                      We ship in 6 to 7 business days within the USA and 12 to 15 business days for all
                      over the globe, easy refunds and reshipment can be provided as per your
                      requirements. We aim to serve our customers with the best medicines in the fastest
                      way possible.
                    </p>
                    <p>
                      NewLandPharma has the most affordable rates so that your health care never
                      affects your pocket. We have customer support team dedicated to serve you 24*7 to
                      answer your queries right away. About 20 to 25 orders are delivered daily to our
                      satisfied and happy customers and over 1000 to 3000 orders are delivered in a year.
                    </p>
                    <p>
                      As a company we believe in customer satisfaction and service the most, we tend to
                      give our customers an absolute easy and safe experience of ordering medicines
                      online. People face problems ordering medicines online because of financial frauds,
                      but here at NewLandPharma we provide you the safest transactions through
                      our secure payment gateways and we take the whole responsibility of your refund if
                      there are any problems in delivery or products.
                    </p>
                    <p>
                      NewLandPharma provides the whole information and track record of your
                      parcel which is packed in the most secure manner to prevent the damages it can
                      cause on the journey. This makes us the most trusted pharmacy on the web. About
                      200 to 300 people happily reorder from us throughout the year. We are always ready
                      to help you and serve with the best possible services.
                    </p>
                  </div>

                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#0F3374 !important;"></i>
                </button>

                <!-- <a class="watch-now"  href="https://doggtasticadventures.com/assets/videos/Order-to-delivery-process.mp4">Watch Now</a> -->
              </div>
              <div class="boxes 1-boxes" id="certified-registered-legal-status">
                <img src="cat-image/icon/high-quality.png" alt="" />
                <div class="content">
                  <h2>Certification and Legal Status</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      We the NewLandsPharma are certified online pharmacy. Registered under
                      <span class="blur"> UK medicinal authority & are legally</span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      We the NewLandsPharma are certified <span class="blur"> online pharmacy</span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      We the <b>NewLandsPharma</b> are certified online pharmacy. Registered
                      under UK medicinal authority & are legally authorized to trade in medicines in
                      USA & UK.
                    </p>
                    <p>
                      <b>Certification/legalities (GHPC link)</b>
                      <b>NewLandsPharma</b> is certified by General Health Pharmaceutical Council of UK. Check the website here:
                      https://www.pharmacyregulation.org/registers/pharmacy/registrationnumber/1031217
                    </p>
                    <p>
                      <b>Genuinity of website</b>
                      Our website https://<?php echo $INFO_WEBSITE_NAME  ?>/ is secured and authenticated by multiple certificates. A very little data that we take from our customers is also stored on our secure servers
                    </p>
                    <p>
                      <b>License number</b>
                      <b>NewLandsPharma</b> is certified by General Health Pharmaceutical
                      Council of UK. Our license number is <b>1031217</b>
                    </p>
                    <p>
                      <b>Right to export & distribute medicines globally</b>
                      <b>NewLandsPharma</b> have acquired license and distribution authority to
                      trade in medicines globally i.e <b>NewLandsPharma</b> can sell and distribute
                      medicines Worldwide.
                    </p>

                  </div>


                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#36F348 !important;"></i>
                </button>
                <!-- <div class="watch-now">Watch Now</div> -->
              </div>
              <div class="boxes 1-boxes" id="no-prescription-needed">
                <img src="cat-image/icon/prescription-related-faqs.png" alt="" />
                <div class="content">
                  <h2>No prescription needed</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      We at NewLandsPharma are constantly working to simplify the delivery
                      process for our customers <span class="blur">and give them a hassle-free experience</span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      We at NewLandsPharma are constantly working to simplify the delivery
                      <span class="blur">process for our customers and give them</span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      We at NewLandsPharma are constantly working to simplify the delivery
                      process for our customers and give them a hassle-free experience. Once you have
                      placed an order, your medicines are packed neatly and after clearing local customs
                      it gets shipped to your country where it clears destination customs and then
                      delivered safely to your doorstep.
                    </p>
                    <p>
                      Shipping medicines to different countries needs a lot of paperwork and we don’t
                      bother you for that, all the needful paperwork will be taken care of by
                      <b>NewLandsPharma</b>. If you don't have a renewed prescription then there is
                      nothing to be worried about. We have our team of certified doctors for prescription.
                      No extra charges will be applicable for renewal of prescription. If you don't have the
                      prescription with you for the required medicine then our team will provide you the
                      prescription without any extra charges.
                    </p>
                    <p>
                      Over the counter medicines don't need any kind of prescription, they will be provided
                      to you easily. We don't want our customers to go through any kind of trouble or face
                      any kind of problems in getting their medicines delivered. Because of this we do all
                      the work and you just need to Click, Sit and Relax.
                    </p>
                  </div>


                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#8389FE !important;"></i>
                </button>

                <!-- <div class="watch-now">Watch Now</div> -->
              </div>
              <div class="boxes 2-boxes" id="about-medicines-manufacturers">
                <img src="cat-image/icon/medicines-&-manufacturers-related-faqs.png" alt="" />
                <div class="content">
                  <h2>Info on Meds and Manufacturers</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      All our medicines are manufactured by reputed manufacturers, while following
                      standard <span class="blur">manufacturing guidelines Reputed manufacturers/variety of manufacturers</span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      All our medicines are manufactured by reputed <span class="blur"> manufacturers, while following
                        standard</span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      All our medicines are manufactured by reputed manufacturers, while following
                      standard manufacturing guidelines
                    </p>
                    <p>
                      - Reputed manufacturers/variety of manufacturers
                    </p>
                    <p>
                      <b>Generic medicines</b>
                      Generic medicines are same as branded medicines. Generic medicines contain
                      the same ingredients as branded medicines.
                    </p>
                    <p>
                      <b>Quality & Genuine medicines</b>
                      Affordable prices don’t mean that <b>NewLandsPharma</b> deals in
                      substandard quality. All our medicines are of best quality and made with
                      genuine ingredients.
                    </p>
                    <p>
                      <b>Generic Vs. Branded</b>
                      Generic medicines are those medicines which are manufactured by local yet
                      reputed manufacturer under strict guidelines of WHO & FDA. Since, its not
                      branded the additional brand cost, marketing cost, research cost & distribution
                      cost is not added into price, which makes generic medicines very affordable to
                      end consumer. After patent of medicine expires the recipe of medicine is
                      available for every manufacturer to produce the branded medicine at affordable
                      cost.
                      <br>
                      Branded medicines are manufactured by large brands on global scale. Initial
                      research cost, marketing cost, distribution and brand cost is added to the mix &
                      all these additional cost makes branded medicine way costlier than generic
                      medicine
                    </p>
                    <p>
                      <b>WHO & FDA approved</b>
                      All our medicines are manufactured under guidelines of WHO & approved by
                      Food & Drug Authority
                    </p>
                    <p>
                      <b>Specification of medicines</b>
                      We at <b>NewLandsPharma</b> have multiple medicines categorized in 28
                      categories. Pain Medication, Hypertension, Erectile Dysfunction, Heart
                      Medication are some of the popular categories.
                    </p>
                    <p>
                      <b>Forms of medicines & location on website & shelf life</b>
                      We at <b>NewLandsPharma</b> serve multiple medicines in different forms i.e
                      Tablets, Capsules, Injections, Inhalers, Ointments, Creams, etc.
                      <br>
                      Tablets & Capsules are found in day-to-day medicines, Inhalers are for asthma
                      & breathing issues, Ointments & creams can be found in Skincare category.
                      <br>
                      All the medicines that are available on <b>NewLandsPharma</b> are freshly
                      manufactured and have shelf life of 2-3 years
                    </p>
                    <p>
                      <b>Country of origin of medicines</b>
                      All the generic medicines are manufactured in India. That includes the tablets,
                      capsules, inhalers, ointments & creams. All Injectable Steroids are shipped from
                      Singapore.
                    </p>
                    <p>
                      <b>Potency differentiation/Abbreviations/Description (SR, MR, XR etc.)</b>
                      On <b>NewLandsPharma</b> customers can find many medicines with multiple
                      potencies (strengths) to choose from according to their needs
                      You will find many medicines with added abbreviations such as CR, SR, ER
                      etc. CR stands for Controlled Release, SR stands for Sustained Release & ER
                      stands for Extended Release. These abbreviations serve different purpose.
                      Kindly purchase according to your need or as prescribed by your healthcare
                      professional.
                    </p>
                  </div>


                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#3F75D8 !important;"></i>
                </button>

                <!-- <div class="watch-now">Watch Now</div> -->
              </div>
              <div class="boxes 2-boxes" id="customer-experience">
                <img src="cat-image/icon/Customer experience.png" alt="" />
                <div class="content">
                  <h2>User Friendly Experience</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      Here at NewLandsPharma we have made every process easy for our
                      customers. For ordering medicines, <span class="blur">you just need some simple clicks</span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      Here at NewLandsPharma we have made every process easy for our
                      customers. <span class="blur">For ordering medicines, </span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      Here at <b>NewLandsPharma</b> we have made every process easy for our
                      customers. For ordering medicines, you just need some simple clicks, as you land
                      on our homepage you see medicines perfectly categorised so it can be easy to get
                      medicines according to their categories. You can search for the specific medicines
                      you need and read detailed information about it by clicking on it, this brings you to
                      the medicine page where you can add it to your cart by selecting the required
                      strength. After this you need to go to the cart and click on the buy now button. Fill in
                      your correct address and the medicines will be delivered to you.
                    </p>
                    <p>
                      We keep in touch with you regarding your parcel and keep you updated about the
                      parcel’s positions through mails, messages and WhatsApp. If you have any queries
                      then you can contact to our customer service team which dedicated to serve you
                      24*7. Your queries will be answered and resolved 24 business hours.
                    </p>
                  </div>
                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#E42D61 !important;"></i>
                </button>
              </div>
              <div class="boxes 2-boxes" id="my-account">
                <img src="cat-image/icon/sign-up-&-login-in-related-faqs.png" alt="" />
                <div class="content">
                  <h2>Setup-Up Your account</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      Steps to signup/login/account creation NewLandsPharma has a specialized
                      feature created <span class="blur"> just for our customers to simplify signup</span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      Steps to signup/login/account creation NewLandsPharma has a specialized
                      <span class="blur"> feature created just for</span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      <b>Steps to signup/login/account creation</b>
                      <br>
                      <b>NewLandsPharma</b> has a specialized feature created just for our
                      customers to simplify signup, login & new account creation process.
                    </p>
                    <p>
                      <b>For Signup</b>
                      <br>
                      Simply click on my account icon on the top right corner, click on sign up, fill in
                      the details and your account is created.
                    </p>
                    <p>
                      <b>For login</b>
                      <br>
                      Click on my account icon on top right corner, click on login button & just enter
                      your login credentials and you are logged into your account. In case if you don’t
                      remember your password, you can sign in using OTP. To login with OTP kindly
                      enter your registered email address and select the option of Login With OTP,
                      you’ll receive an email that has an OTP, type that OTP into given boxes, and
                      you’ll be logged in your account.
                    </p>
                    <p>
                      <b>Benefits of my account</b>
                      <br>
                      Previous order/tracking/tickets of previous issues
                      <br>
                      Having an account with <b>NewLandsPharma</b> comes with multiple
                      accessibility perks, which are: Order History, Order Tracking & Open tickets
                      (status of your enquiry, grievances etc.)
                      <br>
                      In order to access all the features of my account you must be logged in with
                      your registered email address on our website.
                    </p>
                    <p>
                      <b>Order History</b>
                      <br>
                      In my account section, on the left had side you’ll be able to find Order History
                      option, in which you can see all the existing orders you made with <b>NewLandsPharma</b>.
                      <br>
                      In order history you’ll get all the information about previous orders which
                      includes – Name of the medicine, strength of the medicine, quantity that you
                      ordered, breakup of the amount that you paid (i.e medicine cost, shipping,
                      discounts etc.).
                      <br>
                      In order history we have also provided a Reorder feature to make your ordering
                      experience smooth and hassle free. You’ll be able to reorder same medicine of
                      same strength & quantity with just a click of a button and we’ll deliver it to you.
                    </p>
                    <p>
                      <b>Multiple addresses/Data saved</b>
                      <br>
                      If you are a registered member on <b>NewLandsPharma</b>, you will get the
                      benefit of having multiple addresses saved in your account. This feature is
                      specially added for customer’s convenience of receiving their orders at any of
                      the addresses that they saved & it also facilitates customers to order for their
                      relatives and friends.
                    </p>
                    <br><br>
                    <b>Membership benefits</b>
                    <br><br>
                    <p>
                      <b>Special discounts/referrals/free pills.</b>
                      Soon <b>NewLandsPharma</b> is going to start Membership benefits for our
                      frequently ordering & loyal customers.
                    </p>
                    <p>
                      <b>Special discounts</b>
                      Personalized and special discounts for all the members to get their medicines at
                      even more affordable prices.
                    </p>
                    <p>
                      <b>Referrals</b>
                      A limited time referral scheme for all our members to invite their friends & family
                      on <b>NewLandsPharma</b> and get surprising referral offers to save more on
                      your medicine bills
                    </p>
                    <p>
                      <b>Free pills</b>
                      <b>NewLandsPharma</b> is going to reward our members with complimentary
                      medicines in their every order.
                    </p>
                  </div>
                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#848AFE !important;"></i>
                </button>
              </div>
              <div class="boxes 3-boxes" id="cheap-rates">
                <img src="cat-image/icon/Cheap Rates.png" alt="" />
                <div class="content">
                  <h2>Reasonable prices</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      Taking care of our health is a lot costly these days but health is
                      more important than <span class="blur">anything else. NewLandsPharm</span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      Taking care of our health is a lot costly these days but health is more
                      <span class="blur">important than anything else.</span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      Taking care of our health is a lot costly these days but health is more important than
                      anything else. <b>NewLandsPharma</b> is here to make your healthcare affordable
                      with low-cost medicines and many more offers. You can get your medicines at
                      amazingly affordable prices and even free delivery at <b>NewLandsPharma</b>
                    </p>
                    <p>
                      We provide generic forms of every medicine you need at a very low cost which are
                      manufactured and exported from the UK. The manufacturers are registered and
                      certified as well as reputed all over the world.
                    </p>
                    <p>
                      Low prices does not mean compromising quality. We believe in quality and
                      affordability at one stop and we very well intend to be that one stop. You have often
                      come across some pharmacies who claim low prices and add external charges, we
                      are against that. There are no hidden charges at <b>NewLandsPharma</b>, even
                      there are no extra charges for prescription. We are here to serve not to rob you.
                    </p>
                  </div>
                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#FF356E !important;"></i>
                </button>
              </div>
              <div class="boxes 3-boxes" id="delivery-locations">
                <img src="cat-image/icon/Delivery locations.png" alt="" />
                <div class="content">
                  <h2>Delivered Around Globe</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      All over USA We at NewLandsPharma delivers affordable medicines all over USA.
                      From <span class="blur">Washington to Florida & from California to New York </span>
                    </p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      All over USA We at NewLandsPharma delivers affordable medicines
                      <span class="blur">all over USA. From </span>
                    </p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      <b>All over USA</b>
                      We at <b>NewLandsPharma</b> delivers affordable medicines all over USA.
                      From Washington to Florida & from California to New York we’ve got you
                      covered
                      <br>
                      Customers from USA have a special benefit for being USA resident i.e., they
                      have two delivery options to choose from.
                    </p>
                    <p>
                      1. USA to USA Delivery
                      <br><br>
                      USA to USA delivery is done within United States of America, customer
                      needs to pay a premium price but delivery is done within whooping 5-7
                      business days.
                      <br>
                      Delivery of USA-to-USA medicines is done rapidly because all our
                      medicines are already stocked in our storage facility in America. Hence, no
                      formalities with custom officials & products are ready to ship as soon as
                      we receive the order.
                    </p>
                    <p>
                      2. Standard Delivery
                      <br><br>
                      Standard delivery takes anywhere between 12-18 business days.
                      Medicines are shipped from UK to all around the globe. Prices are
                      unbelievably cheap and affordable. Standard delivery takes comparatively
                      more time because medicines are shipped from India and few times gets
                      stuck in custom formalities.
                    </p>
                    <p><b>All over Europe/Global (Standard Shipping)</b></p>
                    <p><b>Delivery time USA to USA/Other location</b></p>
                    <p>
                      <b>Handling & Packaging</b>
                      We at <b>NewLandsPharma</b> take the greatest possible care in packaging
                      your order. Untouched by human hands, your order will be packaged in factory-
                      sealed blister packs and sealed in bubble wrap envelopes to keep it safe and
                      discreet.
                    </p>
                    <p>
                      <b>What if delayed</b>
                      Your order may be delayed due to several reasons such as stock unavailability,
                      shortage of staff, higher demand, delay in shipping etc. If you wish to find out
                      the exact reason for the delay, you can get in touch with our customer service.
                    </p>
                    <p>
                      <b>Why delivery time is different</b>
                      As mentioned in recent point, in USA to USA shipping our medicines are
                      already stocked in storage facility in America. Hence, no intervention from
                      customs department & that enables us to delivery rapidly.
                      <br>
                      Whereas, in Standard Shipping medicines are shipped from India &amp; the
                      package goes through various customs formalities, that’s why it takes more
                      time than USA to USA shipping.
                    </p>
                  </div>
                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#878EFF !important;"></i>
                </button>
              </div>
              <div class="boxes 4-boxes" id="discreet-shipping">
                <img src="cat-image/icon/Discreet shipping.png" alt="" />
                <div class="content">
                  <h2>Discreet Shipping</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      We at take extreme care when it comes to packaging and shipping your order.
                      Your privacy is <span class="blur">our utmost priority Secured packaging untouched by human hands,</span></p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      We at take extreme care when it comes to packaging and shipping your <span class="blur">order.
                        Your privacy is </span></p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      We at <b>NewLandsPharma</b> take extreme care when it comes to packaging
                      and shipping your order. Your privacy is our utmost priority.
                    </p>
                    <p>
                      <b>Secured packaging</b>
                      Untouched by human hands, your order will be packaged in factory-sealed blister packs and sealed in bubble wrap envelopes to keep it safe and discreet.
                    </p>
                    <p>
                      <b>Shipping process</b>
                      Once you place an order on <b>NewLandsPharma</b>, it gets processed through our Customer Service Representative. Then after, same order is forwarded to our order processing department, where your order is packed in factory sealed blister packets, and send to shipping department for further process. After your package reaches to shipping department, the respective department closely inspects the package, attaches necessary documents to it and dispatches it to our shipping partner which USPS. USPS then ships the given package and delivers it to our processing facility in USA. From then its given to the courier services, and then it reaches to you safely at your home.
                    </p>
                    <p>
                      <b>How to use tracking id</b>
                      Tracking id enables the customer to monitor the travel progress of their
                      respective order.
                      <br>
                      USA to USA order’s tracking id is of 22 digits. And other order’s tracking id consists of 13 alphanumeric characters.
                      <br>
                      Tracking id is given to customers 2 days after payment of their order & it takes 2
                      more days to activate.
                      <br>
                      Your tracking id will be shared with you via Email, SMS & WhatsApp.
                      Once your tracking id is live, you’ll be notify about any major progress of your
                      order through Email, SMS & WhatsApp.
                      <br>
                      You can track your order via your tracking id on https://www.17track.net
                    </p>
                    <p>
                      <b>What if damaged</b>
                      Don’t worry! Just get in touch with us at support@<?php echo $INFO_WEBSITE_NAME  ?>.
                      Keep the images of the damaged products handy and we will ensure that you
                      receive a replacement or a refund for the same.
                    </p>
                    <p>
                      <b>Package confidentiality</b>
                      We respect the privacy of our customers and therefore we ship all of our
                      products in discreet & safe packages.
                    </p>
                  </div>
                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#FFBC3C !important;"></i>
                </button>
              </div>
              <div class="boxes 4-boxes" id="secured-payment-billing-invoice">
                <img src="cat-image/icon/Secured payment.png" alt="" />
                <div class="content">
                  <h2>Secured Payments</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      Payment modes Here at New Lands Pharma, for convenience of our customer have kept
                      multiple <span class="blur"> modes of payment </span></p>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      Payment modes Here at New Lands Pharma, for convenience of <span class="blur"> our customer have kept
                        multiple </span></p>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      <b>Payment modes</b>
                      Here at <b>NewLandsPharma</b>, for convenience of our customer have kept
                      multiple modes of payment to choose from. We accept payments through
                      Credit Card, Wire Transfer & Debit Card. Soon the option of paying
                      through Bitcoin, Google Pay will made available for the convenience of our
                      customers.
                    </p>
                    <p>
                      - Secured payment gateways
                    </p>
                    <p>
                      <b>Invoicing details (name, Id, Contact, DOB)</b>
                      For preparation of customer’s invoice all we need is customer’s name, Email
                      address, Shipping address, Contact number & Date of birth.
                    </p>
                    <p>
                      <b>Post payment itemized bill</b>
                      Once customer places an order and pays for the same. They gets an itemized
                      bill that consists of subtotal, shipping charges, discounts and final total. In
                      itemized bill customer also gets the details of their order i.e name of medicine,
                      strength of medicine, quantity of medicine, billing & shipping address, name of
                      customer etc.
                    </p>
                    <p>
                      - Do I get printed bill?
                    </p>
                    <p>
                      <b>Billing details in email</b>
                      Billing details consists of name of the customer, shipping and billing address,
                      email address, contact number, name of medicine, strength of medicine,
                      quantity of medicine, subtotal, discounts, shipping charges & total payable
                      amount.
                    </p>
                    <p>
                      <b>Email confirmation after payment & order confirmation</b>
                      Every customer of <b>NewLandsPharma</b> receives confirmation email after
                      they pay for their order & and once the payment received customer also gets an
                      email of order confirmation.
                    </p>
                  </div>
                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#0B2F72 !important;"></i>
                </button>
              </div>
              <div class="boxes 4-boxes" id="cancellations">
                <img src="cat-image/icon/cancel.png" alt="" />
                <div class="content">
                  <h2>Flexible Cancellations</h2>
                  <div class="collapse-section deskList">
                    <p style="margin-top: 3px;">
                      Cancellations at NewLandsPharma are easy, once you order from us you can
                      cancel,<span class="blur"> refund or reship any order before its shipment</span>
                  </div>
                  <div class="collapse-section mobList">
                    <p style="margin-top: 3px;">
                      Cancellations at NewLandsPharma are easy, once you order from us you can<span class="blur">
                        cancel, refund </span>
                  </div>
                  <div class="expand-section">
                    <p style="margin-top: 3px;">
                      Cancellations at <b>NewLandsPharma</b> are easy, once you order from us you can
                      cancel, refund or reship any order before its shipment has been done. When the
                      order is shipped, you get notified through mail and messages. Any kind of changes
                      you need to be done in your order are surely possible before the shipment.
                    </p>
                    <p>
                      If you need a refund for your order you can apply for that, after your refund is passed
                      it will reflect in your bank account within 24 to 48 business hours. For cancellation or
                      refund of your order you need to contact our customer service and get the proper
                      assistance you need.
                    </p>
                    <p>
                      <b>Refund</b>
                      <b>NewLandsPharma</b> takes the full responsibility of the medicines that have been
                      delivered. If the medicines that are delivered are incorrect or expired then you will
                      get full refund as well as reshipment for the same order. If the potency of the
                      medicines are not rightly delivered as you selected then you will get refund or
                      reshipment as per your need.
                      <br>
                      If an incomplete order is delivered then you can get partial refund or partial
                      reshipment and if you are not satisfied with the quality of medicines then you are
                      liable for a refund or reshipment.
                      <br>
                      If you need a refund then you have to send the cancelled product to us and the
                      charges for that will be borne by <b>NewLandsPharma</b>. If you need a reshipment
                      then you can apply for it and the previous order stays with you and new medicines
                      will be delivered to you. In any situation you get two choices either to get a refund or
                      reship your order.
                    </p>
                    <p>
                      <b>Reshipment</b>
                      When your medicines are shipped by us it goes through customs. By any chance
                      your parcel gets stuck or seized by the destination customs, you will surely get one
                      time reshipment from <b>NewLandsPharma</b>.
                      <br>
                      Once you have applied for reshipment your medicines are repacked and are again
                      ready for the shipment. It takes 2 to 3 business days to generate your new tracking
                      number and your package will be delivered in normal shipping time.

                    </p>
                  </div>
                </div>
                <button class="close-btn"><i class="fa-solid fa-xmark"></i></button>
                <button class="btn expand">
                  <i class="fa-solid fa-right-long" style="color:#EC2432 !important;"></i>
                </button>
              </div>
            </div>
            <button class="show-all-box view-more-btn"><span>View More</span><i class="fa-solid fa-chevron-down"></i></button>
            <button class="hide-all-box view-more-btn"><span>View Less</span><i class="fa-solid fa-chevron-up"></i></button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container-fluid shop-category">
      <div class="row tns-carousel tns-nav-enabled">
        <div class="col-12">
          <h2 class="heading">Shop By Category</h2>
        </div>
        <div class="col-12 cat-section">
          <a href="allergy" class="category-item cat-box-1">
            <img src="https://myglobal1.gumlet.io/category-images/Allergy.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Allergy</h3> -->
          </a>
          <a href="anti-fungal" class="category-item cat-box-1">
            <img src="https://myglobal1.gumlet.io/category-images/Anti-Fungal.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Anti Fungal</h3> -->
          </a>
          <a href="anti-viral" class="category-item cat-box-1">
            <img src="https://myglobal1.gumlet.io/category-images/Anti-Viral.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Anti Viral</h3> -->
          </a>
          <a href="antibiotics" class="category-item cat-box-1">
            <img src="https://myglobal1.gumlet.io/category-images/Antibiotics.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Antibiotics</h3> -->
          </a>
          <a href="anxiety-and-depression" class="category-item cat-box-2">
            <img src="https://myglobal1.gumlet.io/category-images/Anxiety-&-Depression.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Anxiety & Depression</h3> -->
          </a>
          <a href="arthritis-medication" class="category-item cat-box-2">
            <img src="https://myglobal1.gumlet.io/category-images/Arthritis-Medication.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Arthritis Medication</h3> -->
          </a>
          <a href="asthama-medication" class="category-item cat-box-2">
            <img src="https://myglobal1.gumlet.io/category-images/Asthama.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Asthama</h3> -->
          </a>
          <a href="cancer-medication" class="category-item cat-box-2">
            <img src="https://myglobal1.gumlet.io/category-images/Cancer.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Cancer</h3> -->
          </a>
          <a href="covid" class="category-item cat-box-3">
            <img src="https://myglobal1.gumlet.io/category-images/Covid.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Covid</h3> -->
          </a>
          <a href="de-addiction" class="category-item cat-box-3">
            <img src="https://myglobal1.gumlet.io/category-images/De-addiction.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">De Addication</h3> -->
          </a>
          <a href="diabeties-medication" class="category-item cat-box-3">
            <img src="https://myglobal1.gumlet.io/category-images/Diabetes.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Diabetes</h3> -->
          </a>
          <a href="erectile-dysfunction" class="category-item cat-box-3">
            <img src="https://myglobal1.gumlet.io/category-images/ed.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">ED</h3> -->
          </a>
          <a href="gastrointestinal-medication" class="category-item cat-box-4">
            <img src="https://myglobal1.gumlet.io/category-images/gas.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">GAS</h3> -->
          </a>
          <a href="hair-care" class="category-item cat-box-4">
            <img src="https://myglobal1.gumlet.io/category-images/Hair-Care.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Hair Care</h3> -->
          </a>
          <a href="heart-medication" class="category-item cat-box-4">
            <img src="https://myglobal1.gumlet.io/category-images/Heart-Medication.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Heart Medication</h3> -->
          </a>
          <a href="herbal-medication" class="category-item cat-box-4">
            <img src="https://myglobal1.gumlet.io/category-images/Herbal-Medication.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Herbal Medication</h3> -->
          </a>
          <a href="hiv-meds" class="category-item cat-box-5">
            <img src="https://myglobal1.gumlet.io/category-images/hiv.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">HIV</h3> -->
          </a>
          <a href="injectable-steroids" class="category-item cat-box-5">
            <img src="https://myglobal1.gumlet.io/category-images/Injectable-Steroids.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Injectable Steroids</h3> -->
          </a>
          <a href="mens-health-care" class="category-item cat-box-5">
            <img src="https://myglobal1.gumlet.io/category-images/Mens-Health-Care.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Mens Health Care</h3> -->
          </a>
          <a href="oral-steroids" class="category-item cat-box-5">
            <img src="https://myglobal1.gumlet.io/category-images/Oral-Steroids.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Oral Sterioids</h3> -->
          </a>
          <a href="pain-medication" class="category-item cat-box-6">
            <img src="https://myglobal1.gumlet.io/category-images/Pain.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Pain</h3> -->
          </a>
          <a href="skincare-" class="category-item cat-box-6">
            <img src="https://myglobal1.gumlet.io/category-images/Skin-Care.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Skin Care</h3> -->
          </a>
          <a href="sleeping-pills" class="category-item cat-box-6">
            <img src="https://myglobal1.gumlet.io/category-images/Sleeping-Pills.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Sleeping Pills</h3> -->
          </a>
          <a href="somatropin-h-g-h" class="category-item cat-box-6">
            <img src="https://myglobal1.gumlet.io/category-images/Somatropin-H-G-H.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Somatropin H G H</h3> -->
          </a>
          <a href="weight-loss-pills" class="category-item cat-box-7">
            <img src="https://myglobal1.gumlet.io/category-images/Weight-Loss.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Weight Loss</h3> -->
          </a>
          <a href="womens-health-care" class="category-item cat-box-7">
            <img src="https://myglobal1.gumlet.io/category-images/Womens-Health-Care.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Womens Health Care</h3> -->
          </a>
          <a href="other" class="category-item cat-box-7">
            <img src="https://myglobal1.gumlet.io/category-images/Others.png?w=214" alt="" srcset="">
            <!-- <h3 class="catname">Others</h3> -->
          </a>
        </div>
        <button class="show-all-cat view-more-btn "><span>View More</span><i class="fa-solid fa-chevron-down"></i></button>
        <button class="hide-all-cat view-more-btn "><span>View Less</span><i class="fa-solid fa-chevron-up"></i></button>
        <?php
        if (isset($_SESSION['catSlider'])) {
          $cardSet = $_SESSION['catSlider'];
        } else {
          $cardSet = 0;
        }
        ?>
        <div id="categoryCar" class="col-12 cat-section1 tns-carousel-inner" data-carousel-options='{"mode": "gallery", "startIndex": <?php echo $cardSet; ?>, "controls":false, "nav": true, "info": "getInfo"}'>
          <div class="group">
            <a id="allergy" onclick="setSession(0,'allergy')" class="category-item cat-box-1">
              <img src="https://myglobal1.gumlet.io/category-images/Allergy.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Allergy</h3> -->
            </a>
            <a id="anti-fungal" onclick="setSession(0,'anti-fungal')" class="category-item cat-box-1">
              <img src="https://myglobal1.gumlet.io/category-images/Anti-Fungal.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Anti Fungal</h3> -->
            </a>
            <a id="anti-viral" onclick="setSession(0,'anti-viral')" class="category-item cat-box-1">
              <img src="https://myglobal1.gumlet.io/category-images/Anti-Viral.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Anti Viral</h3> -->
            </a>
            <a onclick="setSession(0,'antibiotics')" id="antibiotics" class="category-item cat-box-1">
              <img src="https://myglobal1.gumlet.io/category-images/Antibiotics.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Antibiotics</h3> -->
            </a>
          </div>
          <div class="group">
            <a onclick="setSession(1,'anxiety-and-depression')" id="anxiety-and-depression" class="category-item cat-box-2">
              <img src="https://myglobal1.gumlet.io/category-images/Anxiety-&-Depression.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Anxiety & Depression</h3> -->
            </a>
            <a onclick="setSession(1,'arthritis-medication')" id="arthritis-medication" class="category-item cat-box-2">
              <img src="https://myglobal1.gumlet.io/category-images/Arthritis-Medication.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Arthritis Medication</h3> -->
            </a>
            <a onclick="setSession(1,'asthama-medication')" id="asthama-medication" class="category-item cat-box-2">
              <img src="https://myglobal1.gumlet.io/category-images/Asthama.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Asthama</h3> -->
            </a>
            <a onclick="setSession(1,'cancer-medication')" id="cancer-medication" class="category-item cat-box-2">
              <img src="https://myglobal1.gumlet.io/category-images/Cancer.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Cancer</h3> -->
            </a>
          </div>
          <div class="group">
            <a onclick="setSession(2,'covid')" id="covid" class="category-item cat-box-3">
              <img src="https://myglobal1.gumlet.io/category-images/Covid.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Covid</h3> -->
            </a>
            <a onclick="setSession(2,'de-addiction')" id="de-addiction" class="category-item cat-box-3">
              <img src="https://myglobal1.gumlet.io/category-images/De-addiction.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">De Addication</h3> -->
            </a>
            <a onclick="setSession(2,'diabeties-medication')" id="diabeties-medication" class="category-item cat-box-3">
              <img src="https://myglobal1.gumlet.io/category-images/Diabetes.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Diabetes</h3> -->
            </a>
            <a onclick="setSession(2,'erectile-dysfunction')" id="erectile-dysfunction" class="category-item cat-box-3">
              <img src="https://myglobal1.gumlet.io/category-images/ed.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">ED</h3> -->
            </a>
          </div>
          <div class="group">
            <a onclick="setSession(3,'gastrointestinal-medication')" id="gastrointestinal-medication" class="category-item cat-box-4">
              <img src="https://myglobal1.gumlet.io/category-images/gas.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">GAS</h3> -->
            </a>
            <a onclick="setSession(3,'hair-care')" id="hair-care" class="category-item cat-box-4">
              <img src="https://myglobal1.gumlet.io/category-images/Hair-Care.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Hair Care</h3> -->
            </a>
            <a onclick="setSession(3,'heart-medication')" id="heart-medication" class="category-item cat-box-4">
              <img src="https://myglobal1.gumlet.io/category-images/Heart-Medication.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Heart Medication</h3> -->
            </a>
            <a onclick="setSession(3,'herbal-medication')" id="herbal-medication" class="category-item cat-box-4">
              <img src="https://myglobal1.gumlet.io/category-images/Herbal-Medication.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Herbal Medication</h3> -->
            </a>
          </div>
          <div class="group">
            <a onclick="setSession(4,'hiv-meds')" id="hiv-meds" class="category-item cat-box-5">
              <img src="https://myglobal1.gumlet.io/category-images/hiv.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">HIV</h3> -->
            </a>
            <a onclick="setSession(4,'injectable-steroidsmens-health-care')" id="injectable-steroidsmens-health-care" class="category-item cat-box-5">
              <img src="https://myglobal1.gumlet.io/category-images/Injectable-Steroids.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Injectable Steroids</h3> -->
            </a>
            <a onclick="setSession(4,'mens-health-care')" id="mens-health-care" class="category-item cat-box-5">
              <img src="https://myglobal1.gumlet.io/category-images/Mens-Health-Care.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Mens Health Care</h3> -->
            </a>
            <a onclick="setSession(4,'oral-steroids')" id="oral-steroids" class="category-item cat-box-5">
              <img src="https://myglobal1.gumlet.io/category-images/Oral-Steroids.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Oral Sterioids</h3> -->
            </a>
          </div>
          <div class="group">
            <a onclick="setSession(5,'pain-medication')" id="pain-medication" class="category-item cat-box-6">
              <img src="https://myglobal1.gumlet.io/category-images/Pain.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Pain</h3> -->
            </a>
            <a onclick="setSession(5,'skincare-')" id="skincare-" class="category-item cat-box-6">
              <img src="https://myglobal1.gumlet.io/category-images/Skin-Care.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Skin Care</h3> -->
            </a>
            <a onclick="setSession(5,'sleeping-pills')" id="sleeping-pills" class="category-item cat-box-6">
              <img src="https://myglobal1.gumlet.io/category-images/Sleeping-Pills.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Sleeping Pills</h3> -->
            </a>
            <a onclick="setSession(5,'somatropin-h-g-h')" id="somatropin-h-g-h" class="category-item cat-box-6">
              <img src="https://myglobal1.gumlet.io/category-images/Somatropin-H-G-H.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Somatropin H G H</h3> -->
            </a>
          </div>
          <div class="group">
            <a onclick="setSession(6,'weight-loss-pills')" id="weight-loss-pills" class="category-item cat-box-7">
              <img src="https://myglobal1.gumlet.io/category-images/Weight-Loss.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Weight Loss</h3> -->
            </a>
            <a onclick="setSession(6,'womens-health-care')" id="womens-health-care" class="category-item cat-box-7">
              <img src="https://myglobal1.gumlet.io/category-images/Womens-Health-Care.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Womens Health Care</h3> -->
            </a>
            <a onclick="setSession(6,'other')" id="other" class="category-item cat-box-7">
              <img src="https://myglobal1.gumlet.io/category-images/Others.png?w=158" alt="" srcset="">
              <!-- <h3 class="catname">Others</h3> -->
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials">
    <div class="inner-testimonials">
      <div class="col-12">
        <h2 class="heading">Customer's Review</h2>
      </div>
      <div class="review_section">
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="service-tab" data-bs-toggle="tab" data-bs-target="#service-tab-pane" type="button" role="tab" aria-controls="service-tab-pane" aria-selected="true">Service Review</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="false">Product Review</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="website-tab" data-bs-toggle="tab" data-bs-target="#website-tab-pane" type="button" role="tab" aria-controls="website-tab-pane" aria-selected="false">Website Review</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="overall-tab" data-bs-toggle="tab" data-bs-target="#overall-tab-pane" type="button" role="tab" aria-controls="overall-tab-pane" aria-selected="false" >Overall Review</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="service-tab-pane" role="tabpanel" aria-labelledby="service-tab" tabindex="0">
                  <div class="m_container ">
                    <div class="owl-carousel review-carousel">
                    <?php
                        $service_review = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id DESC limit 10');
                        $service_review->execute(['Service Review' ,'Approved']);
                        $count = $service_review->RowCount();
                        $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row_service_review as $review_rating_row){
                          $old_date = new DateTime($review_rating_row['date']);
                          $now = new DateTime(Date('Y-m-d'));
                          $interval = $old_date->diff($now);
                          $year_ago = $interval->y;
                          $month_ago = $interval->m;
                          $days_ago = $interval->d;
                          $hours_ago = $interval->h;
                          $minutes_ago = $interval->i;
                          $seconds_ago = $interval->s;
                          
                          if($year_ago==0){
                            $set_date= $month_ago." Months Ago";
                          }if($month_ago==0){
                            $set_date= $days_ago." Days Ago";
                          }if($days_ago==0){
                            $set_date= $hours_ago." Hours Ago";
                          }if($hours_ago==0){
                            $set_date= $minutes_ago." Minutes Ago";
                          }?>  
                    <div class="review_card">
                        <div class="header">
                            <img src="image/review/pr1.png" alt="">
                            <div class="reviewer_info">
                                <h2><?php echo $review_rating_row['username'] ?></h2>
                                <div class="mt-3">
                                    <!-- <span>Existing Users</span> -->
                                    <span> <?php echo $review_rating_row['state'] ?>, <?php echo $review_rating_row['country'] ?></span><span><?php echo $set_date ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <p><?php echo $review_rating_row['review'] ?></p>
                        </div>
                        
                        <div class="footer">
                         <?php $rating = $review_rating_row['rating'];
                              if($rating==1){ ?>
                        <img src="./image/review/star.png">
                          <?php }elseif($rating==2){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==3){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                           <img src="./image/review/star.png">                          
                          <?php }elseif($rating==4){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==5){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <?php } ?>




                        </div>

                    </div>
        <?php } ?>

                    </div>
                    </div>
                    <div class="d-flex justify-content-center">
                       <a  href="review">                    <button class="btn view_all_review d-none">
                        View all reviews
                    </button></a>     
                    </div>
                </div>
                <div class="tab-pane fade" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                <div class="m_container ">
                    <div class="owl-carousel review-carousel">
                    <?php
                        $service_review = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id DESC limit 10');
                        $service_review->execute(['Product Review' ,'Approved']);
                        $count = $service_review->RowCount();
                        $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row_service_review as $review_rating_row){
                          $old_date = new DateTime($review_rating_row['date']);
                          $now = new DateTime(Date('Y-m-d'));
                          $interval = $old_date->diff($now);
                          $year_ago = $interval->y;
                          $month_ago = $interval->m;
                          $days_ago = $interval->d;
                          $hours_ago = $interval->h;
                          $minutes_ago = $interval->i;
                          $seconds_ago = $interval->s;
                          
                          if($year_ago==0){
                            $set_date= $month_ago." Months Ago";
                          }if($month_ago==0){
                            $set_date= $days_ago." Days Ago";
                          }if($days_ago==0){
                            $set_date= $hours_ago." Hours Ago";
                          }if($hours_ago==0){
                            $set_date= $minutes_ago." Minutes Ago";
                          }?>  
                    <div class="review_card">
                        <div class="header">
                            <img src="image/review/pr1.png" alt="">
                            <div class="reviewer_info">
                                <h2><?php echo $review_rating_row['username'] ?></h2>
                                <div class="mt-3">
                                    <!-- <span>Existing Users</span> -->
                                    <span> <?php echo $review_rating_row['state'] ?>, <?php echo $review_rating_row['country'] ?></span><span><?php echo $set_date ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <p><?php echo $review_rating_row['review'] ?></p>
                        </div>
                        <div class="footer">
                        <?php $rating = $review_rating_row['rating'];
                              if($rating==1){ ?>
                        <img src="./image/review/star.png">
                          <?php }elseif($rating==2){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==3){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                           <img src="./image/review/star.png">                          
                          <?php }elseif($rating==4){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==5){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <?php } ?>
                        </div>
                    </div>
        <?php } ?>

                    </div>
                    </div>
                    <div class="d-flex justify-content-center d-none">
                    <a  href="review"> <button class="btn view_all_review">
                        View all reviews
                    </button></a>
                    </div>
                </div>
                <div class="tab-pane fade" id="website-tab-pane" role="tabpanel" aria-labelledby="website-tab" tabindex="0">
                <div class="m_container ">
                    <div class="owl-carousel review-carousel">
                    <?php
                        $service_review = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id DESC limit 10');
                        $service_review->execute(['Website Review' ,'Approved']);
                        $count = $service_review->RowCount();
                        $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row_service_review as $review_rating_row){
                          $old_date = new DateTime($review_rating_row['date']);
                          $now = new DateTime(Date('Y-m-d'));
                          $interval = $old_date->diff($now);
                          $year_ago = $interval->y;
                          $month_ago = $interval->m;
                          $days_ago = $interval->d;
                          $hours_ago = $interval->h;
                          $minutes_ago = $interval->i;
                          $seconds_ago = $interval->s;
                          
                          if($year_ago==0){
                            $set_date= $month_ago." Months Ago";
                          }if($month_ago==0){
                            $set_date= $days_ago." Days Ago";
                          }if($days_ago==0){
                            $set_date= $hours_ago." Hours Ago";
                          }if($hours_ago==0){
                            $set_date= $minutes_ago." Minutes Ago";
                          }?>  

                    <div class="review_card">
                        <div class="header">
                            <img src="image/review/pr1.png" alt="">
                            <div class="reviewer_info">
                                <h2><?php echo $review_rating_row['username'] ?></h2>
                                <div class="mt-3">
                                    <!-- <span>Existing Users</span> -->
                                    <span> <?php echo $review_rating_row['state'] ?>, <?php echo $review_rating_row['country'] ?></span><span><?php echo $set_date ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <p><?php echo $review_rating_row['review'] ?></p>
                        </div>
                        <div class="footer">

                        <?php $rating = $review_rating_row['rating'];
                              if($rating==1){ ?>
                        <img src="./image/review/star.png">
                          <?php }elseif($rating==2){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==3){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                           <img src="./image/review/star.png">                          
                          <?php }elseif($rating==4){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==5){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <?php } ?>

                        </div>
                    </div>
        <?php } ?>

                    </div>
                    </div>
                    <div class="d-flex justify-content-center d-none">
                    <a  href="review"><button class="btn view_all_review">
                        View all reviews
                    </button></a>
                    </div>
                </div>
                <div class="tab-pane fade" id="overall-tab-pane" role="tabpanel" aria-labelledby="overall-tab" tabindex="0">
                <div class="m_container ">
                    <div class="owl-carousel review-carousel">
                    <?php
                        $service_review = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id DESC limit 10');
                        $service_review->execute(['Overall Review' ,'Approved']);
                        $count = $service_review->RowCount();
                        $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row_service_review as $review_rating_row){
                          $old_date = new DateTime($review_rating_row['date']);
                          $now = new DateTime(Date('Y-m-d'));
                          $interval = $old_date->diff($now);
                          $year_ago = $interval->y;
                          $month_ago = $interval->m;
                          $days_ago = $interval->d;
                          $hours_ago = $interval->h;
                          $minutes_ago = $interval->i;
                          $seconds_ago = $interval->s;
                          
                          if($year_ago==0){
                            $set_date= $month_ago." Months Ago";
                          }if($month_ago==0){
                            $set_date= $days_ago." Days Ago";
                          }if($days_ago==0){
                            $set_date= $hours_ago." Hours Ago";
                          }if($hours_ago==0){
                            $set_date= $minutes_ago." Minutes Ago";
                          }?>  

                    <div class="review_card">
                        <div class="header">
                            <img src="image/review/pr1.png" alt="">
                            <div class="reviewer_info">
                                <h2><?php echo $review_rating_row['username'] ?></h2>
                                <div class="mt-3">
                                    <!-- <span>Existing Users</span> -->
                                    <span> <?php echo $review_rating_row['state'] ?>, <?php echo $review_rating_row['country'] ?></span><span><?php echo $set_date ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <p><?php echo $review_rating_row['review'] ?></p>
                        </div>
                        <div class="footer">
                        <?php $rating = $review_rating_row['rating'];
                              if($rating==1){ ?>
                        <img src="./image/review/star.png">
                          <?php }elseif($rating==2){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==3){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                           <img src="./image/review/star.png">                          
                          <?php }elseif($rating==4){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                          <?php }elseif($rating==5){ ?>
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <img src="./image/review/star.png">
                            <?php } ?>
                        </div>
                    </div>
        <?php } ?>

                    </div>
                    </div>
                    <div class="d-flex justify-content-center d-none">
                    <a  href="review"><button class="btn view_all_review">
                        View all reviews
                    </button></a>
                    </div>
                </div>
              </div>
            
        </div>
    </div>
  </section>

  <div class="container-fluid home-faq1 faq-desk">
    <h2 class="heading">Read Our FAQ's</h2>
    <div class="accordion accordion-flush" id="accordionFlushExample">

      <?php
      $i = 0;
      $selectCat = $conn->prepare('SELECT * from faqscategories WHERE primacy=0');
      $selectCat->execute();
      while ($row = $selectCat->fetch(PDO::FETCH_ASSOC)) {
        ++$i;
        $name = $row['name'];
        $id = $row['id'];
        $image = $row['image'];
        $slug = $row['slug'];
        if ($i == 1) {
          $bsta = '';
          $bodysta = 'show';
        } else {
          $bsta = 'collapsed';
          $bodysta = '';
        }
        $selectSubCat1 = $conn->prepare("SELECT * from faqscategories WHERE primacy='" . $id . "'");
        $selectSubCat1->execute();
        $countSub = $selectSubCat1->rowCount();
        if ($countSub > 0) {
      ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
              <button class="accordion-button <?php echo $bsta; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i ?>" aria-expanded="true" aria-controls="flush-collapse<?php echo $i ?>">
                <img src="cat-image/faq-tab-desk.png" style="width:100%;">
                <img src="https://myglobal1.gumlet.io/cat-image/icon/<?php echo $image; ?>?w=36" class="faq-icon">
                <h3 class="accord-title"><?php echo $name; ?></h3>
              </button>
            </h2>
            <div class="accordion-collapse collapse <?php echo $bodysta; ?>" id="flush-collapse<?php echo $i ?>" aria-labelledby="flush-heading<?php echo $i ?>" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <?php
                $selectSubCat = $conn->prepare("SELECT * from faqscategories WHERE primacy='" . $id . "'");
                $selectSubCat->execute();
                while ($rowSub = $selectSubCat->fetch(PDO::FETCH_ASSOC)) {
                  $names = $rowSub['name'];
                  $ids = $rowSub['id'];
                  $slugs = $rowSub['slug'];
                ?>
                  <a class="accord-link" href="faq/<?php echo $slug . '/' . $slugs; ?>">
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
        } else {
        ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
              <a class="accordion-button <?php echo $bsta; ?>" href="faq/<?php echo $slug; ?>">
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
  <div class="container-fluid home-faq1 faq-mob">
    <h2 class="heading">Read Our FAQ's</h2>
    <div class="accordion accordion-flush" id="accordionFlushExample">

      <?php
      $i = 0;
      $selectCat = $conn->prepare('SELECT * from faqscategories WHERE primacy=0');
      $selectCat->execute();
      while ($row = $selectCat->fetch(PDO::FETCH_ASSOC)) {
        ++$i;
        $name = $row['name'];
        $id = $row['id'];
        $image = $row['image'];
        $slug = $row['slug'];
        if ($i == 1) {
          $bsta = '';
          $bodysta = 'show';
        } else {
          $bsta = 'collapsed';
          $bodysta = '';
        }
        $selectSubCat1 = $conn->prepare("SELECT * from faqscategories WHERE primacy='" . $id . "'");
        $selectSubCat1->execute();
        $countSub = $selectSubCat1->rowCount();
        if ($countSub > 0) {
      ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
              <button class="accordion-button <?php echo $bsta; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i ?>" aria-expanded="true" aria-controls="flush-collapse<?php echo $i ?>">
                <img src="cat-image/faq-tag.png" style="width:100%;">
                <img src="https://myglobal1.gumlet.io/cat-image/icon/<?php echo $image; ?>?w=36" class="faq-icon">
                <h3 class="accord-title"><?php echo $name; ?></h3>
              </button>
            </h2>
            <div class="accordion-collapse collapse <?php echo $bodysta; ?>" id="flush-collapse<?php echo $i ?>" aria-labelledby="flush-heading<?php echo $i ?>" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <?php
                $selectSubCat = $conn->prepare("SELECT * from faqscategories WHERE primacy='" . $id . "'");
                $selectSubCat->execute();
                while ($rowSub = $selectSubCat->fetch(PDO::FETCH_ASSOC)) {
                  $names = $rowSub['name'];
                  $ids = $rowSub['id'];
                  $slugs = $rowSub['slug'];
                ?>
                  <a class="accord-link" href="faq/<?php echo $slug . '/' . $slugs; ?>">
                    <img src="cat-image/faq-tag.png" style="width:100%;">
                    <h3 class="accord-title"><?php echo $names; ?></h3>
                    <i class="fa-solid fa-arrow-right sub-arrow-mob"></i>
                  </a>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        <?php
        } else {
        ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading<?php echo $i ?>">
              <a class="accordion-button <?php echo $bsta; ?>" href="faq/<?php echo $slug; ?>">
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

  <?php include('include/footer.php'); ?>
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


  <script type="text/javascript">
    // $(window).on('load', function() {
    //   if (<?php echo $_SESSION['offerseen'] ?> == 0) {
    //     $('#offerPopup').modal('show');
    //   }
    // });

    $('.offerbox').on('click', function() {
      $(this).addClass('active');
      <?php $_SESSION['offerseen'] = 1 ?>
    });
    // watch now
    $('.watch-now').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
  </script>