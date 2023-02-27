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
                                                <label for="orderid">{{__('Order ID')}}</label>
                                                <input class="input-text" type="text" value="T0001" name="orderId" id="orderid" placeholder="Found in your order confirmation email." required/>
                                            </p>

                                            <p class="form-row form-row-last">
                                                <label for="order_email">{{__('Billing Email')}}</label>
                                                <input class="input-text" type="text" name="orderEmail" id="order_email" placeholder="Email you used during checkout." value="azan@gmail.com" required />
                                            </p>

                                            <div class="clear"></div>

                                            <p class="form-row">
                                                <input type="submit" class="button" name="track" value="Track" />
                                            </p>
                                        </form>
                                    </div>
                                </div><!-- .entry-content -->
                         
                            </article><!-- #post-## -->

                        </main><!-- #main -->
                    </div><!-- #primary -->


                </div><!-- .col-full -->
            </div><!-- #content -->
