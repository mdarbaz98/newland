<?php 

    $productSeoTitle = "Payment";
    $productSeoDescription = "Payment";
    include( 'include/header.php'); 
    
?>
<?php 
    include( 'include/sidenav.php'); 
    $invoiceno = $_GET['invoiceno'];
    $getOrderDetails = $conn->prepare('SELECT fname, lname, paymentAgreement,  payMethod, source, subtotal, dcharge, discount, total, ogtotal,paymentMethod FROM orderdetails WHERE orderid=?');
    $getOrderDetails->execute([$invoiceno]);
    while($row=$getOrderDetails->fetch(PDO::FETCH_ASSOC)){
        $subtotal = $row['subtotal'];
        $source = $row['source'];
        $dcharge = $row['dcharge'];
        $discount = $row['discount'];
        $total = $row['total'];
        $currentPay = $row['paymentMethod'];
        $ogtotal = $row['ogtotal'];
        $payMethod = $row['paymentMethod'];
        $paymentAgreement = $row['paymentAgreement'];
        $name = $row['fname']." ".$row['lname'];
        if($paymentAgreement==2){
            echo "<script>window.location.href = 'https://".$INFO_WEBSITE_NAME ."/'</script>";
        }
        if($source=='MAN'){
            if($payMethod!=NULL){
                $_SESSION['payInvoiceOrg'] = $invoiceno;
                $_SESSION['payInvoiceDub'] = $invoiceno;
                $_SESSION['invoiceId'] = $invoiceno;
                echo "<script>window.location.href = 'process-payment';</script>";
            }
            $newtotal = $ogtotal;
            $distot = round(($ogtotal)-(($ogtotal)*0), 2);
        }else {
            $newtotal = ($ogtotal+$dcharge)-$discount;
            $distot = round((($ogtotal+$dcharge)-$discount)-((($ogtotal+$dcharge)-$discount)*0), 2);
        }
    }
?>
<div class="modal fade" id="CredPayment" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style=" text-align: center; ">
          <div class="modal-body tab-content p-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            <div class="main-list">
                <div class="top-headline row">
                    <div class="col-12">
                        <h2>Pay by Credit Card:</h2>
                    </div>
                    <div class="col-12">
                        <img src="./image/payCred.png" alt="" srcset="">
                        <p>Please read the instructions carefully before paying</p>
                    </div>
                </div>
                <div class="scroll-cred-data" id="scroll-cred-data" tabindex="0">
                    <div class="credit-content">
                        <ul>
                            <li>To facilitate safe and hassle-free payments, Newland Pharmacy accepts Credit card via HowToPay.</li>
                            <li>Paying through Credit card is very simple. Just follow the simple steps and make the payment via HowToPay.</li>
                            <li>To proceed to pay with Credit card, customer needs to complete the one time varification (KYC-Know Your Customer) procedure.</li>
                            <li>For completing the KYC process, customer is required to provide the details of 
                                either their Driving Licence, Passport or any other Indetity card.</li>
                            <li>KYC validation is required only for the customers that are paying Credit card; 
                                the customers already registered on How To Pay, don’t need to go through the validation process all over again.</li>
                        </ul>
                        <h3>Step By Step Payment Process</h3>
                        <p class="top-line">Paying through Credit card is very easy and simple.</p>
                        <ul>
                            <li>Customer places an order and selects pay by Credit card option.</li>
                            <li>After clicking on the pay by Credit Card option, the customer is redirected to the Credit card payment gateway.</li>
                            <li>A customer paying by Credit card for the first time must have to enter their basic information in order to complete their KYC procedure.</li>
                            <li>After filling in basic information for the KYC procedure, the customer gets registered through one time validation.</li>
                            <li>After completing all the above given necessary steps, customer is asked to confirm the amount of their 
                                current transaction which will be converted & shown into Thai Baht.</li>
                            <li>Once the customer validates the transaction details, they must fill in the Credit card details 
                                in order to complete the transaction (Applicable for first time user only).</li>
                            <li>After filling in their Credit Card details, customer is redirected to the final payment page, the customer needs to confirm on the transaction details mentioned on the page and click the 'Pay Now' button to finalize the payment.</li>
                            <li>Once the payment is done our Customer Service team gets confirmation of your payment, a payment confirmation email gets send by the team to ensure our customer that their payment is successful & their order is being processed.</li>
                        </ul>
                    </div>
                    <div class="other-pay" id="other-pay">
                        <div class="payment-item cash-app">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/cashapp.png?w=36" alt="">
                                <p class="payment-name">Cash App</p>
                            </div>
                            <div class="right-side">
                                <!-- <p class="offer-text desk-offer" style="color:#11AB36;">Extra 2% Off </p>
                                <p class="offer-text mob-offer" style="color:#11AB36;">Extra 2% Off </p> -->
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="cashapp">Pay <span class="mob-amt1">$<?php echo $distot; ?></span></button>
                        </div>
                        <div class="payment-item zelle">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/zelle.png?w=36" alt="">
                                <p class="payment-name">Zelle</p>
                            </div>
                            <div class="right-side">
                                <!-- <p class="offer-text desk-offer" style="color: #9C36D5;">Extra 2% Off </p> -->
                                <!-- <p class="offer-text mob-offer" style="color: #9C36D5;">Extra 2% Off </p> -->
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="zelle">Pay <span class="mob-amt1">$<?php echo $distot; ?></span></button>
                        </div>

                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/bitcoin1.png?w=36" alt="">
                                <p class="payment-name">BitCoin</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="bt">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>
                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/chime.png?w=36" class="me-2" alt="">
                                <p class="payment-name">Chime</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="chime">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>

                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/apple-pay.png?w=36" class="me-2" alt="">
                                <p class="payment-name">Apple Pay</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="apple-pay">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>

                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/google-pay.png?w=36" class="me-2" alt="">
                                <p class="payment-name">Google Pay</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="google-pay">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>

                        
                    </div>
                </div>
            </div>
            <span class="error-check">You must read all the way to the bottom before proceed.</span>

            <!-- <div class="clcik-toscroll">
                Click to Scroll
                <div class="scroll-up pay-scroll-button" onclick="scrollUp()"><i class="fa-solid fa-caret-up"></i></div>
                <div class="scroll-down pay-scroll-button" onclick="scrollDown()"><i class="fa-solid fa-caret-down"></i></div>
            </div> -->
            <button class="payemnt-button1 cred-pay"  data-invoice="<?php echo $invoiceno ?>"><i class="fa-regular fa-credit-card"></i> &nbsp; Proceed</button>
            <div class="switch-en">
                <span class="note">Switch to other payment method available.</span>
                <button class="cred-pay-close pay-switch"  type="button">Switch</button>
            </div>
            <div class="switch-dis">
                <span class="note">No! I want to switch Credit Card</span>
                <button class="cred-pay-close credit-switch"  type="button">Switch</button>
            </div>
            <!-- <div class="btn-group dropdown">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle cred-pay-close" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Other Method
                </button>
                <div class="dropdown-menu">
                    <a href="#"  
                    data-subtotal="<?php echo $subtotal; ?>"  
                    data-source="<?php echo $source; ?>"  
                    data-dcharge="<?php echo $dcharge ?>" 
                    data-discount="<?php echo $discount ?>" 
                    data-total="<?php echo $total ?>" 
                    data-ogtotal="<?php echo $ogtotal ?>" 
                    data-currentpay="<?php echo $currentPay; ?>" 
                    data-invoice="<?php echo $invoiceno ?>" 
                    data-pname="cashapp" class="dropdown-item payemnt-button"><img src="https://myglobal1.gumlet.io/payment-logo/cashapp.png?w=36" alt=""> Cash App</a>
                    <a href="#"  
                    data-subtotal="<?php echo $subtotal; ?>"  
                    data-source="<?php echo $source; ?>"  
                    data-dcharge="<?php echo $dcharge ?>" 
                    data-discount="<?php echo $discount ?>" 
                    data-total="<?php echo $total ?>" 
                    data-ogtotal="<?php echo $ogtotal ?>" 
                    data-currentpay="<?php echo $currentPay; ?>" 
                    data-invoice="<?php echo $invoiceno ?>" 
                    data-pname="zelle" class="dropdown-item payemnt-button"><img src="https://myglobal1.gumlet.io/payment-logo/zelle.png?w=36" alt=""> Zelle</a>
                    <a href="#" 
                    data-subtotal="<?php echo $subtotal; ?>"  
                    data-source="<?php echo $source; ?>"  
                    data-dcharge="<?php echo $dcharge ?>" 
                    data-discount="<?php echo $discount ?>" 
                    data-total="<?php echo $total ?>" 
                    data-ogtotal="<?php echo $ogtotal ?>" 
                    data-currentpay="<?php echo $currentPay; ?>" 
                    data-invoice="<?php echo $invoiceno ?>" 
                    data-pname="wt" class="dropdown-item payemnt-button"><img src="https://myglobal1.gumlet.io/payment-logo/wiretransfer.png?w=36" alt=""> Wiretrasnfer</a>
                    <a href="#" data-subtotal="<?php echo $subtotal; ?>"  
                    data-source="<?php echo $source; ?>"  
                    data-dcharge="<?php echo $dcharge ?>" 
                    data-discount="<?php echo $discount ?>" 
                    data-total="<?php echo $total ?>" 
                    data-ogtotal="<?php echo $ogtotal ?>" 
                    data-currentpay="<?php echo $currentPay; ?>" 
                    data-invoice="<?php echo $invoiceno ?>" 
                    data-pname="bt" class="dropdown-item payemnt-button"><img src="https://myglobal1.gumlet.io/payment-logo/bitcoin1.png?w=36" alt=""> BitCoin</a>
                </div>
            </div> -->
            
          </div>
        </div>
      </div>
    </div>
<main class="offcanvas-enabled mt-5" style="background:#fff;">
    <section class="payment-option">
        <div class="container-fluid">
            <h2 class="text-center">Choose Payment Options</h2>
            <div class="row">
                    <!-- <div class="col-12">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingone">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true">
                                <h3 class="accord-title">Important Note !</h3>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse show" id="flush-collapseone" aria-labelledby="flush-headingone" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <p>
                                    Name on statment will be <b class="flashName">‘Doggtastic Adventures(Pet Foods)’</b>
                                    </p>
                                    <p style="margin-top: 4px;font-family: 'Poppins'; font-style: normal; font-weight: 600; font-size: 16px; line-height: 24px; color: #000000;">Call On: <?php  echo $_SESSION['phone1'] ?> (If you have any query)</p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-12">
                        <div class="payment-item">
                            <div class="left-side">
                                <img src="./image/Credit-Card-Icons.jpg" alt="">
                                <p class="payment-name">Credit Card</p>
                            </div>
                            <div class="right-side">
                                <button type="button" class="payemnt-button1" data-bs-toggle="modal" data-bs-target="#CredPayment">
                                Pay $<?php echo $newtotal; ?>
                                </button>
                            </div>
                            
                        </div>
                        <div class="payment-item zelle">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/zelle.png?w=36" alt="">
                                <p class="payment-name">Zelle</p>
                            </div>
                            <div class="right-side">
                                <!-- <p class="offer-text desk-offer" style="color: #9C36D5;">Extra 2% Off </p> -->
                                <!-- <p class="offer-text mob-offer" style="color: #9C36D5;">Extra 2% Off </p> -->
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="zelle">Pay <span class="mob-amt1">$<?php echo $distot; ?></span></button>
                        </div>
                        <div class="payment-item cash-app">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/cashapp.png?w=36" alt="">
                                <p class="payment-name">Cash App</p>
                            </div>
                            <div class="right-side">
                                <!-- <p class="offer-text desk-offer" style="color:#11AB36;">Extra 2% Off </p>
                                <p class="offer-text mob-offer" style="color:#11AB36;">Extra 2% Off </p> -->
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="cashapp">Pay <span class="mob-amt1">$<?php echo $distot; ?></span></button>
                        </div>


                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/apple-pay.png?w=36" alt="">
                                <p class="payment-name">Apple Pay</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="apple-pay">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>

                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/google-pay.png?w=36" alt="">
                                <p class="payment-name">Google Pay</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="google-pay">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>



                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/chime.png?w=36" alt="">
                                <p class="payment-name">Chime</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="chime">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>

                        <div class="payment-item">
                            <div class="left-side">
                                <img src="https://myglobal1.gumlet.io/payment-logo/bitcoin1.png?w=36" alt="">
                                <p class="payment-name">BitCoin</p>
                            </div>
                            <div class="right-side">
                            </div>
                            <button class="payemnt-button" data-subtotal="<?php echo $subtotal; ?>"  data-source="<?php echo $source; ?>"  data-dcharge="<?php echo $dcharge ?>" data-discount="<?php echo $discount ?>" data-total="<?php echo $total ?>" data-ogtotal="<?php echo $ogtotal ?>" data-currentpay="<?php echo $currentPay; ?>" data-invoice="<?php echo $invoiceno ?>" data-pname="bt">Pay <span class="mob-amt1">$<?php echo $newtotal; ?></span></button>
                        </div>

                        

                        


                        <div class="payment-item select-note" style="box-shadow:none; border:0px; display: block;">
                            <div class="payment-details">
                                <div class="wu-pay-head">
                                    <p>Looking for another payment method ? No Worries! just make a call or chat with us </p>    
                                </div>
                            </div>
                            <div class="contact-option">
                                <div class="swipe-call">
                                    <div id="slider3" class="col-10">
                                    </div>
                                    <p>Swipe to call</p>
                                </div>
                                <button class="chat-crisp" onclick='opencrispHelp("<?php echo $invoiceno; ?>", "<?php echo $name; ?>")'>
                                <img src="https://myglobal1.gumlet.io/payment-logo/chat.png?w=21" class="chat-icon" alt=""> Chat With Us
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</main>
<?php include( 'include/footer.php'); ?>
<script>
    $(window).scrollTop($('#scroll-cred-data').position().top);
    // $('#scroll-cred-data').attr('tabindex', '0');
    document.getElementById('scroll-cred-data').focus();
    $("#CredPayment").on("show", function () {
        $('#scroll-cred-data').focus();
        document.getElementById('scroll-cred-data').focus();
    }).on("hidden", function () {
        // $("body").removeClass("modal-open")
    });
    function scrollDown() {
        document.getElementById('scroll-cred-data').scrollBy(0,50);
    }
    function scrollUp() {
        document.getElementById('scroll-cred-data').scrollBy(0,-50);
    }
</script>
