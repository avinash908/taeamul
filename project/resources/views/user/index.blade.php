@extends('layouts.front.app')

@section('content')
<style type="text/css">
  .parentClass{
    background-color: #eee;
    box-shadow: 0px 0px 3px #ddd;
  }
  .list-group-item:hover{
    background-color: #eee;
    opacity: 0.8;
  }
</style>
<div class="content">
	<div class="container">
		<div class="row">
         @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
  @endif
			<div class="col-lg-3 p-5">
				<div class="top-nav  bg-template">
					<div id="p-center">
						<img src="{{url('/').'/'.Auth::user()->image->url}}" width="30%" class="img-fluid " style="border-radius: 40%">
						<h4 class="txt-white">{{__(ucfirst(Auth::user()->name))}}</h4>
					</div>
				</div>
				<div class="bg-light" style="padding: 10px"></div>
				<div class="bg-success p-5">
					<ul class="list-group">
					<li class="list-group-item" id="dashboard" style="color:#000"><a class="hoverItem" href="javascript:void(0)" style="color: #000"> {{__('Dashboard')}}</a></li>
          <li class="list-group-item" id="orders" style="color:#000"><a class="hoverItem" href="javascript:void(0)" style="color: #000"> {{__('Orders')}}</a></li>
					<li class="list-group-item" id="messages" style="color:#000" ><a class="hoverItem" href="javascript:void(0)" style="color: #000"> {{__('Messages')}}</a></li>
					<li class="list-group-item" id="tracking" style="color:#000"><a class="hoverItem" href="javascript:void(0)" style="color: #000"> {{__('Order Tracking')}}</a></li>
					<li class="list-group-item" id="edit_profile" style="color:#000"><a class="hoverItem" href="javascript:void(0)" style="color: #000"> {{__('Edit Profile')}}</a></li>
					<li class="list-group-item" id="settings" style="color:#000"><a class="hoverItem" href="javascript:void(0)" style="color: #000"> {{__('Settings')}}</a></li>
					<li class="list-group-item" id="logout" style="color:#000"><a class="hoverItem" href="{{route('user.logout')}}" style="color: #000"> {{__('Logout')}}</a></li>
	
				</ul>
				</div>
			</div>
     
			<div id="async-data" class="col-lg-9 pd-5"  style="border:1px solid lightgray">
				<div id="loader">
					<div class="col-lg-12" style="background-color: lightgrey;padding: 10px"></div>
					<div class="col-lg-12" style="background-color: white;padding: 10px"></div>
					<div class="col-lg-12" style="background-color: lightgrey;padding: 50px"></div>
					<div class="col-lg-12" style="background-color: white;padding: 10px"></div>
					<div class="col-lg-12" style="background-color: lightgrey;padding: 10px"></div>
					<div class="col-lg-12" style="background-color: white;padding: 10px"></div>
					<div class="col-lg-12" style="background-color: lightgrey;padding: 10px"></div>
				</div>
			</div>

			
			
		</div>
			
	</div>
</div>
@endsection

@section('jquery')

<script type="text/javascript" src="{{asset('assets/js/jQuery.print.min.js')}}"></script>
<script type="text/javascript">

jQuery(document).ready(function () {
function dataClick() {
  jQuery.ajax({
    url:'{{route("in.msg")}}',
    type:'POST',
    data: { _token:jQuery('#_token').attr('content') },
    success:function (data) {
      jQuery('#addData').empty();
      jQuery('#addData').html(data.html);
    },

  });
}
 jQuery('.hoverItem').click(function () {
      var prt = jQuery(this).parent('.list-group-item');
      jQuery('.list-group-item').removeClass('parentClass')

      // jQuery(this).addClass('hoverOn');
      prt.addClass('list-group-item parentClass')
  });



  jQuery(document).on('click','.print_btn',function(){
    jQuery("#invoice").print({
      noPrintSelector : ".avoid-this-for-print",
    }); 
  });



  jQuery(document).on('submit','.track_order',function (e) {
      e.preventDefault();
      jQuery.ajax({
          url:jQuery(this).attr('action'),
          type:'POST',
          data:jQuery(this).serialize(),
          dataType:'JSON',
          success:function (data) {
             jQuery('#statusSelect').empty();
                        jQuery('#exampleModal').modal('show');
                        jQuery('#statusSelect').html('<div style="text-align:center;padding: 10px;font-weight: bold;text-transform: capitalize;"><h3>{{__("Your Order Is")}} &nbsp;'+data.success+'</h3></div>');
          }
      });
  });
  jQuery('document').on('submit','#updt',function (e) {
    e.preventDefault();
    jQuery.ajax({
      url:'{{url("my-account/update")}}',
      type:'POST',
      data: new FormData(this),
      success:function (data) {
        alert(data.success);
      }
    });
  });
	var url = '{{url("dashboardData")}}';
        function dataFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        dataFetch();
         function orderTrackStatus() {
           var url = '{{url("orderTrackingData")}}';
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }


         
	jQuery('#dashboard').click(function () {
       var url = '{{url("dashboardData")}}';
        function dataFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        dataFetch();
	});
	jQuery('#edit_profile').click(function () {
		       var url = '{{url("editProfileData")}}';
        function dataFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        dataFetch();
	});
  jQuery('#messages').click(function () {
    function messages() {
       var url = '{{url("/userMessage")}}';
        jQuery.ajax({
           url: url,
           method:'POST',
           data: { _token:jQuery('#_token').attr('content') },
           beforeSend: function(){
            jQuery('#loader').show();
            },
           success:function (data) {
             jQuery('#loader').hide();
             jQuery('#async-data').empty()
             jQuery('#async-data').html(data.html)
           }
        });
    }
    messages();
    dataClick();
  });
  jQuery(document).on('submit','#msgAdmin',function (e) {
    e.preventDefault();
    var url = "{{route('user.msg.send')}}";
    jQuery.ajax({
      url:url,
      type:'POST',
      data:{
        _token:jQuery('#_token').attr('content'),
        replyBox:jQuery('#replyBox').val(),
        subBox:jQuery('#subBox').val(),
      },
      success:function(data){
        toastr.success('success','Message Sent !')
        jQuery('#msgAdmin')[0].reset();
    dataClick();
        
      },

    });
  })
   
    
	jQuery('#orders').click(function () {
		       var url = '{{url("ordersData")}}';
        function dataFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        dataFetch();
	});
	jQuery('#settings').click(function () {
		       var url = '{{url("settingsData")}}';
        function dataFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        dataFetch();
	});
	jQuery('#tracking').click(function () {
		       var url = '{{url("orderTrackingData")}}';
        function dataFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        dataFetch();
	});

	
})	
</script>
<script type="text/javascript">
    jQuery(document).on('click','.viewOrder',function () {
       var url = jQuery(this).attr('data-url');
        function orderViewFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#loader').show();
                },
               success:function (data) {
                 jQuery('#loader').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        orderViewFetch();
  });
</script>
@endsection
@section('toast')
@include('front.partials.script')
@endsection