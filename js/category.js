var categoryApi = $("#categoryName").val();

const imageSliderOwl = () => {
  $(".image_conatiner").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    dots: true,
    nav: false,
  });
};

function getALlProducts(value) {
  fetch(`api/category/${value}`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      Object.values(data).map((item, ind) => {
        // console.log(item)
        var product = Object.values(item)[0];
        var productStrength = Object.values(item)[2];

        var productCard = "";
        var listItem = "";
        var tab = "";
        var tabData = "";
        var imageData = "";

        var initialPrice = null;
        var initialAP = null;
        var initialTS = null;
        var initialTP = null;
        var type = null;

        var totalPrice = null;

        var shippingCharges = 0;
        var shippingChargesText = "";

        var toggle = "";

        var productImage = Object.values(product.image);
        productImage.map((imgItem, index) => {
          imageData =
            imageData +
            `<div class="image-item ${index == 0 ? "active" : ""}">
        <img src="https://myglobal1.gumlet.io/onglobaladmincrm/` +
            imgItem +
            `" alt="Product image">
        </div>`;
        });

        var i = 0;

        for (parentkey in productStrength) {
          i++;
      
          var value = productStrength[parentkey];
      
          var singleQuantity = value.quantity;
      
          listItem = "";
      
          var j = 0;
      
          for (qty in singleQuantity) {
            j++;
      
            var len = Object.keys(singleQuantity).length;
      
            var quantity = singleQuantity[qty];
      
            if (i < 2) {
              if (j == len) {
                initialPrice = (
                  quantity.price -
                  (quantity.price * quantity.discount) / 100
                ).toFixed(2);
      
                initialAP = (quantity.price * qty).toFixed(2);
      
                initialTP =
                  quantity.price * qty -
                  (quantity.price * qty * quantity.discount) / 100;
      
                initialTS = (quantity.price * qty * quantity.discount) / 100;
      
                type = qty;
              }
      
              var finalValue = shippingCalculation(
                product.category,
                qty,
                shippingCharges,
                shippingChargesText,
                initialTP
              );
      
              totalPrice = (finalValue.price + finalValue.shippingCharges).toFixed(2);
            }
      
            listItem =
              listItem +
              `
                    <div class="item ${len == j ? "active" : ""}" data-pro-type="${
                product.productType
              }" data-orders="2" data-usa-enable="${product.usaAvail}" data-is-usa="${
                product.usaAvail
              }" data-type="${product.type}" data-discount="${
                quantity.discount
              }" data-qty="${qty}" data-cart="${quantity.oncart}" data-section="${
                product.code
              }" data-price="${quantity.price}" data-ogprice="${(
                quantity.price * qty
              ).toFixed(2)}" data-code="${quantity.code}" data-category="${
                product.category
              }">
                    <div class="qty">
                    ${qty} <span>${product.productType}</span>
                    </div>
                    <div class="price_per_pill">
                    $${(
                      quantity.price -
                      (quantity.price * quantity.discount) / 100
                    ).toFixed(2)} <span>/${product.productType}</span>
                    </div>
                    <div class="prices">
                      <div class="discout_price">
                      $${(
                        quantity.price * qty -
                        (quantity.price * qty * quantity.discount) / 100
                      ).toFixed(2)}
                      </div>
                      <div class="ogprice">
                      $${(quantity.price * qty).toFixed(2)}
                      </div>
                    </div>
                    <img src="image/productPageImg/pills-checkbox.png" alt="">
                    </div>
                    `;
          }
      
          tab =
            tab +
            `
      
           <button href="#${value.code}" draggable="false" class="nav-link ${
              value.active == 1 ? "active" : ""
            }" data-bs-toggle="tab" role="tab"><span>${parentkey}</span></button>
           `;
      
          tabData =
            tabData +
            `
           <div class="tab-pane fade ${value.active == 1 ? "active show" : ""}" id="${
              value.code
            }" role="tabpanel">
           ${listItem}
           </div>
           `;

        }
        
        // usa Available check
      var usaToggle = usaAvailable(toggle,product,ind,"");
        // usa Available check

        productCard = `
      <div class="col-lg-4 col-12 px-2">
      ${product.code}
      <div class="product_card ${product.code}">
      <div class="catgory">${product.category}</div>
      <img class="cat-label" src="https://myglobal1.gumlet.io/images/Ribbon.png" alt="">
      <img class="cat-ribbin" src="https://myglobal1.gumlet.io/images/Ring.png" alt="">
      
      <div class="name_image">
        <div class="name_details">
          <p class="name">
            ${product.name}
          </p>
          <span class="generic">${product.generic}</span>
          <div class="price_type">
            <span class="price">$${initialPrice}</span>
            <span class="slash">/</span>
            <span class="pro-Type">${product.productType}</span>
          </div>
        </div>
        <div class="image_conatiner ${product.code} owl-carousel">
          ${imageData}
        </div>
      </div>

       <!-- action buttons  -->
       <div class="act_buttons">
          <div class="shipping_line">
          <img src="image/shipping.png" alt="">
          <p>Free Shipping on order above <strong>$199</strong></p>
        </div>
          <div class="buttons">
            <button class="${product.code}">Add To cart</button>
            <button class="${product.code}">Order Now</button>
          </div>
          <a class="know_more" href="p/${
            product.slug
          }">Know More <i class="fa-solid fa-arrow-right"></i></a>
          </div>
      <!-- action buttons  -->

      <div class="product_inner" id="${product.code}">
      <div class="strength_quantity">

        <button class="close_btn ${
          product.code
        }"><i class="fa-solid fa-circle-xmark"></i></button>
        
        <div class="strrngth_sevtion">
          <p class="strength_heading">Select The Required Strength</p>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item ${product.code}" role="presentation">
            ${tab}
            </li>
          </ul>
        </div>

        <div class="quantity_section">
          <p class="strength_heading">Select Number Of Pills</p>
          <div class="tab-content ${product.code}" id="myTabContent">
            ${tabData}
          </div>
        </div>


        <div class="create_own">
          <button class="create">
          <i class="fa-solid fa-plus"></i> Create Your Own
          </button>
        </div>


        <div class="shipping_line">
          <img src="image/shipping.png" alt="">
          <p>Free Shipping on order above <strong>$199</strong></p>
        </div>

        <div class="product-calculation ${product.code}">
                        <div class="round-shape-right">
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                        </div>
                        <div class="round-shape-left">
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                        </div>
                        <div class="logo dashed-line">
                            <img src="https://myglobal1.gumlet.io/images/newland-logo-sub1.PNG?w=128">
                        </div>
                        <div class="offer-applied">
                            <span class="discount">30% OFF</span>
                            <p class="dis-text">
                                Applied <span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>
                            </p>
                        </div>
                        <div class="calculation">
                            <div class="list">
                                <span class="title">Quantity</span>
                                <span class="value ogPill">${
                                  type
                                } ${product.productType}</span>
                            </div>
                            <div class="list">
                                <span class="title">Actual Price</span>
                                <span class="value ogprice">$${
                                  initialAP
                                }</span>
                            </div>
                            <div class="list">
                                <span class="title">Shipping Charges</span>
                                <span class="value shippingCharges" "="">${
                                  finalValue.shippingChargesText
                                }</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Saving</span>
                                <span class="value save-value">$${initialTS.toFixed(
                                  2
                                )}</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Price</span>
                                <span class="value totalprice">$${
                                  totalPrice
                                }</span>
                            </div>
                        </div>
                    </div>



        ${usaToggle ? ` <div>${usaToggle}</div>` : ``}

        <ul class="shipping_details">
          <li class="dashed-line">
            <img src="image/arrive.png" alt="">
            <span>Arriving On</span>
            <span>05-15-2023 WED</span>
          </li> 
          <li >
            <img src="image/Flight.png" alt="">
            <span>Expected On</span>
            <span>05-15-2023 WED</span>
          </li>
        </ul>

        <button class="desc">What’s the difference?</button>

        <a class="cart">Confirm Cart</a>
        
      </div>
      </div>
    </div>
        </div>
      `;

        $(".category-products").append(productCard);
        imageSliderOwl();
      });
      onload();
    });
}
getALlProducts(categoryApi);

function onload() {
  $(".product_card .buttons button").click(function () {
    $(this).parent().parent().hide();
    var id = $(this).attr("class");
    $(`#${id}`).show();

    $(
      ".product-card-layout .product_card .product_inner .quantity_section .tab-pane .item"
    ).click(function () {
      var procode = $(this).attr("data-section");
      $(`#${procode} .tab-content .item`).removeClass("active");
      $(this).addClass("active");
      console.log($(this).children("img").eq(0).attr("src"));
      let code = $(this).attr("data-section");
      let pro_type = $(this).attr("data-pro-type");
      let category = $(this).attr("data-category");
      let qty = $(this).attr("data-qty");
      let discount = $(this).attr("data-discount");
      let ogPrice = $(this).attr("data-ogprice");

      let pricePerItem = $(this).attr("data-price");
      let discountValue = (pricePerItem * qty * discount) / 100;
      let price = ogPrice - discountValue;

      let shippingCharges = 0;
      let shippingChargesText = "";

      let totalPrice = null;

      var finalValue = shippingCalculation(
        category,
        qty,
        shippingCharges,
        shippingChargesText,
        price
      );

      totalPrice = (finalValue.price + finalValue.shippingCharges).toFixed(2);

      $(`.product-calculation.${code}`).html(`
      <div class="round-shape-right">
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                        </div>
                        <div class="round-shape-left">
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                            <div class="round"></div>
                        </div>
                        <div class="logo dashed-line">
                            <img src="https://myglobal1.gumlet.io/images/newland-logo-sub1.PNG?w=128">
                        </div>
                        <div class="offer-applied">
                            <span class="discount">30% OFF</span>
                            <p class="dis-text">
                                Applied <span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>
                            </p>
                        </div>
                        <div class="calculation">
                            <div class="list">
                                <span class="title">Quantity</span>
                                <span class="value ogPill">${qty} ${pro_type}</span>
                            </div>
                            <div class="list">
                                <span class="title">Actual Price</span>
                                <span class="value ogprice">$${ogPrice}</span>
                            </div>
                            <div class="list">
                                <span class="title">Shipping Charges</span>
                                <span class="value shippingCharges" "="">${
                                  finalValue.shippingChargesText
                                }</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Saving</span>
                                <span class="value save-value">$${discountValue.toFixed(
                                  2
                                )}</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Price</span>
                                <span class="value totalprice">$${totalPrice}</span>
                            </div>
                        </div>
      `);
    });
  });

  // hide inner_section
  $(".strength_quantity .close_btn").click(function () {
    var code = $(this).attr("class").split(" ")[1];
    $(`#${code}`).hide();
    $(`#${code}`).siblings(".act_buttons").show();
  });

  // checkbox change
  $(".checkbox").change(function () {
    let currCode = $(this).attr("data-current-code");
    let toggleCode = $(this).attr("data-code");
    switchProduct(currCode, toggleCode);
  });
}

function quantityAndStrength(
  i,
  productStrength,
  initialPrice,
  initialAP,
  initialTP,
  initialTS,
  type,
  totalPrice,
  listItem,
  product,
  tab,
  tabData,
  shippingCharges,
  shippingChargesText
) {
  for (parentkey in productStrength) {
    i++;

    var value = productStrength[parentkey];

    var singleQuantity = value.quantity;

    listItem = "";

    var j = 0;

    for (qty in singleQuantity) {
      j++;

      var len = Object.keys(singleQuantity).length;

      var quantity = singleQuantity[qty];

      if (i < 2) {
        console.log('hi')
        if (j == len) {
          console.log('ji')
          initialPrice = (
            quantity.price -
            (quantity.price * quantity.discount) / 100
          ).toFixed(2);

          initialAP = (quantity.price * qty).toFixed(2);

          initialTP =
            quantity.price * qty -
            (quantity.price * qty * quantity.discount) / 100;

          initialTS = (quantity.price * qty * quantity.discount) / 100;

          type = qty;
        }

        var finalValue = shippingCalculation(
          product.category,
          qty,
          shippingCharges,
          shippingChargesText,
          initialTP
        );

        totalPrice = (finalValue.price + finalValue.shippingCharges).toFixed(2);
      }

      listItem =
        listItem +
        `
              <div class="item ${len == j ? "active" : ""}" data-pro-type="${
          product.productType
        }" data-orders="2" data-usa-enable="${product.usaAvail}" data-is-usa="${
          product.usaAvail
        }" data-type="${product.type}" data-discount="${
          quantity.discount
        }" data-qty="${qty}" data-cart="${quantity.oncart}" data-section="${
          product.code
        }" data-price="${quantity.price}" data-ogprice="${(
          quantity.price * qty
        ).toFixed(2)}" data-code="${quantity.code}" data-category="${
          product.category
        }">
              <div class="qty">
              ${qty} <span>${product.productType}</span>
              </div>
              <div class="price_per_pill">
              $${(
                quantity.price -
                (quantity.price * quantity.discount) / 100
              ).toFixed(2)} <span>/${product.productType}</span>
              </div>
              <div class="prices">
                <div class="discout_price">
                $${(
                  quantity.price * qty -
                  (quantity.price * qty * quantity.discount) / 100
                ).toFixed(2)}
                </div>
                <div class="ogprice">
                $${(quantity.price * qty).toFixed(2)}
                </div>
              </div>
              <img src="image/productPageImg/pills-checkbox.png" alt="">
              </div>
              `;
    }

    tab =
      tab +
      `

     <button href="#${value.code}" draggable="false" class="nav-link ${
        value.active == 1 ? "active" : ""
      }" data-bs-toggle="tab" role="tab"><span>${parentkey}</span></button>
     `;

    tabData =
      tabData +
      `
     <div class="tab-pane fade ${value.active == 1 ? "active show" : ""}" id="${
        value.code
      }" role="tabpanel">
     ${listItem}
     </div>
     `;
    return {
      i,
      productStrength,
      initialPrice,
      initialAP,
      initialTP,
      initialTS,
      type,
      totalPrice,
      listItem,
      product,
      tab,
      tabData,
      shippingCharges,
      shippingChargesText,
      finalValue,
    };
  }
}

function shippingCalculation(
  category,
  qty,
  shippingCharges,
  shippingChargesText,
  price
) {
  if (category == "Injectable Steroids" || category == "Oral Steroids") {
    if (qty < 5) {
      shippingCharges = 20;
      shippingChargesText = "$20";
    } else {
      shippingCharges = 40;
      shippingChargesText = "$40";
    }
  } else if (category == "USA Premium") {
    shippingCharges = 0;
    shippingChargesText =
      '<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
  } else {
    if (price < 100) {
      shippingCharges = 20;
      shippingChargesText = "$20";
    } else if (price >= 100 && price < 150) {
      shippingCharges = 15;
      shippingChargesText = "$15";
    } else if (price >= 150 && price < 200) {
      shippingCharges = 10;
      shippingChargesText = "$10";
    } else {
      shippingCharges = 0;
      shippingChargesText =
        '<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
    }
  }

  return { category, qty, shippingCharges, shippingChargesText, price };
}


var k = 0;

function switchProduct(currCode, toggleCode) {
  k++
  fetch(`api/product/${toggleCode}`)
    .then((data) => data.json())
    .then((response) => {
      var product = Object.values(response)[0];

      var productStrength = Object.values(response)[2];

      console.log(productStrength)

      var productImage = Object.values(product.image);

      var listItem = "";
      var tab = "";
      var tabData = "";
      var imageData = "";
      var switchText = "Switch";


      var initialPrice = null;
      var initialAP = null;
      var initialTS = null;
      var initialTP = null;
      var type = null;

      var totalPrice = null;

      var shippingCharges = 0;
      var shippingChargesText = "";

      var toggle = "";

      productImage.map((imgItem, index) => {
        imageData =
          imageData +
          `<div class="image-item ${index == 0 ? "active" : ""}">
          <img src="https://myglobal1.gumlet.io/onglobaladmincrm/` +
          imgItem +
          `" alt="Product image">
          </div>`;
      });

      var i = 0;

      for (parentkey in productStrength) {
        i++;
    
        var value = productStrength[parentkey];
    
        var singleQuantity = value.quantity;
    
        listItem = "";
    
        var j = 0;
    
        for (qty in singleQuantity) {
          j++;
    
          var len = Object.keys(singleQuantity).length;
    
          var quantity = singleQuantity[qty];
    
          if (i < 2) {
            if (j == len) {
              initialPrice = (
                quantity.price -
                (quantity.price * quantity.discount) / 100
              ).toFixed(2);
    
              initialAP = (quantity.price * qty).toFixed(2);
    
              initialTP =
                quantity.price * qty -
                (quantity.price * qty * quantity.discount) / 100;
    
              initialTS = (quantity.price * qty * quantity.discount) / 100;
    
              type = qty;
            }
    
            var finalValue = shippingCalculation(
              product.category,
              qty,
              shippingCharges,
              shippingChargesText,
              initialTP
            );
    
            totalPrice = (finalValue.price + finalValue.shippingCharges).toFixed(2);
          }
    
          listItem =
            listItem +
            `
                  <div class="item ${len == j ? "active" : ""}" data-pro-type="${
              product.productType
            }" data-orders="2" data-usa-enable="${product.usaAvail}" data-is-usa="${
              product.usaAvail
            }" data-type="${product.type}" data-discount="${
              quantity.discount
            }" data-qty="${qty}" data-cart="${quantity.oncart}" data-section="${
              product.code
            }" data-price="${quantity.price}" data-ogprice="${(
              quantity.price * qty
            ).toFixed(2)}" data-code="${quantity.code}" data-category="${
              product.category
            }">
                  <div class="qty">
                  ${qty} <span>${product.productType}</span>
                  </div>
                  <div class="price_per_pill">
                  $${(
                    quantity.price -
                    (quantity.price * quantity.discount) / 100
                  ).toFixed(2)} <span>/${product.productType}</span>
                  </div>
                  <div class="prices">
                    <div class="discout_price">
                    $${(
                      quantity.price * qty -
                      (quantity.price * qty * quantity.discount) / 100
                    ).toFixed(2)}
                    </div>
                    <div class="ogprice">
                    $${(quantity.price * qty).toFixed(2)}
                    </div>
                  </div>
                  <img src="image/productPageImg/pills-checkbox.png" alt="">
                  </div>
                  `;
        }
    
        tab =
          tab +
          `
    
         <button href="#${value.code}" draggable="false" class="nav-link ${
            value.active == 1 ? "active" : ""
          }" data-bs-toggle="tab" role="tab"><span>${parentkey}</span></button>
         `;
    
        tabData =
          tabData +
          `
         <div class="tab-pane fade ${value.active == 1 ? "active show" : ""}" id="${
            value.code
          }" role="tabpanel">
         ${listItem}
         </div>
         `;
      }

      // usa Available check
      var usaToggle = usaAvailable(toggle,product,k,switchText);
      // usa Available check

      $(`.image_conatiner.${currCode}`).html(imageData).removeClass(currCode).addClass(product.code);
      $(`.nav-tabs .nav-item.${currCode}`).html(tab).removeClass(currCode).addClass(product.code);
      $(`.tab-content.${currCode}`).html(tabData).removeClass(currCode).addClass(product.code);
      $(`.product-calculation.${currCode}`).html(
        `<div class="${product.code}">
        <div class="round-shape-right">
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
        </div>
        <div class="round-shape-left">
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
            <div class="round"></div>
        </div>
        <div class="logo dashed-line">
            <img src="https://myglobal1.gumlet.io/images/newland-logo-sub1.PNG?w=128">
        </div>
        <div class="offer-applied">
            <span class="discount">30% OFF</span>
            <p class="dis-text">
                Applied <span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>
            </p>
        </div>
        <div class="calculation">
            <div class="list">
                <span class="title">Quantity</span>
                <span class="value ogPill">${type} ${product.productType}</span>
            </div>
            <div class="list">
                <span class="title">Actual Price</span>
                <span class="value ogprice">$${initialAP}</span>
            </div>
            <div class="list">
                <span class="title">Shipping Charges</span>
                <span class="value shippingCharges" "="">${
                  finalValue.shippingChargesText
                }</span>
            </div>
            <div class="list">
                <span class="title">Total Saving</span>
                <span class="value save-value">$${initialTS.toFixed(2)}</span>
            </div>
            <div class="list">
                <span class="title">Total Price</span>
                <span class="value totalprice">$${totalPrice}</span>
            </div>
        </div>
    </div>`
      ).removeClass(currCode).addClass(product.code);
      $(`.shipping-toggle.${currCode}`).parent().html(usaToggle).children('.shipping-toggle').removeClass(currCode).addClass(productData.product.code);
      onload();
    })
    .catch((err) => console.log(err));
}


function usaAvailable (toggle ,product ,number,switchText) {
  // usa Available check
  if (product.type == "USA") {
    if (product.globeAvail) {
      var globeCode = product.globeCode;
      toggle = `
    <div class="shipping-toggle ${product.code}">
    <input type="checkbox" id="checkbox${switchText}${number}" class="checkbox" data-code="${globeCode}" data-current-code="${product.code}" checked="checked">
    <label for="checkbox${switchText}${number}" class="switch_bg">
        <div class="switch_button"></div>
    </label>
    <div class="ship-name first">Global Shipping</div>
    <div class="ship-name second">USA Premium Shipping</div>
</div>`;
    }
  } else {
    if (product.usaAvail) {
      var usaCode = product.usaCode;
      toggle = `
        <div class="shipping-toggle ${product.code}">
        <input type="checkbox" id="checkbox${switchText}${number}" class="checkbox" data-code="${usaCode}" data-current-code="${product.code}" >
        <label for="checkbox${switchText}${number}" class="switch_bg">
            <div class="switch_button"></div>
        </label>
        <div class="ship-name first">Global Shipping</div>
        <div class="ship-name second">USA Premium Shipping</div>
    </div>`;
    }
  }

  return toggle;
}