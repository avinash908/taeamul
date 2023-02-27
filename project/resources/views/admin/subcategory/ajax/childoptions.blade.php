<option value="">{{__('Select Child Category')}}</option>
@foreach($cat->childs as $child)
	<option value="{{$child->id}}" data-url="{{route('admin.childcategory.attributes',$child->id)}}">{{__($child->name)}}</option>
@endforeach