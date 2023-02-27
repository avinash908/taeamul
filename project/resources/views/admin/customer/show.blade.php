@extends('layouts.admin.app')
@section('content')
<style type="text/css">
  .t_content_boxd {
    border: 1px solid #d6d6d6;
    box-shadow: 0 0 1px 1px #0000001f;
    border-radius: 10px;
    padding: 20px;
}
</style>
<div class="container">
  <div class="bg-white p-5 col-xl-12 col-lg-12 col-md-12 col-sm-12 shadow-lg">
    <h1 class="pb-4">{{__('Customer Details ')}}</h1>
    <div class="row">
    	<div class="col-md-3">
        <div class="t_content_boxd">
      		<div class=" p-2">
      			<img src="{{url('/').'/'.$user->image->url}}" class="img-thumnbnail rounded-circle" style="width: 100%">
      		</div>
        </div>
    	</div>
    	<div class="col-md-9">
        <div class="t_content_boxd">  
      		<table class="table">
      			<tr>
      				<td>{{__('Name')}}</td>
      				<td>{{__($user->name)}}</td>
      			</tr>
      			<tr>
      				<td>{{__('Email')}}</td>
      				<td>{{$user->email}}</td>
      			</tr>
      			<tr>
      				<td>{{__('Phone')}}</td>
      				<td>{{$user->phone}}</td>
      			</tr>
      			<tr>
      				<td>{{__('State')}}</td>
      				<td>{{__($user->state)}}</td>
      			</tr>
            <tr>
              <td>{{__('City')}}</td>
              <td>{{__($user->city)}}</td>
            </tr>
            <tr>
              <td>{{__('Address')}}</td>
              <td>{{$user->address}}</td>
            </tr>
            <tr>
              <td>{{__('Postal/Zip Code')}}</td>
              <td>{{$user->zip}}</td>
            </tr> 
      		</table>
        </div>
    	</div>
    </div>

    <div class="row" style="margin-top: 20px;">   
      <div class="col-sm-12">
        <div class="t_content_boxd">
          <div class="table-responsive">
          	<table class="table">
              <thead>  
               <tr class="bg-light text-dark">
                  <th >{{__('Order NUMBER#')}}</th>
                  <th >{{__('ORDER DATE')}}</th>
                  <th >{{__('AMOUNT')}}</th>
                  <th >{{__('STATUS')}}</th>
                  <th>{{__('Details')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->orders as $order)
                <tr>
                		<td>{{$order->order_number}}</td>
                		<td>{{$order->created_at}}</td>
                		<td>{{number_format($order->total_amount,2)}}</td>
                		<td>
                			<div class="badge order-{{$order->status}} badge-fw">{{ucwords($order->status)}}</div>
                		</td>
                		<td>
                			<a href="{{route('admin.orders.show',$order->id)}}" class="badge badge-dark">{{__('Details')}}</a>
                		</td>
                 </tr>
                @endforeach
              </tbody>
             </table>   
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection