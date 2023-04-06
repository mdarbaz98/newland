
var telInput = $("#phone"),
errorMsg = $("#error-msg"),
validMsg = $("#valid-msg");

// initialise plugin
telInput.intlTelInput({
setNumber: +44,
allowExtensions: true,
formatOnDisplay: true,
autoFormat: true,
autoHideDialCode: true,
autoPlaceholder: true,
defaultCountry: "auto",
ipinfoToken: "yolo",

nationalMode: true,
numberType: "MOBILE",
//onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
preferredCountries: ['us', 'uk','ch', 'ca', 'do'],
preventInvalidNumbers: true,
separateDialCode: true,
initialCountry: "us",
});

var reset = function() {
telInput.removeClass("error");
errorMsg.addClass("hide");
validMsg.addClass("hide");
};

// on blur: validate
telInput.blur(function() {
reset();
if ($.trim(telInput.val())) {
  if (telInput.intlTelInput("isValidNumber")) {
    validMsg.removeClass("hide");
  } else {
    telInput.addClass("error");
    errorMsg.removeClass("hide");
  }
}
});

// on keyup / change flag: reset
telInput.on("keyup change", reset);


