<?php 
    $productSeoTitle = "Payment Methods";
    $productSeoDescription = "Payment Methods";
    include( 'include/header.php'); 
?>
<?php include( 'include/sidenav.php'); ?>

<main class="offcanvas-enabled " style="margin-left: 0px !important; margin-right: 0px !important; margin-top: 120px !important; padding-bottom: 50px;">
    <div class="payment-section">

        <div class="container-fluid m-0 p-0">
            <div class="row m-0">
                <div class="col-lg-6 col-12 p-0 payment-description">
                    <h2>Payment Methods</h2>
                    <p id="pm1">The number of ways in which merchants can collect payments from their customers are called payment modes, for example, credit cards, digital wallets, direct debit, offline payment, etc. In a store, perhaps you use cash, credit cards, or mobile payment options like Apple Pay, Google pay etc.</p>

                    <p id="pm2">Currently at Newlands Pharmacy, we are offering a variety of payment options for our valued customers to ease the payment process such as Cash App, Zelle, Western Union, Money Transfer, Bitcoin & Wire Transfer. All the payment modes are safe, secured and trusted by its users. </p>

                    <p id="pm3">Due to technical issues, we’re currently not accepting payments through Credit card & Debit card. Therefore we request our valued customers to use other safe & secure payment options available on our website to continue your purchase. Our technical team is working to resolve this issue, we’ll notify you once the issue is resolved.</p>

                    <div class="link"  data-bs-toggle="modal" data-bs-target="#payment-expand-modal">
                        <div class="tranlate">
                            <i class="fa-solid fa-arrow-right left"></i> 
                            <span>Read More</span> 
                            <i class="fa-solid fa-arrow-right right"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 payment-logo">
                    <div class="logo-line-first">
                        <img src="image/credit.png" alt="">
                        <img src="image/zelle.png" alt="">
                        <img src="image/wire.png" alt="">
                    </div>
                    <div class="logo-line-second">
                        <img src="image/bitcoin.png" alt="">
                        <img src="image/cashapp.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-12 pay-opt">
                    
                    <div class="row m-0 p-0">
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box right-margin creditbox">
                                <img src="image/credit.png" alt="">
                                <h2>Credit Card</h2>
                                <div class="front-data">
                                    <p>Most of the credit card transactions are secured, but for adding an extra layer of security in our customer’s transaction we’re working relentlessly & due to this technical upgrade time we are currently not accepting Credit card payments.</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Most of the credit card transactions are secured, but for adding an extra layer of security in our customer’s transaction we’re working relentlessly & due to this technical additional time we are currently not accepting Credit card payments.A credit card is a payment card issued to users (cardholders) to enable the cardholder to pay a merchant for goods and services based on the cardholder's accrued debt.Alternatives to credit cards include debit cards, mobile payments, digital wallets, cryptocurrencies, pay-by-hand, bank transfers.</p>
                                    </div>
                                </div>
                                <!-- <div class="link" data-bs-toggle="modal" data-bs-target="#payment-modal">
                                    <span>Read More</span> <i class="fa-solid fa-arrow-right"></i>
                                </div> -->
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='credit'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box left-margin debitbox">
                                <img src="image/credit.png" alt="">
                                <h2>Debit Card</h2>
                                <div class="front-data">
                                    <p>Banks provide the most secure payment getaways to ensure security and safety for their customers' privacy. To ensure the same level of security on our servers & provide maximum possible security to our customers’ transactions</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Banks provide the most secure payment getaways to ensure security and safety for their customers' privacy. To ensure the same level of security on our servers & provide maximum possible security to our customers’ transactions. We are upgrading ourselves and therefore, we’re not accepting payments by debit cards for now.In simple words, while transacting with a debit card; money is debited from the user's account and is paid to the respective receiver, which is done by the user's bank.
                                    </div>
                                </div>
                                <!-- <div class="link" data-bs-toggle="modal" data-bs-target="#payment-modal">
                                    <span>Read More</span> <i class="fa-solid fa-arrow-right"></i>
                                </div> -->
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='debit'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box cashappbox">
                                <img src="image/cashapp.png" alt="">
                                <h2>Cash App</h2>
                                <div class="front-data">
                                    <p>It is a secure mobile payment service application introduced in 2013. It is available on iOS & Android & it's widely used in the United States of America & United Kingdom. Cash App has reported trusted payment method by 70 million</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                    <p>It is a secure mobile payment service application introduced in 2013. It is available on iOS & Android & it's widely used in the United States of America & United Kingdom. Cash App has reported trusted payment method by 70 million users.</p>
                                    <h3>How to Pay</h3>
                                    <h4>If you are new user</h4>
                                    <ul>
                                        <li>Visit <a href="https://cash.app/">https://cash.app/</a></li>
                                        <li>Download on your device</li>
                                        <li>Create an account</li>
                                        <li>Connect to your bank account</li>
                                        <li>Add cash to your Cashapp</li>
                                        <li>Scan QR code / enter receiver’s number</li>
                                        <li>Pay for shopping</li>
                                        <li>For more information kindly contact our customer service executive</li>
                                    </ul>
                                    <h4>If you are existing user</h4>
                                    <ul>
                                        <li>Scan QR code OR enter our contact details as mentioned on process payment page</li>
                                        <li>Pay the amount shown on the screen</li>
                                        <li>For more information kindly contact our customer service executive</li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='cashapp'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box zellebox left-margin">
                                <img src="image/zelle.png" alt="">
                                <h2>Zelle</h2>
                                <div class="front-data">
                                    <p>Zelle is a digital payments network, which is ultimately owned by reputed banks in the United States of America. Zelle enables its users to electronically transfer money from their bank account to another registered user’s bank account.</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Zelle is a digital payments network, which is ultimately owned by reputed banks in the United States of America. Zelle enables its users to electronically transfer money from their bank account to another registered user’s bank account. Currently, there are 61.1 million Zelle users worldwide.Payments app Zelle processes more payments than apps like Venmo. Several of the largest banks banded together to launch Zelle two years ago. It's different from other payment apps because you don't have to wait to receive the money in your bank account.</p>
                                        <h3>How to Pay</h3>
                                        <h4>If you are new user</h4>
                                        <ul>
                                            <li>Download on your device</li>
                                            <li>Create an account</li>
                                            <li>Connect to bank account</li>
                                            <li>Scan QR code / enter receiver’s number</li>
                                            <li>Pay for shopping</li>
                                            <li>In case, if you don’t have Zelle app, kindly download the app from this link <a href="https://www.zellepay.com/go/zelle">https://www.zellepay.com/go/zelle</a></li>
                                        </ul>
                                        <h4>If you are existing user</h4>
                                        <ul>
                                            <li>Open Zelle app</li>
                                            <li>Scan the QR code or enter details shown on the screen</li>
                                            <li>Pay for the amount displayed on the screen</li>
                                            <li>For more information kindly contact our customer service executive</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='zelle'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box venmobox">
                                <img src="https://myglobal1.gumlet.io/payment-logo/Venmo-footer.png" alt="">
                                <h2>Venmo</h2>
                                <div class="front-data">
                                    <p>Venmo is a mobile payment company founded in 2009 and based in America.
                                    Paypal is the parent company of Venmo and it is only operational in America itself.
                                    You can transfer money to anyone with help of Venmo but the sender and receiver
                                    both should be in America.</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                    <p>Venmo is a mobile payment company founded in 2009 and based in America.
                                    Paypal is the parent company of Venmo and it is only operational in America itself.
                                    You can transfer money to anyone with help of Venmo but the sender and receiver
                                    both should be in America.</p>
                                    <h3>How to Pay</h3>
                                    <h4>If you are new user</h4>
                                    <ul>
                                        <li>If you are a new user you need to create an account by providing your bank account details.</li>
                                        <li>You need a valid email address and phone number of the United States for creating an account.</li>
                                        <li>When you are done with creating the account you can pay through Phone number, Venmo username or email address.t</li>
                                        <li>After entering the given number, check the amount and proceed through the security passwords.</li>
                                    </ul>
                                    <h4>If you are existing user</h4>
                                    <ul>
                                        <li>You just need to enter the given number on your Venmo app and check the account details.</li>
                                        <li>Enter the amount manually and check it once and proceed the transaction by security passwords and you are good to go!</li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='venmo'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box applepaybox left-margin">
                                <img src="https://myglobal1.gumlet.io/payment-logo/ApplePay-footer.png" alt="">
                                <h2>Apple Pay</h2>
                                <div class="front-data">
                                    <p>Apple Pay is a mobile payment mode made by Apple Inc. it is already installed in
                                    your Apple phone, watch and Mac and Ipad. Apple Pay is heavily secured and very
                                    easy to use.</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Apple Pay is a mobile payment mode made by Apple Inc. it is already installed in
                                        your Apple phone, watch and Mac and Ipad. Apple Pay is heavily secured and very
                                        easy to use.</p>
                                        <p>Apple is one of the best payment [option you can get, it has come into existence
                                        from October 2014 and became one of the most popular payment methods. Apple
                                        Pay is only available for Apple devices only.</p>
                                        <h3>How to Pay</h3>
                                        <h4>If you are new user</h4>
                                        <ul>
                                            <li>Open Apple pay on your Apple device and create your profile.</li>
                                            <li>Tap on Add Card and enter your credit or debit card information to get your card registered and activated.</li>
                                            <li>Verify your information with the bank and after the confirmation you have
                                            successfully done the process and are ready to make payments.</li>
                                            <li>You can pay by tapping your phone to the code or you can also pay by
                                            entering phone number.</li>
                                            <li>After entering the phone number you can proceed with the payment by security code or face identification.</li>
                                        </ul>
                                        <h4>If you are existing user</h4>
                                        <ul>
                                            <li>You just need to enter the given phone number on your Apple Pay app and enter the correct amount.</li>
                                            <li>Proceed your payment by entering the password or using your face id.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='applepay'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box gpay">
                                <img src="https://myglobal1.gumlet.io/payment-logo/google-pay.png" alt="">
                                <h2>Google Pay</h2>
                                <div class="front-data">
                                    <p>Google pay is the most popular and secured online payment mode across the globe.
                                    It is the best option for contactless payments. Google pay has been improving global
                                    payments since 2011..</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Google pay is the most popular and secured online payment mode across the globe.
                                        It is the best option for contactless payments. Google pay has been improving global
                                        payments since 2011.</p>
                                        <p>Google Pay is currently available in 46 countries and you make payments through
                                        scanning QR codes and phone numbers and also bank transfers.Transaction are
                                        extremely secured with Google’s security.</p>
                                        <h3>How to Pay</h3>
                                        <h4>If you are new user</h4>
                                        <ul>
                                            <li>Create an account on Google pay by filling all the necessary details.</li>
                                            <li>Go through the one time KYC process.</li>
                                            <li>Set your security passwords.</li>
                                            <li>Scan the QR code with your Google Pay scanner or else you can pay by the given phone number.</li>
                                            <li>Check the amount and proceed by entering your security code.</li>
                                        </ul>
                                        <h4>If you are existing user</h4>
                                        <ul>
                                            <li>Open and Unlock your Google Pay app and scan the given QR code or enter the given phone number.</li>
                                            <li>If you have scanned the QR code then the amount will be automatically
                                            entered there and if you are proceeding with a phone number then you have
                                            to manually enter the amount.</li>
                                            <li>Check the amount and proceed with the payment by entering your security code, and it's done.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='gpay'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box chimebox left-margin">
                                <img src="https://myglobal1.gumlet.io/payment-logo/Chime-footer.png" alt="">
                                <h2>Chime</h2>
                                <div class="front-data">
                                    <p>Chime is an America based financial technology company founded in 2012. The mobile based 
                                        online transaction services of Chime are provided by Stride Bank or The Bancorp Bank. </p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Chime is an America based financial technology company founded in 2012. The mobile based 
                                        online transaction services of Chime are provided by Stride Bank or The Bancorp Bank. </p>
                                        <p>The account holders of Chime are provided visa debit and credit cards which are operational on Chime’s 
                                        official website and on its mobile app. Chime is a secured and safe payment system which you can easily operate and rely on.</p>
                                        <h3>How to Pay</h3>
                                        <ul>
                                            <li>Log in to your Chime mobile app.</li>
                                            <li>Select the Pay Anyone tab.</li>
                                            <li>Search for your friend's or receiver’s name or
                                            $ChimeSign, or enter the email or phone number of someone who isn't on Chime or
                                            in your contact list.</li>
                                            <li>Enter the amount to send to the recipient and the reason that you're sending the money.</li>
                                            <li>Confirm the amount and the recipient.</li>
                                            <li>Click send.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='chime'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box wirebox">
                                <img src="image/wire.png" style="width: 62px;">
                                <h2>Wire Transfer</h2>
                                <div class="front-data">
                                    <p>Wire Transfer is another method of electronic funds transfer from one person or entity to another. A wire transfer is a secured mode of payment that can be made from one bank account to another bank account. Almost all banks support</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Wire Transfer is another method of electronic funds transfer from one person or entity to another. A wire transfer is a secured mode of payment that can be made from one bank account to another bank account. Almost all banks support wire transfer, but before proceeding we request you to confirm with your bank. Wire transfers offer convenience when sending money or paying bills electronically. In terms of speed, wire transfers tend to process much more quickly and safely.</p>
                                        <h3>How to Pay</h3>
                                        <ul>
                                            <li>To pay by Wire Transfer, a user must have a bank account</li>
                                            <li>Senders pay for the transaction at the remitting bank and provide the recipient's name, bank account number, and the amount transferred.</li>
                                            <li>The recipient's name, address, contact number, along with any other personal information required to facilitate the transaction</li>
                                            <li>The recipient's banking information, including their account number and branch number</li>
                                            <li>The receiving bank's information, which includes the institution's name, address, and bank identifier (routing number or SWIFT code)</li>
                                            <li>The reason for the transfer</li>
                                            <li>International wire payments are monitored by the Office of Foreign Assets Control to ensure the money isn't being wired to terrorist groups or for money laundering purposes.</li>
                                            <li>For more information kindly contact our customer service executive</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='wire-transfer'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box westernbox right-margin">
                                <img src="image/western.png" style="width: 165px;">
                                <h2>Western Union</h2>
                                <div class="front-data">
                                    <p>Western Union Money Transfer is one of the oldest & most trusted modes of domestic & international money transfer. Western Union has been serving their customers since the 1980s.Western Union has more than 150 million</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Western Union Money Transfer is one of the oldest & most trusted modes of domestic & international money transfer. Western Union has been serving their customers since the 1980s.Western Union has more than 150 million customers across 200 countries and territories with a 130 currency portfolio. In many parts of the world, banks charge high fees if you want to transfer money. With Western Union’s money transfer services, you always know the exchange rates and fees before you make a transaction. If you transfer to an international bank account on a regular basis, you should only have to input the receiver’s details when making your first transaction</p>
                                        <h3>How to Pay</h3>
                                        <ul>
                                            <li>Log in/Create new account</li>
                                            <li>Enter destination/amount</li>
                                            <li>Select send to a bank account</li>
                                            <li>Select payment method</li>
                                            <li>Enter receiver’s bank name/code/account number</li>
                                            <li>Save receiver’s details to make repeat transfer faster & easier</li>
                                            <li>You’ll receive MTCN number after transaction is initiated</li>
                                            <div class="text-center"><b>OR</b></div>
                                            <li>Visit  nearest Western Union Money Transfer Centre, provide receiver’s details</li>
                                            <li>Pay the exact amount mentioned on the invoice</li>
                                            <li>For more information kindly contact our customer service executive</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='western'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box moneygrambox left-margin">
                                <img src="image/moneygram.png" style="width: 170px;">
                                <h2>Money Gram</h2>
                                <div class="front-data">
                                    <p>MoneyGram is an American company with headquarters in Texas. The company provides its services to individuals and businesses through a network of agents & financial institutions. MoneyGram operates in more than 200 countries.</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>MoneyGram is an American company with headquarters in Texas. The company provides its services to individuals and businesses through a network of agents & financial institutions. MoneyGram operates in more than 200 countries. MOneyGram has grown to serve nearly 150 million people across the globe over the last five years. it's highly trusted and is the second-biggest name in the money transfer industry. So, you can trust that with MoneyGram, your money will get to the recipient fast and secure.</p>
                                        <h3>How to Pay</h3>
                                        <ul>
                                            <li>Download the free MoneyGram Online Money Transfer app</li>
                                            <li>Log into your MoneyGram Online profile or create a new one</li>
                                            <li>Enter receiver’s details</li>
                                            <li>Choose your payment method</li>
                                            <li>Complete your transaction</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='moneygram'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-6 col-12 p-0">
                            <div class="payment-box bitcoinbox left-margin">
                                <img src="image/bitcoin.png">
                                <h2>Bitcoin</h2>
                                <div class="front-data">
                                    <p>Bitcoin is the most modern mode of payment. Bitcoin is basically decentralised digital currency that can be transferred on the peer to peer bitcoin network. Bitcoin transactions are verified by network nodes which are secured</p>
                                </div>
                                <div class="back-data">
                                    <div class="payment-data">
                                        <p>Bitcoin is the most modern mode of payment. Bitcoin is basically decentralised digital currency that can be transferred on the peer to peer bitcoin network. Bitcoin transactions are verified by network nodes which are secured and encrypted in nature. Bitcoin transactions operate more like cash: exchanged person-to-person without a financial intermediary. Essentially, by using bitcoins users will be contributing to the network, and thus sharing the burden of authorizing transactions. Sharing this work greatly reduces transaction costs, and thus makes transaction costs negligible. Once Bitcoins are sent, the transaction cannot be reversed.</p>
                                        <h3>How to Pay</h3>
                                        <h4>For New Users</h4>
                                        <ul>
                                            <li>Download bitcoin application from App Store/Play Store like Coinbase Commerce,Circle, Bitpay, Coinomi</li>
                                            <li>Log in or Register using your details</li>
                                            <li>Scan QR code / Enter 34 digit wallet address</li>
                                            <li>Enter exact amount mentioned on invoice</li>
                                            <li>Send it</li>
                                            <li>For more information kindly contact our customer service executive</li>
                                        </ul>
                                        <h4>For Existing Users</h4>
                                        <ul>
                                            <li>Open your bitcoin payment application</li>
                                            <li>Click on send coins option</li>
                                            <li>Open QR code scanner on your app</li>
                                            <li>Scan our QR code</li>
                                            <li>Enter amount to pay</li>
                                            <li>Press send and your payment is done</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-more">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link mob-button-payment show-less">
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Show Less</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                                <div class="link desk-button-payment" id='bitcoin'>
                                    <div class="tranlate">
                                        <i class="fa-solid fa-arrow-right left"></i> 
                                        <span>Read More</span> 
                                        <i class="fa-solid fa-arrow-right right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="payment-expand-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body tab-content">
                    <h2>Payment Methods</h2>

                    <p>The number of ways in which merchants can collect payments from their customers are called payment modes, for example, credit cards, digital wallets, direct debit, offline payment, etc. In a store, perhaps you use cash, credit cards, or mobile payment options like Apple Pay, Google pay etc.</p>
                    <br>
                    <p>Currently at Newlands Pharmacy, we are offering a variety of payment options for our valued customers to ease the payment process such as Cash App, Zelle, Western Union, Money Transfer, Bitcoin & Wire Transfer. All the payment modes are safe, secured and trusted by its users. </p>
                    <br>
                    <p>Due to technical issues, we’re currently not accepting payments through Credit card & Debit card. Therefore we request our valued customers to use other safe & secure payment options available on our website to continue your purchase. Our technical team is working to resolve this issue, we’ll notify you once the issue is resolved.</p>

                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body tab-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="credit pay-section payment-data">
                        <img src="image/credit.png" alt="">
                        <h2>Credit Card</h2>
                        <p>Most of the credit card transactions are secured, but for adding an extra layer of security in our customer’s transaction we’re working relentlessly & due to this technical upgrade we are currently not accepting Credit card payments.A credit card is a payment card issued to users (cardholders) to enable the cardholder to pay a merchant for goods and services based on the cardholder's accrued debt.Alternatives to credit cards include debit cards, mobile payments, digital wallets, cryptocurrencies, pay-by-hand, bank transfers.</p>
                    </div>
                    <div class="debit pay-section payment-data">
                        <img src="image/credit.png" alt="">
                        <h2>Debit Card</h2>
                        <p>Banks provide the most secure payment getaways to ensure security and safety for their customers' privacy. To ensure the same level of security on our servers & provide maximum possible security to our customers’ transactions. We are upgrading ourselves and therefore, we’re not accepting payments by debit cards for now.In simple words, while transacting with a debit card; money is debited from the user's account and is paid to the respective receiver, which is done by the user's bank.</p>
                    </div>
                    <div class="cashapp pay-section payment-data">
                        <img src="https://myglobal1.gumlet.io/payment-logo/cashapp.png?w=93" alt="">
                        <h2>Cash App</h2>
                        <p>It is a secure mobile payment service application introduced in 2013. It is available on iOS & Android & it's widely used in the United States of America & United Kingdom. Cash App has reported trusted payment method by 70 million users.</p>
                        <h3>How to Pay</h3>
                        <h4>If you are new user</h4>
                        <ul>
                            <li>Visit <a href="https://cash.app/">https://cash.app/</a></li>
                            <li>Download on your device</li>
                            <li>Create an account</li>
                            <li>Connect to your bank account</li>
                            <li>Add cash to your Cashapp</li>
                            <li>Scan QR code / enter receiver’s number</li>
                            <li>Pay for shopping</li>
                            <li>For more information kindly contact our customer service executive</li>
                        </ul>
                        <h4>If you are existing user</h4>
                        <ul>
                            <li>Scan QR code OR enter our contact details as mentioned on process payment page</li>
                            <li>Pay the amount shown on the screen</li>
                            <li>For more information kindly contact our customer service executive</li>
                        </ul>
                    </div>
                    <div class="zelle pay-section payment-data">
                        <img src="image/zelle.png?w=93" alt="">
                        <h2>Zelle</h2>
                        <p>Zelle is a digital payments network, which is ultimately owned by reputed banks in the United States of America. Zelle enables its users to electronically transfer money from their bank account to another registered user’s bank account. Currently, there are 61.1 million Zelle users worldwide.Payments app Zelle processes more payments than apps like Venmo. Several of the largest banks banded together to launch Zelle two years ago. It's different from other payment apps because you don't have to wait to receive the money in your bank account.</p>
                        <h3>How to Pay</h3>
                        <h4>If you are new user</h4>
                        <ul>
                            <li>Download on your device</li>
                            <li>Create an account</li>
                            <li>Connect to bank account</li>
                            <li>Scan QR code / enter receiver’s number</li>
                            <li>Pay for shopping</li>
                            <li>In case, if you don’t have Zelle app, kindly download the app from this link <a href="https://www.zellepay.com/go/zelle">https://www.zellepay.com/go/zelle</a></li>
                        </ul>
                        <h4>If you are existing user</h4>
                        <ul>
                            <li>Open Zelle app</li>
                            <li>Scan the QR code or enter details shown on the screen</li>
                            <li>Pay for the amount displayed on the screen</li>
                            <li>For more information kindly contact our customer service executive</li>
                        </ul>
                    </div>
                    <div class="venmo pay-section payment-data">
                        <img src="https://myglobal1.gumlet.io/payment-logo/Venmo-footer.png?w=93" alt="">
                        <h2>Venmo</h2>
                        <p>Venmo is a mobile payment company founded in 2009 and based in America. Paypal is the parent company 
                            of Venmo and it is only operational in America itself. You can transfer money to anyone with help of 
                            Venmo but the sender and receiver both should be in America.</p>
                        <h3>How to Pay</h3>
                        <h4>If you are new user</h4>
                        <ul>
                            <li>If you are a new user you need to create an account by providing your bank account details.</li>
                            <li>You need a valid email address and phone number of the United States for creating an account.</li>
                            <li>When you are done with creating the account you can pay through Phone number, Venmo username or email address.</li>
                            <li>After entering the given number, check the amount and proceed through the security passwords.</li>
                            
                        </ul>
                        <h4>If you are existing user</h4>
                        <ul>
                            <li>You just need to enter the given number on your Venmo app and check the account details.</li>
                            <li>Enter the amount manually and check it once and proceed the transaction by security passwords and you are good to go!</li>
                        </ul>
                    </div>
                    <div class="gpay pay-section payment-data">
                        <img src="https://myglobal1.gumlet.io/payment-logo/google-pay.png?w=93" alt="">
                        <h2>Google Pay</h2>
                        <p>Google pay is the most popular and secured online payment mode across the globe.
                        It is the best option for contactless payments. Google pay has been improving global
                        payments since 2011.</p>
                        <p>Google Pay is currently available in 46 countries and you make payments through
                        scanning QR codes and phone numbers and also bank transfers.Transaction are
                        extremely secured with Google’s security.</p>
                        <h3>How to Pay</h3>
                        <h4>If you are new user</h4>
                        <ul>
                            <li>Create an account on Google pay by filling all the necessary details.</li>
                            <li>Go through the one time KYC process.</li>
                            <li>Set your security passwords.</li>
                            <li>Scan the QR code with your Google Pay scanner or else you can pay by the given phone number.</li>
                            <li>Check the amount and proceed by entering your security code.</li>
                        </ul>
                        <h4>If you are existing user</h4>
                        <ul>
                            <li>Open and Unlock your Google Pay app and scan the given QR code or enter the given phone number.</li>
                            <li>If you have scanned the QR code then the amount will be automatically
                            entered there and if you are proceeding with a phone number then you have
                            to manually enter the amount.</li>
                            <li>Check the amount and proceed with the payment by entering your security code, and it's done.</li>
                        </ul>
                    </div>
                    <div class="applepay pay-section payment-data">
                        <img src="https://myglobal1.gumlet.io/payment-logo/ApplePay-footer.png?w=93" alt="">
                        <h2>Apple Pay</h2>
                        <p>Apple Pay is a mobile payment mode made by Apple Inc. it is already installed in
                        your Apple phone, watch and Mac and Ipad. Apple Pay is heavily secured and very
                        easy to use.</p>
                        <p>Apple is one of the best payment [option you can get, it has come into existence
                        from October 2014 and became one of the most popular payment methods. Apple
                        Pay is only available for Apple devices only.</p>
                        <h3>How to Pay</h3>
                        <h4>If you are new user</h4>
                        <ul>
                            <li>Open Apple pay on your Apple device and create your profile.</li>
                            <li>Tap on Add Card and enter your credit or debit card information to get your card registered and activated.</li>
                            <li>Verify your information with the bank and after the confirmation you have
                            successfully done the process and are ready to make payments.</li>
                            <li>You can pay by tapping your phone to the code or you can also pay by
                            entering phone number.</li>
                            <li>After entering the phone number you can proceed with the payment by security code or face identification.</li>
                        </ul>
                        <h4>If you are existing user</h4>
                        <ul>
                            <li>You just need to enter the given phone number on your Apple Pay app and enter the correct amount.</li>
                            <li>Proceed your payment by entering the password or using your face id.</li>
                        </ul>
                    </div>
                    <div class="chime pay-section payment-data">
                        <img src="https://myglobal1.gumlet.io/payment-logo/Chime-footer.png?w=93" alt="">
                        <h2>Chime</h2>
                        <p>Chime is an America based financial technology company founded in 2012. The mobile based 
                        online transaction services of Chime are provided by Stride Bank or The Bancorp Bank. </p>
                        <p>The account holders of Chime are provided visa debit and credit cards which are operational on Chime’s 
                        official website and on its mobile app. Chime is a secured and safe payment system which you can easily operate and rely on.</p>
                        <h3>How to Pay</h3>
                        <ul>
                            <li>Log in to your Chime mobile app.</li>
                            <li>Select the Pay Anyone tab.</li>
                            <li>Search for your friend's or receiver’s name or
                            $ChimeSign, or enter the email or phone number of someone who isn't on Chime or
                            in your contact list.</li>
                            <li>Enter the amount to send to the recipient and the reason that you're sending the money.</li>
                            <li>Confirm the amount and the recipient.</li>
                            <li>Click send.</li>
                        </ul>
                    </div>
                    <div class="wire-transfer pay-section payment-data">
                        <img src="image/wire.png" style="width: 62px;">
                        <h2>Wire Transfer</h2>
                        <p>Wire Transfer is another method of electronic funds transfer from one person or entity to another. A wire transfer is a secured mode of payment that can be made from one bank account to another bank account. Almost all banks support wire transfer, but before proceeding we request you to confirm with your bank. Wire transfers offer convenience when sending money or paying bills electronically. In terms of speed, wire transfers tend to process much more quickly and safely.</p>
                        <h3>How to Pay</h3>
                        <ul>
                            <li>To pay by Wire Transfer, a user must have a bank account</li>
                            <li>Senders pay for the transaction at the remitting bank and provide the recipient's name, bank account number, and the amount transferred.</li>
                            <li>The recipient's name, address, contact number, along with any other personal information required to facilitate the transaction</li>
                            <li>The recipient's banking information, including their account number and branch number</li>
                            <li>The receiving bank's information, which includes the institution's name, address, and bank identifier (routing number or SWIFT code)</li>
                            <li>The reason for the transfer</li>
                            <li>International wire payments are monitored by the Office of Foreign Assets Control to ensure the money isn't being wired to terrorist groups or for money laundering purposes.</li>
                            <li>For more information kindly contact our customer service executive</li>
                        </ul>
                    </div>
                    <div class="western pay-section payment-data">
                        <img src="image/western.png" style="width: 185px;">
                        <h2>Western Union Money Transfer</h2>
                        <p>Western Union Money Transfer is one of the oldest & most trusted modes of domestic & international money transfer. Western Union has been serving their customers since the 1980s.Western Union has more than 150 million customers across 200 countries and territories with a 130 currency portfolio. In many parts of the world, banks charge high fees if you want to transfer money. With Western Union’s money transfer services, you always know the exchange rates and fees before you make a transaction. If you transfer to an international bank account on a regular basis, you should only have to input the receiver’s details when making your first transaction</p>
                        <h3>How to Pay</h3>
                        <ul>
                            <li>Log in/Create new account</li>
                            <li>Enter destination/amount</li>
                            <li>Select send to a bank account</li>
                            <li>Select payment method</li>
                            <li>Enter receiver’s bank name/code/account number</li>
                            <li>Save receiver’s details to make repeat transfer faster & easier</li>
                            <li>You’ll receive MTCN number after transaction is initiated</li>
                            <div class="text-center"><b>OR</b></div>
                            <li>Visit  nearest Western Union Money Transfer Centre, provide receiver’s details</li>
                            <li>Pay the exact amount mentioned on the invoice</li>
                            <li>For more information kindly contact our customer service executive</li>
                        </ul>
                    </div>
                    <div class="moneygram pay-section payment-data">
                        <img src="image/moneygram.png" style="width: 185px;">
                        <h2>Money Gram</h2>
                        <p>MoneyGram is an American company with headquarters in Texas. The company provides its services to individuals and businesses through a network of agents & financial institutions. MoneyGram operates in more than 200 countries. MOneyGram has grown to serve nearly 150 million people across the globe over the last five years. it's highly trusted and is the second-biggest name in the money transfer industry. So, you can trust that with MoneyGram, your money will get to the recipient fast and secure.</p>
                        <h3>How to Pay</h3>
                        <ul>
                            <li>Download the free MoneyGram Online Money Transfer app</li>
                            <li>Log into your MoneyGram Online profile or create a new one</li>
                            <li>Enter receiver’s details</li>
                            <li>Choose your payment method</li>
                            <li>Complete your transaction</li>           
                        </ul>
                    </div>
                    <div class="bitcoin pay-section payment-data">
                        <img src="image/bitcoin.png">
                        <h2>Bitcoin</h2>
                        <p>Bitcoin is the most modern mode of payment. Bitcoin is basically decentralised digital currency that can be transferred on the peer to peer bitcoin network. Bitcoin transactions are verified by network nodes which are secured and encrypted in nature. Bitcoin transactions operate more like cash: exchanged person-to-person without a financial intermediary. Essentially, by using bitcoins users will be contributing to the network, and thus sharing the burden of authorizing transactions. Sharing this work greatly reduces transaction costs, and thus makes transaction costs negligible. Once Bitcoins are sent, the transaction cannot be reversed.</p>
                        <h3>How to Pay</h3>
                        <h4>For New Users</h4>
                        <ul>
                            <li>Download bitcoin application from App Store/Play Store like Coinbase Commerce,Circle, Bitpay, Coinomi</li>
                            <li>Log in or Register using your details</li>
                            <li>Scan QR code / Enter 34 digit wallet address</li>
                            <li>Enter exact amount mentioned on invoice</li>
                            <li>Send it</li>
                            <li>For more information kindly contact our customer service executive</li>
                        </ul>
                        <h4>For Existing Users</h4>
                        <ul>
                            <li>Open your bitcoin payment application</li>
                            <li>Click on send coins option</li>
                            <li>Open QR code scanner on your app</li>
                            <li>Scan our QR code</li>
                            <li>Enter amount to pay</li>
                            <li>Press send and your payment is done</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>
<?php include( 'include/footer.php'); ?>
