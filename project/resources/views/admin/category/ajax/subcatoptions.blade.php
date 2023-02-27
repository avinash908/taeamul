<option value="">Select Sub Category</option>
@foreach($cat->subs as $sub)
	<option value="{{$sub->id}}" data-url="{{route('admin.subchildcategory.options',$sub->id)}}">{{__($sub->name)}}</option>
@endforeach