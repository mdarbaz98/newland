
// // strength slider starts here to changes 
// const slider = document.querySelector('.strength-slider-inner');
// // $('.shipping-info').hide();

// let sliderGrabbed = false;
// slider.parentElement.addEventListener('scroll', (e) => {
//     $('.strength-slider-inner .nav-link').addClass('disabled');

//     $('.strength-slider-inner a').click(function(event){
//         if ($(this).hasClass('disabled')) {
//             return false;
//         }
//     });
    
// })

// slider.addEventListener('mousedown', (e) => {
//     e.stopPropagation();
//     sliderGrabbed = true;
//     // slider.style.cursor = 'grabbing';
// })

// slider.addEventListener('mouseup', (e) => {
    
//     sliderGrabbed = false;
//     slider.style.cursor = 'grab';
    
// })

// slider.addEventListener('mouseleave', (e) => {
//     sliderGrabbed = false;
// })

// slider.addEventListener('mousemove', (e) => {
    
//     $('.strength-slider-inner .nav-link').removeClass('disabled');
//     if(sliderGrabbed){
//         slider.parentElement.scrollLeft -= e.movementX;
//     }
// })

// var leftLen = $(".strength-slider-inner .nav-link.active").get(0).getBoundingClientRect().left; 
// slider.parentElement.scrollLeft = leftLen-50;

//Product UI Image Slider

function slider() {
    const cardsSlider = document.getElementById("strength-slider-inner");

    let isGrabbed = false;
    let initialPos;
    let scrollLeft;

    const initializeDrag = (e) => {
    cardsSlider.classList.add('active')
    isGrabbed = true;
    initialPos = e.pageX - cardsSlider.offsetLeft;
    scrollLeft = cardsSlider.scrollLeft;
    }

    const handleDragging = (e) => {
    if (!isGrabbed) return;
    e.preventDefault();
    const xPos = e.pageX - cardsSlider.offsetLeft
    const walk = (xPos - initialPos) * 2;
    cardsSlider.scrollLeft = scrollLeft - walk;
    }

    const deInitializeDrag = () => {
    isGrabbed = false;
    cardsSlider.classList.remove('active');
    }

    cardsSlider.addEventListener('mousedown', initializeDrag);
    cardsSlider.addEventListener('mousemove', handleDragging);
    cardsSlider.addEventListener('mouseleave', deInitializeDrag);
    cardsSlider.addEventListener('mouseup', deInitializeDrag);
}

function slider1(id) {
const cardsSlider = document.getElementById("strength-slider-inner"+id);

let isGrabbed = false;
let initialPos;
let scrollLeft;

const initializeDrag = (e) => {
cardsSlider.classList.add('active')
isGrabbed = true;
initialPos = e.pageX - cardsSlider.offsetLeft;
scrollLeft = cardsSlider.scrollLeft;
}

const handleDragging = (e) => {
if (!isGrabbed) return;
e.preventDefault();
const xPos = e.pageX - cardsSlider.offsetLeft
const walk = (xPos - initialPos) * 2;
cardsSlider.scrollLeft = scrollLeft - walk;
}

const deInitializeDrag = () => {
isGrabbed = false;
cardsSlider.classList.remove('active');
}

cardsSlider.addEventListener('mousedown', initializeDrag);
cardsSlider.addEventListener('mousemove', handleDragging);
cardsSlider.addEventListener('mouseleave', deInitializeDrag);
cardsSlider.addEventListener('mouseup', deInitializeDrag);
}


function mainImageSlider(){
var productImageSlider=$("#product-image-slider");
productImageSlider.owlCarousel({
    margin: 3,
    items: 1,
    center: true,
    controls: false,
    loop: true,
    controls: true,
    // autoplay:true,
    // autoplayTimeout:3000,
    // autoplayHoverPause: true,
    nav: false,
    touchDrag  : false,
    mouseDrag  : false,
    responsive: {
        0: {
            items: 1,
            stagePadding:40,
            mousedrag: true,
        },
        768: {
            items: 1,
            margin: 15,
            stagePadding:40,
            mousedrag: true,
        },
            1000: {
            items: 1,
            mousedrag: true,
        }
    }
});
$(".next").click(function () {
    productImageSlider.trigger('next.owl.carousel');
});

$(".prev").click(function () {
    productImageSlider.trigger('prev.owl.carousel', [300]);
});
}

function suggestedProductSlider(){
var suggestProductSlider=$(".suggested-product");
suggestProductSlider.owlCarousel({
    margin: 15,
    loop: true,
    rewind: true,
    controls: false,
    controls: true,
    nav: false,
    mouseDrag:false,
    responsive: {
        0: {
            items: 1,
        },
        768: {
            items: 1,
        },
            1000: {
            items: 3,
        }
    }
});
$(".next").click(function () {
    suggestProductSlider.trigger('next.owl.carousel');
});

$(".prev").click(function () {
    suggestProductSlider.trigger('prev.owl.carousel', [300]);
});
}
// suggestedProductSlider();


function suggestedProductSubSlide(){
var productImageSlider1=$(".suggested-product-image-slider");
productImageSlider1.owlCarousel({
    margin: 3,
    items: 1,
    center: true,
    controls: false,
    loop: true,
    controls: true,
    // autoplay:true,
    // autoplayTimeout:3000,
    // autoplayHoverPause: true,
    nav: false,
    touchDrag  : true,
    mouseDrag  : true,
    responsive: {
    0: {
    items: 1,
    stagePadding:0,
    mousedrag: true,
    },
    768: {
    items: 1,
    margin: 15,
    stagePadding:0,
    mousedrag: true,
    },
    1000: {
    items: 1,
    mousedrag: true,
    }
    }
});
}



function suggestedProductSectionToggle() {
$('.temp-section-one').show();
$('.temp-section-two').hide();
$('.suggested-product-list').addClass('active');
$( ".temp-show-hide" ).click(function() {
    var id = $(this).data('id');
    $('.'+id).toggleClass('active');
    $('.'+id+' .temp-section-one').toggle();
    $('.'+id+' .temp-section-two').toggle();  

});

$( ".suggested-product-list .add-cart-button" ).click(function() {
    var id = $(this).data('id');
    $('.'+id+' .action-button').attr('data-type','addToCart');
    $('.'+id).toggleClass('active');
    $('.'+id+' .temp-section-one').toggle();
    $('.'+id+' .temp-section-two').toggle(); 
    setTimeout(function() {
        
        //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
        checkRelatedDefaultQuantity();
        onloadproductfunction();
    },500);

});

$( ".suggested-product-list .order-now" ).click(function() {
    var id = $(this).data('id');
    $('.'+id+' .action-button').attr('data-type','orderNow');
    $('.'+id).toggleClass('active');
    $('.'+id+' .temp-section-one').toggle();
    $('.'+id+' .temp-section-two').toggle();  
    setTimeout(function() {
        //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
        checkRelatedDefaultQuantity();
        onloadproductfunction();
    },500);

});
}

function suggestedProductSectionToggle1() {
// $('.temp-section-one').show();
// $('.temp-section-two').hide();
$('.suggested-product-list').addClass('active');
$( ".temp-show-hide" ).click(function() {
    var id = $(this).data('id');
    $('.'+id).toggleClass('active');
    $('.'+id+' .temp-section-one').toggle();
    $('.'+id+' .temp-section-two').toggle();  

});

$( ".suggested-product-list .add-cart-button" ).click(function() {
    var id = $(this).data('id');
    $('.'+id+' .action-button').attr('data-type','addToCart');
    $('.'+id).toggleClass('active');
    $('.'+id+' .temp-section-one').toggle();
    $('.'+id+' .temp-section-two').toggle();  
    onloadproductfunction();

});

$( ".suggested-product-list .order-now" ).click(function() {
    var id = $(this).data('id');
    $('.'+id+' .action-button').attr('data-type','orderNow');
    $('.'+id).toggleClass('active');
    $('.'+id+' .temp-section-one').toggle();
    $('.'+id+' .temp-section-two').toggle();  
    onloadproductfunction();

});
}



var productCode = $('#productCode').val();
var url = 'api/product/'+productCode;

function getProductInfo(){

fetch(url).then((data)=>{
    return data.json();
}).then((objectData)=>{
    var strengthData = JSON.stringify(objectData['strength']);
    var quantityData = JSON.stringify(objectData['quantity']);
    let productCode = objectData['product'].code;
    var productImage = objectData['product'].image;
        let fLen = productImage.length;
        var imageElement1 = ``;
        for (let i = 0; i < fLen; i++) {
            if(i==0){
                var classImage = 'active';
            }else{
                var classImage = '';
            }
            imageElement1 = imageElement1 +`
            <div class="image-item product-gallery-preview-item active">
                <img class="image-zoom" src="https://myglobal1.gumlet.io/onglobaladmincrm/`+productImage[i]+`" data-zoom="https://myglobal1.gumlet.io/onglobaladmincrm/`+productImage[i]+`" alt="Product image">
                <div class="image-zoom-pane"></div>
            </div>
            `;
        }
    
    var productName = objectData['product'].name;
    var protype = objectData['product'].productType;
    var usaAvail = objectData['product'].usaAvail;
    var brand = objectData['product'].brand;
    var generic = objectData['product'].generic;
    var globeAvail = objectData['product'].globeAvail;
    var type = objectData['product'].type;
    if(type=='global'){
        $('#checkbox').attr('checked', false); // Unchecks it
        if(usaAvail==1){
            var usaCode = objectData['product'].usaCode;
            $('.main-product-data').find('.shipping-toggle').css('visibility','visible');
            $('.main-product-data').find('.shipping-toggle input').attr('data-code',usaCode);
            
        }else {
            $('.main-product-data').find('.shipping-toggle').hide();
            $('.main-product-data').find('.shipping-toggle input').attr('disabled', true);
            $('.main-product-data').find('.shipping-toggle').attr('checked', false);
        }
    }else {
        $('.custome-pill-button').hide();
        $('#checkbox').attr('checked', true); // Unchecks it
        if(globeAvail==1){
            var globeCode = objectData['product'].globeCode;
            // alert(globeCode);
            $('.main-product-data').find('.shipping-toggle').css('visibility','visible');
            $('.main-product-data').find('.shipping-toggle input').attr('data-code',globeCode);
        }else {
            $('.main-product-data').find('.shipping-toggle').hide();

            $('.main-product-data').find('.shipping-toggle input').attr('disabled', true);
            $('.main-product-data').find('.shipping-toggle').attr('checked', true);
        }
    }
    var productCategory = objectData['product'].category;
    
    var productdescription = objectData['product'].description;
    var productuse = objectData['product'].use;
    var productsideeffect = objectData['product'].sideeffect;
    var productwarning = objectData['product'].warning;
    var productinteraction = objectData['product'].interaction;
    var productstorage = objectData['product'].storage;
    var productsymptoms = objectData['product'].symptoms;
    var productabuse = objectData['product'].abuse;
    var manufacture = objectData['product'].manufacture;


    $('#product-image-slider').html(imageElement1);
    for (var e = document.querySelectorAll(".image-zoom"), t = 0; t < e.length; t++) new Drift(e[t], {
        paneContainer: e[t].parentElement.querySelector(".image-zoom-pane")
    })
    $('.product-link').find('p').removeClass('placeholder');
    $('.product-link').find('p').css('width','auto');
    $('.category-link').find('p').removeClass('placeholder');
    $('.product-link').find('p').html(productName);
    $('.product-type').html(protype);
    
    let weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
    ];
    if(productName.includes('to US')){
        var d1 = new Date();
        d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
        d1.setDate(d1.getDate() + 5);
        var month = d1.getMonth() + 1; //months from 1-12
        var day = d1.getDate();
        var week = d1.getDay() + 1; //months from 1-12
        var year = d1.getFullYear();

        $('.main-box-ship .product-use .expected-dates .list .date-a').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
        $('.shipping-info .expected-dates .list .date-a').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
        var d2 = new Date();
        d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
        d2.setDate(d2.getDate() + 7);
        var month = d2.getMonth() + 1; //months from 1-12
        var day = d2.getDate();
        var week = d2.getDay() + 1; //months from 1-12
        var year = d2.getFullYear();

        $('.main-box-ship .product-use .expected-dates .list .date-e').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
        $('.shipping-info .expected-dates .list .date-e').html(month+'-'+day+'-'+year+' '+weekday[week-1]);

    }else {
        var d1 = new Date();
        d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
        d1.setDate(d1.getDate() + 18);
        var month = d1.getMonth() + 1; //months from 1-12
        var day = d1.getDate();
        var week = d1.getDay() + 1; //months from 1-12
        var year = d1.getFullYear();
    

        $('.main-box-ship .product-use .expected-dates .list .date-a').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
        $('.shipping-info .expected-dates .list .date-a').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
        var d2 = new Date();
        d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
        d2.setDate(d2.getDate() + 21);
        var month = d2.getMonth() + 1; //months from 1-12
        var day = d2.getDate();
        var week = d2.getDay() + 1; //months from 1-12
        var year = d2.getFullYear();

        $('.main-box-ship .product-use .expected-dates .list .date-e').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
        $('.shipping-info .expected-dates .list .date-e').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
    }
    $('.main-product-data .product-name .name').html(productName);
    $('title').html(productName);
    
    $('.main-product-data .category-link p').html(productCategory);

    $('.main-product-data .product-name p.ingredient').html('('+generic+')');
    $('.main-product-data .image-slider-box .cat-stick').html(productCategory);
    $('.brand .info .value').html(brand.slice(0, -2));
    $('.category-link p').html("<a href='"+(productCategory.toLowerCase()).split(' ').join('-')+"'>"+productCategory+"</a>");
    $('.product-link p').html(productName);
    $('#description .accordion-body').html(productdescription);
    $('#use .accordion-body').html(productuse);
    $('#sideeffects .accordion-body').html(productsideeffect);
    $('#warningprecautions .accordion-body').html(productwarning);
    $('#druginteractions .accordion-body').html(productinteraction);
    $('#abuse .accordion-body').html(productabuse);
    $('#symptoms .accordion-body').html(productsymptoms);
    $('#storage .accordion-body').html(productstorage);
    $('.product-info .info-list .list .info .value span').html(manufacture)

    $('.main-product-data .product-calculation').addClass(productCode);

    var width ='';

    if(productName == 'Hucog'){
       var width = 'fit-content'
    }

    function strength(data) {
        $('.strength-slider-inner').html('');
        $.each(JSON.parse(data), function(key, value){
            var strength = key;
            var result = Object.entries(value);
            var strnStatus = result[0][1];
            var strnCode = result[1][1];
            if(strnStatus==1){
                var status = 'active';
            }else {
                var status ='';
            }
            let strengthData = '<a href="#'+strnCode+'" draggable="false" class="nav-link '+status+' '+width+'" data-bs-toggle="tab" role="tab"><span>'+strength+'</span></a>';
            $('.main-product-data .strength-slider-inner').append(strengthData);    
        });
        
        // $(".strength-slider-inner").draggable({axis: "x", containment: '.overflow', scroll: false});

    }
    
    function quantity(data) {
        $('.product-quantity').html(''); 
        $.each(JSON.parse(data), function(key,value){
            var newdata = JSON.parse(quantityData);
            var result = Object.entries(newdata[key]);
            var strCode = result[0][1];
            var leastPrice = result[3][1];
            var strStatus = result[1][1];
            var quantity = result[2][1];
            var quantity = result[2][1];
            var quantity = JSON.stringify(quantity);
            if(strStatus==1){
                var tabclass = 'show active';
            }else {
                var tabclass = ''
            }
            // console.log(result1);
            var strength = key; 
            var postFix;
            if(productCategory=='Injectable Steroids' || productCategory=='Oral Steroids'){
                $('.pills-label').html('<img src="image/quantity.png"> <div class="'+productCategory+'" id="category-identity">Select Quantities Of Box</div>')
                // $('.manufacture .info .value').html('Kosher Pharmaceuticals')
                $('.product-desc-label').show();
                postFix = "";
            } else{
                $('.pills-label').html('<img src="image/quantity.png"> <div class="'+productCategory+'" id="category-identity">Select Quantity Of Pills</div>')
                // $('.manufacture .info .value').html('Registered and Reputed manufacturers from India')
                $('.product-desc-label').hide();
                postFix ="s";
            }
            if(type=='global' && productCategory!='Injectable Steroids' && productCategory!='Oral Steroids'){
                data = `
                <div class="tab-pane fade `+tabclass+`" id="`+strCode+`" role="tabpanel">
                `;
            }else {
                data = `
                <div class="tab-pane fade usa-box `+tabclass+`" style="padding-top:0px;" id="`+strCode+`" role="tabpanel">
                `; 
            }

            if(productCategory=='Injectable Steroids'){
                $('.product-desc-label').html('Box Details : 1 Box contains 10 ampoules')
            } else{
                $('.product-desc-label').html('Box Details : 1 Box contains 100 Pills')
            }

            if(type=='global' && productCategory!='Injectable Steroids' && productCategory!='Oral Steroids'){

            data = data + `<div class="pillsInstruction">
                <img src="https://myglobal1.gumlet.io/product-quantity/pillins.gif" class="pillins-image">
                Offer on order of <span class="noPills">600 Pills</span> for at <span class="leastPrice">$`+leastPrice+`/pill</span>
            </div>`;
            }
            var qtyNum=0;
            $.each(JSON.parse(quantity), function(key1, value1){
                
                let qty = key1;
                var qtyResult = Object.entries(value1);
                var code  = qtyResult[0][1];
                var price = qtyResult[1][1];
                var ogprice = qtyResult[2][1];
                var active = qtyResult[3][1];
                var oncart = qtyResult[4][1];
                var discount = qtyResult[5][1];
                if(qtyResult[6][1]){
                    var usa = Object.entries(qtyResult[7][1]);
                    var usacode  = usa[0][1];
                    var usaprice = usa[1][1];
                    var usaogprice = usa[2][1];
                    var usaoncart = usa[3][1];
                    var usadiscount = usa[4][1];
                    var usaqty= usa[5][1];
                }
                if(discount>0){
                    var discountBlock = ` <div class="quantity-offer">
                                `+discount+`% Off
                        </div>`;
                }else {
                    var discountBlock = ``;
                }
                if(active==1) {
                    var qtyClass = ' ';
                    if(productCategory=='Injectable Steroids' || productCategory=='Oral Steroids')
                    {
                        postFix = '';
                    } else{
                        postFix = 's';
                    }
                }else {
                    var qtyClass = '';
                    postFix = 's'
                }
                qtyNum++;
                if(qtyResult[6][1]){
                    data = data + `
                    <div class="quantity-item `+qtyClass+` pro" 
                    data-type='main' 
                    data-orders="`+qtyNum+`"
                    data-discount="`+discount+`" 
                    data-qty="`+qty+`" 
                    data-cart="`+oncart+`" 
                    data-section='`+productCode+`' 
                    data-price="`+price+`" 
                    data-ogprice="`+(price*qty).toFixed(2)+`" 
                    data-code="`+code+`"
                    data-is-usa="`+1+`"
                    data-usa-enable="`+0+`"
                    data-usa-type='main' 
                    data-usa-discount="`+usadiscount+`" 
                    data-usa-qty="`+usaqty+`" 
                    data-usa-cart="`+usaoncart+`" 
                    data-usa-section='`+productCode+`' 
                    data-usa-price="`+usaprice+`" 
                    data-usa-ogprice="`+(usaprice*usaqty).toFixed(2)+`" 
                    data-usa-code="`+usacode+`"
                    data-pro-type="`+protype+`"
                    data-usa-global-type="`+type+`"
                    >
                        <div class="quantity-pricing">
                            <div class="quantity-pill">
                                `+qty+` `+protype+``+postFix+`
                            </div>
                            <div class="price-wrapper">
                            <div class="price">
                                $`+((price)-((price)*(discount/100))).toFixed(2)+`
                            </div>
                            <span class="proType">/`+protype+`</span>
                            </div>
                        </div>
                        <div class="quantity-pricing-calculation">
                            <div class="quantity-pricing-calculation-data">
                                <div class="quantity-total">
                                    $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                                </div>
                                <div class="quantity-total-non">
                                    <del>$`+(price*qty).toFixed(2)+`</del>
                                </div>
                            </div>
                            
                            <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />
                            
                            `+discountBlock+`
                        </div>
                    </div>
                    `;
                }else {
                data = data + `
                <div class="quantity-item `+qtyClass+`" data-usa-global-type="`+type+`" data-pro-type="`+protype+`" data-orders="`+qtyNum+`"  data-usa-enable="`+0+`" data-is-usa="`+0+`" data-type='main' data-discount="`+discount+`" data-qty="`+qty+`" data-cart="`+oncart+`" data-section='`+productCode+`' data-price="`+price+`" data-ogprice="`+(price*qty).toFixed(2)+`" data-code="`+code+`">
                    <div class="quantity-pricing">
                        <div class="quantity-pill">
                            `+qty+` `+protype+``+postFix+`
                        </div>
                        <div class="price-wrapper">
                        <div class="price">
                            $`+((price)-((price)*(discount/100))).toFixed(2)+`
                        </div>
                        <span class="proType">/`+protype+`</span>
                        </div>
                    </div>
                    <div class="quantity-pricing-calculation">
                        <div class="quantity-pricing-calculation-data">
                            <div class="quantity-total">
                                $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                            </div>
                            <div class="quantity-total-non">
                                <del>$`+(price*qty).toFixed(2)+`</del>
                            </div>
                        </div>
                        <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />
                        `+discountBlock+`
                    </div>
                </div>
                `;}
            });
                
            
            
            
                    
            data = data +`</div>`;

            $('.main-product-data .product-quantity').append(data); 
            $("[data-qty=30]").hide();
            $('.quantity-item:last-child()').addClass('active');
        });
        // $('.main-product-data .product-quantity .tab-pane').append('<div class="pillIndicator"></div>'); 
    }
    
    quantity(quantityData)

    strength(strengthData)

    onloadproductfunction();
    mainImageSlider();


    // $('.flickity-slider').addClass('nav-item');
    // $('.flickity-viewport').addClass('nav');
    // $('.flickity-viewport').addClass('nav-tabs');
        
})
}



$('#checkbox').change(function() {
$('#product-image-slider').trigger("destroy.owl.carousel");
$('.productShipChange').css('display','flex');
var code = $(this).attr('data-code');
url = 'api/product/'+code;

    fetch(url).then((data)=>{
        return data.json();
    }).then((objectData)=>{
        console.log(objectData)
        $('.productShipChange').css('display','none');
        var strengthData = JSON.stringify(objectData['strength']);
        var quantityData = JSON.stringify(objectData['quantity']);
        let productCode = objectData['product'].code;
        var productImage = objectData['product'].image;
            let fLen = productImage.length;
            var imageElement1 = ``;
            for (let i = 0; i < fLen; i++) {
                if(i==0){
                    var classImage = 'active';
                }else{
                    var classImage = '';
                }
                imageElement1 = imageElement1 +`
                <div class="image-item product-gallery-preview-item active">
                    <img class="image-zoom" src="https://myglobal1.gumlet.io/onglobaladmincrm/`+productImage[i]+`" data-zoom="https://myglobal1.gumlet.io/onglobaladmincrm/`+productImage[i]+`" alt="Product image">
                    <div class="image-zoom-pane"></div>
                </div>
                `;
            }
        
        var productName = objectData['product'].name;
        var protype = objectData['product'].productType;
        var usaAvail = objectData['product'].usaAvail;
        var brand = objectData['product'].brand;
        var generic = objectData['product'].generic;
        var globeAvail = objectData['product'].globeAvail;
        var type = objectData['product'].type;
        if(type=='global'){
            $('#checkbox').attr('checked', false); // Unchecks it
            if(usaAvail==1){
                var usaCode = objectData['product'].usaCode;
                $('.main-product-data').find('.shipping-toggle').css('visibility','visible');
                $('.main-product-data').find('.shipping-toggle input').attr('data-code',usaCode);
                
            }else {
                $('.main-product-data').find('.shipping-toggle input').hide();
                $('.main-product-data').find('.shipping-toggle').attr('checked', false);
            }
        }else {
            $('.custome-pill-button').hide();
            $('#checkbox').attr('checked', true); // Unchecks it
            if(globeAvail==1){
                var globeCode = objectData['product'].globeCode;
                $('.main-product-data').find('.shipping-toggle').css('visibility','visible');
                $('.main-product-data').find('.shipping-toggle input').attr('data-code',globeCode);
            }else {
                $('.main-product-data').find('.shipping-toggle').hide();
            }
        }
        var productCategory = objectData['product'].category;
        
        var productdescription = objectData['product'].description;
        var productuse = objectData['product'].use;
        var productsideeffect = objectData['product'].sideeffect;
        var productwarning = objectData['product'].warning;
        var productinteraction = objectData['product'].interaction;

        $('#product-image-slider').html(imageElement1);
        for (var e = document.querySelectorAll(".image-zoom"), t = 0; t < e.length; t++) new Drift(e[t], {
            paneContainer: e[t].parentElement.querySelector(".image-zoom-pane")
        })
        $('.product-link p').html(productName);
        let weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        if(productName.includes('to US')){
            var d1 = new Date();
            d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d1.setDate(d1.getDate() + 5);
            var month = d1.getMonth() + 1; //months from 1-12
            var day = d1.getDate();
            var week = d1.getDay() + 1; //months from 1-12
            var year = d1.getFullYear();

            $('.main-box-ship .product-use .expected-dates .list .date-a').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
            var d2 = new Date();
            d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d2.setDate(d2.getDate() + 7);
            var month = d2.getMonth() + 1; //months from 1-12
            var day = d2.getDate();
            var week = d2.getDay() + 1; //months from 1-12
            var year = d2.getFullYear();

            $('.main-box-ship .product-use .expected-dates .list .date-e').html(month+'-'+day+'-'+year+' '+weekday[week-1]);

        }else {
            var d1 = new Date();
            d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d1.setDate(d1.getDate() + 15);
            var month = d1.getMonth() + 1; //months from 1-12
            var day = d1.getDate();
            var week = d1.getDay() + 1; //months from 1-12
            var year = d1.getFullYear();

            $('.main-box-ship .product-use .expected-dates .list .date-a').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
            var d2 = new Date();
            d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d2.setDate(d2.getDate() + 10);
            var month = d2.getMonth() + 1; //months from 1-12
            var day = d2.getDate();
            var week = d2.getDay() + 1; //months from 1-12
            var year = d2.getFullYear();

            $('.main-box-ship .product-use .expected-dates .list .date-e').html(month+'-'+day+'-'+year+' '+weekday[week-1]);
        }
        $('.main-product-data .product-name .name').html(productName);
        $('title').html(productName);
        $('.main-product-data .product-name p.ingredient').html('('+generic+')');
        $('.main-product-data .category-link p').html(productCategory);
        $('.main-product-data .image-slider-box .cat-stick').html(productCategory);
        $('.brand .info .value').html(brand.slice(0, -1));
        $('.category-link p').html("<a href='"+(productCategory.toLowerCase()).split(' ').join('-')+"'>"+productCategory+"</a>");
        $('.product-link p').html(productName);
        $('#description .accordion-body').html(productdescription);
        $('#use .accordion-body').html(productuse);
        $('#sideeffects .accordion-body').html(productsideeffect);
        $('#warningprecautions .accordion-body').html(productwarning);
        $('#druginteractions .accordion-body').html(productinteraction);
        // $('#abuse .accordion-body').html(productabuse);
        // $('#symptoms .accordion-body').html(productsymptoms);
        // $('#storage .accordion-body').html(productstorage);

        $('.main-product-data .product-calculation').addClass(productCode);
        function strength(data) {
            $('.main-product-data .strength-slider-inner').html('');
            $.each(JSON.parse(data), function(key, value){
                var strength = key;
                var result = Object.entries(value);
                var strnStatus = result[0][1];
                var strnCode = result[1][1];
                if(strnStatus==1){
                    var status = 'active';
                }else {
                    var status ='';
                }
                let strengthData = '<a href="#'+strnCode+'" draggable="false" class="nav-link '+status+'" data-bs-toggle="tab" role="tab"><span>'+strength+'</span></a>';
                $('.main-product-data .strength-slider-inner').append(strengthData);    
            });

        }

        function quantity(data) {
            $('.main-product-data .product-quantity').html(''); 
            $.each(JSON.parse(data), function(key,value){
                var newdata = JSON.parse(quantityData);
                var result = Object.entries(newdata[key]);
                var strCode = result[0][1];
                var leastPrice = result[3][1];
                var strStatus = result[1][1];
                var quantity = result[2][1];
                var quantity = result[2][1];
                var quantity = JSON.stringify(quantity);
                if(strStatus==1){
                    var tabclass = 'show active';
                }else {
                    var tabclass = ''
                }
                // console.log(result1);
                var strength = key; 
                if(type=='global' && productCategory!='Injectable Steroids' && productCategory!='Oral Steroids'){
                    data = `
                    <div class="tab-pane fade `+tabclass+`" id="`+strCode+`" role="tabpanel">
                    `;
                }else {
                    data = `
                    <div class="tab-pane fade usa-box `+tabclass+`" style="padding-top:0px;" id="`+strCode+`" role="tabpanel">
                    `; 
                }

                if(type=='global' && productCategory!='Injectable Steroids' && productCategory!='Oral Steroids'){

                data = data + `<div class="pillsInstruction">
                    <img src="https://myglobal1.gumlet.io/product-quantity/pillins.gif" class="pillins-image">
                    Offer on order of <span class="noPills">600 Pills</span> for at <span class="leastPrice">$`+leastPrice+`/pill</span>
                </div>`;
                }
                var qtyNum=0;
                $.each(JSON.parse(quantity), function(key1, value1){
                    let qty = key1;
                    var qtyResult = Object.entries(value1);
                    var code  = qtyResult[0][1];
                    var price = qtyResult[1][1];
                    var ogprice = qtyResult[2][1];
                    var active = qtyResult[3][1];
                    var oncart = qtyResult[4][1];
                    var discount = qtyResult[5][1];
                    if(qtyResult[6][1]){
                        var usa = Object.entries(qtyResult[7][1]);
                        var usacode  = usa[0][1];
                        var usaprice = usa[1][1];
                        var usaogprice = usa[2][1];
                        var usaoncart = usa[3][1];
                        var usadiscount = usa[4][1];
                        var usaqty= usa[5][1];
                    }
                    if(discount>0){
                        var discountBlock = ` <div class="quantity-offer">
                                    `+discount+`% Off
                            </div>`;
                    }else {
                        var discountBlock = ``;
                    }
                    if(active==1) {
                        var qtyClass = ' ';
                    }else {
                        var qtyClass = '';
                    }
                    qtyNum++;
                    if(qtyResult[6][1]){
                        data = data + `
                        <div class="quantity-item `+qtyClass+`" 
                        data-orders="`+qtyNum+`"
                        data-type='main' 
                        data-discount="`+discount+`" 
                        data-qty="`+qty+`" 
                        data-cart="`+oncart+`" 
                        data-section='`+productCode+`' 
                        data-price="`+price+`" 
                        data-ogprice="`+(price*qty).toFixed(2)+`" 
                        data-code="`+code+`"
                        data-is-usa="`+1+`"
                        data-usa-enable="`+0+`"
                        data-usa-type='main' 
                        data-usa-discount="`+usadiscount+`" 
                        data-usa-qty="`+usaqty+`" 
                        data-usa-cart="`+usaoncart+`" 
                        data-usa-section='`+productCode+`' 
                        data-usa-price="`+usaprice+`" 
                        data-usa-ogprice="`+(usaprice*usaqty).toFixed(2)+`" 
                        data-usa-code="`+usacode+`"
                        data-pro-type="`+protype+`"
                        data-usa-global-type="`+type+`"
                        >
                            <div class="quantity-pricing">
                                <div class="quantity-pill">
                                    `+qty+` `+protype+`
                                </div>
                                <div class="price-wrapper">
                                <div class="price">
                                    $`+((price)-((price)*(discount/100))).toFixed(2)+`
                                </div>
                                <span class="proType">/`+protype+`</span>
                            </div>
                            </div>
                            <div class="quantity-pricing-calculation">
                                <div class="quantity-pricing-calculation-data">
                                    <div class="quantity-total">
                                        $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                                    </div>
                                    <div class="quantity-total-non">
                                        <del>$`+(price*qty).toFixed(2)+`</del>
                                    </div>
                                </div>
                            <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />
                                `+discountBlock+`
                            </div>
                        </div>
                        `;
                    }else {
                    data = data + `
                    <div class="quantity-item `+qtyClass+`" data-usa-global-type="`+type+`" data-pro-type="`+protype+`" data-orders="`+qtyNum+`" data-usa-enable="`+0+`" data-is-usa="`+0+`" data-type='main' data-discount="`+discount+`" data-qty="`+qty+`" data-cart="`+oncart+`" data-section='`+productCode+`' data-price="`+price+`" data-ogprice="`+(price*qty).toFixed(2)+`" data-code="`+code+`">
                        <div class="quantity-pricing">
                            <div class="quantity-pill">
                                `+qty+` `+protype+`
                            </div>
                            <div class="price-wrapper">
                            <div class="price">
                                $`+((price)-((price)*(discount/100))).toFixed(2)+`
                            </div>
                            <span class="proType">/`+protype+`</span>
                        </div>
                        </div>
                        <div class="quantity-pricing-calculation">
                            <div class="quantity-pricing-calculation-data">
                                <div class="quantity-total">
                                    $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                                </div>
                                <div class="quantity-total-non">
                                    <del>$`+(price*qty).toFixed(2)+`</del>
                                </div>
                            </div>
                        <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />

                            `+discountBlock+`
                        </div>
                    </div>
                    `;}
                });
                    
                
                
                
                        
                data = data +`</div></div>`;

                $('.main-product-data .product-quantity').append(data); 
                $("[data-qty=30]").hide();
                $('.quantity-item:last-child()').addClass('active');

            });
        }
        
        quantity(quantityData)
        strength(strengthData)

        onloadproductfunction();
        checkDefaultQuantity();
        mainImageSlider();
        setTimeout(function() {
            //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
            customeQty();

        slider();
        },500);
    })

});


function getRelatedProduct() {
fetch('api/relatedProduct/'+productCode).then((data)=>{
    return data.json();
}).then((objectData)=>{
    var products = JSON.stringify(objectData);
    $.each(JSON.parse(products), function(key1, value1){
        // if(key==2){
        var strengthData = JSON.stringify(value1['strength']);
        var quantityData = JSON.stringify(value1['quantity']);
        let productCode = value1['product'].code;
        let protype = value1['product'].productType;
        let productCategory = value1['product'].category
        let type = value1['product'].type
        function strength(data) {
            let strengthList='';
            $.each(JSON.parse(data), function(key, value){
                var strength = key;
                var result = Object.entries(value);
                var strnStatus = result[0][1];
                var strnCode = result[1][1];
                if(strnStatus==1){
                    var status = 'active';
                }else {
                    var status ='';
                }
                strengthList = strengthList+'<a href="#'+strnCode+'" draggable="false" class="nav-link '+status+'" data-bs-toggle="tab" role="tab"><span>'+strength+'</span></a><br>'; 
            });
        $('.slide'+key1+' .temp-section-two  .strength-slider-inner').append(strengthList);
      
        }
        var slidenum = key1;
        function quantity(data) {
            data;
            $.each(JSON.parse(data), function(key,value){
                var newdata = JSON.parse(quantityData);
                var result = Object.entries(newdata[key]);
                var strCode = result[0][1];
                var strStatus = result[1][1];
                var quantity = result[2][1];
                var quantity = result[2][1];
                var quantity = JSON.stringify(quantity);
                if(strStatus==1){
                    var tabclass = 'show active';
                }else {
                    var tabclass = ''
                }
                // console.log(result1);
                var strength = key; 
                var postFix;

                let data = `<div class="tab-pane fade `+tabclass+`" id="`+strCode+`" role="tabpanel">`;
                var qtyNum=0;
                $.each(JSON.parse(quantity), function(key1, value1){
                    let qty = key1;
                    var qtyResult = Object.entries(value1);
                    var code  = qtyResult[0][1];
                    var price = qtyResult[1][1];
                    var ogprice = qtyResult[2][1];
                    var active = qtyResult[3][1];
                    var oncart = qtyResult[4][1];
                    var discount = qtyResult[5][1];
                    if(qtyResult[6][1]){
                        var usa = Object.entries(qtyResult[7][1]);
                        var usacode  = usa[0][1];
                        var usaprice = usa[1][1];
                        var usaogprice = usa[2][1];
                        var usaoncart = usa[3][1];
                        var usadiscount = usa[4][1];
                        var usaqty= usa[5][1];
                    }
                    if(discount>0){
                        var discountBlock = ` <div class="quantity-offer">
                                    `+discount+`% Off
                            </div>`;
                    }else {
                        var discountBlock = ``;
                    }
                    if(active==1) {
                        var qtyClass = ' ';
                        if(productCategory=='Injectable Steroids' || productCategory=='Oral Steroids')
                        {
                            postFix = '';
                        } else{
                            postFix = 's';
                        }
                    }else {
                        var qtyClass = '';
                        postFix = 's'
                    }
                    qtyNum++;
                    if(qtyResult[6][1]){
                        data = data + `
                        <div class="quantity-item `+qtyClass+`" 
                        data-orders="`+qtyNum+`"
                        data-type='sub' 
                        data-discount="`+discount+`" 
                        data-qty="`+qty+`" 
                        data-slide-number = "`+slidenum+`" 
                        data-cart="`+oncart+`" 
                        data-section='`+productCode+`' 
                        data-price="`+price+`" 
                        data-ogprice="`+(price*qty).toFixed(2)+`" 
                        data-code="`+code+`"
                        data-is-usa="`+1+`"
                        data-usa-enable="`+0+`"
                        data-usa-type='sub' 
                        data-usa-discount="`+usadiscount+`" 
                        data-usa-slide-number = "`+slidenum+`" 
                        data-usa-qty="`+usaqty+`" 
                        data-usa-cart="`+usaoncart+`" 
                        data-usa-section='`+productCode+`' 
                        data-usa-price="`+usaprice+`" 
                        data-usa-ogprice="`+(usaprice*usaqty).toFixed(2)+`" 
                        data-usa-code="`+usacode+`"
                    data-pro-type="`+protype+`"
                    data-usa-global-type="`+type+`"

                        >
                            <div class="quantity-pricing">
                                <div class="quantity-pill">
                                    `+qty+` `+protype+``+postFix+`
                                </div>
                                <div class="price-wrapper">
                                <div class="price">
                                    $`+((price)-((price)*(discount/100))).toFixed(2)+`
                                </div>
                                <span class="proType">/`+protype+`</span>

                                </div>
                            </div>
                            <div class="quantity-pricing-calculation">
                                <div class="quantity-pricing-calculation-data">
                                    <div class="quantity-total">
                                        $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                                    </div>
                                    <div class="quantity-total-non">
                                        <del>$`+(price*qty).toFixed(2)+`</del>
                                    </div>
                                </div>
                            <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />
                                `+discountBlock+`
                            </div>
                        </div>
                        `;
                    }else {
                    data = data + `
                    <div class="quantity-item `+qtyClass+`" 
                    data-usa-global-type="`+type+`"
                        data-pro-type="`+protype+`"
                        data-orders="`+qtyNum+`"
                        data-usa-enable="`+0+`" 
                        data-is-usa="`+0+`" 
                        data-type='sub' 
                        data-discount="`+discount+`" 
                        data-qty="`+qty+`" 
                        data-cart="`+oncart+`" 
                        data-section='`+productCode+`' 
                        data-price="`+price+`" 
                        data-ogprice="`+(price*qty).toFixed(2)+`" 
                        data-code="`+code+`"
                        data-slide-number = "`+slidenum+`"
                        >
                        <div class="quantity-pricing">
                            <div class="quantity-pill">
                                `+qty+` `+protype+``+postFix+`
                            </div>
                            <div class="price-wrapper">
                            <div class="price">
                                $`+((price)-((price)*(discount/100))).toFixed(2)+`
                            </div>
                            <span class="proType">/`+protype+`</span>

                            </div>
                        </div>
                        <div class="quantity-pricing-calculation">
                            <div class="quantity-pricing-calculation-data">
                                <div class="quantity-total">
                                    $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                                </div>
                                <div class="quantity-total-non">
                                    <del>$`+(price*qty).toFixed(2)+`</del>
                                </div>
                            </div>
                            <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />
                            `+discountBlock+`
                        </div>
                    </div>
                    `;}
                });
                    
                
                
                
                        
                data = data +`</div>`;
                $('.slide'+key1+' .temp-section-two .product-quantity').append(data);
                $("[data-qty=30]").hide();
                $('.quantity-item:last-child()').addClass('active');
                slider1(key1);
                autoRelatedCustomQty('.slide'+key1);
                
            });
            return data;
        }

        strength(strengthData);
        quantity(quantityData);
        
        // console.log(strength(strengthData));
        // console.log(quantity(quantityData));
    // }
    });
    
})
setTimeout(function() {
    //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
    checkRelatedDefaultQuantity(); 
    onloadproductfunction();
},4500);
}

function getCheckRelatedSingleProduct(x,y) {
$('.slide'+y+' .temp-section-two  .strength-slider-inner').html('');
$('.slide'+y+' .temp-section-two .product-quantity').html('');
fetch('api/singleRelatedProduct/'+x).then((data)=>{
    return data.json();
}).then((objectData)=>{
    var products = JSON.stringify(objectData);
    $.each(JSON.parse(products), function(key1, value1){
        // if(key==2){
        var strengthData = JSON.stringify(value1['strength']);
        var quantityData = JSON.stringify(value1['quantity']);
        let productCode = value1['product'].code;
        if(productCode==x){

            function strength(data) {
                let strengthList='';
                $.each(JSON.parse(data), function(key, value){
                    var strength = key;
                    var result = Object.entries(value);
                    var strnStatus = result[0][1];
                    var strnCode = result[1][1];
                    if(strnStatus==1){
                        var status = 'active';
                    }else {
                        var status ='';
                    }
                    strengthList = strengthList+'<a href="#'+strnCode+'" draggable="false" class="nav-link '+status+'" data-bs-toggle="tab" role="tab"><span>'+strength+'</span></a><br>'; 
                });
            $('.slide'+y+' .temp-section-two  .strength-slider-inner').html(strengthList);
            
        
            }
            let datanew="";
            function quantity(data) {
                $.each(JSON.parse(data), function(key,value){
                    var newdata = JSON.parse(quantityData);
                    var result = Object.entries(newdata[key]);
                    var strCode = result[0][1];
                    var strStatus = result[1][1];
                    var quantity = result[2][1];
                    var quantity = result[2][1];
                    var quantity = JSON.stringify(quantity);
                    if(strStatus==1){
                        var tabclass = 'show active';
                    }else {
                        var tabclass = ''
                    }
                    // console.log(result1);
                    var strength = key; 
                    datanew = datanew + `<div class="tab-pane fade `+tabclass+`" id="`+strCode+`" role="tabpanel">`;
                    var qtyNum=0;
                    $.each(JSON.parse(quantity), function(key1, value1){
                        let qty = key1;
                        var qtyResult = Object.entries(value1);
                        var code  = qtyResult[0][1];
                        var price = qtyResult[1][1];
                        var ogprice = qtyResult[2][1];
                        var active = qtyResult[3][1];
                        var oncart = qtyResult[4][1];
                        var discount = qtyResult[5][1];
                        if(qtyResult[6][1]){
                            var usa = Object.entries(qtyResult[7][1]);
                            var usacode  = usa[0][1];
                            var usaprice = usa[1][1];
                            var usaogprice = usa[2][1];
                            var usaoncart = usa[3][1];
                            var usadiscount = usa[4][1];
                            var usaqty= usa[5][1];
                        }
                        if(discount>0){
                            var discountBlock = ` <div class="quantity-offer">
                                        `+discount+`% Off
                                </div>`;
                        }else {
                            var discountBlock = ``;
                        }
                        if(active==1) {
                            var qtyClass = ' ';
                        }else {
                            var qtyClass = '';
                        }
                        qtyNum++;
                        if(qtyResult[6][1]){
                            datanew = datanew + `
                            <div class="quantity-item `+qtyClass+`"
                            data-orders="`+qtyNum+`" 
                            data-type='sub' 
                            data-discount="`+discount+`" 
                            data-qty="`+qty+`" 
                            data-slide-number = "`+y+`"
                            data-cart="`+oncart+`" 
                            data-section='`+productCode+`' 
                            data-price="`+price+`" 
                            data-ogprice="`+(price*qty).toFixed(2)+`" 
                            data-code="`+code+`"
                            data-is-usa="`+1+`"
                            data-usa-enable="`+0+`"
                            data-usa-type='sub' 
                            data-usa-discount="`+usadiscount+`" 
                            data-usa-qty="`+usaqty+`" 
                            data-usa-cart="`+usaoncart+`" 
                            data-usa-section='`+productCode+`' 
                            data-usa-price="`+usaprice+`" 
                            data-usa-ogprice="`+(usaprice*usaqty).toFixed(2)+`" 
                            data-usa-code="`+usacode+`"
    
                            >
                                <div class="quantity-pricing">
                                    <div class="quantity-pill">
                                        `+qty+`
                                    </div>
                                    <div class="price-wrapper">
                                    <div class="price">
                                        $`+((price)-((price)*(discount/100))).toFixed(2)+`
                                    </div>
                                    </div>
                                </div>
                                <div class="quantity-pricing-calculation">
                                    <div class="quantity-pricing-calculation-data">
                                        <div class="quantity-total">
                                            $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                                        </div>
                                        <div class="quantity-total-non">
                                            <del>$`+(price*qty).toFixed(2)+`</del>
                                        </div>
                                    </div>
                                <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />

                                    `+discountBlock+`
                                </div>
                            </div>
                            `;
                        }else {
                        datanew = datanew + `
                        <div class="quantity-item `+qtyClass+`" 
                        data-orders="`+qtyNum+`"
                        data-usa-enable="`+0+`" 
                        data-is-usa="`+0+`" 
                        data-type='sub' 
                        data-discount="`+discount+`" 
                        data-qty="`+qty+`" 
                        data-cart="`+oncart+`" 
                        data-section='`+productCode+`' 
                        data-price="`+price+`" 
                        data-ogprice="`+(price*qty).toFixed(2)+`" 
                        data-code="`+code+`"
                        data-slide-number = "`+y+`"
                        >
                            <div class="quantity-pricing">
                                <div class="quantity-pill">
                                    `+qty+`
                                </div>
                                <div class="price-wrapper">
                                <div class="price">
                                    $`+((price)-((price)*(discount/100))).toFixed(2)+`
                                </div>
                                </div>
                            </div>
                            <div class="quantity-pricing-calculation">
                                <div class="quantity-pricing-calculation-data">
                                    <div class="quantity-total">
                                        $`+((price*qty)-((price*qty)*(discount/100))).toFixed(2)+`
                                    </div>
                                    <div class="quantity-total-non">
                                        <del>$`+(price*qty).toFixed(2)+`</del>
                                    </div>
                                </div>
                                <img class="gradient-check-box" src="image/productPageImg/pills-checkbox.png" />

                                `+discountBlock+`
                            </div>
                        </div>
                        `;}
                    });
                        
                    
                    
                    
                            
                    datanew = datanew +`</div>`;
                    
                
                });
                $('.slide'+y+' .temp-section-two .product-quantity').html(datanew);
                slider1(y);
                
            }
            
            strength(strengthData);
            quantity(quantityData);
            setTimeout(function() {
                //$("[data-orders=6]").hide();
                $("[data-orders=7]").hide();
                $('.slide'+y+' .custom-pills .custome-input-ins').hide();
                relatedchecker();
                // relatedchecker1()
                onloadproductfunction();
                $("[data-qty=30]").hide();
                $('.quantity-item:last-child()').addClass('active');
            }, 500);
            
            
        }

        
        

        // console.log(strength(strengthData));
        // console.log(quantity(quantityData));
    // }
    });
    
})
setTimeout(function() {
    checkRelatedDefaultQuantity();

    onloadproductfunction();
    customeRelatedButton();
    customeProductCalculate();
    //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
},4500);
}

function getCheckerRelatedProductBox(x,y) {

$('.productShipChange').css('display','flex');
let productBox='';
fetch('api/singleRelatedProduct/'+x).then((data)=>{
    return data.json();
}).then((objectData)=>{

    var products = JSON.stringify(objectData);
    $.each(JSON.parse(products), function(key, value){
        var productImage = value['product'].image;
        let fLen = productImage.length;
        var imageElement1 = ``;
        for (let i = 0; i < fLen; i++) {
            if(i==0){
                var classImage = 'active';
            }else{
                var classImage = '';
            }
            imageElement1 = imageElement1 +`
            <div class="image-item `+classImage+`">
                <img src="https://myglobal1.gumlet.io/onglobaladmincrm/`+productImage[i]+`" alt="Product image">
            </div>
            `;
        }
        var productName = value['product'].name;
        var proType = value['product'].productType;
        var productCategory = value['product'].category;
        var productCode = value['product'].code;

        var slug = value['product'].slug;

        var usaAvail = value['product'].usaAvail;
        var globeAvail = value['product'].globeAvail;
        var generic = value['product'].generic;
        var type = value['product'].type;
        if(type=='global'){
            var customeStatus = 'display: flex;';
            if(usaAvail==1){
                var usaCode = value['product'].usaCode;
                var shippingBox = `
                <div class="shipping-toggle">
                            
                <input type="checkbox" data-id='slide' data-code="`+usaCode+`" id="checkbox`+y+`" data-main-code="`+productCode+`" class="checkbox subchecked" />
                    <label for="checkbox`+y+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>
                `;
                
            }else {
                var shippingBox=`
                <div class="shipping-toggle">
                    <!--<input type="checkbox" data-id='slide' data-code="`+usaCode+`" id="checkbox`+key+`" disabled data-main-code="`+productCode+`" class="checkbox subchecked" />-->
                    <label for="checkbox`+key+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>`;
            }
        }else {

            var customeStatus = 'display: none;';
            if(globeAvail==1){
                var globeCode = value['product'].globeCode;
                var shippingBox = `
                <div class="shipping-toggle">
                            
                    <input type="checkbox" data-id='slide' data-code="`+globeCode+`" id="checkbox`+y+`" data-main-code="`+productCode+`" checked class="checkbox subchecked" />
                    <label for="checkbox`+y+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>`;
            }else {
                var shippingBox=`
                <div class="shipping-toggle">
                    <!--<input type="checkbox" data-id='slide' data-code="`+usaCode+`" id="checkbox`+key+`" checked disabled data-main-code="`+productCode+`" class="checkbox subchecked" />-->
                    <label for="checkbox`+key+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>`;
            }
        }
        let weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
        ];
        if(productName.includes('to US')){
            var d1 = new Date();
            d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d1.setDate(d1.getDate() + 7);
            var month = d1.getMonth() + 1; //months from 1-12
            var day = d1.getDate();
            var week = d1.getDay() + 1; //months from 1-12
            var year = d1.getFullYear();

            var d2 = new Date();
            d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d2.setDate(d2.getDate() + 5);
            var month2 = d2.getMonth() + 1; //months from 1-12
            var day2= d2.getDate();
            var week2 = d2.getDay() + 1; //months from 1-12
            var year2 = d2.getFullYear();


        }else {
            var d1 = new Date();
            d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d1.setDate(d1.getDate() + 15);
            var month = d1.getMonth() + 1; //months from 1-12
            var day = d1.getDate();
            var week = d1.getDay() + 1; //months from 1-12
            var year = d1.getFullYear();

            var d2 = new Date();
            d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d2.setDate(d2.getDate() + 10);
            var month2 = d2.getMonth() + 1; //months from 1-12
            var day2 = d2.getDate();
            var week2 = d2.getDay() + 1; //months from 1-12
            var year2 = d2.getFullYear();

        }
        productBox = `
                <img src="https://myglobal1.gumlet.io/images/Ribbon.png" class="tag-stick">
                <img src="https://myglobal1.gumlet.io/images/Ring.png" class="tag-stick1">
                <h2 class="cat-stick">`+productCategory.replace("And","&")+`</h2>
                <div class="product-info-fix">
                    <img src="./image/plus-bg.png" class="plus-bg">
                    <img src="./image/tablet-bg.png" class="tablet-bg1">
                    <img src="./image/tablet-bg.png" class="tablet-bg2">
                    <div class="product-meta-info">
                        <div class="product-name">
                            <h2><span class="name">`+productName+`</span>
                            <!---<span class="str"></span>-->
                            </h2>
                            <p class="ingredient">(`+generic+`)</p>
                        </div>
                        <div class="product-price">
                            <span class="price">$0.31</span>
                            <span class="divide">/</span>
                            <span class="product-type">`+proType+`</span>
                        </div>
                    </div>
                    <div class="product-image-suggested">
                        <div class="owl-carousel custome_slide suggested-product-image-slider" id="">
                            `+imageElement1+`
                        </div>
                    </div>
                </div>
                <div class="temp-section-one">
                    <div class="shipping-note">
                        <div class="icon"><img src="image/shipping.png" alt="" srcset=""></div>
                        <div class="note">Free Shipping on order above $199</div>
                    </div>
                    <div class="action-button" data-type="addToCart">
                        <button class="add-cart-button" data-id="slide`+y+`">
                            <span class="button__text">Add To Cart</span>
                        </button>
                        <button class="order-now" data-id="slide`+y+`">
                            <span class="button__text">Order Now</span>
                        </button>
                    </div>
                    <a class="link" href="`+(productCategory.toLowerCase()).split(' ').join('-')+`/`+(slug.toLowerCase()).split(' ').join('-')+`">
                        Know More <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="temp-section-two">
                    <div class="temp-show-hide close-temp"  data-id="slide`+y+`">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <div class="product-strength">
                        <div class="title"><img src="image/strength.png">Select Strength</div>
                        <ul class="nav nav-tabs strength-slider-wrap" role="tablist">
                            <li class="nav-item strength-slider-inner" id="strength-slider-inner`+y+`">
                                
                            </li>
                        </ul>
                        <div class="title"><img src="image/quantity.png"> Select Quantity Of Pills</div>
                    </div>
                    <div class="tab-content product-quantity">
                        
                    </div>
                    <div class="custom-pills">
                        <button class="custome-pill-button" style="`+customeStatus+`" id="`+y+`"><img src="image/customize.png">Create Your Own</button>
                        <div class="custome-input-ins">
                            <div class="input-section">
                                <div class="quantity-input">
                                    <input type="tel" placeholder='0' name="productQuantityCustome" id="productQuantityCustome">
                                </div>
                                <div class="quantity-price">
                                    $0.89
                                </div>
                            </div>
                            <div class="custome-instruction">
                                Note: Multiple of 10 or 100 only
                            </div>
                            <div class="button-custome">
                                <button class="custome-calculate" data-slide="`+y+`" data-dis="0">
                                    <span class="button__text">Calculate</span>
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="shipping-note">
                        <div class="icon"><img src="image/shipping.png" alt="" srcset=""></div>
                        <div class="note">Free Shipping on order above $199</div>
                    </div>
                    <div class="product-calculation `+productCode+`">
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
                            <span class="discount">15% OFF</span>
                            <p class="dis-text">
                                Applied <span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>
                            </p>
                        </div>
                        <div class="calculation">
                            <div class="list">
                                <span class="title">Actual Price</span>
                                <span class="value ogprice">$27.59</span>
                            </div>
                            <div class="list">
                                <span class="title">Shipping Charges</span>
                                <span class="value shippingCharges""><span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>Free</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Saving</span>
                                <span class="value save-value">$4.22</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Price</span>
                                <span class="value totalprice">$23.12</span>
                            </div>
                        </div>
                    </div>
                    <div class="shipping-info">
                        `+
                            shippingBox
                        +`
                        <div class="expected-dates">
                            <div class="round-right"></div>
                            <div class="round-left"></div>
                            <div class="border-insert"></div>
                            <div class="list" style="border-bottom: 1px dashed #cfcfcf;">
                                <div class="image"><img src="image/arrive.png"></div>
                                <div class="text-details">Arriving On</div>
                                <div class="date">`+month+`-`+day+`-`+year+` `+weekday[week-1]+`</div>
                            </div>
                            <div class="list">
                                <div class="image"><img src="image/Flight.png"></div>
                                <div class="text-details">Expected On</div>
                                <div class="date">`+month2+`-`+day2+`-`+year2+` `+weekday[week2-1]+`</div>
                            </div>
                        </div>
                    </div>
                    <div class="delivery-instruction" type="button" data-bs-toggle="modal" data-bs-target="#deliveryIns">What’s the difference?</div>
                    <a class="link" href="`+(productCategory.toLowerCase()).split(' ').join('-')+`/`+(slug.toLowerCase()).split(' ').join('-')+`">
                        Know More <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <div class="action-button checkout slide`+y+`">
                        <button class="confirm-cart">Confirm Cart</button>
                    </div>
                </div>
        `;
        $('.slide'+y).html(productBox);
        
    });

    
    suggestedProductSlider();
    // suggestedProductSectionToggle();
    suggestedProductSubSlide();
    

    // $('.slide'+y).toggleClass('active');
    $('.slide'+y+' .temp-section-one').hide();
    $('.slide'+y+' .temp-section-two').show();
    $('.suggested-product-list').addClass('active');
    $('.slide'+y+' .temp-show-hide' ).click(function() {
        var id = $(this).data('id');
        $('.'+id).toggleClass('active');
        $('.'+id+' .temp-section-one').toggle();
        $('.'+id+' .temp-section-two').toggle();
        // relatedchecker();  

    });
    $( ".slide"+y+" .add-cart-button" ).click(function() {
        var id = $(this).data('id');
        $('.'+id+' .action-button').attr('data-type','addToCart');
        $('.'+id).toggleClass('active');
        $('.'+id+' .temp-section-one').toggle();
        $('.'+id+' .temp-section-two').toggle();  
        onloadproductfunction();
    });

    $(".slide"+y+" .order-now" ).click(function() {
        var id = $(this).data('id');
        $('.'+id+' .action-button').attr('data-type','orderNow');
        $('.'+id).toggleClass('active');
        $('.'+id+' .temp-section-one').toggle();
        $('.'+id+' .temp-section-two').toggle();  
        onloadproductfunction();
    });

    setTimeout(function() {
        $('.productShipChange').css('display','none');
        //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
    }, 5500);

   
    
    
})

}


function relatedchecker() {

$('.subchecked').change(function() {
    var code = $(this).attr('data-code');
    var maincode = $(this).attr('data-main-code');
    $('.ogp'+maincode).addClass('ogp'+code);
    $('.ogp'+code).removeClass('.ogp'+maincode);
    var id = $(this).attr('id');
    id = id.replace("checkbox", "");
    getCheckerRelatedProductBox(code,id);
    setTimeout(function() {
        getCheckRelatedSingleProduct(code,id);
        relatedchecker();
        //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
        // onloadproductfunction();
    }, 1500);
});
}


function getRelatedProductBox() {
$('.suggested-product').html('');

$('.suggested-product').addClass('owl-carousel');
let productBox='';
fetch('api/relatedProduct/'+productCode).then((data)=>{
    return data.json();
}).then((objectData)=>{
    var products = JSON.stringify(objectData);
    $.each(JSON.parse(products), function(key, value){
        var productImage = value['product'].image;
        let fLen = productImage.length;
        var imageElement1 = ``;
        for (let i = 0; i < fLen; i++) {
            if(i==0){
                var classImage = 'active';
            }else{
                var classImage = '';
            }
            imageElement1 = imageElement1 +`
            <div class="image-item `+classImage+`">
                <img src="https://myglobal1.gumlet.io/onglobaladmincrm/`+productImage[i]+`" alt="Product image">
            </div>
            `;
        }
        var productName = value['product'].name;
        var proType = value['product'].productType;
        var productCategory = value['product'].category;
        var productCode = value['product'].code;


        var slug = value['product'].slug;
        var usaAvail = value['product'].usaAvail;
        var globeAvail = value['product'].globeAvail;
        var generic = value['product'].generic;
        var type = value['product'].type;
        if(type=='global'){

            var customeStatus = 'display: flex';
            if(usaAvail==1){
                var usaCode = value['product'].usaCode;
                var shippingBox = `
                <div class="shipping-toggle">
                            
                    <input type="checkbox" data-id='slide' data-code="`+usaCode+`" id="checkbox`+key+`" data-main-code="`+productCode+`" class="checkbox subchecked" />
                    <label for="checkbox`+key+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>
                `;
                
            }else {
                var shippingBox=`
                <div class="shipping-toggle">
                    <!--<input type="checkbox" data-id='slide' data-code="`+usaCode+`" id="checkbox`+key+`" disabled data-main-code="`+productCode+`" class="checkbox subchecked" />-->
                    <label for="checkbox`+key+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>`;
            }
        }else {

            var customeStatus = 'display: none;';
            if(globeAvail==1){
                var globeCode = value['product'].globeCode;
                var shippingBox = `
                <div class="shipping-toggle">
                            
                    <input type="checkbox" data-id='slide' data-code="`+globeCode+`" id="checkbox`+key+`" data-main-code="`+productCode+`" checked class="checkbox subchecked" />
                    <label for="checkbox`+key+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>`;
            }else {
                var shippingBox=`
                <div class="shipping-toggle">
                    <!--<input type="checkbox" data-id='slide' data-code="`+usaCode+`" id="checkbox`+key+`" checked disabled data-main-code="`+productCode+`" class="checkbox subchecked" />-->
                    <label for="checkbox`+key+`" class="switch_bg">
                        <div class="switch_button"></div>
                    </label>
                    <div class="ship-name first">Global Shipping</div>
                    <div class="ship-name second">USA Premium Shipping</div>
                </div>`;
            }
        }
        let weekday = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"
        ];
        if(productName.includes('to US')){
            var d1 = new Date();
            d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d1.setDate(d1.getDate() + 7);
            var month = d1.getMonth() + 1; //months from 1-12
            var day = d1.getDate();
            var week = d1.getDay() + 1; //months from 1-12
            var year = d1.getFullYear();

            var d2 = new Date();
            d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d2.setDate(d2.getDate() + 5);
            var month2 = d2.getMonth() + 1; //months from 1-12
            var day2= d2.getDate();
            var week2 = d2.getDay() + 1; //months from 1-12
            var year2 = d2.getFullYear();


        }else {
            var d1 = new Date();
            d1.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d1.setDate(d1.getDate() + 15);
            var month = d1.getMonth() + 1; //months from 1-12
            var day = d1.getDate();
            var week = d1.getDay() + 1; //months from 1-12
            var year = d1.getFullYear();

            var d2 = new Date();
            d2.toLocaleString('en-US', { timeZone: 'America/New_York' })
            d2.setDate(d2.getDate() + 10);
            var month2 = d2.getMonth() + 1; //months from 1-12
            var day2 = d2.getDate();
            var week2 = d2.getDay() + 1; //months from 1-12
            var year2 = d2.getFullYear();

        }
        productBox = `
        <div class="col-lg-12 col-12">
            <div class="suggested-product-list slide`+key+` ogp`+productCode+`">
                <img src="https://myglobal1.gumlet.io/images/Ribbon.png" class="tag-stick">
                <img src="https://myglobal1.gumlet.io/images/Ring.png" class="tag-stick1">
                <h2 class="cat-stick">`+productCategory.replace("And","&")+`</h2>
                <div class="product-info-fix">
                    <img src="./image/plus-bg.png" class="plus-bg">
                    <img src="./image/tablet-bg.png" class="tablet-bg1">
                    <img src="./image/tablet-bg.png" class="tablet-bg2">
                    <div class="product-meta-info">
                        <div class="product-name">
                        <h2><span class="name">`+productName+`</span>
                        <!---<span class="str"></span>-->
                        </h2>
                        <p class="ingredient">(`+generic+`)</p>
                        </div>
                        <div class="product-price">
                            <span style="width:84px; height:100%;" class="price placeholder"></span>
                            <span class="divide">/</span>
                            <span class="product-type">`+proType+`</span>
                        </div>
                    </div>
                    <div class="product-image-suggested">
                        <div class="owl-carousel custome_slide suggested-product-image-slider" id="">
                            `+imageElement1+`
                        </div>
                    </div>
                </div>
                <div class="temp-section-one">
                    <div class="shipping-note">
                        <div class="icon"><img src="image/shipping.png" alt="" srcset=""></div>
                        <div class="note">Free Shipping on order above $199</div>
                    </div>
                    <div class="action-button" data-type="addToCart">
                        <button class="add-cart-button" data-id="slide`+key+`">
                            <span class="button__text">Add To Cart</span>
                        </button>
                        <button class="order-now" data-id="slide`+key+`">
                            <span class="button__text">Order Now</span>
                        </button>
                    </div>
                    <a class="link" href="`+(productCategory.toLowerCase()).split(' ').join('-')+`/`+(slug.toLowerCase()).split(' ').join('-')+`">
                        Know More <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="temp-section-two">
                    <div class="temp-show-hide close-temp"  data-id="slide`+key+`">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <div class="product-strength">
                        <div class="title"><img src="image/strength.png">Select Strength</div>
                        <ul class="nav nav-tabs strength-slider-wrap" role="tablist">
                            <li class="nav-item strength-slider-inner" id="strength-slider-inner`+key+`">
                                
                            </li>
                        </ul>
                        <div class="title"><img src="image/quantity.png"> Select Quantity Of Pills</div>
                    </div>
                    <div class="tab-content product-quantity">
                        
                    </div>
                    <div class="custom-pills">
                        <button class="custome-pill-button" style="`+customeStatus+`" id="`+key+`"><img src="image/customize.png">Create Your Own</button>
                        <div class="custome-input-ins">
                            <div class="input-section">
                                <div class="quantity-input">
                                    <input type="tel" placeholder='0' name="productQuantityCustome" id="productQuantityCustome">
                                </div>
                                <div class="quantity-price">
                                    $0.89
                                </div>
                            </div>
                            <div class="custome-instruction">
                                Note: Multiple of 10 or 100 only
                            </div>
                            <div class="button-custome">
                                <button class="custome-calculate" data-dis="0" data-slide="`+key+`">
                                    <span class="button__text">Calculate</span>
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="shipping-note">
                        <div class="icon"><img src="image/shipping.png" alt="" srcset=""></div>
                        <div class="note">Free Shipping on order above $199</div>
                    </div>
                    <div class="product-calculation `+productCode+`">
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
                            <span class="discount">15% OFF</span>
                            <p class="dis-text">
                                Applied <span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>
                            </p>
                        </div>
                        <div class="calculation">
                            <div class="list">
                                <span class="title">Actual Price</span>
                                <span class="value ogprice">$27.59</span>
                            </div>
                            <div class="list">
                                <span class="title">Shipping Charges</span>
                                <span class="value shippingCharges""><span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>Free</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Saving</span>
                                <span class="value save-value">$4.22</span>
                            </div>
                            <div class="list">
                                <span class="title">Total Price</span>
                                <span class="value totalprice">$23.12</span>
                            </div>
                        </div>
                    </div>
                    <div class="shipping-info">
                        `+
                            shippingBox
                        +`
                        <div class="expected-dates">
                            <div class="round-right"></div>
                            <div class="round-left"></div>
                            <div class="border-insert"></div>
                            <div class="list" style="border-bottom: 1px dashed #cfcfcf;">
                                <div class="image"><img src="image/arrive.png"></div>
                                <div class="text-details">Arriving On</div>
                                <div class="date">`+month+`-`+day+`-`+year+` `+weekday[week-1]+`</div>
                            </div>
                            <div class="list">
                                <div class="image"><img src="image/Flight.png"></div>
                                <div class="text-details">Expected On</div>
                                <div class="date">`+month2+`-`+day2+`-`+year2+` `+weekday[week2-1]+`</div>
                            </div>
                        </div>

                    </div>
                    <div class="delivery-instruction" type="button" data-bs-toggle="modal" data-bs-target="#deliveryIns">What’s the difference?</div>
                    <a class="link" href="`+(productCategory.toLowerCase()).split(' ').join('-')+`/`+(slug.toLowerCase()).split(' ').join('-')+`">
                        Know More <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <div class="action-button checkout slide`+key+`">
                        <button class="confirm-cart">Confirm Cart</button>
                    </div>
                </div>
            </div>
        </div>
        `;
        $('.suggested-product').append(productBox);

        
    });
    suggestedProductSlider();
    suggestedProductSectionToggle();
    suggestedProductSubSlide();
    relatedchecker();
    $('.suggested-product-list .custom-pills .custome-input-ins').hide();
})
}

getRelatedProductBox();

// getRelatedProduct();
getProductInfo();

//$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
setTimeout(function() {
autoCustomeQty();
//$("[data-orders=6]").hide();
$("[data-orders=7]").hide();
slider();
}, 1000);

setTimeout(function() {
getRelatedProduct();
onloadproductfunction();
//$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
}, 3000);



function 
onloadproductfunction() {
var parentCategory = $('#category-identity').attr('class').toLowerCase();
$('.quantity-item').on('click', function() {
    if ($(window).width() < 767) {
    $('html, body').animate({
        scrollTop: $(".main-product-data .shipping-note").offset().top
    }, 300);
    }
    var qtyType = $(this).attr('data-type');
    if(qtyType=='main') {
        var strnid = $(this).parent().closest('div').attr('id');
        $(' #'+strnid+' .quantity-item').removeClass('active');
        $(this).addClass('active');
        if ($(window).width() < 767) {
            $('html, body').animate({
                scrollTop: $(".main-product-data .shipping-note").offset().top
            }, 100);
        }
    }else {
        var newslide = $(this).attr('data-slide-number');

        var strnid = $(this).parent().closest('div').attr('id');
        $('.slide'+newslide+' #'+strnid+' .quantity-item').removeClass('active');
        $(this).addClass('active');

        if ($(window).width() < 767) {
            $('html, body').animate({
                scrollTop: $(".slide"+newslide+" .temp-section-two .shipping-note").offset().top
            }, 100);
        }
    }
    
    var usaenable = $(this).data('usa-enable');
    var dataOrders = $(this).attr('data-orders');
    var usaGlobal = $(this).data('usa-global-type');

    if(usaenable==0){
        var ogprice = parseFloat($(this).data('ogprice'));
        var proType = $(this).data('pro-type');
        var price = $(this).data('price');
        var price1 = $(this).find('.quantity-pricing .price').html();
        var code = $(this).data('code');
        var qty = $(this).data('qty');
        var section = $(this).data('section');
        var type = $(this).data('type');
        var cartVal = $(this).data('cart')
        var discount = $(this).data('discount')
        
        var totaldisamount = (ogprice*(discount/100))
        // condition for injectable and oral steroids 
        if(parentCategory.includes('oral steroids') || parentCategory.includes('injectable steroids')){
            if(dataOrders >= 1 && dataOrders < 5){
                var shipping='$20';
                var shippingCharges=20; 
            }
            else{
                var shipping='$40';
                var shippingCharges=40;
            }
        } else{
            let toPrice = ogprice-totaldisamount;

            if(toPrice>=200) {
                var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
                var shippingCharges=0;
            }
            else if(toPrice>=150 && toPrice<200) {
                var shipping='$10';
                var shippingCharges=10;
            }
            else if(toPrice>=100 && toPrice<150) {
                var shipping='$15';
                var shippingCharges=15;
            } 
            else if(toPrice<100) {
                var shipping='$20';
                var shippingCharges=20;
            }
        }
    }else {
        var ogprice = parseFloat($(this).data('usa-ogprice'));
        var proType = $(this).data('pro-type');
        var price = $(this).data('usa-price');
        var price1 = $(this).find('.quantity-pricing .price').html();
        var code = $(this).data('usa-code');
        var qty = $(this).data('usa-qty');
        var section = $(this).data('usa-section');
        var type = $(this).data('usa-type');
        var cartVal = $(this).data('usa-cart')
        var discount = $(this).data('usa-discount')
        var totaldisamount = (ogprice*(discount/100))
        var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
        var shippingCharges=0;
    }

    var usaGlobal = $(this).data('usa-global-type');
    if(parentCategory.includes('usa premium')){
        if(usaGlobal == 'USA'){
            var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
            var shippingCharges=0;
        }
    }

    // console.log(type);
    if(type=='main'){
        var strength = $('.strength-slider-inner a[href="#'+strnid+'"] span').html();
        $('.main-product-data .product-price .price').html(price1);
        // $('.main-product-data .product-name .str').html(strength);
        var isusa = $(this).data('is-usa');
        if(cartVal=='yes'){
            var button = `
            <button class="add-cart-button go-cart" onclick="gotocart()" style=" background: #dbfee2; color: #128629; ">Go to Cart</button>
            <button class="order-now go-cart" onclick="gotocart()">Order Now</button>
        `;
        }else {
            var button = `
            <button class="add-cart-button"
            data-wishlist="0" 
            onclick="addProductToCart(this)"
            data-qty="`+qty+`" 
            data-total-price="`+ogprice+`" 
            data-qty-code="`+code+`"
            data-type="cart"
            data-user="6332a495362d8"><span class="button__text">Add To Cart</span></button>
            <button class="order-now"
            data-wishlist="0" 
            onclick="addProductToCart(this)"
            data-qty="`+qty+`" 
            data-total-price="`+ogprice+`" 
            data-qty-code="`+code+`"
            data-type="checkout"
            data-user="6332a495362d8"><span class="button__text">Order Now</span></button>`
        }
        
        $('.'+section+' .action-button').html(button);
    }else if(type=='sub'){

        var slide = $(this).attr('data-slide-number');
        var typeBut = $('.ogp'+section).find('.action-button').attr('data-type');

        var strength = $('.slide'+slide+' .strength-slider-inner a[href="#'+strnid+'"] span').html();
        $('.slide'+slide).find('.product-price .price').html(price1);
        // $('.slide'+slide).find('.product-name .str').html(strength);
        if(cartVal=='yes'){
            var button = `
            <button 
                class="confirm-cart go-cart" onclick="gotocart()" style=" background: #dbfee2; color: #128629; "
            >Go To Cart</button>
            `;
        }else {
            
            // alert(typeBut);
            if(typeBut=='addToCart') {
                
                var button = `
                    <button 
                        class="confirm-cart"
                        data-wishlist="0" 
                        onclick="addRelatedProductToCart(this)"
                        data-qty="`+qty+`" 
                        data-slide="`+slide+`"
                        data-pcode="`+section+`" 
                        data-total-price="`+ogprice+`" 
                        data-bt-type="cart"
                        data-qty-code="`+code+`"
                        data-user="6332a495362d8"
                    ><span class="button__text">Confirm Cart</span></button>
                `;
            }else {
                var button = `
                <button 
                    class="confirm-cart"
                    data-wishlist="0" 
                    data-slide="`+slide+`"
                    onclick="addRelatedProductToCart(this)"
                    data-qty="`+qty+`" 
                    data-pcode="`+section+`" 
                    data-total-price="`+ogprice+`" 
                    data-qty-code="`+code+`"
                    data-bt-type="checkout"
                    data-user="6332a495362d8"
                ><span class="button__text">Confirm Order</span></button>
                `;
            }

        }
        
        $('.ogp'+section).find('.action-button.checkout').html(button);
        
        
       
    }
    

    var total =  (ogprice-totaldisamount)+shippingCharges;
    $('.'+section+' .offer-applied span.discount').html(discount+'% OFF');
    $('.'+section+' .ogPill').html(qty+` `+proType);
    $('.'+section+' .ogprice').html('$'+ogprice);
    $('.'+section+' .shippingCharges').html(shipping);
    $('.'+section+' .save-value').html("$"+(totaldisamount).toFixed(2));
    $('.'+section+' .totalprice').html("$"+(total).toFixed(2));
})
// tab switch acticve item 
activeQuantity();
$('.strength-slider-wrap li .nav-link').click(function () {
    let id = $(this).attr('href');
    let strCode = id.replace('#','');
    $('.main-product-data .product-quantity #'+strCode+' .quantity-item.active').click();
})
// tab switch acticve item 
}

// active quantity 
function activeQuantity () {
let id = $('.strength-slider-wrap li .nav-link.active').attr('href')
let strCode = id.replace('#','');
$('.main-product-data .product-quantity #'+strCode+' .quantity-item.active').click()
}
// active quantity 

function checkDefaultQuantity() {
customeQty();
var parentCategory = $('#category-identity').attr('class').toLowerCase();
var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
var code = id.replace("#", "");

var usaenable = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').attr('data-usa-enable');
var dataOrders = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').attr('data-orders');

if(usaenable==0){
    var type = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('type');
    var ogprice = parseFloat($('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('ogprice'));

    var price1 = $('.product-data-left .product-quantity #'+code+' .quantity-item.active .quantity-pricing .price').html();

    var proType = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('pro-type');

    var price = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('price');
    
    var qty = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('qty');
    var sectionName = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('section');
    var cartVal = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('cart');
    var discount = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('discount');
    var code = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('code');
    
    var totaldisamount = (ogprice*(discount/100))
    //condition for steroids and injectable 
    if(parentCategory.includes('oral steroids') || parentCategory.includes('injectable steroids')){
        if(dataOrders >= 1 && dataOrders < 5){
            var shipping='$20';
            var shippingCharges=20;
        }
        else{
            var shipping='$40';
            var shippingCharges=40;
        }
    } else{

        if(ogprice>=200) {
            var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
            var shippingCharges=0;
        }
        else if(ogprice>=150 && ogprice<200) {

            var shipping='$10';
            var shippingCharges=10;
        }
        else if(ogprice>=100 && ogprice<150) {
            var shipping='$15';
            var shippingCharges=15;
        } 
        else if(ogprice<100) {
            var shipping='$20';
            var shippingCharges=20;
        }
    }

}else {
    var type = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-type');
    var ogprice = parseFloat($('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-ogprice'));
    var price = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-price');
    var proType = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('pro-type');

    var price1 = $('.product-data-left .product-quantity #'+code+' .quantity-item.active .quantity-pricing .price').html();

    var qty = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-qty');
    var sectionName = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-section');
    var cartVal = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-cart');
    var discount = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-discount');
    var code = $('.product-data-left .product-quantity #'+code+' .quantity-item.active').data('usa-code');
    
    var totaldisamount = (ogprice*(discount/100))

    var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
    var shippingCharges=0;

}
    
if(type=='main'){
    var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
    var strn = $('.product-data-left .strength-slider-inner a.active span').html();
    var code1 = id.replace("#", "");

    var isusa = $('.product-data-left .product-quantity #'+code1+' .quantity-item.active').data('is-usa');
    // if(isusa==1){
    //     $('.main-box-ship .shipping-info').css('visibility','visible');
    // }else {
    //     $('.main-box-ship .shipping-info').hide();
    // }
    $('.main-product-data .product-price .price').html(price1);
    // $('.main-product-data .product-name .str').html(strn);

    if(cartVal=='yes'){
        var button = `
        <button class="add-cart-button go-cart" onclick="gotocart()" style=" background: #dbfee2; color: #128629; ">Go to Cart</button>
        <button class="order-now go-cart" onclick="gotocart()">Order Now</button>
    `;
    }else {
        var button = `
        <button class="add-cart-button"
        data-wishlist="0" 
        onclick="defaultModal(this)"
        data-qty="`+qty+`" 
        data-total-price="`+ogprice+`" 
        data-qty-code="`+code+`"
        data-type="cart"
        data-user="6332a495362d8"><span class="button__text">Add To Cart</span></button>
        <button class="order-now"
        data-wishlist="0" 
        onclick="defaultModal(this)"
        data-qty="`+qty+`" 
        data-total-price="`+ogprice+`" 
        data-qty-code="`+code+`"
        data-type="checkout"
        data-user="6332a495362d8"><span class="button__text">Order Now</span></button>`
    }
    
    $('.'+sectionName+' .action-button').html(button);
}
var total =  (ogprice-totaldisamount)+shippingCharges;
$('.'+sectionName+' .offer-applied span.discount').html(discount+'% OFF');
$('.'+sectionName+' .ogPill').html(qty+' '+proType);
$('.'+sectionName+' .ogprice').html('$'+ogprice);
$('.'+sectionName+' .shippingCharges').html(shipping);
$('.'+sectionName+' .save-value').html("$"+(totaldisamount).toFixed(2));
$('.'+sectionName+' .totalprice').html("$"+(total).toFixed(2));
}
function checkRelatedDefaultQuantity() {
$(".suggested-product .suggested-product-list").each(function(){
    var id = $(this).find('.strength-slider-inner a.active').attr('href');
    var str= $(this).find('.strength-slider-inner a.active').html();
    var code = id.replace("#", "");

    var typeBut = $(this).find('.action-button').attr('data-type');
    var usaenable = $(this).find('.product-quantity #'+code+' .quantity-item.active').attr('data-usa-enable');
    var slide  = $(this).find('.product-quantity #'+code+' .quantity-item.active').attr('data-slide-number');
    if(usaenable==0){
        var type = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('type');
        var ogprice = parseFloat($(this).find('.product-quantity #'+code+' .quantity-item.active').data('ogprice'));
        var price = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('price');
        var qty = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('qty');
        var sectionName = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('section');
        var cartVal = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('cart');
        var discount = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('discount');
        var code = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('code');
        
        var totaldisamount = (ogprice*(discount/100))
        if(ogprice>=200) {
            var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
            var shippingCharges=0;
        }
        else if(ogprice>=150 && ogprice<200) {
            var shipping='$10';
            var shippingCharges=10;
        }
        else if(ogprice>=100 && ogprice<150) {
            var shipping='$15';
            var shippingCharges=15;
        } 
        else if(ogprice<100) {
            var shipping='$20';
            var shippingCharges=20;
        }
    }else {
        var type = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-type');
        var ogprice = parseFloat($(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-ogprice'));
        var price = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-price');
        var qty = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-qty');
        var sectionName = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-section');
        var cartVal = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-cart');
        var discount = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-discount');
        var code = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('usa-code');
        
        var totaldisamount = (ogprice*(discount/100))
        var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
        var shippingCharges=0;
    }
    $('.slide'+slide).find('.product-price .price').html('$'+(price-(price*(discount/100))).toFixed(2));
    // $('.slide'+slide).find('.product-name .str').html(str);
    if(cartVal=='yes'){
        var button = `
        <button 
            class="confirm-cart go-cart" onclick="gotocart()" style=" background: #dbfee2; color: #128629; "
        >Go To Cart</button>
        `;
    }else {
        if(typeBut=='addToCart') {
            var button = `
                <button 
                    class="confirm-cart"
                    data-wishlist="0" 
                    onclick="addRelatedProductToCart(this)"
                    data-qty="`+qty+`" 
                    data-slide="`+slide+`"
                    data-pcode="`+sectionName+`" 
                    data-total-price="`+ogprice+`" 
                    data-qty-code="`+code+`"
                    data-bt-type="cart"
                    data-user="6332a495362d8"
                ><span class="button__text">Confirm Cart</span></button>
            `;
        }else {
            var button = `
            <button 
                class="confirm-cart"
                data-wishlist="0" 
                onclick="addRelatedProductToCart(this)"
                data-qty="`+qty+`" 
                data-pcode="`+sectionName+`"
                data-slide="`+slide+`" 
                data-total-price="`+ogprice+`" 
                data-bt-type="checkout"
                data-qty-code="`+code+`"
                data-user="6332a495362d8"
            ><span class="button__text">Confirm Order</span></button>
            `;
        }
    }

    $(this).find('.action-button.checkout').html(button);

    var id = $(this).find('.strength-slider-inner a.active').attr('href');
    var code = id.replace("#", "");

    var isusa = $(this).find('.product-quantity #'+code+' .quantity-item.active').data('is-usa');
    // alert(isusa);
    // if(isusa==1){
    //     $(this).find('.shipping-info .shipping-toggle').css('visibility','visible');
    // }else {
    //     $(this).find('.shipping-info .shipping-toggle').hide();
    // }

    var total =  (ogprice-totaldisamount)+shippingCharges;
    $(this).find('.'+sectionName+' .ogprice').html('$'+ogprice);
    $(this).find('.'+sectionName+' .shippingCharges').html(shipping);
    $(this).find('.'+sectionName+' .save-value').html("$"+(totaldisamount).toFixed(2));
    $(this).find('.'+sectionName+' .totalprice').html("$"+(total).toFixed(2));
    
});




}

setTimeout(function() {
checkDefaultQuantity();
customeRelatedButton();
customeProductCalculate();
//$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
}, 3500);

setTimeout(function() {
$('.product-price .price').css('width','auto');
$('.product-price .price').removeClass('placeholder');
}, 7500);

function addProductToCart(x)  {
$(x).addClass('button--loading');
var code = $(x).data('qty-code');
var userid = $(x).data('user');
var wish = $(x).data('wishlist');
var price = $(x).data('total-price');
var catName = $(x).data('cat-name');
var type = $(x).data('type');
var btn = 'addToCart';
$.ajax ({
    url: 'action.php',
    type: 'post',
    data: {'btn':btn, 'code':code, 'userid':userid, 'wish':wish },
    success: function(data) {
        if(price>=199 && catName!='USA TO USA Medication'){
            $('.js-container').show();
                $('#freeShipConfirm').modal('toggle');
            setTimeout(function(){ 
                $('.js-container').hide();
                $('#freeShipConfirm').modal('toggle');
            }, 4500);
        }
        if(type=='checkout'){
            window.location.href = "cart";
        }else{
            getProductInfo();
            setTimeout(function() {
                checkDefaultQuantity();
            }, 2500);
            setTimeout(function() {
                //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
            }, 1500);
            count_cart();
            load_cart();
        }
    }
})
}

function addRelatedProductToCart(x)  {
var classes = $(x).parent().closest('div').attr('class');
classes=classes.replace('action-button checkout slide','');
classes=classes.replace(' active','');
$(x).addClass('button--loading');

var pcode = $(x).attr('data-pcode');
var code = $(x).attr('data-qty-code');
var userid = $(x).attr('data-user');
var wish = $(x).attr('data-wishlist');
var price = $(x).attr('data-total-price');
var catName = $(x).attr('data-cat-name');
var type = $(x).attr('data-bt-type');
var btn = 'addToCart';
$.ajax ({
    url: 'action.php',
    type: 'post',
    data: {'btn':btn, 'code':code, 'userid':userid, 'wish':wish },
    success: function(data) {
        if(type=='checkout'){
            window.location.href = "cart";
        }else {
            if(price>=199 && catName!='USA TO USA Medication'){
                $('.js-container').show();
                    $('#freeShipConfirm').modal('toggle');
                setTimeout(function(){ 
                    $('.js-container').hide();
                    $('#freeShipConfirm').modal('toggle');
                }, 4500);
            }
            $('.ogp'+pcode).find('.temp-section-two .strength-slider-inner').html('');
            $('.ogp'+pcode).find('.temp-section-two .product-quantity').html('');
            // getRelatedSingleProduct(pcode)
            getCheckRelatedSingleProduct(pcode,classes)
            setTimeout(function() {
                checkRelatedDefaultQuantity();
                onloadproductfunction();
            }, 2500);
            setTimeout(function() {
                //$("[data-orders=6]").hide();
        $("[data-orders=7]").hide();
            }, 1500);
            count_cart();
            load_cart();
        }
    }
})
}


// $('#checkbox').change(function() {
//     if ($(this).prop('checked')) {
//         var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
//         var code = id.replace("#", "");
//         $('.product-data-left .product-quantity #'+code+' .quantity-item.active').attr('data-usa-enable',1);
//         checkDefaultQuantity();
//     }
//     else {
//         var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
//         var code = id.replace("#", "");
//         $('.product-data-left .product-quantity #'+code+' .quantity-item.active').attr('data-usa-enable',0);checkDefaultQuantity();
//     }
// });


function gotocart() {
window.location.href="cart";

}

$('.product-data-left .custom-pills .custome-input-ins').hide();

$('.product-data-left .custome-pill-button').on('click', function() {
    
var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
var code = id.replace("#", "");
$(this).hide();
$('.product-data-left .custom-pills .title').hide();
$('.product-data-left .custom-pills .custome-input-ins').show();
$('.product-data-left .custom-pills .custome-input-ins').attr('data-code',code);
$('.product-data-left .custom-pills .custome-input-ins input').focus();
customeQty();
})
function customeRelatedButton(){
$('.temp-section-two .custome-pill-button').on('click', function() {

    var boxnum = $(this).attr('id');
    var id = $('.slide'+boxnum+' .strength-slider-inner a.active').attr('href');
    var code = id.replace("#", "");
    $('.slide'+boxnum+' .temp-section-two .custome-pill-button').hide();
    $('.slide'+boxnum+' .custom-pills .custome-input-ins').show();
    $('.slide'+boxnum+' .custom-pills .custome-input-ins').attr('data-code',code);
    // $('.slide'+boxnum+' .custom-pills .custome-input-ins input').focus();
    relatedcustomeQty('.slide'+boxnum);
})
}

function relatedcustomeQty(x) {
// alert(x);
$(x+' .custom-pills .custome-input-ins input').keyup(function() {
    let price;
    let newprice='';
    let quantity='';
    let qtyArray = [];
    let priceArray = [];
    let priceArray1 = [];
    var id = $(x+' .strength-slider-inner a.active').attr('href');
    let code = id.replace("#", "");
    let qty = $(this).val();
    $(x+" .tab-pane#"+code+" .quantity-item").each(function(){
        quantity = quantity+" "+$(this).find('.quantity-pricing .quantity-pill').html().replaceAll(/\D/g,'');
        price = $(this).find('.quantity-pricing .price').html().replaceAll(/\s/g,'');
        price = price.replace('$','');
        newprice = newprice+" "+ price;
        
    })
    qtyArray = quantity.split(" ");
    priceArray = newprice.split(" ");
    var lastrate = (priceArray[priceArray.length-1]);

    newprice = newprice + " "+lastrate;

    priceArray1 = newprice.split(" ");

    array = qtyArray.map(Number);
    array.push(99999999);
    

    array = array.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1 = priceArray1.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1.push(lastrate);
    priceArray1.shift();

    var price1 = [0.30, 0.60, 0.90, 1.20, 1.80, 1.80];
    var index=array.findIndex(function(number) {
      return number > parseInt(qty);
    });
    var totPrice = priceArray1 [index-2];
    if(totPrice==undefined){
        $(x+' .custome-input-ins .input-section .quantity-price').html('$'+priceArray1 [priceArray1.length - 1]);
    }else {
        $(x+' .custome-input-ins .input-section .quantity-price').html('$'+totPrice);
    }
    
});
}

function autoRelatedCustomQty(x) {
// alert(x);
    let price;
    let newprice='';
    let quantity='';
    let qtyArray = [];
    let priceArray = [];
    let priceArray1 = [];
    var id = $(x+' .strength-slider-inner a.active').attr('href');
    let code = id.replace("#", "");
    let qty = $(x+' .custom-pills .custome-input-ins input').val();
    $(x+" .tab-pane#"+code+" .quantity-item").each(function(){
        quantity = quantity+" "+$(this).find('.quantity-pricing .quantity-pill').html().replaceAll(/\s/g,'');
        price = $(this).find('.quantity-pricing .price').html().replaceAll(/\s/g,'');
        price = price.replace('$','');
        newprice = newprice+" "+ price;
        
    })
    qtyArray = quantity.split(" ");
    priceArray = newprice.split(" ");
    var lastrate = (priceArray[priceArray.length-1]);

    newprice = newprice + " "+lastrate;

    priceArray1 = newprice.split(" ");

    array = qtyArray.map(Number);
    array.push(99999999);
    

    array = array.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1 = priceArray1.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1.push(lastrate);
    priceArray1.shift();

    var price1 = [0.30, 0.60, 0.90, 1.20, 1.80, 1.80];
    var index=array.findIndex(function(number) {
      return number > parseInt(qty);
    });
    var totPrice = priceArray1 [index-2];
    if(totPrice==undefined){
        $(x+' .custome-input-ins .input-section .quantity-price').html('$'+priceArray1 [priceArray1.length - 1]);
    }else {
        $(x+' .custome-input-ins .input-section .quantity-price').html('$'+totPrice);
    }
    
}

function customeQty() {

$('.product-data-left .custom-pills .custome-input-ins input').keyup(function() {
    let price;
    let newprice='';
    let quantity='';
    let qtyArray = [];
    let priceArray = [];
    let priceArray1 = [];
    var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
    let code = id.replace("#", "");
    let qty = $(this).val();
    $(".tab-pane#"+code+" .quantity-item").each(function(){
        quantity = quantity+" "+$(this).find('.quantity-pricing .quantity-pill').html().replaceAll(/\D/g,'');
        price = $(this).find('.quantity-pricing .price').html().replaceAll(/\s/g,'');
        price = price.replace('$','');
        newprice = newprice+" "+ price;
    })
    qtyArray = quantity.split(" ");
    priceArray = newprice.split(" ");
    var lastrate = (priceArray[priceArray.length-1]);

    newprice = newprice + " "+lastrate;

    priceArray1 = newprice.split(" ");

    array = qtyArray.map(Number);
    array.push(99999999);
    

    array = array.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1 = priceArray1.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1.push(lastrate);
    priceArray1.shift();

    var price1 = [0.30, 0.60, 0.90, 1.20, 1.80, 1.80];
    var index=array.findIndex(function(number) {
      return number > parseInt(qty);
    });
    var totPrice = priceArray1 [index-2];
    if(totPrice==undefined){
        $('.product-data-left .custome-input-ins .input-section .quantity-price').html('$'+priceArray1 [priceArray1.length - 1]);
    }else {
        $('.product-data-left .custome-input-ins .input-section .quantity-price').html('$'+totPrice);
    }
    
});
}

function autoCustomeQty() {


    let price;
    let newprice='';
    let quantity='';
    let qtyArray = [];
    let priceArray = [];
    let priceArray1 = [];
    var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
    let code = id.replace("#", "");
    let qty = 0;
    $(".tab-pane#"+code+" .quantity-item").each(function(){
        quantity = quantity+" "+$(this).find('.quantity-pricing .quantity-pill').html().replaceAll(/\s/g,'');
        price = $(this).find('.quantity-pricing .price').html().replaceAll(/\s/g,'');
        price = price.replace('$','');
        newprice = newprice+" "+ price;
        
    })
    qtyArray = quantity.split(" ");
    priceArray = newprice.split(" ");
    var lastrate = (priceArray[priceArray.length-1]);

    newprice = newprice + " "+lastrate;

    priceArray1 = newprice.split(" ");

    array = qtyArray.map(Number);
    array.push(99999999);
    

    array = array.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1 = priceArray1.filter( function( item, index, inputArray ) {
        return inputArray.indexOf(item) == index;
    });
    priceArray1.push(lastrate);
    priceArray1.shift();

    var price1 = [0.30, 0.60, 0.90, 1.20, 1.80, 1.80];
    var index=array.findIndex(function(number) {
      return number > parseInt(qty);
    });
    var totPrice = priceArray1 [index-2];
    if(totPrice==undefined){
        $('.product-data-left .custome-input-ins .input-section .quantity-price').html('$'+priceArray1 [priceArray1.length - 1]);
    }else {
        $('.product-data-left .custome-input-ins .input-section .quantity-price').html('$'+totPrice);
    }
}

function customeProductCalculate(){
$('.suggested-product-list .button-custome .custome-calculate').on('click', function(){
    var slide = '.slide'+$(this).attr('data-slide');
    $(slide+' .custome-input-ins .custome-instruction').css('color','#4b566b');
    let price;
    let newprice='';
    let quantity='';
    let qtyArray = [];
    let priceArray = [];
    let priceArray1 = [];
    var id = $(slide+' .strength-slider-inner a.active').attr('href');
    let code = id.replace("#", "");
    let qty = $(slide+' .custom-pills .custome-input-ins input').val();
    if(qty>0 && (qty%10==0 || qty%100==0)){
        $(this).html('Calculated');
        let discount;
        $(slide+" .tab-pane#"+code+" .quantity-item").each(function(){
            quantity = quantity+" "+$(this).find('.quantity-pricing .quantity-pill').html().replaceAll(/\s/g,'');
            price = $(this).find('.quantity-pricing .price').html().replaceAll(/\s/g,'');
            price = price.replace('$','');
            newprice = newprice+" "+ price;
            discount = $(this).data('discount');
            productCode = $(this).data('section');
        })
        qtyArray = quantity.split(" ");
        priceArray = newprice.split(" ");
        var lastrate = (priceArray[priceArray.length-1]);

        newprice = newprice + " "+lastrate;

        priceArray1 = newprice.split(" ");

        array = qtyArray.map(Number);
        array.push(99999999);

            array = array.filter( function( item, index, inputArray ) {
                return inputArray.indexOf(item) == index;
            });
            priceArray1 = priceArray1.filter( function( item, index, inputArray ) {
                return inputArray.indexOf(item) == index;
            });
            priceArray1.push(lastrate);
            priceArray1.shift();

            var price1 = [0.30, 0.60, 0.90, 1.20, 1.80, 1.80];
            var index=array.findIndex(function(number) {
            return number > parseInt(qty);
            });
            var totPrice = priceArray1 [index-2];
            if(totPrice==undefined){
                $(slide+' .custome-input-ins .input-section .quantity-price').html('$'+priceArray1 [0]);
                totPrice = priceArray1 [0];
            }else {
                $(slide+' .custome-input-ins .input-section .quantity-price').html('$'+totPrice);
                totPrice = totPrice;
            }
            $(this).attr('data-dis',discount);
            $(this).attr('data-strength',code);
            $(this).attr('data-qty',qty);
            $(this).attr('data-price',totPrice);
            $(this).attr('data-prcode',productCode);

            var section = productCode;
            var totalprice = (qty*totPrice).toFixed(2);
            // var discountAmt = totalprice*(discount/100);
            var discountAmt = 0;
            var ogprice1 = totalprice-discountAmt;
            if(ogprice1>=200) {
                var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
                var shippingCharges=0;
            }
            else if(ogprice1>=150 && ogprice<200) {
                var shipping='$10';
                var shippingCharges=10;
            }
            else if(ogprice1>=100 && ogprice<150) {
                var shipping='$15';
                var shippingCharges=15;
            } 
            else if(ogprice1<100) {
                var shipping='$20';
                var shippingCharges=20;
            }
            var ogprice = ((parseFloat(totalprice)+shippingCharges)-discountAmt).toFixed(2);
            var type= $(slide+' .action-button').attr('data-type');
            if(type=='orderNow'){
                var buttonText = "Confirm Order";
            }else {
                var buttonText = "Confirm Cart";
            }
            var button = `
                <button class="add-cart-button add-custome-cart" onclick="customCart(this)"
                    data-discount="`+discount+`" data-strength="`+code+`"
                    data-qty="`+qty+`" data-price="`+totPrice+`" data-prcode="`+productCode+`"
                    data-total="`+ogprice+`" data-original="`+totalprice+`" data-save="`+discountAmt+`">
                    <span class="button__text">`+buttonText+`</span>
                </button>`;
            var strength = $(slide+' .strength-slider-inner a[href="#'+code+'"] span').html();
            
            // $(slide+' .product-name .str').html(strength);
            $(slide+' .temp-section-two .action-button').html(button);
            $(slide+' .product-price .price').html('$'+(totPrice));
            $(slide+' .ogprice').html('$'+totalprice);
            $(slide+' .shippingCharges').html(shipping);
            $(slide+' .save-value').html("$"+(discountAmt).toFixed(2));
            $(slide+' .totalprice').html("$"+(ogprice));
            $(this).addClass('active');
            setTimeout(()=>{
                $(this).removeClass('active');
                $(this).html('Calculate');
            },1000);
    }else {
        $(slide+' .custome-input-ins .custome-instruction').css('color','red');
    }
})
}

$('.product-data-left .button-custome .add-cart-button').on('click', function(){
$('.product-data-left .custome-input-ins .custome-instruction').css('color','#4b566b');
let price;
let newprice='';
let quantity='';
let qtyArray = [];
let priceArray = [];
let priceArray1 = [];
var id = $('.product-data-left .strength-slider-inner a.active').attr('href');
let code = id.replace("#", "");
// alert(c     x0.val();
let qty = $('.product-data-left .custom-pills .custome-input-ins input').val();
if(qty>0 && (qty%10==0 || qty%100==0)){
    let discount;
    $(this).html('Calculated');
    $(".tab-pane#"+code+" .quantity-item").each(function(){
        quantity = quantity+" "+$(this).find('.quantity-pricing .quantity-pill').html().replaceAll(/\s/g,'');
        price = $(this).find('.quantity-pricing .price').html().replaceAll(/\s/g,'');
        price = price.replace('$','');
        newprice = newprice+" "+ price;
        discount = $(this).data('discount');
        productCode = $(this).data('section');
    })
    qtyArray = quantity.split(" ");
    priceArray = newprice.split(" ");
    var lastrate = (priceArray[priceArray.length-1]);

    newprice = newprice + " "+lastrate;

    priceArray1 = newprice.split(" ");

    array = qtyArray.map(Number);
    array.push(99999999);

        array = array.filter( function( item, index, inputArray ) {
            return inputArray.indexOf(item) == index;
        });
        priceArray1 = priceArray1.filter( function( item, index, inputArray ) {
            return inputArray.indexOf(item) == index;
        });
        priceArray1.push(lastrate);
        priceArray1.shift();

        var price1 = [0.30, 0.60, 0.90, 1.20, 1.80, 1.80];
        var index=array.findIndex(function(number) {
        return number > parseInt(qty);
        });
        var totPrice = priceArray1 [index-2];
        if(totPrice==undefined){
            $('.product-data-left .custome-input-ins .input-section .quantity-price').html('$'+priceArray1 [priceArray1.length - 1]);
            totPrice = priceArray1 [0];
        }else {
            $('.product-data-left .custome-input-ins .input-section .quantity-price').html('$'+totPrice);
            totPrice = totPrice;
        }
        $(this).attr('data-dis',discount);
        $(this).attr('data-strength',code);
        $(this).attr('data-qty',qty);
        $(this).attr('data-price',totPrice);
        $(this).attr('data-prcode',productCode);

        var section = productCode;
        var totalprice = (qty*totPrice).toFixed(2);
        // var discountAmt = totalprice*(discount/100);
        var discountAmt = 0;
        var ogprice1 = totalprice-discountAmt;


        if(ogprice1>=200) {
            var shipping='<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE';
            var shippingCharges=0;
        }
        else if(ogprice1>=150 && ogprice1<200) {
            var shipping='$10';
            var shippingCharges=10;
        }
        else if(ogprice1>=100 && ogprice1<150) {
            var shipping='$15';
            var shippingCharges=15;
        } 
        else if(ogprice1<100) {
            var shipping='$20';
            var shippingCharges=20;
        }

        var ogprice = ((parseFloat(totalprice)+shippingCharges)-discountAmt).toFixed(2);
        var button = `
            <button class="add-cart-button add-custome-cart" onclick="customCart(this)"
                data-discount="`+discount+`" data-strength="`+code+`"
                data-qty="`+qty+`" data-price="`+totPrice+`" data-prcode="`+productCode+`"
                data-total="`+ogprice+`" data-original="`+totalprice+`" data-save="`+discountAmt+`">
                <span class="button__text">Add To Cart</span>
            </button>
            <button class="order-now"><span class="button__text">Order Now</span></button>`;
        var strength = $('.strength-slider-inner a[href="#'+code+'"] span').html();
        // $('.main-product-data .product-name .str').html(strength);
        $('.'+section+' .action-button').html(button);
        $('.main-product-data .product-price .price').html('$'+(totPrice));
        $('.'+section+' .ogprice').html('$'+totalprice);
        $('.'+section+' .shippingCharges').html(shipping);
        $('.'+section+' .save-value').html("$"+(discountAmt).toFixed(2));
        $('.'+section+' .totalprice').html("$"+(ogprice));
        $(this).addClass('active');
        setTimeout(()=>{
            $(this).removeClass('active');
            $(this).html('Calculate');
        },1000);
        
}else {
    $('.product-data-left .custome-input-ins .custome-instruction').css('color','red');
}
})

function customCart(x){
$(x).addClass('button--loading');
var discount = $(x).data('discount');
var strength = $(x).data('strength');
var qty = $(x).data('qty');
var price  =$(x).data('price');
var prcode = $(x).data('prcode');
var total = $(x).data('total');
var orgprice = $(x).data('original');
var save = $(x).data('save');
var btn = 'AddCustomeCart';
$.ajax ({
    url: 'action.php',
    type: 'post',
    data: {'btn':btn, discount:discount, strength:strength, qty:qty, price:price, prcode:prcode, total: total, orgprice:orgprice, save:save},
    success: function(data) {
        // $('.ogp'+pcode).find('.temp-section-two .strength-slider-inner').html('');
        // $('.ogp'+pcode).find('.temp-section-two .product-quantity').html('');
        // // getRelatedSingleProduct(pcode)
        // getCheckRelatedSingleProduct(pcode,slide)
        // setTimeout(function() {
        //     checkRelatedDefaultQuantity();
        //     onloadproductfunction();
        // }, 1500);
        $(x).removeClass('button--loading');
        count_cart();
        load_cart();
    }
})
}

// countdownTimeStart();
// function countdownTimeStart(){

// var countDownDate = new Date();

// // add a day
// countDownDate.setDate(countDownDate.getDate() + 1);

// // Update the count down every 1 second
// var x = setInterval(function() {

//     // Get todays date and time
//     var now = new Date().getTime();

//     // Find the distance between now an the count down date
//     var distance = countDownDate - now;

//     // Time calculations for days, hours, minutes and seconds
//     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((distance % (1000 * 60)) / 1000);

//     // Output the result in an element with id="demo"
//     document.getElementById("progressBar").innerHTML = hours + ":"
//     + minutes + ":" + seconds + " Hrs";

//     // If the count down is over, write some text 
//     if (distance < 0) {
//         clearInterval(x);
//         document.getElementById("progressBar").innerHTML = "EXPIRED";
//     }
// }, 1000);
// }


function defaultModal(x){
$('#defaultQuantityModal').modal('toggle');
// data-wishlist="0" 
// onclick="addProductToCart(this)"
// data-qty="`+qty+`" 
// data-total-price="`+ogprice+`" 
// data-qty-code="`+code+`"
// data-type="checkout"
// data-user="6332a495362d8"

var wishlist = $(x).attr('data-wishlist');  
var qty = $(x).attr('data-qty');
var totalPrice = $(x).attr('total-price');
var code = $(x).attr('data-qty-code');
var type = $(x).attr('data-type');
var user = $(x).attr('data-user');

var strength = $('.main-product-data .nav-link.active').html();

$('.success-title').attr('data-wishlist', wishlist);
$('.success-title').attr('data-qty', qty);
$('.success-title').attr('data-total-price', totalPrice);
$('.success-title').attr('data-qty-code', code);
$('.success-title').attr('data-type', type);
$('.success-title').attr('data-user', user);
$('.success-title').attr('onclick', 'addProductToCart(this)');

$('.strength-info .count-box').html(strength);
$('.pills-info .count-box').html(qty);
}

$('.success-title').on('click', function() {
$('#defaultQuantityModal').modal('toggle');
var type = $(this).attr('data-type');
if(type=='cart'){
    $('.main-product-data .action-button .add-cart-button').addClass('button--loading');
}else {
    $('.main-product-data .action-button .order-now').addClass('button--loading');
}
});