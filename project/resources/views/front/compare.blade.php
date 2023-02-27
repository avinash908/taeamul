@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Compare' )
@section('content')
<nav class=" container woocommerce-breadcrumb"><a href="{{url('/')}}">{{__('Home')}}</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>{{__('Compare')}}</nav>
<div style="margin: 7rem 0px"></div>
 <div tabindex="-1" class="site-content" id="content">
                <div class="container">
                    <h1 style="text-align: center">{{__('Compare Products')}}</h1>
                    <span class="compare_class">
                        @include('front.ajax.compare')
                    </span>
                </div><!-- .col-full -->
            </div>

            
     @include('front.includes.bottom-ads')
@endsection
@section('jquery')
<script type="text/javascript">
   
</script>
@endsection