<?php
$productSeoTitle = "user";
$productSeoDescription = "user";
include('include/header.php');
?>
<?php include('include/sidenav.php'); ?>
<div class="user_section single-product-section">
    <div class="bread-crumb">
        <div class="home-link">
            <a href=""><img src="image/home-bread.png" srcset=""></a>
        </div>
        <div class="category-link">
            <img src="image/category-bread.png" alt="" srcset="">
            <p style="width:85px;" class="text-placeholder">Profile</p>
        </div>
    </div>
    <div class="content-area">
        <div class="user_banner">
            <img src="image/user/user-banner.png" class="d-none d-md-block" alt="user-banner">
            <img src="image/user/Mask-group.png" class="d-md-none" alt="user-banner">
        </div>
        <div class="user-dtl">
        <div class="top-user-name d-md-none">
                Abram Dorwart <span>(abramdorwart@gamil.com)</span>
                </div>
            <div class="user-name">
                <div class="name">
                    DA
                    <button class="edit-btn mob"><i class="fa-solid fa-pencil"></i></button>
                </div>
            </div>
            <div class="user-desc">
                <div class="line-1 d-none d-md-block">
                Abram Dorwart <span>(abramdorwart@gamil.com)</span>
                </div>
                <div class="line-2">
                    <input type="text" value="3254 Jarvis Street, Buffalo, United Stae, Washington DC, New York">
                    </input>
                    <button class="edit-btn"><i class="fa-solid fa-pencil"></i></button>
                </div>
                <div class="line-3">
                    <p class="orders common"><span>Total orders:</span><span class="num">4</span></p>
                    <p class="savings common"><span>Total savings:</span><span class="num">$213</span></p>
                    <p class="Wishlist common"><span>Item In Wishlist:</span><span class="num">$213</span></p>
                </div>
                <div class="line-4">
                    <button class="order-btn"><i class="fa-solid fa-bag-shopping mx-2"></i>Your Orders</button>
                    <button class="wishlist-btn">Wishlist</button>
                </div>
            </div>
        </div>
    </div>
    <div class="user_products">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="product_card">
                    <img src="./image/tablet-bg.png" class="tablet-bg1">
                        <img src="./image/tablet-bg.png" class="tablet-bg2">
                        <img src="./image/plus-bg.png" class="plus-bg">
                        <div class="product_invoice">
                                <p>#INV-8756HG56409</p>
                                <p>11-Nov-2022</p>
                        </div>
                        <div class="product_name">
                            <p>Alprazolam</p>
                            <p>$341.06</p>
                        </div>
                        <div class="product_info">
                            <p>Quantity: <span>180</span></p>
                            <p>Strength: <span>2mg</span></p>
                        </div>
                        <div class="product_details">
                            <div class="inner_container">
                            <span>Order Status</span>
                            <p>Shipped</p>
                            </div>
                            <div class="inner_container">
                            <span>Delivery Type</span>
                            <p>USA Premium</p>
                            </div>
                        </div>
                        <div class="product_actions">
                            <button class="reorder">
                            Reorder
                            </button>
                            <button class="view_details">
                            View Details
                            </button>
                            <button class="cancel">
                            Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/sidenav.php'); ?>
<?php include('include/footer.php'); ?>