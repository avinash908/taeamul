<div class="content" >
	<div class="msgBox" style="padding: 10px;">
	<!-- <h3 style="padding: 10px"><u>{{__('Messages')}}</u></h3> -->
		<div class="row">
			<div class="col-lg-12" style="border-left: 1px solid #eee">
				<div class="header">
						<p   style="border-bottom: 2px solid #eee;font-size: 1.4rem;font-weight: bold">{{__('Messages')}}</p>
					<div class="row">
						<div style="height: 20rem;max-height: 25rem;overflow-y: scroll;">
							<div class="msgfrom col-lg-9" style="margin:10px 10px;background-color: #eee;padding: 10px; border-radius:10px;">
								<p class="lead"><span style="font-weight: bold">Hi, {{ucwords(Auth::user()->name)}}</span></p>
								<p style="font-size: 1rem">Thank You For Registering <br>Your Account at Taemul.</p>
								<p style="font-weight: bold;font-size: 1rem;margin-right: 2rem" >- {{__(env('APP_NAME'))}}</p>
							</div>
							<span id="addData">
								
							</span>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-lg-12">
						<form action="javascript:void(0)" id="msgAdmin" method="post">
							@csrf
							<div class="form-group">
								<label for="subBox">Subject</label>
	                    		<input type="text" placeholder="Subject" id="subBox" name="subBox" class="form-control">
							</div>
							<div class="form-group">
								<label for="replyBox">Reply</label>
	                 			<textarea class="form-control rounded-0 " id="replyBox" style="border:1px solid #eee" name="replyBox" cols="10" rows="6" placeholder="Write Reply"></textarea>
							</div>
							
							<div style="text-align: right;">
								<button type="submit" class="button alt">Send</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
