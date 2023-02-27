@extends('layouts.vendor.app')
@section('content')
<div class="py-4"></div>
<div class="container bg-white rounded-pill p-5">
  <h1>{{__('Shop Settings')}}</h1>
  @if ($errors->any())
      <ul class="alert alert-danger">
          @foreach($errors->all() as $error)
            <li>  
              {{__($error)}}</li>
          @endforeach
      </ul>
  @endif
  <div class="p-4">
  <form action="{{route('v-settings.update.shop')}}" method="POST" enctype="multipart/form-data">
      @csrf
    <div class="row">
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop Name')}}</label>
            <input type="text" name="shop_name" class="form-control" value="{{$user->shop->shop_name}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Owner Name')}}</label>
            <input type="text" name="owner_name" class="form-control" value="{{$user->shop->owner_name}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop Email')}}</label>
            <input type="email" name="shop_email" class="form-control" value="{{$user->shop->shop_email}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop Number')}}</label>
            <input type="text" name="shop_number" class="form-control" value="{{$user->shop->shop_number}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Comercial Register Number')}}</label>
              
            <input type="text" name="comercial_reg_number" class="form-control" value="{{$user->shop->comercial_reg_number}}" required>

          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Comercial Register Copy')}}
               <span style="display: block;font-size: 10px; font-weight: 400;color: red">
                ({{__('Attach file* if you attach new file old one will be deleted')}} <b>{{__('Be careful')}}</b>)
              </span>
            </label>
            <div class="input-group">
              <input type="file" name="comercial_reg_copy" class="form-control" >
            </div>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('National ID Number')}}</label>
            <input type="text" name="national_id" class="form-control" value="{{$user->shop->national_id}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('National ID Copy')}}
               <span style="display: block;font-size: 10px; font-weight: 400;color: red">
                ({{__('Attach file* if you attach new file old one will be deleted')}} <b>{{__('Be careful')}}</b>)
              </span>
            </label>
            <div class="input-group">
              <input type="file" name="national_copy" class="form-control" >
            </div>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop District')}}</label>
            <input type="text" name="shop_district" class="form-control" value="{{$user->shop->shop_district}}">
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop City')}}</label>
            <input type="text" name="shop_city" class="form-control" value="{{$user->shop->shop_city}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop Street')}}</label>
            <input type="text" name="shop_street" class="form-control" value="{{$user->shop->shop_street}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop Address')}}</label>
           <textarea class="form-control" name="shop_address" required>{{$user->shop->shop_address}}</textarea>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop MailBox')}}</label>
            <input type="text" name="shop_mail_box" class="form-control" value="{{$user->shop->shop_mail_box}}" required>
          </div>
        </div>
        <div class="col-md-6">
          
          <div class="form-group">
            <label>{{__('Shop Postal Code/Zip')}}</label>
            <input type="text" name="shop_postal_code" class="form-control" value="{{$user->shop->shop_postal_code}}" required>
          </div>
        </div>
        <div class="col-md-12">
          
          <div class="form-group">
            <label>{{__('Shop Activity')}}</label>
            <textarea name="shop_activity" class="form-control" required>{{$user->shop->shop_activity}}</textarea>
          </div>
        </div>
        <div class="col-md-12">
          
          <div class="form-group">
            <label>{{__('Shop Details')}}</label>
            <textarea name="shop_details" class="form-control">{{$user->shop->shop_details}}</textarea>
          </div>
        </div>
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">{{__('UPDATE')}}</button>
        </div>
    </div>
  </form>
  </div>
</div>
@endsection