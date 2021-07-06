$(".show_password").on("click", function () {
  input = $(this).prev();

  if ($(input).attr("type") === "password") {
    $(input).attr("type", "text");
    $(this).removeClass("hide");
    $(this).addClass("show");
  } else {
    $(input).attr("type", "password");
    $(this).removeClass("show");
    $(this).addClass("hide");
  }
});

$(".resend_another").on("click", function () {
  $(".reg_inp_email").val("");
  $(".after_submit_block").fadeOut("slow");
  setTimeout(function () {
    $(".single_webinar_register").fadeIn();
  }, 600);
});

$("#phone").on("change", function () {
  text = $(".iti__selected-dial-code").text();
  $("#phone_code").val(text);
});

$.exists = function (selector) {
  return $(selector).length > 0;
};

var state_selector = $("#state_selector");
var country_selector = $("#country_selector");
var country_result = $("#dynamic_hidden_country");
country_selector.countrySelect({
  defaultCountry: "us"
});
var country_selected = country_selector.countrySelect("getSelectedCountryData");
// console.log(country_selected.iso2);
var start_country = country_selector.val();
country_result.val(start_country);

country_selector.on("change", function (e) {
  var country = $(this).val();
  country_result.val(country);
});
var data_path = $("body").attr("data-path");
var build_url = data_path + "/assets/js/intl-tel-input/js/utils.js";
var input = document.querySelector("#phone");
if ($.exists(input)) {
  var input_tel = intlTelInput(input, {
    utilsScript: build_url,
    autoPlaceholder: "aggressive",
    initialCountry: "auto",
    separateDialCode: true,
    geoIpLookup: function (callback) {
      $.get("https://ipinfo.io", function () {}, "jsonp").always(function (
        resp
      ) {
        var countryCode = resp && resp.country ? resp.country : "";
        callback(countryCode);
      });
    },
    nationalMode: true
  });
  setTimeout(function () {
    var full_input = input_tel;
    var countryData = input_tel.getSelectedCountryData();
    var iso_2 = countryData.iso2;
    country_selector.countrySelect("selectCountry", iso_2);
    if (iso_2 == "us") {
      state_selector.attr("disabled", false);
      state_selector.removeClass("disabled");
    } else {
      state_selector.attr("disabled", true);
      state_selector.addClass("disabled");
    }
  }, 1000);
}
$("#country_selector").on("change", function () {
  var countryData = country_selector.countrySelect("getSelectedCountryData");
  var iso_2 = countryData.iso2;
  // console.log(iso_2);
  if (iso_2 == "us") {
    state_selector.attr("disabled", false);
    state_selector.removeClass("disabled");
  } else {
    state_selector.attr("disabled", true);
    state_selector.addClass("disabled");
  }
});
$("#phone").on("change", function () {
  var number = input_tel.getNumber(intlTelInputUtils.numberFormat.E164);
  //console.log(number);
  $("#dynamichidden-phone").val(number);
});

$(document).ready(function () {
  $("#user_pass").keyup(validate);
  $("#user_pass_repeat").keyup(validate);
});

function validate() {
  var password1 = $("#user_pass").val();
  var password2 = $("#user_pass_repeat").val();
  var password1_t = $("#user_pass");
  var password2_t = $("#user_pass_repeat");

  var match = $("#match");
  var length = $("#length");
  var lowercase = $("#lowercase");
  var upper = $("#upper");
  var numb = $("#numb");

  var btn = $(".change-pass");

  // Проверка одинаковы ли введены пароли
  if (password1 == password2) {
    if (password1 == "" || password2 == "") {
      password2_t.addClass("error");
      match.css("color", "red");
      match.addClass("false");
      match.removeClass("true");
    } else {
      password2_t.removeClass("error");
      password2_t.addClass("change");
      match.css("color", "green");
      match.addClass("true");
      match.removeClass("false");
    }
  } else {
    password2_t.removeClass("change");
    password2_t.addClass("error");
    match.css("color", "red");
    match.addClass("false");
    match.removeClass("true");  
  }

  // Проверка количества символов
  if (password1.length <= 7) {
    length.css("color", "red");
    length.addClass("false");
    length.removeClass("true");
  } else {
    length.css("color", "green");
    length.addClass("true");
    length.removeClass("false");
  }

  // Проверка есть ли регистр строчных букв
  if (!/[a-z]/.test(password1)) {
    lowercase.css("color", "red");
    lowercase.addClass("false");
    lowercase.removeClass("true");
  } else {
    lowercase.css("color", "green");
    lowercase.addClass("true");
    lowercase.removeClass("false");
  }

  // Проверка есть ли регистр заглавных букв
  if (!/[A-Z]/.test(password1)) {
    upper.css("color", "red");
    upper.addClass("false");
    upper.removeClass("true");
  } else {
    upper.css("color", "green");
    upper.addClass("true");
    upper.removeClass("false");
  }

  // Проверка есть ли цифры в пароле
  if (!/[0-9]/.test(password1)) {
    numb.css("color", "red");
    numb.addClass("false");
    numb.removeClass("true");
  } else {
    numb.css("color", "green");
    numb.addClass("true");
    numb.removeClass("false");
  }

  // Проверка всех условий
  if ( match.hasClass('true') && 
    length.hasClass('true') && 
    lowercase.hasClass('true') && 
    upper.hasClass('true') && 
    numb.hasClass('true') ) {

    btn.attr("disabled", false);
  } else {
    btn.attr("disabled", true)
  }
}

// $(document).ready(function () {
//   $(".menu-item a").click(nav_menu);
// });

// function nav_menu() {
//   var link = $(".header_menu li a");
//   var submenu = link.prev().find('.sub-menu');

//   $(link).click(function() {
//     $(this).find('.sub-menu').css('display', 'block');
//   });
// }

// $('.header_menu > li > a').click(function() {
//   var submenu = $(this).next('.sub-menu');
//   submenu.slideToggle();
//   $(this).toggleClass('active');
// });

var menuBtn = $('.header_menu > li > a'),
    menu    = menuBtn.next('.sub-menu');

menuBtn.on('click', function() {
  if ( $(this).hasClass('active') ) {
    $(this).removeClass('active');
    $(this).next('.sub-menu').slideUp();
  } else {
    $(this).addClass('active');
    $(this).next('.sub-menu').slideDown();
  }
});

$(document).click(function (e) {
  if ( !menuBtn.is(e.target) && !menu.is(e.target) && menu.has(e.target).length === 0) {
    menu.slideUp();
    menuBtn.removeClass('active');
  };
});

$('.cf_check').click(function() {

  this_check = $(this);

    if ($(this).find('input[type="radio"]').is(':checked')) {
      $('.cf_check_btn').removeClass('active');
      $(this_check).find('.cf_check_btn').addClass('active');
    } else {
      $(this_check).find('.cf_check_btn').removeClass('active');
    }
  });

$('#webinar_form').on('change', function() {
  if ( $('input[name="acceptance"]').is(':checked') ) {
    $('#wp-submit').attr('disabled', false);
  } else {
    $('#wp-submit').attr('disabled', true);
  }
});
