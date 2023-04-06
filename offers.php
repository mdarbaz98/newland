<?php 
  $productSeoTitle = "Newlands Pharmacy Offers & Coupon Codes: Upto 80%Off";
  $productSeoDescription = "Newlands Pharmacy Offers & Coupon Codes: Upto 80%Off,";
  include('include/header.php'); 
?>
<?php include('include/sidenav.php'); ?>

    <!-- Page-->
    <main class="offcanvas-enabled" style="padding-top: 5rem;">
        <div class="container-fluid">
            <div class="row">
                <section class="offersection">
                    <h2 style="padding: 0 15px;">Newlands Pharmacy Offers & Coupon Codes</h2>
                    <p style="padding: 0 15px;">Newlands Pharmacy is trusted online pharmacy store that provides a wide variety of medications. We make the best use of 
                    Mobile and Web Technology to make sure that you get access to the best medicines, with attractive discounts & in the shortest 
                    time possible.</p>
                    <p style="padding: 0 15px;"><b>Hurry! Avail these exclusive Newlands Pharmacy offers now.</b></p>
                    
                    <div class="list-coupon">
                        <?php
                            $selectCouponData = $conn->prepare("SELECT * FROM coupons WHERE status='1'");
                            $selectCouponData->execute();
                            $totalCoupon= $selectCouponData->rowCount();
                            if($totalCoupon>0){
                                while($row=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                                    if($row['isTypePercentage']){
                                        $offer = $row['discount'].'%Off';
                                        $dis = $row['discount'].'% <br>OFF';
                                    }else {
                                        $offer = '$'.$row['discount'].' OFF';
                                        $dis = '$'.$row['discount'].' <br>OFF';
                                    }
                                    $des  =$row['description'];
                                    $code  =$row['code'];
                        ?>
                        <div class="coupon-item">
                            <div class="coupon-data">
                                <div class="image">
                                   
                                    <p><?php echo $dis; ?></p>
                                </div>
                                <div class="des">
                                    <h4>FLAT <?php echo $offer; ?></h4>
                                    <p><?php echo $des; ?></p>
                                </div>
                                <div class="goto">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </div>
                            <div class="coupon-code">
                                <div class="code-dis">
                                    <p>Code: <span class="code"><?php echo $code; ?></span></p>
                                </div>
                                <div class="code-copy">
                                    <p onclick="copyanycode('<?php echo $code; ?>')">CODE COPY</p>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
	            </section>
            </div>
        </div>
</main
    <!-- Footer-->
      
<?php include('include/footer.php'); ?>