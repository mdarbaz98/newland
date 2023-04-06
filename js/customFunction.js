function getCart(){
    var btn = "load_maincart_data";
         $.ajax ({
             url: 'new_action.php',
             type: 'post',
             dataType: 'json',
             data: {"btn":btn},
             
             success: function(data) {
                 
                 var json = $.parseJSON(JSON.stringify(data))
                 var htmldata = json.datahtml;
                 var product_calculation = json.product_calculation;
                 var cart_product_count = json.cart_product_count;
                 var discount_price = json.discount_price+"% OFF";


                  $('.usercartList').html(htmldata);
                  $('.product_calculation').html(product_calculation);
                  $('.cart_total_product').html(cart_product_count)
                  $('.discount_price').html(discount_price)
 
               //  $('.outer_item1').html(data)
             }
         });
 }
 getCart();
 
 function deleteCartproduct(id){
     var btn = "DeleteFromCartPage";
     snackbar('Deleting Cart ...');
     $.ajax({
         url: 'new_action.php',
         type: 'post',
         dataType: 'html',
         data: {'btn':btn,
                 'cartid':id},
         success:function(data){
             if(data=='done'){
 
                 //snackbar('Item Removed');
                 // if(currentPage1.includes('cart')){
                 //     load_main_cart();
                 //     loadCoupan();
                 // }
                 // if(currentPage1.includes('checkout')){
                 //     load_checkout();
                 // }
                 // if(pageName=='ProductPage'){
                 //     loadMainStrength();
                 // }
 
                 getCart();
                 count_cart();
             }
         }
     })
 }
 function emptyCartproduct(){
     var btn = "RemoveAllcartproduct";
     snackbar('Deleting Cart ...');
     $.ajax({
         url: 'new_action.php',
         type: 'post',
         dataType: 'html',
         data: {'btn':btn},
 
         success:function(data){
             if(data=='done'){
                 getCart(); 
                 count_cart();
                 //count_cart();
             }
         }
     });
 
 }
 
 function cartProductupdate(id){
     var btn = "updateCartproduct";
     $.ajax({
         url: 'new_action.php',
         type: 'post',
         dataType: 'json',
         data: {'btn':btn,
               'cartid':id},
         success:function(data){
          var json = $.parseJSON(JSON.stringify(data))
          var cart_product_strength = json.cart_product_strength;
          var cart_product_quantity = json.cart_product_quantity;
          var product_cart_name = json.product_cart_name;
          var pill_calculation_strength=json.pill_calculation_strength;
          
           $('.strength-section').html(cart_product_strength);
           $('#productTabContent').html(cart_product_quantity);
           $('.product_cart_name').html(product_cart_name);
           $('.pill-strength-calculation').html(pill_calculation_strength);
           $('#cartProduct_update').modal('show');
 
             // if(data=='done'){
             //     getCart(); 
             //     //count_cart();
             // }
         }
     });
 }
 function test(x){
     var btn = "updateCartproduct_quantityPrice";
     var cart_strength = $('.cart_'+$(x).data('strength'));
     var strength_value = cart_strength.val();
     var quantityCode = $(x).data('qty_code');
     var quantity = $(x).data('quantity');
     var cartId = $(x).data('cartproductid');
     var productcode = $(x).data('productcode');
     var stength_code = $(x).data('product_strength');
     var discount = $(x).data('discount');
     var quantityogprice = $(x).data('quantityogprice');
     var product_orgprice = $(x).data('product_orgprice');
     var quantityPrice = $(x).data('qyt_prc');
     
     $('.qty-per-pill').removeClass('active');
     $(x).addClass('active');
     $.ajax({
         url: 'new_action.php',
         type: 'post',
         dataType: 'json',
         data: {'btn':btn,
               'quantityCode':quantityCode,
               'quantity':quantity,
               'strength':strength_value,
               'product_strength':stength_code,
               'discount':discount,
               'productcode':productcode,
               'quantityogprice':quantityogprice,
               'product_orgprice':product_orgprice,
               'quantityPrice':quantityPrice,
               'cartid':cartId},
         success:function(data){
                                 var json = $.parseJSON(JSON.stringify(data))
                                 var Pill_Strength = json.Pill_Strength;
                                 var Pill_Quantity = json.Pill_Quantity;
                                 var Per_pill_cost = json.Per_pill_cost;
                                 var toPay_total = json.toPay_total;
                                 var success_msg = json.success_msg;
                                 if(success_msg=='done'){   
                                 $('.Pill_Strength').html(Pill_Strength);
                                 $('.Pill_Quantity').html(Pill_Quantity);
                                 $('.Per_pill_cost').html(Per_pill_cost);
                                 $('.toPay_total').html(toPay_total);
                                     getCart(); 
                                 }
                             }
    });
 }
 
 function edit_cartProduct(){
     $('#cartProduct_update').modal('hide');
 }
 function addUserAddress(){
     $('#addUserAddress').modal('show');
 }
 function editNewUserAddress(id){
 //alert(id);
 //$('#addNewUserAddress').modal('show');
 
//  var addressID = x;
  var addressID = id;
  $.ajax({
   url: "action.php",
   type: "post",
   data: { btn: "EditUser", addressID: addressID },
   dataType: "json",
   // processData: false,
   success: function (data) {
     var json = $.parseJSON(JSON.stringify(data));
     var fname = json.fname;
     var lname = json.lname;
     var email = json.email;
     var phone = json.phone;
     var address1 = json.address1;
     var address2 = json.address2;
     var country = json.country;
     var state = json.state;
     var city = json.city;
     var pincode = json.pincode;
 
     $("#update_addressID").val(addressID);
     $("#update_fname").val(fname);
     $("#update_lname").val(lname);
     $("#update_email").val(email);
     $("#update_phone").val(phone);
     $("#update_addressline1").val(address1);
     $("#update_addressline2").val(address2);
     $("#update_country").val(country);
     $("#update_state").val(state);
     $("#update_city").val(city);
     $("#update_pincode").val(pincode);
   },
 });
 
 $('#editUserAddress').modal('show');
 }

 function deleteUserAddress(id){
  $.ajax({
   url: "new_action.php",
   type: "post",
   data: { btn: "deleteUserAddress", addressID: id },
   dataType: "html",
   // processData: false,
   success: function (data) {
    if(data=='done'){
      allAddressList_new()
    }
   }
  });
}


 // user logged address show previous

 function allAddressList_new() {
    $.ajax({
      url: "new_action.php",
      type: "post",
      data: { btn: "allAddressList_new" },
      dataType: "html",
      success: function (data) {
      //  alert(data);
        // snackbar('Success');
        // console.log(data);
        if(data==""){
         // alert("blank data")
        }else{
         $(".allAddressList_new").html(data);
        }


        // loadCheckoutDefaultAddress();
        $("input[type=radio][name=addresscheck]").change(function () {
          var id = this.value;
          snackbar("Please Wait Processing...");
          $.ajax({
            url: "action.php",
            type: "post",
            data: { btn: "setDefaultAddress", id: id },
            success: function (data) {
              snackbar("Success");
              loadUserAddressModal();
              allAddressList_new();
            //  loadCheckoutDefaultAddress();
              $("#checkoutAddressList").modal("toggle");
            },
          });
        });

      },
    });
  }
  allAddressList_new();

  function placeOrder_registerUser(){
    var addressId = $("#customer_addressId").val();
    if (addressId > 0) {
      // $(".loader-bg2").css("display", "flex");
      // $('#TermsCondition').modal('toggle');
      // $(".loader-bg1").css("display", "flex");
      

     $(".loader-bg").show();
      $.ajax({
        url: "newaction.php",
        type: "post",
        data: { btn: "orderNow", addressId: addressId },
        dataType: "json",
        success: function (data) {
          $("#TermsCondition").modal("toggle");
          $(".loader-bg").hide();
          $(".loader-bg1").hide();
          var json = $.parseJSON(JSON.stringify(data));
          var invid = json.invid;
          $(".loader-bg2").css("display", "none");
          // $('#OrderConfirm').modal('toggle');
          $("#proceedClick").attr("data-invid", invid);
          // $('.gotoOrders').attr('href',"order/invoice/"+invid)
          // window.location.replace("confirmation");
          // window.location.replace("order/payselect/"+invid);

          $("#proceedClick").attr("data-invid", invid);
          // $('.gotoOrders').attr('href',"payselect/"+invid)
        },
      });
    }else{
      placeOrder_guestUser();
    }

  }

  function placeOrder_guestUser(){
    $("#addNewUserAddress").modal("show");
  }

  //for more Service review 
  function getmoreservice_Reviews(x){
    var id = $(x).attr('data-last_id');
    var increment_val = $(x).attr('data-increment_val');
        if(id){
        $.ajax({
          type: 'post',
          url: 'new_action.php',
          dataType: 'json',
          data: {
            serviceReview_id: id,
            last_increment_val:increment_val,
            btn: 'serviceReview_id',
          },
          beforeSend: function () {
            $('.content').css('opacity', 0.5)
            $('.btn-ring').show()
          },
          success: function (data) {
          
            var json = $.parseJSON(JSON.stringify(data))
            var lastId = json.last_id;
            var htmldata = json.datahtml;
            var last_increment_val = json.last_increment_val;
            var status = json.status;

             if(status=="data"){      
              $('#btn_more_service_review').attr('data-increment_val', last_increment_val)
              $('#btn_more_service_review').attr('data-last_id', lastId)
              $('#more_service_review').append(htmldata)
             }
             if(status=="nodata"){
              snackbar("There is no more reviews");
             }
            $('.content').css('opacity', 1)
            $('.btn-ring').hide()
          },
        })
      }
  }

  // for more Website review
  function getmoreWebsite_Reviews(x){
    var id = $(x).attr('data-website_last_id');
    var increment_val = $(x).attr('data-website_increment_val');
        if(id){
        $.ajax({
          type: 'post',
          url: 'new_action.php',
          dataType: 'json',
          data: {
            websiteReview_id: id,
            last_increment_val:increment_val,
            btn: 'websiteReview_id',
          },
          beforeSend: function () {
            $('.content').css('opacity', 0.5)
            $('.btn-ring').show()
          },
          success: function (data) {
          
            var json = $.parseJSON(JSON.stringify(data))
            var lastId = json.last_id;
            var htmldata = json.datahtml;
            var last_increment_val = json.last_increment_val;
            var status = json.status;

             if(status=="data"){      
              $('#btn_more_website_review').attr('data-website_increment_val', last_increment_val)
              $('#btn_more_website_review').attr('data-website_last_id', lastId)
              $('#more_website_review').append(htmldata)
             }
             if(status=="nodata"){
              snackbar("There is no more reviews");
             }

            $('.content').css('opacity', 1)
            $('.btn-ring').hide()
          },
        })
      }
  }


// for more product review
function getmoreProduct_Reviews(x){
  var id = $(x).attr('data-product_last_id');
    var increment_val = $(x).attr('data-product_increment_val');
        if(id){
        $.ajax({
          type: 'post',
          url: 'new_action.php',
          dataType: 'json',
          data: {
            overallProduct_id: id,
            last_increment_val:increment_val,
            btn: 'overallProduct_id',
          },
          beforeSend: function () {
            $('.content').css('opacity', 0.5)
            $('.btn-ring').show()
          },
          success: function (data) {
          
            var json = $.parseJSON(JSON.stringify(data))
            var lastId = json.last_id;
            var htmldata = json.datahtml;
            var last_increment_val = json.last_increment_val;
            var status = json.status;

             if(status=="data"){      
              $('#btn_more_product_review').attr('data-product_increment_val', last_increment_val)
              $('#btn_more_product_review').attr('data-product_last_id', lastId)
              $('#more_product_review').append(htmldata)
             }
             if(status=="nodata"){
              snackbar("There is no more reviews");
             }

            $('.content').css('opacity', 1)
            $('.btn-ring').hide()
          },
        })
      }
 }


// for more overall review
 function getmoreOverall_Reviews(x){
  var id = $(x).attr('data-overall_last_id');
    var increment_val = $(x).attr('data-increment_overall_val');
        if(id){
        $.ajax({
          type: 'post',
          url: 'new_action.php',
          dataType: 'json',
          data: {
            overallReview_id: id,
            last_increment_val:increment_val,
            btn: 'overallReview_id',
          },
          beforeSend: function () {
            $('.content').css('opacity', 0.5)
            $('.btn-ring').show()
          },
          success: function (data) {
          
            var json = $.parseJSON(JSON.stringify(data))
            var lastId = json.last_id;
            var htmldata = json.datahtml;
            var last_increment_val = json.last_increment_val;
            var status = json.status;

             if(status=="data"){      
              $('#btn_more_overall_review').attr('data-increment_overall_val', last_increment_val)
              $('#btn_more_overall_review').attr('data-overall_last_id', lastId)
              $('#more_overall_review').append(htmldata)
             }
             if(status=="nodata"){
              snackbar("There is no more reviews");
             }

            $('.content').css('opacity', 1)
            $('.btn-ring').hide()
          },
        })
      }
 }

 // product search bar for product review

 $(".product_searchbar").on("keyup", function(e) {
  // do stuff!
  var val = $(this).val();
  //alert(val);
  let length = val.length;
  if(length>2){
    // alert(val)

    $.ajax({
      type: 'post',
      url: 'new_action.php',
      dataType: 'json',
      data: {
        productSearchVal:val,
        btn: 'productSearchbar',
      },
      beforeSend: function () {
        $('.content').css('opacity', 0.5)
        $('.btn-ring').show()
      },
      success: function (data) {
      
        var json = $.parseJSON(JSON.stringify(data))
        var htmldata = json.datahtml;
  

          $('#search_product_reavie').html(htmldata)

          $('.content').css('opacity', 1)
        $('.btn-ring').hide()
      },
    })


  }




});

