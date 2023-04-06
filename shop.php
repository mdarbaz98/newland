<?php 
    $productCategorySlug = $_GET['productCategory'];
    $prductCategoryModify = str_replace("-"," ",$productCategorySlug);
    $productSlugNew = ucwords($prductCategoryModify);
    
    $productSeoTitle = $productSlugNew;
    $productSeoDescription = $productSlugNew;
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
    $select_product=$conn->prepare("SELECT * FROM ogproduct WHERE productCategory='$productSlugNew' AND productStatus='active'");
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
        <button class="open-modal btn btn-danger hall-btn">Click</button>
    </div>
<?php include('include/footer.php'); ?>
  