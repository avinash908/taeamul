	
		<h3  id="p-center" style="text-decoration: underline;">{{__('Edit Profile')}}</h3>
<div style="padding: 20px">
		<form id="updt" action="{{url('my-account/update')}}" method="POST" enctype="multipart/form-data">
	<div id="p-center">
		<img id="blah" src="{{url('/').'/'.Auth::user()->image->url}}" style="border-radius: 50px" width="15%">
	</div>
		<div id="p-center">
		<label class="button alt" style="cursor: pointer;display: block">{{__('Change Picture')}}
			<input  name="picUser" id="imgInp" style="display: none" type="file" value="Change Picture" class="button alt">
		</label>
		</div>
	<div style="padding: 10px 0px;"></div>
	<div style="text-align: center;">
		<h3>{{ucfirst(Auth::user()->name)}}</h3>
	</div>
	<hr>
	
	<div id="p">
			@csrf
			<div class="row">
				<p><span style="color: red;font-weight: bold"> {{__('Note')}} &nbsp;:&nbsp;{{__(' Do not leave any field Empty')}}</span></p>
				<div class="col-lg-6">
					<label>{{__('Name')}}</label>
					<input placeholder="Write Name" value="{{Auth::user()->name}}" type="text" name="uname" class="form-control" >
					<label>{{__('Phone Number')}}</label>
					<input placeholder="Write Phone" value="{{Auth::user()->phone}}" type="text" name="pno" class="form-control" required>
					<label>{{__('Address')}}</label>
					<input placeholder="Write Address" value="{{Auth::user()->address}}" type="text" name="addr" class="form-control" required>
				</div>
				<div class="col-lg-6">
					<label>{{__('Email')}}</label>
					<br>
					<small>{{__('Note : Email can Only be Changed from Settings')}}</small>
					<input placeholder="Write Email" disabled value="{{Auth::user()->email}}" type="text" name="email" class="form-control">
					<label>{{__('City')}}</label>
					<input placeholder="Write City" value="{{__(Auth::user()->city)}}" type="text" name="city" class="form-control" required>
					<label>{{__('Country')}}</label>
					<input placeholder="Write Country" value="{{__(Auth::user()->country)}}" type="text" name="country" class="form-control" required>
				</div>
			</div>
			<div style="padding: 30px;" id="p-center">
				<input type="submit" data-value="Place order" value="Update" class="button alt">
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                jQuery('#blah').removeAttr('src');
                jQuery('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
   jQuery("#imgInp").change(function(){
        readURL(this);
    });
</script>