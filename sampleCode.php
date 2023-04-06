<section class="home-faq">
      <div class="row">
        <div class="col-12">
          <h2 class="heading">Read Our FAQ's</h2>
        </div>
        <div class="col-12">
          <!-- Basic accordion -->
          <div class="accordion" id="accordionExample">
            
            <?php
              $i=0;
							$selectCat = $conn->prepare('SELECT * from faqscategories WHERE primacy=0');
							$selectCat->execute();
							while($row=$selectCat->fetch(PDO::FETCH_ASSOC)){
                ++$i;
								$name = $row['name'];
								$id = $row['id'];
								$image = $row['image'];
								$slug = $row['slug'];
                if($i==1){
                  $bsta = '';
                  $bodysta = 'show';
                }else {
                  $bsta = 'collapsed';
                  $bodysta = '';
                }
                $selectSubCat1 = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                $selectSubCat1->execute();
                $countSub = $selectSubCat1->rowCount();
						?>        
            <div class="accordion-item">
              <?php
                if($countSub>0){
              ?>
              <h2 class="accordion-header" id="heading<?php echo $i ?>">
                <a href="faq/<?php echo $slug; ?>" class="accordion-button <?php echo $bsta;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i ?>" aria-expanded="true" aria-controls="collapse<?php  echo $i ?>">
                  <img src="cat-image/icon/<?php echo $image; ?>" alt="" srcset="">
                  <h2> <?php echo $name; ?> </h2>
                </a>
              </h2>
              <div class="accordion-collapse collapse <?php echo $bodysta;?>" id="collapse<?php echo $i ?>" aria-labelledby="heading<?php echo $i ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <?php
                    $selectSubCat = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                    $selectSubCat->execute();
                    while($rowSub=$selectSubCat->fetch(PDO::FETCH_ASSOC)){
                      $names = $rowSub['name'];
                      $ids = $rowSub['id'];
                      $slugs = $rowSub['slug'];
                  ?>
                  <h2 class="accordion-header" id="subheading">
                      <a href="faq/<?php echo $slug.'/'.$slugs; ?>" class="accordion-button" type="button">
                        <h2><?php echo $names; ?></h2>
                    </a>
                  </h2>
                  <?php
                    }
                  ?>
                </div>
              </div>
              <?php
                }else {
              ?>
                <h2 class="accordion-header" id="heading<?php echo $i ?>">
                  <a href="faq/<?php echo $slug; ?>" class="accordion-button <?php echo $bsta;?>" >
                    <img src="cat-image/icon/<?php echo $image; ?>" alt="" srcset="">
                    <h2> <?php echo $name; ?> </h2>
                  </a>
                </h2>
              <?php
                }
              ?>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
    </section>

    <section class="home-faq">
      <div class="row">
        <div class="col-12">
          <h2 class="heading">Read Our FAQ's</h2>
        </div>
        <div class="col-12">
          <!-- Basic accordion -->
          <div class="accordion" id="accordionExample">
            
            <?php
              $i=0;
							$selectCat = $conn->prepare('SELECT * from faqscategories WHERE primacy=0');
							$selectCat->execute();
							while($row=$selectCat->fetch(PDO::FETCH_ASSOC)){
                ++$i;
								$name = $row['name'];
								$id = $row['id'];
								$image = $row['image'];
								$slug = $row['slug'];
                if($i==1){
                  $bsta = '';
                  $bodysta = 'show';
                }else {
                  $bsta = 'collapsed';
                  $bodysta = '';
                }
                $selectSubCat1 = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                $selectSubCat1->execute();
                $countSub = $selectSubCat1->rowCount();
						?>        
            <div class="accordion-item">
              <?php
                if($countSub>0){
              ?>
              <h2 class="accordion-header" id="heading<?php echo $i ?>">
                <a href="faq/<?php echo $slug; ?>" class="accordion-button <?php echo $bsta;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i ?>" aria-expanded="true" aria-controls="collapse<?php  echo $i ?>">
                  <img src="cat-image/icon/<?php echo $image; ?>" alt="" srcset="">
                  <h2> <?php echo $name; ?> </h2>
                </a>
              </h2>
              <div class="accordion-collapse collapse <?php echo $bodysta;?>" id="collapse<?php echo $i ?>" aria-labelledby="heading<?php echo $i ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <?php
                    $selectSubCat = $conn->prepare("SELECT * from faqscategories WHERE primacy='".$id."'");
                    $selectSubCat->execute();
                    while($rowSub=$selectSubCat->fetch(PDO::FETCH_ASSOC)){
                      $names = $rowSub['name'];
                      $ids = $rowSub['id'];
                      $slugs = $rowSub['slug'];
                  ?>
                  <h2 class="accordion-header" id="subheading">
                      <a href="faq/<?php echo $slug.'/'.$slugs; ?>" class="accordion-button" type="button">
                        <h2><?php echo $names; ?></h2>
                    </a>
                  </h2>
                  <?php
                    }
                  ?>
                </div>
              </div>
              <?php
                }else {
              ?>
                <h2 class="accordion-header" id="heading<?php echo $i ?>">
                  <a href="faq/<?php echo $slug; ?>" class="accordion-button <?php echo $bsta;?>" >
                    <img src="cat-image/icon/<?php echo $image; ?>" alt="" srcset="">
                    <h2> <?php echo $name; ?> </h2>
                  </a>
                </h2>
              <?php
                }
              ?>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
      </div>
    </section>


    .home-faq1 .accordion-item .accordion-header .accordion-button{
    position: relative;
  }
  .home-faq1 .accordion-item .accordion-header .accordion-button .accord-title {
    position: absolute;
    margin: 0;
    left: 186px;
    font-size: 16px;
  } 