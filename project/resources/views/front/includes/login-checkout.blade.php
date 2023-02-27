<div class="woocommerce-billing-fields">

    <h3>{{__('Billing Details')}}</h3>

    <p id="billing_first_name_field" class="form-row form-row form-row-second validate-required"><label class="" for="billing_first_name">{{__('Full Name')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_first_name" name="customer_name" class="input-text " value="{{Auth::user()->name}}" required></p>
    
    <div class="clear"></div>

    <p id="billing_email_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_email">{{__('Email Address')}} <abbr title="required" class="required">*</abbr></label><input type="email"  placeholder="" id="billing_email" name="customer_email" class="input-text " value="{{Auth::user()->email}}" readonly required></p>

    <p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone">{{__('Phone')}} <abbr title="required" class="required">*</abbr></label><input type="tel"  placeholder="" id="billing_phone" name="customer_phone" class="input-text " value="{{Auth::user()->phone}}" required></p><div class="clear"></div>


    <p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1">{{__('Address')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="Street address" id="billing_address_1" name="customer_address" class="input-text "  value="{{Auth::user()->address}}" required></p>


    <p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city">{{__('City')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_city" name="customer_city" class="input-text "  value="{{Auth::user()->city}}" required></p>

    <p id="billing_state_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_state">{{__('State')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_state" name="customer_state" class="input-text " value="{{Auth::user()->state}}" required></p>

    <p id="billing_postcode_field" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="billing_postcode">{{__('Postcode / ZIP')}} <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_postcode" value="{{Auth::user()->zip}}" name="customer_zip" class="input-text " required></p>
</div>