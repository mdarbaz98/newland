<?php
$userid = $_COOKIE["userID"];
include('include/header.php');
include('include/sidenav.php'); ?>
<div class="checkout__page">
    <section class="gridmain_container">
        <div class="grid-container main-grid">
            <div class="grid-item outer_item2 mobile-user-add d-md-none">
                <div class="add_sec">
                    <img class="img1" src="image/cartImages/card texture1.png" alt="">
                    <img class="img2" src="image/cartImages/card texture2.png" alt="">
                    <div class="profile_picdiv1 d-flex justify-content-between align-items-center">
                        <div class="profile_pic">
                            <p class="d-flex justify-content-center align-items-center">ER
                            </p>
                        </div>
                        <div class="profile_name">
                            <p>Emerson Rosser</p>
                        </div>
                        <button class="d-flex justify-content-center align-items-center">
                            <a href="#signin-modal" data-bs-toggle="modal"><img src="image/cartImages/pencil.png" alt="edit_pencil"></a>
                        </button>
                    </div>
                    <div class="profile_picdiv2 d-flex justify-content-between align-items-center">
                        <div class="profile_add">
                            <p>Lorem Ipsum is simply dummy text Lorem Ipsum</p>
                            <p>sample@mail.com</p>
                        </div>
                        <button class="d-flex justify-content-center align-items-center">
                            <img src="image/cartImages/delete.png" alt="">
                        </button>
                    </div>
                    <div class="gap-2 add_address align-items-center d-flex justify-content-around align-items-between">
                        <i class="fa-solid fa-plus"></i>
                        <p class="mb-0" onclick="addUserAddress()">Add</p>
                    </div>
                </div>
            </div>
            <div class="grid-item outer_item1">
                <form id="checkoutForm">
                <div class="total mb-md-3">
                <p>Total Item(<span class="cart_total_product"></span>)</p>
                </div>

                <div class="usercartList"></div>

                <div class="empty_cart">
                    <button onclick="emptyCartproduct()">Empty Cart</button>
                </div>
                <div class="budget desk-budget d-none d-md-block">
                    <p>Still Not in Budget ? Click Below</p>
                    <div class="icons d-flex justify-content-evenly align-items-center">
                        <div class="call_icon"></div>
                        <div class="chat_icon"></div>
                    </div>
                </div>
            </div>
            <!-- <div class="grid-item outer_item3">
                    
                </div> -->
            <div class="add-bill-div gap-5 d-flex flex-column">
            <div class="allAddressList_new"></div>


                <div class="grid-item outer_item4">
                    <div class="product-calculation">
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
                        </div>
                        <div class="offerapplied_main d-flex justify-content-between align-items-center">
                            <div class="offer-applied">
                                <span class="discount discount_price"></span>
                                <p class="dis-text">
                                    Applied
                                    <span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>
                                </p>
                            </div>
                            <div class="remove">
                                <a href="">Remove</a>
                            </div>
                        </div>

                        <div class="product_calculation"></div>

                    </div>
                    <div class="purchase_btn">
                            <button type="sumit" onclick="placeOrder_registerUser()">Confirm Purchase</button>


                    </div>
    </form>

                    <!-- <div class="purchase_btn">
                        <button onclick="addUserAddress()">Confirm Purchase</button>
                    </div> -->
                     

                    
                    <div class="email_btn">
                        <button>
                            <img src="image/cartImages/email.png" alt="" />
                            <p>Send This Price on <span>Mail or SMS</span></p>
                        </button>
                    </div>
                    <div class="budget mobil-budget mt-4 d-md-none">
                        <p>Still Not in Budget ? Click Below</p>
                        <div class="icons d-flex justify-content-evenly align-items-center">
                            <div class="call_icon"></div>
                            <div class="chat_icon"></div>
                        </div>
                    </div>
                    <div class="assured_secure_section d-md-flex justify-content-evenly align-items-center d-none">
                        <div class="assured">
                            <p>100% Assured Product</p>
                            <img src="image/cartImages/Assured.png" alt="" />
                        </div>
                        <div class="assured">
                            <p>100% Assured Product</p>
                            <img src="image/cartImages/Secure Payment.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- suggested products  -->
    <section>

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


    </section>
    <!-- one touch ingo  -->
    <section class="container-fluid onetouch__section py-5">
        <div class="onetouch-heading">One Touch Information</div>
        <div class="onetouch-contaienr">
            <div class="box-content">
                <div class="box">
                    <img src="./call.png" alt="icon-img">
                    <p class="mb-0">Cheap1 Rates</p>
                    <i class="fa-solid fa-right-long"></i>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="box-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam ut magnam sequi sunt voluptatum eius illo iure pariatur doloribus, consectetur corrupti id nostrum cumque vitae, odio minima accusamus voluptatem quas?
                </div>
            </div>
            <div class="box-content">
                <div class="box">
                    <img src="./call.png" alt="icon-img">
                    <p class="mb-0">Cheap2 Rates</p>
                    <i class="fa-solid fa-right-long"></i>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="box-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam ut magnam sequi sunt voluptatum eius illo iure pariatur doloribus, consectetur corrupti id nostrum cumque vitae, odio minima accusamus voluptatem quas?
                </div>
            </div>
            <div class="box-content">
                <div class="box">
                    <img src="./call.png" alt="icon-img">
                    <p class="mb-0">Cheap3 Rates</p>
                    <i class="fa-solid fa-right-long"></i>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="box-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam ut magnam sequi sunt voluptatum eius illo iure pariatur doloribus, consectetur corrupti id nostrum cumque vitae, odio minima accusamus voluptatem quas?
                </div>
            </div>
            <div class="box-content">
                <div class="box">
                    <img src="./call.png" alt="icon-img">
                    <p class="mb-0">Cheap4 Rates</p>
                    <i class="fa-solid fa-right-long"></i>
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="box-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam ut magnam sequi sunt voluptatum eius illo iure pariatur doloribus, consectetur corrupti id nostrum cumque vitae, odio minima accusamus voluptatem quas?
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="strength_modal">
        <div class="modal fade" id="cartProduct_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title title product_cart_name" id="exampleModalLabel">
                            Poxet-30<span>(Dapoxitine)</span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal_inner_body">
                            <p>Choose Strength</p>
                            
                            <ul class="nav nav-tabs strength-section" id="productTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="strength-tab" data-bs-toggle="tab" data-bs-target="#strength" type="button" role="tab" aria-controls="strength" aria-selected="true">strength</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="strength2-tab" data-bs-toggle="tab" data-bs-target="#strength2" type="button" role="tab" aria-controls="strength2" aria-selected="false">strength2</button>
                                </li>

                            </ul>
                            <p>select number of pills</p>
                            <div class="tab-content" id="productTabContent">
                                <div class="tab-pane fade show active numberofpills11" id="strength" role="tabpanel" aria-labelledby="strength-tab">
                                    <div class="qty-container">

                                    <div class="qty-per-pill">
                                        <div class="str">30</div>
                                        <div class="qty"><p>$1.02/pill</p><p>$26.01</p></div>
                                    </div>


                                    <div class="qty-per-pill">
                                        <div class="str">30</div>
                                        <div class="qty"><p>$1.02/pill</p><p>$26.01</p></div>
                                    </div>
                                    
                                    <div class="qty-per-pill">
                                        <div class="str">30</div>
                                        <div class="qty"><p>$1.02/pill</p><p>$26.01</p></div>
                                    </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="strength2" role="tabpanel" aria-labelledby="strength2-tab">.2..</div>
                            </div>
                            
                            <div class="details_div">
                                <p>Details</p>
                                <div class="details">
                                    <div class="product-calculation">
                                        
                                        <div class="round-shape-right">
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
                                        </div>

                                        <div class="pill-strength-calculation">

                                        
                                        <!-- <div class="calculation">
                                            <div class="list">
                                                <span class="title">Pill Strength</span>
                                                <span class="value ogprice">$27.59</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Pill Quantity</span>
                                                <span class="value shippingCharges"><span class="success-icon"></span>Free</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Per pill cost</span>
                                                <span class="value save-value">$4.22</span>
                                            </div>
                                            <div class="list" style="border: none">
                                                <span class="total">To Pay</span>
                                                <span class="value finalprice">$23.12</span>
                                            </div>
                                        </div> -->


                                    </div>


                                    </div>
                                </div>
                            </div>
                            <div class="confirm_btn">
                                <button onclick="edit_cartProduct()">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>