var voucher = {'code': 0, 'discount': 0, 'total': 0};
var maps = [JSON.parse(JSON.stringify(mapObj))];
var map = new mapboxgl.Map({
    container: 'map', // container id
    style: maps[currentMapIndex].mapStyle, //stylesheet location
    center: [maps[currentMapIndex].longitude, maps[currentMapIndex].latitude], // starting position
    zoom: 14, // starting zoom
    minZoom: 5,
    preserveDrawingBuffer: true
});

map.addControl(new mapboxgl.NavigationControl());
map.addControl(new mapboxgl.FullscreenControl());
maps[currentMapIndex].bounds = map.getBounds();
//console.log(map.getCenter());

function initalizeMap(obj) {
    map.setCenter([
        obj.longitude,
        obj.latitude
    ]);
    map.setZoom(obj.zoom);
    maps[currentMapIndex].bounds = map.getBounds();
    map.setStyle(obj.mapStyle);
    $('.map-img-circle.active').removeClass('active');
    maps[currentMapIndex].mapStyle = obj.mapStyle;
    $('.map-img-circle[value="' + obj.mapStyle + '"]').addClass('active');
    maps[currentMapIndex].staticAPI = obj.staticAPI;
    //$('#'+obj.posterStyle).trigger('click');
    $('.btn-with-text.active').removeClass('active');
    $('#' + obj.posterStyle).addClass('active');
    if (obj.posterStyle == 'clean') {
        $('.map-location').hide();
        $('.map-location-modern').hide();
        $('.map-location-stricts').hide();
        maps[currentMapIndex].posterStyle = 'clean';
    } else if (obj.posterStyle == 'modern') {
        $('.map-location').hide();
        $('.map-location-modern').show();
        $('.map-location-stricts').hide();
        maps[currentMapIndex].posterStyle = 'modern';
    } else if (obj.posterStyle == 'stricts') {
        $('.map-location').hide();
        $('.map-location-modern').hide();
        $('.map-location-stricts').show();
        maps[currentMapIndex].posterStyle = 'stricts';
    } else {
        $('.map-location').show();
        $('.map-location-modern').hide();
        $('.map-location-stricts').hide();
        maps[currentMapIndex].posterStyle = 'white';
    }
    maps[currentMapIndex].posterStyleValue = obj.posterStyleValue;
    $('#' + obj.posterid).trigger('click');
    //$('#'+obj.orientation).trigger('click');
    $('.btn-with-text-orientation').removeClass('active');
    $('#' + obj.orientation).addClass('active');
    if (obj.orientation == 'landscape') {
        var heightP = $('span#poster-height');
        var height = heightP.text();
        var widthP = $('span#poster-width');
        var width = widthP.text();
        heightP.text(width);
        widthP.text(height);
        heightP.attr('id', 'poster-width');
        widthP.attr('id', 'poster-height');
        maps[currentMapIndex].orientation = obj.orientation;
        maps[currentMapIndex].orientationValue = obj.orientationValue;
        $('img#3x4-landscape').show();
        $('img#3x4-portrait').hide();
        $('#mapContainer1').removeClass('col-md-8').addClass('col-md-12');
        map.resize();
    } else if (obj.orientation == 'portrait') {
        /*var heightP=$('span#poster-height');
         var height=heightP.text();
         var widthP=$('span#poster-width');
         var width=widthP.text();
         heightP.text(width);
         widthP.text(height);
         heightP.attr('id','poster-width');
         widthP.attr('id','poster-height');*/
        maps[currentMapIndex].orientation = obj.orientation;
        maps[currentMapIndex].orientationValue = obj.orientationValue;
        $('img#3x4-landscape').hide();
        $('img#3x4-portrait').show();
        $('#mapContainer1').removeClass('col-md-12').addClass('col-md-8');
        map.resize();
    }

    //$('#'+obj.finish).trigger('click');
    $('.btn-with-text-finish').removeClass('active');
    $('#' + obj.finish).addClass('active');
    if (obj.finish == 'strict') {
        $('.map-bg').addClass('strict');
        $('.map-bg').removeClass('map-bg-frame');
        maps[currentMapIndex].finish = obj.finish;
        maps[currentMapIndex].finishValue = obj.finishValue;
    } else if (obj.finish == 'paper') {
        $('.map-bg').removeClass('map-bg-frame');
        $('.map-bg').removeClass('strict');
        maps[currentMapIndex].finish = obj.finish;
        maps[currentMapIndex].finishValue = obj.finishValue;
    }
    //var h=$('#map').width();
    //$('.white-text-div').width(h);


    $('#' + obj.posterSize).trigger('click');
    $('.map_price').text(obj.price);
    $('ul.setup-panel li a[href="#step-1"]').trigger('click');
    setTitles(obj.title, obj.subtitle, obj.tagline);
    manageHeight();
    click_btn();
    //createImageThumb();
}
// var theToggle = document.getElementById('toggle');
// based on Todd Motto functions
// http://toddmotto.com/labs/reusable-js/

// hasClass
function hasClass(elem, className) {
    return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
// addClass
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
        elem.className += ' ' + className;
    }
}
// removeClass
function removeClass(elem, className) {
    var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, ' ') + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}
// toggleClass
function toggleClass(elem, className) {
    var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, " ") + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0) {
            newClass = newClass.replace(" " + className + " ", " ");
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
        elem.className += ' ' + className;
    }
}

//theToggle.onclick = function() {
//   toggleClass(this, 'on');
//   return false;
// };

$(document).ready(function () {
    var navListItems = $('ul.setup-panel li a'),
            allWells = $('.setup-content');
    allWells.hide();
    navListItems.click(function (e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this).closest('li');
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
        if ($(this).attr('href') == '#step-4') {
            createImageThumb();
            $('#mapContainer').hide();
            $('#paymentTab').hide();
            $('#shippingTab').show();
            updateCart();
            generateMapResult(currentMapIndex);

        } else if ($(this).attr('href') == '#step-5') {
            $('#step-4').show();
            $('#mapContainer').hide();
            if (maps.length == 0) {
                alert('Please Add Map to further proceed.')
                return;
            }

            if ($('#frmShipping').valid()) {
                $('#shippingTab').hide();
                $('#paymentTab').show();
            }
            updateCart();

        } else {
            $('#mapContainer').show();
        }
    });
    $('ul.setup-panel li.active a').trigger('click');

    $('#activate-step-2').on('click', function (e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $('#mapContainer').show();
    });

    $('#activate-step-3').on('click', function (e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $('#mapContainer').show();
    });

    $('#activate-step-4').on('click', function (e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $('#mapContainer').hide();
    });

    $('#activate-step-5').on('click', function (e) {
        if (maps.length == 0) {
            alert('Please Add Map to further proceed.');
            return;
        }
        //alert('Step-1');
        if ($('#frmShipping').valid()) {
            if (voucher.total === 0 && $('#frmAgreement').valid()) {
                stripeResponseHandler(200, {error: false});
                return;
            }
            if (voucher.total !== 0 && $('#frmPayment').valid() && $('#frmAgreement').valid()) {
                var cardnumber = $('input[name="cardnumber"]').val();
                var cardexpire = $('select[name="cardexpire_year"]').val() + '/' + $('select[name="cardexpire_month"]').val();
                var cvc = $('input[name="cardcvc"]').val();
                var error = false;
                if (!Stripe.card.validateCardNumber(cardnumber)) {
                    error = true;
                    $('label[for="cardnumber"]').text('The credit card number appears to be invalid.');
                }
                if (!Stripe.card.validateExpiry(cardexpire)) {
                    error = true;
                    $('label[for="cardexpire_month"]').text('The expiration date appears to be invalid.').show();
                }
                if (!Stripe.card.validateCVC(cvc)) {
                    error = true;
                    $('label[for="cardcvc"]').text('The CVC number appears to be invalid.');
                }
                if (!error) {
                    //alert('Step-2');
                    var date = cardexpire.split("/");
                    Stripe.card.createToken({
                        number: cardnumber,
                        cvc: cvc,
                        exp_month: date[1],
                        exp_year: date[0],
                        name: $('#fname').val() + ' ' + $('#lname').val(),
                        address_line1: $('#address_line').val(),
                        address_line2: $('#address_line2').val(),
                        address_city: $('#city').val(),
                        address_state: $('#state').val(),
                        address_zip: $('#zipcode').val(),
                        address_country: $('#country').val()
                    }, stripeResponseHandler);
                }
            }
        }

    });
    //Location Tab Functions                       
    google.maps.event.addDomListener(window, 'load', function () {
        map.resize();
        var places = new google.maps.places.Autocomplete(document.getElementById('address'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var queryParameter = {};
            var place = places.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            var address = place.address_components;
            var cnt = address.length - 1;
            for (i = cnt; i >= 0; i--) {
                if (address[i].types[0] == 'country') {
                    maps[currentMapIndex].country = address[i].long_name;
                    maps[currentMapIndex].countryCode = address[i].short_name.toString().toLowerCase();
                } else if (address[i].types[0] == 'administrative_area_level_1') {
                    maps[currentMapIndex].param = address[i].long_name;
                } else if (address[i].types[0] == 'administrative_area_level_2') {
                    maps[currentMapIndex].param = address[i].long_name;
                } else if (address[i].types[0] == 'locality') {
                    maps[currentMapIndex].param = address[i].long_name;
                }
            }

            var latitude = (place.geometry.location.lat()).toFixed(2);
            var longitude = (place.geometry.location.lng()).toFixed(2);
            var tagline = latitude + "," + longitude;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = (function (xhttp, map) {
                return function () {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var json_text = xhttp.responseText;
                        var geoJosnData = JSON.parse(json_text);
                        var feature = geoJosnData.features[0];
                        maps[currentMapIndex].latitude = feature.geometry.coordinates[1];
                        maps[currentMapIndex].longitude = feature.geometry.coordinates[0];
                        map.setCenter(feature.geometry.coordinates);
                        var lat = feature.geometry.coordinates[1];
                        var lng = feature.geometry.coordinates[0];
                        var tagline = '';
                        if (lat >= 0) {
                            tagline += feature.geometry.coordinates[1].toFixed(2) + "°N / ";
                        } else {
                            tagline += feature.geometry.coordinates[1].toFixed(2) + "°S / ";
                        }
                        if (lng >= 0) {
                            tagline += feature.geometry.coordinates[0].toFixed(2) + "°E ";
                        } else {
                            tagline += feature.geometry.coordinates[0].toFixed(2) + "°W ";
                        }
                        //var tagline=feature.geometry.coordinates[1].toFixed(2)+"° / "+feature.geometry.coordinates[0].toFixed(2)+'°';
                        setTitles(maps[currentMapIndex].param, maps[currentMapIndex].country, tagline);
                        //console.log(map.getCenter());
                        maps[currentMapIndex].bounds = map.getBounds();
                        //createImageThumb();
                    }
                    ;
                };
            })(xhttp, map);
            xhttp.open("GET", "https://api.mapbox.com/geocoding/v5/mapbox.places/" + maps[currentMapIndex].param + ".json?country=" + maps[currentMapIndex].countryCode + "&types=place&autocomplete=true&access_token=pk.eyJ1Ijoia2F0aGFrIiwiYSI6ImNpcnJydTlxejBocHh0Y25rMm9rb2k4cGUifQ.jwd-geXu9qd9oRcMqEZGNQ", true);
            xhttp.send();
        });
    });
    map.on('zoomend', function () {
        var center = map.getCenter();
        maps[currentMapIndex].longitude = center.lng;
        maps[currentMapIndex].latitude = center.lat;
        maps[currentMapIndex].bounds = map.getBounds();
        //createImageThumb();
    });
    map.on('dragend', function () {
        var center = map.getCenter();
        maps[currentMapIndex].longitude = center.lng;
        maps[currentMapIndex].latitude = center.lat;
        maps[currentMapIndex].bounds = map.getBounds();
        //createImageThumb();
    });
    $('#map_title').keyup(function () {
        updateTitle($(this).val());
    });
    $('#map_subtitle').keyup(function () {
        updateSubtitle($(this).val());
    });
    $('#map_tagline').keyup(function () {
        updateTagline($(this).val());
    });

    //Style Tab Functions
    //Poster Style
    $('#hide-btn .btn-with-text').on('click', posterstyle);

    //Map Style
    $('.map-img .map-img-circle').on('click', mapstyle);

    //Layout Tab
    /* Orientation */
    $('#hide-layout-btn .btn-with-text-orientation').on('click', orientation);

    /* Finish */
    $('#hide-layout-btn .btn-with-text-finish').on('click', finish);

    /* Paper Size */
    $('#hide-layout-btn .btn-with-text-size').on('click', postersize);

    //
    /*Coupon Code*/
    $("#coupon-code").click(function () {
        $("#hide").hide();
        $("#show").show();
    });

    $("#close-code").click(function () {
        $("#show").hide();
        $("#hide").show();
    });


    /**Add New Map**/
    $('#add_map').on('click', function () {
        maps[currentMapIndex].bounds = map.getBounds();
        maps[currentMapIndex].pitch = map.getPitch();
        maps[currentMapIndex].bearing = map.getBearing();
        generateMapResult(currentMapIndex);
        currentMapIndex += 1;
        maps[currentMapIndex] = JSON.parse(JSON.stringify(mapObj));
        initalizeMap(maps[currentMapIndex]);
        manageHeight();
    });
    click_btn();
    manageHeight();
    map.resize();
    initalizeMap(maps[currentMapIndex]);
    $('#couponcode').on('keyup', function () {
        var value = $(this).val();
        if (value.length > 0) {
            $('#verifyCode').prop('disabled', false);
            $('label[for=couponcode]').hide();
        } else {
            $('#verifyCode').prop('disabled', true);
            $('label[for=couponcode]').text('Introduce el código de cupón').show();
        }
    });
    $('#verifyCode').click(verify_code);
    $('#frmShipping').validate({
        rules: {
            fname: "required",
            lname: "required",
            address_line: "required",
            city: "required",
            state: "required",
            country: "required",
            zipcode: "required",
            email: {required: true, email: true},
            phone: "required"
        },
        messages: {
            fname: "Nombre es requerido",
            lname: "Apelllidos son requeridos",
            address_line: "Dirección es requerida",
            city: "Ciudad es requerida",
            state: "Provincia es requerida",
            country: "País es requerido",
            zipcode: "Código Postal es requerido",
            email: {required: "Email es requerido", email: "Ingresa un email valido para suscribirte."},
            phone: "Teléfono es requerido"
        },
        submitHandler: function (form) {
            return false;
        }
    });
    $('#frmPayment').validate({
        rules: {
            cardnumber: "required",
            cardexpire_month: "required",
            cardexpire_year: "required",
            cardcvc: "required",
            terms: "required"
        },
        messages: {
            cardnumber: "Número de tarjeta es requerido",
            cardexpire_month: "Fecha de caducidad es requerida",
            cardexpire_year: "Año es requerido",
            cardcvc: "Código CVC es requerido",
            terms: "Aceptar Términos & Condiciones"
        },
        submitHandler: function (form) {
            return false;
        }
    });
    $('#frmAgreement').validate({
        rules: {
            terms: "required"
        },
        messages: {
            terms: "Aceptar Términos & Condiciones"
        },
        submitHandler: function (form) {
            return false;
        }
    });
    $('#frmCouponCode').validate({
        rules: {
            couponcode: "required"
        },
        messages: {
            couponcode: "Introduce el código de cupón"
        },
        submitHandler: function (form) {
            return false;
        }
    });

    var $form = $('#frmPayment');
    get_countries();
});

$(window).bind("load", function () {
    $(".jumper").on("click", function (e) {
        e.preventDefault();
        $("body, html").animate({
            scrollTop: $($(this).data('target')).offset().top
        }, 600);
    });
});

function setTitles(title, subtitle, tagline) {
    maps[currentMapIndex].title = title;
    maps[currentMapIndex].subtitle = subtitle;
    maps[currentMapIndex].tagline = tagline;
    document.getElementById('map_title').value = title;
    document.getElementById('map_subtitle').value = subtitle;
    document.getElementById('map_tagline').value = tagline;
    $('.map_title').html(title);
    $('.map_subtagline').find('span.states').text(subtitle);
    $('.map_subtagline').find('span.states-location').text(tagline);
    $('.map_tagline').html(tagline);
    $('.map_subtitle').html(subtitle);
}

function updateTitle(title) {
    maps[currentMapIndex].title = title;
    $('.map_title').html(title);
    //createImageThumb();
}

function updateSubtitle(subtitle) {
    maps[currentMapIndex].subtitle = subtitle;
    $('.map_subtagline').find('span.states').text(subtitle);
    $('.map_subtitle').html(subtitle);
    //createImageThumb();
}

function updateTagline(tagline) {
    maps[currentMapIndex].tagline = tagline;
    $('.map_subtagline').find('span.states-location').text(tagline);
    $('.map_tagline').html(tagline);
    //createImageThumb();
}

function updateCart() {
    $('.cart_item').remove();
    var total = 0.00;
    maps.forEach(function (map, i, array) {
        var markup = '<li class="cart_item" id="cartitem_' + i + '">\n';
        if (currentMapIndex != i) {
            markup += '<p class="delete"><a href="#" data-index="' + i + '" title="Delete"><i class="fa fa-trash-o"></i></a></p>\n';
        }
        markup += '<div class="pull-left col-xs-8">\n\
                    <p class="city-shipping">' + map.title + '</p>';
        if (version == 'V1') {
            markup += '<p class="tagline-shipping">' + map.orientationValue + ' ' + map.posterWidth + 'cm x' + map.posterHeight + 'cm, <br/>' + map.posterStyleValue + ',' + map.finishValue + '</p>';

        } else {
            var h = (parseFloat(map.posterHeight) / 2.54).toFixed(0);
            var w = (parseFloat(map.posterWidth) / 2.54).toFixed(0);
            markup += '<p class="tagline-shipping">' + map.orientationValue + ' ' + w + '" x ' + h + '", <br/>' + map.posterStyleValue + ',' + map.finishValue + '</p>';
        }

        markup += '<p class="price">' + map.price + ' $</p>\n\
                    <div class="input-group cs-group"> \n\
                        <span class="input-group-btn">\n\
                            <button type="button" class="btn default-btn btn-number"  data-type="minus" data-field="quant[' + i + ']"> \n\
                            <span class="glyphicon glyphicon-minus"></span></button>\n\
                        </span>\n\
                        <input type="text" name="quant[' + i + ']" class="form-control input-number" value="' + map.qty + '" data-index="' + i + '" maxlength="3" min="1" max="999">\n\
                        <span class="input-group-btn">\n\
                            <button type="button" class="btn default-btn btn-number" data-type="plus" data-field="quant[' + i + ']">\n\
                            <span class="glyphicon glyphicon-plus"></span></button>\n\
                        </span>\n\
                    </div>\n\
                </div>\n\
                <div class="pull-left col-xs-3" id="poster_preview_' + i + '">\n\
                    <img class="img-responsive" src="' + map.imageThumb + '" alt="" />\n\
                </div>\n\
            </li>';
        //$('#step-4 .shipping').prepend(markup);
        $(markup).insertBefore('li#hide')
        $('#cartitem_' + i + ' .input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });
        $('#cartitem_' + i + ' .btn-number').on('click', function (e) {
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            var index = input.data('index');
            if (!isNaN(currentVal)) {
                if (type == 'minus') {
                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }
                    maps[index].qty = parseInt(input.val());
                    updateTotalPrice();
                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }
                    maps[index].qty = parseInt(input.val());
                    updateTotalPrice();
                }
            } else {
                input.val(0);
            }
        });
        $('#cartitem_' + i + ' .input-number').change(function () {
            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });
        $('#cartitem_' + i + ' .input-number').keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                            (e.keyCode == 65 && e.ctrlKey === true) ||
                            // Allow: home, end, left, right
                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
        $('#cartitem_' + i + ' .delete').on('click', function (e) {
            e.preventDefault();
            //console.log(maps);
            $(this).closest('li.cart_item').remove();
            var index = $(this).data('index');
            maps.splice(index, 1);
            if (maps.length == 1) {
                currentMapIndex = 0;
                updateCart();
            }
            updateTotalPrice();
        });
        var amt = parseFloat(maps[i].price);
        var qty = parseInt(maps[i].qty);
        total += (amt * qty);
        if (voucher.discount != 0) {
            var discount = total * voucher.discount / 100;
            var subtotal = total;
            total = subtotal - discount;
            $('#subtotal').find('span').text(' $' + subtotal.toFixed(2));
            $('#subtotal').show();
        }
        voucher.total = total;
        showhidePaymentForm();
    });
    $('.maintotal').find('span').text(total.toFixed(2) + ' $');
}

function updateTotalPrice() {
    var total = 0.00;
    maps.forEach(function (map, i, array) {
        var amt = parseFloat(map.price);
        var qty = parseInt(map.qty);
        total += (amt * qty);
    });
    if (voucher.discount != 0) {
        var discount = total * voucher.discount / 100;
        var subtotal = total;
        total = subtotal - discount;
        $('#subtotal').find('span').text(subtotal.toFixed(2) + ' $');
        $('#subtotal').show();
    }
    voucher.total = total;
    showhidePaymentForm();
    $('.maintotal').find('span').text(total.toFixed(2) + ' $');
}

function showhidePaymentForm() {
    if (voucher.total == 0) {
        $('#frmPaymentDiv').hide();
    } else {
        $('#frmPaymentDiv').show();
    }
}

function click_btn() {
    /*Height and width count*/
    setTimeout(function () {
        var element = document.getElementById('map-new');
        var addheight = document.getElementById('add-height');
        addheight.style.height = element.offsetHeight + 'px';

        var addwidth = document.getElementById('add-width');
        addwidth.style.width = element.offsetWidth + 'px';
    }, 10);

}

function stripeResponseHandler(status, response) {
    //alert('Step-3');
    if (response.error) {
        $('#frmPayment').append('<label for="cardnumber" class="error">' + response.error.message + '</label>');
        reportError(response.error.message);
    } else {
        $('.loader').show();
        var shipping = $('#frmShipping')[0];
        var frmdata = new FormData(shipping);
        if (typeof response.id !== "undefined") {
            frmdata.append('stripe_id', response.id);

        }
        maps.forEach(function (map, i, array) {
            maps[i].imageThumb = '';
        });
        frmdata.append('mapsData', JSON.stringify(maps));
        if (voucher.code !== 0) {
            //data.code=btoa(voucher.code);
            frmdata.append('code', btoa(voucher.code));
        }
        ;
        $.ajax({
            url: window.location.href + "/order",
            type: "post",
            contentType: false,
            processData: false,
            data: frmdata,
            dataType: "json",
            success: function (data) {
                //alert('Step-4');
                if (data.success) {
                    window.location = data.processing;
                } else {
                    alert(data.message);
                    $('.loader').hide();
                }
            },
            beforeSend: function (jqXHR, settings) {
                $('.loader').show();
            },
            complete: function (jqXHR, textStatus) {
                $('.loader').hide();
            }
        });
    }
}
;

function posterstyle() {
    $('.btn-with-text.active').removeClass('active');
    $(this).addClass('active');
    if ($(this).attr('id') == 'clean') {
        $('.map-location').hide();
        $('.map-location-modern').hide();
        $('.map-location-stricts').hide();
        maps[currentMapIndex].posterStyle = 'clean';
    } else if ($(this).attr('id') == 'modern') {
        $('.map-location').hide();
        $('.map-location-modern').show();
        $('.map-location-stricts').hide();
        maps[currentMapIndex].posterStyle = 'modern';
    } else if ($(this).attr('id') == 'stricts') {
        $('.map-location').hide();
        $('.map-location-modern').hide();
        $('.map-location-stricts').show();
        maps[currentMapIndex].posterStyle = 'stricts';
    } else {
        $('.map-location').show();
        $('.map-location-modern').hide();
        $('.map-location-stricts').hide();
        maps[currentMapIndex].posterStyle = 'white';
    }
    maps[currentMapIndex].posterStyleValue = $(this).val();
    //createImageThumb();
}

function mapstyle() {
    $('.map-img-circle.active').removeClass('active');
    $(this).addClass('active');
    maps[currentMapIndex].mapStyle = $(this).val();
    maps[currentMapIndex].staticAPI = $(this).attr('data-api');
    map.setStyle($(this).val());
    //createImageThumb();
}

function orientation() {
    if ($(this).attr('id') == 'landscape' && !$(this).hasClass('active')) {
        var heightP = $('span#poster-height');
        var height = heightP.text();
        var widthP = $('span#poster-width');
        var width = widthP.text();
        heightP.text(width);
        widthP.text(height);
        heightP.attr('id', 'poster-width');
        widthP.attr('id', 'poster-height');
        maps[currentMapIndex].orientation = 'landscape';
        maps[currentMapIndex].orientationValue = $(this).val();
        //maps[currentMapIndex].posterHeight=width;
        //maps[currentMapIndex].posterWidth=height;
        $('img#3x4-landscape').show();
        $('img#3x4-portrait').hide();
        $('#mapContainer1').removeClass('col-md-8').addClass('col-md-12');
        map.resize();
    } else if ($(this).attr('id') == 'portrait' && !$(this).hasClass('active')) {
        var heightP = $('span#poster-height');
        var height = heightP.text();
        var widthP = $('span#poster-width');
        var width = widthP.text();
        heightP.text(width);
        widthP.text(height);
        heightP.attr('id', 'poster-width');
        widthP.attr('id', 'poster-height');
        maps[currentMapIndex].orientation = 'portrait';
        maps[currentMapIndex].orientationValue = $(this).val();
        //maps[currentMapIndex].posterHeight=width;
        //maps[currentMapIndex].posterWidth=height;
        $('img#3x4-landscape').hide();
        $('img#3x4-portrait').show();
        $('#mapContainer1').removeClass('col-md-12').addClass('col-md-8');
        map.resize();
    }
    $('.btn-with-text-orientation.active').removeClass('active');
    $(this).addClass('active');
    manageHeight();
    click_btn();
    //createImageThumb();
}

function finish() {
    if ($(this).attr('id') == 'strict' && !$(this).hasClass('active')) {
        $('.map-bg').addClass('strict');
        $('.map-bg').removeClass('map-bg-frame');
        maps[currentMapIndex].finish = 'strict';
        maps[currentMapIndex].finishValue = $(this).val();
    } else if ($(this).attr('id') == 'paper' && !$(this).hasClass('active')) {
        $('.map-bg').removeClass('map-bg-frame');
        $('.map-bg').removeClass('strict');
        maps[currentMapIndex].finish = 'paper';
        maps[currentMapIndex].finishValue = $(this).val();
    }
    $('.btn-with-text-finish.active').removeClass('active');
    $(this).addClass('active');
    //var h=$('#map').width();
    //$('.white-text-div').width(h);
    //createImageThumb();
}

function postersize() {
    var w, h;
    if (version == 'V1') {
        h = $(this).data('height');
        w = $(this).data('width');
    } else {
        h = (parseFloat($(this).data('height')) / 2.54).toFixed(0);
        w = (parseFloat($(this).data('width')) / 2.54).toFixed(0);
    }
    $('span#poster-height').text(h);
    $('span#poster-width').text(w);
    maps[currentMapIndex].posterHeight = $(this).data('height');
    maps[currentMapIndex].posterWidth = $(this).data('width');
    maps[currentMapIndex].price = $(this).data('price');
    $('.map_price').text(maps[currentMapIndex].price);
    maps[currentMapIndex].posterSize = $(this).attr('id');
    ;
    maps[currentMapIndex].posterid = $(this).data('id');
    $('.btn-with-text-size.active').removeClass('active');
    $(this).addClass('active');
    manageHeight();
    click_btn();
    //$('img#3x4-landscape').attr('height',size[1]).attr('width',size[0]);
    //$('img#3x4-portrait').attr('height',size[0]).attr('width',size[1]);
}
function verify_code(e) {
    var code = $('#couponcode').val();
    $.ajax({
        url: window.location.href + "/verifycode",
        type: "post",
        data: {"code": btoa(code)},
        dataType: "json",
        success: function (data) {
            //alert(data.message);
            if (data.success) {
                voucher.code = data.code;
                voucher.discount = parseFloat(data.discount);
                updateTotalPrice();
                $('#discount').find('span').text(voucher.discount.toFixed(2) + '%');
                $('#discount').show();
                $('#couponcode').prop('readonly', true);
                $('#verifyCode').prop('disabled', true);
                $('#verifyCode').text('Verified');
            } else {
                alert(data.message);
            }
        },
        beforeSend: function (jqXHR, settings) {
            $('.loader').show();
        },
        complete: function (jqXHR, textStatus) {
            $('.loader').hide();
        }
    });
}
function manageHeight() {
    var mapConainer = $('#map-new');
    var width = mapConainer.width();
    width += 36;
    var height = 36;
    if (maps[currentMapIndex].orientation == 'portrait') {
        height += (width * maps[currentMapIndex].posterHeight / maps[currentMapIndex].posterWidth);
        console.log(maps[currentMapIndex].posterHeight, maps[currentMapIndex].posterWidth);
    } else {
        height += (width * maps[currentMapIndex].posterWidth / maps[currentMapIndex].posterHeight);
    }
    height -= 36;
    mapConainer.height(height);
    console.log(height, width);
    map.resize();
    //var h=$('#map.mapPreview').width();

    /* if(maps[currentMapIndex].orientation=='landscape'){
     $('.white-text-div').css('width','100.1%');
     }else{
     $('.white-text-div').css('width','100%');
     }*/
}

function createImageThumb() {
    var cloneObj = $('#map-new').clone();
    var canvas = map.getCanvas();
    $(cloneObj).width(canvas.width + 36);
    //$(cloneObj).find('.white-text-div').width($('#map-new').find('.white-text-div').width()+36);
    var center = map.getCenter();
    $(cloneObj).find('#map').html('<img width="100%" height="100%" \n\
                src="' + maps[currentMapIndex].staticAPI + center.lng + ',' + center.lat + ',' + map.getZoom() + ',' +
            map.getPitch() + ',' + map.getBearing() + '/' + canvas.width + 'x' + canvas.height +
            '?access_token=' + mapboxgl.accessToken + '&attribution=false&logo=false"></img>');
    $(cloneObj).attr('id', 'map-fbimg');
    $(cloneObj).find('.map-location-modern .city, .map-location-modern .tag-line').css('letter-spacing', '0px');
    $('body').append(cloneObj);
    html2canvas(cloneObj, {
        useCORS: true,
        onrendered: function (canvas) {
            //window.open(canvas.toDataURL());
            var src = canvas.toDataURL();
            $('#map-fbimg').remove();
            maps[currentMapIndex].imageThumb = src;
            var img = $('#poster_preview_' + currentMapIndex + ' img');
            if (typeof img !== 'undefined') {
                img.attr('src', src);
            }
        }
    });
}

function generateMapResult(oldindex) {
    console.log(maps[oldindex]);
    var height = 1280;
    var width = 1280;
    if (maps[oldindex].orientation == 'landscape') {
        height = width * maps[oldindex].posterWidth / maps[oldindex].posterHeight;
    } else {
        width = height * maps[oldindex].posterWidth / maps[oldindex].posterHeight;
    }
    var mapDivId = 'map' + oldindex;
    console.log('Div-L', $('#' + mapDivId).length);
    if ($('#' + mapDivId).length == 0) {
        $('<div id="' + mapDivId + '" class="hide-map"></div>').appendTo('body');
    }

    var map1 = new mapboxgl.Map({
        container: mapDivId, // container id
        style: maps[oldindex].mapStyle, //stylesheet location
        center: [maps[oldindex].longitude, maps[oldindex].latitude], // starting position
        zoom: 10, // starting zoom
        minZoom: 9,
        interactive: false
    });
    $('#' + mapDivId).height(height);
    $('#' + mapDivId).width(width);
    map1.resize();
    console.log(height, width);
    map1.setBearing(maps[oldindex].bearing);
    map1.setPitch(maps[oldindex].pitch);
    map1.fitBounds(maps[oldindex].bounds);
    setTimeout(function () {
        var center = map1.getCenter();
        maps[oldindex].longitude = center.lng;
        maps[oldindex].latitude = center.lat;
        maps[oldindex].zoom = map1.getZoom();
        maps[oldindex].pitch = map1.getPitch();
        maps[oldindex].bearing = map1.getBearing();
        console.log('generateMapResult', maps[oldindex]);
        $('#' + mapDivId).remove();
    }, 5000);
}

function get_countries() {
    $.ajax({
        url: window.base_url + "/editor/get_countries",
        method: "get",
        success: function (data) {
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    $('#country').append('<option value="' + key + '">' + data[key].name + '</option>');
                }
            }
            $('#country').on('change', function (data) {
                return function () {
                    var key = $(this).val();
                    if (data[key].states === null) {
                        $('#state_container').html('');
                        var input = '<input type="text" class="form-control" name="state" id="state" placeholder="State">';
                        $('#state_container').html(input);
                    } else {
                        $('#state_container').html('');
                        var input = '<select class="selectpicker" data-live-search="true" name="state" id="state" title="State">';
                        $('#state_container').html(input);
                        for(var i=0;i<data[key].states.length;i++){
                            input+='<option value="' + data[key].states[i].code + '">' + data[key].states[i].name + '</option>';
                        }
                        input+='</select>';
                        $('#state_container').html(input);
                        $('.selectpicker').selectpicker('refresh');
                    }
                };
            }(data));
        },
        dataType: "json"
    });

}