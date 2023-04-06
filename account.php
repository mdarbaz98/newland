<?php 
error_reporting(0);
    session_start();
    if(isset($_SESSION['IS_LOGIN'])){
        
    }else {
        header('location:https://'.$INFO_WEBSITE_NAME );
    }
include('include/header.php'); ?>
<?php 
    include('include/sidenav.php'); 
    // if(!isset($_SESSION['IS_LOGIN']) && !isset($_SESSION['EMAIL']) && !isset($_SESSION['USER_ID'])) {
    //     exit(header('location: https://newlandpharmacy.co.uk/'));
    // }
?>
<main class="offcanvas-enabled" style="padding-top: 93px">
  <div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
      <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
        <nav aria-label="breadcrumb">
          <ol
            class="
              breadcrumb breadcrumb-light
              flex-lg-nowrap
              justify-content-center justify-content-lg-start
            "
          >
            <li class="breadcrumb-item">
             <a class="text-nowrap" href="<?php echo $baseUrl; ?>">
                  <i class="fa-solid fa-house"></i>Home > 
            </a>
            </li>
            <li class="breadcrumb-item1 text-nowrap"><a href="#">Account</a></li>
          </ol>
        </nav>
      </div>
      <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
        <h1 class="h3 text-light mb-0">My orders</h1>
      </div>
    </div>
  </div>

  <div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
      <!-- Sidebar-->
      <aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
        <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
          <div
            class="
              d-md-flex
              justify-content-between
              align-items-center
              text-center text-md-start
              p-4
            "
          >
            <div class="d-md-flex align-items-center">
                <?php
                        $selectUser=$conn->prepare("SELECT * FROM ogcustomer WHERE userid='".$_SESSION['USER_ID']."'");
                        $selectUser->execute();
                        $totalUser=$selectUser->rowCount();
                        if($totalUser>0){
                            while($row1=$selectUser->fetch(PDO::FETCH_ASSOC)){
                                $name = $row1['fname']." ".$row1['lname'];
                            }
                        }
                    ?>
              <div class="" style=" padding: 0px 21px; background: #20c5be; color: #fff; border-radius: 32px; font-size: 43px; font-weight: 500; ">
                <?php 
                 echo substr($name,0,1) 
                ?>
              </div>
              <div class="ps-md-3">
                
                    <h3 class="fs-base mb-0"><?php echo $name; ?></h3>
              </div>
            </div>
            <a
              class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0"
              href="#account-menu"
              data-bs-toggle="collapse"
              aria-expanded="false"
              ><i class="fa-solid fa-bars me-2"></i>Account menu</a
            >
          </div>
          <div class="d-lg-block collapse" id="account-menu">
            <div class="bg-secondary px-4 py-3">
              <h3 class="fs-sm mb-0 text-muted">Dashboard</h3>
            </div>
            <ul class="list-unstyled mb-0">
                <?php
                    $getorder=$conn->prepare("SELECT * FROM orderdetails WHERE userid='".$_SESSION['USER_ID']."' order by id DESC");
                    $getorder->execute();
                    $totalOrders=$getorder->rowCount();
                ?>
              <li class="border-bottom mb-0">
                <a
                  class="
                    nav-link-style
                    d-flex
                    align-items-center
                    px-4
                    py-3
                    active
                  "
                  href="account"
                  ><i class="fa-solid fa-bag-shopping opacity-60 me-2"></i>Orders<span
                    class="fs-sm text-muted ms-auto"
                    ><?php echo $totalOrders; ?></span
                  ></a
                >
              </li>
              <li class="border-bottom mb-0">
                 <?php
                    $getwish=$conn->prepare("SELECT * FROM ogcart WHERE userid='".$_SESSION['USER_ID']."' && wishlist=1");
                    $getwish->execute();
                    $totalWish=$getwish->rowCount();
                ?>
                <a
                  class="nav-link-style d-flex align-items-center px-4 py-3"
                  href="wishlist"
                  ><i class="fa-solid fa-heart opacity-60 me-2"></i>Wishlist<span
                    class="fs-sm text-muted ms-auto"
                    ><?php echo $totalWish; ?></span
                  ></a
                >
              </li>
              <!--<li class="mb-0">-->
              <!--  <a-->
              <!--    class="nav-link-style d-flex align-items-center px-4 py-3"-->
              <!--    href="tickets"-->
              <!--    ><i class="ci-help opacity-60 me-2"></i>Support tickets</a-->
              <!--  >-->
              <!--</li>-->
            </ul>
            <div class="bg-secondary px-4 py-3">
              <h3 class="fs-sm mb-0 text-muted">Account settings</h3>
            </div>
            <ul class="list-unstyled mb-0">
              <li class="border-bottom mb-0">
                <a
                  class="nav-link-style d-flex align-items-center px-4 py-3"
                  href="profile"
                  ><i class="fa-solid fa-user opacity-60 me-2"></i>Profile info</a
                >
              </li>
              <li class="border-bottom mb-0">
                <a
                  class="nav-link-style d-flex align-items-center px-4 py-3"
                  href="address"
                  ><i class="fa-solid fa-map-location-dot opacity-60 me-2"></i>Addresses</a
                >
              </li>
              <li class="d-lg-none border-top mb-0">
                <a
                  class="nav-link-style d-flex align-items-center px-4 py-3"
                  href="account-signin"
                  ><i class="fa-solid fa-right-from-bracket opacity-60 me-2"></i>Sign out</a
                >
              </li>
            </ul>
          </div>
        </div>
      </aside>
      <!-- Content  -->
      <section class="col-lg-8">
        <!-- Toolbar-->
        <div
          class="
            d-flex
            justify-content-between
            align-items-center
            pt-lg-2
            pb-4 pb-lg-5
            mb-lg-3
          "
        >
          <div class="d-flex align-items-center"></div>
          <a
            class="btn btn-primary btn-sm d-none d-lg-inline-block"
            href="logout.php"
            ><i class="fa-solid fa-right-from-bracket me-2"></i>Sign out</a
          >
        </div>
        <!-- Orders list-->

        <?php
            $getorder=$conn->prepare("SELECT * FROM orderdetails WHERE userid='".$_SESSION['USER_ID']."' order by id DESC");
            $getorder->execute(); 
            while($row=$getorder->fetch(PDO::FETCH_ASSOC)){ ?>
        <div class="single-order-details">
          <div class="order-meta">
            <div class="row">
              <div class="col-lg-3 col-sm-12">
                <div class="orderid-section">
                  Order
                  <span class="order-no">#<?php echo $row['orderid']; ?></span>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-6 order-date-section">
                <div class="order-date">
                  Order Placed:
                  <?php echo date("D, d M, y", strtotime($row['orderDate'])); ?>
                </div>
              </div>
              <div class="col-6 track-order-section">
                <?php
                    $gettrack=$conn->prepare("SELECT * FROM ogtracking WHERE orderid='".$row['orderid']."'");
                    $gettrack->execute();
                    while($track=$gettrack->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <a href="https://Newlands Pharmacy4d.aftership.com/<?php echo $track['trackingid'] ?>" target="_blank" style="margin-right:2px;" class="track-order-button" style="cursor:pointer;"> + Track</a>
                <?php
                    }
                ?>
              </div>
            </div>
            <br />
            <hr />
            <?php
                $getorderproduct=$conn->prepare("SELECT * FROM ogorderproduct WHERE orderid='".$row['orderid']."'");
                $getorderproduct->execute();
            while($prrow=$getorderproduct->fetch(PDO::FETCH_ASSOC)){
                $productImage=$conn->prepare("SELECT * FROM ogproduct WHERE productCode='".$prrow['productCode']."'"); 
                $productImage->execute();
                while($primage=$productImage->fetch(PDO::FETCH_ASSOC)){ 
                    $image = $primage['productImage']; 
                } ?>
            <div class="cart-main-product1">
              <div
                class="row py-1 product-row"
                style="/* border-bottom: 1px solid #d3d3d3; */"
              >
                <div
                  class="col-5 col-lg-2 text-center d-flex align-items-center"
                >
                  <img
                    src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $image; ?>?w=102"
                    alt=""
                  />
                </div>
                <div
                  class="col-7 col-lg-5"
                  style="
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                  "
                >
                  <a class="product-title" style="color: #000"
                    ><?php echo $prrow['productName'] ?></a
                  >
                  <div class="procuct-specification">
                    <p>
                      <b>Quantity:</b>
                      <?php echo $prrow['quantity'] ?>
                    </p>
                    <p style="margin-left: 3px">
                      <b>Strength:</b>
                      <?php echo $prrow['strength'] ?>
                    </p>
                  </div>
                  <div class="product-pricing">
                    <span
                      style="
                        color: #000;
                        font-weight: 700;
                        font-size: 16px;
                        padding-right: 8px;
                      "
                      ><?php echo $_SESSION["currency_symbol"].number_format(($prrow['totalPrice']*$_SESSION["currency_rate"]),2) ; ?> 
                        <?php
                            if(!empty($row['coupon'])){
                                echo "<span style='color:blue; font-weight:600;font-size: 11px;'><i class='fa-solid fa-tag'></i>&nbsp;(".$row['coupon'].")</span>";
                            }
                        ?>
                        
                      </span
                    >
                  </div>
                </div>
                <div
                  class="col-5 col-lg-2"
                  style="
                    display: flex;
                    align-items: flex-start;
                    flex-direction: column;
                    justify-content: center;
                  "
                >
                  <p><b>Status</b></p>
                  <p><?php echo $prrow['status'] ?></p>
                </div>
                <div class="col-6 col-lg-3 del-expect">
                  <p><b>Delivered Excpected In:</b></p>
                  <?php
                    if(strpos($prrow['productCategory'],'Steroids')>0){
                        echo '<p>15 To 18 Days</p>';
                    }
                    elseif(strpos($prrow['productName'],'USA to USA')>0) {
                        echo '<p>7 To 10 Days</p>';
                    }
                    elseif(strpos($prrow['productName'],'Express')>0) {
                        echo '<p>10 Days</p>';
                    }
                    else {
                        echo '<p>15 To 21 Days</p>';
                    }
                  ?>
                  <!--<a onclick="orderTrack(this)" data-oid="<?php echo $prrow['id']; ?>" class="track-order-button" style="cursor:pointer;"> + Track</a>-->
                </div>
              </div>
            </div>
            <?php
                        }
                    ?>
            <hr />
            <div class="row bottom-order-date">
              <div class="col-lg-8 bottom-order-date-section">
                <span style=" font-size: 12px; color: #000; ">Subtotal:  <b><?php echo $_SESSION["currency_symbol"].number_format(($row['subtotal']*$_SESSION["currency_rate"]),2) ; ?> </b></span>
                <span style=" font-size: 12px; color: #000; ">Shipping:  <b><?php echo $_SESSION["currency_symbol"].number_format(($row['dcharge']*$_SESSION["currency_rate"]),2) ; ?> </b></span>
                <span style=" font-size: 12px; color: #000; ">Total:  <b><?php echo $_SESSION["currency_symbol"].number_format(($row['total']*$_SESSION["currency_rate"]),2) ; ?> </b></span>
                <span style=" font-size: 12px;  color: #000;  border-radius: 3px; ">Discount: <b style=" color: #0aa169; "><?php echo $_SESSION["currency_symbol"].number_format(($row['discount']*$_SESSION["currency_rate"]),2); ?> </b></span>
                
                <div class="order-date"><b><?php echo $row['paymentStatus']; ?></b>
                
                    <?php 
                        if(!empty($row['paymentlink']) && $row['paymentStatus']=='Pedning'){
                    ?>
                    <a target="_blank" href="<?php echo $row['paymentlink']; ?>" style=" background: #004fff; color: #fff; padding: 0px 11px; text-transform: uppercase; border-radius: 2px; ">Pay</a>
                    <?php } ?>
                </div>
                
                
              </div>
               <div class="col-lg-4 cart-main-product2">
                    <!--<div class="col-lg-6 cancel-order"> X CANCEL ORDER</div>-->
                    <div class="col-lg-12 total-order-amount">
                        <a target="_blank" href="order/invoice/<?php echo $row['orderid']; ?>" class="cart-button btn btn-primary buttonCart reorder-button" style="background: #00c3d1;border: #0c3072;padding: 4px 30px;border-radius: 6px;font-size: 15px;margin-right: 4px;">
                            <span class="button__text add-to-cart ">View</span>
                        </a>
                        <button type="button" class="cart-button btn btn-primary buttonCart reorder-button" style="background: #0c3072;border: #0c3072;padding: 4px 30px;" data-oid="<?php echo $row['orderid']; ?>" onclick="reorder(this)">
                            <span class="button__text add-to-cart ">Reorder</span>
                        </button>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <?php
      }
  ?>
      </section>
    </div>
  </div>

  <?php include('include/footer.php'); ?>
</main>
