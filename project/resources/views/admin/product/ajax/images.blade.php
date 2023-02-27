<div class="row" style="padding: .5rem;line-height: 0;">
	@foreach($product->images as $p_img)
	<div class="col-lg-2  col-md-2 p-galler-img-box">
		<img src="{{asset($p_img->url)}}">
    <span href="javascript:void(0)" data-url="{{route('admin.product.image.delete',[$product->id,$p_img->id])}}" class="p-img-delete-icon dlt_p_img">&#10006;</span>
	</div>
	@endforeach
</div>