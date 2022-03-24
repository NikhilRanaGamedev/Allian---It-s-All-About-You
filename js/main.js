//Preloader
var preloader = $('#spinner-wrapper');
$(window).on('load', function() {
    var preloaderFadeOutTime = 500;

    function hidePreloader() {
        preloader.fadeOut(preloaderFadeOutTime);
    }
    hidePreloader();
});

// toggle password visibility
$('#login_password + i').on('click', function() {
  $(this).toggleClass('fa-eye').toggleClass('fa-eye-slash'); // toggle our classes for the eye icon
  var x = document.getElementById("login_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    } // activate the hideShowPassword plugin
});

// about routing
var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "basic_info.php"
    })
    .when("/education_work", {
        templateUrl : "education_work.php"
    })
    .when("/my_interests", {
        templateUrl : "interests.php"
    })
    .when("/account_settings", {
        templateUrl : "account_settings.php"
    })
    .when("/change_password", {
        templateUrl : "change_password.php"
    });
});

// Geolocation
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
}

// Button Check
//
// $(document).ready(function(){
//     $('#publish').prop('disabled',true);
//     $('#post_msg').keyup(function(){
//         $('#publish').prop('disabled', this.value == "" ? true : false);
//     })
// });
//
// $(document).ready(function(){
//     $('#publish').prop('disabled',true);
//     $('#post_image').keyup(function(){
//         $('#publish').prop('disabled', this.value == "" ? true : false);
//     })
// });
SNButton.init("publish");
