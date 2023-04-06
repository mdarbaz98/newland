Skip to content
Search or jump to…
Pull requests
Issues
Marketplace
Explore
 
@sandeepparekh 
sandeepparekh
/
globalpharma
Private
Code
Issues
Pull requests
Actions
Projects
Security
Insights
Settings
globalpharma/include/header.php /
@sandeepparekh
sandeepparekh Add to Cart
Latest commit 1ecf2bc on Jul 13
 History
 1 contributor
1506 lines (1406 sloc)  88.6 KB

<?php
  session_start();
  error_reporting(0);
  include('include/database.php');  
  include('function.php'); 
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
      $ipaddress = getenv('HTTP_CLIENT_IP');
  else if(getenv('HTTP_X_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if(getenv('HTTP_X_FORWARDED'))
      $ipaddress = getenv('HTTP_X_FORWARDED');
  else if(getenv('HTTP_FORWARDED_FOR'))
      $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if(getenv('HTTP_FORWARDED'))
      $ipaddress = getenv('HTTP_FORWARDED');
  else if(getenv('REMOTE_ADDR'))
      $ipaddress = getenv('REMOTE_ADDR');
  else
      $ipaddress = 'UNKNOWN';
  $details = json_decode(file_get_contents("https://api.ipdata.co/?api-key=f75623ed19b1b11bd2bb08de6649354ee410131cdf5abf2eb6bbed29"));
  $ar = (array)$details;
  $ar2 = (array)$ar['currency'];
    
  $ip = $ar['ip'];
  $code = $ar2['code'];
  $symbol = $ar2['native'];
  if($code=='INR'){
      $code = "USD";
      $symbol = "$";
  }

  

  if(!isset($_SESSION["currency_rate"])){
    if($_SESSION['currency']==$code){
      $details = json_decode(file_get_contents("https://api.currencyapi.com/v3/convert?apikey=DhVYwUSFNki3WH3lSiMmqF62yXhCiya1cE0YijAs&value=1&base_currency=USD&currencies=$code"));
      $currency = (array)$details->data->$code->value;
      $rate = ($currency[0]);
      $_SESSION['currency']=$code;
      $_SESSION["currency_rate"] = $rate;
      $_SESSION["currency_symbol"] = $symbol;
    }elseif($_SESSION['currency']!=$code) {
      $details = json_decode(file_get_contents("https://api.currencyapi.com/v3/convert?apikey=DhVYwUSFNki3WH3lSiMmqF62yXhCiya1cE0YijAs&value=1&base_currency=USD&currencies=$code"));
      $currency = (array)$details->data->$code->value;
      $rate = ($currency[0]);
      $_SESSION['currency']=$code;
      $_SESSION["currency_rate"] = $rate;
      $_SESSION["currency_symbol"] = $symbol;
    }  
  }

  // if(strlen($_SESSION['currency'])<2){
  //   $code='USD';
  //   $symbol='$';
  //   $details = json_decode(file_get_contents("https://api.currencyapi.com/v3/convert?apikey=DhVYwUSFNki3WH3lSiMmqF62yXhCiya1cE0YijAs&value=1&base_currency=USD&currencies=$code"));
  //     $currency = (array)$details->data->$code->value;
  //     $rate = ($currency[0]);
  //     $_SESSION['currency']=$code;
  //     $_SESSION["currency_rate"] = $rate;
  //     $_SESSION["currency_symbol"] = $symbol;
  // }
  $_SESSION['currency']='USD';
  $_SESSION["currency_rate"] = '1';
  $_SESSION["currency_symbol"] = '$';
  


  echo "<script>console.log('Currency Is: ".$_SESSION['currency']."');</script>";

  setcookie("userID");
  $id = uniqid();
  if(!isset($_COOKIE["userID"])) {
    setcookie("userID",$id,time()+31556926 ,'/');
    $insertUser=$conn->prepare("INSERT INTO ogcustomer(userid, cookieUser) VALUE('".$id."', 'yes')");
    $insertUser->execute();
    
  } else {
    setcookie("userID",$_COOKIE["userID"],time()+31556926 ,'/');
    $checkUser=$conn->prepare("SELECT * FROM ogcustomer WHERE userid='".$_COOKIE["userID"]."'");
    $checkUser->execute();
    $isUser = $checkUser->rowCount();
    while($row=$checkUser->fetch(PDO::FETCH_ASSOC)){
        $email = $row['email'];
        $fname=$row['fname'];
        $userid=$row['userid'];
    }
    if($email!=NULL){
        $_SESSION['IS_LOGIN']=true;
        $_SESSION['NAME']=$fname;
        $_SESSION['EMAIL']=$email;
        $_SESSION['USER_ID']=$userid;   
    }
    if($isUser==0){
        $insertUser=$conn->prepare("INSERT INTO ogcustomer(userid, cookieUser) VALUE('".$_COOKIE['userID']."', 'yes')");
        $insertUser->execute();
    }
    
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $productSeoTitle ?></title>
    <?php
        // $root = "http://".$_SERVER['HTTP_HOST'];
        // $root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    ?>
    <base href="<?php echo $actual_link; ?>">
    <!-- <base href="<?php echo $root; ?>"> -->
    <!-- SEO Meta Tags-->
    <meta name="robots" content="noindex" />
    <meta name="description" content="<?php echo $productSeoDescription; ?>">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <?php
      $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        if (strpos($actual_link, 'newlandspharmacy')) { 
      
      ?>
          <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="edbab015-81b8-4a5d-aafa-984f8fb8b15a";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
          <!-- Global site tag (gtag.js) - Google Analytics -->
          <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152779301-3"></script>
          <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-152779301-3');
          </script>

          <script type='text/javascript'>
            window.smartlook||(function(d) {
              var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
              var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
              c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
              })(document);
              smartlook('init', 'aac0e6e029fbf818503041061d9cf28ce9fb17b8', { region: 'eu' });
          </script>

      <?php

      }elseif (strpos($actual_link, 'oneglobalpharma')) {
      ?>
          <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="edbab015-81b8-4a5d-aafa-984f8fb8b15a";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
<!-- Global site tag (gtag.js) - Google Analytics -->

          <script type='text/javascript'>
                window.smartlook||(function(d) {
                  var o=smartlsook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
                  var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
                  c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
                  })(document);
                  smartlook('init', '71d4124c43e14246140a601b7100016ac8cce7ca', { region: 'eu' });
              </script>


      <!-- Google Tag Manager -->
              <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
              new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
              j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
              'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
              })(window,document,'script','dataLayer','GTM-5KC67PH');</script>
              <!-- End Google Tag Manager -->

      <script>
                  (function(h,o,t,j,a,r){
                      h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                      h._hjSettings={hjid:2508960,hjsv:6};
                      a=o.getElementsByTagName('head')[0];
                      r=o.createElement('script');r.async=1;
                      r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                      a.appendChild(r);
                  })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
              </script>

      <!-- Global site tag (gtag.js) - Google Analytics -->
              <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152779301-1"></script>
              <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
              
                gtag('config', 'UA-152779301-1');
              </script>
      <?php
          
      }
    ?>

    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="edbab015-81b8-4a5d-aafa-984f8fb8b15a";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152779301-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-152779301-3');
    </script>

    <script type='text/javascript'>
      window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='https://web-sdk.smartlook.com/recorder.js';h.appendChild(c);
        })(document);
        smartlook('init', 'aac0e6e029fbf818503041061d9cf28ce9fb17b8', { region: 'eu' });
    </script>

<!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <!-- Main Theme Styles + Bootstrap-->
    
  </head>
  <!-- Body-->
  <body class="bg-secondary">
	<link rel="stylesheet" media="screen" href="css/main.css">   
 <div class="js-container container" style="top:0px !important;"></div>
    
    <div class="loader-bg">
        <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
        <?php
            if($productSeoTitle!='checkout'){
        ?>
        <!--<iframe src="lottie/loader.html" style=" height: 319px; position: absolute; top: 40%; left: 40%; width: 250px; overflow: hidden; right: auto; "></iframe>-->
            <lord-icon src="https://assets6.lottiefiles.com/packages/lf20_kpx4m39k.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 414px;height: fit-content;display: flex;"></lord-icon>
      	<?php 
            }
      	?>
      	</div>
    </div>
    <div class="loader-bg2">
        <lord-icon src="https://assets4.lottiefiles.com/packages/lf20_zw7jo1.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 95px;height: fit-content;"></lord-icon>
    </div>
  
  <!--<div class="loader-bg1">-->
  <!--	 <iframe src="lottie/order.html" style=" height: 319px; position: absolute; top: 40%; left: 40%; width: 250px; overflow: hidden; right: auto; "></iframe>-->
  <!--</div>-->
    <!-- Sign in / sign up modal-->
    <!-- <div class="block-stick">
        <div class="add-btn" style="display: inline-block;float: left;padding: 0 !important;width: 100%;text-align: center;">
                <button class="btns">Add to Cart</button>
        </div>
    </div> -->
    <!-- Cart Sticky -->

          <!-- End Cart Sticky -->
    <div id="snackbar"></div>
    <div id="codeCopyAlert" class=""><i class="fa-solid fa-check"></i> code 5FORU copied</div>
    <div id="codeCopyAlert" class="anyCode"></div>
    <div class="modal fade" id="outModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
          <div class="modal-header bg-secondary">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content pt-3 py-4">
            <form class="tab-pane fade show active" autocomplete="off" novalidate id="out-med-enq-forms">
                <input type="hidden" name="web" value="GLOBAL">
                <input type="hidden" name="type" value="inq">
                <input type="hidden" name="page" value="http://newlandpharmacy.co.uk/">
              <h1 style=" font-slize: 17px; font-weight: 700; margin-bottom: 0px; ">Currently we're out of <span id="out-product-text" style=" color: #30c9c3; "></span></h1>
              <p class="mb-3">Please share your details, & we'll get back to you</p>
              <div class="mb-2">
                <input type="hidden" value="med-enq" name="btn">
                <label class="form-label" for="si-email" style=" padding: 2px; font-weight: 600; ">Product Name</label>
                <input class="form-control" type="text" id="out-product-name" name="med-name" style=" padding: 5px 11px; " readonly>
              </div>
              <div class="row">
                <div class="col-md-6 mb-2 fname">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">First name</label>
                  <input class="form-control" type="text" name="fname" id="fname" placeholder="First name" style=" padding: 5px 11px; ">
                  <div class="fnameError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-2 lname">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">Last name</label>
                  <input class="form-control" type="text" name="lname" id="lname" placeholder="Last name" style=" padding: 5px 11px; ">
                  <div class="lnameError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="mb-2 email">
                <label class="form-label" for="si-email" style=" padding: 2px; font-weight: 600; ">Email</label>
                <input class="form-control" type="email" id="email" name="email" style=" padding: 5px 11px; ">
                <div class="emailError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
              </div>
              <div class="row" style="overflow:initial !important;">
                <div class="col-md-12 mb-3 phone">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">Phone</label>
                  <input class="form-control tel" type="tel" id="phone" name="phone" id="phone" inputmode="tel" value="" style=" padding: 5px 11px; " / >
                  <div class="phoneError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12 mb-3 message">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">Note/Message</label>
                  <textarea class="form-control" id="note" name="message"></textarea>
                  <div class="messageError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              
                <div class="alert alert-success med-success-msg success" style=" background: #ecfbf5; padding: 4px 10px; font-size: 13px; text-align: center; " role="alert">
                  Thank You! Your submission has been send
                </div>
              
                <button type="submit" class="btn btn-primary btn-shadow d-block w-100 buttonCart" id="signinbtn">
                    <span class="button__text">Submit</span>
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="med-enq-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
          <div class="modal-header bg-secondary">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content pt-3 py-4">
            <form class="tab-pane fade show active" autocomplete="off" novalidate id="med-enq-forms">
              <h1 style=" font-slize: 17px; font-weight: 700; margin-bottom: 0px; ">Need help in order a <span id="med-name-text" style=" color: #30c9c3; "></span>?</h1>
              <p class="mb-3">Share your details, we will help you!</p>
              <div class="mb-2">
                <input type="hidden" value="med-enq" name="btn">
                <label class="form-label" for="si-email" style=" padding: 2px; font-weight: 600; ">Product Name</label>
                <input class="form-control" type="text" id="med-name-input" name="med-name" style=" padding: 5px 11px; " readonly>
              </div>
              <div class="row">
                <div class="col-md-6 mb-2">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">First name</label>
                  <input class="form-control" type="text" name="fname" id="fname" placeholder="First name" style=" padding: 5px 11px; ">
                  <div class="fError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-2">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">Last name</label>
                  <input class="form-control" type="text" name="lname" id="lname" placeholder="Last name" style=" padding: 5px 11px; ">
                  <div class="lError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="mb-2">
                <label class="form-label" for="si-email" style=" padding: 2px; font-weight: 600; ">Email</label>
                <input class="form-control" type="email" id="email" name="email" style=" padding: 5px 11px; ">
                <div class="eError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">Phone</label>
                  <input class="form-control tel" type="tel" id="phone" name="phone" id="phone" inputmode="tel" value="" style=" padding: 5px 11px; " / >
                  <div class="pError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label"  style=" padding: 2px; font-weight: 600; ">Note/Message</label>
                  <textarea class="form-control" id="note" name="note"></textarea>
                  <div class="nError labelError" style="color: red; font-size: 10px; padding-left: 5px;"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              
                <div class="alert alert-success med-success-msg" style=" background: #ecfbf5; padding: 4px 10px; font-size: 13px; text-align: center; " role="alert">
                  Thank You! Your submission has been send
                </div>
              
                <button type="submit" class="btn btn-primary btn-shadow d-block w-100 buttonCart" id="signinbtn">
                    <span class="button__text">Submit</span>
                </button>
            </form>
          </div>
        </div>
      </div>
    </div>   
    
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#signin-tab" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="fa-solid fa-lock me-2 mt-n1"></i>Sign in</a></li>
              <li class="nav-item"><a class="nav-link fw-medium" href="#signup-tab" data-bs-toggle="tab" role="tab" aria-selected="false"><i class="fa-solid fa-user me-2 mt-n1"></i>Sign up</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <form class="tab-pane fade show active" autocomplete="off" novalidate id="signin-tab">
              
              <div class="uniError labelError text-center mb-2"></div>
              <div class="mb-3">
                <input type="hidden" value="signin" name="btn">
                <label class="form-label" for="si-email">Email address</label>
                <input class="form-control" type="email" id="si-email" name="email" placeholder="Enter Email">
                <div class="emailError labelError"></div>
              </div>
              <div class="cardOTP p-2 text-center">
                <div class="otp-success"> <span>A code has been sent to email</span></div>
                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
                    <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp2')" type="text" id="otp1" maxlength="1" /> 
                    <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp3')" type="text" id="otp2" maxlength="1" /> 
                    <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp4')" type="text" id="otp3" maxlength="1" /> 
                    <input class="m-2 text-center form-control rounded" onkeyup="movetoNext(this, 'otp5')" type="text" id="otp4" maxlength="1" />
                </div>
                <div class="otpError labelError"></div>
                <p class="text-center password-login">Login With Password</p>
                
               </div>
                <div class="password-section">
                  <div class="mb-3">
                    <label class="form-label" for="si-password">Password</label>
                    <div class="password-toggle">
                      <input class="form-control" type="password" id="si-password"  name="password" placeholder="Enter Password">
                      <label class="password-toggle-btn" aria-label="Show/hide password">
                      </label>
                      <div class="passwordError labelError"></div>
                    </div>
                  </div>
                  <p class="otp-login">Login With OTP</p>
                </div>
                <button type="submit" class="btn btn-primary btn-shadow d-block w-100 buttonCart" id="signinbtn">
                    <span class="button__text">Sign In</span>
                </button>
            </form>
            <form class="tab-pane fade" autocomplete="off" id="signup-tab">
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
              <div class="row" style=" overflow: initial; ">
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
    </div>   
    
    <div class="nav__header" id="header1">
            <nav class="nav container" style="
    height: auto !important;
">

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">
                                <i class='bx bx-home-alt fa-solid fa-house'></i>
                                <span class="nav__name">Home</span>
                            </a>
                        </li>
                        
                        <li class="nav__item">
                            <a href="#searchBox" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox" class="nav__link">
                                <i class='bx bx-briefcase-alt fa-solid fa-magnifying-glass'></i>
                                <span class="nav__name">Search</span>
                            </a>
                        </li>

                        <li class="nav__item" style="position: relative;">
                            <span class="navbar-tool-label total-item-cart" style="position: absolute;top: 0px;right: 0;background: #20c5be;padding: 0px 5px 0 5px;font-size: 11px;z-index: 999;border-radius: 51px;color: #fff;"></span>
                            <a href="cart" class="nav__link">
                                <lord-icon src="https://cdn.lordicon.com/dnoiydox.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 44px;height: 29px;margin-bottom: 9px;"></lord-icon>
                                
                            </a>
                        </li>
                            
                        <li class="nav__item" style="position: relative;">
                            <a href="wishlist" class="nav__link">
                                <i class='bx bx-briefcase-alt fa-solid fa-heart'></i>
                                <span class="nav__name">Wishlist</span>
                            </a>
                        </li>
                        

                        <li class="nav__item">
                            <a href="#accountBox" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="accountBox" class="nav__link">
                                <i class='bx bx-briefcase-alt fa-solid fa-user'></i>
                                <span class="nav__name">Account</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    
    <div class="modal fade" id="checkoutAddressList" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#editAddressBox" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="fa-solid fa-lock me-2 mt-n1"></i>Edit Address</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <a class="btn btn-primary btn-sm d-lg-inline-block changeAddress" href="#addUserAddress" data-bs-toggle="modal" style=" display: block !important; width: fit-content; margin: 10px auto; ">Add New Address</a>
            <p style=" text-align: center; margin-bottom: 8px; font-weight: 600; font-size: 15px; position: relative; ">OR</p>
            <div class="allAddressList">
                    
            </div>
            
              
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="orderStatusList" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#editAddressBox" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="fa-solid fa-lock me-2 mt-n1"></i>Edit Address</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <div class="trackData">
                    
            </div>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="couponLoad" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body tab-content p-0">
            <!--<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>-->
            <div class="addInput">
                <div class="input-group">
                    <input class="form-control couponInput" type="text" placeholder="APPLY COUPON">
                    <button class="btn btn-primary couponButton"  onclick="insertCoupon(this)" type="button">APPLY</button>
                </div>
            </div>
            <?php
                $selectUser=$conn->prepare("SELECT * FROM ogcustomer WHERE userid='".$_SESSION['USER_ID']."'");
                $selectUser->execute();
                $totalUser=$selectUser->rowCount();
                if($totalUser>0){
                    while($row1=$selectUser->fetch(PDO::FETCH_ASSOC)){
                        $email = $row1['email'];
                    }
                }
            
                $selectCoupon =$conn->prepare("SELECT * FROM coupons WHERE user='ALL' OR user LIKE '%".$email."%'");
                $selectCoupon->execute();
                $totalCoupon = $selectCoupon->rowCount();
                if($totalCoupon>0){
                echo '<p class="couponError">Promotions cannot be applied using your current device</p>';
                while($row=$selectCoupon->fetch(PDO::FETCH_ASSOC)){
                    $id = $row['code'];
            ?>
                <label class="couponList">
                    <div class="couponDec">
                        <p class="couponCode"><?php echo $row['code']; ?></p>
                        <p class="couponDes"><?php echo $row['description']; ?></p>
                    </div>
                    <div class="applyBtn">
                        <a onclick="insertCoupon('<?php echo $id ?>')">Apply</a>
                    </div>  
                </label>
            <?php 
                }}else {

            ?>
            <img src="https://i.ibb.co/f8XJWGy/coupon.png" style=" width: fit-content; display: block; margin: 0 auto; ">
            <p class="couponHead" style=" margin: 0; text-align: center; padding: 0  0px 29px; ">No other coupons available</p>
            <?php
                }
            ?>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="OrderConfirm" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style=" text-align: center; ">
          <div class="modal-body tab-content p-0">
            <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 95px;height: fit-content;"></lord-icon>
            <h2>Thanks for your order!</h2>
            <p>Your order is successfully placed, You will receive one step login link and order details on your mail.You can click below button to access my account </p>
            <a href="" class="gotoOrders">Done</a>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="freeShipConfirm" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style=" text-align: center; border-radius: 11px !important;padding: 42px 0px;width: fit-content;margin: 0 auto;">
          <div class="modal-body tab-content p-0" style="width: fit-content;">
            <lord-icon src="https://assets1.lottiefiles.com/packages/lf20_uhIxIg.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 410px;height: 410px;margin-top: -101px;"></lord-icon>
            <h2 style="margin-top: -43px;font-size: 23px;font-weight: 800;color: #119385;margin-bottom: 1px;">Congratulations!!</h2>
            <p>You have got free shipping on this order.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="orderTrack" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body tab-content p-0 track-data">
            <div class="track-list" style=" border-left: 3px solid #1877f2; margin: 14px; padding-left: 8px; " >
                <p style=" font-size: 13px; width: fit-content; padding: 1px 0; border-radius: 11px; color: #000; font-weight: 600; "> Fetch Data...</p>
            </div>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="TermsCondition" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style=" text-align: center; ">
          <div class="modal-body tab-content p-0">
            <!--<lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 95px;height: fit-content;"></lord-icon>-->
            
                <h2>Please Read! Before we proceed</h2>
                <div class="termsBox">
                    <p style=" margin-bottom: 0; padding-bottom: 0; font-size: 13px; text-align: left; font-weight: 400; "><b>Overview:</b></p>
                    <p style="font-size: 11px; text-align: left; line-height: 15px; font-weight: 400; ">
                        Processing payment in exchange of prescription medicine is prohibited. Thus, products that are allowed to ship 
                        will reflect in your payment statement. And we will be shipping you the actual medicines. Therefore, do not 
                        reveal purchase of medicines with your payment authority. 
                    </p>
                    <p style=" margin-bottom: 0; padding-bottom: 0; font-size: 13px; text-align: left; font-weight: 400; "><b>Payment Authentication:</b></p>
                    <p style="font-size: 11px; text-align: left; line-height: 15px; font-weight: 400; ">
                        We will disclose that you are making payment for toys which is legitimate. 
                        You might get asked to authenticate the purchase by your payment authorities; 
                        do not reveal purchase of medicine to them.
                    </p>
                    
                    <p style=" margin-bottom: 0; padding-bottom: 0; font-size: 13px; text-align: left; font-weight: 400; "><b>Payment & Safety:</b></p>
                    <p style="font-size: 11px; text-align: left; line-height: 15px; font-weight: 400; ">
                        You’ll receive an email with a secured payment link on your verified/registered email address. 
                        There, you’ll notice toys are switched with medicines in your cart, this is done deliberately 
                        for safety. Therefore, do not get confused when you see toys instead of medicines.
                    </p>
                    
                    <p style=" margin-bottom: 0; padding-bottom: 0; font-size: 13px; text-align: left; font-weight: 400; "><b>Attention:</b></p>
                    <p  style="font-size: 11px; text-align: left; line-height: 15px; font-weight: 400; ">
                        Name of  <b class="flashName">‘Global Pharma’</b> will appear on your payment statement. We will show that you are paying for toys which is not forbidden. 
                    </p>
                    
                    <p style=" margin-bottom: 0; padding-bottom: 0; font-size: 13px; text-align: left; font-weight: 400; "><b>Don’t worry:</b></p>
                    <p  style="font-size: 11px; text-align: left; line-height: 15px; font-weight: 400; ">
                        Your medication purchase is classified.
                    </p>
                    <div class="ScrollButton" style=" position: sticky; bottom: 0; z-index: 51; font-size: 11px; color: #fff; background: #00c3d1; padding: 2px 0; ">
                       Scroll To View More
                    </div>
                    <!--<p>Processing payment for purchase of Pharmaceutical Medications is not allowed.Therefore your Statements will show other products which is allowed and will Ship Actual Medications.</p>-->
                    <!--<p class="termspoints">Please do not disclose purchase of Medicines with your Credit/Debit Card Company or Paypal</p>-->
                    <!--<p class="termspoints">We will show that you are paying us for Kids Toys which is allowed</p>-->
                    <!--<p class="termspoints">You May Receive a Call or email from Credit/debit Card Company Or PayPal asking about the products you ordered, Please Make Sure you Don't tell them anything about the purchase of medications</p>-->
                    <!--<p class="termspoints">You will receive payment link on your Email to submit payment, you will see Kids Toys has been replaced with medications in your cart, this is being done for safety purpose</p>-->
                    <!--<p class="termspoints">Please don't get confused when you see Kids Toys in your cart instead of medications</p>-->
                    
                    <!--<p class="termspoints">Name on Pay pal Credit/Debit Card Statement will be Global Pharma</p>-->
                    <!--<p class="termspoints">We will show that you are paying us for Kids Toys which is allowed</p>-->
                    <!--<p class="termspoints">The purchase of your medication will be confidential between us</p>-->
                    <!--<p class="termspoints">Please contact our customer support we are here to help you Call On: <?php  echo $_SESSION['phone1'] ?></p>-->
                    <!--<p class="termspoints">You can discuss freely about the purchase of actual medications with our customer support executive.</p>-->
                    <!--<p class="termspoints">(Please directly don't contact Credit/Debit Card Company or PayPal for issues related to your order)</p>-->
                </div>
                
                <h2 style=" background: #fff; color: #000; font-size: 13px; font-weight: 700; margin-top: 26px; margin-bottom: 0; ">Name on Pay pal Credit/Debit Card Statement will be <span class="flashName">Global Pharma</span></h2>
                <p>Call On: <?php  echo $_SESSION['phone1'] ?> (If you have any query)</p>
                
                <p style="text-align:center !important;"><b style=" font-weight: 600; text-decoration: underline; font-size: 12px; ">Please check below before we proceed.</b></p>
                
                <!-- <div class="checkboxes">
                    <div style="margin-top:3px;text-align: left;">
                    <input type="checkbox" id="cbx" class="cbx" style="display: none;">
                    <label for="cbx" class="check" style=" display: flex; align-items: center; margin: 9px 0px;">
                      <svg width="25px" height="20px" viewBox="0 0 18 18">
                        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                        <polyline points="1 9 7 14 15 4"></polyline>
                      </svg>
                      <span class="conditionCheck">I will not mention anything about the purchase of medications 
                        (with Credit/debit Card Company)</span>
                    </label>
                    </div>
                    <div style="margin-top:3px;text-align: left;">
                    <input type="checkbox" id="cbx2" class="cbx" style="display: none;">
                    <label for="cbx2" class="check" style=" display: flex; align-items: center; margin: 9px 0px;">
                      <svg width="25px" height="20px" viewBox="0 0 18 18" style=" margin-left: -2px; ">
                        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                        <polyline points="1 9 7 14 15 4"></polyline>
                      </svg>
                      <span class="conditionCheck" style=" padding-left: 7px; ">(If Asked) I will mention that i paid for Kids Toys as showed in my cart on checkout.</span>
                    </label>
                    </div>
                    <div style="margin-top:3px;text-align: left;">
                    <input type="checkbox" id="cbx3" class="cbx" style="display: none;">
                    <label for="cbx3" class="check" style=" display: flex; align-items: center; margin: 9px 0px;">
                      <svg width="42px" height="20px" viewBox="0 0 18 18">
                        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                        <polyline points="1 9 7 14 15 4"></polyline>
                      </svg>
                      <span class="conditionCheck" style=" padding-left: 9px; ">In case of issues related to my order, I agree to contact your Customer Support instead of making chargeback or dispute 
                      with Credit/debit Card Company or PayPal.</span>
                    </label>
                    </div>
                </div> -->
                
                <button type="button" id="proceedClick" data-invid="" onclick="pendOrder(this)" class="nextTerms" disabled>Proceed</button>
                <!--<button type="button" class="nextTerms" onclick="terms()">Proceed</button>-->
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="TermsCondition2" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style=" text-align: center; ">
          <div class="modal-body tab-content p-0">
            <!--<lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 95px;height: fit-content;"></lord-icon>-->
            
                <h2>Name on Pay pal Credit/Debit Card Statement will be Global Pharma</h2>
                <p>Call On: <?php  echo $_SESSION['phone1'] ?> (If you are still confused)</p>
                <p>This is how we will replace Medications with Some Kids Toys. It will look like you paid us for Kids Toys & You will receive the actual medications you ordered.</p>
                
                <p style="text-align:center !important;"><b>Please check below before we proceed.</b></p>
                
                <!--<div class="checkboxes">-->
                <!--    <div style="margin-top:3px;text-align: left;">-->
                <!--    <input type="checkbox" id="cbx" class="cbx" style="display: none;">-->
                <!--    <label for="cbx" class="check">-->
                <!--      <svg width="20px" height="20px" viewBox="0 0 18 18">-->
                <!--        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>-->
                <!--        <polyline points="1 9 7 14 15 4"></polyline>-->
                <!--      </svg>-->
                <!--      <span class="conditionCheck">I will not mention anything about the purchase of medications -->
                <!--        (with Credit/debit Card Company or PayPal)</span>-->
                <!--    </label>-->
                <!--    </div>-->
                <!--    <div style="margin-top:3px;text-align: left;">-->
                <!--    <input type="checkbox" id="cbx2" class="cbx" style="display: none;">-->
                <!--    <label for="cbx2" class="check">-->
                <!--      <svg width="20px" height="20px" viewBox="0 0 18 18">-->
                <!--        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>-->
                <!--        <polyline points="1 9 7 14 15 4"></polyline>-->
                <!--      </svg>-->
                <!--      <span class="conditionCheck">Instead I will mention that i paid for Kids Toys as showed in my cart on checkout.</span>-->
                <!--    </label>-->
                <!--    </div>-->
                <!--    <div style="margin-top:3px;text-align: left;">-->
                <!--    <input type="checkbox" id="cbx3" class="cbx" style="display: none;">-->
                <!--    <label for="cbx3" class="check">-->
                <!--      <svg width="20px" height="20px" viewBox="0 0 18 18">-->
                <!--        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>-->
                <!--        <polyline points="1 9 7 14 15 4"></polyline>-->
                <!--      </svg>-->
                <!--      <span class="conditionCheck">In case of issues related to my order, I agree to contact your Customer Support instead of making chargeback or dispute -->
                <!--      with Credit/debit Card Company or PayPal.</span>-->
                <!--    </label>-->
                <!--    </div>-->
                <!--</div>-->
                
                <button type="button" id="proceedClick" data-invid="" onclick="pendOrder(this)" class="nextTerms" disabled>Proceed</button>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="editUserAddress" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#editAddressBox" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="fa-solid fa-lock me-2 mt-n1"></i>Edit Address</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <form class="tab-pane fade show active" autocomplete="off" id="editAddressBox">
              <div class="row">
                <input type="hidden" value="signup" name="btn">
                <p>Contact Details</p>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">First name</label>
                  <input type="hidden" name="btn" value="updateUserAddress">
                  <input type="hidden" name="addressID" id="update_addressID">
                  <input class="form-control" type="text" name="fname" id="update_fname">
                  <div class="fError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Last name</label>
                  <input class="form-control" type="text" name="lname" id="update_lname">
                  <div class="lError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Phone</label>
                  <input class="form-control" type="tel" name="updatephone" id="update_phone" inputmode="tel" value="" />
                  <div class="pError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <p>Address</p>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Address Line 1</label>
                  <input class="form-control"type="text" name="addressline1" id="update_addressline1" value="" />
                  <div class="addressError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Address Line 2</label>
                  <input class="form-control"type="text" name="addressline2" id="update_addressline2" value="" />
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Country</label>
                  <input class="form-control" type="text" name="country" id="update_country">
                  <div class="countryError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">State</label>
                  <input class="form-control" type="text" name="state" id="update_state">
                  <div class="stateError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">City</label>
                  <input class="form-control" type="text" name="city" id="update_city">
                  <div class="cityError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Pin Code</label>
                  <input class="form-control" type="text" name="pincode" id="update_pincode">
                  <div class="pincodeError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Update Address</button>
            </form>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="addUserAddress" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#editAddressBox" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="fa-solid fa-lock me-2 mt-n1"></i>Add Address</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content py-4">
            <form class="tab-pane fade show active" autocomplete="off" id="addAddressBox">
              <div class="row">
                <input type="hidden" value="signup" name="btn">
                <p>Contact Details</p>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">First name</label>
                  <input type="hidden" name="btn" value="addUserAddress">
                  <input class="form-control" type="text" name="fname" id="update_fname">
                  <div class="fError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Last name</label>
                  <input class="form-control" type="text" name="lname" id="update_lname">
                  <div class="lError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row" style="overflow: visible !important;">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Phone</label>
                  <input class="form-control tel" type="tel" name="phone" id="update_phone" inputmode="tel" value="" />
                  <div class="pError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <p>Address</p>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Address Line 1</label>
                  <input class="form-control"type="text" name="addressline1" id="update_addressline1" value="" />
                  <div class="addressError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Address Line 2</label>
                  <input class="form-control"type="text" name="addressline2" id="update_addressline2" value="" />
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Country</label>
                  <input class="form-control" type="text" name="country" id="update_country">
                  <div class="countryError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">State</label>
                  <input class="form-control" type="text" name="state" id="update_state">
                  <div class="stateError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">City</label>
                  <input class="form-control" type="text" name="city" id="update_city">
                  <div class="cityError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Pin Code</label>
                  <input class="form-control" type="text" name="pincode" id="update_pincode">
                  <div class="pincodeError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Add Address</button>
            </form>
          </div>
        </div>
      </div>
    </div> 
    
    <div class="modal fade" id="addNewUserAddress" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link fw-medium active" href="#editAddressBox" data-bs-toggle="tab" role="tab" aria-selected="true"><i class="fa-solid fa-lock me-2 mt-n1"></i>Add Address</a></li>
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body tab-content">
            <form class="tab-pane fade show active" autocomplete="off" id="addNewUserAddressBox">
              <div class="row">
                <p>Contact Details</p>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">First name</label>
                  <input type="hidden" name="btn" value="addNewUserAddress">
                  <input class="form-control" type="text" name="fname" id="update_fname">
                  <div class="fError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Last name</label>
                  <input class="form-control" type="text" name="lname" id="update_lname">
                  <div class="lError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="si-email">Email address</label>
                    <input class="form-control" type="email" id="si-email" name="email">
                    <div class="emailError labelError"></div>
                </div>
              </div>
              <div class="row" style="overflow: visible !important;">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Phone</label>
                  <input class="form-control tel" type="tel" name="phone" id="update_phone" inputmode="tel" value="" />
                  <div class="pError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <p>Address</p>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Address Line 1</label>
                  <input class="form-control"type="text" name="addressline1" id="update_addressline1" value="" />
                  <div class="addressError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="" class="form-label">Address Line 2</label>
                  <input class="form-control"type="text" name="addressline2" id="update_addressline2" value="" />
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Country</label>
                  <input class="form-control" type="text" name="country" id="update_country">
                  <div class="countryError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">State</label>
                  <input class="form-control" type="text" name="state" id="update_state">
                  <div class="stateError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">City</label>
                  <input class="form-control" type="text" name="city" id="update_city">
                  <div class="cityError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
                <div class="col-md-6 mb-3">
                  <label for="" class="form-label">Pin Code</label>
                  <input class="form-control" type="text" name="pincode" id="update_pincode">
                  <div class="pincodeError labelError"></div>
                  <!--<div class="valid-feedback">Looks good!</div>-->
                </div>
              </div>
              <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Add Address</button>
            </form>
          </div>
        </div>
      </div>
    </div> 
    
    <!--Shopping Cart Panel Starts-->
    <div class="offcanvas offcanvas-end w-35" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
    <div class="offcanvas-header">
      <h6 class="cartheading-title d-none d-sm-block" id="offcanvas">Shopping Cart <span class="count-class">(1)</span></h6>
      <button type="button" class="btn-close text-reset fw-600" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body px-0 pt-1">
      <div class="p-3">
        <div class="cartheading-body">
          <div class="row p-3">
            <div class="col-md-3">
              <span>
                <img style="width: 100%; height: 100%; object-fit: cover;" src="http://localhost/globalnew/onglobaladmincrm/assets/images/products/Levitra-Medicine-Box-5.jpg" alt="">
              </span>
            </div>
            <div class="col-md-9">
              <h6 class="cartheading-main-title">Levitra 10MG (60 tablets)</h6>
              <span class="cart-quantity-css">1 X $32.25</span>
              <div class="cartheading-product-price">
                <span class="cartprice-css">$108.00</span>
                <span class="cartcompare-css">$150.32</span>
              </div>
              <div class="pt-2">
                <span class="remove-text">Remove</span>
              </div>
            </div>
          </div>
        </div>
        <div class="cart-row">
          <p class="d-flex align-items-center">Total : <span class="cartmain-price">$105.25</span></p>
          <a class="removeall-btn">Remove all Items</a>
        </div>
      </div>
    </div>
  </div>
 
 <!--Shopping Cart Panel Ends-->
    
    <header class="bg-light shadow-sm fixed-top" data-fixed-element>
      <!--<div class="topbar topbar-dark d-flex align-items-center justify-content-center" style="background-color: #20c5be !important; padding: 3px 0 !important;">-->
      <!--  <a href="" class="text-light" style="font-size: 12px; padding: 0 10px;">About Us</a>-->
      <!--  <a href="" class="text-light" style="font-size: 12px; padding: 0 10px;">Contact Us</a>-->
      <!--  <a href="" class="text-light" style="font-size: 12px; padding: 0 10px;">Account</a>-->
      <!--  <a href="" class="text-light" style="font-size: 12px; padding: 0 10px;">Privacy Policy</a>-->
      <!--</div>-->
      <div class="navbar navbar-expand-lg navbar-light" style=" padding-left: 3px; ">
        <div class="container-fluid" style="padding-left: 0;">
 <button class="navbar-toggler"  style="padding: 2px 17px 2px 0px;" type="button" data-bs-toggle="offcanvas" onclick="loadCats()" data-bs-target="#sideNav" >
            <span class="navbar-toggler-icon"></span>
          </button>
          <?php
            if (strpos($actual_link, 'newlandspharmacy')) {
          ?>
            <a class="navbar-brand d-none d-sm-block me-3 me-xl-4 flex-shrink-0" href="<?php echo $root; ?>">
              <img src="https://myglobal1.gumlet.io/images/newlandlogo.png" width="139px" alt="">
            </a>
            <a class="navbar-brand d-sm-none me-2" href="<?php echo $root; ?>"><img src="https://myglobal1.gumlet.io/images/newlandlogo.png" width="115px" alt=""></a>
          <?php
            }elseif (strpos($actual_link, 'oneglobalpharma')) {
          ?>
            <a class="navbar-brand d-none d-sm-block me-3 me-xl-4 flex-shrink-0" href="<?php echo $root; ?>">
              <img src="https://gcdnb.pbrd.co/images/MAOsCoQZeAEb.png?o=1" width="139px" alt="">
            </a>
            <a class="navbar-brand d-sm-none me-2" href="<?php echo $root; ?>"><img src="https://gcdnb.pbrd.co/images/MAOsCoQZeAEb.png?o=1" width="115px" alt=""></a>
          <?php
            }else{
              ?>
                <a class="navbar-brand d-none d-sm-block me-3 me-xl-4 flex-shrink-0" href="<?php echo $root; ?>">
                  <img src="https://gcdnb.pbrd.co/images/MAOsCoQZeAEb.png?o=1" width="139px" alt="">
                </a>
                <a class="navbar-brand d-sm-none me-2" href="<?php echo $root; ?>"><img src="https://gcdnb.pbrd.co/images/MAOsCoQZeAEb.png?o=1" width="115px" alt=""></a>
              <?php
                }
              ?>
          <!-- Search-->
          <button class="navbar-toggler cat-toggle" style="padding: 2px 2px 2px 0px;" type="button" data-bs-toggle="offcanvas" onclick="loadCats()" data-bs-target="#sideNav"><span class="navbar-toggler-icon"></span></button>
          <div class="input-group d-none d-lg-flex flex-nowrap mx-4">
            <div class="searchLoader">
                
            </div>
              <i class="fa-solid fa-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-3"></i>
            <input class="form-control rounded-start w-100" type="text" placeholder="Search for products" onclick="onInputClick()" id="search" autocomplete="off">
            
                 <!-- Omkar Search -->
                    <div id="multidropdown">
                        <div id="display-text" class="autocomplete-list">
                            <p id="realSearch" style=" padding: 3px 37px; background: #20c5be; color: #fff; cursor: pointer;">Search For: <b><span id="searchKeyword"></span></b> <span href="#med-enq-modal" data-bs-toggle="modal" style="background: #ffc905; padding: 3px 11px 4px 11px; margin-left: 10px; color: #000000; text-transform: uppercase; font-weight: 600;">Enquiry</span></p>
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
                    <!--<?php echo $productSlugNew; ?>-->
                        <div class="row mx-n2">
                            <?php
                            // SELECT  p1.productName, p1.productCode, p1.productCategory, p1. p2.price FROM product p1 INNER JOIN ( SELECT codes, price FROM pricing order by price)p2 ON p1.code == p2.codes where p2.price BETWEEN 0.39 AND 0.70 GROUP by p1.name;
                            $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE bestseller='Bestseller' limit 6");
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
                                $productDiscount = $row['productDiscount'];
                                $productSeoTitle = $row['productSeoTitle'];
                                $productSeoDescription = $row['productDescription'];
                            ?>
                              <div class="col-lg-4 col-12 px-0 px-lg-2">
                                <div class="card product-card pb-0 my-0">
                                  <div class="card-img-top d-block overflow-hidden" style=" display: flex !important; align-items: center; justify-content: center; padding: 0 !important; ">
                                      <a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                                        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>" alt="<?php echo $productImageAlt; ?>" title="<?php echo $productImageTitle; ?>" style=" display: flex; width: 100%; align-items: center; justify-content: center; ">
                                      </a>
                                  </div>
                                  <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"><?php echo $productCategory; ?></a>
                                    <a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                                    <h3 class="product-title fs-sm"><?php echo $productName; ?></h3>
                                    <p class="product-description d-flex justify-content-start  justify-lg-content-between">
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
                                    </a>
                                    <?php
                                        $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                                        $select_product_price->execute();
                                        while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                                        {
                                            $price = $row['price']; 
                                        }
                                    ?>
                                    <p class="product-price">
                                      <?php echo $_SESSION["currency_symbol"]; ?><?php echo number_format(($price*$_SESSION["currency_rate"]),2); ?>/<small><?php echo $productType; ?></small>*
                                    </p>
                                  </div>
                                </div>
                              </div>
                            <?php
                            }
                            ?>
                        </div>
                </section>
            </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <!-- Omkar Search -->
            
            <!--<select class="form-select flex-shrink-0" style="width: 14rem;">-->
            <!--  <option>All categories</option>-->
              <?php
                    // $selectCategory=$conn->prepare("SELECT * FROM ogcategory ORDER BY ogCategoryName ASC");
                    // $selectCategory->execute();  
                    // $categoryRow=$selectCategory->rowCount();
                    // while($categoryRow=$selectCategory->fetch(PDO::FETCH_ASSOC))
                    // {
                    //     $ogCategoryName = $categoryRow['ogCategoryName'];
                    //     $ogCategorySlug = $categoryRow['ogCategorySlug'];
                    
              ?>
              <!--<option><?php echo $ogCategoryName; ?></option>-->
              <?php 
                    // }
              ?>
            <!--</select>-->
          </div>
          <!-- Toolbar-->
          <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center ms-xl-2">
            <select class="form-select form-select-sm" onchange="getCurrency(this)">
                <option value="USD" <?php echo $_SESSION['currency']=='USD' ? 'selected' : ''; ?>>$ USD</option>
                <option value="EUR" <?php echo $_SESSION['currency']=='EUR' ? 'selected' : ''; ?>>€ EUR</option>
                <option value="GBP" <?php echo $_SESSION['currency']=='GBP' ? 'selected' : ''; ?>>£ GBP</option>
                <option value="AUD" <?php echo $_SESSION['currency']=='AUD' ? 'selected' : ''; ?>>A$ AUD</option>
            </select>
          </div>
        <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center ms-xl-2">
          <a class="navbar-tool d-flex d-lg-none" href="#searchBox" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">Search</span>
            <div class="navbar-tool-icon-box"><i class="navbar-tool-icon fa-solid fa-magnifying-glass"></i></div>
          </a>
          <?php
            if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
          ?>
          <a class="navbar-tool d-none d-lg-flex" href="wishlist">
              <div class="navbar-tool-icon-box">
                <lord-icon src="https://cdn.lordicon.com/rjzlnunf.json" trigger="hover" colors="primary:#121331,secondary:#e8308c" stroke="87" scale="36" style="width:250px;height:250px; display:inline !important;"></lord-icon>
            </div>
          </a>
          <?php
            }else{
          ?>
          <a class="navbar-tool d-none d-lg-flex" href="wishlist">
              <div class="navbar-tool-icon-box">
                <lord-icon src="https://cdn.lordicon.com/rjzlnunf.json" trigger="hover" colors="primary:#121331,secondary:#e8308c" stroke="87" scale="36" style="width:250px;height:250px; display:inline !important;"></lord-icon>
            </div>
          </a>
          <?php
            }
          ?>
            
          <?php
            if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
          ?>
          <div class="navbar-tool dropdown ms-3">
            
            <a class="navbar-tool-icon-box dropdown-toggle ms-1 ms-lg-0 me-n1 me-lg-2" href="account">
                <div class="navbar-tool-icon-box">
                    <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#121331,secondary:#20C5BE" stroke="87" scale="40" style="width:250px;height:250px; display:inline !important;"></lord-icon>
                </div>
            </a>
          </div>
          <?php
            }else{
          ?>
          <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="#signin-modal" data-bs-toggle="modal">
            <div class="navbar-tool-icon-box">
                <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:#121331,secondary:#20C5BE" stroke="87" scale="40" style="width:250px;height:250px; display:inline !important;"></lord-icon>
            </div>
            <div class="navbar-tool-text ms-n3"></div>
          </a>
          <?php
            }
          ?>
          <!--<a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2 pe-auto" href="#offcanvas" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" data-bs-toggle="modal">-->
          <!--  <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-cart"></i></div>-->
          <!--  <div class="navbar-tool-text ms-n3"></div>-->
          <!--</a>-->
          <div class="navbar-tool dropdown ms-3">
            <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="cart" style="display: flex; align-items: center; justify-content: center; ">
              <span class="navbar-tool-label total-item-cart"></span>
              <img src="https://myglobal1.gumlet.io/images/cart.png" style="width:25px;">
            </a>
            <!-- <a class="navbar-tool-text" href="grocery-checkout.html">
                <small>My Cart</small>$25.00
              </a> -->
            <div class="dropdown-menu dropdown-menu-end">
              <div class="widget widget-cart px-3 pt-2 pb-3" style="width: 20rem;">
                <p class="text-center"><small>User ID: <?php echo $_COOKIE["userID"] ?> <?php echo $_SESSION["IS_LOGIN"] ?></small></p>
                <div class="cart-list-item">

                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>

      <!-- Search collapse-->
      <div class="collapse fullSearchBox" id="searchBox">
        <div class="card search-card pb-4 border-0 rounded-0">
          <div class="container p-0">
            <div class="input-group">
              <a class="navbar-tool d-flex d-lg-none" href="#searchBox" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="searchBox"><span class="navbar-tool-tooltip">Search</span>
                <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-arrow-left"></i></div>
              </a>
              <input class="form-control rounded-start search-mob-bar" type="text" placeholder="Search for products" id="searchMob" autocomplete="off">
            </div>
            <p id="realSearch" style=" padding: 3px 37px; margin-top: 7px; background: #20c5be; z-index: 5; color: #fff; cursor: pointer; position: absolute; top: 51px; right: 0; left: 0;">Search For: <b><span id="searchKeywordNew"></span></b> <span href="#med-enq-modal" data-bs-toggle="modal" style="background: #ffc905; padding: 3px 11px 4px 11px; margin-left: 10px; color: #000000; text-transform: uppercase; font-weight: 600;">Enquiry</span></p>
            <div id="mobResult" class="mt-3">
                
                <p class="searchHeading">Bestseller Categories</p>
                <div class="categoryListed py-2" style=" padding: 0 6px; ">
                    <a href="antibiotics" class="searchLink mobOne">Antibiotics</a>
                    <a href="anxiety-and-depression" class="searchLink mobSeven">Anxiety And Depression</a>
                    <a href="sleeping-pills" class="searchLink mobTwo">Sleeping Pills</a>
                    <a href="oral-steroids" class="searchLink mobThree">Oral Sterioids</a>
                    <a href="pain-medication" class="searchLink mobFour">Pain Medication</a>
                    <a href="erectile-dysfunction" class="searchLink mobSix">Erectile Dysfunction</a>
                    <a href="injectable-steroids" class="searchLink mobTwo">Injectable Sterioidsn</a>
                </div>
                <p class="searchHeading">Bestseller Medication</p>
                <section class="">
                        <!--<?php echo $productSlugNew; ?>-->
                            <div class="row mx-n2">
                                <?php
                                // SELECT  p1.productName, p1.productCode, p1.productCategory, p1. p2.price FROM product p1 INNER JOIN ( SELECT codes, price FROM pricing order by price)p2 ON p1.code == p2.codes where p2.price BETWEEN 0.39 AND 0.70 GROUP by p1.name;
                                $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE bestseller='Bestseller' limit 10");
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
                                    $productDiscount = $row['productDiscount'];
                                    $productSeoTitle = $row['productSeoTitle'];
                                    $productSeoDescription = $row['productDescription'];
                                ?>
                                  <div class="col-lg-4 col-12 px-0 px-lg-2">
                                    <div class="card product-card pb-0 my-0">
                                      <div class="card-img-top d-block overflow-hidden" style=" display: flex !important; align-items: center; justify-content: center; padding: 0 !important; ">
                                          <a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                                            <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>" alt="<?php echo $productImageAlt; ?>" title="<?php echo $productImageTitle; ?>" style=" display: flex; width: 100%; align-items: center; justify-content: center; ">
                                          </a>
                                      </div>
                                      <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#"><?php echo $productCategory; ?></a>
                                        <a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                                        <h3 class="product-title fs-sm"><?php echo $productName; ?></h3>
                                        <p class="product-description d-flex justify-content-start  justify-lg-content-between">
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
                                        </a>
                                        <?php
                                            $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                                            $select_product_price->execute();
                                            while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                                            {
                                                $price = $row['price']; 
                                            }
                                        ?>
                                        <p class="product-price">
                                          $<?php echo $price; ?>/<small><?php echo $productType; ?></small>*
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                <?php
                                }
                                ?>
                            </div>
                    </section>
            </div>
            
          </div>
        </div>
      </div>
      
      <div class="collapse fullSearchBox" id="accountBox">
                <div class="card search-card pb-4 border-0 rounded-0">
                  <div class="container p-0">
                    <div class="input-group">
                      <a class="navbar-tool d-flex d-lg-none" href="#accountBox" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="accountBox"><span class="navbar-tool-tooltip">Search</span>
                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-arrow-left"></i></div>
                      </a>
                    </div>
                    
                    <div id="mobResult">
                        <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2 signin-newsection-button" href="#signin-modal" data-bs-toggle="modal">
                            Sign in / Sign Up
                        </a>
                        <div class="checklist">
                            <a href="account"><i class="ci-package"></i> &nbsp; Orders</a>
                            <a href="account"><i class="fa-solid fa-user"></i> &nbsp; Profile</a>
                            <a href="account"><i class="fa-solid fa-map-location-dot"></i> &nbsp; Address</a>
                            <a href="account"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a>
                        </div>
                    </div>
                    
                  </div>
                </div>
            </div>
      
    </header>
    
Footer
© 2022 GitHub, Inc.
Footer navigation
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
