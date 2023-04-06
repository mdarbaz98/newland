var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})()

$('.emailerror').html('');
$('.emailsuccess').html('');
$('.phoneerror').html('');
$('.ziperror').html('');
$('.phonesuccess').html('');
let $email = $('#email');
$email.on('keydown', function (e) {
    var email = $('#email').val();
    console.log(e.key);
    if(validateEmail(email)){
        if(e.key != 'ArrowLeft'){
            if(e.key != 'ArrowRight'){
                delay(function () {            
                    $.ajax({
                        url: 'action.php',
                        type: 'post',
                        data: {'email':$('#email').val()},
                        success: function(data) {
                            $('.emailerror').html('');
                            $('.emailsuccess').html('');
                            if(data=='Bounce'){
                                $('.emailerror').html('Email not exist');
                            }else if(data=='Disposable'){
                                $('.emailerror').html('We not allowed temprory email');
                            }else if(data=='Syntax'){
                                $('.emailerror').html('Please enter valid emai');
                            }else {
                                $('.emailsuccess').html('Verified');
                            }
                        }
                    })      
                }, 400);
            }
        }
    }else {
        $('.emailerror').html('');
        $('.emailsuccess').html('');
        $('.emailerror').html('Please enter valid email');
    }
}); 

let $phone = $('#phone');
$phone.on('input', function (e) {
    phoneVerify();
}); 

function phoneVerify() {
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
                            $('.phonesuccess').html('');
                            $('.phoneerror').html('');
                            if(data){
                                $('.phonesuccess').html('Verified');
                            }else {
                                $('.phoneerror').html('Enter Valid Number');
                            }
                        }
                    })      
                }, 100);
        }else {
            $('.phonesuccess').html('');
            $('.phoneerror').html('');
            $('.phoneerror').html('Enter Valid Number');
    }
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
            autoPlaceholder: "aggressive1" ,
            initialCountry: "us",
            separateDialCode: true,
            preferredCountries: ['in', 'in'],
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

$('.iti__country iti__standard').on('click', function(){
    alert('working');
})

$('#zipcode').on('input', function() {
    var zipcode = $('#zipcode').val();
    if(zipcode.length>4){
        $.ajax({
            url: 'action.php',
            type: 'post',
            type: 'post',
            data: {'zipcode':zipcode},
            dataType: 'json',
            success: function(data) {
                if(data=='error'){
                    $('.ziperror').html('Enter Valid Zip');
                }else {
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
    }
})

function validateEmail(email) 
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}
    