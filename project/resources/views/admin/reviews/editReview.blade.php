<form id="formSubmitReev" action="{{route('review.Update',$rev->id)}}" method="get">
	<input type="hidden" value="{{csrf_token()}}" id="Newtoken" name="_token">
	<div class="form-group">
		<textarea id="textareaRev" class="form-control" name="revUpdate" required>{{__($rev->review)}}</textarea>

	</div>
	<div class="form-group text-right">
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
		
	</div>
</form>