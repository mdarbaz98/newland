 <?php
  include('include/database.php');
  include('env.php');
  setcookie("userID");
  // echo "<script>alert('".$_COOKIE["userID"]."');</script>";
  error_reporting(0);
    if(!isset($_COOKIE["userID"])) {
        setcookie("userID",uniqid(),time()+31556926 ,'/');
    } else {
        setcookie("userID",$_COOKIE["userID"],time()+31556926 ,'/');
    }
  $product_slug =   $_GET['product_slug'];
  if(empty($product_slug)){
    header('location: shop.php');
  }
  $currentUrl1 = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if(strpos($currentUrl1, 'usa-to-usa-medication')){
     $newuri = str_replace("usa-to-usa-medication","usa-premium", $currentUrl1);
     header('location: '.$newuri);
  }
      $select_product=$conn->prepare("SELECT productName, productCategory,productStatus FROM ogproduct WHERE productSlug=?");
      $select_product->execute([$product_slug]);  
      $row=$select_product->rowCount();
      while($row=$select_product->fetch(PDO::FETCH_ASSOC))
      {
        $productName = $row['productName'];
        $productCategory = $row['productCategory'];
        $productDetails = $row['productDescription'];
        $productStatus = $row['productStatus'];
      }
      
      if($productStatus=='inactive') {
        echo "<script>window.location.replace('https://".$INFO_WEBSITE_NAME ."/');</script>";
      }
      if(strpos($productCategory,'Steroids')>0){
        $shiptime = '12 to 18 Days Standard Delivery';
        $info = '<button type="button" 
                class="" data-bs-container="body" 
                data-bs-toggle="popover" data-bs-placement="top" 
                data-bs-trigger="hover" 
                title="" 
                data-bs-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus ornare sem." 
                data-bs-original-title="Popover on hover" 
                aria-label="Popover on hover" 
                style="font-size: 18px; border: 0px;background: #fff;margin: 3px 0px 0px 5px !important;">
                <i class="ci-announcement" style="font-size: 18px;margin-bottom: -1px !important;"></i></button>';
      }
      elseif(strpos($productName,'USA to USA')>0) {
        $altship = 'USA to USA 7-9 Days Shipping';
        $altProName = trim(str_replace('USA to USA', '', $productName));

        $proSql = "SELECT * FROM ogproduct WHERE (productName='".$altProName."' OR productName='".str_replace('USA to USA', '', $productName)."'  OR (productName LIKE '%".$altProName."%' AND  productName LIKE '%Express%')) AND productStatus='active'";

        $shiptime = '5 to 7 Days USA to USA Shipping';
        $info = '<button type="button" 
                class="" 
                data-bs-container="body" 
                data-bs-toggle="popover" 
                data-bs-placement="top" 
                data-bs-trigger="hover" 
                title="" 
                data-bs-content="Medicines will be shipped from USA, prompt shipping & free delivery." 
                data-bs-original-title="USA to USA" 
                aria-label="Popover on hover" 
                style="font-size: 18px; border: 0px;background: #fff;margin: 3px 0px 0px 5px !important;"><i class="ci-announcement" style="font-size: 18px;margin-bottom: -1px !important;"></i></button>';
      }
      elseif(strpos($productName,'Express')>0) {
        $altship = 'Express 10 Days Shipping';
        $altProName = trim(str_replace('Express', '',str_replace('-', '',  $productName)));
        $proSql = "SELECT * FROM ogproduct WHERE productName='".$altProName."' OR productName='".str_replace('Express', '',str_replace(' -', '',  $productName))."'  OR (productName LIKE '%".$altProName."%' AND  productName LIKE '%USA to USA%')";

        $shiptime = '10 Days Delivery';
        $info = '<button type="button" 
                class="" 
                data-bs-container="body" 
                data-bs-toggle="popover" 
                data-bs-placement="top" 
                data-bs-trigger="hover" 
                title="" 
                data-bs-content="Medicines will be shipped from UK, cheaper than USA to USA & faster delivery than Standard shipping" 
                data-bs-original-title="Express Shipping" 
                aria-label="Popover on hover" 
                style="font-size: 18px; border: 0px;background: #fff;margin: 3px 0px 0px 5px !important;"><i class="ci-announcement" style="font-size: 18px;margin-bottom: -1px !important;"></i></button>';
      }
      else {
        $altship = 'Standard 18-21 Days Shipping';
        $altProName = trim($productName);
        $proSql = "SELECT * FROM ogproduct WHERE productName LIKE '%".$altProName."%' AND (productName LIKE '%Express%' OR  productName LIKE '%USA to USA%')";

        $shiptime = '12 to 18 Days Standard Delivery';
        $info = '<button type="button" 
                class="" 
                data-bs-container="body" 
                data-bs-toggle="popover" 
                data-bs-placement="top" 
                data-bs-trigger="hover" 
                title="" 
                data-bs-content="Medicines will be shipped from India, cheaper than USA to USA, but more shipping time." 
                data-bs-original-title="Standard Shipping" 
                aria-label="Popover on hover" 
                style="font-size: 18px; border: 0px;background: #fff;margin: 3px 0px 0px 5px !important;"><i class="ci-announcement" style="font-size: 18px;margin-bottom: -1px !important;"></i></button>';
      }
      $productSeoTitle = $productName;
      $productSeoDescription = $productDetails;
      
?>
    <?php include('include/header.php'); ?>
    <?php 
      include('include/sidenav.php'); 
      $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE productSlug=?");
      $select_product->execute([$product_slug]);  
      $row=$select_product->rowCount();
      while($row=$select_product->fetch(PDO::FETCH_ASSOC))
      {
        $productName = $row['productName'];
        $productCode = $row['productCode'];
        $bestseller = $row['bestseller'];
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
        $productDiscount = $row['productDiscount'];
        $productSeoTitle = $row['productSeoTitle'];
        $productSeoDescription = $row['productDescription'];
	$productStatus = $row['productStatus'];
        
        
        $pageName = "ProductPage";
        
      }
    ?>
    <input type="hidden" id="productPageName" value="<?php echo $pageName ?>">
    <input type="hidden" id="productNewCode" value="<?php echo $productCode ?>">
    
  
    <!--<section class="prdt-cart-sticky">-->
      
    <!--</section>-->

    <main class="offcanvas-enabled" style="padding-top: 5rem;">
      <section class="ps-lg-4 pe-lg-3 pt-4">
        <div class="px-3 pt-2">
          <!-- Page title + breadcrumb-->
          <nav class="mb-4" aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap">
             <?php
                $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === FALSE ? 'https' : 'https';
                $domainLink = $protocol . '://' . $_SERVER['HTTP_HOST'];
             ?>
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo $domainLink; ?>"><i class="fa-solid fa-house"></i>Home</a></li>
              <li class="breadcrumb-item1 text-nowrap"><a href="<?php echo $prductcategoryslug; ?>"><?php echo $productCategory;?></a>
              </li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo $productName; ?></li>
            </ol>
          </nav>
          <!-- Content-->
          <!-- Product Gallery + description-->
          <section class="row g-0 mx-n2 pb-5 mb-xl-3" style="background:#fff !important;">
            <div class="col-xl-4 px-2 mb-3 product_image">
              <!--<div class="offer">-->
              <!--  <img src="images/offer1.png" style="width: 96px !important;">-->
              <!--</div>-->
              <div class="h-100 bg-light rounded-3">
                <div class="product-gallery">
                  <?php
                    if(strpos($productName,'USA to USA')>0) {
                  ?>
                    <img src="https://myglobal1.gumlet.io/product-quantity/free.png?w=85" class="free-ship-tag-img" alt="">
                  <?php
                    }
                  ?>
                  <div class="product-gallery-preview order-sm-2">
                    <div class="product-gallery-preview-item active" id="first">
                      <img class="image-zoom" src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage ?>?w=502" alt="Product image">
                    </div>
                    <?php
                        $select_product_image=$conn->prepare("SELECT * FROM ogproductimage WHERE productImageCode='$productCode'");
                        $select_product_image->execute();
                        while($row=$select_product_image->fetch(PDO::FETCH_ASSOC))
                        {
                          $image_location = $row['productImagePath']; 
                          $image_id = $row['productImageId'];
                    ?>
                    <div class="product-gallery-preview-item" id="image<?php echo $image_id; ?>">
                      <img src="onglobaladmincrm/<?php echo $image_location; ?>" alt="Product image">
                    </div>
                    <?php
                        }
                    ?>
                  </div>
                  <div class="product-gallery-thumblist order-sm-1 d-lg-flex d-md-flex justify-content-center">
                    <a class="product-gallery-thumblist-item active" href="#first"><img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage ?>" alt="Product thumb"></a>
                    
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 px-2 mb-3" style="border-left: 1px solid #ebebeb !important;">
              <div class="h-100 bg-light rounded-3 py-4 px-lg-3" style="position: relative;">
                
              
	        <?php
			if($productStatus!='active'){
		?>
		
		<?php } ?>
                <?php
                    if(strlen($bestseller)>0){
                ?>
                <div class="">
                  <span class="badge bg-primary">Bestseller</span>
                </div>
                <?php
                    }
                ?>
                <?php
                     $select_product_price=$conn->prepare("SELECT * FROM ogproductingredient WHERE productCode='$productCode'");
                    $select_product_price->execute();
                    $totalAlt = $select_product_price->rowCount();
                    if($totalAlt>0){
                ?>
                <small class="text-accent">Active Ingredient : &nbsp;</small>
                
                <?php
                    $select_product_price=$conn->prepare("SELECT * FROM ogproductingredient WHERE productCode='$productCode' ");
                    $select_product_price->execute();
                    while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                    {
                        $ingname = $row['productIngredientName'];
                ?>
                <a class="product-meta fs-sm pb-2 text-dark" href="ingredient/<?php echo strtolower(str_replace(' ', '-', $ingname)); ?>"><?php  echo $row['productIngredientName']?> </a>
                <?php
                    }
                    }
                ?>
                <h1 style="display: flex;align-items: center;" class="h2 mb-0 pb-0"><?php echo $productName; ?> 
                <span><i class="h2 text-body ci-loudspeaker" style="font-size: 17px; color: #e91e63 !important; padding: 5px 7px; border-radius: 5px; margin-left: 4px; font-weight: bolder;" id="playSound"></i></span></h1>
                <div class="playSound">
                <p>
                        <input type="hidden" id="productReadName" value="<?php echo $productName ?>"></input>
                </p>
                <p>
                        <input type="hidden"  id="volume" value="1"></input>
                </p>
                <p>
                        <input type="hidden" id="rate" value="1"></input>
                </p>
                <p>
                        <input type="hidden" id="pitch" value="1"></input>
                </p>
                <p>
                        <select type="hidden" id="hidden" style="display:none;"></select>
                </p>
                </div>
                <a href="<?php echo $prductcategoryslug; ?>" style="color: #f01117 !important;"><small><?php echo $productCategory; ?></small></a>
                <?php
                     $select_product_price=$conn->prepare("SELECT * FROM ogproductaltname WHERE productCode='$productCode' ");
                    $select_product_price->execute();
                    $totalAlt = $select_product_price->rowCount();
                    if($totalAlt>0){
                ?>
                <br>
                <small class="text-accent" style="color: #000 !important;">Other brand names : &nbsp;</small>
                
                <?php
                   
                        $select_product_price=$conn->prepare("SELECT * FROM ogproductaltname WHERE productCode='$productCode' ");
                        $select_product_price->execute();
                        while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                        {
                            $altname = $row['productAltName'];
                ?>
                <a class="product-meta fs-sm pb-2 text-dark" style="color: #119385 !important;font-weight: 700;" href="brand/<?php echo strtolower(str_replace(' ', '-', $altname)); ?>"><?php  echo $row['productAltName']?> </a>, 
                <?php
                        }
                    }
                ?>
                
                <!--<p class="text-success mt-1">Special Price</p>-->
                <?php
                    $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                    $select_product_price->execute();
                    while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                    {
                        $price = $row['price']; 
                    }
                ?>
		<div class="spbox" style="display: flex;flex-direction: row;">
			<div class="pricingbox">
                		
      <?php
                    $selectCat=$conn->prepare("SELECT * FROM ogproduct WHERE productCode = '$productCode'");
                    $selectCat->execute();
                    while($row=$selectCat->fetch(PDO::FETCH_ASSOC)){
                        $name = $row['productCategory']; 
                        $catsName = $row['productCategory']; 
                        $productType = $row['productType'];
                        $cat =  (explode(",",$name));
                        $category = array();
                        foreach($cat AS $x) {
                            array_push($category,"'".$x."'");
                        }
                
                        $categoryName = (implode(",",$category));
                        $proStrn = $row['proStrn']; 
                      
                        $type = $row['productType'];    
                    }
                    $discount = 0;
                    $newprice = 0;
                    $selectOffer=$conn->prepare("SELECT * FROM discount WHERE code='$productCode' AND type='PROD'");
                    $selectOffer->execute();
                    
                    $countOffer = $selectOffer->rowCount();
                    if($countOffer<1){
                        $selectOffer=$conn->prepare("SELECT * FROM discount WHERE name IN ($categoryName) AND type='CAT'");
                        $selectOffer->execute();
                        $countOffer = $selectOffer->rowCount();
                        if($countOffer<1){
                            $selectOffer=$conn->prepare("SELECT * FROM discount WHERE type='ALL'");
                            $selectOffer->execute();
                            $countOffer = $selectOffer->rowCount();
                            if($countOffer<1){
                                
                            }else {
                                while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                    $discount = $crow['discount'];
                                    $newprice = ($price-($price*($discount/100)));
                                }
                            }
                        }else {
                            while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                                $discount = $crow['discount'];
                                $newprice = ($price-($price*($discount/100)));
                            }
                        }
                    }else {
                        while($crow=$selectOffer->fetch(PDO::FETCH_ASSOC)){
                            $discount = $crow['discount'];
                            $newprice = ($price-($price*($discount/100)));
                        }
                    }
                    ?>
                		<div class="h4 fw-normal mt-1 mb-0">
                    <?php
                      if($discount>0){
                    ?>
                    <b><?php echo $_SESSION["currency_symbol"]; ?><?php echo number_format(($newprice*$_SESSION["currency_rate"]),2); ?></b>
                    <small><del><?php echo $_SESSION["currency_symbol"]; ?><?php echo number_format(($price*$_SESSION["currency_rate"]),2); ?></del></small>
                    <small>/<?php echo $productType; ?></small>
                    <div class="tot-price" style="display: inline;">20%Off</div>
                    <?php
                      }else{
                    ?>
                    <?php echo $_SESSION["currency_symbol"]; ?><?php echo number_format(($price*$_SESSION["currency_rate"]),2); ?>
                    <small>/<?php echo $productType; ?></small>
                    <?php } ?>


                      
                       
                    </div>
                    
                		<div style="display: flex;align-items: center;"><span class="pro-ship-time"><?php echo $shiptime?></span><?php echo $info ?></div>
                		<!--<small>Get the best price on this product on orders above $650</small><br>-->
                    <?php
                      if(strpos($productName,'USA to USA')<1) {
                    ?>
                		<small class="align-middle"> <img src="https://myglobal1.gumlet.io/images/fast.png" width="20px"> Free shipping on order above <span class="text-primary">$250</span></small>
                    <?php
                      }
                    ?>
                	</div>
      
      <?php 
      if (strpos($actual_link, 'newlandpharmacy') OR strpos($actual_link, 'oneglobalpharma')) { 
      ?>              
			<div class="regbox" style="display: flex;align-items: center;padding-left: 27px;">
				<a href="https://www.pharmacyregulation.org/registers/pharmacy/registrationnumber/1031217" target="_blank"><img src="https://myglobal1.gumlet.io/images/logo/Registered-Pharmacy-Logo.jpg?w=118"></a>
			</div>
        <?php } ?>
		</div>
    <br>
    <div class="social_share_wrap">
      <?php
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      ?>
      <div class="ss_wrap ss_wrap_1">
        <div class="ss_btn">
          <span class="">
            <i class="fa-solid fa-share-nodes"></i>
          </span>
        </div>

        <div class="dd_list">
          <ul>
            <li><a href="https://wa.me/?text=Limited-deal: <?php echo $productName; ?> <?php echo $actual_link  ?>">
                <span class="icon">
                  <img src="social/whatsapp.png"  alt="">
                </span>
              </a></li>
            <li><a href="mailto:?body=Limited-deal: <?php echo $productName; ?> <?php echo $actual_link  ?>&subject=<?php echo $productName; ?> From NEWLANDS PHARMACY" class="twitter">
                <span class="icon">
                  <img src="social/email.png" alt="">
                </span>
              </a></li>
            <li class="sms-desk"><a href="sms:?body=Limited-deal: <?php echo $productName; ?> <?php echo $actual_link  ?>" class="instagram ">
                <span class="icon">
                  <img src="social/message.png" alt="">
                </span>
              </a></li>
            <li><a onclick="window.print()" class="reddit">
                <span class="icon">
                  <img src="social/print.png" alt="">
                </span>
              </a>
            </li>
            <li><a onclick="shareURL('<?php echo $productName; ?>','<?php echo $actual_link  ?>')" class="reddit">
                <span class="icon">
                  <img src="social/copy.png" alt="">
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>

    </div>
		 <?php
	            if(!empty($proSql)){
                    $selectAlt1 = $conn->prepare($proSql);
                    $selectAlt1->execute();
		    $totalAlt=$selectAlt1->rowCount();
		    if($totalAlt>0){
			if(strpos($productName,'Express')>0){
                            $delTag = "Cheaper Price";
                        }
                        elseif(strpos($productName,'USA to USA')>0) {
                            $delTag = "Cheaper Price";
                        }
                        else {
                           $delTag = "USA to USA Free Shipping";
                        }
			
		?>
		<div class="shadow-box" style=" padding: 16px; margin: 19px 0px; border-radius: 9px; background: #edfffe61; position: relative; padding-top: 31px;  border: 1px dashed #2ecfc6; ">
	        <h4 style="font-size: 10px;font-weight: 600;text-align: center;position: absolute;top: -10px;display: flex;align-items: center;left: 0;color: #000 !important;overflow: hidden;right: 0;border: 1px solid #4e54c8;margin-left: auto;margin-right: auto;background: #ffffff;width: fit-content;padding: 0px 0px 0px 19px;color: #fff;border-right: 0;border-radius: 10px;">Also Available<span style="background-image: linear-gradient(to right, #051937, #00436f, #00728f, #00a289, #00cd60);padding: 5px 10px;margin-left: 10px;color: #fff;"><?php echo $delTag; ?></span></h4>
		<i class="hide-show ci-arrow-down"></i>
                <i class="show-hide ci-arrow-up"></i>
		<div class="alt-pro">
		<?php
                    $selectAlt = $conn->prepare($proSql);
                    $selectAlt->execute();
                    while($altRow=$selectAlt->fetch(PDO::FETCH_ASSOC)){
			$productName = $altRow['productName'];
			$productCategory = $altRow['productCategory'];
			$productCode = $altRow['productCode'];
               		$productlower = strtolower($productCategory);
                        $prductcategoryslug = str_replace(" ","-",$productlower);
                        $productSlug = $altRow['productSlug'];
			if(strpos($productName,'Express')>0){
			    $altship = '10 Days Shipping';
		   	    $stag = '<span class="stag" style=" background: #4d53c5; ">Express</span>';
			}
			elseif(strpos($productName,'USA to USA')>0) {
			    $altship = '7-9 Days Shipping';
			    $stag = '<span class="stag">USA TO USA</span>';
			}
			else {
			    $altship = '18-21 Days Shipping</span>';
			    $stag = '<span class="stag" style=" background: #119385; ">Standard</span>';
			}
		
                    $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                    $select_product_price->execute();
                    while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                    {
                        $price = $row['price'];
                    }
               

                ?>
                <a class="alt-med-box" href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                    <?php echo $stag; ?>
		    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage ?>" alt="Product thumb" class="alt-image">
                    <div class="proinf">
                            <h3><?php echo $altRow['productName']; ?>($<?php echo $price; ?>)</h3>
                            <p style="font-size: 11px;font-weight: 600;font-style: italic;"><?php echo $altship; ?></p>
                    </div>
                </a>
		<?php
                	}
		?>
		</div>
		</div>
		<?php
			}}
		?>
                <!--<p class="rate"><span class="badge rounded-pill bg-success py-1 my-2">4.1 <i class="ci-star-filled"></i> </span> 25 ratings and 10 reviews</p>-->
                <div id="tabular" class="mt-3 listStrength">
                    <lord-icon
                        src="https://cdn.lordicon.com/kvsszuvz.json"
                        trigger="loop"
                        colors="primary:#121331,secondary:#08a88a"
                        stroke="58"
                        scale="100"
                        style="width: 300px;height: 36px;display: block;margin: 0 auto;">
                    </lord-icon>
                    <p class="text-center">Loading Strength...</p>
                </div>
                
                
                <p class="product-varient-error py-2"></p>
                <div class="shipping-info-extra">
                  <div class="left">
                    <div class="list-ship"><div class="dot-icon"></div><div><b>Free</b> shipping for order above <b>$200</b></div></div>
                    <div class="list-ship"><div class="dot-icon"></div><div>Orders below <b>$99</b> shipping charges <b>$20</b></div></div>
                  </div>
                  <div class="center">
                    <img src="image/price-tag.png" alt="">
                    <div class="list-ship-head">New Shipping <b>Prices</b></div>
                    <img src="image/price-tag.png" class="two-image">
                  </div>
                  <div class="right">
                    <div class="list-ship"><div class="dot-icon"></div><div>Orders between <b>$199-$150</b> shipping charges <b>$10</b></div></div>
                    <div class="list-ship"><div class="dot-icon"></div><div>Orders between <b>$149-$100</b> shipping charges <b>$15</b></div></div>
                  </div>
                </div>
                <h6>Product description</h6>
                <p><?php echo $productDetails; ?></p>
                <!--<h6 class="mt-3 mb-0 pb-2">Also Available</h6>-->
                <!--  <div class="also-availbale mb-2">-->
                <!--    <img src="images/Levitra-Medicine-Box-th1.jpg" class="" width="60px" alt="Product thumb">-->
                <!--    <div class="details text-left d-flex flex-column px-2">-->
                <!--      <h6 style="margin-bottom: 0px;">LEVITRA UK -US </h6>-->
                <!--      <p>US-UK 7-10 Days Shipping <img src="images/fast.png" width="20px"> </p>-->
                <!--    </div>-->
                <!--    <div class="button d-flex justify-content-end">-->
                <!--      <button class="btn d-block btn-primary" type="submit"><i class="ci-cart fs-lg me-2"></i>View</button>-->
                <!--    </div>-->
                <!--  </div>-->
                <div class="accordion accordion-flush mt-4 prdt-usage productAccord" id="accordionFlushExample">
                  <!-- Item -->
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                      <button class="accordion-button collapsed product-accord-item" type="button" data-bs-toggle="collapse" data-bs-target="#use" aria-expanded="false" aria-controls="flush-collapseOne">How to use</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="use" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <?php 
                          $select_use=$conn->prepare("SELECT * FROM ogproductuse WHERE productCode = '$productCode'");
                          $select_use->execute();  
                          $rowUse=$select_use->rowCount();
                          while($rowUse=$select_use->fetch(PDO::FETCH_ASSOC))
                          {
                        ?>
                        <p><?php  echo $rowUse['data']; ?></p>
                        <?php
                          }
                        ?>
                        </div>
                    </div>
                  </div>
                  
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#warning" aria-expanded="false" aria-controls="flush-collapseOne">Side effects</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="warning" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <?php 
                          $select_use=$conn->prepare("SELECT * FROM ogproductsideeffect WHERE productCode = '$productCode'");
                          $select_use->execute();  
                          $rowUse=$select_use->rowCount();
                          while($rowUse=$select_use->fetch(PDO::FETCH_ASSOC))
                          {
                        ?>
                        <p><?php  echo $rowUse['data']; ?></p>
                        <?php
                          }
                        ?>
                        </div>
                    </div>
                  </div>
                  
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sideeffect" aria-expanded="false" aria-controls="flush-collapseOne">Warnings & Precautions</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="sideeffect" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <?php 
                          $select_use=$conn->prepare("SELECT * FROM ogproductwarning WHERE productCode = '$productCode'");
                          $select_use->execute();  
                          $rowUse=$select_use->rowCount();
                          while($rowUse=$select_use->fetch(PDO::FETCH_ASSOC))
                          {
                        ?>
                        <p><?php  echo $rowUse['data']; ?></p>
                        <?php
                          }
                        ?>
                        </div>
                    </div>
                  </div>
                  
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#interaction" aria-expanded="false" aria-controls="flush-collapseOne">Drug interactions</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="interaction" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <?php 
                          $select_use=$conn->prepare("SELECT * FROM ogproductinteraction WHERE productCode = '$productCode'");
                          $select_use->execute();  
                          $rowUse=$select_use->rowCount();
                          while($rowUse=$select_use->fetch(PDO::FETCH_ASSOC))
                          {
                        ?>
                        <p><?php  echo $rowUse['data']; ?></p>
                        <?php
                          }
                        ?>
                        </div>
                    </div>
                  </div>
                  
                </div>
            </div>
            </div>
            <div class="col-xl-2 px-2 mb-3 product_image">
                <div class="bg-light rounded-3 py-4 px-lg-3">
                    <picture>
                         <source media="(max-width: 900px)" srcset="https://myglobal1.gumlet.io/images/Payment-Mode-mobile.jpg" style="width:100% !important;">
                         <img src="https://myglobal1.gumlet.io/images/Payment-Mode.jpg">
                     </picture>
                </div>
            </div>
          </section>
          
    <section class="m-0 mb-2 product-carousel-card related-product-section" style="padding:0 25px !important;">
        <!-- Heading-->
        <div class="text-center pt-1">
          <h2 class="h3 mb-0 pt-3 me-3">Related Products</h2>
          <!--<div class="pt-3"><a class="btn btn-outline-accent btn-sm" href="shop.php">View All<i class="fa-solid fa-arrow-right ms-1 me-n1"></i></a></div>-->
        </div>
        <div class="tns-carousel tns-controls-static tns-controls-outside tns-nav-disabled py-2">
          <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 16, &quot;loop&quot;: true, &quot;autoHeight&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1}, &quot;480&quot;:{&quot;items&quot;:2}, &quot;720&quot;:{&quot;items&quot;:3}, &quot;991&quot;:{&quot;items&quot;:2}, &quot;1140&quot;:{&quot;items&quot;:4}, &quot;1300&quot;:{&quot;items&quot;:4}, &quot;1500&quot;:{&quot;items&quot;:4}}}">
            <!-- Product-->
            
            <?php
            $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory=? && productCode!=? &&  productStatus!=? limit 7");
            $select_product->execute([$productCategory, $productCode, 'inactive']);  
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
                        $select_product_price=$conn->prepare("SELECT * FROM ogquantity WHERE productCode='$productCode' ORDER BY price ASC limit 1");
                        $select_product_price->execute();
                        while($row=$select_product_price->fetch(PDO::FETCH_ASSOC))
                        {
                            $price = $row['price']; 
                        }
            ?>
                <div class="">
                        <a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                        <div class="card product-card" style=" position: relative; ">
                            <!--<p class="besttag" style=" position: absolute; bottom: 0px; right: 0; z-index: 5; font-size: 10px; background: #42d697; padding: 0px 4px; color: #fff; ">Bestseller</p>-->
                            <div class="card-img-top d-block overflow-hidden">
                                <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>?w=208" alt="<?php echo $productImageAlt; ?>" title="<?php echo $productImageTitle; ?>">
                            </div>
                            <div class="card-body">
                                <small><?php echo $productCategory; ?></small>
                                <h3 class="product-title fs-sm"><?php echo $productName; ?></h3>
                                <p class="product-description d-flex justify-content-between">
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
                                <p class="product-price">
                                  $<?php echo $price; ?>/<small><?php echo $productType; ?></small>*
                                </p>
                             </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>

          </div>
        </div>
      </section>

          <!-- Related products-->
          <!-- <section class="pb-5 mb-2 mb-xl-4">
            <h2 class="h3 pb-2 mb-grid-gutter text-center">You may also like</h2>
            <div class="tns-carousel tns-controls-static tns-controls-outside tns-nav-enabled">
              <div class="tns-carousel-inner" data-carousel-options='{"items": 2, "gutter": 16, "controls": true, "responsive": {"0":{"items":1}, "480":{"items":2}, "720":{"items":3}, "991":{"items":2}, "1140":{"items":3}, "1300":{"items":4}, "1500":{"items":5}}}'>
                <div>
                  <div class="card product-card card-static pb-3">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="fa-solid fa-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="grocery-single.html"><img src="images/catalog-08.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Dairy and Eggs</a>
                      <h3 class="product-title fs-sm"><a href="grocery-single.html">Mozzarella Cheese (125g)</a></h3>
                      <div class="product-price"><span class="text-accent">$4.<small>30</small></span></div>
                    </div>
                    <div class="product-floating-btn">
                      <button class="btn btn-primary btn-shadow btn-sm" type="button">+<i class="ci-cart fs-base ms-1"></i></button>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="card product-card card-static pb-3">
                    <button class="btn-wishlist btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="fa-solid fa-heart"></i></button><a class="card-img-top d-block overflow-hidden" href="grocery-single.html"><img src="images/catalog-09.jpg" alt="Product"></a>
                    <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1" href="#">Personal hygiene</a>
                      <h3 class="product-title fs-sm text-truncate"><a href="grocery-single.html">Men&rsquo;s Shampoo (400ml)</a></h3>
                      <div class="product-price"><span class="text-accent">$5.<small>99</small></span></div>
                    </div>
                    <div class="product-floating-btn">
                      <button class="btn btn-primary btn-shadow btn-sm" type="button">+<i class="ci-cart fs-base ms-1"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section> -->
        </div>
      </section>

<?php
    include('include/footer.php');
?>
  
<!-- <script>
      $('.ag-smoke-block').hide();
      $(window).on('load', function() {
        $('#halloween-modal').modal('show');
        // $('.ag-smoke-block').show();
        $(document).on('hide.bs.modal','#halloween-modal', function () {
          $('.ag-smoke-block').hide();
        });
      });
    </script>  -->