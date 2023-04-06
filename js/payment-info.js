var websitename = window.location.href;
var url_string = websitename; 
var url = new URL(url_string);
var c = url.searchParams.get("payment-name");

$('.front-data').show();
$('.back-data').hide();

$('.mob-button-payment.show-more').on('click', function() {
    $('.payment-box').removeClass('open');
    $('.front-data').show();
    $('.back-data').hide();
    $(this).parent().find('.front-data').toggle();
    $(this).parent().find('.back-data').toggle();
    $(this).parent().addClass('open');
});
if(websitename.includes('payment-name')){
    if(screen.width>450){
        $(window).on('load',function(){
            var delayMs = 100; // delay in milliseconds
            
            setTimeout(function(){
                $('#payment-modal').modal('show');
                $('.pay-section').hide();
                $('.'+c).show();
            }, delayMs);
        });
    }else {
        $('.'+c+'box .front-data').hide();
        $('.'+c+'box .back-data').show();
        $('.'+c+'box').addClass('open');
        var topOfElement = document.querySelector('.'+c+'box').offsetTop - 130;
        window.scroll({ top: topOfElement, behavior: "smooth" });
        // $('.'+c+'box').get(0).scrollIntoView();
    }
}


// document.getElementsByClassName("desk-button-payment").click();

$('.mob-button-payment.show-less').on('click', function() {
    $(this).parent().find('.front-data').toggle();
    $(this).parent().find('.back-data').toggle();
    $(this).parent().removeClass('open');
});

$('#payment').on('click', function() {
    $("#payment-modal").modal("show");
})


$('.pay-section').hide();
$(".desk-button-payment").click(function () {
    $("#payment-modal").modal("show");
    var name = $(this).attr('id');
    $('.pay-section').hide();
    $('.'+name).show();
});

$('.payment-logo').marquee({
    direction: 'left',
    duration: 50000,
    gap: 230,
    delayBeforeStart: 0,
    duplicated: true,
    startVisible: true
});

// Start marquee


