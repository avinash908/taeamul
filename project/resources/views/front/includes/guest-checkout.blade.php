<div class="woocommerce-billing-fields">

    <h3>{{__('Billing Details')}}</h3>

    <p id="billing_first_name_field" class="form-row form-row form-row-second validate-required"><label class="" for="billing_first_name">{{__('Full Name')}} <abbr title="required" class="required">*</abbr></label><input type="text" value="{{old('customer_name')}}" placeholder="" id="billing_first_name" name="customer_name" class="input-text " required></p>
    @error('customer_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
    <div class="clear"></div>

    <p id="billing_email_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_email">{{__('Email Address')}} <abbr title="required" class="required">*</abbr></label><input type="email"  value="{{old('customer_email')}}" placeholder="" id="billing_email" name="customer_email" class="input-text " required></p>
       @error('customer_email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
    <p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone">{{__('Phone')}} <abbr title="required" class="required">*</abbr></label><input type="tel" value="{{old('customer_phone')}}" placeholder="" id="billing_phone" name="customer_phone" class="input-text " required></p><div class="clear"></div>
       @error('customer_phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror

    <p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1">{{__('Address')}} <abbr title="required" class="required">*</abbr></label><input type="text" value="{{old('customer_address')}}"  placeholder="Street address" id="billing_address_1" name="customer_address" class="input-text " required></p>
       @error('customer_address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror

    <p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city">City <abbr title="required" class="required">*</abbr></label><input type="text"  placeholder="" id="billing_city" value="{{old('customer_city')}}" name="customer_city" class="input-text " required></p>
       @error('customer_city')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
    <p id="billing_state_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_state">{{__('State')}} <abbr title="required" class="required">*</abbr></label><input type="text" value="{{old('customer_state')}}"  placeholder="" id="billing_state" name="customer_state" class="input-text " required></p>
       @error('customer_state')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
    <p id="billing_postcode_field" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="billing_postcode">{{__('Postcode / ZIP')}} <abbr title="required" class="required">*</abbr></label><input type="text" value="{{old('customer_zip')}}" placeholder="" id="billing_postcode" name="customer_zip" class="input-text " required></p>
       @error('customer_zip')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
    <div class="clear"></div>

    <p class="form-row form-row-wide create-account"><input type="checkbox" value="1" name="createaccount" id="createaccount" class="input-checkbox"> <label class="checkbox" for="createaccount">{{__('Create an account?')}}</label></p>
    @error('createaccount')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
    <div id="password-inputsfields" style="display: none;">  
        <p id="password" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-password"><label class="" for="password">{{__('Confirm Password')}}<abbr title="required" class="required">*</abbr></label><input type="password"  placeholder="" id="password" name="password" minlength="8" class="input-text password-inputs"></p>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
        <p id="confirm-password" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-confirm-password">
            <label class="" for="confirm-password">{{__('Confirm Password')}}
            <abbr title="required" class="required">*</abbr>
        </label><input type="password" minlength="8" placeholder="" id="confirm-password" name="password_confirmation" class="input-text password-inputs"></p>
         @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
    </div>
</div>