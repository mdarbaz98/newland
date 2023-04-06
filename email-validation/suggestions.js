const searchWrapper = document.querySelector(".addressSearch");
const inputBox = searchWrapper.querySelector("input");
inputBox.onkeyup = (e)=>{
        if(e.target.value.length>4){
            listData = "";
            searchWrapper.classList.add("active");
            delay(function () {  
                $.ajax({
                    url: 'address.php',
                    type: 'post',
                    data: {'address':encodeURIComponent(e.target.value)},
                    dataType: 'json',
                    success: function(data) {
                        var suggestions = [];
                        for(var i in data)
                            suggestions.push([data[i]]);

                        if(suggestions.length>0){
                            for(var i=0; i<suggestions.length; i++){
                                listData += "<li onclick='select(this)'>"+suggestions[i]+"</li>";
                            }
                        }else {
                            listData = "<li onclick='select(this)'>"+e.target.value+"</li>";
                        }
                            $('.autocom-box').html(listData);
                    }
                })
            }, 300);
        }else {
            searchWrapper.classList.add("active");
            listData = "<li onclick='select(this)'>"+e.target.value+"</li>";
            $('.autocom-box').html(listData);
        }
}


let $email = $('#email');
$email.on('keydown', function (e) {
    $(".email").removeClass("error");
    $(".email").removeClass("success");
    $(".email").addClass("loader");
    var email = $('#email').val();
        if(e.key != 'ArrowLeft'){
            if(e.key != 'ArrowRight'){
                delay(function () {     
                    if(validateEmail($('#email').val())){ 
                        $.ajax({
                            url: 'action.php',
                            type: 'post',
                            data: {'email':$('#email').val()},
                            success: function(data) {
                                $('.emailerror').html('');
                                $('.emailsuccess').html('');
                                if(data=='Bounce'){
                                    $(".email").removeClass("loader");
                                    $(".email").removeClass("success");
                                    $(".email").addClass("error");
                                }else if(data=='Disposable'){
                                    $(".email").removeClass("loader");
                                    $(".email").removeClass("success");
                                    $(".email").addClass("error");
                                }else if(data=='Syntax'){
                                    $(".email").removeClass("loader");
                                    $(".email").removeClass("success");
                                    $(".email").addClass("error");
                                }else {
                                    $(".email").removeClass("loader");
                                    $(".email").removeClass("error");
                                    $(".email").addClass("success");
                                }
                            }
                        }) 
                    }else {
                        $(".email").removeClass("loader");
                        $(".email").removeClass("success");
                        $(".email").addClass("error");
                    }     
                }, 400);
            }
        }
}); 

let $phone = $('#phone');
$phone.on('input', function (e) {
    phoneVerify();
}); 



var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})()
function select(element){
    let selectData = element.textContent;
    inputBox.value = selectData;
    searchWrapper.classList.remove("active");
}


$(function () {
    var input = document.querySelectorAll("input[name=phone]");
    var iti_el = $('.iti.iti--allow-dropdown.iti--separate-dial-code');
    if(iti_el.length){
        iti.destroy();
    }
    for(var i = 0; i < input.length; i++){
        iti = intlTelInput(input[i], {
            
            autoHideDialCode: false,
            autoPlaceholder: "aggressive" ,
            initialCountry: "us",
            separateDialCode: true,
            preferredCountries: ['us', 'uk'],
            customPlaceholder:function(selectedCountryPlaceholder,selectedCountryData){
                var numberLength = selectedCountryPlaceholder.length;
                console.log(numberLength);
                $('#phonelength').val(numberLength);
                console.log(numberLength);
                return ''+selectedCountryPlaceholder.replace(/[0-9]/g,'X');
            },
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io?token=26abe7355b303f', function() {}, "jsonp").always(function(resp) {
                  var countryCode = (resp && resp.country) ? resp.country : "us";
                  callback(countryCode);
              });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/js/utils.js" // just for 
        });
        $('input[name="phone"]').on("focus click countrychange", function(e, countryData) {
            
            var pl = $(this).attr('placeholder') + '';
            var res = pl.replace( /X/g ,'9');
            var numberLength = res.length;
            $('#phonelength').val(numberLength);
            console.log(res);
            if(res != 'undefined'){
                $(this).inputmask(res, {placeholder: "X", clearMaskOnLostFocus: false});
                
            phoneVerify();
            }
            
        });
        $('input[name="phone"]').on("focusout", function(e, countryData) {
            
            var intlNumber = iti.getNumber();
            // console.log(intlNumber);   
        });
        
    }
})


function phoneVerify() {
    $(".phone").removeClass("error");
    $(".phone").removeClass("success");
    $(".phone").addClass("loader");
    var phone = $('#phone').val();
    var phoneLength = $('#phonelength').val();
    var phone = phone.replace('X','');
    console.log("Number Length: "+phoneLength);
    console.log('Enter Length: '+phone);
        if(phone.length==phoneLength){
                delay(function () {   
                    var code = $('.iti__selected-dial-code').html().replace('+','');
                    var phone = $('#phone').val();
                    var phone = phone.replace('X','');  
                    var phone = phone.replace('-','');  
                    var phone = phone.replace(' ','');      
                    $.ajax({
                        url: 'action.php',
                        type: 'post',
                        data: {'phone':phone, 'code':code},
                        success: function(data) {
                        $(".phone").removeClass("loader");
                            $('.phonesuccess').html('');
                            $('.phoneerror').html('');
                            if(data){
                                $(".phone").addClass("success");
                            }else {
                                $(".phone").addClass("error");
                            }
                        }
                    })      
                }, 100);
        }else if(phone.length==0){
            $(".phone").addClass("error");
            $(".phone").removeClass("success");
            $(".phone").removeClass("loader");
        }else if(phone.length>0){
            $(".phone").addClass("loader");
            $(".phone").removeClass("success");
            $(".phone").removeClass("error");
        }else {
            $(".phone").removeClass("error");
        }
} 
function validateEmail(email) 
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
  
$('#zipcode').on('input', function() {
    $(".zipcode").removeClass("loader");
    $(".zipcode").removeClass("success");
    $(".zipcode").removeClass("error");
    var zipcode = $('#zipcode').val();
    if(zipcode.length>4){
        $(".zipcode").addClass("loader");
        $(".zipcode").removeClass("success");
        $(".zipcode").removeClass("error");
        delay(function () { 
        $.ajax({
            url: 'action.php',
            type: 'post',
            type: 'post',
            data: {'zipcode':zipcode},
            dataType: 'json',
            success: function(data) {
                if(data=='error'){
                    $(".zipcode").addClass("loader");
                    $(".zipcode").removeClass("success");
                    $(".zipcode").removeClass("error");
                    $('.ziperror').html('Enter Valid Zip');
                }else {
                    $(".zipcode").removeClass("loader");
                    $(".zipcode").addClass("success");
                    $(".zipcode").removeClass("error");
                    var json = $.parseJSON(JSON.stringify(data));
                    var city = json.city;
                    var state = json.state;
                    var country = json.country;
                    
                    $('#city').val(city);
                    $('#state').val(state);
                    $('#country').val(country);
                }

            }
        })  
    }, 400);
    }
    else if(zipcode.length>0 && zipcode.length<4){
        $(".zipcode").addClass("loader");
        $(".zipcode").removeClass("success");
        $(".zipcode").removeClass("error");
    }
})