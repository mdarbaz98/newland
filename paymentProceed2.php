<?php 
    
    $productSeoTitle = "Payemnt";
    $productSeoDescription = "Payment";
    include( 'include/header.php'); 
    $invoiceno = $_SESSION['payInvoiceOrg'];
    if($invoiceno=='done'){
        echo "<script>window.location.href = 'https://".$INFO_WEBSITE_NAME."/'</script>";
    }
    $invoiceno = $_SESSION['payInvoiceDub'];
?>
<?php 
    include( 'include/sidenav.php'); 
    $getOrderDetails = $conn->prepare('SELECT * FROM orderdetails WHERE orderid=?');
    $getOrderDetails->execute([$invoiceno]);
    $row=$getOrderDetails->fetch(PDO::FETCH_ASSOC);
    $payMethod = $row['paymentMethod'];
    $total = $row['total'];
    $name = $row['fname']." ".$row['lname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $subtotal = $row['subtotal'];
    $dcharge = $row['dcharge'];
    $source  =$row['source'];
?>

<main class="offcanvas-enabled" style="background:#fff;">
    <section class="single-payment">
        <div class="container-fluid">
            <input type="hidden" value="<?php echo $invoiceno ?>" id="inv">
            <input type="hidden" value="<?php echo $payMethod ?>"  id="paymethod">
            <input type="hidden" value="<?php echo $total ?>"  id="total">
            <input type="hidden" value="<?php echo $name ?>"  id="payname">
            <input type="hidden" value="<?php echo $phone ?>"  id="payphone">
            <input type="hidden" value="<?php echo $email ?>"  id="payemail">
            <div class="row">
                <?php
                    if($payMethod=='cashapp'){
                ?>
                <div class="col-lg-12 col-12 payment-mob-tag">
                    <div class="payment-tag">
                        <div class="left-side">
                            <img src="https://myglobal1.gumlet.io/payment-logo/cashapp.png" alt="">
                            <p class="payment-name">Cash App</p>
                            <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                            <!-- <p class="offer-text" style="color:#11AB36;">Extra 2% Off Applied</p> -->
                            <!-- <p class="success-icon"><i class="fa-solid fa-circle-check"></i></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 payment-details-bank">
                    <div class="payment-details">
                        <div class="qr-info">
                            <p>Scan This QR Code</p>
                            <img src="image/payment/Cash-App.jpg" width="122" alt="">
                            <p>$petcare415</p>
                            <p onclick="saveFile('image/payment/Cash-App-2.jpg')" style="cursor:pointer;">Download <img src="https://myglobal1.gumlet.io/payment-logo/download.png" class="download-icon" alt=""></p>
                        </div>
                        <div class="sample-text">
                            <p>OR</p>
                        </div>
                        <div class="bank-info">
                            <p>Cash App Details</p>
                            <p class="name">Erica Moulder</p>
                            <p class="number">510 939 1561</p>
                            <div class="bank-copy-text" onclick="codeCopyAny1('5109391561')"><img src="https://myglobal1.gumlet.io/payment-logo/copy.png?w=16" alt=""> Click to copy</div>
                        </div>
                    </div>
                    <div class="instruction">
                        <p>Instructions to Pay:</p>
                        <ul>
                            <li>Open Cash App</li>
                            <li>Enter the amount</li>
                            <li>Tap Pay</li>
                            <li>Enter the phone number on payment page, or scan QR</li>
                            <li>Enter the note for payment given below.</li>
                            <li>Tap Pay.</li>
                        </ul>
                    </div>
                    <div class="payment-note">
                        <p>Name on statement: <span class="flashName">Doggtastic Adventures</span></p>
                        <button class="payment-confirm">I Have Made My Payment</button>
                        <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                    </div>
                </div>
                <?php
                    }elseif($payMethod=='zelle'){
                ?>
                <div class="col-lg-12 col-12 payment-mob-tag">
                    <div class="payment-tag">
                        <div class="left-side">
                            <img src="https://myglobal1.gumlet.io/payment-logo/zelle.png" alt="">
                            <p class="payment-name">Zelle</p>
                            <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                            <!-- <p class="offer-text" style="color:#9C36D4;">Extra 2% Off Applied</p> -->
                            <!-- <p class="success-icon"><i class="fa-solid fa-circle-check"></i></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 payment-details-bank">
                    <div class="payment-details">
                        <div class="qr-info">
                            <p>Scan This QR Code</p>
                            <img src="image/payment/zelle1.jpg" alt="" style="width: 150px">
                            <p onclick="saveFile('https://myglobal1.gumlet.io/payment-logo/zelle.jpeg')" style="cursor:pointer;">Download <img src="https://myglobal1.gumlet.io/payment-logo/download.png" class="download-icon" alt=""></p>
                        </div>
                        <div class="sample-text">
                            <p>OR</p>
                        </div>
                        <div class="bank-info">
                            <p>Zelle App Details</p>
                            <p class="name">Gregory Shashurin</p>
                            <p class="number">415 351 9676</p>
                            <div class="bank-copy-text" onclick="codeCopyAny1('6282838663')"><img src="https://myglobal1.gumlet.io/payment-logo/copy.png?w=16" alt=""> Click to copy</div>
                        </div>
                    </div>
                    <div class="instruction">
                        <p>Instructions to Pay:</p>
                        <ul>
                            <li>Go to Send money with Zelle.</li>
                            <li>Add or select recipient.</li>
                            <li>Enter amount and select your funding account.</li>
                            <li>Review and send.</li>
                        </ul>
                    </div>
                    <div class="payment-note">
                        <p>Name on statement: <span class="flashName">Doggtastic Adventures</span> </p>
                        <button class="payment-confirm">I Have Made My Payment</button>
                        <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                    </div>
                </div>
                <?php
                    }elseif($payMethod=='apple-pay'){
                ?>
                <div class="col-lg-12 col-12 payment-mob-tag">
                    <div class="payment-tag">
                        <div class="left-side">
                            <img src="https://myglobal1.gumlet.io/payment-logo/apple-pay.png" alt="">
                            <p class="payment-name">Apple Pay</p>
                            <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                            <!-- <p class="offer-text" style="color:#9C36D4;">Extra 2% Off Applied</p> -->
                            <!-- <p class="success-icon"><i class="fa-solid fa-circle-check"></i></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 payment-details-bank">
                    <div class="payment-details">
                        <div class="bank-info">
                            <p style="margin-top: 12px;font-weight: 400;font-size: 20px;">Apple Pay Details</p>
                            <p class="name" style="margin-top: 10px;">Erica Moulder</p>
                            <p style=" padding-top: 0; padding-left: 0px; " class="number">628 283 8663</p>
                            <div class="bank-copy-text" onclick="codeCopyAny1('6282838663')"><img src="https://myglobal1.gumlet.io/payment-logo/copy.png?w=16" alt=""> Click to copy</div>
                        </div>
                    </div>
                    <div class="instruction">
                        <p>Instructions to Pay:</p>
                        <ul>
                            <li>Tap the Apple Pay button or choose Apple Pay as your payment method.</li>
                            <li>If necessary, enter your billing, shipping, and contact information. Apple Pay stores that information, so you won't need to enter it again.</li>
                            <li>Enter the phone number</li>
                            <li>Confirm the payment.</li>
                        </ul>
                    </div>
                    <div class="payment-note">
                        <p>Name on statement: <span class="flashName">Doggtastic Adventures</span> </p>
                        <button class="payment-confirm">I Have Made My Payment</button>
                        <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                    </div>
                </div>
                <?php
                    }elseif($payMethod=='google-pay'){
                ?>
                <div class="col-lg-12 col-12 payment-mob-tag">
                    <div class="payment-tag">
                        <div class="left-side">
                            <img src="https://myglobal1.gumlet.io/payment-logo/google-pay.png" alt="">
                            <p class="payment-name">Google Pay</p>
                            <!-- <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p> -->
                            <!-- <p class="offer-text" style="color:#9C36D4;">Extra 2% Off Applied</p> -->
                            <!-- <p class="success-icon"><i class="fa-solid fa-circle-check"></i></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 payment-details-bank">
                    <div class="payment-details">
                        <div class="qr-info">
                            <p>Scan This QR Code</p>
                            <img src="https://myglobal1.gumlet.io/payment-logo/gpay.png?w=122" alt="">
                            <p onclick="saveFile('https://myglobal1.gumlet.io/payment-logo/gpay.png')" style="cursor:pointer;">Download <img src="https://myglobal1.gumlet.io/payment-logo/download.png" class="download-icon" alt=""></p>
                        </div>
                        <div class="sample-text">
                            <p>OR</p>
                        </div>
                        <div class="bank-info">
                            <p style="margin-top: 12px;font-weight: 400;font-size: 20px;">Google Pay Details</p>
                            <p class="name" style="margin-top: 10px;">Erica Moulder</p>
                            <p style=" padding-top: 0; padding-left: 0px; " class="number">+1 6282495563</p>
                            <div class="bank-copy-text" onclick="codeCopyAny1('+1 6282495563')"><img src="https://myglobal1.gumlet.io/payment-logo/copy.png?w=16" alt=""> Click to copy</div>
                        </div>
                    </div>
                    <div class="instruction">
                        <p>Instructions to Pay:</p>
                        <ul>
                            <li>Open the Google Pay app.</li>
                            <li>Scan the QR code above or add the phone number.</li>
                            <li>Enter the amount.</li>
                            <li>Tap Pay.</li>
                        </ul>
                    </div>
                    <div class="payment-note">
                        <p>Name on statement: <span class="flashName">Doggtastic Adventures</span> </p>
                        <button class="payment-confirm">I Have Made My Payment</button>
                        <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                    </div>
                </div>
                <?php
                    }elseif($payMethod=='venmo'){
                ?>
                <div class="col-lg-12 col-12 payment-mob-tag">
                    <div class="payment-tag">
                        <div class="left-side">
                            <img src="https://myglobal1.gumlet.io/payment-logo/venmo.png" alt="">
                            <p class="payment-name">Venmo</p>
                            <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                            <!-- <p class="offer-text" style="color:#9C36D4;">Extra 2% Off Applied</p> -->
                            <!-- <p class="success-icon"><i class="fa-solid fa-circle-check"></i></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 payment-details-bank">
                    <div class="payment-details">
                        <div class="qr-info">
                            <p>Scan This QR Code</p>
                            <img src="https://myglobal1.gumlet.io/payment-logo/venmo.jpg?w=122" alt="">
                            <p onclick="saveFile('https://myglobal1.gumlet.io/payment-logo/venmo.jpg')" style="cursor:pointer;">Download <img src="https://myglobal1.gumlet.io/payment-logo/download.png" class="download-icon" alt=""></p>
                        </div>
                        <div class="sample-text">
                            <p>OR</p>
                        </div>
                        <div class="bank-info">
                            <p>Venmo Details</p>
                            <p class="name">Gregory Shashurin</p>
                            <p class="number">415 351 9676</p>
                            <div class="bank-copy-text" onclick="codeCopyAny1('4153519676')"><img src="https://myglobal1.gumlet.io/payment-logo/copy.png?w=16" alt=""> Click to copy</div>
                        </div>
                    </div>
                    <div class="instruction">
                        <p>Instructions to Pay:</p>
                        <ul>
                            <li>You can find the Pay/Request button at the bottom of your Venmo app.</li>
                            <li>After tapping there scan your QR code or phone number given above, </li>
                            <li>Enter the amount and add the note given below.</li>
                            <li>Once you're ready, tap “Request” or “Pay”, and you should be all set!</li>
                        </ul>
                    </div>
                    <div class="payment-note">
                        <p>Name on statement: <span class="flashName">Doggtastic Adventures</span> </p>
                        <button class="payment-confirm">I Have Made My Payment</button>
                        <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                    </div>
                </div>
                <?php
                    }elseif($payMethod=='chime'){
                ?>
                <div class="col-lg-12 col-12 payment-mob-tag">
                    <div class="payment-tag">
                        <div class="left-side">
                            <img src="https://myglobal1.gumlet.io/payment-logo/chime-icon.png" alt="">
                            <p class="payment-name">Chime</p>
                            <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                            <!-- <p class="offer-text" style="color:#9C36D4;">Extra 2% Off Applied</p> -->
                            <!-- <p class="success-icon"><i class="fa-solid fa-circle-check"></i></p> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-12 payment-details-bank">
                    <div class="payment-details">
                        <div class="bank-info">
                            <p style="margin-top: 12px;font-weight: 400;font-size: 20px;">Chime Details</p>
                            <p class="name" style="margin-top: 10px;">Erica Moulder</p>
                            <p style=" padding-top: 0; padding-left: 0px; " class="number">628 283 8663</p>
                            <div class="bank-copy-text" onclick="codeCopyAny1('6282838663')"><img src="https://myglobal1.gumlet.io/payment-logo/copy.png?w=16" alt=""> Click to copy</div>
                        </div>
                    </div>
                    <div class="instruction">
                        <p>Instructions to Pay:</p>
                        <ul>
                            <li>Log in to your Chime mobile app.</li>
                            <li>Select the Pay Anyone tab.</li>
                            <li>Enter the email or phone number shared above.</li>
                            <li>Enter the amount to send to the recipient and the note given below.</li>
                            <li>Confirm the amount and the recipient.</li>
                            <li>Tap Pay</li>
                        </ul>
                    </div>
                    <div class="payment-note">
                        <p>Name on statement: <span class="flashName">Doggtastic Adventures</span> 
                    </p>
                        <button class="payment-confirm">I Have Made My Payment</button>
                        <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                    </div>
                </div>
                <?php
                    }elseif($payMethod=='wt'){
                ?>
                        <div class="col-lg-12 col-12 payment-mob-tag">
                            <div class="payment-tag">
                                <div class="left-side">
                                    <img src="https://myglobal1.gumlet.io/payment-logo/wiretransfer.png" alt="">
                                    <p class="payment-name">Wiretransfer</p>
                                    <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-12 payment-details-bank">
                            <div class="payment-details">
                                <div class="pay-head">Payment Details For Wiretransfer</div>
                            </div>
                            <div class="wt-pay-info">
                                <div class="wt-item">
                                    <div class="wt-item-head">
                                        Account Name
                                    </div>
                                    <div class="wt-item-value">
                                        Erica Moulder
                                    </div>
                                </div>
                                <div class="wt-item">
                                    <div class="wt-item-head">
                                        Account Number
                                    </div>
                                    <div class="wt-item-value">
                                        867892595
                                    </div>
                                </div>
                                <div class="wt-item">
                                    <div class="wt-item-head">
                                        Routing Number
                                    </div>
                                    <div class="wt-item-value">
                                        322271627
                                    </div>
                                </div>
                                <div class="wt-item">
                                    <div class="wt-item-head">
                                        Account Type
                                    </div>
                                    <div class="wt-item-value">
                                        Checking
                                    </div>
                                </div>
                                <div class="wt-item">
                                    <div class="wt-item-head">
                                        Bank Name
                                    </div>
                                    <div class="wt-item-value">
                                        Chase Bank
                                    </div>
                                </div>
                            </div>
                            <div class="instruction">
                                <p>Instructions to Pay:</p>
                                <ul>
                                    <li>Recipient bank name shared above</li>
                                    <li>Recipient bank routing number or other code.</li>
                                    <li>Payee's account number at the bank.</li>
                                    <li>Add the note below.</li>
                                </ul>
                            </div>
                            <div class="payment-note">
                                <p>Name on statement: <span class="flashName">Doggtastic Adventures</span></p>
                                <button class="payment-confirm">I Have Made My Payment</button>
                                <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                <?php
                    }elseif($payMethod=='wu'){
                ?>
                    <div class="col-lg-12 col-12 payment-mob-tag">
                        <div class="payment-tag">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/wu.png" alt="">
                                <p class="payment-name">Western Union</p>
                                <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12 payment-details-bank">
                        <div class="payment-details">
                            <div class="wu-pay-head">
                                <p>If you wish to make a payment through Western Union</p> 
                                <p>Please contact our customer care or chat support for further assistance.Please contact the number below to connect directly on call or chat,</p>    
                            </div>
                        </div>
                        <div class="contact-option">
                            <div class="swipe-call">
                                <div id="slider3" class="col-10">
                                </div>
                                <p>Swipe to call</p>
                            </div>
                            <button class="chat-crisp" onclick='opencrisp("<?php echo $invoiceno; ?>")'>
                            <img src="https://myglobal1.gumlet.io/payment-logo/chat.png?w=21" class="chat-icon" alt=""> Chat With Us
                            </button>
                        </div>
                        
                        <div class="payment-note">
                            <!-- <p>Kindly Add Note as a Newlands Clothings</p> -->
                            <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                        </div>
                    </div>  
                <?php
                    }elseif($payMethod=='mg'){
                        ?>
                            <div class="col-lg-12 col-12 payment-mob-tag">
                                <div class="payment-tag">
                                    <div class="left-side">
                                        <img src="https://myglobal1.gumlet.io/payment-logo/moneygram.png" alt="">
                                        <p class="payment-name">MoneyGram</p>
                                        <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-12 payment-details-bank">
                                <div class="payment-details">
                                    <div class="wu-pay-head">
                                        <p>If you wish to make a payment through Western Union</p> 
                                        <p>Please contact our customer care or chat support for further assistance.Please contact the number below to connect directly on call or chat,</p>    
                                    </div>
                                </div>
                                <div class="moneygram contact-option">
                                    <div class="swipe-call">
                                        <div id="slider3" class="col-10">
                                        </div>
                                        <p>Swipe to call</p>
                                    </div>
                                    <button class="chat-crisp" onclick='opencrisp("<?php echo $invoiceno; ?>")'>
                                    <img src="https://myglobal1.gumlet.io/payment-logo/chat.png?w=21" class="chat-icon" alt=""> Chat With Us
                                    </button>
                                </div>
                                <div class="payment-note">
                                    <!-- <p>Kindly Add Note as a Newlands Clothings</p> -->
                                    <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>  
                        <?php
                            }elseif($payMethod=='bt'){
                                ?>
                                <div class="col-lg-12 col-12 payment-mob-tag">
                                    <div class="payment-tag">
                                        <div class="left-side">
                                            <img src="https://myglobal1.gumlet.io/payment-logo/bitcoin1.png" alt="">
                                            <p class="payment-name">Bitcoin</p>
                                            <p class="top-note">Note to buyer <span class="flashName"><i>Leave it Blank or Pets Food</i></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-12 payment-details-bank">
                                    <div class="payment-details">
                                        <div class="qr-info">
                                            <p>Scan This QR Code</p>
                                            <img src="https://myglobal1.gumlet.io/payment-logo/bitcoinqr.png?w=122" alt="">
                                            <p onclick="saveFile('https://myglobal1.gumlet.io/payment-logo/bitcoinqr.png')" style="cursor:pointer;">Download <img src="https://myglobal1.gumlet.io/payment-logo/download.png" class="download-icon" alt=""></p>
                                        </div>
                                        <div class="sample-text">
                                            <p>OR</p>
                                        </div>
                                        <div class="bank-info">
                                            <p>Bitcoin Details</p>
                                            <p class="number" onclick="codeCopyAny1('3QQEkPGGbmaXvjmyUNpXr5if8rCfQ4WufE')">3QQEkPGGbmaX...</p>
                                            <div class="bank-copy-text" onclick="codeCopyAny1('3QQEkPGGbmaXvjmyUNpXr5if8rCfQ4WufE')"><img src="https://myglobal1.gumlet.io/payment-logo/copy.png?w=16" alt=""> Click to copy</div>
                                        </div>
                                    </div>
                                    <div class="instruction">
                                        <p>Instructions to Pay:</p>
                                        <ul>
                                            <li>Open your  bitcoin wallet app.</li>
                                            <li>Click on Send Payment.</li>
                                            <li>Enter the amount you want to send.</li>
                                            <li>Scan the QR code or wallet address of the recipient.</li>
                                            <li>Click Send.</li>
                                        </ul>
                                    </div>
                                    <div class="payment-note">
                                        <!-- <p>Kindly Add Note as a Newlands Clothings</p> -->
                                        <button class="payment-confirm">I Have Made My Payment</button>
                                        <?php
                                    if($source!='MAN'){
                                        
                                ?>
                                <button class="change-payment" data-inv="<?php echo $invoiceno; ?>">Change Payment Method</button>
                                <?php
                                    }
                                ?>
                                    </div>
                                </div>
                                <?php
                                    }
                ?>
                


                <?php
                    if($payMethod!='wu'){
                ?>
                <div class="col-lg-3 col-12 timer-ring">
                    <div class="time-text">
                        <p>Your Payment Session WIll Expire In</p>
                    </div>
                    <div class="outerRing">
                        <div class="outerRing2">
                        </div>
                        <div class="timer">
                            <div id="time">
                                <span id="minutes">10</span>
                                <span id="colon">:</span>
                                <span id="seconds">00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                 }else {
                ?>
                    <div class="wu-time" style="display:none;">
                        <div class="outerRing">
                        </div>
                        <span id="minutes">10</span>
                        <span id="colon">:</span>
                        <span id="seconds">00</span>
                    </div>
                <?php
                 }
                ?>
                <div class="col-lg-4 col-12 order-details">
                    <div class="product-box">
                        <div class="headline">Product Details</div>

                        <?php
                            $i=0;
                            $getProduct = $conn->prepare('SELECT * FROM ogorderproduct WHERE orderid=?');
                            $getProduct->execute([$invoiceno]);
                            while($pro=$getProduct->fetch(PDO::FETCH_ASSOC)){
                                ++$i;
                        ?>

                        <div class="product-list">
                            <div class="product-datas">
                                <div class="num"><?php echo $i; ?></div>
                                <div class="name">
                                    <div class="pro-name"><?php echo $pro['productName'] ?></div>
                                    <div class="prodata">
                                        <div class="str"><?php echo $pro['strength'] ?></div>
                                        <div class="qty"><?php echo $pro['quantity'] ?> pills</div>
                                    </div>
                                    <div class="del-option">
                                        <?php
                                            
                                            if(strpos($pro['productName'],'to US')>0){
                                                echo 'USA to USA Delivery';
                                            }else {
                                                echo 'Standard Delivery';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="product-price">
                                <div class="disPrice">$<?php echo $pro['total'] ?></div>
                                <!-- <div class="realPrice">$<?php echo $pro['orgPrice'] ?></div> -->
                            </div>
                        </div>

                        <?php
                            }
                        ?>

                        <div class="shipping-list">
                            <div class="ship-head">Shipping Charges</div>
                            <div class="ship-rate">
                                <?php 
                                    if($dcharge>0){
                                        echo '$'.$dcharge;
                                    }else {
                                        echo '<i class="fa-solid fa-circle-check"></i> Free';
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <div class="total-pro-price">
                            <div class="head">Total</div>
                            <div class="total-rate">
                            <?php 
                                if($payMethod=='cashapp' or $payMethod=='zelle'){
                            ?>
                            <p class="success-icon"></p>$<?php echo $total; ?> 
                            <!-- <span class="del" style="font-family: 'Poppins';font-style: normal;font-weight: 600;font-size: 14px;line-height: 21px;text-decoration-line: line-through;color: #9C0808;"> $<?php echo $subtotal+$dcharge; ?></span> -->
                        </div>
                            <?php
                                }else {
                                    
                            ?>
                            <p class="success-icon"></p>$<?php echo $total; ?></div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="customer-box">
                        <div class="headline">User Details</div>
                            <div class="user info">
                                <div class="user-meta">
                                    <div class="name-details">
                                        <div class="name-title">Name</div>
                                        <div class="name-value"><?php echo $name ?></div>
                                    </div>
                                    <div class="phone-details">
                                        <div class="phone-title">Mobile Number</div>
                                        <div class="phone-value"><?php echo $phone ?></div>
                                    </div>
                                </div>
                                <div class="address-details">
                                    <div class="address-title">Communication Address</div>
                                    <div class="address-value"><?php echo $row['addressline1']." ".$row['addressline2'].", ".$row['city'].", ".$row['state'].", ".$row['country']." ".$row['postalcode'] ?></div>
                                </div>
                                <div class="email-details">
                                    <div class="email-title">Email</div>
                                    <div class="email-value"><?php echo $row['email'] ?></div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include( 'include/footer.php'); ?>
