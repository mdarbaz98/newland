<?php 
  $productSeoTitle = "Frequently Asked Questions | Newlands Pharmacy";
  $productSeoDescription = "Frequently Asked Questions | Newlands Pharmacy";
  include('include/header.php'); 
?>
<?php 
	include('include/sidenav.php'); 
	if(isset($_GET['subcatname'])) {
		$subcatname = $_GET['subcatname'];
		echo 'SELECT * from faqscategories WHERE slug="'.$subcatname.'"';
		$selectsubCatId = $conn->prepare('SELECT * from faqscategories WHERE slug="'.$subcatname.'"');
		$selectsubCatId->execute();
		while($subcatIds=$selectsubCatId->fetch(PDO::FETCH_ASSOC)){
			$subcatid = $subcatIds['id'];
			$subslug = $subcatIds['name'];
		}
		$catname = $_GET['catname'];
		$selectCatId = $conn->prepare('SELECT * from faqscategories WHERE slug="'.$catname.'"');
		$selectCatId->execute();
		while($catId=$selectCatId->fetch(PDO::FETCH_ASSOC)){
			$catslug = $catId['name'];
		}
	}elseif(strlen($_GET['catname'])) {
		$catname = $_GET['catname'];
		$selectCatId = $conn->prepare('SELECT * from faqscategories WHERE slug="'.$catname.'"');
		$selectCatId->execute();
		while($catId=$selectCatId->fetch(PDO::FETCH_ASSOC)){
			$catIds = $catId['id'];
			$catslug = $catId['name'];
		}
	}

	

	

?>

    <!-- Page-->
    <main class="offcanvas-enabled" style="padding-top: 5rem;background: #fff;">
        <div class="container-fluid">
            <div class="row">
				<div class="col-12 faq-banner">
					<img src="cat-image/faq/Frame1.png" class="frame1">
					
					<img src="cat-image/faq/Frame2.png" class="frame2">
					
					<img src="cat-image/faq/Frame3.png" class="frame3">

					<h1>FAQ's</h1>
					<h2>Everything you need to know about us</h2>
				</div>
				<div class="col-12 faq-breadcrumb">
					<a href="">FAQ</a>
					<a href="faq/<?php echo $_GET['catname'] ?>"><?php echo $catslug; ?></a>
					<a href="faq/<?php echo $_GET['catname'].'/'.$_GET['subcatname'] ?>" class="active-faq"><?php echo $subslug; ?></a>
				</div>
				<section class="position-relative">
				<div class="faq_search_section">
					<div class="Wrapper_container">
					<div class="input_wrapper">
					<input type="text" placeholder="search faq">
					<button><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i></button>
					</div>
					<ul>
						<li><p>What if I don’t find at the exact potency of medicine at NLGP?</p>
						<span>About New Lands Pharma</span>
						<a href="">more<i class="fa-solid fa-arrow-right ms-2" style="color: #0C3072;"></i></a>
					</li>
						<li><p>What if I don’t find at the exact potency of medicine at NLGP?</p>
						<span>About New Lands Pharma</span>
						<a href="">more<i class="fa-solid fa-arrow-right ms-2" style="color: #0C3072;"></i></a>
					</li>
						<li><p>What if I don’t find at the exact potency of medicine at NLGP?</p>
						<span>About New Lands Pharma</span>
						<a href="">more<i class="fa-solid fa-arrow-right ms-2" style="color: #0C3072;"></i></a>
					</li>
					</ul>
					</div>
				</div>
				</section>
				<div class="col-12 faq-section mt-5 pt-5">
					<div class="nav opennav" id="navbar">
						<nav class="nav__container">
							<div>
								<div class="nav__list">
									<?php
										$selectCat = $conn->prepare('SELECT * from faqscategories WHERE primacy=0');
										$selectCat->execute();
										while($row=$selectCat->fetch(PDO::FETCH_ASSOC)){
											$name = $row['name'];
											$id = $row['id'];
											$image = $row['image'];
											$slug = $row['slug'];
											$selectSubCat1 = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
											$selectSubCat1->execute();
											$countSub = $selectSubCat1->rowCount();
											if($countSub>0){
									?>
									<div class="nav__items">
										
										<div class="nav__dropdown">
											<a class="nav__link">
												<i class='nav__icon' ><img src="cat-image/icon/<?php echo $image; ?>" alt="" srcset=""></i>
												<span class="nav__name"><?php echo $name; ?></span>
												<i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
											</a>
											<div class="nav__dropdown-collapse">
												<div class="nav__dropdown-content">
												<?php
													$selectSubCat = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
													$selectSubCat->execute();
													while($rowSub=$selectSubCat->fetch(PDO::FETCH_ASSOC)){
														$names = $rowSub['name'];
														$ids = $rowSub['id'];
														$slugs = $rowSub['slug'];
												?>
													<a href="faq/<?php echo $slug.'/'.$slugs; ?>" class="nav__dropdown-item"><?php echo $names; ?></a>
												<?php
													}
												?>
												<a href="faq/<?php echo $slug; ?>" class="nav__dropdown-item">View All <i class="fa-solid fa-right-long"></i></a>
												</div>
											</div>
										</div>
									</div>
									<?php
											}else{
									?>
									<div class="nav__items">
										
										<div class="nav__dropdown">
											<a class="nav__link" href="faq/<?php echo $slug; ?>">
												<i class='nav__icon' ><img src="cat-image/icon/<?php echo $image; ?>" alt="" srcset=""></i>
												<span class="nav__name"><?php echo $name; ?></span>
											</a>
										</div>
									</div>
									<?php
										}}
									?>
								</div>
							</div>

						</nav>
					</div>
					<div class="faq-answer">
						<?php
							
							if(isset($subcatid)){
								$selectQa = $conn->prepare('SELECT * from faqs WHERE category_id=?');
								$selectQa->execute([$subcatid]);
								$totalSub = $selectQa->rowCount();
							}elseif($catIds) {
								$selectQa = $conn->prepare('SELECT * from faqs WHERE main_category_id=?');
								$selectQa->execute([$catIds]);
								$totalMain = $selectQa->rowCount();
							}
							if(!isset($subcatid) && $totalMain==0) {
								$selectQa = $conn->prepare('SELECT * from faqs WHERE category_id=?');
								$selectQa->execute([$catIds]);
							}
							$i=0;
							while($rowQa=$selectQa->fetch(PDO::FETCH_ASSOC)){
								++$i;
								$question = $rowQa['question'];
								$answer = $rowQa['answer'];
						?>
						<div class="qa-div">
							<h3><?php echo $i.'. '.$question; ?></h3>
							<p><?php echo $answer; ?></p>
						</div>
						<?php
							}
						?>
						
					</div>
				</div>
            </div>
        </div>
</main>
    <!-- Footer-->
      
<?php include('include/footer.php'); ?>
