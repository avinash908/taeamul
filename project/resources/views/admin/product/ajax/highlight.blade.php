<div class="row">
	<div class="col-lg-12">
		<form id="highlightform" action="{{route('admin.products.highlight',$product->id)}}" method="POST">
			<input type="hidden" name="_token" id="Newtoken" value="{{csrf_token()}}">
			<ul class="list-group">
				<li class="list-group-item">
		            <span class="p-highlited-text">{{__('Highlight in Featured*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_featured" class="t_switch" id="is_featured" value="yes" <?= ($product->is_featured == 1) ? 'checked="checked"' : '' ?> >
	                   <div class="switch {{ ($product->is_featured == 1) ? 'switchOn' : '' }}"></div>
	                </label>
		        </li>
		        <li class="list-group-item">
		            <span class="p-highlited-text">{{__('Highlight in  Best Seller*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_bestSeller" class="t_checkbox" id="is_bestSeller" value="yes" <?= ($product->is_bestSeller == 1) ? 'checked="checked"' : '' ?>>
	                   <div class="switch {{ ($product->is_bestSeller == 1) ? 'switchOn' : '' }} "></div>
	                </label>
		        </li>
		         <li class="list-group-item">
		           <span class="p-highlited-text">{{__('Highlight in  Top Rated*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_topRated" class="t_checkbox" id="is_topRated" value="yes" <?= ($product->is_topRated == 1) ? 'checked="checked"' : '' ?>>
	                  <div class="switch {{ ($product->is_topRated == 1) ? 'switchOn' : '' }} "></div>
	                </label>
		        </li>
		        <li class="list-group-item">
		          <span class="p-highlited-text">{{__('Highlight in Best Deals*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_bestDeals" class="t_checkbox" id="is_bestDeals" value="yes" <?= ($product->is_bestDeals == 1) ? 'checked="checked"' : '' ?>>
	                  <div class="switch {{ ($product->is_bestDeals == 1) ? 'switchOn' : '' }} "></div>
	                </label>
		        </li>
		        <li class="list-group-item">
		           <span class="p-highlited-text">{{__('Highlight in  Hot*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_hot" class="t_checkbox" id="is_hot" value="yes" <?= ($product->is_hot == 1) ? 'checked="checked"' : '' ?>>
	                  <div class="switch {{ ($product->is_hot == 1) ? 'switchOn' : '' }} "></div>
	                </label>
		        </li>
		        <li class="list-group-item">
		          <span class="p-highlited-text">{{__('Highlight in New*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_new" class="t_checkbox" id="is_new" value="yes" <?= ($product->is_new == 1) ? 'checked="checked"' : '' ?>>
	                  <div class="switch {{ ($product->is_new == 1) ? 'switchOn' : '' }} "></div>
	                </label>
		        </li>
		        <li class="list-group-item">
		          <span class="p-highlited-text">{{__('Highlight in Trending*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_trending" class="t_checkbox" id="is_trending" value="yes" <?= ($product->is_trending == 1) ? 'checked="checked"' : '' ?>>
	                  <div class="switch {{ ($product->is_trending == 1) ? 'switchOn' : '' }}"></div>
	                </label>
		        </li>
		         <li class="list-group-item">
		          <span class="p-highlited-text">{{__('Highlight in Sale*')}}</span>
	                <label class="float-right t_check">
	                  <input type="checkbox" name="is_sale" class="t_checkbox" id="is_sale" value="yes" <?= ($product->is_sale == 1) ? 'checked="checked"' : '' ?>>
	                  <div class="switch  {{ ($product->is_sale == 1) ? 'switchOn' : '' }} "></div>
	                </label>
		        </li>
		        <li class="list-group-item text-center">
		        	<button type="submit" class="btn btn-dark mt-10">Submit</button>
		        </li>
			</ul>
		</form>
	</div>
</div>