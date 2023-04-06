<aside class="offcanvas offcanvas-expand w-100 border-end" id="sideNav" style="max-width: 21.875rem;">
      <div class="pt-2 d-none d-lg-block"></div>
      <ul class="nav nav-tabs nav-justified mb-0" role="tablist" style="min-height: 3rem;">
        <li class="nav-item"><a class="nav-link fw-medium" href="#categories" data-bs-toggle="tab" role="tab">Categories</a></li>
        <li class="nav-item"><a class="nav-link fs-sm"data-bs-dismiss="offcanvas" role="tab"><i class="fa-solid fa-xmark  fs-xs me-2"></i></a></li>
      </ul>
      <div class="offcanvas-body px-0 pt-0 pb-0">
          <div class="tab-content">
            <!-- Categories-->
            <div class="sidebar-nav tab-pane fade show active" id="categories" role="tabpanel">
              <div class="widget widget-categories">
                <div class="accordion" id="shop-categories">
                  <!-- Special offers-->
                  <div class="accordion-item border-bottom">
                    <h3 class="accordion-header px-grid-gutter" style="background: #0c3072;color: #fff !important;">
                        <a class="nav-link-style d-block fs-md fw-normal py-3" href="bestseller" style="color: #fff;">
                            <span class="d-flex align-items-center">
                                <i class="fa-solid fa-tag fs-lg mt-n1 me-2"></i>
                                Bestseller
                            </span>
                        </a>
                    </h3>
                  </div>
                  <div class="cat-bg">
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                        <?php
                            if($productSeoTitle!='checkout'){
                        ?>
                        <lord-icon src="https://assets6.lottiefiles.com/packages/lf20_kpx4m39k.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width: 414px;height: fit-content;display: flex;"></lord-icon>
                      	<?php 
                            }
                      	?>
                      	</div>
                    </div>
                  <div class='showcat'></div>
                    <script>
                        function scrolling(x) {
                            alert("adad");
                            $(x).on('shown.bs.collapse', function () {
                              this.scrollIntoView();
                            });
                        }
                    </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!--<div class="offcanvas-footer d-block px-grid-gutter pt-4 pb-4 mb-2">-->
      <!--  <div class="d-flex mb-3"><i class="ci-support h4 mb-0 fw-normal text-primary mt-1 me-1"></i>-->
      <!--    <div class="ps-2">-->
      <!--      <div class="text-muted fs-sm">Support</div><a class="nav-link-style fs-md" href="tel:+100331697720">+1 (00) 33 169 7720</a>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--  <div class="d-flex mb-3"><i class="ci-mail h5 mb-0 fw-normal text-primary mt-1 me-1"></i>-->
      <!--    <div class="ps-2">-->
      <!--      <div class="text-muted fs-sm">Email</div><a class="nav-link-style fs-md" href="mailto:customer@example.com">customer@example.com</a>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--  <h6 class="pt-2 pb-1">Follow us</h6><a class="btn-social bs-outline bs-twitter me-2 mb-2" href="#"><i class="ci-twitter"></i></a><a class="btn-social bs-outline bs-facebook me-2 mb-2" href="#"><i class="ci-facebook"></i></a><a class="btn-social bs-outline bs-instagram me-2 mb-2" href="#"><i class="ci-instagram"></i></a><a class="btn-social bs-outline bs-youtube me-2 mb-2" href="#"><i class="ci-youtube"></i></a>-->
      <!--</div>-->
    </aside>