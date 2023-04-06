<?php include('include/header.php'); ?>
<?php include('include/sidenav.php'); ?>
<main class="offcanvas-enabled" style="padding-top: 93px;">
    
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
          <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo $baseUrl; ?>"><i class="fa-solid fa-house"></i>Home</a></li>
                <li class="breadcrumb-item1 text-nowrap"><a href="account">Account</a>
                </li>
                <li class="breadcrumb-item text-nowrap active" aria-current="page">Address</li>
              </ol>
            </nav>
          </div>
          <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
            <h1 class="h3 text-light mb-0">Address</h1>
          </div>
        </div>
      </div>
      
      <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
            <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
              <div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
                <div class="d-md-flex align-items-center">
                  <div style=" padding: 0px 21px; background: #20c5be; color: #fff; border-radius: 32px; font-size: 43px; font-weight: 500; ">
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
                      <?php 
                         echo substr($name,0,1) 
                      ?>
                  </div>
                  <div class="ps-md-3">
                    <h3 class="fs-base mb-0"><?php echo $name; ?></h3>
                  </div>
                </div><a class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0" href="#account-menu" data-bs-toggle="collapse" aria-expanded="false"><i class="fa-solid fa-map-location-dot me-2"></i>Account menu</a>
              </div>
              <div class="d-lg-block collapse" id="account-menu">
                <div class="bg-secondary px-4 py-3">
                  <h3 class="fs-sm mb-0 text-muted">Dashboard</h3>
                </div>
                <ul class="list-unstyled mb-0">
                  <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="account"><i class="fa-solid fa-bag-shopping opacity-60 me-2"></i>Orders<span class="fs-sm text-muted ms-auto"></span></a></li>
                  <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="wishlist"><i class="fa-solid fa-heart opacity-60 me-2"></i>Wishlist<span class="fs-sm text-muted ms-auto"></span></a></li>
                </ul>
                <div class="bg-secondary px-4 py-3">
                  <h3 class="fs-sm mb-0 text-muted">Account settings</h3>
                </div>
                <ul class="list-unstyled mb-0">
                  <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="profile"><i class="fa-solid fa-user opacity-60 me-2"></i>Profile info</a></li>
                  <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 active" href="address"><i class="fa-solid fa-map-location-dot opacity-60 me-2"></i>Addresses</a></li>
                  
                  <li class="d-lg-none border-top mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="logout"><i class="fa-solid fa-right-from-bracket opacity-60 me-2"></i>Sign out</a></li>
                </ul>
              </div>
            </div>
          </aside>
          <!-- Content  -->
          <section class="col-lg-8">
            <!-- Toolbar-->
            <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
              <div class="d-flex align-items-center">
              </div><a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i>Sign out</a>
            </div>
            <!-- Orders list-->
            <div class="row mb-2">
                <div class="col-12 text-right">
                    <a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="#addUserAddress" onclick="editUserAddress('.$id.')" data-bs-toggle="modal"><i class="fa-solid fa-right-from-bracket me-2"></i>Add Address</a>
                </div>
            </div>
            <div class="row addressUSers">
            
            
            </div>
          </section>
        </div>
      </div>
    
    
<?php include('include/footer.php'); ?>