<?php 
   
    include('include/header.php'); 
?>
<?php include('include/sidenav.php'); ?>

<main class="shop-page offcanvas-enabled" style="padding-top: 89px; background: rgba(0,0,0,0);">
    <div class="container-fluid review-section">
        <div class="row">
            <div class="col-lg-6 col-12 left-review-header">
                <h2>Newlands Pharmacy</h2>
                <h2>Review Board</h2>
                <div class="text">
                    <p style=" font-size: 24px; color: #0C3072;">What user’s think about our </p>
                    <p style=" font-size: 40px;">
                        <span class="word wisteria">Services</span>
                        <span class="word belize">Product</span>
                        <span class="word pomegranate">Website</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <img src="./image/Ratings 1.png">
            </div>
        </div>
    </div>
    <div class="container-fluid review-section review-breif">
        <div class="row">
            <div class="col-12">

                <ul class="nav nav-tabs card-header-tabs justify-content-between ps-5" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link fw-medium active" href="#service" data-bs-toggle="tab" role="tab" aria-selected="true">
                            <!-- <img src="./image/service.png" alt="" srcset=""> -->
                            <span>Service Review</span>
                        </a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#product" data-bs-toggle="tab" role="tab" aria-selected="false">
                            <!-- <img src="./image/product.png" alt="" srcset=""> -->
                            <span>Product Review</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#website" data-bs-toggle="tab" role="tab" aria-selected="false">
                            <!-- <img src="./image/website.png" alt="" srcset=""> -->
                            <span>Website Review</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="#overall" data-bs-toggle="tab" role="tab" aria-selected="false">
                            <!-- <img src="./image/overall.png" alt="" srcset=""> -->
                            <span>Overall Review</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content overflow-hidden" style="margin-top: 7px;">

                    <div class="tab-pane fade active show" id="service">
                                <?php
                                                $service_review = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id ASC');
                                                $service_review->execute(['Service Review' ,'Approved']);
                                                $count = $service_review->RowCount();
                                                $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                $num1_array = array();
                                                $num2_array = array();
                                                $num3_array = array();
                                                $num4_array = array();
                                                $num5_array = array();
                                                $i=1;
                                                foreach($row_service_review as $review_rating_row){
                                                $i++;

                                                    if($review_rating_row['rating']==5){
                                                        array_push($num5_array, $review_rating_row['rating']);
                                                    }elseif($review_rating_row['rating']==4){
                                                        array_push($num4_array, $review_rating_row['rating']);
                                                    }elseif($review_rating_row['rating']==3){
                                                        array_push($num3_array, $review_rating_row['rating']);
                                                    }elseif($review_rating_row['rating']==2){
                                                        array_push($num2_array, $review_rating_row['rating']);                                                       
                                                    }elseif($review_rating_row['rating']==1){
                                                        array_push($num1_array, $review_rating_row['rating']);
                                                    }

                                                }
                                                    $star_5 = count($num5_array); 
                                                    $progress_bar_5 = ($star_5/$count)*100;
                                                    $star_4 = count($num4_array); 
                                                    $progress_bar_4 = ($star_4/$count)*100;
                                                    $star_3 = count($num3_array); 
                                                    $progress_bar_3 = ($star_3/$count)*100;
                                                    $star_2 = count($num2_array); 
                                                    $progress_bar_2 = ($star_2/$count)*100;
                                                    $star_1 = count($num1_array); 
                                                    $progress_bar_1 = ($star_1/$count)*100;
                                    
                                ?>
                        <div class="review-chart">
                            <div class="start-status">
                                <div class="star rate">
                                    <div class="rating-num">4.0<span class="divide">/</span><span class="outof">5</span></div>
                                    <div class="rating-icon"><img src="./image/review/star.png"></div>
                                </div>
                                <div class="total-star">
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                </div>
                                <div class="status">
                                    Excellent
                                </div>
                            </div>
                            <div class="user-profile">
                                <div class="profile-list">
                                    <img src="./image/review/pr1.png" alt="" srcset="">
                                    <img src="./image/review/pr2.png" alt="" srcset="">
                                    <img src="./image/review/pr3.png" alt="" srcset="">
                                    <img src="./image/review/pr4.png" alt="" srcset="">
                                </div>
                                <div class="user-total">
                                    +<?php echo $count ?>
                                </div>
                            </div>
                            <div class="rating">
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">5</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_5; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div> 
                                    <div class="total">
                                    <?php echo $star_5 ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">4</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_4; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>
                                    <div class="total">
                                    <?php echo $star_4 ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">3</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_3; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                        <?php echo $star_3 ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">2</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_2)){ echo 0;}; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo $star_2 ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">1</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_1)){ echo 0;}; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo $star_1 ?>
                                    </div> 
                                </div>
                            </div>
                        </div>


                        <div class="review-list" id="more_service_review">
                            
                            <?php
                                $service_review_limit = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id ASC limit 2');
                                $service_review_limit->execute(['Service Review' ,'Approved']);
                                $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
                            $i=1;
                            foreach($row_service_review_limit as $review_row){
                            $lastId = $review_row['id'];

                            $post_date = $review_row['date'];
                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($post_date);
                            $interval = $datetime1->diff($datetime2);
                            $month_ago = $interval->format('%m');
                            $year_ago = $interval->format('%y');
                            if($month_ago==0){
                                $set_date = $year_ago." Years Ago";
                            }else{
                                $set_date = $month_ago." Months Ago";
                            }

                            // echo $review_row['date'];   
                            // $old_date = new DateTime($review_row['date']);
                            // $now = new DateTime(Date('Y-m-d'));
                            // $interval = $old_date->diff($now);
                            // $month_ago = $interval->m;

                            // echo $interval->d.' days<br>';
                            // // you can also get years, month, hours, minutes, and seconds
                            // echo $interval->y.' years<br>';
                            // echo $interval->m.' month<br>';
                            // echo $interval->h.' hours<br>';
                            // echo $interval->i.' minutes<br>';
                            // echo $interval->s.' seconds<br>';
                            
                        //   $interval = $old_date->diff($now);
                        //   $year_ago = $interval->y;
                        //   $month_ago = $interval->m;
                        //   $days_ago = $interval->d;
                        //   $hours_ago = $interval->h;
                        //   $minutes_ago = $interval->i;
                        //   $seconds_ago = $interval->s;
                            
                            ?>   
                            <div class="rlist-item">
                                <div class="number"><?php echo $i; ?></div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-6 vol-12">
                                            <div class="user-data">
                                                <div class="name"><?php echo $review_row['username']; ?></div>

                                                <div class="star-rating">
                                                <?php if($review_row['rating']==1){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>  
                                                <?php }elseif($review_row['rating']==2){?>                                                   
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==3){ ?>     
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==4){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==5){?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php } ?>
                                                    </div>

                                                <div class="review-status">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <p>Query Resolved</p>
                                                </div>
                                            </div>
                                            <div class="review-user-meta">
                                                <div class="user-type">Existing Users</div>
                                                <div class="user-location"><?php echo $review_row['state'] ?>, <?php echo $review_row['country'] ?></div>
                                                <div class="date"><?php echo $set_date ?></div>
                                            </div>
                                            <div class="review-content">
                                                <?php echo $review_row['review']; ?>
                                            </div>

                                            <!-- <div class="chat-window">
                                                <div class="chat-body sender">
                                                    <div class="content">Thanks Nancy for shopping with us</div>
                                                    <div class="profile"><img src="./image/review/npchaticon.png"></div>
                                                </div>
                                            </div>
                                            <div class="chat-window">
                                                <div class="chat-body receiver">
                                                    <div class="content">Thanks Nancy for shopping with us</div>
                                                    <div class="diff-arrow"></div>
                                                    <div class="profile"><img src="./image/review/npchaticon.png"></div>
                                                </div>
                                            </div> -->

                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="review-product-image">
                                                <?php
                                    $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                    $service_review_image->execute([$review_row['id']]);
                                    while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                     


                                                        // $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                        // $service_review_image->execute([$review_row['id']]);
                                                        // $row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC));
                                                ?>
                                                <div class="image-item">
                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $row_service_review_image['path'] ?>" class="review-item-image">
                                                </div>
                                    <?php } ?>

                                                <!-- <div class="image-item">
                                                    <img src="./image/review/product2.png" class="review-item-image">
                                                </div>
                                                <div class="image-item">
                                                    <img src="./image/review/product3.png" class="review-item-image">
                                                </div>
                                                <div class="image-item">
                                                    <img src="./image/review/product4.png" class="review-item-image">
                                                </div> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php $i++; } ?> 
                        </div>
                                            
                        <div class="d-flex justify-content-center">
                            <button class="btn-process" id="btn_more_service_review" onclick="getmoreservice_Reviews(this)" data-increment_val="<?php echo $i ?>" data-last_id="<?php echo $lastId ?>">Read All Review
                                <span class="btn-ring"></span>
                            </button>   
                        </div>
                    </div>


                    <div class="tab-pane position-relative fade" id="product">

                                        <div class="product_review_search_section">
                                            <div class="input_container">
                                            <input type="text" class="product_searchbar" placeholder="Search product...">
                                            </div>
                                        </div>

                                <?php
                                                $service_review = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id ASC');
                                                $service_review->execute(['Product Review' ,'Approved']);
                                                $count = $service_review->RowCount();
                                                $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                                                $num1_array = array();
                                                $num2_array = array();
                                                $num3_array = array();
                                                $num4_array = array();
                                                $num5_array = array();
                                                $productCode = array();
                                                    foreach($row_service_review as $review_rating_row){
                                                        array_push($productCode, $review_rating_row['productCode']);
                                                        if($review_rating_row['rating']==5){
                                                            array_push($num5_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==4){
                                                            array_push($num4_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==3){
                                                            array_push($num3_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==2){
                                                            array_push($num2_array, $review_rating_row['rating']);                                                       
                                                        }elseif($review_rating_row['rating']==1){
                                                            array_push($num1_array, $review_rating_row['rating']);
                                                        }
                                                }
                                                $star_5 = count($num5_array); 
                                                $progress_bar_5 = ($star_5/$count)*100;
                                                $star_4 = count($num4_array); 
                                                $progress_bar_4 = ($star_4/$count)*100;
                                                $star_3 = count($num3_array); 
                                                $progress_bar_3 = ($star_3/$count)*100;
                                                $star_2 = count($num2_array); 
                                                $progress_bar_2 = ($star_2/$count)*100;
                                                $star_1 = count($num1_array); 
                                                $progress_bar_1 = ($star_1/$count)*100; ?>
                        <div class="review-chart">
                            <div class="start-status">
                                <div class="star rate">
                                    <div class="rating-num">4.0<span class="divide">/</span><span class="outof">5</span></div>
                                    <div class="rating-icon"><img src="./image/review/star.png"></div>
                                </div>
                                <div class="total-star">
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                </div>
                                <div class="status">
                                    Excellent
                                </div>
                            </div>
                            <div class="user-profile">
                                <div class="profile-list">
                                    <img src="./image/review/pr1.png" alt="" srcset="">
                                    <img src="./image/review/pr2.png" alt="" srcset="">
                                    <img src="./image/review/pr3.png" alt="" srcset="">
                                    <img src="./image/review/pr4.png" alt="" srcset="">
                                </div>
                                <div class="user-total">
                                    +<?php echo $count ?>
                                </div>
                            </div>
                            <div class="rating">
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">5</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_5; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div> 
                                    <div class="total">
                                    <?php echo count($num5_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">4</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_4; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>
                                    <div class="total">
                                    <?php echo count($num4_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">3</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_3; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                        <?php echo count($num3_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">2</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_2)){ echo 0;}; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo count($num2_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">1</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_1)){ echo 0;}; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo count($num1_array); ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="review-list" id="more_product_review">
                            <?php
                            $service_review_limit = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id ASC limit 10');
                            $service_review_limit->execute(['Product Review' ,'Approved']);
                            $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
                            $i=1;
                            foreach($row_service_review_limit as $review_row){
                            $post_date = $review_row['date'];
                            $productCode = $review_row['productCode'];
                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($post_date);
                            $interval = $datetime1->diff($datetime2);
                            $month_ago = $interval->format('%m');
                            $year_ago = $interval->format('%y');
                            if($month_ago==0){
                                $set_date = $year_ago." Years Ago";
                            }else{
                                $set_date = $month_ago." Months Ago";
                            }

                            $product_review_limit = $conn->prepare('SELECT productName FROM ogproduct WHERE productCode=?');
                            $product_review_limit->execute([$productCode]);
                            $product_review_limit = $product_review_limit->fetchAll(PDO::FETCH_ASSOC);
                            $productName = $product_review_limit[0]['productName'];
                            
                            ?>   
                            <div class="rlist-item" id="search_product_reavie">
                                <div class="pill_design">
                                    <div class="number"><?php echo $i; ?></div>
                                    <p class="product_name_tage"><?php echo $productName ?></p>
                                </div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-6 vol-12">
                                            <div class="user-data">
                                                <div class="name"><?php echo $review_row['username']; ?></div>
                                                <div class="star-rating">
                                                <?php if($review_row['rating']==1){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>  
                                                <?php }elseif($review_row['rating']==2){?>                                                   
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==3){ ?>     
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==4){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==5){?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php } ?>
                                                </div>
                                                <div class="review-status">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <p>Query Resolved</p>
                                                </div>
                                            </div>
                                            <div class="review-user-meta">
                                                <div class="user-type">Existing Users</div>
                                                <div class="user-location"><?php echo $review_row['state'] ?>, <?php echo $review_row['country'] ?></div>
                                                <div class="date"><?php echo $set_date ?></div>
                                            </div>
                                            <div class="review-content">
                                                <?php echo $review_row['review']; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="review-product-image">
                                                <?php
                                                    $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                    $service_review_image->execute([$review_row['id']]);
                                                    while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){?>
                                                    <div class="image-item">
                                                        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $row_service_review_image['path'] ?>" class="review-item-image">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php $i++; } ?> 
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn-process" id="btn_more_product_review" onclick="getmoreProduct_Reviews(this)" data-product_increment_val="<?php echo $i ?>" data-product_last_id="<?php echo $lastId ?>">Read All Review
                                <span class="btn-ring"></span>
                            </button>   
                        </div>
                    </div>


                <div class="tab-pane fade" id="website">
                                <?php
                                                $service_review = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id ASC');
                                                $service_review->execute(['Website Review' ,'Approved']);
                                                $count = $service_review->RowCount();
                                                $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                                                $num1_array = array();
                                                $num2_array = array();
                                                $num3_array = array();
                                                $num4_array = array();
                                                $num5_array = array();
                                                    foreach($row_service_review as $review_rating_row){

                                                        if($review_rating_row['rating']==5){
                                                            array_push($num5_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==4){
                                                            array_push($num4_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==3){
                                                            array_push($num3_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==2){
                                                            array_push($num2_array, $review_rating_row['rating']);                                                       
                                                        }elseif($review_rating_row['rating']==1){
                                                            array_push($num1_array, $review_rating_row['rating']);
                                                        }

                                                }
                                                $star_5 = count($num5_array); 
                                                $progress_bar_5 = ($star_5/$count)*100;
                                                $star_4 = count($num4_array); 
                                                $progress_bar_4 = ($star_4/$count)*100;
                                                $star_3 = count($num3_array); 
                                                $progress_bar_3 = ($star_3/$count)*100;
                                                $star_2 = count($num2_array); 
                                                $progress_bar_2 = ($star_2/$count)*100;
                                                $star_1 = count($num1_array); 
                                                $progress_bar_1 = ($star_1/$count)*100;



                                                    
                                    
                                ?>
                        <div class="review-chart">
                            <div class="start-status">
                                <div class="star rate">
                                    <div class="rating-num">4.0<span class="divide">/</span><span class="outof">5</span></div>
                                    <div class="rating-icon"><img src="./image/review/star.png"></div>
                                </div>
                                <div class="total-star">
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                </div>
                                <div class="status">
                                    Excellent
                                </div>
                            </div>
                            <div class="user-profile">
                                <div class="profile-list">
                                    <img src="./image/review/pr1.png" alt="" srcset="">
                                    <img src="./image/review/pr2.png" alt="" srcset="">
                                    <img src="./image/review/pr3.png" alt="" srcset="">
                                    <img src="./image/review/pr4.png" alt="" srcset="">
                                </div>
                                <div class="user-total">
                                    +<?php echo $count ?>
                                </div>
                            </div>
                            <div class="rating">
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">5</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_5; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div> 
                                    <div class="total">
                                    <?php echo count($num5_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">4</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_4; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>
                                    <div class="total">
                                    <?php echo count($num4_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">3</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_3; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                        <?php echo count($num3_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">2</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_2)){ echo 0;} ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo count($num2_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">1</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_1)){ echo 0;} ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo count($num1_array); ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="review-list" id="more_website_review">
                            <?php
                                $service_review_limit = $conn->prepare('SELECT * FROM reviews WHERE reviewType=? AND status=? ORDER BY id ASC limit 10');
                                $service_review_limit->execute(['Website Review' ,'Approved']);
                                $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
                            $i=1;
                            foreach($row_service_review_limit as $review_row){
                            $website_lastId = $review_row['id']; 
                            $post_date = $review_row['date'];
                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($post_date);
                            $interval = $datetime1->diff($datetime2);
                            $month_ago = $interval->format('%m');
                            $year_ago = $interval->format('%y');
                            if($month_ago==0){
                                $set_date = $year_ago." Years Ago";
                            }else{
                                $set_date = $month_ago." Months Ago";
                            }
                            ?>   
                            <div class="rlist-item">
                                <div class="number"><?php echo $i; ?></div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-6 vol-12">
                                            <div class="user-data">
                                                <div class="name"><?php echo $review_row['username']; ?></div>
                                                <div class="star-rating">
                                                <?php if($review_row['rating']==1){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>  
                                                <?php }elseif($review_row['rating']==2){?>                                                   
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==3){ ?>     
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==4){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==5){?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php } ?>
                                                </div>
                                                <div class="review-status">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <p>Query Resolved</p>
                                                </div>
                                            </div>
                                            <div class="review-user-meta">
                                                <div class="user-type">Existing Users</div>
                                                <div class="user-location"><?php echo $review_row['state'] ?>, <?php echo $review_row['country'] ?></div>
                                                <div class="date"><?php echo $set_date ?></div>
                                            </div>
                                            <div class="review-content">
                                                <?php echo $review_row['review']; ?>
                                            </div>

                                            <!-- <div class="chat-window">
                                                <div class="chat-body sender">
                                                    <div class="content">Thanks Nancy for shopping with us</div>
                                                    <div class="profile"><img src="./image/review/npchaticon.png"></div>
                                                </div>
                                            </div>
                                            <div class="chat-window">
                                                <div class="chat-body receiver">
                                                    <div class="content">Thanks Nancy for shopping with us</div>
                                                    <div class="diff-arrow"></div>
                                                    <div class="profile"><img src="./image/review/npchaticon.png"></div>
                                                </div>
                                            </div> -->

                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="review-product-image">
                                                <?php
                                    $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                    $service_review_image->execute([$review_row['id']]);
                                    while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                     


                                                        // $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                        // $service_review_image->execute([$review_row['id']]);
                                                        // $row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC));
                                                ?>
                                                <div class="image-item">
                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $row_service_review_image['path'] ?>" class="review-item-image">
                                                </div>
                                    <?php } ?>

                                                <!-- <div class="image-item">
                                                    <img src="./image/review/product2.png" class="review-item-image">
                                                </div>
                                                <div class="image-item">
                                                    <img src="./image/review/product3.png" class="review-item-image">
                                                </div>
                                                <div class="image-item">
                                                    <img src="./image/review/product4.png" class="review-item-image">
                                                </div> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php $i++; } ?> 
                        </div>

                        <div class="d-flex justify-content-center">
                            <button class="btn-process" id="btn_more_website_review" onclick="getmoreWebsite_Reviews(this)" data-website_increment_val="<?php echo $i ?>" data-website_last_id="<?php echo $website_lastId ?>">Read All Review
                                <span class="btn-ring"></span>
                            </button>   
                        </div>

                    </div>
                    <div class="tab-pane fade" id="overall">
                                <?php
                                                $service_review = $conn->prepare('SELECT * FROM reviews WHERE status="Approved" ORDER BY id ASC');
                                                $service_review->execute();
                                                $count = $service_review->RowCount();
                                                $row_service_review = $service_review->fetchAll(PDO::FETCH_ASSOC);
                                                $num1_array = array();
                                                $num2_array = array();
                                                $num3_array = array();
                                                $num4_array = array();
                                                $num5_array = array();
                                                    foreach($row_service_review as $review_rating_row){

                                                        if($review_rating_row['rating']==5){
                                                            array_push($num5_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==4){
                                                            array_push($num4_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==3){
                                                            array_push($num3_array, $review_rating_row['rating']);
                                                        }elseif($review_rating_row['rating']==2){
                                                            array_push($num2_array, $review_rating_row['rating']);                                                       
                                                        }elseif($review_rating_row['rating']==1){
                                                            array_push($num1_array, $review_rating_row['rating']);
                                                        }

                                                }

                                                $star_5 = count($num5_array); 
                                                $progress_bar_5 = ($star_5/$count)*100;
                                                $star_4 = count($num4_array); 
                                                $progress_bar_4 = ($star_4/$count)*100;
                                                $star_3 = count($num3_array); 
                                                $progress_bar_3 = ($star_3/$count)*100;
                                                $star_2 = count($num2_array); 
                                                $progress_bar_2 = ($star_2/$count)*100;
                                                $star_1 = count($num1_array); 
                                                $progress_bar_1 = ($star_1/$count)*100;
                                ?>
                        <div class="review-chart">
                            <div class="start-status">
                                <div class="star rate">
                                    <div class="rating-num">4.0<span class="divide">/</span><span class="outof">5</span></div>
                                    <div class="rating-icon"><img src="./image/review/star.png"></div>
                                </div>
                                <div class="total-star">
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                    <span class="star"><img src="./image/review/star.png"></span>
                                </div>
                                <div class="status">
                                    Excellent
                                </div>
                            </div>
                            <div class="user-profile">
                                <div class="profile-list">
                                    <img src="./image/review/pr1.png" alt="" srcset="">
                                    <img src="./image/review/pr2.png" alt="" srcset="">
                                    <img src="./image/review/pr3.png" alt="" srcset="">
                                    <img src="./image/review/pr4.png" alt="" srcset="">
                                </div>
                                <div class="user-total">
                                    +<?php echo $count ?>
                                </div>
                            </div>
                            <div class="rating">

                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">5</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_5; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div> 
                                    <div class="total">
                                    <?php echo count($num5_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">4</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_4; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>
                                    <div class="total">
                                    <?php echo count($num4_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">3</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php echo $progress_bar_3; ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                        <?php echo count($num3_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">2</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_2)){ echo 0;} ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo count($num2_array); ?>
                                    </div> 
                                </div>
                                <div class="star-pro-list">
                                    <div class="start-type">
                                        <span class="num">1</span> <img src="./image/review/star.png">
                                    </div>
                                    <div class="wrapper">
                                        <div class="storage__gradient u-mb-sm">
                                            <span style="width: <?php if(empty($progress_bar_1)){ echo 0;} ?>%;"><span class="progress"></span></span>
                                        </div>
                                    </div>  
                                    <div class="total">
                                    <?php echo count($num1_array); ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="review-list" id="more_overall_review">
                            <?php
                                $service_review_limit = $conn->prepare('SELECT * FROM reviews WHERE status=? ORDER BY id ASC limit 10');
                                $service_review_limit->execute(['Approved']);
                                $row_service_review_limit = $service_review_limit->fetchAll(PDO::FETCH_ASSOC);
                            $i=1;
                            foreach($row_service_review_limit as $review_row){
                                $overall_lastId = $review_row['id'];
                                $post_date = $review_row['date'];
                                $datetime1 = new DateTime();
                                $datetime2 = new DateTime($post_date);
                                $interval = $datetime1->diff($datetime2);
                                $month_ago = $interval->format('%m');
                                $year_ago = $interval->format('%y');
                                if($month_ago==0){
                                    $set_date = $year_ago." Years Ago";
                                }else{
                                    $set_date = $month_ago." Months Ago";
                                }
                            ?>   
                            <div class="rlist-item">
                                <div class="number"><?php echo $i; ?></div>
                                <div class="content">
                                    <div class="row">
                                        <div class="col-lg-6 vol-12">
                                            <div class="user-data">
                                                <div class="name"><?php echo $review_row['username']; ?></div>
                                                <div class="star-rating">
                                                <?php if($review_row['rating']==1){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>  
                                                <?php }elseif($review_row['rating']==2){?>                                                   
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==3){ ?>     
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==4){ ?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php }elseif($review_row['rating']==5){?>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                        <span class=""><img src="./image/review/star.png"></span>
                                                <?php } ?>
                                                </div>
                                                <div class="review-status">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <p>Query Resolved</p>
                                                </div>
                                            </div>
                                            <div class="review-user-meta">
                                                <div class="user-type">Existing Users</div>
                                                <div class="user-location"><?php echo $review_row['state'] ?>, <?php echo $review_row['country'] ?></div>
                                                <div class="date"><?php echo $set_date ?></div>
                                            </div>
                                            <div class="review-content">
                                                <?php echo $review_row['review']; ?>
                                            </div>

                                            <!-- <div class="chat-window">
                                                <div class="chat-body sender">
                                                    <div class="content">Thanks Nancy for shopping with us</div>
                                                    <div class="profile"><img src="./image/review/npchaticon.png"></div>
                                                </div>
                                            </div>
                                            <div class="chat-window">
                                                <div class="chat-body receiver">
                                                    <div class="content">Thanks Nancy for shopping with us</div>
                                                    <div class="diff-arrow"></div>
                                                    <div class="profile"><img src="./image/review/npchaticon.png"></div>
                                                </div>
                                            </div> -->

                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="review-product-image">
                                                <?php
                                    $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                    $service_review_image->execute([$review_row['id']]);
                                    while($row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC)){
                                     


                                                        // $service_review_image = $conn->prepare('SELECT * FROM reviewImages WHERE reviewId=? ORDER BY id ASC');
                                                        // $service_review_image->execute([$review_row['id']]);
                                                        // $row_service_review_image = $service_review_image->fetch(PDO::FETCH_ASSOC));
                                                ?>
                                                <div class="image-item">
                                                    <img src="https://myglobal1.gumlet.io/onglobaladmincrm/<?php echo $row_service_review_image['path'] ?>" class="review-item-image">
                                                </div>
                                    <?php } ?>

                                                <!-- <div class="image-item">
                                                    <img src="./image/review/product2.png" class="review-item-image">
                                                </div>
                                                <div class="image-item">
                                                    <img src="./image/review/product3.png" class="review-item-image">
                                                </div>
                                                <div class="image-item">
                                                    <img src="./image/review/product4.png" class="review-item-image">
                                                </div> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <?php $i++; } ?> 
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn-process" id="btn_more_overall_review" onclick="getmoreOverall_Reviews(this)" data-increment_overall_val="<?php echo $i ?>" data-overall_last_id="<?php echo $overall_lastId ?>">Read All Review
                                <span class="btn-ring"></span>
                            </button>   
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php include('include/footer.php'); ?>
<script>
    var words = document.getElementsByClassName('word');
    var wordArray = [];
    var currentWord = 0;

    words[currentWord].style.opacity = 1;
    for (var i = 0; i < words.length; i++) {
    splitLetters(words[i]);
    }

    function changeWord() {
    var cw = wordArray[currentWord];
    var nw = currentWord == words.length-1 ? wordArray[0] : wordArray[currentWord+1];
    for (var i = 0; i < cw.length; i++) {
        animateLetterOut(cw, i);
    }
    
    for (var i = 0; i < nw.length; i++) {
        nw[i].className = 'letter behind';
        nw[0].parentElement.style.opacity = 1;
        animateLetterIn(nw, i);
    }
    
    currentWord = (currentWord == wordArray.length-1) ? 0 : currentWord+1;
    }

    function animateLetterOut(cw, i) {
    setTimeout(function() {
            cw[i].className = 'letter out';
    }, i*80);
    }

    function animateLetterIn(nw, i) {
    setTimeout(function() {
            nw[i].className = 'letter in';
    }, 340+(i*80));
    }

    function splitLetters(word) {
    var content = word.innerHTML;
    word.innerHTML = '';
    var letters = [];
    for (var i = 0; i < content.length; i++) {
        var letter = document.createElement('span');
        letter.className = 'letter';
        letter.innerHTML = content.charAt(i);
        word.appendChild(letter);
        letters.push(letter);
    }
    
    wordArray.push(letters);
    }

    changeWord();
    setInterval(changeWord, 4000);


</script>