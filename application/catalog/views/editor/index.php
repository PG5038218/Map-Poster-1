<?php echo $header; ?>
<style>
    .txbox-icon{cursor: context-menu;left: 30px;padding: 11px;position: absolute;}
    .calendra{float: left;width: 19%;}
    .calendra i{font-size: 23px;padding: 13px 12px 15px 7px;}
    .cvv-box .btn-group.bootstrap-select {margin-bottom: 14px;width: 37% !important;}
    .fa.fa-question-circle.tooltip-bg {cursor: pointer;font-size: 16px;padding: 15px 0; color:#442275;}
    .txbox-icon i{font-size: 25px;color: #442275;}
    #cardnumber{padding-left: 65px !important;}
    .img-responsive.click {position: absolute;right: 57px;top: -95px;}
    #map-new{ -ms-transform: scale(0.5);
        -webkit-transform: scale(0.5);
        transform: scale(1.1); 
    }
</style>
<div class="loader"><table><tbody><th><p>Please wait ... We are processing your order</p><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></table></tbody></th></div>
<div class="container cstm-container">
    <div class="col-md-7 col-xs-12 pull-right" id="mapContainer"> 
        <div class="col-md-8 center-map-new" id="mapContainer1">
            <div class="col-xs-11 padding-0 f-width">
                <div class="col-md-4 pull-left"><img src="<?php echo base_url(); ?>img/shape.png" class="img-responsive center-img" alt="" width="56" height="54" /></div>
                <div class="col-md-4 pull-right"><img src="<?php echo base_url(); ?>img/shape1.png" class="img-responsive center-img" alt="" width="56" height="54" /></div>
            </div>
            <div class="map-bg col-xs-11 f-width h_iframe" id="map-new"> 
                <div class="map-bg">
                    <div class="box-shadow">
                        <div class="mapPreview" id='map'></div>
                        <div class="map-location poster-title" id="map-location" style="display:none">
                            <div class="white-text-div padding-0">
                                <p class="city map_title"></p>
                                <p class="tag-line map_subtitle"></p>
                                <p class="des-address map_tagline"></p>
                            </div>
                        </div>
                        <div class="map-location-modern poster-title" id="map-location-modern" style="display:none">
                            <div class="white-text-div padding-0">
                                <p class="city map_title"></p>
                                <p class="tag-line"><span class="border-top-text map_subtitle"></span></p><div class="nb"></div>
                                <p class="des-address map_tagline"></p>
                            </div>
                        </div>
                        <div class="map-location-stricts poster-title" id="map-location-stricts" style="display:none">
                            <div class="white-text-div padding-0">
                                <p class="city map_title"></p>
                                <p class="tag-line map_subtitle"></p>
                                <p class="des-address map_tagline"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-1 padding-0 border-top-bottom pull-right">
                <div id="add-height" style=" margin:0 auto"></div><p class="ff"><span id="poster-height"></span> "</p>
            </div>
            <div class="border-left-right">
                <div class="col-xs-12" id="add-width"></div><p class="sm-size"><span id="poster-width"></span> "</p>
            </div>
            <div class="auto-height"> </div>
        </div>
    </div>
    <div class="setup-content" id="step-1">
        <div class="col-md-6 col-xs-12 padding-0 cstm-tab">
            <div class="bg_white with-tx">
                <p class="form-title">Now find your favourite city!</p>
                <form class="location-form">
                    <div class="form-group col-md-10 padding-0">
                        <div class="inner-addon right-addon"> <i class="glyphicon glyphicon-map-marker"></i>
                            <input type="text" class="form-control" placeholder="Location" name="address" id="address" autocomplete="off"  spellcheck="false" />
                        </div>
                    </div>
                    <div class="form-group col-md-10 padding-0">
                        <input type="text" id="map_title" class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group col-md-10 padding-0">
                        <input type="text" id="map_subtitle" class="form-control" placeholder="Subtitle">
                    </div>
                    <div class="form-group col-md-10 padding-0">
                        <input type="text" id="map_tagline" class="form-control" placeholder="Tagline">
                    </div>
                </form>
                <p class="perfectionist"><b>Are you a perfectionist? So are we! </b>You can modify the zoom and position on the map to perfect the positioning for region and continental travelling.</p>
            </div>
            <div class="bg-white-new padding-right-0"> <img src="<?php echo base_url(); ?>img/caret.png" class="img-responsive shadow" alt="" title="" width="11" height="10" />
                <div class="gray-inner">
                    <p class="new-york map_title">NEW YORK</p>
                    <div class="col-md-4 padding-0">
                        <p class="free-shipping"><span class="map_price">49.00</span> $ <br>
                            + FREE SHIPPING</p>
                    </div>
                    <div class="col-md-8 padding-0">
                        <p class="state map_subtagline"><span class="states">UNITED STATES</span><br>
                            <span class="states-location"></span> </p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <img class="img-responsive shadow" src="<?php echo base_url(); ?>img/caret.png" alt="" title="" width="11" height="10" />
                <button id="activate-step-2" class="btn btn-primary btn-lg next">Next</button>
            </div>
        </div>
    </div>
    <div class="setup-content" id="step-2">
        <div class="col-md-6 padding-0 cstm-tab">
            <div class="bg_white">
                <p class="form-title">Excellent! Now add a style for your map</p>
                <div class="col-xs-12 padding-0 hide-btn" id="hide-btn">
                    <div class="style-btm">
                        <p class="poster-style">Poster Styles</p>
                        <?php foreach ($posterstyles as $style): ?>
                            <button value="<?php echo $style['style_value'] ?>" class="btn btn-with-text <?php
                            if ($style['isdefault']) {
                                echo "active";
                            }
                            ?>" id="<?php echo $style['style_name'] ?>" ><?php echo $style['style_value'] ?></button>
                                <?php endforeach; ?>
                        <!--button class=" active" id="clean">Clean</button>
                        <button class="btn btn-with-text">With text</button>
                        <button class="btn btn-with-text" id="modern">Modern</button>
                        <button class="btn btn-with-text" id="stricts">Stricts</button-->
                    </div>
                    <div class="clearfix"></div>
                    <div class="style-btm">
                        <p class="poster-style">Map Options</p>
                        <div class="map-img"> 
                            <?php foreach ($styles as $style): ?>
                                <button value="<?php echo $style['style_path'] ?>" 
                                        data-api="<?php echo $style['static_api_path'] ?>" 
                                        class="map-img-circle <?php
                                        if ($style['isdefault']) {
                                            echo "active";
                                        }
                                        ?>" >
                                    <img src="<?php echo base_url('img/' . $style['style_img']); ?>" alt="" title="" width="60" height="60" />
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="bg-white-new padding-right-0"><img src="<?php echo base_url(); ?>img/caret.png" class="img-responsive shadow" alt="" title="" width="11" height="10" />
                <div class="gray-inner">
                    <p class="new-york map_title"></p>
                    <div class="col-md-4 padding-0">
                        <p class="free-shipping"><span class="map_price"> 49.00</span> $ <br>
                            + FREE SHIPPING</p>
                    </div>
                    <div class="col-md-8 padding-0">
                        <p class="state map_subtagline"><span class="states"><span></span></span><br>
                            <span class="states-location"></span> </p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <img class="img-responsive shadow" src="<?php echo base_url(); ?>img/caret.png" alt="" title="" width="11" height="10" />
                <button id="activate-step-3" class="btn btn-primary btn-lg next">Next</button>
            </div>
        </div>
    </div>
    <div class="setup-content" id="step-3">
        <div class="col-md-6 padding-0 cstm-tab">
            <div class="bg_white with-tx">
                <p class="form-title">Other Options</p>
                <div class="col-xs-12 padding-0" id="hide-layout-btn">
                    <div class="style-btm">
                        <p class="poster-style">Orientation</p>
                        <button class="btn btn-with-text-orientation active" id="portrait" value="Vertical" onclick="click_btn();">Vertical</button>
                        <button class="btn btn-with-text-orientation" id="landscape" value="Horizontal" onclick="click_btn();">Horizontal</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="style-btm">
                        <p class="poster-style">Finish</p>
                        <button class="btn btn-with-text-finish active" id="paper" value="Sin Borde">No Border</button>
                        <button class="btn btn-with-text-finish" id="strict" value="Con Borde">Frame</button>
                        <!--<button class="btn btn-with-text-finish" id="framed">Framed</button>-->

                    </div>
                    <div class="clearfix"></div>
                    <div class="style-btm">
                        <p class="poster-style">Poster Size</p>
                        <?php $default_poster = array(); ?>
                        <?php foreach ($posters as $poster): ?>
                            <button data-height="<?php echo $poster['poster_height']; ?>" 
                                    data-width="<?php echo $poster['poster_width']; ?>" 
                                    data-price="<?php echo $poster['poster_price'] ?>" 
                                    data-id="<?php echo $poster['poster_id'] ?>"
                                    data-ration="<?php echo str_replace(':', 'x', $poster['poster_ratio']); ?>" 
                                    class="btn btn-with-text-size <?php
                                    if ($poster['isdefault']) {
                                        echo "active";
                                    }
                                    ?>" 
                                    id="<?php echo $poster['poster_id'] ?>">
                                <?php echo number_format($poster['poster_width'] / 2.54, 0); ?> " &times; <?php echo number_format($poster['poster_height'] / 2.54, 0); ?> "
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <p class="perfectionist"><b>Are you a perfectionist? So are we! </b>You can modify the zoom and position on the map to perfect the positioning for region and continental travelling.</p>
                </div>
            </div>
            <div class="bg-white-new padding-right-0"> <img src="<?php echo base_url(); ?>img/caret.png" class="img-responsive shadow" alt="" title="" width="11" height="10" />
                <div class="gray-inner">
                    <p class="new-york map_title"></p>
                    <div class="col-md-4 padding-0">
                        <p class="free-shipping"><span class="map_price"></span>$<br>
                            + FREE SHIPPING</p>
                    </div>
                    <div class="col-md-8 padding-0">
                        <p class="state map_subtagline"><span class="states"></span><br>
                            <span class="states-location"></span> </p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <img class="img-responsive shadow" src="<?php echo base_url(); ?>img/caret.png" alt="" title="" width="11" height="10" />
                <button id="activate-step-4" class="btn btn-primary btn-lg next">Next</button>
            </div>
        </div>
    </div>
    <div class="setup-content" id="step-4">
        <div class="col-md-12 padding-0">
            <div class="col-md-5">
                <div class="bg_white">
                    <ul class="shipping">

                        <li id="hide">
                            <div class="add">
                                <button class="add-map" title="Añadir otro mapa" id="add_map"><i class="fa fa-plus-circle"></i>+ ADD ANOTHER MAP</button>
                                <button class="add-coupon" title="Ingresar cupón de descuento" id="coupon-code">ENTER COUPON DISCOUNT</button>
                            </div>
                        </li>
                        <li id="show" style="display:none">
                            <form class="form-horizontal cs-form-horizontal" target="_balnk" id="frmCouponCode">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-left padding-0">
                                        <input type="text" class="form-control" id="couponcode" name="couponcode" placeholder="Ingresar código de cupón de descuento">
                                        <div class="vrify">
                                            <button id="verifyCode" type="button" class="btn enter-code" disabled="">Verify</button>
                                            <a class="close-offer" id="close-code">&times;</a> 
                                        </div>
                                        <label for="couponcode" class="error" style="display: none"></label>    
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li>
                            <div id="subtotal" class="subtotal" style="display: none">
                                <p>Subtotal</p>
                                <span>$</span> 
                            </div>
                            <div id="discount" class="subtotal" style="display: none">
                                <p>Descuento</p>
                                <span>$</span> 
                            </div>
                            <div class="maintotal">
                                <p>Total</p>
                                <span>$</span> </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="shippingTab" class="col-md-7">
                <form class="shipping-form" method="post" action="" id="frmShipping">
                    <div class="bg_white top-new">
                        <p class="form-title">Shipping Information</p>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">First Name:</label>
                            <div class="col-sm-12">
                                <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">Surnames</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Surnames">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">Address-Street</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="address_line" id="address_line" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">Other Address Information</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="address_line2" id="address_line2" placeholder="Continuation Address">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">City</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="city" id="city" placeholder="City">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">Country</label>
                            <div class="col-sm-12">
                                <select class="selectpicker" data-live-search="true" name="country" id="country" title="Selecte Your Country"></select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">State</label>
                            <div class="col-sm-12" id="state_container">
                                <input type="text" class="form-control" name="state" id="state" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">Postal Code</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Postal code">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">E-Mail</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="email" id="email" placeholder="E-Mail">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-xs-12 padding-0">
                            <label class="control-label col-md-12">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="bg_white top-new">
                    <div id="frmPaymentDiv">
                        <div class="col-sm-8">
                            <p class="form-title">Payment Information<br>
                                <span>All transactions are secure and encrypted. We never save your card details</span></p>

                        </div>
                        <div class="col-sm-4">
                            <img src="<?php echo base_url('img/stripe-secure-300x118.png'); ?>" class="img img-responsive"  />		
                        </div>
                        <form class="shipping-form" method="post" role="form" id="frmPayment">
                            <!--div class="form-group col-md-12 col-xs-12" id="myRadioGroup">
                                <label class="radio-inline">
                                    <input type="radio" size="20" name="paymethod" value="stripe">
                                    Credit card </label>
                                <label class="radio-inline">
                                    <input type="radio" name="paymethod" value="paypal">
                                    PayPal </label>
                                <div class="pull-right payment"> <img height="23" width="36" src="https://grafomap.com//images/credit_card_icons/visa.png"> <img height="23" width="36" src="https://grafomap.com//images/credit_card_icons/mastercard.png"> <img height="23" width="36" src="https://grafomap.com//images/credit_card_icons/maestro.png"> <img height="23" width="36" src="https://grafomap.com//images/credit_card_icons/maestro-uk.png"> <img height="23" width="36" src="https://grafomap.com//images/credit_card_icons/jcb.png"> <img height="23" width="36" src="https://grafomap.com//images/credit_card_icons/discover.png"> </div>
                            </div-->
                            <div id="credit-card" class="desc">
                                <div class="form-group col-md-12 col-xs-12 padding-0">
                                    <label class="control-label col-md-12">Credit Card Number</label>
                                    <div class="col-sm-12">
                                        <span class="txbox-icon"><i type="button" class="fa fa-credit-card"></i></span>
                                        <input type="text" class="form-control" name="cardnumber" id="cardnumber" placeholder="Credit Card Number"  maxlength="20" autocomplete="off">
                                        <label for="cardnumber" class="error"></label>
                                    </div>
                                </div>
                                <!--div class="form-group col-md-12 col-xs-12 padding-0">
                                    <label class="control-label col-md-12">Name on card</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder="Name on card">
                                    </div>
                                </div-->
                                <div class="form-group col-md-4 col-xs-12 padding-0">
                                    <label class="control-label col-md-12">Expiration date. MM / YY</label>
                                    <div class="col-sm-12 cvv-box">
                                        <div class="calendra"><i class="fa fa-calendar"></i></div>
                                        <!--input type="text" class="form-control" name="cardexpire" id="cardexpire" maxlength="7" placeholder="MM/YYYY"-->
                                        <select id="cardexpire_month" name="cardexpire_month" class="selectpicker" name="card-month">
                                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <select  name="cardexpire_year" id="cardexpire_year" class="selectpicker" name="card-month">
                                            <?php
                                            $i = date('Y');
                                            $end = $i + 25;
                                            for ($i; $i <= $end; $i++):
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <label for="cardexpire_month" class="error"></label>
                                    </div>
                                </div>
                                <div class="form-group col-md-8 col-xs-12 padding-0">
                                    <label class="control-label col-md-12">CVV2 Code</label>
                                    <div class="col-sm-4 col-xs-9">
                                        <input type="password" class="form-control" name="cardcvc" id="cardcvc" placeholder="CVV2 Code" maxlength="4" autocomplete="off">
                                        <label for="cardcvc" class="error"></label>
                                    </div>
                                    <div class="col-sm-8 col-xs-3">
                                        <img src="<?php echo base_url('img/card.png'); ?>" class="img-responsive" />
                                    </div>

                                </div>
                            </div>
                            <div class="payment-errors"></div>
                        </form>
                    </div>
                    <div id="agreement" class="desc">
                        <form class="shipping-form" method="post" role="form" id="frmAgreement">
                            <div class="form-group">
                                <div class="col-sm-12 pull-left">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="terms">
                                            I have read and i accept <a target="_blank" href="">the Terms & Conditions</a> </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-white-new padding-right-0"> 
                    <div class="clearfix"></div>
                    <button class="btn btn-primary btn-lg next" type="buttton" id="activate-step-5">COMPLETE ORDER</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>

