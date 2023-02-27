@foreach($cat->attributes as $attribute)
<div class="row pt-4">
	<div class="col-md-3">
		<label>{{__(ucwords($attribute->name))}}*</label>
	</div>
	<div class="col-md-9 ">
		@foreach ($attribute->attribute_options as $key => $option)
        <div class="custom-control custom-checkbox custom-control-inline">
          <input type="checkbox" id="customRadioInline{{$option->id}}" name="{{ $attribute->input_name }}[]" value="{{__($option->name)}}" class="custom-control-input">
          <label class="custom-control-label" for="customRadioInline{{$option->id}}">{{ __($option->name) }}</label>
        </div>
      @endforeach
	</div>
</div>
@endforeach