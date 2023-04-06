<?php 
  $productSeoTitle = "Newlands Pharmacy Offers & Coupon Codes: Upto 80%Off";
  $productSeoDescription = "Newlands Pharmacy Offers & Coupon Codes: Upto 80%Off,";
  include('include/header.php'); 
  error_reporting(1);
?>
<?php include('include/sidenav.php'); ?>

    <!-- Page-->
    <main class="offcanvas-enabled" style="padding-top: 5rem;">
        <div class="container-fluid">
            <div class="row">
                <section class="offersection">
                    <h2 style="padding: 0 15px; text-align:center;">Newlands Pharmacy Offers & Coupon Codes</h2>
                    <div class="list-coupon">
                        <?php
                            $selectCouponData = $conn->prepare("SELECT * FROM discount WHERE status='1'");
                            $selectCouponData->execute();
                            $totalCoupon= $selectCouponData->rowCount();
                            if($totalCoupon>0){
                                while($row=$selectCouponData->fetch(PDO::FETCH_ASSOC)){
                                    $offer = $row['discount'].'%Off';
                                    $dis = $row['discount'].'% <br>OFF';
                                    $des  =$row['description'];
                                    $code  =$row['code'];
                                    $link = $row['link'];
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
                                    <p>No Code Required</p>
                                </div>
                                <div class="code-copy">
                                    <p><a href="<?php echo $link ?>">Continue</a></p>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }else {
                        ?>
                            <div class="not-found">
                                <img src="https://gcdnb.pbrd.co/images/GALPIMxtWp9X.png?o=1">
                                <h2>Sorry! Currently no offers available</h2>
                            </div>

                        <?php
                            }
                        ?>
                    </div>
	            </section>
            </div>
        </div>
</main
    <!-- Footer-->
      
<?php include('include/footer.php'); ?>