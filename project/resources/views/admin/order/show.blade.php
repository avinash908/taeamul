@extends('layouts.admin.app')
@section('content')
<div class="container">
  <div class="bg-white p-5 col-xl-12 col-lg-12 col-md-12 col-sm-12 shadow-lg">
  <h1 class="pb-4">{{__('Order Details')}}</h1>
    <div class="row">

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
           <h4 class="card-title">{{__('Order Details')}}</h4>
            <div class="table-responsive-sm">
                <table class="table">
                    <tbody>
                    <tr>
                        <th class="45%" width="45%">{{__('Order Number')}}</th>
                        <td width="10%">:</td>
                        <td class="45%" width="45%">{{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <th width="45%">{{__('Total Product')}}</th>
                        <td width="10%">:</td>
                        <td width="45%">{{$order->items->count()}}</td>
                    </tr>
                                                                    
                    <tr>
                        <th width="45%">{{__('Total Cost')}}</th>
                        <td width="10%">:</td>
                        <td width="45%">{{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                        <th width="45%">{{__('Ordered Date')}}</th>
                        <td width="10%">:</td>
                        <td width="45%">{{$order->created_at}}</td>
                    </tr>
                    <tr>
                        <th width="45%">{{__('Payment Method')}}</th>
                        <td width="10%">:</td>
                        <td width="45%">{{$order->payment_method}}</td>
                    </tr>

                    
                    <tr>
                        <th width="45%">{{__('Payment Status')}}</th>
                        <th width="10%">:</th>
                        <td width="45%">
                          @if($order->status == 1)
                           <span class="badge badge-success">{{__('Paid')}}</span>
                          @else
                          <span class="badge badge-danger">{{__('Unpaid')}}</span>
                          @endif
                        </td>
                    </tr>  
                    
                    </tbody>
                </table>
            </div>
          </div>
          <div class="card-footer text-right">
              <a href="{{route('admin.orders.invoice',$order->id)}}" class="btn btn-primary  btn-sm">
                <i class="mdi mdi-eye"></i> {{__('View Invoice')}}
              </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
           <h4 class="card-title">{{__('Billing Details')}}</h4>
            <div class="table-responsive-sm">
                <table class="table">
                    <tbody>
                            <tr>
                                <th width="45%">{{__('Name')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{__($order->customer_name)}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Email')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_email}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Phone')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_phone}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Address')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_address}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('City')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{__($order->customer_city)}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Postal Code')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_zip}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
           <h4 class="card-title">{{__('Shipping Details')}}</h4>
            <div class="table-responsive-sm">
              @if($order->ship_to)
                <table class="table">
                    <tbody>
                    <tr>
                      <th width="45%"><strong>{{__('Name')}}:</strong></th>
                      <th width="10%">:</th>
                      <td>{{__($order->shipping_name)}}</td>
                    </tr>
                    <tr>
                      <th width="45%"><strong>{{__('Email')}}:</strong></th>
                      <th width="10%">:</th>
                    <td width="45%">{{$order->shipping_email}}</td>
                    </tr>
                    <tr>
                      <th width="45%"><strong>{{__('Phone')}}:</strong></th>
                      <th width="10%">:</th>
                    <td width="45%">{{$order->shipping_phone}}</td>
                    </tr>
                    <tr>
                      <th width="45%"><strong>{{__('Address')}}:</strong></th>
                      <th width="10%">:</th>
                    <td width="45%">{{$order->shipping_address}}</td>
                    </tr>
                    <tr>
                      <th width="45%"><strong>{{__('City')}}:</strong></th>
                      <th width="10%">:</th>
                    <td width="45%">{{__($order->shipping_city)}}</td>
                    </tr>
                    <tr>
                      <th width="45%"><strong>{{__('Postal Code')}}:</strong></th>
                      <th width="10%">:</th>
                    <td width="45%">{{$order->shipping_zip}}</td>
                    </tr>
                </tbody>
              </table>
              @else
                <table class="table">
                    <tbody>
                            <tr>
                                <th width="45%">{{__('Name')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{__($order->customer_name)}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Email')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_email}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Phone')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_phone}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Address')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_address}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('City')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{__($order->customer_city)}}</td>
                            </tr>
                            <tr>
                                <th width="45%">{{__('Postal Code')}}</th>
                                <th width="10%">:</th>
                                <td width="45%">{{$order->customer_zip}}</td>
                            </tr>
                    </tbody>
                </table>
              @endif
            </div>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 order-details-table">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{__('Products Ordered')}}</h4> 
                <div class="table-responsive">
                   <table class="table">
                    <thead>  
                     <tr class="bg-dark text-white">
                        <th >{{__('Product ID#')}}</th>
                        <th >{{__('Shop Name')}}</th>
                        <th >{{__('Product Title')}}</th>
                        <th >{{__('Details')}}</th>
                        <th >{{__('Total Price')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($order->items as $item)
                      <tr>
                        <td>{{$item->product_id}}</td>
                        <td>
                          @if($item->shop)
                          {{__(ucfirst($item->shop->name))}}
                          @else
                          {{ __(env('APP_NAME')) }}
                          @endif
                        </td>
                        <td><a href="{{url('/'.$item->product->slug)}}" target="_blank">{{__(ucwords($item->product->name))}}</a></td>
                        <td>
                          <span style="display: flex;">
                          <ul class="list-unstyled">
                            <li>    
                              <span style="font-weight: bold">{{__('Quantity')}}&nbsp;:&nbsp;</span>{{$item->quantity}}
                            </li>
                            <li>    
                              <span style="font-weight: bold">{{__('Price')}}&nbsp;:&nbsp;</span>Sr. {{number_format($item->price,2)}}
                            </li>
                            @if($item->color)
                            <li style="display: flex;">
                               <span style="font-weight: bold">Color&nbsp;:&nbsp;</span>
                            <a href="javascript:void(0)" class="atag-color-section">
                            <div style="background-color: <?=$item->color?>;padding:10px 10px ;">
                            </div>
                            </a>
                            </li>
                            @endif
                            @if($item->size)

                            <li>
                                
                             <a href="javascript:void(0)" class="atag-color-section">
                            <div>
                               <span style="font-weight: bold">Size&nbsp;:&nbsp;</span>{{$item->size}}
                            </div>
                            </a>
                            </li>
                            @endif
                          </ul>
                      </span>
                        </td>
                        <td>
                          Sr. {{number_format($item->total_price,2)}}
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
</div>
@endsection