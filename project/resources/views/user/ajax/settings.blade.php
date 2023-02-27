<div class="settings">
	<hr>
	<div class="vc_toggle panel panel-default">
    <div class="panel-heading" role="tab" id="headingTow">
        <div class="vc_toggle_title">
            <h4 class="panel-title">
                <a data-toggle="collapse" style="color: #434343;" data-parent="#accordion" href="#collapseTow" aria-expanded="true" aria-controls="collapseTow">{{__('Change Email')}}</a>
            </h4>
            <i class="vc_toggle_icon"></i>
        </div>
    </div>
    <div id="collapseTow" class="vc_toggle_content panel-collapse collapse" role="tabpanel" aria-labelledby="headingTow">
    	<form action="{{route('user.email.update')}}" method="post">
    		@csrf
    		
        <p class="form-row" style="padding-left: 30px">
				<p style="margin-left: 40px"><b>{{__('Current Email')}}</b> : {{Auth::user()->email}}</p>
			</p>
			<p class="form-row" style="padding-left: 30px">
				<label>{{__('Write New Email')}}</label>
				<input type="email" placeholder="Change Email" name="email" required>
			</p>
			<input type="submit" class="button alt" value="Change" name="">
    	</form>
    </div>
</div>
<hr>

</div>
<div>
<div class="vc_toggle panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
        <div class="vc_toggle_title">
            <h4 class="panel-title">
                <a data-toggle="collapse" style="color: #434343;" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">{{__('Change Password')}}</a>
            </h4>
            <i class="vc_toggle_icon"></i>
        </div>
    </div>
    <div id="collapseThree" class="vc_toggle_content panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
    	<form action="{{route('user.pass.update')}}" method="post">
    		@csrf
        <p class="form-row" style="padding-left: 30px">
				<label>{{__('Write Current Password')}}</label>
				<input type="password" name="c_pass" required>
			</p>
			<p class="form-row" style="padding-left: 30px">
				<label>{{__('Write New Password')}}</label>
				<input type="password" name="password" required>
			</p>
			<p class="form-row" style="padding-left: 30px">
				<label>{{__('Confirm New Password')}}</label>
				<input type="password"  name="password_confirmation" required>
			</p>
			<input type="submit" class="button alt" value="Change" name="">
    	</form>

    </div>
</div>
<hr>
</div>



</div>
