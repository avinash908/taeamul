@component('mail::message')
# {{__(env("APP_NAME"))}}

<h3 style="text-align: center;">Your Coupon Code Is</h3>
<h4 style="text-align: center;"><b>{{__($data['coupon'])}}</b></h4>
<?php
	$d  = date_create($data['endDate']);
?>
<h4 style="text-align: center;">{{__('It Will Validate till ')}}: {{__(date_format($d,"Y/m/d"))}}</h4>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ __(config('app.name')) }}
@endcomponent
