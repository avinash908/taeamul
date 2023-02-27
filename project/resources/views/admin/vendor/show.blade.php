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
    <h1 class="pb-4">{{__('Vendor Details ')}}</h1>

    <div class="row">
      	<div class="col-md-3">
         <div class="t_content_boxd">  
      		<div class=" p-2">
      			<img src="{{asset($user->image->url)}}" class="img-thumnbnail rounded-circle" style="width: 100%">
      		</div>
      	</div>
      </div>
    	<div class="col-md-9">
        <div class="t_content_boxd">
      		<table class="table">
      			<tr>
      				<td><b>{{__('Vendor Name')}}</b></td>
      				<td>{{_($user->name)}}</td>
      			</tr>
            <tr>
              <td><b>{{__('Vendor Email')}}</b></td>
              <td>{{$user->email}}</td>
            </tr>
             <tr>
              <td><b>{{__('Vendor Phone')}}</b></td>
              <td>{{$user->phone}}</td>
            </tr>
             <tr>
              <td><b>{{__('Vendor Address')}}</b></td>
              <td>{{$user->address}}</td>
            </tr>
             <tr>
              <td><b>{{__('Vendor City')}}</b></td>
              <td>{{__($user->city)}}</td>
            </tr>
            <tr>
              <td><b>{{__('Vendor State')}}</b></td>
              <td>{{__($user->state)}}</td>
            </tr>
             <tr>
              <td><b>{{__('Vendor Zip')}}</b></td>
              <td>{{$user->zip}}</td>
            </tr>
      		</table>
        </div>
    	</div>
    </div>
    <div class="container p-3">
      <div class="row">
        <div class="col-md-12 t_content_boxd" style="background-color: #f3f3f3b3">
        <table class="table">
          <tr>
            <td><b>{{__('Shop Name')}}</b></td>
            <td>{{$user->shop->shop_name}}</td>
          </tr>
          <tr>
            <td><b>{{__('Owner Name')}}</b></td>
            <td>{{$user->shop->owner_name}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop Email')}}</b></td>
            <td>{{$user->shop->shop_email}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop Number')}}</b></td>
            <td>{{$user->shop->shop_number}}</td>
          </tr>
          <tr>
            <td><b>{{__('National ID')}}</b></td>
            <td>{{$user->shop->national_id}}</td>
          </tr>
          <tr>
            <td><b>{{__('National ID COPY')}}</b></td>
            <td><a class="btn btn-sm btn-primary" href="{{url('/') .'/'. $user->shop->national_copy}}" download>Download</a></td>
          </tr>
           <tr>
            <td><b>{{__('Comercial Register Number')}}</b></td>
            <td>{{$user->shop->comercial_reg_number}}</td>
          </tr>
          <tr>
            <td><b>{{__('Comercial Register Copy')}}</b></td>
            <td><a class="btn btn-sm btn-primary" href="{{url('/') .'/'. $user->shop->comercial_reg_copy}}" download>Download</a></td>
          </tr>
          <tr>
            <td><b>{{__('Shop Activity')}}</b></td>
            <td>{{$user->shop->shop_activity}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop Details')}}</b></td>
            <td>{{$user->shop->shop_details}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop District')}}</b></td>
            <td>{{$user->shop->shop_district}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop City')}}</b></td>
            <td>{{$user->shop->shop_city}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop Street')}}</b></td>
            <td>{{$user->shop->shop_street}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop Full Address')}}</b></td>
            <td>{{$user->shop->shop_address}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop Mail Box')}}</b></td>
            <td>{{$user->shop->shop_mail_box}}</td>
          </tr>
          <tr>
            <td><b>{{__('Shop Postal Code')}}</b></td>
            <td>{{$user->shop->shop_postal_code}}</td>
          </tr>
          <tr>
            <td><b>{{__('Created On')}}</b></td>
            <td>{{$user->shop->created_at->format('d M Y')}}</td>
          </tr>
          <tr>
            <td><b>{{__('Total Products')}}</b></td>
            <td>{{$user->shop->products->count()}}</td>
          </tr>
          <tr>
            <td><b>{{__('Vendor Status')}}</b></td>
            <td>
              @if($user->status == 1)
              <span class="badge badge-success">{{__('Verified')}}</span>
              @else
              <span class="badge badge-dark">{{__('Unverified')}}</span>
              @endif
            </td>
          </tr>
        </table> 
        </div>     
      </div>
    </div>


    <div class="col-md-12 t_content_boxd" style="background-color: #f3f3f3b3">
      <h4 >{{__('Shop Products')}}</h4>
      <div class="row table-responsive">
      	<table class="table datatable">
          <thead>  
           <tr class="bg-light text-dark">
              <th >{{__('Product')}}</th>
              <th >{{__('Stock')}}</th>
              <th >{{__('Price')}}</th>
              <th> {{__('Status')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($user->shop->products as $p)
            <tr>
              <td>{{$p->name}} </td>
              <td>{{$p->stock}} </td>
              <td>Sr. {{number_format($p->price,2)}}</td>
              <td>
                @if($p->status == 1)
                <span class="badge badge-success">{{__('Activated')}}</span>
                @else
                <span class="badge badge-danger">{{__('Deactivated')}}</span>
                @endif
              </td>
              <td>
                <a href="{{route('products.edit',$p->id)}}" class="badge badge-dark">{{__('Details')}}</a>
              </td>
             </tr>
            @endforeach
          </tbody>
         </table>   
      </div>
    </div>
  </div>
</div>
@endsection