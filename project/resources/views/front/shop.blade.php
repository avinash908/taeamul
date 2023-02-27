@extends('layouts.front.master')
@include('front.includes.shop_seo')
@section('body-classes','left-sidebar')

@section('content')

<div id="content" class="site-content" tabindex="-1">
    <div class="container">
                    
        <nav class="woocommerce-breadcrumb" ><a href="{{url('/')}}">{{__('Home')}}</a>
            <span class="delimiter"><i class="fa fa-angle-right"></i></span><a href="{{url('/shop')}}">{{__('Shop')}}</a>
            @if(!empty($cat))
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                @if(!empty($subcat))
                <a href="{{url('/shop',$cat->slug)}}">{{__(ucwords($cat->name))}}</a>
                @else
                {{__(ucwords($cat->name))}}
                @endif
            @endif
            @if(!empty($subcat))
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>
                @if(!empty($childcat))
                <a href="{{url('/shop',[$cat->slug, $subcat->slug])}}">{{__(ucwords($subcat->name))}}</a>
                @else
                {{__(ucwords($subcat->name))}}
                @endif
            @endif
            @if(!empty($childcat))
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__(ucwords($childcat->name))}}
            @endif
        </nav>
        <!-- filter form -->
        <form id="filter_form" action="{{route('front.shop', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')])}}" method="get">
            @if(request()->filled('search'))
            <input type="hidden" name="search" value="{{request('search')}}">
            @endif
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <header class="page-header">
                    @php
                        $curenTCategory = App\CurrentFilter::category($childcat ?? null, $subcat  ?? null, $cat  ?? null);
                        $seletedTitle = $curenTCategory ? $curenTCategory->name : 'Shop Products';
                    @endphp
                    <h1 class="page-title">{{__(ucwords($seletedTitle))}}</h1>
                    <p class="woocommerce-result-count">{{__("Showing")}}  {{ $products->firstItem() }}&ndash;{{ $products->lastItem() }} of {{$products->total()}} {{__("results")}}</p>
                </header>

                <div class="shop-control-bar">
                    <ul class="shop-view-switcher nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" title="Grid View" href="#grid"><i class="fa fa-th"></i></a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" title="Grid Extended View" href="#grid-extended"><i class="fa fa-align-justify"></i></a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View" href="#list-view"><i class="fa fa-list"></i></a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View Small" href="#list-view-small"><i class="fa fa-th-list"></i></a></li>
                    </ul>
                    <div class="woocommerce-ordering">
                        
                        <select name="sort" id="sortby" class="orderby short-item" onchange="document.getElementById('filter_form').submit()">
                        <option value="date_desc" {{ (request()->sort == 'date_desc') ? 'selected' : '' }}>{{__('Latest Product')}}</option>
                        <option value="date_asc" {{ (request()->sort == 'date_asc') ? 'selected' : '' }}>{{__('Oldest Product')}}</option>
                        <option value="price_asc" {{ (request()->sort == 'price_asc') ? 'selected' : '' }}>{{__('Lowest Price')}}</option>
                        <option value="price_desc" {{ (request()->sort == 'price_desc') ? 'selected' : '' }}>{{__('Highest Price')}}</option>
                        </select>
                    </div>
                </div>

                <div class="tab-content">
                    @include('front.ajax.shopProducts')
                </div>
                <div class="shop-control-bar-bottom">
                    <p class="woocommerce-result-count">{{__("Showing")}}  {{ $products->firstItem() }}&ndash;{{ $products->lastItem() }} of {{$products->total()}} {{__("results")}}</p>
                    {{ $products->links('front.includes.pagination') }}
                </div>

            </main><!-- #main -->
        </div><!-- #primary -->

        <div id="sidebar" class="sidebar" role="complementary">
            <aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
                <ul class="product-categories category-single">
                    <li class="product_cat">
                        <ul class="show-all-cat">
                            <li class="product_cat"><span class="show-all-cat-dropdown">{{__('Show All Categories')}}</span>
                                <ul>
                                    <?php
                                        $categories = App\Category::where('status','!=',0)->get();
                                    ?>
                                    @foreach($categories as $category)
                                    <li class="cat-item"><a href="{{url('/shop',$category->slug)}}">{{__(ucwords($category->name))}}</a> <span class="count">( {{$category->products()->count()}} )</span></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <ul>
                            @foreach ($categories as $category)
                                @if(!empty($cat) && $cat->id == $category->id)
                                <li class="cat-item current-cat">
                                    <a href="{{route('front.shop', $category->slug)}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}">{{__(ucwords($cat->name))}}</a> <span class="count">( {{$cat->products()->count()}} )</span>
                                    @if($cat->subs)
                                        <ul class="children" style="display: block;">
                                        @foreach($cat->subs as $subcategory)
                                            <li class="cat-item cat-item-116 {{(!empty($subcat) && $subcat->id == $subcategory->id) ? 'current-cat' : ''}}">         
                                            <a href="{{route('front.shop', [$cat->slug, $subcategory->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}">
                                                {{__(ucwords($subcategory->name))}} 
                                                <span class="count">({{$subcategory->products()->count()}} )</span>
                                            </a>
                                            @if(!empty($subcat) && $subcat->id == $subcategory->id && !empty($subcat->childs))
                                                <ul class="" style="display: block !important;">
                                                    @foreach($subcat->childs as $childcategory)
                                                    <li class="cat-item cat-item-116 {{(!empty($childcat) && $childcat->id == $childcategory->id) ? 'current-cat' : ''}}">
                                                        <a href="{{route('front.shop', [$cat->slug, $subcat->slug, $childcategory->slug])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}">{{__(ucwords($childcategory->name))}} 
                                                        <span class="count">({{$childcategory->products()->count()}} )</span>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            </li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </aside>
            <aside class="widget widget_electro_products_filter">

                
                    <h3 class="widget-title">{{__('Filters')}}</h3>

                        @if (!empty($cat))
                        <aside class="widget woocommerce widget_layered_nav">
                          @foreach ($cat->attributes as $key => $attr)
                            <h3 class="widget-title">{{__(ucwords($attr->name))}}</h3>
                            @if (!empty($attr->attribute_options))
                            <ul>
                              @foreach ($attr->attribute_options as $key => $option)
                                <li>
                                    <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}"
                                    {{ (is_array(request($attr->input_name)) && in_array($option->name, request($attr->input_name))) ? ' checked' : '' }}
                                    >
                                    <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{__(ucwords($option->name))}}</label>
                                </li>
                              @endforeach
                            </ul>
                            @endif
                          @endforeach
                          <!-- <p class="maxlist-more"><a href="#">{{__('Show more')}} </a></p> -->
                        </aside>
                        @endif

                        @if (!empty($subcat))
                        <aside class="widget woocommerce widget_layered_nav">
                          @foreach ($subcat->attributes as $key => $attr)
                           <h3 class="widget-title">{{__(ucwords($attr->name))}}</h3>
                            @if (!empty($attr->attribute_options))
                            <ul>
                              @foreach ($attr->attribute_options as $key => $option)
                               <li>
                                   <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}"
                                    {{ (is_array(request($attr->input_name)) && in_array($option->name, request($attr->input_name))) ? ' checked' : '' }}
                                    >
                                    <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{__(ucwords($option->name))}}</label>
                                </li>
                              @endforeach
                            </ul>
                            @endif
                          @endforeach
                        </aside>
                        @endif

                        @if (!empty($childcat) )
                        <aside class="widget woocommerce widget_layered_nav">
                          @foreach ($childcat->attributes as $key => $attr)
                            <h3 class="widget-title">{{__(ucwords($attr->name))}}</h3>
                            @if (!empty($attr->attribute_options))
                            <ul>
                              @foreach ($attr->attribute_options as $key => $option)
                                <li>
                                  <input name="{{$attr->input_name}}[]" class="form-check-input attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}"
                                    {{ (is_array(request($attr->input_name)) && in_array($option->name, request($attr->input_name))) ? ' checked' : '' }}
                                    >
                                    <label class="form-check-label" for="{{$attr->input_name}}{{$option->id}}">{{__(ucwords($option->name))}}</label>
                                </li>
                              @endforeach
                            </ul>
                            @endif
                          @endforeach  

                        </aside>
                        @endif
                        <aside id="woocommerce_price_filter-1" class="widget woocommerce widget_price_filter">
                        <h3 class="widget-title">Price</h3>
                            <div class="price_slider_wrapper">
                                <div id="slider-range" class="price-filter-range price_slider " style="width: 100%" name="rangeInput"></div>
                                <input type="hidden" name="min_price" min=0 max="100000" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" />
                                <input type="hidden" name="max_price" min=0 max="100000" oninput="validity.valid||(value='100000');" id="max_price" class="price-range-field" />

                                <div class="price_slider_amount">
                                    <button type="submit" class="button">Filter</button>
                                    <div class="price_label" style="">
                                     Price: Sr.<span class="from price-from">0</span> — Sr.<span class="to price-to">100000</span>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </aside>
            </aside>
            @if($right_banner = App\Banner::where('position','=','right_side')->first())
            <aside class="widget widget_text">
                <div class="textwidget">
                    <a href="{{$right_banner->link}}"><img src="{{asset($right_banner->image)}}" alt="{{$right_banner->title}}"></a>
                </div>
            </aside>
            @endif
            <aside class="widget widget_products">
                <h3 class="widget-title">{{__('Latest Products')}}</h3>
                <ul class="product_list_widget">
                    @foreach(App\Product::where('status','!=',0)->latest()->take(5)->get() as $latest_p)
                    <li>
                        <a href="{{url('/'.$latest_p->slug)}}" title="{{__(ucwords($latest_p->name))}}">
                            <img width="180" height="180" src="{{asset(ucwords($latest_p->thumbnail))}}" class="wp-post-image" alt=""/><span class="product-title">{{__(ucwords($latest_p->name))}}</span>
                        </a>
                        <span class="electro-price">
                            <ins><span class="amount">Sr. {{number_format($latest_p->price,2)}}</span></ins>
                            @if($latest_p->old_price)
                                <del><span class="amount">
                                   Sr. {{number_format($latest_p->old_price,2)}}
                                 </span></del>
                            @endif
                        </span>
                    </li>
                    @endforeach
                </ul>
            </aside>
        </div>
        </form>
        <!-- filter form ends -->
    </div><!-- .container -->
</div><!-- #content -->
@include('front.includes.bottom-ads')
@endsection
@section('jquery')
<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/price_range_style.css')}}">
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/price_range_script.js')}}"></script>
@endsection