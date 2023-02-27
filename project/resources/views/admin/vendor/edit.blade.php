@extends('layouts.admin.app')
@section('content')
<div class="container">
  <div class="bg-white p-5 col-xl-12 col-lg-12 col-md-12 col-sm-12 shadow-lg">
    <h1 class="pb-4">{{__('Edit Vendor')}}</h1>
      <form action="{{route('admin.vendors.update',$user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
        	<div class="col-md-3">
        		<input type="file" class="drop-image" data-allowed-file-extensions="jpeg png jpg gif" data-default-file="{{url('/').'/'.$user->image->url}}" name="pic">
        	</div>
        	<div class="col-md-9">
              <div class="row">
                @if ($errors->any())
                  <hr/>
                  <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                @endif
              <div class="col-md-6">
            		<div class="form-group">
                  <label>{{__('Vendor Name')}}</label>
                  <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                </div>
              </div>
              <div class="col-md-6">           
                <div class="form-group">
                  <label>{{__('Vendor Email')}}</label>
                  <input type="email" name="email" class="form-control" value="{{$user->email}}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>{{__('Vendor Phone')}}</label>
                  <input type="text" name="phone" class="form-control" value="{{$user->phone}}" required>
                </div>
              </div>
              <div class="col-md-6">
                
                <div class="form-group">
                  <label>{{__('Vendor Address')}}</label>
                  <textarea  name="address" class="form-control" required>{{$user->address}}</textarea>
                </div>
              </div>
              <div class="col-md-4">
                
                <div class="form-group">
                  <label>{{__('Vendor City')}}</label>
                  <input type="text" name="city" class="form-control" value="{{$user->city}}" required>
                </div>
              </div>
              <div class="col-md-4">
                
                <div class="form-group">
                  <label>{{__('State')}}</label>
                  <input type="text" name="state" class="form-control" value="{{$user->state}}">
                </div>
              </div>
              <div class="col-md-4">
                
                <div class="form-group">
                  <label>{{__('Vendor Postal Code/Zip')}}</label>
                  <input type="text" name="zip" class="form-control" value="{{$user->zip}}" required>
                </div>
              </div>
              
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
                      {{__('(Attach file* if you attach new file old one will be deleted ')}}<b>{{__('Be careful')}}</b>)
                    </span>
                  </label>
                  <div class="input-group">
                    
                    <input type="file" name="comercial_reg_copy" class="form-control" >
                     <div class="input-group-prepend">
                      
                      <a href="{{url('/') .'/'. $user->shop->comercial_reg_copy}}" class="btn btn-dark" download>{{__('Download')}}</a>
                    </div>
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
                     {{__(' (Attach file* if you attach new file old one will be deleted ')}}<b>{{__('Be careful')}}</b>)
                    </span>
                  </label>
                  <div class="input-group">
                  <input type="file" name="national_copy" class="form-control" >
                      <div class="input-group-prepend">
                      <a  href="{{url('/') .'/'. $user->shop->national_copy}}" class="btn btn-dark" download>{{__('Download')}}</a>
                    </div>
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
        	</div>
        </div>
      </form>
  </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
  $('.drop-image').dropify();
</script>
@endsection