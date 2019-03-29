var path = window.location.href;
jQuery(document).ready(function () {

    jQuery(".add-cart").click(function () {
//        showLoader();
        var closest_div = jQuery(this).closest(".product");
        jQuery('.alert-success').addClass('hide');
        var canname = jQuery(this).attr('pro_id');
        var list_id = jQuery(this).attr('data-val');
        var qty = jQuery('#quantity').val();
        addcart(canname, qty, list_id, closest_div);

    });
    jQuery(".add_cart").click(function () {
//        showLoader();
        var closest_div = jQuery(this).closest(".product");
        jQuery('.alert-success').addClass('hide');
        var canname = jQuery(this).attr('pro_id');
        var list_id = jQuery(this).attr('data-val');
        var qty = jQuery('#quantity_').val();
        addcart(canname, qty, list_id, closest_div);

    });


    jQuery(".buy-now").click(function () {
        showLoader();
        jQuery('.alert-success').addClass('hide');
        var canname = jQuery(this).attr('pro_id');
        var list_id = jQuery(this).attr('data-val');
        var qty = jQuery('#quantity').val();
        Buynow(canname, qty, list_id);
    });
//    jQuery(".buy_now").click(function () {
//        showLoader();
//        jQuery('.alert-success').addClass('hide');
//        var canname = jQuery(this).attr('id');
//        var list_id = jQuery(this).attr('data-val');
//        var qty = jQuery('.quantity').val();
//        Buynow(canname, qty, list_id);
//    });

    jQuery('body').on('click', '.dd-close-btn', function () {
        jQuery('.dropdown-menu').css('visibility', 'hidden');
    });
//    jQuery('body').on('mouseover', '.cart-dropdown', function () {
//        if (jQuery('.dropdown-menu').css('display') == 'none')
//        {
//alert('hai');
//        }
////        jQuery('.dropdown-menu').css('display', 'block');
//    });
    jQuery('.loginCheckout').click(function () {
        var modal = document.getElementById('myModal');

        modal.style.display = "block";

    });
    jQuery('.close-alert').click(function () {
        jQuery('.alert-success').addClass('hide');
    });
    jQuery('body').on('click', '.remove_cart', function () {
        var answer = confirm("Are you sure want to remove?");
        if (answer)
        {
            showLoader();
            var jQueryid = jQuery(this).attr('data-product_id');
            var jQuerycount = jQuery('#cart_count').val();
            jQuery('.error_' + jQueryid).html('');
            jQuery.ajax({
                url: homeUrl + 'cart/cart_remove',
                type: "post",
                data: {id: jQueryid, count: jQuerycount},
                success: function (data) {
                    var jQuerydata = JSON.parse(data);
                    if (jQuerydata.msg === "success") {
                        jQuery('.tr_' + jQueryid).remove();
                        getcart();
                        jQuery('.cart_subtotal').html('AED ' + jQuerydata.subtotal);
                        jQuery('.shipping-cost').html('AED ' + jQuerydata.shipping);
                        jQuery('.grand_total').html('AED ' + jQuerydata.grandtotal);
                        jQuery('#cart_count').val(jQuerydata.count);
                        hideLoader();
                    } else {
                        window.location.href = homeUrl + "cart/mycart";
                    }
                }, error: function () {
                    jQuery('.error_' + jQueryid).html('Cannot Find');
                }
            });
        }
    });
    jQuery('body').on('click', '.remove_cart_product', function (e) {
        var answer = confirm("Are you sure want to remove?");
        if (answer)
        {
//            showLoader();
            var jQueryid = jQuery(this).attr('data-product_id');
//            var jQuerycount = jQuery('#cart_count_').val();
////            jQuery('.error_' + jQueryid).html('');
            jQuery.ajax({
                url: homeUrl + 'cart/remove_cart',
                type: "post",
                data: {id: jQueryid},
                success: function (data) {
                    var jQuerydata = JSON.parse(data);
                    if (jQuerydata.msg === "success") {
                        window.location.href = jQuerydata.href;
                    }
                }
            });
        } else {
            e.preventDefault();
        }
    });

    /*
     * to change quantity fron cart page
     */

    jQuery('.cart_quantity').on('change keyup', function () {
        showLoader();
        var quantity = this.value
        var jQueryids = jQuery(this).attr('id');
        var ids = jQueryids.split('_');
        var id = ids['1'];
        var jQuerycount = jQuery('#cart_count').val();
        if (quantity != '' && parseInt(quantity) > '0') {
            findstock(id, quantity);
            updatecart(id, quantity, jQuerycount);
            PromotionQuantityChange();
        } else if (quantity != '') {
            jQuery('#quantity_' + id).val('1');
        }
    });
    jQuery(".add_to_wish_list").click(function () {

        var canname = jQuery(this).attr('id');
        var div_id = jQuery(this).parent().closest('div').attr('class').split(' ');
        var other = jQuery(this).attr('other');

        if (other && other != '') {
            addwishlist(jQuery(this), canname, jQuery(this).closest(".detail-wishlist"));
        } else {
            addwishlist(jQuery(this), canname, jQuery(this).closest(".all-product-box"));
        }

        jQuery('.alert-success').removeClass('wishlist_hide');
        setTimeout(function () {
            jQuery('.wishlist_message').remove();
        }, 2000);

    });

    jQuery(".remove-wish-list").click(function () {
        var answer = confirm("Are you sure want to remove?");
        if (answer)
        {
            showLoader();
            var canname = jQuery(this).attr('id');
            var list_id = jQuery(this).attr('data-val');
            removewishlist(list_id, canname);
        }
    });

    jQuery(".mobile").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        var mobile = jQuery(this).val();
        console.log(mobile);
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        } else if (mobile.length === 10) {
            return false;
        }
    });

    jQuery('.apply-coupen').on('click', function (e) {
        e.preventDefault();
        var code = jQuery('#coupon_code').val();
        var order_id = jQuery('#master_order_id').val();
        var promotion_amount = jQuery('#promotion-code-amount').val();
        jQuery.ajax({
            url: homeUrl + 'cart/promotion-check',
            type: "POST",
            data: {code: code, promotion_amount: promotion_amount, order_id: order_id},
            success: function (data) {
                jQuery('.help-block').remove();
                var res = jQuery.parseJSON(data);
                if (res.result['msg'] == 6) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">In order to avail the benefits of this promotional code, please Login/Sign Up.</div>');
                } else if (res.result['msg'] == 1) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">Invalid Code! Please try another one.</div>');
                } else if (res.result['msg'] == 2) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">Code validity expired !</div>');
                } else if (res.result['msg'] == 3) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">Sorry!! You are already used this code!</div>');
                } else if (res.result['msg'] == 4) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">Invalid Code! Please try another one.</div>');
                } else if (res.result['msg'] == 5) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">This code is only when purchase items above AED  ' + res.result['amount'] + '</div>');
                } else if (res.result['msg'] == 7) {
                    jQuery('.help-block').hide();
                    var codes = jQuery('#promotion-codes').val();
                    if (codes && codes != '') {
                        var promo_values = jQuery('#promotion-codes').val() + ',' + res.result['discount_id'];
                    } else {
                        var promo_values = res.result['discount_id'];
                    }
                    jQuery('#promotion-codes').val(promo_values);
                    jQuery('#coupon_code').val('');
                    jQuery('#promotion-code-amount').val(res.result['total_promotion_amount']);
                    jQuery('#promotions-listing').append('<p id="disc_' + res.result['discount_id'] + '">Coupon code  ' + res.result['code'] + ' is added with AED ' + res.result['amount'] + ' <a class="promotion-remove" title="Remove" id="' + res.result['discount_id'] + '" type="' + res.result['temp_session'] + '"><i class="far fa-times-circle"></i></a></p>');
                    jQuery('.cart-promotions').show();
                    jQuery('.promotion_discount').text('AED ' + res.result['total_promotion_amount']);
                    jQuery('.checkout-total').html('AED ' + res.result['overall_grand_total']);
                } else if (res.result['msg'] == 8) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">Sorry!! You are already used this code!</div>');
                } else if (res.result['msg'] == 9) {
                    jQuery("#coupon-code-error").append('<div class="help-block" style="color:red">You can use only one coupon code</div>');
                }


            }
        });
    });

    jQuery(document).on('click', '.promotion-remove', function () {

        var id = jQuery(this).attr('id');
        var temp_id = jQuery(this).attr('type');
        var promo_codes = jQuery('#promotion-codes').val();
        var order_id = jQuery('#master_order_id').val();
        jQuery.ajax({
            url: homeUrl + 'cart/promotion-remove',
            type: "POST",
            data: {id: id, promo_codes: promo_codes, temp_id: temp_id, order_id: order_id},
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                jQuery('#disc_' + id).remove();
                jQuery('#promotion-codes').val(obj.code);
                jQuery('#promotion-code-amount').val(obj.total_promotion_amount);
                if (obj.total_promotion_amount > 0) {
                    jQuery('.cart-promotion').show();
                    jQuery('.promotion_discount').text(obj.total_promotion_amount);
                } else {
                    jQuery('.cart-promotions').hide();
                }
                jQuery('.checkout-total').html('<span class=""> AED </span>' + obj.overall_grand_total);
            }
        });
    });


    /************ Serach ****************/
    jQuery('.search-keyword').on('keyup', function (e) {
        var dropdown = jQuery(this).attr('drop');
        if (jQuery(this).val()[0] === " ") {

        } else {
            if (e.keyCode != 40 && e.keyCode != 38 && e.keyCode != 27) {
                jQuery.ajax({
                    url: homeUrl + 'product/search-keyword',
                    type: "POST",
                    data: {keyword: jQuery(this).val()},
                    success: function (data) {
                        jQuery('.' + dropdown).html(data);
                    }
                });
            }
        }
    });

    /********* selected li value to textbox **********/
    jQuery(document).on('mousedown', '.search-dropdown li', function () {
        jQuery('.search-dropdown').hide();
        jQuery('.search-keyword').val(jQuery(this).attr('id'));
        jQuery('form.product-search-box').submit();
    });

    /********************li navigation keys ***************/
    jQuery('.search-keyword').on('keydown', function (e) {

        if (e.keyCode == 40) { //down

            var selected = jQuery(".search-selected");
            jQuery('.search-dropdown li').removeClass('search-selected');
            if (selected.next().length == 0) {
                selected.siblings().first().addClass('search-selected');
            } else {
                selected.next().addClass('search-selected');
            }
        } else if (e.keyCode == 38) { //up

            var selected = jQuery(".search-selected");
            jQuery('.search-dropdown li').removeClass('search-selected');
            if (selected.prev().length == 0) {
                selected.siblings().last().addClass('search-selected');
            } else {
                selected.prev().addClass('search-selected');
            }
        } else if (e.keyCode == 27) { //escape

            jQuery('.search-dropdown').hide();
            jQuery('.search-keyword').val('');

        } else if (e.keyCode == 13) { //enter

            var value = jQuery('.search-selected').attr('id');
            jQuery('.search-dropdown').hide();
            if (value) {
                jQuery('.search-keyword').val(value);
            } else {
                jQuery('.search-keyword').val(jQuery(this).val());
            }
            jQuery('form.product-search-box').submit();
            e.preventDefault();
        }

        var nav = jQuery('.search-dropdown');
        if (nav.length) {
            jQuery(".search-dropdown").scrollTop(0);//set to top
            jQuery(".search-dropdown").scrollTop(jQuery('.search-selected:first').offset().top - jQuery(".search-dropdown").height())
        }

    });

    jQuery('.beauty').hover(function () {
        var id = jQuery(this).attr('id');
        jQuery('.beautyimage').addClass('hide');
        jQuery('.beautyimage_' + id).removeClass('hide');
    });
    jQuery('.fregrance').hover(function () {
        var id = jQuery(this).attr('id');
        jQuery('.fregranceimage').addClass('hide');
        jQuery('.fregranceimage_' + id).removeClass('hide');
    });


});
/**shipping/billing address****/
jQuery('#address-form').on('submit', function (e) {
    e.preventDefault();
    jQuery('.error').html('');
    var check = 'true';
    if (jQuery('#useraddress-name').val() === "") {
        jQuery('.name_error').html('Name Cannot be blank');
        var check = 'false';
    }
    if (jQuery('#useraddress-address').val() === "") {
        jQuery('.address_error').html('Address Cannot be blank');
        var check = 'false';
    }
    if (jQuery('#useraddress-location').val() === "") {
        jQuery('.location_error').html('Location Cannot be blank');
        var check = 'false';
    }
    if (jQuery('#useraddress-emirate').val() === "") {
        jQuery('.emirate_error').html('Emirates Cannot be blank');
        var check = 'false';
    }
//    if (jQuery('#useraddress-post_code').val() === "") {
//        jQuery('.post_code_error').html('Post Code Cannot be blank');
//        var check = 'false';
//    }
    if (jQuery('#useraddress-mobile_number').val() === "") {
        jQuery('.mobile_number_error').html('Mobile Number Cannot be blank');
        var check = 'false';
    }
//    console.log(check);
    if (check === "true") {
        jQuery("#address-form").submit();
    }

});
/*****************Contact Us*****************/
jQuery('#contact-form').on('submit', function (e) {
    e.preventDefault();
    jQuery('.error').html('');
    var check = 'true';
    if (jQuery('#contactus-first_name').val() === "") {
        jQuery('.first_name_error').html('First name Cannot be blank');
        var check = 'false';
    }
    if (jQuery('#contactus-last_name').val() === "") {
        jQuery('.last_name_error').html('Last name Cannot be blank');
        var check = 'false';
    }
    if (jQuery('#contactus-email').val() === "") {
        jQuery('.email_error').html('Email Cannot be blank');
        var check = 'false';
    }
    if (jQuery('#contactus-mobile_no').val() === "") {
        jQuery('.mobile_no_error').html('Mobile Number Cannot be blank');
        var check = 'false';
    }
    if (jQuery('#contactus-reason').val() === "") {
        jQuery('.reason_error').html('Reason Cannot be blank');
        var check = 'false';
    }
//    console.log(check);
    if (check === "true") {
        jQuery("#contact-form").submit();
    }

});
jQuery('.billing').on('change', function () {
    if (jQuery('#useraddress-name').val() !== "") {
        jQuery('.name_error').html('');
    }
    if (jQuery('#useraddress-address').val() !== "") {
        jQuery('.address_error').html('');
    }
    if (jQuery('#useraddress-location').val() !== "") {
        jQuery('.location_error').html('');
    }
    if (jQuery('#useraddress-emirate').val() !== "") {
        jQuery('.emirate_error').html('');
    }
    if (jQuery('#useraddress-post_code').val() !== "") {
        jQuery('.post_code_error').html('');
    }
    if (jQuery('#useraddress-mobile_number').val() !== "") {
        jQuery('.mobile_number_error').html('');
    }
});
jQuery('#billing').on('change', function () {
    jQuery('.error').html('');
});


///////////     my order continue order  starts-> ////////////

jQuery('body').on('click', '.remove_order', function () {
    var answer = confirm("Are you sure want to remove?");
    if (answer)
    {
        showLoader();
        var jQueryid = jQuery(this).attr('data-product_id');
        var jQuerycount = jQuery('#cart_count').val();
        jQuery('.error_' + jQueryid).html('');
        jQuery.ajax({
            url: homeUrl + 'checkout/remove-order',
            type: "post",
            data: {id: jQueryid, count: jQuerycount},
            success: function (data) {
                var jQuerydata = JSON.parse(data);
                if (jQuerydata.msg === "success") {
                    jQuery('.tr_' + jQueryid).remove();
                    getcart();
                    jQuery('.cart_subtotal').html('AED ' + jQuerydata.subtotal);
                    jQuery('.shipping-cost').html('AED ' + jQuerydata.shipping);
                    jQuery('.grand_total').html('AED ' + jQuerydata.grandtotal);
                    hideLoader();
                } else {
                    window.location.href = homeUrl + "checkout/continue?id=" + jQuerydata.order_id;
                }
            }, error: function () {
                jQuery('.error_' + jQueryid).html('Cannot Find');
            }
        });
    }
});

jQuery('.ordqnty').on('change keyup', function () {
    showLoader();
    var quantity = this.value
    var jQueryids = jQuery(this).attr('id');
    var ids = jQueryids.split('_');
    var id = ids['1'];
    if (quantity != '' && parseInt(quantity) > '0') {
        findorderstock(id, quantity);
        updatedetail(id, quantity);
    } else if (quantity != '') {
        jQuery('#quantity_' + id).val('1');
    }
});

jQuery(".order_return").click(function () {
    var order = jQuery(this).attr('id');
    var order_id = jQuery(this).attr('ordr');
    jQuery('.order_id').html(order);
    jQuery('.return-order_id').val(order_id);
});
jQuery('.return_confirm').on('click', function () {
    var reason = jQuery('.return_reason').val();
    var order_id = jQuery('.return-order_id').val();
    if (reason !== '') {
        showLoader();
        jQuery.ajax({
            type: "POST",
            url: homeUrl + 'myaccounts/my-orders/return-order',
            data: {reason: reason, order_id: order_id},
            success: function (data) {
                var jQuerydata = JSON.parse(data);
                if (jQuerydata.msg === "success") {
                    window.location.href = homeUrl + "myaccounts/my-orders";
                }
                hideLoader();
//
            }
        });
    } else {
        jQuery('.return_error').html('Please mention your reason');
    }
});


jQuery(".order_return").click(function () {
    var order = jQuery(this).attr('id');
    var order_id = jQuery(this).attr('ordr');
    jQuery('.order_id').html(order);
    jQuery('.return-order_id').val(order_id);
});

jQuery(document).on('click', '.return_confirm', function (e) {
    e.preventDefault();
    var reason = jQuery('.return_reason').val();
    var order_id = jQuery('.return-order_id').val();
    alert(reason);
    alert(order_id);
    if (reason !== '') {
        jQuery.ajax({
            type: "POST",
            url: homeUrl + 'myaccounts/my-orders/return-order',
            data: {reason: reason, order_id: order_id},
            success: function (data) {
                var jQuerydata = JSON.parse(data);
                if (jQuerydata.msg === "success") {
                    window.location.href = homeUrl + "myaccounts/my-orders";
                }
            }
        });
    } else {
        jQuery('.return_error').html('Please mention your reason');
    }
});

jQuery(".cancel_order").click(function () {
    var order_id = jQuery(this).attr('ordr');
    jQuery('.cancel-order_id').val(order_id);
});
jQuery('.cancel_confirm').on('click', function () {
    jQuery('.return_error').html('');
    var reason = jQuery('.cancel_reason').val();
    var order_id = jQuery('.cancel-order_id').val();
    if (reason !== '') {
        jQuery.ajax({
            type: "POST",
            url: homeUrl + 'myaccounts/my-orders/cancel-order',
            data: {reason: reason, order_id: order_id},
            success: function (data) {
                var jQuerydata = JSON.parse(data);
                if (jQuerydata.msg === "success") {
                    window.location.href = homeUrl + "myaccounts/my-orders";
                }
            }
        });
    } else {
        jQuery('.return_error').html('Please mention your reason');
    }
});

/************************************************************************************************************/
function addcart(canname, qty, list_id, closest_div) {
    jQuery.ajax({
        type: "POST",
        url: homeUrl + 'cart/buynow',
        data: {product: canname, qty: qty}
    }).done(function (data) {
        if (data === 9) {
            jQuery('.option_errors').html('<p>Invalid Product.Please try again</p>').show();
        } else {
            jQuery('.alert_' + canname).removeClass('hide');
            jQuery('.shopping-cart-items').html(data);
            getcartcount();
            getcarttotal();
            if (list_id) {
                removewishlist(list_id, canname);
            }
            ShowAddCartPopup(closest_div);
        }
    });
}
function Buynow(canname, qty, list_id) {
    jQuery.ajax({
        type: "POST",
        url: homeUrl + 'cart/buynow',
        data: {product: canname, qty: qty}
    }).done(function (data) {
        if (data === 9) {
            jQuery('.option_errors').html('<p>Invalid Product.Please try again</p>').show();
        } else {
            window.location.href = homeUrl + "cart/mycart";
            if (list_id) {
                removewishlist(list_id, canname);
            }
        }
        hideLoader();
    });
}
function getcartcount() {

    jQuery.ajax({
        type: "POST",
        cache: 'false',
        async: false,
        url: homeUrl + 'cart/getcartcount',
        data: {}
    }).done(function (data) {
        jQuery(".cart_count").html(data);
//        hideLoader();
    });
}
function getcarttotal() {

    jQuery.ajax({
        type: "POST",
        cache: 'false',
        async: false,
        url: homeUrl + 'cart/getcarttotal',
        data: {}
    }).done(function (data) {
        jQuery(".cart_amount").html(data);
//        hideLoader();
    });
}

function removewishlist(list_id, canname) {
    jQuery.ajax({
        url: homeUrl + 'cart/remove-wishlist',
        type: "POST",
        data: {wish_list_id: list_id},
        success: function (data) {
//            jQuery('.tr_' + jQueryid).remove();
            jQuery('#wishlist_' + canname).remove();
            hideLoader();
            location.reload();
        }
    });
}
function getcart() {

    jQuery.ajax({
        type: "POST",
        cache: 'false',
        async: false,
        url: homeUrl + 'cart/getcart',
        data: {}
    }).done(function (data) {
        jQuery('.shop-cart').html('').html(data);
//        hideLoader();
    });
}
function findstock(id, quantity) {
    jQuery.ajax({
        type: "POST",
        url: homeUrl + 'cart/findstock',
        data: {cartid: id, quantity: quantity},
        success: function (data) {
            var jQuerydata = JSON.parse(data);
            if (jQuerydata.msg === "success") {
                jQuery('.total_' + id).html('AED ' + jQuerydata.total);
                jQuery('.quantity_' + id).val(jQuerydata.quantity);
//                jQuery('#total_' + id).html('AED ' + jQuerydata.total);
//                jQuery('#quantity_' + id).val(jQuerydata.quantity);
            } else {
                location.reload();
            }
//
        }
    });
}
function findorderstock(id, quantity) {
    jQuery.ajax({
        type: "POST",
        url: homeUrl + 'checkout/findstock',
        data: {cartid: id, quantity: quantity},
        success: function (data) {
            var jQuerydata = JSON.parse(data);
            if (jQuerydata.msg === "success") {
                jQuery('#total_' + id).html('AED ' + jQuerydata.total);
                jQuery('#quantity_' + id).val(jQuerydata.quantity);
            } else {
                location.reload();
            }
//
        }
    });
}
function updatecart(id, quantity, count) {
    var ship_charge = jQuery('.min_ship_amount').html();
    if (jQuery("#gift-wrap").prop('checked') == true) {
        var gift_wrap = 1;
    } else {
        var gift_wrap = 0;
    }
    var giftwrap_value = jQuery('.giftwrap_value').html();
    jQuery.ajax({
        type: "POST",
        url: homeUrl + 'cart/updatecart',
        data: {cartid: id, quantity: quantity, count: count},
        success: function (data) {
            var jQuerydata = JSON.parse(data);
            if (jQuerydata.msg === "success") {
                jQuery("#cart_count").val(jQuerydata.cart_count);
                jQuery('.cart_subtotal').html('AED ' + jQuerydata.subtotal);
                jQuery('.shipping-cost').html('AED ' + jQuerydata.shipping);
                jQuery('.grand_total').html('AED ' + jQuerydata.grandtotal);
                jQuery('.grand_total_value').val(jQuerydata.grandtotal);
                jQuery('#subb_total').val(jQuerydata.subtotal);
//                var subtotal = jQuerydata.subtotal;
                if (gift_wrap == '1') {
                    var result = +jQuerydata.subtotal + parseFloat(giftwrap_value);
                    var grand_total = parseFloat(jQuerydata.grandtotal) + parseFloat(giftwrap_value);
                    jQuery('.cart_subtotal').html('AED ' + result.toFixed(2));
//                    var subtotal = result;
                    jQuery('#subb_total').val(result);
                    jQuery('.grand_total').html('AED ' + grand_total.toFixed(2));
                    jQuery('.grand_total_value').val(grand_total);
                }
                hideLoader();
            }
        }
    });
}
function updatedetail(id, quantity) {
    var ship_charge = jQuery('.min_ship_amount').html();
    var gift_wrap = jQuery('.gift_wrapp').val();
    var giftwrap_value = jQuery('.giftwrap_value').html();
    jQuery.ajax({
        type: "POST",
        url: homeUrl + 'checkout/updatecart',
        data: {cartid: id, quantity: quantity},
        success: function (data) {
            var jQuerydata = JSON.parse(data);
            if (jQuerydata.msg === "success") {
                jQuery("#cart_count").val(jQuerydata.cart_count);
                jQuery('.cart_subtotal').html('AED ' + jQuerydata.subtotal);
                jQuery('.shipping-cost').html('AED ' + jQuerydata.shipping);
                jQuery('.grand_total').html('AED ' + jQuerydata.grandtotal);
                jQuery('.grand_total_value').val(jQuerydata.grandtotal);
                jQuery('#subb_total').val(jQuerydata.subtotal);
                if (gift_wrap === '1') {
                    var result = +jQuerydata.subtotal + parseFloat(giftwrap_value);
                    var grand_total = parseFloat(jQuerydata.grandtotal) + parseFloat(giftwrap_value);
                    jQuery('.cart_subtotal').html('AED ' + result.toFixed(2));
//                    var subtotal = result;
                    jQuery('#subb_total').val(result);
                    jQuery('.grand_total').html('AED ' + grand_total.toFixed(2));
                    jQuery('.grand_total_value').val(grand_total);
                }
                hideLoader();
            }
        }
    });
}
function addwishlist(button, id, closest_div) {

    jQuery.ajax({
        type: "POST",
        cache: 'false',
        async: false,
        url: homeUrl + 'ajax/savewishlist',
        data: {product_id: id}
    }).done(function (data) {
        if (data == 0) {
            window.location.href = homeUrl + "site/login-signup";
        } else {
            ShowWishlistPopup(button, id, data, closest_div);
        }
        hideLoader();
    });
}

function ShowWishlistPopup(button, id, flag, closest_div) {
    var offset = button.offset();

    if (flag === '2') {
        closest_div.prepend('<div class="wish-list-popup"><i class="fa fa-check" aria-hidden="true"></i>Already Added to Wishlist</div>');

    } else {
        console.log('adad');
        closest_div.prepend('<div class="wish-list-popup"><i class="fa fa-check" aria-hidden="true"></i>Added to Your Wishlist</div>').delay(500).remove(".wish-list-popup");

    }
    setTimeout(function () {
        jQuery('.wish-list-popup').remove();
    }, 2000);
    jQuery('#wish-list-popup-' + id).fadeIn('fast').delay(1500).fadeOut('slow');
}

function ShowAddCartPopup(closest_div) {
    closest_div.prepend('<div class="wish-list-popup"><i class="fa fa-check" aria-hidden="true"></i>Added to cart</div>');
    setTimeout(function () {
        jQuery('.wish-list-popup').remove();
    }, 2000);
}


function PromotionQuantityChange() {
    var promo_codes = jQuery('#promotion-codes').val();
    jQuery.ajax({
        url: homeUrl + 'cart/promotion-quantity-change',
        type: "POST",
        data: {promo_codes: promo_codes},
        success: function (data) {

            var obj = jQuery.parseJSON(data);
            jQuery('#promotions-listing').html('');

            jQuery.each(obj.promotion, function (index, value) {
                jQuery('#promotions-listing').append('<p id="disc_' + value.discount_id + '">Coupon code  ' + value.code + ' is added with ' + value.amount + ' AED <a class="promotion-remove" title="Remove" id="' + value.discount_id + '"  type="' + value.temp_session + '">x</a></p>');
            });
            jQuery('#promotion-codes').val(obj.code);
            jQuery('#promotion-code-amount').val(obj.promotion_total_discount);
            if (obj.promotion_total_discount > 0) {
                jQuery('.cart-promotion').show();
                jQuery('.promotion_discount').text(obj.promotion_total_discount);
            } else {
                jQuery('.cart-promotion').hide();
            }
            jQuery('.grand_total').html('<span class="woocommerce-Price-currencySymbol"> AED </span>' + obj.overall_grand_total);
        }
    });
}


function showLoader() {
    jQuery('.page-loading-overlay').removeClass('loaded');
}
function hideLoader() {
    jQuery('.page-loading-overlay').addClass('loaded');
}
/************************************************/

/*********************************************/

