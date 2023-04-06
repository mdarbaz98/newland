let website = window.location.origin + "/";
var currentPage = window.location.href;
var currentPage1 = currentPage.replace(website, "");
var currentPage1 = currentPage1.replace(".php", "");
var domainName = window.location.origin;

// alert(currentPage1);
if (currentPage1.includes("confirmation")) {
  var finalInv = $("#finalInvId").val();
  if (finalInv == "Draft") {
    $(window).on("load", function () {
      $("#TermsCondition").modal("show");
    });
  }
}
// alert(currentPage);
$(".searchBoxIcon").css("display", "none");
if (
  currentPage == "https://newlandpharmacy.co.uk/" ||
  currentPage == "https://newlandspharma.com/" ||
  currentPage == "http://localhost/globalph"
) {
    $(".navbar-toggler ").css("padding", "5px 100px 2px 38px");
    if (screen.width < 600) {
      $(".navbar-toggler ").css("padding", "2px 5px 2px 12px");
    $(".desktop-search-box").css("display", "none");
    $(window).scroll(function () {
      if ($(this).scrollTop() > 500) {
        $(".searchBoxIcon").css("display", "flex");
      } else {
        $(".searchBoxIcon").css("display", "none");
      }
    });
  }
} else {
  if (screen.width < 600) {
    $(".searchBoxIcon").css("display", "flex");
  }
  $(".navbar-toggler ").css("padding", "2px 15px 2px 15px")
}
if (screen.width > 450) {
  $(".desktop-search-box").css("display", "none");
  if (
    currentPage == "https://newlandpharmacy.co.uk/" ||
    currentPage == "https://newlandspharma.com/" ||
    currentPage ==
      "https://newlandspharma.com/?data=2&info=discreet-shipping" ||
    currentPage ==
      "https://newlandpharmacy.co.uk/?data=2&info=discreet-shipping"
  ) {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 400) {
        $(".desktop-search-box").css("display", "flex");
      } else {
        $(".desktop-search-box").css("display", "none");
      }
    });
  }
}

$("#display-text").hide();
$(".searchLoader").hide();
$(".newDisplayText").hide();
function onInputClick() {
  if (window.innerWidth > 650) {
    $(".newDisplayText").show();
    $(".currency-header").hide();
    // $('.header-left-section').css('transform','translateY(-119px)');
    $(".search-header-input").css("width", "100%");
    $(".search-header-input").css("border-radius", "64px 108px 0 0");
    // $('.search-button').css('border-radius','0 29px 0');
  } else {
    var state = open_panel_count ? "hide" : "show";
    $("#searchBox").collapse(state);
  }
}
$("#search").on("input", function () {
  var searchData = $("#search").val();
  if (searchData.length > 2) {
    $(".searchLoader").show();
  }
});

function redirect(x) {
  window.open(x, "_blank");
}

function onInputClick1() {
  $("#display-text").show();
}

$(".payment-confirm").on("click", function () {
  $("#payment-confirm").modal("toggle");
  $(".modal-backdrop").css("background-color", "#F2F2F2");
});

$(".nav__dropdown").on("click", function () {
  // $('.nav__dropdown').removeClass('active');
  $(this).toggleClass("active");
});
$(".faq-section .nav").addClass("opennav");
$(".faq-section .nav").hover(
  function () {
    $(this).removeClass("opennav");
    $(this).addClass("active");
  },
  function () {
    $(this).addClass("opennav");
    $(this).removeClass("active");
  }
);

/*==================== LINK ACTIVE ====================*/
const linkColor = document.querySelectorAll(".nav__link");

function colorLink() {
  linkColor.forEach((l) => l.classList.remove("active"));
  this.classList.add("active");
}

linkColor.forEach((l) => l.addEventListener("click", colorLink));

// Footer Swipe to Call

//show only 6 boxes
$(".hide-all-cat").hide();
$(".hide-all-box").hide();
$(".main-container .boxes").eq(4).next().nextAll().hide();
$(".cat-section .category-item").eq(8).next().nextAll().hide();

$(".show-all-box").click(function () {
  $(".main-container .boxes").show();
  $(".hide-all-box").show();
  $(".show-all-box").hide();
});

$(".hide-all-box").click(function () {
  $(".main-container .boxes").eq(4).next().nextAll().hide();
  $(".hide-all-box").hide();
  $(".show-all-box").show();
});

$(".show-all-cat").click(function () {
  $(".cat-section .category-item").show();
  $(".hide-all-cat").show();
  $(".show-all-cat").hide();
});

$(".hide-all-cat").click(function () {
  $(".cat-section .category-item").eq(8).next().nextAll().hide();
  $(".hide-all-cat").hide();
  $(".show-all-cat").show();
});

$(".collapse-section").show();
$(".expand-section").hide();
$(".expand").click(function () {
  $(".expand").show();
  $(".close-btn").hide();
  $(".collapse-section").show();
  $(".expand-section").hide();
  $(".expand").removeClass("activeBox activesecBox activethdBox activefourBox");
  $(this).parent().find(".collapse-section").hide();
  $(this).parent().find(".expand-section").show();
  $(this).hide();
  $(".close-btn").hide();
  $(this).siblings(".close-btn").show();
  $(".expand").parent().removeClass("activeBox activesecBox activethdBox");
  if ($(this).parent().hasClass("1-boxes")) {
    $(this).parent().addClass("activeBox");
  } else if ($(this).parent().hasClass("2-boxes")) {
    $(this).parent().addClass("activesecBox");
  } else if ($(this).parent().hasClass("3-boxes")) {
    $(this).parent().addClass("activethdBox");
  } else {
    $(this).parent().addClass("activefourBox");
  }
  $(".content").css({
    overflow: "hidden",
    height: "90px",
    display: "block",
  });
  $(this).siblings(".content").css({
    overflow: "auto",
    height: "100%",
    display: "block",
  });
});
$(".close-btn").click(function () {
  $(".collapse-section").show();
  $(".expand-section").hide();
  $(".close-btn").hide();
  $(this).parent().find(".collapse-section").show();
  $(this).parent().find(".expand-section").hide();
  $(this).siblings(".expand").show();
  $(this)
    .parent()
    .removeClass("activeBox activesecBox activethdBox activefourBox");
  $(".content").css({
    overflow: "hidden",
    height: "90px",
    display: "block",
  });
});

$(document).mouseup(function (e) {
  var st = 0;
  $("#display-text").click(function () {
    var st = 1;
  });
  if (st == 0) {
    $("#display-text").hide();
  }
  $(".search-header-input").css("width", "74%");
  // $('.header-left-section').css('transform','translateY(0px)');
  $(".search-header-input").css("border-radius", "108px");
  // $('.search-button').css('border-radius','29px');
  // setTimeout(function() {
  //     $('.currency-header').show();
  // }, 3000);
  $(".currency-header").show();
  $(".newDisplayText").hide();
});
$(".btn-outline-accent").on("click", function (e) {
  $("input[id=addressNew]").attr("checked", true);
});
var Lowl = $("#slide-testimonal");
Lowl.owlCarousel({
  margin: 3,
  items: 3,
  center: true,
  controls: false,
  loop: true,
  controls: true,
  nav: true,
  mousedrag: true,
  responsive: {
    0: {
      items: 1,
      stagePadding: 40,
      mousedrag: true,
    },
    768: {
      items: 1,
      margin: 15,
      stagePadding: 40,
      mousedrag: true,
    },
    1000: {
      items: 3,
      mousedrag: true,
    },
  },
});

$(".next").click(function () {
  Lowl.trigger("next.owl.carousel");
});

$(".prev").click(function () {
  Lowl.trigger("prev.owl.carousel", [300]);
});

Lowl.owlCarousel();
// Listen to owl events:
Lowl.on("changed.owl.carousel", function (event) {
  unpin();
  setTimeout(function () {
    pin();
  }, 200);
});

function unpin() {
  $(".img-box").removeClass("pin");
  $(".img-box").removeClass("unpin");
  $(".img-box").addClass("unpin");
}
function pin() {
  $(".img-box").removeClass("unpin");
  $(".img-box").removeClass("pin");
  $(".img-box").addClass("pin");
}

Lowl.trigger("owl.play", false);

$(".pqt-minus").click(function () {
  alert("hello");
});
$(".loader-bg").hide();
$(".loader-bg1").hide();
$(document).ready(function () {
  $(".strength:first()").prop("checked", true);
  if ($(".activeQty").length == 0) {
    //   quantity($("#quantity:first()"));
  } else {
    $(".activeQty:first()").prop("checked", true);
    quantity($(".activeQty:first()"));
  }
});
$(".cartData").hide();
$(".emptyCartData").hide();
function setSession(x, y) {
  $.ajax({
    type: "POST",
    url: "action.php", //url to file
    data: { slider: x, btn: "setSliderSession" },
    success: function (data) {
      window.location.href = y;
    },
  });
}
// if(currentPage=='https://newlandpharmacy.co.uk/' || currentPage=='https://newlandspharma.com/' || currentPage=='http://localhost/globalph/'){
//     document.getElementById("div").addEventListener("mousemove", parallax);
//     function parallax(e) {
//         document.querySelectorAll(".object").forEach(function (move) {
//             var moving_value = move.getAttribute("data-value");
//             var x = (e.clientX * moving_value) / 250;
//             var y = (e.clientY * moving_value) / 250;

//             move.style.transform = "translateX(" + x + "px) translateY(" + y + "px)";
//         });
//     }
// }

// var old = $('.cat-section').html();
// var groups={};
// $('.category-item').each(function(){
// var cls = (this.className);

//     var group = groups[cls];
//     if(!group)
//     {
//         group = $('<div/>').appendTo('.cat-section1');
//         group.addClass('group');

//         groups[cls] = group;
//     }

//     $(this).appendTo(group);
// });
// $('.cat-section').html(old);

// function getInfo(i){
//    alert(i.currentPage + ' of ' + i.allPages);
// }

// $( ".shop-category .tns-nav button" ).css("background", "#0686c9");

// $('.shop-category .tns-nav button').data('nav')+1;

setTimeout(function () {
  $(".shop-category .tns-nav button").each(function () {
    var num = $(this).attr("data-nav");
    $(this).html(parseInt(num) + 1);
  });
}, 1000);

function loadcartwish() {
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "loadatcartwish" },
    success: function (data) {
      $(".wishcartprod").html(data);
    },
  });
}
loadcartwish();
function loadCartData() {
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "loadCartData" },
    success: function (data) {
      loadcartwish();
      if (data > 0) {
        $(".cartData").show();
        $(".emptyCartData").hide();
      } else {
        $(".cartData").hide();
        $(".emptyCartData").show();
      }
    },
  });
}
loadCartData();

function loadCartData1() {
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "loadCartData1" },
    success: function (data) {
      loadcartwish();
      if (data > 0) {
        $(".cartData1").show();
        $(".emptyCartData1").hide();
      } else {
        $(".cartData1").hide();
        $(".emptyCartData1").show();
      }
    },
  });
}
loadCartData1();

function getRecord(x) {
  var code = $(x).data("track-id");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { code: code },
    success: function (data) {
      $("#orderStatusList").modal("toggle");
      $(".trackData").html(data);
    },
  });
}

function editAddress(x) {
  alert(x);
}

function removeFromCart(x) {
  var id = $(x).attr("id");
  var btn = "RemoveFromCartPage";
  snackbar("Removing from cart...");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn, id: id },
    success: function (data) {
      if (data == "done") {
        snackbar("Item removed");
        if (currentPage1.includes("cart")) {
          load_main_cart();
          loadCoupan();
        }
        if (currentPage1.includes("checkout")) {
          load_checkout();
        }
        if (pageName == "ProductPage") {
          loadMainStrength();
        }
        load_cart();
        count_cart();
      }
    },
  });
}

function removeAllCart() {
  var btn = "RemoveAll";
  snackbar("Deleting Cart ...");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      if (data == "done") {
        snackbar("All Item Removed");
        if (currentPage1.includes("cart")) {
          load_main_cart();
          loadCoupan();
        }
        if (currentPage1.includes("checkout")) {
          load_checkout();
        }
        if (pageName == "ProductPage") {
          loadMainStrength();
        }
        load_cart();
        count_cart();
      }
    },
  });
}

function removeWishList(x) {
  var id = $(x).attr("id");
  var btn = "removeWishList";
  snackbar("Removing from Wishlist...");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn, id: id },
    success: function (data) {
      if (data == "done") {
        snackbar("Item removed");
        if (currentPage1.includes("cart")) {
          load_main_cart();
          loadCoupan();
        }
        if (currentPage1.includes("checkout")) {
          load_checkout();
        }
        if (pageName == "ProductPage") {
          loadMainStrength();
        }
        load_cart();
        loadCartData();
        loadCartData1();
        count_cart();
        load_main_wishlist();
      }
    },
  });
}

function removeWishListAll() {
  var btn = "removeWishListAll";
  snackbar("Removing from Wishlist...");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      if (data == "done") {
        snackbar("Item removed");
        if (currentPage1.includes("cart")) {
          load_main_cart();
          loadCoupan();
        }
        if (currentPage1.includes("checkout")) {
          load_checkout();
        }
        if (pageName == "ProductPage") {
          loadMainStrength();
        }
        load_cart();
        count_cart();
        load_main_wishlist();
      }
    },
  });
}

function addToWishlist(x) {
  var id = $(x).attr("id");
  var btn = "AddedToWishlist";
  snackbar("Adding to wishlist...");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn, id: id },
    success: function (data) {
      if (data == "done") {
        snackbar("Added to Wishlist");
        if (currentPage1.includes("cart")) {
          load_main_cart();
          loadCoupan();
        }
        if (currentPage1.includes("checkout")) {
          load_checkout();
        }
        if (pageName == "ProductPage") {
          loadMainStrength();
        }
        load_cart();
        count_cart();
      }
    },
  });
}

function againAddToCart(x) {
  var id = $(x).attr("id");
  var btn = "AddedToCart";
  snackbar("Adding to Cart...");
  $.ajax({
    url: "action.php",
    type: "post",

    data: { btn: btn, id: id },
    success: function (data) {
      if (data == "done") {
        snackbar("Added to Cart");
        load_main_wishlist();
        load_cart();
        count_cart();
        loadCartData();
        loadCartData1();
        load_main_cart();
      }
    },
  });
}

function cartClick(x) {
  // alert('fff');
  // let button = this;
  // button.classList.add('clicked');
  $(x).addClass("button--loading");
  var code = $(x).data("qty-code");
  var userid = $(x).data("user");
  var wish = $(x).data("wishlist");
  var price = $(x).data("total-price");
  var catName = $(x).data("cat-name");
  // alert(price);
  // $('.listQuantity').removeClass('activeQty1');
  // $('.listQuantity[data-quantity-id="'+code+'"]').addClass('activeQty1');
  var btn = "addToCart";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn, code: code, userid: userid, wish: wish },
    success: function (data) {
      if (price >= 250 && catName != "USA TO USA Medication") {
        $(".js-container").show();
        $("#freeShipConfirm").modal("toggle");
        setTimeout(function () {
          $(".js-container").hide();
          $("#freeShipConfirm").modal("toggle");
        }, 4500);
      }
      loadMainStrength();

      count_cart();
      load_cart();
      // $(".activeQty1:first()").prop('checked', true);
      // quantity($(".activeQty1:first()"));
      // cartStatus($(".activeQty1:first()"));
      // load_main_cart();
    },
  });
}
function incdd() {
  var cartButtons = document.querySelectorAll(".cart-button");
  // var card_value = document.querySelector(".added");
  var pqtplus = document.querySelector(".pqt-plus");
  var pqtminus = document.querySelector(".pqt-minus");
  var qty = $(".added").data("value");
  var cartvalue = qty;

  // cartButtons.forEach(button => {
  //     button.addEventListener('click', cartClick);
  // });

  pqtPlus.forEach((button) => {
    pqtplus.addEventListener("click", pqtPlus);
  });

  function cartClick() {
    let button = this;
    button.classList.add("clicked");
    var code = $(".added").data("qty-code");
    var userid = $(".added").data("user");
    var wish = $(x).data("wish");
    $(".listQuantity").removeClass("activeQty1");
    $('.listQuantity[data-quantity-id="' + code + '"]').addClass("activeQty1");
    var btn = "addToCart";
    $.ajax({
      url: "action.php",
      type: "post",
      data: { btn: btn, code: code, userid: userid, wish: wish },
      success: function (data) {
        loadMainStrength();
        count_cart();
        load_cart();
        // $(".activeQty1:first()").prop('checked', true);
        // quantity($(".activeQty1:first()"));
        // cartStatus($(".activeQty1:first()"));
        // load_main_cart();
      },
    });
  }

  function pqtPlus() {
    let pqtplus = this;
    pqtplus.classList.add("clicked");
    if (card_value.nodeValue <= 0) {
      card_value.textContent = cartvalue += 1;
      var code = $(this).data("qty-code");
      var userid = $(this).data("user");
      $(".listQuantity").removeClass("activeQty1");
      $('.listQuantity[data-quantity-id="' + code + '"]').addClass(
        "activeQty1"
      );
      var btn = "addQunatity";
      $.ajax({
        url: "action.php",
        type: "post",
        data: { btn: btn, code: code, userid: userid },
        success: function (data) {
          alert("done");
          loadMainStrength();
        },
      });
    }
  }

  pqtplus.addEventListener("click", function () {
    if (card_value.nodeValue <= 0) {
      card_value.textContent = cartvalue += 1;
      var code = $(".pqt-plus").data("qty-code");
      var userid = $(".pqt-plus").data("user");
      $(".listQuantity").removeClass("activeQty1");
      $('.listQuantity[data-quantity-id="' + code + '"]').addClass(
        "activeQty1"
      );
      var btn = "addQunatity";
      $.ajax({
        url: "action.php",
        type: "post",
        data: { btn: btn, code: code, userid: userid },
        success: function (data) {
          alert("done");
          loadMainStrength();
        },
      });
    }
  });

  pqtminus.addEventListener("click", function () {
    if (Number(card_value.innerText) - 1 >= 0) {
      card_value.textContent = cartvalue -= 1;
      var code = $(".pqt-minus").data("qty-code");
      var userid = $(".pqt-minus").data("user");
      $(".listQuantity").removeClass("activeQty1");
      $('.listQuantity[data-quantity-id="' + code + '"]').addClass(
        "activeQty1"
      );
      var btn = "removeQunatity";
      $.ajax({
        url: "action.php",
        type: "post",
        data: { btn: btn, code: code, userid: userid },
        success: function (data) {
          $(".activeQty1:first()").prop("checked", true);
          quantity($(".activeQty1:first()"));
          cartStatus($(".activeQty1:first()"));
          load_main_cart();
        },
      });
    }
  });
}
function incdd1() {
  var cartButtons = document.querySelectorAll(".cart-button1");
  var card_value = document.querySelector(".added1");
  var pqtplus = document.querySelector(".pqt-plus1");
  var pqtminus = document.querySelector(".pqt-minus1");
  var qty = $(".added1").data("value");
  var cartvalue = qty;

  cartButtons.forEach((button) => {
    button.addEventListener("click", cartClick);
  });
  function cartClick() {
    let button = this;
    button.classList.add("clicked");
    var code = $(".added1").data("qty-code");
    var userid = $(".added1").data("user");
    var wish = $(x).data("wish");
    $(".listQuantity").removeClass("activeQty1");
    $('.listQuantity[data-quantity-id="' + code + '"]').addClass("activeQty1");
    var btn = "addToCart";
    $.ajax({
      url: "action.php",
      type: "post",
      data: { btn: btn, code: code, userid: userid, wish: wish },
      success: function (data) {
        $(".activeQty1:first()").prop("checked", true);
        quantity($(".activeQty1:first()"));
        load_main_cart();
      },
    });
  }

  pqtplus.addEventListener("click", function () {
    if (card_value.nodeValue <= 0) {
      card_value.textContent = cartvalue += 1;
      var code = $(".pqt-plus1").data("qty-code");
      var userid = $(".pqt-plus1").data("user");
      $(".listQuantity").removeClass("activeQty1");
      $('.listQuantity[data-quantity-id="' + code + '"]').addClass(
        "activeQty1"
      );
      var btn = "addQunatity";
      $.ajax({
        url: "action.php",
        type: "post",
        data: { btn: btn, code: code, userid: userid },
        success: function (data) {
          // $('.quantity').html(data);
          // $("#quantity:first()").prop('checked', true);
          $(".activeQty1:first()").prop("checked", true);
          quantity($(".activeQty1:first()"));
          load_main_cart();
          loadMainStrength();
        },
      });
    }
  });

  pqtminus.addEventListener("click", function () {
    if (Number(card_value.innerText) - 1 >= 0) {
      card_value.textContent = cartvalue -= 1;
      var code = $(".pqt-minus1").data("qty-code");
      var userid = $(".pqt-minus1").data("user");
      $(".listQuantity").removeClass("activeQty1");
      $('.listQuantity[data-quantity-id="' + code + '"]').addClass(
        "activeQty1"
      );
      var btn = "removeQunatity";
      $.ajax({
        url: "action.php",
        type: "post",
        data: { btn: btn, code: code, userid: userid },
        success: function (data) {
          $(".activeQty1:first()").prop("checked", true);
          quantity($(".activeQty1:first()"));
          load_main_cart();
          loadMainStrength();
        },
      });
    }
  });
}

function decrement(x) {
  var cartvalue = qty;
  var qty = $(".added").data("value");
  var card_value = document.querySelector(".added");
  if (card_value.nodeValue <= 0) {
    var currentQty = $(".added-" + $(x).data("qty-code")).html();
    $(".added-" + $(x).data("qty-code")).html(parseInt(currentQty) - 1);
    var code = $(x).data("qty-code");
    var userid = $(x).data("user");
    $(".listQuantity").removeClass("activeQty1");
    $('.listQuantity[data-quantity-id="' + code + '"]').addClass("activeQty1");
    var btn = "removeQunatity";
    $(".loader-bg").show();
    $.ajax({
      url: "action.php",
      type: "post",
      data: { btn: btn, code: code, userid: userid },
      success: function (data) {
        $(".activeQty1:first()").prop("checked", true);
        quantity($(".activeQty1:first()"));
        cartStatus($(".activeQty1:first()"));
        load_main_cart();
        setTimeout(function () {
          $(".loader-bg").hide();
        }, 1500);
      },
    });
  }
}
function increment(x) {
  var cartvalue = qty;
  var qty = $(".added").data("value");
  var card_value = document.querySelector(".added");
  if (card_value.nodeValue <= 0) {
    var currentQty = $(".added-" + $(x).data("qty-code")).html();
    $(".added-" + $(x).data("qty-code")).html(parseInt(currentQty) + 1);
    var code = $(x).data("qty-code");
    var userid = $(x).data("user");
    $(".listQuantity").removeClass("activeQty1");
    $('.listQuantity[data-quantity-id="' + code + '"]').addClass("activeQty1");
    var btn = "addQunatity";
    $(".loader-bg").show();
    $.ajax({
      url: "action.php",
      type: "post",
      data: { btn: btn, code: code, userid: userid },
      success: function (data) {
        // $('.quantity').html(data);
        // $("#quantity:first()").prop('checked', true);
        $(".activeQty1:first()").prop("checked", true);
        quantity($(".activeQty1:first()"));
        cartStatus($(".activeQty1:first()"));
        load_main_cart();
        setTimeout(function () {
          $(".loader-bg").hide();
        }, 1500);
      },
    });
  }
}

function strengthDefault() {
  var s = $(".strength").attr("id");
  var type = $(".strength").data("product-type");
  var productName = $(".strength").data("product-name");
  var productImage = $(".strength").data("product-image");
  $.ajax({
    url: "quantity.php",
    type: "post",
    data: {
      strength: s,
      type: type,
      productName: productName,
      productImage: productImage,
    },
    success: function (data) {
      $(".quantity").html(data);
      $("#quantity:first()").prop("checked", true);
    },
  });
}
strengthDefault();

function focusInput() {
  $(".search-mob-bar").focus();
}

$(".desktop-search-box").on("click", function () {
  $("#search").focus();
  onInputClick();
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
});

$(".btn-scroll-top").on("click", function () {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
});

var pageName = $("#productPageName").val();

function loadMainStrength() {
  var productCode = $("#productNewCode").val();
  $.ajax({
    url: "loadMainStrength.php",
    type: "post",
    data: { productCode: productCode },
    success: function (data) {
      $(".listStrength").html(data);
      var swiper = new Swiper(".swiper-container", {
        slidesPerView: "auto",
        freeMode: false,
        slideToClickedSlide: true,
        spaceBetween: 10,
        scrollbar: {
          el: ".swiper-scrollbar",
          draggable: true,
          dragSize: 100,
        },
        mousewheel: true,
      });
    },
  });
}
var pageName = $("#productPageName").val();
if (pageName == "ProductPage") {
  loadMainStrength();
}

function quantity(x) {
  addToCartBtn(x);
  var strength = $(x).data("strength");
  var name = $(x).data("productName");
  var image = $(x).data("productImage");
  var type = $(x).data("productType");
  var quantity = $(x).data("quantity");
  var price = $(x).data("price");
  var quantityCode = $(x).data("quantity-id");
  var total = price * quantity;
  var total_price = total.toPrecision(3);
  count_cart();
  load_cart();
  if (total > 250) {
    var fship = "Free Shipping";
    var dcharge = "";
  } else {
    var fship = "";
    var dcharge = "$25";
    // var total_price = parseInt(total_price) + 25;
  }
  $.ajax({
    url: "load_cart.php",
    type: "post",
    data: {
      quantityCode: quantityCode,
      strength: strength,
      name: name,
      image: image,
      type: type,
      quantity: quantity,
      price: price,
      total: total,
      totalPrice: total_price,
      fship: fship,
      dcharge: dcharge,
    },
    success: function (data) {
      $(".prdt-cart-sticky").show();
      $(".prdt-cart-sticky").html(data);
      incdd();
      load_cart();
    },
  });
}

function cartStatus(x) {
  addToCartBtn(x);
  var strength = $(x).data("strength");
  var name = $(x).data("productName");
  var image = $(x).data("productImage");
  var type = $(x).data("productType");
  var quantity = $(x).data("quantity");
  var price = $(x).data("price");
  var quantityCode = $(x).data("quantity-id");
  var total = price * quantity;
  var total_price = total.toPrecision(3);
  count_cart();
  load_cart();
  if (total > 250) {
    var fship = "Free Shipping";
    var dcharge = "";
  } else {
    var fship = "";
    var dcharge = "$25";
    // var total_price = parseInt(total_price) + 25;
  }
  $.ajax({
    url: "cartStatus.php",
    type: "post",
    data: {
      quantityCode: quantityCode,
      strength: strength,
      name: name,
      image: image,
      type: type,
      quantity: quantity,
      price: price,
      total: total,
      totalPrice: total_price,
      fship: fship,
      dcharge: dcharge,
    },
    success: function (data) {
      $(".cart-update").html(data);
      incdd();
      load_cart();
    },
  });
}

function addToCartBtn(x) {
  var strength = $(x).data("strength");
  var name = $(x).data("productName");
  var image = $(x).data("productImage");
  var type = $(x).data("productType");
  var quantity = $(x).data("quantity");
  var price = $(x).data("price");
  var quantityCode = $(x).data("quantity-id");
  var total = price * quantity;
  var total_price = total.toPrecision(3);
  if (total > 250) {
    var fship = "Free Shipping";
    var dcharge = "";
  } else {
    var fship = "";
    var dcharge = "$25";
    // var total_price = parseInt(total_price) + 25;
  }
  $.ajax({
    url: "load-add-to-cart-btn.php",
    type: "post",
    data: {
      quantityCode: quantityCode,
      strength: strength,
      name: name,
      image: image,
      type: type,
      quantity: quantity,
      price: price,
      total: total,
      totalPrice: total_price,
      fship: fship,
      dcharge: dcharge,
    },
    success: function (data) {
      $(".add-to-cart-btn").html(data);
      incdd1();
    },
  });
}

function strength(x) {
  var s = x.id;
  var type = $(x).data("product-type");
  var productName = $(x).data("product-name");
  var productImage = $(x).data("product-image");
  $.ajax({
    url: "quantity.php",
    type: "post",
    data: {
      strength: s,
      type: type,
      productName: productName,
      productImage: productImage,
    },
    success: function (data) {
      $(".quantity").html(data);
      $("#quantity:first()").prop("checked", true);
    },
  });
}

function load_cart() {
  var btn = "load_cart";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      $(".cart-list-item").html(data);
    },
  });
}
load_cart();

function count_cart() {
  var btn = "count_cart";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      $(".total-item-cart").html(data);
    },
  });
}
count_cart();
function shopAddCart(x) {
  var productCode = $(x).data("product-code");
  var strengthCode = $(x).data("strength-code");
  var strengthName = $(x).data("strength-name");
  var productName = $(x).data("product-name");
  var productImage = $(x).data("product-image");
  var productType = $(x).data("product-type");
  var btn = "load-shop-quantity";
  var classs = ".quantity-for-shop-" + productCode;
  $(".loader-bg").show();
  $.ajax({
    url: "shop-quantity.php",
    type: "post",
    data: {
      strength: strengthCode,
      type: productType,
      productName: productName,
      productImage: productImage,
    },
    success: function (data) {
      // $('.product-quantity-list').html('');
      // $(classs).html(data);
      $("#code").html(productName + " " + strengthName);
      $("#quantity-model").modal("toggle");
      if ($(".activeQty").length == 0) {
        $(".product-modal-quantity").html(data);
        cartStatus($("#quantity:first()"));
        setTimeout(function () {
          $(".loader-bg").hide();
        }, 1000);
      } else {
        $(".activeQty:first()").prop("checked", true);
        $(".product-modal-quantity").html(
          "No Quantity Available For This Strength"
        );
        cartStatus($(".activeQty:first()"));
      }
    },
  });
}

function orderTrack(x) {
  $("#orderTrack").modal("toggle");
  var orderid = $(x).data("oid");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { orderid: orderid, btn: "getTrackRecord" },
    success: function (data) {
      $(".track-data").html(data);
    },
  });
}

// $('#trackOrder').on('click', function(){
//     $('#orderTrack').modal('toggle');
// })

function load_main_cart() {
  var btn = "load-main-cart-product";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      load_payment_amount();
      $(".cart-main-product").html(data);
      loadCartData();
      loadCartData1();
      incdd();
    },
  });
}

function load_main_wishlist() {
  var btn = "load-wishlist-product";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      load_payment_amount();
      $(".cart-main-product9").html(data);
      incdd();
    },
  });
}

if (currentPage1.includes("wishlist")) {
  load_main_wishlist();
}

function loadCoupan() {
  var btn = "coupanLoad";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      $("#promo").html(data);
    },
  });
}

// function insertCoupon(x) {
//     var code = $(x).val();
//     $('#coupanCodeInput').val(code);
//     var btn = 'addCoupan';
//     var code = $('#coupanCodeInput').val();
//     $.ajax({
//         url: 'action.php',
//         type: 'post',
//         data: {'code':code, 'btn':btn},
//         success: function(data) {
//             loadCoupan();
//             $('.confirm-lot').show();
//             load_payment_amount();
//             setTimeout(function(){
//                 $('.confirm-lot').hide();
//             }, 6000);
//         }
//     })
// }

function insertCoupon1(x) {
  var existcoupon = $(".couponInput").val();
  $(".couponError").hide();
  if (existcoupon.length > 1) {
    var code = $(".couponInput").val();
    var btn = "addCoupan";
  } else {
    var code = x;
    $(".couponInput").val(code);
    var code = $(".couponInput").val();
    var btn = "addCoupan";
  }

  $.ajax({
    url: "action.php",
    type: "post",
    data: { code: code, btn: btn },
    success: function (data) {
      // alert(data.length);
      if (data == "Not Found") {
        $(".couponError").html(
          "Promotions cannot be applied using your current device"
        );
        $(".couponError").show();
      } else if (data == "invalid-item") {
        $(".couponError").html("No item in your cart eligible for this coupon");
        $(".couponError").show();
      } else if (data == "not-valid-for-account") {
        $(".couponError").html(
          "Promotions you applied not valid for your account"
        );
        $(".couponError").show();
      } else {
        loadCoupan();
        $(".confirm-lot").show();
        load_payment_amount();
        $("#couponLoad").modal("toggle");
        setTimeout(function () {
          $(".confirm-lot").hide();
        }, 6000);
      }
    },
  });
}

function insertCoupon(x) {
  $(".couponInput").val(x);
  var existcoupon = $(".couponInput").val();
  $(".couponError").hide();
  if (existcoupon.length > 1) {
    var code = $(".couponInput").val();
    var btn = "addCoupan";
  } else {
    var code = x;
    $(".couponInput").val(code);
    var code = $(".couponInput").val();
    var btn = "addCoupan";
  }

  $.ajax({
    url: "action.php",
    type: "post",
    data: { code: code, btn: btn },
    success: function (data) {
      // alert(data.length);
      if (data == "Not Found") {
        $(".couponError").html(
          "Promotions cannot be applied using your current device"
        );
        $(".couponError").show();
      } else if (data == "invalid-item") {
        $(".couponError").html("No item in your cart eligible for this coupon");
        $(".couponError").show();
      } else if (data == "not-valid-for-account") {
        $(".couponError").html(
          "Promotions you applied not valid for your account"
        );
        $(".couponError").show();
      } else {
        loadCoupan();
        $(".confirm-lot").show();
        load_payment_amount();
        $("#couponLoad").modal("toggle");
        setTimeout(function () {
          $(".confirm-lot").hide();
        }, 6000);
      }
    },
  });
}

function removeCoupan() {
  var btn = "removeCoupon";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      loadCoupan();
      load_payment_amount();
    },
  });
}

if (currentPage1.includes("cart")) {
  load_main_cart();
  loadCoupan();
}
loadCoupan();

function load_checkout() {
  var btn = "load-checkout-product";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      load_checkout_amount();
      $(".checkout-main-cart").html(data);
      incdd();
    },
  });
}
if (currentPage1.includes("checkout")) {
  load_checkout();
}

function load_payment_amount() {
  var btn = "load-payment-amount";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      $(".total-cart-details").html(data);
    },
  });
}

function load_checkout_amount() {
  var btn = "load-checkout-amount";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: btn },
    success: function (data) {
      $(".total-amout-to-pay").html(data);
    },
  });
}
function movetoNext(current, nextFieldID) {
  if (current.value.length >= current.maxLength) {
    document.getElementById(nextFieldID).focus();
  }
}
$(".ferror").hide();
$(".lError").hide();
$(".passError").hide();
$(".eError").hide();
$(".emailpError").hide();
$(".pError").hide();

$("#signup-tab").submit(function (event) {
  event.preventDefault();
  $(".fError").hide();
  $(".lError").hide();
  $(".form-control").removeClass("errorInput");
  $(".passError").hide();
  $(".eError").hide();
  $(".emailpError").hide();
  $(".pError").hide();
  var codepin = $(
    "#signup-tab .iti__selected-flag .iti__selected-dial-code"
  ).html();
  var formData = new FormData(this);
  formData.append("codepin", codepin);
  formData.append("url", window.location.href);
  $.ajax({
    url: "action.php",
    type: "post",
    data: formData,
    contentType: false,
    cache: false,
    dataType: "json",
    processData: false,
    success: function (data) {
      var json = $.parseJSON(JSON.stringify(data));
      var result = json.url;
      if (result == "Fempty") {
        $(".fError").show();
        $(".fError").html("First Name Required");
        $("#fname").addClass("errorInput");
        $("#fname").focus();
      } else if (result == "Lempty") {
        $(".lError").show();
        $(".lError").html("Last Name Required");
        $("#lname").addClass("errorInput");
        $("#lname").focus();
      } else if (result == "Eempty") {
        $(".eError").show();
        $(".eError").html("Email Required");
        $("#email").addClass("errorInput");
        $("#email").focus();
      } else if (result == "Pempty") {
        $(".passError").show();
        $(".passError").html("Password Required");
        $("#password").addClass("errorInput");
        $("#password").focus();
      } else if (result == "Phempty") {
        $(".pError").show();
        $(".pError").html("Phone Required");
        $("#phone").addClass("errorInput");
        $("#phone").focus();
      } else if (result == "Cempty") {
        $(".pError").show();
        $(".pError").html("Please Select Country Code");
        $("#phone").addClass("errorInput");
        $("#phone").focus();
      } else if (result == "Already Exist") {
        $(".eError").show();
        $(".eError").html("Already Exist! Please check mail for direct login");
        $("#email").addClass("errorInput");
        $("#email").focus();
      } else {
        window.location.replace(result);
      }
    },
  });
});

$("#signup-tab1").submit(function (event) {
  event.preventDefault();
  $(".fError").hide();
  $(".lError").hide();
  $(".form-control").removeClass("errorInput");
  $(".passError").hide();
  $(".eError").hide();
  $(".emailpError").hide();
  $(".pError").hide();
  var codepin = $(
    "#signup-tab1 .iti__selected-flag .iti__selected-dial-code"
  ).html();
  var formData = new FormData(this);
  formData.append("codepin", codepin);
  formData.append("url", window.location.href);
  $.ajax({
    url: "action.php",
    type: "post",
    data: formData,
    contentType: false,
    cache: false,
    dataType: "json",
    processData: false,
    success: function (data) {
      var json = $.parseJSON(JSON.stringify(data));
      var result = json.url;
      if (result == "Fempty") {
        $(".fError").show();
        $(".fError").html("First Name Required");
        $("#fname").addClass("errorInput");
        $("#fname").focus();
      } else if (result == "Lempty") {
        $(".lError").show();
        $(".lError").html("Last Name Required");
        $("#lname").addClass("errorInput");
        $("#lname").focus();
      } else if (result == "Eempty") {
        $(".eError").show();
        $(".eError").html("Email Required");
        $("#email").addClass("errorInput");
        $("#email").focus();
      } else if (result == "Pempty") {
        $(".passError").show();
        $(".passError").html("Password Required");
        $("#password").addClass("errorInput");
        $("#password").focus();
      } else if (result == "Phempty") {
        $(".pError").show();
        $(".pError").html("Phone Required");
        $("#phone").addClass("errorInput");
        $("#phone").focus();
      } else if (result == "Cempty") {
        $(".pError").show();
        $(".pError").html("Please Select Country Code");
        $("#phone").addClass("errorInput");
        $("#phone").focus();
      } else if (result == "Already Exist") {
        $(".eError").show();
        $(".eError").html("Already Exist! Please check mail for direct login");
        $("#email").addClass("errorInput");
        $("#email").focus();
      } else {
        window.location.replace(result);
      }
    },
  });
});

$(".cardOTP").hide();
$(".otp-login").on("click", function () {
  $("#si-email").removeClass("errorInput");
  $(".emailError").hide();
  $(".otp-login").html("Sending OTP");
  $(".otp-login").addClass("loading-otp");
  $(".otpError").hide();
  var validRegex =
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  var email = $("#si-email").val();
  if (email.match(validRegex)) {
    $.ajax({
      url: "action.php",
      type: "post",
      data: { email: email, btn: "sendOTP" },
      success: function (data) {
        if (data == "Not Found") {
          $(".otp-login").html("Login with OTP");
          $(".otp-login").removeClass("loading-otp");
          $(".emailError").show();
          $(".emailError").html("Account Not Found!");
          $("#si-email").addClass("errorInput");
        } else {
          $(".otp-login").html("Login with OTP");
          $(".otp-login").removeClass("loading-otp");
          $(".cardOTP").show();
          $(".password-section").hide();
          $("#si-password").val("");
        }
      },
    });
  } else {
    $("#si-email").addClass("errorInput");
    $(".emailError").show();
    $(".emailError").html("Please Enter Valid Email");
    $(".otp-login").html("Login with OTP");
    $(".otp-login").removeClass("loading-otp");
  }
});
$(".password-login").on("click", function () {
  $(".cardOTP").hide();
  $(".password-section").show();
});

$(".cardOTP1").hide();
$(".otp-login1").on("click", function () {
  $("#si-email").removeClass("errorInput");
  $(".emailError").hide();
  $(".otpError").hide();
  var validRegex =
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  var email = $("#si-email").val();
  if (email.match(validRegex)) {
    $.ajax({
      url: "action.php",
      type: "post",
      data: { email: email, btn: "sendOTP" },
      success: function (data) {
        if (data == "Not Found") {
          $(".emailError").show();
          $(".emailError").html("Account Not Found!");
          $("#si-email").addClass("errorInput");
        } else {
          $(".cardOTP1").show();
          $(".password-section1").hide();
          $("#si-password").val("");
        }
      },
    });
  } else {
    $("#si-email").addClass("errorInput");
    $(".emailError").show();
    $(".emailError").html("Please Enter Valid Email");
  }
});

$(".password-login1").on("click", function () {
  $(".cardOTP1").hide();
  $(".password-section1").show();
});

$(".password-login").on("click", function () {
  $(".cardOTP").hide();
  $(".password-section").show();
});

$("#signin-tab").submit(function (event) {
  $(".otpError").hide();
  event.preventDefault();
  var otp =
    $("#otp1").val() + $("#otp2").val() + $("#otp3").val() + $("#otp4").val();
  if (otp.length == 0) {
    $("#si-email").removeClass("errorInput");
    $("#si-password").removeClass("errorInput");
    $(".emailError").hide();
    $(".passwordError").hide();
    $("#signinbtn").addClass("button--loading");
    var codepin = $(
      "#signin-tab .iti__selected-flag .iti__selected-dial-code"
    ).html();
    var formData = new FormData(this);
    formData.append("codepin", codepin);
    formData.append("otp", otp);
    formData.append("url", window.location.href);
    $.ajax({
      url: "action.php",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      dataType: "json",
      processData: false,
      success: function (data) {
        $("#signinbtn").removeClass("button--loading");
        var json = $.parseJSON(JSON.stringify(data));
        var result = json.url;

        if (result == "Eempty") {
          $("#si-email").addClass("errorInput");
          $(".emailError").show();
          $(".emailError").html("Please Enter Valid Email");
        } else if (result == "Pempty") {
          $("#si-password").addClass("errorInput");
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Pempty") {
          $("#si-password").addClass("errorInput");
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Wrong Password") {
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Oempty") {
          $(".otpError").show();
          $(".otpError").html("Enter Valid OTP");
        } else if (result == "Not Found") {
          $(".uniError").show();
          $(".uniError").html("Account Not Found!");
          $("#si-email").addClass("errorInput");
        } else {
          window.location.replace(result);
        }
      },
    });
  }
  if (otp.length == 4) {
    $("#si-email").removeClass("errorInput");
    $("#si-password").removeClass("errorInput");
    $(".emailError").hide();
    $(".passwordError").hide();
    $("#signinbtn").addClass("button--loading");
    var codepin = $(
      "#signin-tab .iti__selected-flag .iti__selected-dial-code"
    ).html();
    var formData = new FormData(this);
    formData.append("codepin", codepin);
    formData.append("otp", otp);
    formData.append("url", window.location.href);
    $.ajax({
      url: "action.php",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      dataType: "json",
      processData: false,
      success: function (data) {
        $("#signinbtn").removeClass("button--loading");
        var json = $.parseJSON(JSON.stringify(data));
        var result = json.url;

        if (result == "Eempty") {
          $("#si-email").addClass("errorInput");
          $(".emailError").show();
          $(".emailError").html("Please Enter Valid Email");
        } else if (result == "Pempty") {
          $("#si-password").addClass("errorInput");
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Wrong OTP") {
          $(".otpError").show();
          $(".otpError").html("Enter Valid OTP");
        } else if (result == "Oempty") {
          $(".otpError").show();
          $(".otpError").html("Enter Valid OTP");
        } else if (result == "Not Found") {
          $(".uniError").show();
          $(".uniError").html("Account Not Found!");
          $("#si-email").addClass("errorInput");
        } else {
          window.location.replace(result);
        }
      },
    });
  } else {
    $(".otpError").show();
    $(".otpError").html("Enter Valid OTP");
  }
});

$("#signin-tab1").submit(function (event) {
  $(".otpError").hide();
  event.preventDefault();
  var otp =
    $("#otp1").val() + $("#otp2").val() + $("#otp3").val() + $("#otp4").val();
  if (otp.length == 0) {
    $("#si-email").removeClass("errorInput");
    $("#si-password").removeClass("errorInput");
    $(".emailError").hide();
    $(".passwordError").hide();
    $("#signinbtn").addClass("button--loading");
    var codepin = $(
      "#signin-tab1 .iti__selected-flag .iti__selected-dial-code"
    ).html();
    var formData = new FormData(this);
    formData.append("codepin", codepin);
    formData.append("otp", otp);
    formData.append("url", window.location.href);
    $.ajax({
      url: "action.php",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      dataType: "json",
      processData: false,
      success: function (data) {
        $("#signinbtn").removeClass("button--loading");
        var json = $.parseJSON(JSON.stringify(data));
        var result = json.url;

        if (result == "Eempty") {
          $("#si-email").addClass("errorInput");
          $(".emailError").show();
          $(".emailError").html("Please Enter Valid Email");
        } else if (result == "Pempty") {
          $("#si-password").addClass("errorInput");
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Pempty") {
          $("#si-password").addClass("errorInput");
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Wrong Password") {
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Oempty") {
          $(".otpError").show();
          $(".otpError").html("Enter Valid OTP");
        } else if (result == "Not Found") {
          $(".uniError").show();
          $(".uniError").html("Account Not Found!");
          $("#si-email").addClass("errorInput");
        } else {
          window.location.replace(result);
        }
      },
    });
  }
  if (otp.length == 4) {
    $("#si-email").removeClass("errorInput");
    $("#si-password").removeClass("errorInput");
    $(".emailError").hide();
    $(".passwordError").hide();
    $("#signinbtn").addClass("button--loading");
    var codepin = $(
      "#signin-tab1 .iti__selected-flag .iti__selected-dial-code"
    ).html();
    var formData = new FormData(this);
    formData.append("codepin", codepin);
    formData.append("otp", otp);
    formData.append("url", window.location.href);
    $.ajax({
      url: "action.php",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      dataType: "json",
      processData: false,
      success: function (data) {
        $("#signinbtn").removeClass("button--loading");
        var json = $.parseJSON(JSON.stringify(data));
        var result = json.url;

        if (result == "Eempty") {
          $("#si-email").addClass("errorInput");
          $(".emailError").show();
          $(".emailError").html("Please Enter Valid Email");
        } else if (result == "Pempty") {
          $("#si-password").addClass("errorInput");
          $(".passwordError").show();
          $(".passwordError").html("Please Enter Valid Password");
        } else if (result == "Wrong OTP") {
          $(".otpError").show();
          $(".otpError").html("Enter Valid OTP");
        } else if (result == "Oempty") {
          $(".otpError").show();
          $(".otpError").html("Enter Valid OTP");
        } else if (result == "Not Found") {
          $(".uniError").show();
          $(".uniError").html("Account Not Found!");
          $("#si-email").addClass("errorInput");
        } else {
          window.location.replace(result);
        }
      },
    });
  } else {
    $(".otpError").show();
    $(".otpError").html("Enter Valid OTP");
  }
});

// function terms(){
//     $('#TermsCondition').modal('toggle');
//     $('#TermsCondition2').modal('toggle');
// }

$("#checkoutForm").submit(function (event) {
  event.preventDefault();  
  var addressIdFetch = $("#addressId").val();
  var fname = $("#fnames").val();
  if (fname.length > 0) {
    var codePin = $(
      "#checkoutForm .iti__selected-flag .iti__selected-dial-code"
    ).html();
    var formData = new FormData(this);
    formData.append("codepin", codePin);
    $(".address-error").hide();
    $(".country-error").hide();
    $(".state-error").hide();
    $(".city-error").hide();
    $(".code-error").hide();
    var address = $("#address").val();
    var country = $("#country").val();
    var state = $("#state").val();
    var city = $("#city").val();
    var code = $("#code").val();
    $(".loader-bg").show();
    if (address.length > 0) {
      if (country.length > 0) {
        if (state.length > 0) {
          if (city.length > 0) {
            if (code.length > 0) {
              $(".loader-bg1").show();
              $.ajax({
                url: "newaction.php",
                type: "post",
                data: formData,
                contentType: false,
                cache: false,
                dataType: "json",
                processData: false,
                success: function (data) {
                  $(".loader-bg1").hide();
                  var json = $.parseJSON(JSON.stringify(data));
                  var invid = json.invid;
                },
              });
            } else {
              $(".code-error").show();
              $(".code-error").html("Please Enter Valid Zip Code");
            }
          } else {
            $(".city-error").show();
            $(".city-error").html("Please Select City");
          }
        } else {
          $(".state-error").show();
          $(".state-error").html("Please Select State");
        }
      } else {
        $(".country-error").show();
        $(".country-error").html("Please Select Country");
      }
    } else {
      $(".address-error").show();
      $(".address-error").html("Please Enter Valid Address");
    }
  } else {
    if (addressIdFetch > 0) {
      // $(".loader-bg2").css("display", "flex");
      // $('#TermsCondition').modal('toggle');
      // $(".loader-bg1").css("display", "flex");
      $(".loader-bg").show();
      $.ajax({
        url: "newaction.php",
        type: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        dataType: "json",
        processData: false,
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
    } else {
      $("#addNewUserAddress").modal("toggle");
    }
  }
});

function pendOrder(x) {
  var invid = $(x).data("invid");
  // $("#TermsCondition2").modal('toggle');
  $("#TermsCondition").modal("toggle");
  $(".loader-bg2").css("display", "flex");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { invid: invid, btn: "UpdateOrder" },
    success: function (data) {
      $(".loader-bg1").hide();
      $(".loader-bg2").css("display", "none");
      // $('#OrderConfirm').modal('toggle');
      $("#proceedClick").attr("data-invid", invid);
      // $('.gotoOrders').attr('href',"confirmation")
      window.location.replace("payselect/" + invid);
    },
  });
}

$(".orderConfirm").attr("disabled", true);
$(".step2").hide();
$(".fname-error").hide();
$(".lname-error").hide();
$(".email-error").hide();
$(".phone-error").hide();
$(".shipping").hide();
$(".adress-error").hide();
$(".country-error").hide();
$(".state-error").hide();
$(".city-error").hide();
$(".code-error").hide();
$(".ship-details").click(function (e) {
  $(".fname-error").hide();
  $(".lname-error").hide();
  $(".email-error").hide();
  $(".phone-error").hide();
  var fname = $("#fnames").val();
  var lname = $("#lnames").val();
  var email = $("#emails").val();
  var phone = $("#phones").val();
  if (fname.length > 0) {
    if (lname.length > 0) {
      if (email.length > 0) {
        if (phone.length) {
          $(".socialLogin").hide();
          $("steps2").removeClass("current");
          $(".steps3").addClass("active");
          $(".steps3").addClass("current");
          $(".billing").hide();
          $(".shipping").show();
          $(".step2").show();
          $(".step1").hide();
        } else {
          $(".phone-error").show();
          $(".phone-error").html("Please Enter Valid Phone");
        }
      } else {
        $(".email-error").show();
        $(".email-error").html("Please Enter Valid Email");
      }
    } else {
      $(".lname-error").show();
      $(".lname-error").html("Last Name Required");
    }
  } else {
    $(".fname-error").show();
    $(".fname-error").html("First Name Required");
  }

  // $('.step1').hide();
  // $('.step2').show()
});
// $('.addressFill').hide();
$(".showAddressFil").on("click", function () {
  $(".addressFill").show();
  $(".customerAddress").hide();
  $(".addressIdFetch").prop("checked", false);
});
$(".showSaveAddress").on("click", function () {
  $(".customerAddress").show();
  $(".addressFill").hide();
});

$("#country").on("change", function () {
  var countryID = $(this).val();
  if (countryID) {
    $.ajax({
      type: "POST",
      url: "action.php",
      data: "country_id=" + countryID,
      success: function (html) {
        $("#state").html(html);
        $("#city").html('<option value="">Select state first</option>');
      },
    });
  } else {
    $("#state").html('<option value="">Select Country first</option>');
    $("#city").html('<option value="">Select state first</option>');
  }
});

$("#state").on("change", function () {
  var stateID = $(this).val();
  if (stateID) {
    $.ajax({
      type: "POST",
      url: "action.php",
      data: "state_id=" + stateID,
      success: function (html) {
        $("#city").html(html);
      },
    });
  } else {
    $("#city").html('<option value="">Select state first</option>');
  }
});

$("#updateCustomerForm").submit(function (event) {
  event.preventDefault();
  $.ajax({
    url: "action.php",
    type: "post",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      if (data == "Done") {
        location.reload();
      } else {
        alert(data);
      }
    },
  });
});

function reorder(x) {
  $(x).addClass("button--loading");
  var oid = $(x).data("oid");
  var btn = "reorder";
  $.ajax({
    url: "action.php",
    type: "post",
    data: { oid: oid, btn: btn },
    success: function (data) {
      $(x).removeClass("button--loading");
      window.location.replace("cart");
    },
  });
}

function editUserAddress(x) {
  var addressID = x;
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
      $("#update_phone").val(phone);
      $("#update_addressline1").val(address1);
      $("#update_addressline2").val(address2);
      $("#update_country").val(country);
      $("#update_state").val(state);
      $("#update_city").val(city);
      $("#update_pincode").val(pincode);
    },
  });
}

$("#editAddressBox").submit(function (event) {
  event.preventDefault();
  $.ajax({
    url: "action.php",
    type: "post",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      $("#editUserAddress").modal("toggle");
      snackbar("Address Update Successfull");
      loadAccountAddress();
      allAddressList_new()
    },
  });
});

$("#addAddressBox").submit(function (event) {
  event.preventDefault();
  $("input").css({ border: "1px solid #e3e9ef" });
  $("#addAddressBox .iti").css({ border: "1px solid #e3e9ef" });

  var error = false;

  event.preventDefault();

  const phone = document.querySelector("#addAddressBox .phone");
  if ($("#addAddressBox input[name=fname]").val().length < 1) {
    $("#addAddressBox input[name=fname]").css({ border: "1px solid red" });
    var error = true;
  }

  if ($("#addAddressBox input[name=lname]").val().length < 1) {
    $("#addAddressBox input[name=lname]").css({ border: "1px solid red" });
    var error = true;
  }

  if ($("#addAddressBox input[name=addressline1]").val().length < 1) {
    $("#addAddressBox input[name=addressline1]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if ($("#addAddressBox input[name=pincode]").val().length < 1) {
    $("#addAddressBox input[name=pincode]").css({ border: "1px solid red" });
    var error = true;
  }

  if ($("#addAddressBox input[name=city]").val().length < 1) {
    $("#addAddressBox input[name=city]").css({ border: "1px solid red" });
    var error = true;
  }

  if ($("#addAddressBox input[name=state]").val().length < 1) {
    $("#addAddressBox input[name=state]").css({ border: "1px solid red" });
    var error = true;
  }

  if ($("#addAddressBox input[name=country]").val().length < 1) {
    $("#addAddressBox input[name=country]").css({ border: "1px solid red" });
    var error = true;
  }

  if (!phone.classList.contains("success-input")) {
    $("#addAddressBox .iti").css({ border: "1px solid red" });
    var error = true;
  }

  if (!error) {
    var codepin = $(
      "#addAddressBox .iti__selected-flag .iti__selected-dial-code"
    ).html();
    var formData = new FormData(this);
    formData.append("codepin", codepin);
    $.ajax({
      url: "action.php",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data == "done") {
          $("#addUserAddress").modal("toggle");
          $("#checkoutAddressList").modal("toggle");
          $("#addAddressBox").trigger("reset");
          snackbar("Address Add Successfull");
          allAddressList();
          loadAccountAddress();
          loadCheckoutDefaultAddress();
          allAddressList_new();
        } else {
          $("input[name=" + data + "]").css({ border: "1px solid red" });
          alert("All Field Required");
        }
      },
    });
  }
});

function deleteUserAddress(x) {
  var addressID = x;
  snackbar("Please Wait Processing...");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "deleteUserAddress", addressID: addressID },
    // processData: false,
    success: function (data) {
      snackbar("Delete Successfull");
      loadAccountAddress();
    },
  });
}

function loadAccountAddress() {
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "loadAccountAddress" },
    success: function (data) {
      $(".addressUSers").html(data);
    },
  });
}

loadAccountAddress();

function snackbar(msg) {
  var x = document.getElementById("snackbar");
  x.className = "show";
  x.innerHTML = msg;
  setTimeout(function () {
    x.className = x.className.replace("show", "");
  }, 3000);
}

function loadCheckoutDefaultAddress() {
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "loadCheckoutDefaultAddress" },
    success: function (data) {
      $(".customerAddress").html(data);
    },
  });
}

function setDefaultAddress(id) {
  snackbar("Please Wait Processing...");
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "setDefaultAddress", id: id },
    success: function (data) {
      snackbar("Success");
      loadAccountAddress();
    },
  });
}

function loadUserAddressModal() {
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "loadUserAddressModal" },
    success: function (data) {
      // snackbar('Success');
      $(".loadUserAddressModal").html(data);
      loadCheckoutDefaultAddress();
    },
  });
}

function allAddressList() {
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "allAddressList" },
    success: function (data) {
      // snackbar('Success');
      $(".allAddressList").html(data);
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
            loadCheckoutDefaultAddress();
            $("#checkoutAddressList").modal("toggle");
          },
        });
      });
    },
  });
}
allAddressList();
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
      loadCheckoutDefaultAddress();
      $("#checkoutAddressList").modal("toggle");
    },
  });
});

$("#addNewUserAddressBox").submit(function (event) {
//  alert("this is new user")
  $("input").css({ border: "1px solid #e3e9ef" });
  $("#addNewUserAddressBox .iti").css({ border: "1px solid #e3e9ef" });

  var error = false;

  event.preventDefault();

  const email = document.querySelector(".email");
  const phone = document.querySelector(".phone");
  if ($("#addNewUserAddressBox input[name=fname]").val().length < 1) {
    $("#addNewUserAddressBox input[name=fname]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if ($("#addNewUserAddressBox input[name=lname]").val().length < 1) {
    $("#addNewUserAddressBox input[name=lname]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if ($("#addNewUserAddressBox input[name=addressline1]").val().length < 1) {
    $("#addNewUserAddressBox input[name=addressline1]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if ($("#addNewUserAddressBox input[name=pincode]").val().length < 1) {
    $("#addNewUserAddressBox input[name=pincode]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if ($("#addNewUserAddressBox input[name=city]").val().length < 1) {
    $("#addNewUserAddressBox input[name=city]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if ($("#addNewUserAddressBox input[name=state]").val().length < 1) {
    $("#addNewUserAddressBox input[name=state]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if ($("#addNewUserAddressBox input[name=country]").val().length < 1) {
    $("#addNewUserAddressBox input[name=country]").css({
      border: "1px solid red",
    });
    var error = true;
  }

  if (!email.classList.contains("success-input")) {
    $(".email input[name=email]").css({ border: "1px solid red" });
    var error = true;
  }
  if (!phone.classList.contains("success-input")) {
    $("#addNewUserAddressBox .iti").css({ border: "1px solid red" });
    var error = true;
  }

  if (!error) {
    var codepin = $(
      "#addNewUserAddressBox .iti__selected-flag .iti__selected-dial-code"
    ).html();
    var formData = new FormData(this);
    formData.append("codepin", codepin);
    $.ajax({
      url: "action.php",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data == "done") {
          loadCheckoutDefaultAddress();
          $("#addNewUserAddress").modal("toggle");
        } else {
          $("input[name=" + data + "]").css({ border: "1px solid red" });
          alert("All Field Required");
        }
      },
    });
  }
});

$(".med-success-msg").hide();
$("#med-enq-forms").on("submit", function (e) {
  e.preventDefault();
  $(".labelError").hide();
  $(".labelError").html("");
  var codepin = $(
    " #med-enq-forms .iti__selected-flag .iti__selected-dial-code"
  ).html();
  var formData = new FormData(this);
  formData.append("codepin", codepin);
  $.ajax({
    url: "action.php",
    type: "post",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      if (data == "fError") {
        $(".labelError").show();
        $(".fError").html("Invalid!! First Name");
      }
      if (data == "lError") {
        $(".labelError").show();
        $(".lError").html("Invalid!! Last Name");
      }
      if (data == "eError") {
        $(".labelError").show();
        $(".eError").html("Invalid!! Email");
      }
      if (data == "pError") {
        $(".labelError").show();
        $(".pError").html("Invalid!! Phone");
      }
      if (data == "nError") {
        $(".labelError").show();
        $(".nError").html("Invalid!! Note");
      }
      if (data == "done") {
        $(".med-success-msg").show();
        $("#fname").val("");
        $("#lname").val("");
        $("#email").val("");
        $("#phone").val("");
        $("#note").val("");
      }
    },
  });
});

if ($(".cbx:checked").length == $(".cbx").length) {
  $("#proceedClick").prop("disabled", false);
} else {
  $("#proceedClick").prop("disabled", true);
}

$(".cbx").change(function () {
  if ($(".cbx:checked").length == $(".cbx").length) {
    $("#proceedClick").prop("disabled", false);
  } else {
    $("#proceedClick").prop("disabled", true);
  }
});

if (currentPage1.includes("checkout")) {
  loadCheckoutDefaultAddress();
  loadUserAddressModal();
}
// $('#placeOrder').attr('type', 'button');

// $('#placeOrder[type=button]').click(function() {
//     $('.conditionCheck').css("color",'red');
// });
// if ($('.cbx:checked').length == $('.cbx').length) {
//     $('#placeOrder').attr('type', 'submit');
//     $('.conditionCheck').css("color",'black');
// }
// else{
//     $('#placeOrder').attr('type', 'button');
// }
// $('.cbx').change(function () {
//    if ($('.cbx:checked').length == $('.cbx').length) {
//         $('#placeOrder').attr('type', 'submit');
//         $('.conditionCheck').css("color",'black');
//    }
//    else{
//     $('#placeOrder').attr('type', 'button');
//    }
//  })

$(".fa-solid fa-magnifying-glass").click(function () {
  $("body").css("overflow", "hidden");
});

/* when modal is closed */
document.querySelector(".fa-arrow-left").addEventListener("click", function () {
  document.querySelector("body").style.overflow = "visible";
});

var fixed = document.getElementById("accountBox");

fixed.addEventListener(
  "touchmove",
  function (e) {
    e.preventDefault();
  },
  false
);

$(".productAccord p").each(function () {
  var $this = $(this);
  if ($this.html().replace(/\s|&nbsp;/g, "").length == 0) $this.remove();
});

function loadCats() {
  $(".cat-bg").show();
  var datas = $(".showcat").html();
  if (datas.length < 5) {
    $.ajax({
      url: "action.php",
      type: "post",
      data: { btn: "showcat" },
      success: function (data) {
        $(".cat-bg").hide();
        $(".showcat").html(data);

        function iRunOtherFunctions() {
          for (
            var t = document.querySelectorAll(".widget-filter"), e = 0;
            e < t.length;
            e++
          )
            (function (e) {
              var r = t[e].querySelector(".widget-filter-search"),
                a = t[e]
                  .querySelector(".widget-filter-list")
                  .querySelectorAll(".widget-filter-item");
              if (!r) return;
              r.addEventListener("keyup", function () {
                for (var e = r.value.toLowerCase(), t = 0; t < a.length; t++)
                  -1 <
                  a[t]
                    .querySelector(".widget-filter-item-text")
                    .innerHTML.toLowerCase()
                    .indexOf(e)
                    ? a[t].classList.remove("d-none")
                    : a[t].classList.add("d-none");
              });
            })(e);
        }
        iRunOtherFunctions();
      },
    });
  } else {
    $(".cat-bg").hide();
  }
}

function checkCoupon() {
  loadCoupan();
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "checkCoupon" },
    success: function (data) {},
  });
}

checkCoupon();

function copycode() {
  navigator.clipboard.writeText("5FORU");
  codeCopy();
  setTimeout(function () {
    window.location = "/meds/alzheimers";
  }, 3000);
}

function codeCopyAny(code) {
  $(".anyCode").html(
    '<i class="fa-solid fa-check"></i> code ' + code + " copied"
  );
  $(".anyCode").addClass("show");
  setTimeout(function () {
    $(".anyCode").removeClass("show");
  }, 3000);
}

function codeCopyAny1(code) {
  navigator.clipboard.writeText(code);
  $(".anyCode").html('<i class="fa-solid fa-check"></i> Number copied');
  $(".anyCode").addClass("show");
  setTimeout(function () {
    $(".anyCode").removeClass("show");
  }, 3000);
}

function copyanycode(x) {
  navigator.clipboard.writeText(x);
  codeCopyAny(x);
}

$(".show-hide").hide();
$(".hide-show").on("click", function () {
  if ($(window).width() >= 650) {
    $(".alt-pro").css("height", "86px");
  } else {
    $(".alt-pro").css("height", "170px");
  }
  $("i.hide-show").css("transform", "rotateZ(180deg)");
  $("i.hide-show").hide();
  $("i.show-hide").show();
});

$(".show-hide").on("click", function () {
  $(".alt-pro").css("height", "42px");
  $("i.hide-show").css("transform", "rotateZ(0deg)");
  $("i.hide-show").show();
  $("i.show-hide").hide();
});

function openOutModal(x) {
  $("#outModal").modal("toggle");
  $("#out-product-text").html(capitalizeFirstLetter(x));
  $("#out-product-name").val(capitalizeFirstLetter(x));
}
$(".success").hide();
$(".labelError").hide();
$("#out-med-enq-forms").submit(function (event) {
  $(".success").hide();
  $(".success").hide("");
  $(".labelError").html("");
  $(".labelError").hide();
  event.preventDefault();
  var codepin = $(
    "#out-med-enq-forms .iti__selected-flag .iti__selected-dial-code"
  ).html();
  var formData = new FormData(this);
  formData.append("codepin", codepin);
  formData.append("btn", "out-prod");
  $.ajax({
    url: "action.php",
    type: "post",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      if (data == "done") {
        $(".success").show();
        $(".success").html("Inquiry submitted successfully");
        setTimeout(function () {
          $("#outModal").modal("toggle");
        }, 2000);
      } else {
        $(".labelError").show();
        $("." + data + "Error").html("Please Enter Valid " + data);
      }
    },
  });
});

function codeCopy() {
  var x = document.getElementById("codeCopyAlert");
  x.className = "show";
  setTimeout(function () {
    x.className = x.className.replace("show", "");
  }, 3000);
}

function getCurrency(x) {
  var currency = x.value;
  $.ajax({
    url: "action.php",
    type: "post",
    data: { btn: "currency", currency: currency },
    success: function (data) {
      location.reload();
    },
  });
}

//Email Validation

let $email = $("#address-email");
$email.on("keydown", function (e) {
  $(".email").removeClass("error-input");
  $(".email").removeClass("success-input");
  $(".email").addClass("loader-input");
  var email = $("#address-email").val();
  if (e.key != "ArrowLeft") {
    if (e.key != "ArrowRight") {
      delay(function () {
        if (validateEmail($("#address-email").val())) {
          $.ajax({
            url: "action.php",
            type: "post",
            data: { btn: "validateEmail", email: $("#address-email").val() },
            success: function (data) {
              $(".emailerror").html("");
              $(".emailsuccess").html("");
              if (data == "Bounce") {
                $(".email").removeClass("loader-input");
                $(".email").removeClass("success-input");
                $(".email").addClass("error-input");
                $(".email input[name=email]").css({ border: "1px solid red" });
              } else if (data == "Disposable") {
                $(".email").removeClass("loader-input");
                $(".email").removeClass("success-input");
                $(".email").addClass("error-input");
                $(".email input[name=email]").css({ border: "1px solid red" });
              } else if (data == "Syntax") {
                $(".email").removeClass("loader-input");
                $(".email").removeClass("success-input");
                $(".email").addClass("error-input");
                $(".email input[name=email]").css({ border: "1px solid red" });
              } else {
                $(".email").removeClass("loader-input");
                $(".email").removeClass("error-input");
                $(".email").addClass("success-input");
                $(".email input[name=email]").css({
                  border: "1px solid #e3e9ef",
                });
              }
            },
          });
        } else {
          $(".email").removeClass("loader-input");
          $(".email").removeClass("success-input");
          $(".email").addClass("error-input");
        }
      }, 400);
    }
  }
});

function validateEmail(email) {
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

let $phone = $(".update_phone");
$(".newAddressPhone").on("input", function () {
  phoneVerify();
});

$(".logedPhone").on("input", function () {
  loggedPhoneVerify();
});

function loggedPhoneVerify() {
  $(".phone").removeClass("error-input");
  $(".phone").removeClass("success-input");
  $(".phone").addClass("loader-input");
  var code = $("#addAddressBox .iti__selected-dial-code").html();
  var phone = $(".logedPhone").val();
  var phoneLength = $("#addAddressBox #phonelength").val();
  var phone = phone.replace(/\X/g, "");
  var phone = phone.replace(/\-/g, "");
  var phone = phone.replace(" ", "");
  if (phone.length == phoneLength) {
    var code = $("#addAddressBox .iti__selected-dial-code").html();
    var phone = $(".logedPhone").val();
    var phoneLength = $("#addAddressBox #phonelength").val();
    var phone = phone.replace(/\X/g, "");
    var phone = phone.replace(/\-/g, "");
    var phone = phone.replace(" ", "");
    delay(function () {
      $.ajax({
        url: "action.php",
        type: "post",
        data: { btn: "validatePhone", phone: phone, code: code },
        success: function (data) {
          $(".phone").removeClass("loader-input");
          $(".phonesuccess").html("");
          $(".phoneerror").html("");
          if (data) {
            $(".phone").addClass("success-input");
            $("#addAddressBox .iti").css({ border: "1px solid #e3e9ef" });
          } else {
            $(".phone").addClass("error-input");
            $("#addAddressBox .iti").css({ border: "1px solid red" });
          }
        },
      });
    }, 200);
  } else if (phone.length == 0) {
    $(".phone").addClass("error-input");
    $(".phone").removeClass("success-input");
    $(".phone").removeClass("loader-input");
    $("#addAddressBox .iti").css({ border: "1px solid red" });
  } else if (phone.length > 0) {
    $(".phone").addClass("loader-input");
    $(".phone").removeClass("success-input");
    $(".phone").removeClass("error-input");
    $("#addAddressBox .iti").css({ border: "1px solid red" });
  } else {
    $(".phone").removeClass("error-input");
    $("#addAddressBox .iti").css({ border: "1px solid #e3e9ef" });
  }
}

function phoneVerify() {
  $(".phone").removeClass("error-input");
  $(".phone").removeClass("success-input");
  $(".phone").addClass("loader-input");
  var code = $("#addNewUserAddress .iti__selected-dial-code").html();
  var phone = $(".newAddressPhone").val();
  var phoneLength = $("#addNewUserAddress #phonelength").val();
  var phone = phone.replace(/\X/g, "");
  var phone = phone.replace(/\-/g, "");
  var phone = phone.replace(" ", "");
  // console.log("Number enter: "+phone);
  // console.log("Number Length: "+phoneLength);
  // console.log('Enter Length: '+phone.length);
  if (phone.length == phoneLength) {
    var code = $("#addNewUserAddress .iti__selected-dial-code").html();
    var phone = $(".newAddressPhone").val();
    var phoneLength = $("#addNewUserAddress #phonelength").val();
    var phone = phone.replace(/\X/g, "");
    var phone = phone.replace(/\-/g, "");
    var phone = phone.replace(" ", "");
    delay(function () {
      $.ajax({
        url: "action.php",
        type: "post",
        data: { btn: "validatePhone", phone: phone, code: code },
        success: function (data) {
          $(".phone").removeClass("loader-input");
          $(".phonesuccess").html("");
          $(".phoneerror").html("");
          if (data) {
            $(".phone").addClass("success-input");
            $("#addNewUserAddressBox .iti").css({
              border: "1px solid #e3e9ef",
            });
          } else {
            $(".phone").addClass("error-input");
            $("#addNewUserAddressBox .iti").css({ border: "1px solid red" });
          }
        },
      });
    }, 200);
  } else if (phone.length == 0) {
    $(".phone").addClass("error-input");
    $(".phone").removeClass("success-input");
    $(".phone").removeClass("loader-input");
    $("#addNewUserAddressBox .iti").css({ border: "1px solid red" });
  } else if (phone.length > 0) {
    $(".phone").addClass("loader-input");
    $(".phone").removeClass("success-input");
    $(".phone").removeClass("error-input");
    $("#addNewUserAddressBox .iti").css({ border: "1px solid red" });
  } else {
    $(".phone").removeClass("error-input");
    $("#addNewUserAddressBox .iti").css({ border: "1px solid #e3e9ef" });
  }
}

const searchWrapper = document.querySelector(".addressSearch");
const inputBox = searchWrapper.querySelector("input");
inputBox.onkeyup = (e) => {
  $(".addressSearch").addClass("loader-input");
  if (e.target.value.length > 4) {
    listData = "";

    delay(function () {
      $.ajax({
        url: "action.php",
        type: "post",
        data: {
          btn: "getAddress",
          address: encodeURIComponent(e.target.value),
        },
        dataType: "json",
        success: function (data) {
          $(".addressSearch").removeClass("loader-input");
          var suggestions = [];
          var zip = [];
          var city = [];
          var state = [];
          var country = [];
          var addressAr = data["address"];
          var zipAr = data["zip"];
          var cityAr = data["city"];
          var stateAr = data["state"];
          var countryAr = data["country"];
          for (var i in addressAr) suggestions.push([addressAr[i]]);

          for (var i in zipAr) zip.push([zipAr[i]]);

          for (var i in cityAr) city.push([cityAr[i]]);

          for (var i in countryAr) country.push([countryAr[i]]);

          for (var i in stateAr) state.push([stateAr[i]]);

          if (suggestions.length > 0) {
            searchWrapper.classList.add("active");
            for (var i = 0; i < suggestions.length; i++) {
              var citynew = '"' + city[i] + '"';
              var statenew = '"' + state[i] + '"';
              var countrynew = '"' + country[i] + '"';
              listData +=
                "<li data-country='US' onclick='select(this, " +
                zip[i] +
                ", " +
                citynew +
                ", " +
                statenew +
                ", " +
                countrynew +
                ")'>" +
                suggestions[i] +
                "</li>";
            }
            $(".autocom-box").html(listData);
          } else {
            listData = "<li onclick='select(this)'>" + e.target.value + "</li>";
            searchWrapper.classList.remove("active");
          }
        },
      });
    }, 300);
  } else {
    // searchWrapper.classList.add("active");
    // listData = "<li onclick='select(this)'>"+e.target.value+"</li>";
    // $('.autocom-box').html(listData);
    searchWrapper.classList.remove("active");
  }
};
function select(element, zip, city, state, country) {
  let selectData = element.textContent;
  $(".pincode_address").val(zip);
  $(".city").val(city);
  $(".state").val(state);
  $(".country").val(country);
  // zipCodeVerify();
  inputBox.value = selectData;
  searchWrapper.classList.remove("active");
  $(".addressSearch").removeClass("success-input");
}

const searchWrapper1 = document.querySelector(".addressSearch1");
const inputBox1 = searchWrapper1.querySelector("input");
inputBox1.onkeyup = (e) => {
  $(".addressSearch1").addClass("loader-input");
  if (e.target.value.length > 4) {
    listData1 = "";

    delay(function () {
      $.ajax({
        url: "action.php",
        type: "post",
        data: {
          btn: "getAddress",
          address: encodeURIComponent(e.target.value),
        },
        dataType: "json",
        success: function (data) {
          $(".addressSearch1").removeClass("loader-input");
          var suggestions1 = [];
          var zip1 = [];
          var city1 = [];
          var state1 = [];
          var country1 = [];
          var addressAr1 = data["address"];
          var zipAr1 = data["zip"];
          var cityAr1 = data["city"];
          var stateAr1 = data["state"];
          var countryAr1 = data["country"];
          for (var i in addressAr1) suggestions1.push([addressAr1[i]]);

          for (var i in zipAr1) zip1.push([zipAr1[i]]);

          for (var i in cityAr1) city1.push([cityAr1[i]]);

          for (var i in countryAr1) country1.push([countryAr1[i]]);

          for (var i in stateAr1) state1.push([stateAr1[i]]);

          if (suggestions1.length > 0) {
            searchWrapper1.classList.add("active");
            for (var i = 0; i < suggestions1.length; i++) {
              var citynew1 = '"' + city1[i] + '"';
              var statenew1 = '"' + state1[i] + '"';
              var countrynew1 = '"' + country1[i] + '"';
              listData1 +=
                "<li data-country='US' onclick='select1(this, " +
                zip1[i] +
                ", " +
                citynew1 +
                ", " +
                statenew1 +
                ", " +
                countrynew1 +
                ")'>" +
                suggestions1[i] +
                "</li>";
            }
            $(".autocom-box").html(listData1);
            $(".addressSearch1").removeClass("loader-input");
          } else {
            listData1 =
              "<li onclick='select(this)'>" + e.target.value + "</li>";
            searchWrapper1.classList.remove("active");
          }
        },
      });
    }, 300);
  } else {
    // searchWrapper.classList.add("active");
    // listData = "<li onclick='select(this)'>"+e.target.value+"</li>";
    // $('.autocom-box').html(listData);
    searchWrapper1.classList.remove("active");
  }
};
function select1(element, zip, city, state, country) {
  let selectData = element.textContent;
  $(".pincode_address1").val(zip);
  $(".city1").val(city);
  $(".state1").val(state);
  $(".country1").val(country);
  // zipCodeVerify();
  inputBox1.value = selectData;
  searchWrapper1.classList.remove("active");
  $(".addressSearch1").removeClass("success-input");
}

function zipCodeVerify() {
  $(".zipcode").removeClass("loader");
  $(".zipcode").removeClass("success");
  $(".zipcode").removeClass("error");
  var zipcode = $(".pincode_address").val();
  if (zipcode.length > 4) {
    $(".zipcode").addClass("loader");
    $(".zipcode").removeClass("success");
    $(".zipcode").removeClass("error");
    delay(function () {
      $.ajax({
        url: "action.php",
        type: "post",
        type: "post",
        data: { btn: "zipVerify", zipcode: zipcode },
        dataType: "json",
        success: function (data) {
          if (data == "error") {
            $(".zipcode").addClass("loader");
            $(".zipcode").removeClass("success");
            $(".zipcode").removeClass("error");
            $(".ziperror").html("Enter Valid Zip");
          } else {
            $(".zipcode").removeClass("loader");
            $(".zipcode").addClass("success");
            $(".zipcode").removeClass("error");
            var json = $.parseJSON(JSON.stringify(data));
            var city = json.city;
            var state = json.state;
            var country = json.country;

            $(".city").val(city);
            $(".state").val(state);
            $(".country").val(country);
          }
        },
      });
    }, 400);
  } else if (zipcode.length > 0 && zipcode.length < 4) {
    $(".zipcode").addClass("loader");
    $(".zipcode").removeClass("success");
    $(".zipcode").removeClass("error");
  }
}
$(".paypal").on("click", function () {
  var inv = $(this).data("inv");
  $("#OrderConfirm").modal("toggle");
});

$(".change-payment").on("click", function () {
  var inv = $(this).data("inv");
  window.location.href = "payselect/" + inv;
});

$(".paymentFail").on("click", function () {
  window.location.reload();
});

$(".payemnt-button").on("click", function () {
  var subtotal = $(this).data("subtotal");
  var dcharge = $(this).data("dcharge");
  var discount = $(this).data("discount");
  var total = $(this).data("total");
  var ogtotal = $(this).data("ogtotal");
  var currentpay = $(this).data("currentpay");
  var pname = $(this).data("pname");
  var inv = $(this).data("invoice");
  var source = $(this).data("source");
  var btn = "setPaymentMethod";
  if (pname == "paypal") {
    $crisp.push(["set", "user:nickname", ["" + pname + ""]]);
    $crisp.push([
      "do",
      "message:send",
      ["text", "I want to pay through paypal for " + inv + ""],
    ]);
    $.ajax({
      url: "action.php",
      type: "post",
      data: {
        subtotal: subtotal,
        dcharge: dcharge,
        source: source,
        discount: discount,
        total: total,
        ogtotal: ogtotal,
        currentPay: currentpay,
        btn: btn,
        pname: pname,
        inv: inv,
      },
      success: function (data) {
        if (data == "done") {
          $("#OrderConfirm").modal("toggle");
          // $('#TermsCondition').modal('toggle');
        }
      },
    });
  } else {
    $.ajax({
      url: "action.php",
      type: "post",
      data: {
        subtotal: subtotal,
        dcharge: dcharge,
        source: source,
        discount: discount,
        total: total,
        ogtotal: ogtotal,
        currentPay: currentpay,
        btn: btn,
        pname: pname,
        inv: inv,
      },
      success: function (data) {
        if (data == "done") {
          window.location.href = "process-payment/";
        }
      },
    });
  }
});

function opencrispHelp(x, y) {
  $crisp.push(["set", "user:nickname", ["" + y + ""]]);
  $crisp.push(["do", "chat:open"]);
  $crisp.push([
    "do",
    "message:send",
    [
      "text",
      "Hi, I'm looking to pay by other means. My invoice numbder is " + x + "",
    ],
  ]);
}

$(".chat-now-cart").on("click", function () {
  var names = [];
  $(".cart-main-product1 .product-title").each(function () {
    names.push(" " + $(this).text());
  });
  var userid = $(this).data("userid");
  $crisp.push(["set", "user:nickname", ["" + userid + ""]]);
  $crisp.push(["do", "chat:open"]);
  $crisp.push([
    "do",
    "message:send",
    [
      "text",
      "Hello, I need to order **" + names + "**, can you help me on that?",
    ],
  ]);
});

function opencrisp(x) {
  var method = $("#paymethod").val();
  var name = $("#payname").val();
  if (method == "cashapp") {
    method = "Cashapp";
  } else if (method == "zelle") {
    method = "Zelle";
  } else if (method == "mg") {
    method = "Moneygram";
  } else if (method == "wt") {
    method = "Wiretransfer";
  } else if (method == "wu") {
    method = "Western Union";
  } else if (method == "bt") {
    method = "Bitcoin";
  }

  $crisp.push(["set", "user:nickname", ["" + name + ""]]);
  $crisp.push(["do", "chat:open"]);
  $crisp.push([
    "do",
    "message:send",
    ["text", "Need help in payment for " + x + " via " + method],
  ]);
}

function sendPaymentConfirmation() {
  $(".loader-bg").show();
  var inv = $("#inv").val();
  var method = $("#paymethod").val();
  var total = $("#total").val();
  var name = $("#payname").val();
  var phone = $("#payphone").val();
  var email = $("#payemail").val();

  if (method == "cashapp") {
    method = "Cashapp";
  } else if (method == "zelle") {
    method = "Zelle";
  } else if (method == "mg") {
    method = "Moneygram";
  } else if (method == "wt") {
    method = "Wiretransfer";
  } else if (method == "wu") {
    method = "Western Union";
  } else if (method == "bt") {
    method = "Bitcoin";
  } else if (method == "paypal") {
    method = "Paypal";
  }
  $crisp.push(["set", "user:nickname", ["" + name + ""]]);
  $crisp.push([
    "do",
    "message:send",
    [
      "text",
      "I have made payment of $" +
        total +
        " via " +
        method +
        " for " +
        inv +
        "",
    ],
  ]);

  $.ajax({
    url: "action.php",
    type: "post",
    data: {
      btn: "updateOrderAgain",
      inv: inv,
      phone: phone,
      email: email,
      pname: method,
      total: total,
    },
    success: function (data) {
      if (data == "done") {
        $(".loader-bg").hide();
        window.location.href = domainName + "/confirmation";
      }
    },
  });
}
var delay = (function () {
  var timer = 0;
  return function (callback, ms) {
    clearTimeout(timer);
    timer = setTimeout(callback, ms);
  };
})();

function shareURL(x, y) {
  if (navigator.share) {
    navigator.share({
      text: "Limited-time deal: " + x,
      url: y,
    });
  }
}

$(".ss_wrap_1 .ss_btn").on("click", function () {
  this.classList.toggle("active");
});

function download(source) {
  const fileName = source.split("/").pop();
  var el = document.createElement("a");
  el.setAttribute("href", source);
  el.setAttribute("download", fileName);
  document.body.appendChild(el);
  el.click();
  el.remove();
}
// $('#payment-modal').modal('show');

function applyDis(x) {
  $.ajax({
    type: "POST",
    url: "action.php", //url to file
    data: { dis: x, btn: "applyDis" },
    success: function (data) {
      alert(discountApply);
    },
  });
}

$(".trick-btn").on("click", function () {
  $("#halloween-modal").hide();
});
$(".treat-btn").on("click", function () {
  $("#halloween-modal").hide();
});

// const jsConfetti1 = new JSConfetti();
// document.querySelector(".claimOffer").addEventListener("click", async () => {

// $('#halloween-dis-modal').hide();
//   await jsConfetti1.addConfetti({
//     emojis: ["🎃", "🕷️", "🦇", "🧟", "👻", "🧟‍♀️", "⚰️", "🔮"],
//     emojiSize: 40,
//     confettiNumber: 150,
//     startVelocity: 2,
//     spread: 160,
//     confettiColors: [
//       "#ff0a54",
//       "#ff477e",
//       "#ff7096",
//       "#ff85a1",
//       "#fbb1bd",
//       "#f9bec7",
//     ],
//   });
// });

// $('.watch-now').on('click', function() {
//     alert('Watch video');
// })

// $('.cred-pay').on('click', function() {
//     var invoice = $(this).data('invoice');
//     $('.cred-payment').css('display','flex')
//     $.ajax({
//         type: "POST",
//         url: 'paymentAdd.php',//url to file
//         data: {'invoice':invoice,},
//         success: function(data){
//             window.location.href = 'paymentgateway/'+data;
//         }
//     });

// })

var terms_were_scrolled = false;
$(".other-pay").hide();
$(".switch-dis").hide();
$(".scroll-cred-data").scroll(function () {
  console.log(
    $(this).scrollTop() +
      "=>" +
      Math.round($(this)[0].scrollHeight - $(this).height())
  );
  if ($(this).scrollTop() >= 60) {
    terms_were_scrolled = true;
    $(".cred-pay").addClass("active");

    $("span.error-check").css("visibility", "hidden");
  }
});

$(".cred-pay").click(function (event) {
  if (!terms_were_scrolled) {
    $("span.error-check").css("visibility", "visible");
    event.preventDefault();
  } else {
    var invoice = $(this).data("invoice");
    $(".cred-payment").css("display", "flex");
    $.ajax({
      type: "POST",
      url: "paymentAdd.php", //url to file
      data: { invoice: invoice },
      success: function (data) {
        window.location.href = "paymentgateway/" + data;
      },
    });
  }
});

$(".credit-switch").on("click", function (e) {
  e.preventDefault();
  $(".credit-content").show();
  $(".switch-en").show();
  $(".cred-pay").show();
  $(".top-headline.row").show();
  $(".other-pay").hide();
  $(".switch-dis").hide();
  $(".cred-pay").removeClass("active");
  $(".scroll-cred-data").css("height", "47vh");
  terms_were_scrolled = false;
});

$(".pay-switch").on("click", function (e) {
  e.preventDefault();
  $(".credit-content").hide();
  $(".switch-en").hide();
  $(".cred-pay").hide();
  $(".top-headline.row").hide();
  $(".other-pay").show();
  $(".switch-dis").show();
  $(".scroll-cred-data").css("height", "fit-content");
  const El = document.getElementById("scroll-cred-data");
  var scrollDiv = document.getElementById("other-pay").offsetTop;
  El.scrollTo({ top: scrollDiv - 150, behavior: "smooth" });
});

// home scroll down
// smoothscroll fucntion
function scrollToElement(elementId) {
  if (screen.width < 600) {
    var yOffset = -350 
  } else{
    var yOffset = -90;
  }
  $('.terms_and_condition .content h2').removeClass('active');
  $(`.terms_and_condition .content #${elementId}`).addClass('active');
  var element = document.getElementById(elementId);
  console.log(elementId)
  const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;
  window.scrollTo({ top: y, behavior: "smooth" });
}


// OTP pages js 
  $(window).scroll(function(){
    if($(this).scrollTop() >= 282){
      $('.mobile_list').addClass('active');
      $('.navbar').css({"box-shadow":"none"})
    }else{
      $('.mobile_list').removeClass('active');
      $('.navbar').css({"box-shadow":"rgb(50 50 93 / 25%) 0px 13px 27px -5px, rgb(0 0 0 / 30%) 0px 8px 16px -8px"})
    }
  })

  $(window)
  .scroll(function () {
    var scrollDistance = $(window).scrollTop();
    $(".terms_and_condition .content h2").each(function (i) {
      if ($(this).position().top - 190 <= scrollDistance) {
        $('.terms_and_condition .content h2').removeClass('active')
        $(this).addClass('active')
        $(".sidebar_list li.active").removeClass("active");
        $(".sidebar_list li").eq(i).addClass("active");
      }
    });
  });

  // post active table of content
  var i = 0;
  $(".terms_and_condition .content h2").each(function () {
    ++i;
    $(this).addClass("heading");
    $(this).attr("id", "h" + i);
    if (i == 1) {
      var status = "active";
    $(this).addClass("active");

    } else {
      var status = "";
    }
    $(".terms_and_condition .sidebar_list, .terms_and_condition .mobile_list .accordion-body ul").append(
      `<li onclick="scrollToElement('h${i}')" class="${status}">
    <span>0${i}</span>
        <p>${$(this).html()}</p>
    </li>`
    );
  });

  $(".terms_and_condition .mobile_list li").click(function () {
    $(".mobile_list li").removeClass("active");
    $(".mobile_list .accordion-button").click();
    $(this).addClass("active");
  });

  $(".sidebar_list li").click(function () {
    $(".sidebar_list li").removeClass("active");
    $(this).addClass("active");
  });
// OTP pages js 

// home page review carousel 
var reviewCarosel = $('.review-carousel')

reviewCarosel.owlCarousel({
    loop:true,
    nav: true,
    margin:30,
    responsiveClass:true,
    responsive:{
        0:{
            items:1.1,
            stagePadding: 20,
        },
        600:{
            items:3,
        },
        1000:{
            items:2.5,
            stagePadding: 50,
        }
    },
    navText:['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>']
  })
// home page review carousel


//openlogin=true
$(document).ready(function () {
  if(window.location.href.includes('?openlogin=true')){
    $('#signin-modal').modal('show');
  }else if(window.location.href.includes('?openchat=true')){
    $('.cc-imbb.cc-qfnu').click();
  }
});

//openchat=true

// report an issue 
  $('.live_chat_section  .back-btn').click(() => {
    $('.live_chat_section').toggle()
  })

  var colorArray = ['#1F42AF','#6F27AA','#9B2020','#0D5D2B','#2B3542','#1F42AF','#6F27AA','#9B2020','#0D5D2B','#2B3542'];
  var backgroundColorArray = ['#DBEAFE','#FAF3FF','#FEE2E2','#DCFCE7','#F2F3F5','#DBEAFE','#FAF3FF','#FEE2E2','#DCFCE7','#F2F3F5']
  $('.question_list .span1').each((ind,ele) => {
    ele.style.background = `${backgroundColorArray[ind]}`
    ele.style.color = `${colorArray[ind]}`
  });

  $('.question_answer_section .question_list li,.report_issue_mobile .accordion-body li').click(() => {
    $('.live_chat_section').show();
  })
// report an issue 


// order confirmation 
    $(".text_query .form-check-input").click(function() {
      $(".text_query .form-check-input").each((ind,ele) => {     
        console.log(ele.checked == true)   
        if(ele.checked == true){
          var id = ele.id;
          $(`.query_section .${id}`).show()
        } else {
          var id = ele.id;
          $(`.query_section .${id}`).hide()
        }
      })
  });
// order confirmation 
