//MINI CART JS
$("body").click(function (e) {
    e.stopPropagation();
    $("#notification-dropdown").fadeOut();
    $("#cartbox-dropdown-only").fadeOut();
    $("#notification-dropdown").removeClass("active");
    $("#cartbox-dropdown-only").removeClass("active");
})
$("#cart-box-btn").click(function (e) {
    e.stopPropagation();
    $("#notification-dropdown").removeClass("active");
    $("#notification-dropdown").fadeOut();
    $("#cartbox-dropdown-only").addClass("active");
    $("#cartbox-dropdown-only").fadeIn(250);
})
$("#cartbox-dropdown-only .close-cart").click(function (e) {
    e.stopPropagation();
    $("#cartbox-dropdown-only").removeClass("active");
    $("#cartbox-dropdown-only").fadeOut(250);
})
$('#cartbox-dropdown-only').click(function (e) {
    e.stopPropagation();
});

//NOTIFICATION DROPDOWN JS
$("#noti-box-btn").click(function (e) {
    e.stopPropagation();
    $("#cartbox-dropdown-only").fadeOut(0);
    $("#cartbox-dropdown-only").removeClass("active");
    $("#notification-dropdown").addClass("active");
    $("#notification-dropdown").fadeIn(250);
})
$("#notification-dropdown .close-cart").click(function (e) {
    e.stopPropagation();
    $("#notification-dropdown").removeClass("active");
    $("#notification-dropdown").fadeOut(250);
})
$('#notification-dropdown').click(function (e) {
    e.stopPropagation();
});


//PRODUCT QUANTITY SELECT INPUT
$(document).ready(function () {
    $('.quaitity-box .count').prop('disabled', false);
    // $(document).on('click','.plus-minus .plus',function(){
    $('.plus-minus .plus').click(function () {
        $(this).siblings('.quaitity-box .count').val(parseInt($(this).siblings('.quaitity-box .count').val()) + 1);
    });
    //$(document).on('click','.plus-minus .minus',function(){
    $('.plus-minus .minus').click(function () {
        $(this).siblings('.quaitity-box .count').val(parseInt($(this).siblings('.quaitity-box .count').val()) - 1);
        if ($(this).siblings('.quaitity-box .count').val() == 0) {
            $(this).siblings('.quaitity-box .count').val(1);
        }
    });
});


// CHECKPAGE JS
$("#proceed-to-review").click(function (e) {
    e.preventDefault();
    $("#shipping-tab").removeClass("active");
    $("#shipping").removeClass("active show");
    $("#review").addClass("active show");
    $("#review-tab").addClass("active");
});
$("#proceed-to-payment").click(function (e) {
    e.preventDefault();
    $("#review").removeClass("active show");
    $("#review-tab").removeClass("active");
    $("#payment").addClass("active show");
    $("#payment-tab").addClass("active");
});

// CHAT PAGE JS
$(".toggle-users").click(function (e) {
    e.preventDefault();
    $(this).toggleClass("active");
    $(".chat-box-wrap .chat-users-col").toggleClass("active");
})

//PRICE FILTER SLIDER
var priceFilterSlider = document.getElementById('price-filter');
noUiSlider.create(priceFilterSlider, {
    start: [0, 100],
    connect: true,
    tooltips: [true, true],
    range: {
        'min': 0,
        'max': 100
    }
});

// RESPONSIVE NAV TOGGLE
// let respNavToggle = document.querySelector(".resp-sidenav-toggle");
// let sideBarNav = document.querySelector(".resp-sidenav-wrap");
// let closeSideBarNav = document.querySelector(".resp-sidenav-wrap .close-sidebar");
// let bodySelector = document.querySelector("body");
// respNavToggle.addEventListener('click', () => {
//   sideBarNav.classList.toggle("active");
//   bodySelector.classList.toggle("bg-overlay");
// });
// closeSideBarNav.addEventListener('click', () => {
//   sideBarNav.classList.remove("active");
//   bodySelector.classList.remove("bg-overlay");
// });
// window.addEventListener('resize', function(event) {
//   sideBarNav.classList.remove("active");
//   bodySelector.classList.remove("bg-overlay");
// }, true);


//ADDING SEARCHBAR IN SIDEBAR
let searchComponent = document.querySelector('.header-search');
let clonedComponent = searchComponent.cloneNode(true);
$(document).ready(function () {
    if ($(window).width() < 768) {
        addSearchToSidebar()
    }
});
$(window).resize(function () {
    if ($(window).width() < 768) {
        addSearchToSidebar()
    }
    else if ($(window).width() > 768) {
        clonedComponent.remove();
    }
});
function once(fn, context) {
    var result;
    return function () {
        if (fn) {
            result = fn.apply(context || this, arguments);
            fn = null;
        }
        return result;
    };
}
var addSearchToSidebar = once(function () {
    sideBarNav.appendChild(clonedComponent);
});




// FEATURE SLIDER
var swiper = new Swiper(".featured-slider", {
    slidesPerView: 4.35,
    spaceBetween: 16,
    loop: true,
    breakpoints: {
        0: {
            slidesPerView: 2.35,
        },
        525: {
            slidesPerView: 3.35,
        },
        880: {
            slidesPerView: 4.35,
        },
    }
});

// PRICE BOX INPUT
$(document).ready(function () {
    $('.count').prop('disabled', false);
    $(document).on('click', '.plus', function () {
        $(this).siblings('.count').val(parseInt($(this).siblings('.count').val()) + 1);
    });
    $(document).on('click', '.minus', function () {
        $(this).siblings('.count').val(parseInt($(this).siblings('.count').val()) - 1);
        if ($(this).siblings('.count').val() == 0) {
            $(this).siblings('.count').val(1);
        }
    });
});

// FILE UPLOAD
FilePond.create(
    document.querySelector('#post-img-upload')
);

//POST INPUT PACKGROUND SLIDER
var swiper = new Swiper(".input-color-slider", {
    slidesPerView: "auto",
    spaceBetween: 10,
    loop: true,
    navigation: {
        nextEl: ".bg-color-wrap .swiper-button-next",
        prevEl: ".bg-color-wrap .swiper-button-prev",
    },
});




var masonry1 = new MiniMasonry({
    container: '.upcoming-gallery',
    gutter: 30,
    basewidth: 190,
    surroundingGutter: false,
});

let tabOneGals = document.querySelectorAll(".tab-gal-1");
tabOneGals.forEach(function (tabOneGal) {
    tabOneGal.addEventListener('click', function () {
        setTimeout(function () {
            loadMasonryGal1();
        }, 300);
    });
});
function loadMasonryGal1() {
    var masonry2 = new MiniMasonry({
        container: '.tab-gallery-1',
        gutter: 30,
        basewidth: 190,
        surroundingGutter: false,
    });
}
loadMasonryGal1();

let tabTwoGals = document.querySelectorAll(".tab-gal-2");
tabTwoGals.forEach(function (tabTwoGal) {
    tabTwoGal.addEventListener('click', function () {
        setTimeout(function () {
            loadMasonryGal2();
        }, 300);
    });
});
function loadMasonryGal2() {
    var masonry2 = new MiniMasonry({
        container: '.tab-gallery-2',
        gutter: 30,
        basewidth: 190,
        surroundingGutter: false,
    });
}

let tabThreeGals = document.querySelectorAll(".tab-gal-3");
tabThreeGals.forEach(function (tabThreeGal) {
    tabThreeGal.addEventListener('click', function () {
        setTimeout(function () {
            loadMasonryGal3();
        }, 300);
    });
});
function loadMasonryGal3() {
    var masonry3 = new MiniMasonry({
        container: '.tab-gallery-3',
        gutter: 30,
        basewidth: 190,
        surroundingGutter: false,
    });
}