@extends('layouts.front.app')
@section('title',env('APP_Name') . ' - Track Order' )
  @section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div id="statusSelect" class="modal-body">
      </div>
     
    </div>
  </div>
</div>
  <div id="content" class="site-content" tabindex="-1">
                <div class="container">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">

                            <article id="post-2181" class="post-2181 page type-page status-publish hentry">

                                <header class="entry-header">
                                    <h1 class="entry-title" itemprop="name">{{__('Track your Order')}}</h1>
                                </header><!-- .entry-header -->

                                <div class="entry-content" itemprop="mainContentOfPage">
                                    <div class="woocommerce">
                                        <form action="{{route('order.status.fetch')}}" method="post" class="track_order">
                                            @csrf
                                            <p>{{__('To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.')}}</p>

                                            <p class="form-row form-row-first">
                                                <label for="orderid">Order ID</label>
                                                <input class="input-text" type="text"  name="orderId" id="orderid" placeholder="Found in your order confirmation email." required/>
                                            </p>

                                            <p class="form-row form-row-last">
                                                <label for="order_email">Billing Email</label>
                                                <input class="input-text" type="text" name="orderEmail" id="order_email" placeholder="Email you used during checkout." required />
                                            </p>

                                            <div class="clear"></div>

                                            <p class="form-row">
                                                <button id="btnTrack" style="background-color: #fed700" type="submit" class="button" name="track" >
                                                    {{__('Track')}}
                                                 <i id="spinner" style="display: none" class="fa fa-spinner fa-spin"></i>
                                                </button>
                                            </p>
                                        </form>
                                    </div>
                                </div><!-- .entry-content -->
                            </article><!-- #post-## -->
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- .col-full -->
            </div><!-- #content -->
 @include('front.includes.bottom-ads')
@endsection
@section('jquery')
<script type="text/javascript">
jQuery(document).ready(function () {
  jQuery(document).on('submit','.track_order',function (e) {
      e.preventDefault();
      jQuery.ajax({
          url:jQuery(this).attr('action'),
          type:'POST',
          data:jQuery(this).serialize(),
          dataType:'JSON',
          beforeSend:function () {
            jQuery('#spinner').show();
          },
          success:function (data) {
            jQuery('#spinner').hide();

            jQuery('#statusSelect').empty();
            jQuery('#exampleModal').modal('show');
            jQuery('#statusSelect').html('<div style="text-align:center;padding: 10px;font-weight: bold;text-transform: capitalize;"><h3>Your Order Is&nbsp;'+data.success+'</h3></div>');
          }
      });
  });
  });
</script>
@endsection