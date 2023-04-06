<?php
$productSeoTitle = "Contact";
$productSeoDescription = "Contact";
include('include/header.php');
?>
<?php include('include/sidenav.php'); ?>
<div class="contactus_main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-12 p-0">
                    <div class="infosection_main">
                        <p class="topinfo1">Get in touch with us</p>
                        <p class="topinfo2">We’d love to hear from you and we know your time
                            is valuable. Our friendly team is always here to help you.
                        </p>
                        <div class="common_section d-flex">
                            <img src="image/contact/CallBlue.png" alt="">
                            <div class="common_info">
                                <p class="title">Phone</p>
                                <p class="info mb-3">Got a question? Contact us 24/7</p>
                                <div>
                                <div id="slider2" class="col-10 slideToUnlock locked">
                  <div class="progressBar unlocked"></div><div class="text">+1 315 215 3483</div><div class="drag locked_handle ">  </div><div class="progressBar unlocked"></div><div class="text">+1 315 215 3483</div><div class="drag locked_handle ">  </div></div>
                                </div>
                            </div>
                        </div>
                        <div class="common_section d-flex">
                            <img src="image/contact/ChatBlue.png" alt="">
                            <div class="common_info">
                                <p class="title">Chat</p>
                                <p class="info">Our Friendly team is hear to help you</p>
                            </div>
                        </div>
                        <div class="common_section d-flex">
                            <img src="image/contact/QueryBlue.png" alt="">
                            <div class="common_info">
                                <p class="title">Query</p>
                                <p class="info">Got some question for us? We got you</p>
                            </div>
                        </div>
                        <div class="common_section d-flex">
                            <img src="image/contact/MailBlue.png" alt="">
                            <div class="common_info">
                                <p class="title">Mail</p>
                                <p class="info">Our friendly team is here to help you</p>
                                <p class="d-none d-lg-block"><a href="">support@newlandpharmacy.co.uk</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-12 p-0">
                    <div class="form_section">
                        <p class="fs_p1">Contact us</p>
                        <p class="fs_p2">Give us a call <span>@ +1 (315) 515 4364</span></p>
                        <span class="fs_sp1">or</span>
                        <p class="fs_p3">You can reach us anytime via <span>@support@newlandpharmacy.com</span></p>
                        <div class="form_main">
                            <p class="fs_fill">Fill out this form:</p>
                            <form>
                                <div class="row mb-3">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-floating mb-3 mt-3">
                                            <input type="text" class="form-control" placeholder="Enter First Name"
                                                name="FirstName">
                                            <label for="">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-floating mb-3 mt-3">
                                            <input type="text" class="form-control" placeholder="Enter Last Name"
                                                name="LastName">
                                            <label for="">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                               <div class="row">
                               <div class="col">
                                 <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email"
                                        name="email">
                                    <label for="email">Email</label>
                                </div>
                               </div> 
                               </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-floating mb-3 mt-3">
                                            <input type="text" class="form-control" placeholder="Enter contact"
                                                name="contact">
                                            <label for="">Contact Number</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-floating mb-3 mt-3">
                                            <input type="text" class="form-control" placeholder="Enter Region"
                                                name="Region">
                                            <label for="">Region</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col">
                                  <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email"
                                        name="query">
                                    <label for="query">Query Type</label>
                                </div>
                                <div class="form-floating mt-5 mb-4">
                                    <textarea class="form-control" id="comment" name="text" placeholder="Comment goes here" rows="4"></textarea>
                                    <label for="comment">Message</label>
                                  </div>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('include/sidenav.php'); ?>
<?php include('include/footer.php'); ?>