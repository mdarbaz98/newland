<?php 
    $proid = $_GET['proid'];
    // $productCategorySlug = $_GET['productCategory'];
    // $prductCategoryModify = str_replace("-"," ",$productCategorySlug);
    // $productSlugNew = ucwords($prductCategoryModify);
    
    // $productSeoTitle = $productSlugNew;
    // $productSeoDescription = $productSlugNew;
    include('include/header.php'); 
    $db_host = "newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com";
    $db_user = "root";
    $db_password = "Iamawesome8425";
    $db_name = "onegloba_globalmedz";
    try
    {
        $conn1 = new PDO("mysql:host={$db_host};dbname={$db_name};port=3306", $db_user, $db_password);
        $conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEXCEPTION $e)
    {

    }

    $selectData = $conn1->prepare('SELECT * FROM subcategory WHERE sid='.$proid.'');
    $selectData->execute();
    while ($row = $selectData->fetch(PDO::FETCH_ASSOC))
    {
        $productName = $row['productname'];
    }
   

    $con = mysqli_connect("newlandspharma.c7h06yjxgkol.us-east-2.rds.amazonaws.com", "root", "Iamawesome8425", "global");

    if (!$con)
    {
        die('Could not connect: ' . mysqli_error());
    }
  
    // }


    $productArray = array();
    $mainProductArray = array();
    $strengthArray = array();
    $quantityArray = array();
    $altArray = array();
    $altArray1 = array();
    $prnameArray = array();

    $fetchSql = "SELECT * FROM ogproduct WHERE productName='" . $productName . "' AND productStatus='active'";
    $fetchProduct = mysqli_query($con, $fetchSql) or die(mysqli_error($con));
    if (mysqli_num_rows($fetchProduct) > 0)
    {
        while ($product = mysqli_fetch_assoc($fetchProduct))
        {
            $code = $product['productCode'];
            $mainProductArray['productName'] = $product['productName'];
            $mainProductArray['productCategory'] = $product['productCategory'];
            $mainProductArray['productImage'] = $product['productImage'];
            $mainProductArray['productSlug'] = $product['productSlug'];
            $mainProductArray['strength'] = "";
            $mainProductArray['price'] = "";
            $mainProductArray['ing'] = "";
            $strengthArr = array();
            $priceArr = array();
            $ing = array();

            $fetchStrength = mysqli_query($con, "SELECT * FROM ogstrength WHERE productCode = '$code' ") or die(mysqli_error($mysqli));
            while ($strength = mysqli_fetch_assoc($fetchStrength))
            {
                array_push($strengthArr, $strength['strengthName']);
            }

            $fetchQauntity = mysqli_query($con, "SELECT * FROM ogquantity WHERE productCode = '$code'  ORDER BY price ASC LIMIT 1") or die(mysqli_error($mysqli));
            while ($quantity = mysqli_fetch_assoc($fetchQauntity))
            {
                array_push($priceArr, $quantity['price']);
            }

            $fetchIng = mysqli_query($con, "SELECT * FROM ogproductingredient WHERE productCode = '$code'") or die(mysqli_error($mysqli));
            while ($ings = mysqli_fetch_assoc($fetchIng))
            {
                array_push($ing, $ings['productIngredientName']);
            }

            $strn = implode(",", $strengthArr);
            $price = implode(",", $priceArr);
            $ing = implode(",", $ing);
            $mainProductArray['strength'] = $strn;
            $mainProductArray['price'] = $price;
            $mainProductArray['ing'] = $ing;
            array_push($productArray, $mainProductArray);
        }

    }
    else
    {
        $pro = $productName;
        $altmeds = "SELECT * FROM ogproductingredient WHERE productIngredientName LIKE '%" . $pro . "%'";
        $altmedname = mysqli_query($con, $altmeds) or die(mysqli_error($con));
        if (mysqli_num_rows($altmedname) > 0)
        {
            while ($altname = mysqli_fetch_assoc($altmedname))
            {
                $codes = "'" . $altname['productCode'] . "'";
                array_push($altArray1, $codes);
            }
        }

        $altmed = "SELECT * FROM ogproductaltname WHERE productAltName LIKE '%" . $productName . "%'";

        $altmed = mysqli_query($con, $altmed) or die(mysqli_error($con));
        if (mysqli_num_rows($altmed) > 0)
        {
            while ($alt = mysqli_fetch_assoc($altmed))
            {
                $code = "'" . $alt['productCode'] . "'";
                array_push($altArray, $code);
            }
        }
        $pname = array_merge($altArray, $altArray1);
        $string_version = implode(',', $pname);
        // echo $string_version;
        if (!empty($pname))
        {
            $getproduct = "SELECT productName from ogproduct WHERE productCode IN (" . $string_version . ") AND productStatus='active'";
            $getproduct = mysqli_query($con, $getproduct) or die(mysqli_error($con));
            if (mysqli_num_rows($altmed) > 0)
            {
                while ($prodname = mysqli_fetch_assoc($getproduct))
                {
                    $name = "'" . $prodname['productName'] . "'";
                    array_push($prnameArray, $name);
                }
            }
            $prod_version = implode(',', $prnameArray);
        }

        if (empty($pname))
        {
            $fetchSql = "SELECT * FROM ogproduct WHERE (productName LIKE '%" . $productName . "%' OR productName='" . $productName . "') AND productStatus='active'";
        }
        else
        {
            $fetchSql = "SELECT * FROM ogproduct WHERE (productCode IN (" . $string_version . ") OR productName LIKE '%" . $productName . "%') AND productStatus='active'";
        }
        $fetchProduct = mysqli_query($con, $fetchSql) or die(mysqli_error($con));
        if (mysqli_num_rows($fetchProduct) > 0)
        {
            while ($product = mysqli_fetch_assoc($fetchProduct))
            {
                $code = $product['productCode'];
                $mainProductArray['productName'] = $product['productName'];
                $mainProductArray['productCategory'] = $product['productCategory'];
                $mainProductArray['productImage'] = $product['productImage'];
                $mainProductArray['productSlug'] = $product['productSlug'];
                $mainProductArray['strength'] = "";
                $mainProductArray['price'] = "";
                $mainProductArray['ing'] = "";
                $strengthArr = array();
                $priceArr = array();
                $ing = array();

                $fetchStrength = mysqli_query($con, "SELECT * FROM ogstrength WHERE productCode = '$code' ") or die(mysqli_error($mysqli));
                while ($strength = mysqli_fetch_assoc($fetchStrength))
                {
                    array_push($strengthArr, $strength['strengthName']);
                }

                $fetchQauntity = mysqli_query($con, "SELECT * FROM ogquantity WHERE productCode = '$code'  ORDER BY price ASC LIMIT 1") or die(mysqli_error($mysqli));
                while ($quantity = mysqli_fetch_assoc($fetchQauntity))
                {
                    array_push($priceArr, $quantity['price']);
                }

                $fetchIng = mysqli_query($con, "SELECT * FROM ogproductingredient WHERE productCode = '$code'") or die(mysqli_error($mysqli));
                while ($ings = mysqli_fetch_assoc($fetchIng))
                {
                    array_push($ing, $ings['productIngredientName']);
                }

                $strn = implode(",", $strengthArr);
                $price = implode(",", $priceArr);
                $ing = implode(",", $ing);
                $mainProductArray['strength'] = $strn;
                $mainProductArray['price'] = $price;
                $mainProductArray['ing'] = $ing;
                array_push($productArray, $mainProductArray);
            }

            $jsonData = json_encode($productArray, JSON_PRETTY_PRINT);
        }
        else{
		echo '<script>window.location.href = "https://:newlandpharmacy.co.uk";</script>';
        }
    }

?>
<?php include('include/sidenav.php'); ?>
<div class="modal fade" id="quantity-model" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
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
<main class="shop-page offcanvas-enabled" style="padding-top: 89px; background: rgba(0,0,0,0);">
    <div class="container-fluid">
        <div class="row">
            <!--<div class="col-3 product_image filters" style="background: transparent !important;">-->
            <!--    <div class="offcanvas offcanvas-collapse bg-white w-100 rounded-3 shadow-lg py-1" id="shop-sidebar">-->
            <!--      <div class="offcanvas-header align-items-center shadow-sm">-->
            <!--        <h2 class="h5 mb-0">Filters</h2>-->
            <!--        <button class="btn-close ms-auto" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>-->
            <!--      </div>-->
            <!--      <div class="offcanvas-body py-grid-gutter px-lg-grid-gutter">-->
                    <!-- Filter by Brand-->
            <!--        <div class="widget widget-filter mb-4 pb-4 border-bottom">-->
            <!--          <h3 class="widget-title">Brand <?php echo $_GET['brand']; ?></h3>-->
            <!--          <div class="input-group input-group-sm mb-2">-->
            <!--            <input class="widget-filter-search form-control rounded-end pe-5" type="text" placeholder="Search"><i class="fa-solid fa-magnifying-glass position-absolute top-50 end-0 translate-middle-y fs-sm me-3"></i>-->
            <!--          </div>-->
            <!--            <ul class="widget-list widget-filter-list list-unstyled pt-1" style="max-height: 11rem;" data-simplebar="init" data-simplebar-auto-hide="false">-->
            <!--                <div class="simplebar-wrapper" style="margin: -4px -16px 0px 0px;">-->
            <!--                    <div class="simplebar-height-auto-observer-wrapper">-->
            <!--                        <div class="simplebar-height-auto-observer">-->
                                        
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="simplebar-mask">-->
            <!--                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">-->
            <!--                            <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;">-->
            <!--                                <div class="simplebar-content" style="padding: 4px 16px 0px 0px;">-->
            <!--                                    <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">-->
            <!--                                      <div class="form-check">-->
            <!--                                        <input class="form-check-input" type="checkbox" id="adidas">-->
            <!--                                        <label class="form-check-label widget-filter-item-text" for="adidas">Adidas</label>-->
            <!--                                      </div><span class="fs-xs text-muted">425</span>-->
            <!--                </li>-->
            <!--                                    <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">-->
            <!--                                      <div class="form-check">-->
            <!--                                        <input class="form-check-input" type="checkbox" id="ataylor">-->
            <!--                                        <label class="form-check-label widget-filter-item-text" for="ataylor">Ann Taylor</label>-->
            <!--                                      </div><span class="fs-xs text-muted">15</span>-->
            <!--                </li>-->
            <!--                                    <li class="widget-filter-item d-flex justify-content-between align-items-center mb-1">-->
            <!--                                      <div class="form-check">-->
            <!--                                        <input class="form-check-input" type="checkbox" id="armani">-->
            <!--                                        <label class="form-check-label widget-filter-item-text" for="armani">Armani</label>-->
            <!--                                      </div><span class="fs-xs text-muted">18</span>-->
            <!--                </li>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                    <div class="simplebar-placeholder" style="width: auto; height: 870px;">-->
                                    
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">-->
            <!--                    <div class="simplebar-scrollbar simplebar-visible" style="width: 0px; display: none;">-->
                                    
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">-->
            <!--                    <div class="simplebar-scrollbar simplebar-visible" style="height: 35px; transform: translate3d(0px, 0px, 0px); display: block;">-->
                                    
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </ul>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--</div>-->
            
            <div class="col-lg-12 col-md-12 shop-products col-12 px-0 px-lg-2" style="padding-top:7px;padding-bottom:10px;">
                <section class="pt-4">
                    <?php echo $productName; ?>
                        <div class="row mx-n2">
                            <?php
                            // SELECT  p1.productName, p1.productCode, p1.productCategory, p1. p2.price FROM product p1 INNER JOIN ( SELECT codes, price FROM pricing order by price)p2 ON p1.code == p2.codes where p2.price BETWEEN 0.39 AND 0.70 GROUP by p1.name;
			    if(empty($proudtcArray)){
				echo '<script>window.location.href = "https://:newlandpharmacy.co.uk";</script>';

			    }                            

                            foreach($productArray as $x)
                            {
                                $productName = $x['productName'];
                                $productCategory = $x['productCategory'];
                                $productlower = strtolower($productCategory);
                                $prductcategoryslug = str_replace(" ","-",$productlower);
                                $productImage = $x['productImage'];
                                $productSlug = $x['productSlug'];
                                $price = $x['price'];
                            ?>
                              <div class="col-lg-3 col-12" >
                                <div class="card product-card pb-0 my-0" style=" position: relative; ">
                                  <p class="besttag" style=" position: absolute; bottom: 0px; right: 0; z-index: 5; font-size: 10px; background: #42d697; padding: 0px 4px; color: #fff; ">Bestseller</p>
                                  <?php
                                    if($wishcount>0){
                                        if(isset($_SESSION['IS_LOGIN']) && isset($_SESSION['EMAIL']) && isset($_SESSION['USER_ID'])){
                                  ?>
                                  <a class="btn-wishlist btn-sm" href="wishlist" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Add to wishlist" aria-label="Add to wishlist">
                                    <i class="fa-solid fa-heart-half"></i>
                                  </a>
                                  <?php
                                    }else{
                                  ?>
                                  <a class="btn-wishlist btn-sm" href="#signin-modal" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Add to wishlist" aria-label="Add to wishlist">
                                    <i class="fa-solid fa-heart-half"></i>
                                  </a>
                                  <?php
                                    }}
                                    ?>
                                  <div class="card-img-top d-block overflow-hidden">
                                      <a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                                        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>" alt="">
                                      </a>
                                  </div>
                                  <div class="card-body py-2"><a class="product-meta d-block fs-xs pb-1"><a href="<?php echo $prductcategoryslug.'/'.$productSlug; ?>">
                                    <h3 class="product-title fs-sm"><?php echo $productName; ?></h3>
                                    <p><?php echo $productCategory; ?></p>
                                    <p class="product-description d-flex justify-content-start  justify-lg-content-between">
                                     
                                     <?php
                                    if(strpos($productCategory,'Steroids')>0){
                                        echo '<span>12 to 18 Days Standard Delivery</sapn>';
                                    }
                                    elseif(strpos($productName,'USA to USA')>0) {
                                        echo '<span>5 to 7 Days USA to USA Shipping</sapn>';
                                    }
                                    elseif(strpos($productName,'Express')>0) {
                                        echo '<span>10 Days Delivery</sapn>';
                                    }
                                    else {
                                        echo '<span>12 to 18 Days Standard Delivery</sapn>';
                                    }
                                  ?>
                                    </p>
                                    </a>
                                    <p class="product-price">
                                      $<?php echo $price; ?>/<small><?php echo $productType; ?></small>*
                                        <?php
                                            $selectDiscount=$conn->prepare("SELECT * FROM discount WHERE code='$productCode' && type='PROD' ORDER BY id DESC limit 1");
                                            $selectDiscount->execute();
                                            $total = $selectDiscount->rowCount();
                                            while($rowDis=$selectDiscount->fetch(PDO::FETCH_ASSOC))
                                            {
                                                $discount = $rowDis['discount']; 
                                            }
                                            if($total>0){
                                        ?>
                                      <span class="dis"><?php echo $discount; ?>%Off</span>
                                      <?php
                                            }
                                      ?>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            <?php
                            }
                            ?>
                        </div>
                        </nav>
                </section>
            </div>
        </div>
    </div>
<?php include('include/footer.php'); ?>
  
