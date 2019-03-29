$(document).ready(function () {
    $(".main-carousel").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        arrows: true,
        pauseOnHover: false,
        prevArrow: $(".main-carousel-controls .prev"),
        nextArrow: $(".main-carousel-controls .next"),
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }]
    });
});
$(document).ready(function () {
    $(".branch-carousel").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        arrows: true,
        prevArrow: $(".branch-carousel-controls .prev"),
        nextArrow: $(".branch-carousel-controls .next"),
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }]
    });
});
$(document).ready(function () {
    $('.brands-carousel').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 2
                }
            }]
    });
});
$(document).ready(function () {
    $('.testimonial-carousel').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: true,
        pauseOnHover: true,
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 1
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }]
    });
});
$(document).ready(function () {
    $('.related-products-carousel').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false,
        pauseOnHover: true,
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }]
    });
});
/**************************************************Header**********************************/

window.onscroll = function () {
    myFunction();
};
var header = document.getElementById("myHeader");
var sticky = 460;
function myFunction() {
    if (window.pageYOffset >= sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}



$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 460) {
        $(".navbar").removeClass("navbar-expand-lg");
        $("#header-full").addClass("hide");
        $("#header-scroll").addClass("show");
    } else {
        $(".navbar").addClass("navbar-expand-lg");
        $("#header-full").removeClass("hide");
        $("#header-scroll").removeClass("show");
    }
});
/**************************************************Header_END**********************************/

$(document).ready(function () {

    $(".active-search").click(function () {
        $(".search-box1").toggle();
        $("input[type='search']").focus();
    });
});


jQuery(document).ready(function (e) {
    function t(t) {
        e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
        })
    }
    e(".dropdown-toggle").click(function () {
        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
        e(".button-dropdown .dropdown-menu").hide();
        e(".button-dropdown .dropdown-toggle").removeClass("active");
        if (t) {
            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
        }
    });
});

/******************************************PRODUCT_FILTER*************************************/

jQuery(document).ready(function () {
    jQuery('.scrollbar-inner').scrollbar();
});

$(function () {
    $('.categories-filter').on('hide.bs.collapse', function () {
        var button_id = $(this).attr('val');

        $('#' + button_id).html('<b class="left-b">Brand</b><span class="right-span">+</span>');
    })
    $('.categories-filter').on('show.bs.collapse', function () {
        var button_id = $(this).attr('val');
        $('#' + button_id).html('<b class="left-b">Brand</b><span class="right-span">-</span>');
    })

})

/******************************************PRODUCT_FILTER*************************************/

/******************************************QUANTITY_FILTER*************************************/

jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function () {
    var spinner = jQuery(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = input.attr('max');

    btnUp.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

    btnDown.click(function () {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });

});

/******************************************QUANTITY_FILTER*************************************/

/******************************************DROPDOWN_MENU*************************************/

 $(".sub-dropdown").hover(function () {
    $(this).toggleClass("ruby-active-menu-item");
 });
// $(".main-sub").hover(function () {
//    $(this).toggleClass("sub-dropdown");
// });
// $(".main-sub").first().addClass("sub-dropdown");

if($(window).width() <= 992){
  $(".ruby-menu-mega").click(function () {
    $(this).toggleClass("show");
 });
  $(".ruby-menu-mega-blog").click(function () {
    $(this).toggleClass("show");
 });
 }

/******************************************DROPDOWN_MENU*************************************/