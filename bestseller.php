<?php 
    // $productCategorySlug = $_GET['productCategory'];
    // $prductCategoryModify = str_replace("-"," ",$productCategorySlug);
    // $productSlugNew = ucwords($prductCategoryModify);
    
    // $productSeoTitle = $productSlugNew;
    // $productSeoDescription = $productSlugNew;
    include('include/header.php'); 
    $per_page=12;
    $start=0;
    $current_page=1;
    if(isset($_GET['page'])){
    	$start=$_GET['page'];
    	if($start<=0){
    		$start=0;
    		$current_page=1;
    	}else{
    		$current_page=$start;
    		$start--;
    		$start=$start*$per_page;
    	}
    }
    $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE bestseller='bestseller'");
    $select_product->execute();  
    $record=$select_product->rowCount();
    $pagi=ceil($record/$per_page);

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
            
            <div class="col-lg-12 col-md-12 shop-products col-12 px-0 px-lg-2" style="padding-top:7px;">
                <section class="pt-4">
                    <!--<?php echo $productSlugNew; ?>-->
                        <div class="row mx-n2 postlist g-0">
                        <div class="col-12" style="
                            border-bottom: 1px solid #ebebeb !important;
                            font-size: 13px;
                            padding: 7px 20px;
                        ">
                                Home / <span style="
                            font-weight: 600;
                            color: #4e54c8;
                        ">Bestseller</span>
                            </div>
                            <?php
                            // SELECT  p1.productName, p1.productCode, p1.productCategory, p1. p2.price FROM product p1 INNER JOIN ( SELECT codes, price FROM pricing order by price)p2 ON p1.code == p2.codes where p2.price BETWEEN 0.39 AND 0.70 GROUP by p1.name;
                            $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE bestseller='bestseller'");
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
                                $checkcart = $conn->prepare('SELECT * FROM ogcart WHERE productCode=? && userId=? && wishlist=?');
                                $checkcart->execute([$productCode, $_SESSION['USER_ID'], 1]);
                                $wishcount = $checkcart->rowCount();
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
                                        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $productImage; ?>" alt="<?php echo $productImageAlt; ?>" title="<?php echo $productImageTitle; ?>">
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
  