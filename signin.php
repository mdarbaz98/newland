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
    <main class="offcanvas-enabled" style="padding-top: 94px; background: #ebecef;">

        <div class="container">
            <div class="row" style="background: #fff;margin: 32px 0;padding: 28px 28px;">
                <div class="col-lg-6 col-12">
                    <form autocomplete="off" novalidate id="signin-tab1">
                      <div class="uniError labelError text-center mb-2"></div>
                      <div class="mb-3">
                        <input type="hidden" value="signin" name="btn">
                        <label class="form-label" for="si-email">Email address</label>
                        <input class="form-control" type="email" id="si-email" name="email" placeholder="Enter Email">
                        <div class="emailError labelError"></div>
                      </div>
                      <div class="cardOTP1 p-2 text-center">
                        <div class="otp-success"> <span>A code has been sent to email</span></div>
                        <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
                            <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp2')" type="text" id="otp1" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp3')" type="text" id="otp2" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp4')" type="text" id="otp3" maxlength="1" /> 
                            <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp5')" type="text" id="otp4" maxlength="1" />
                        </div>
                        <div class="otpError labelError"></div>
                        <p class="text-center password-login1">Login With Password</p>
                        
                       </div>
                        <div class="password-section1">
                          <div class="mb-3">
                            <label class="form-label" for="si-password">Password</label>
                            <div class="password-toggle">
                              <input class="form-control" type="password" id="si-password"  name="password" placeholder="Enter Password">
                              <label class="password-toggle-btn" aria-label="Show/hide password">
                              </label>
                              <div class="passwordError labelError"></div>
                            </div>
                          </div>
                          <p class="text-center otp-login1">Login With OTP</p>
                        </div>
                        <button type="submit" class="btn btn-primary btn-shadow d-block w-100 buttonCart" id="signinbtn">
                            <span class="button__text">Sign In</span>
                        </button>
                    </form>
                </div>
                <div class="col-lg-6 col-12">
                    <form autocomplete="off" id="signup-tab1">
                      <div class="row">
                        <input type="hidden" value="signup" name="btn">
                        <div class="col-md-6 mb-3">
                          <label for="" class="form-label">First name</label>
                          <input class="form-control" type="text" name="fname" id="fname" placeholder="First name">
                          <div class="fError labelError"></div>
                          <!--<div class="valid-feedback">Looks good!</div>-->
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="" class="form-label">Last name</label>
                          <input class="form-control" type="text" name="lname" id="lname" placeholder="Last name">
                          <div class="lError labelError"></div>
                          <!--<div class="valid-feedback">Looks good!</div>-->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label for="" class="form-label">Email</label>
                          <input class="form-control" type="email" name="email" id="email"  placeholder="Email Address">
                          <div class="eError labelError"></div>
                          <!--<div class="valid-feedback">Looks good!</div>-->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label for="" class="form-label">Password</label>
                          <input class="form-control" type="password" name="password" id="password"  placeholder="Enter Password">
                          <div class="passError labelError"></div>
                          <!--<div class="valid-feedback">Looks good!</div>-->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <label for="" class="form-label">Phone</label>
                          <input class="form-control tel" 
                          type="tel" id="phone" name="phone" id="phone" inputmode="tel" value="" />
                          <div class="pError labelError"></div>
                          <!--<div class="valid-feedback">Looks good!</div>-->
                        </div>
                      </div>
                      <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>  
    
      


      <?php include('include/footer.php'); ?>