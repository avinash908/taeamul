@extends('layouts.vendor.app')
@section('content')
      @if(auth()->user()->status != 1)
        <div class="alert alert-danger">
          <p>{{__('*Your Account is not Verified!')}}</p>
          <p>{{__('*Your Account Under Verification Process!')}}</p>
          <p>{{__('*You can contact Administrator!')}}</p>
        </div>
      @else
       <div class="row grid-margin">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{__('Current Balance:')}} <b>Sr. {{ number_format(Auth::user()->shop->current_balance,2)}}</b></h4>
                <?php 
                  $payment_setting = App\PaymentSetting::find(1);
                ?>
                @if($payment_setting)
                  @if($payment_setting->charge_in_percentage == 1)
                    <p><b>{{__('Note:')}}</b> {{ $payment_setting->commission_charges.'%' }} {{__('Pecent will be charge on each Order!' )}}</p>
                  @else
                    <p><b>{{__('Note:')}}</b> {{ 'Sr'.$payment_setting->commission_charges }} {{__('will be charge on each Order!' )}}</p>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
      @endif
        <div class="row">
          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
              <div class="card-body">
                <h6 class="font-weight-normal">O{{__('rders Pending!')}}</h6>
                <h2 class="mb-0">{{Auth::user()->shop->orders()->where('status','=','pending')->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Orders Processing!')}}</h6>
                <h2 class="mb-0">{{Auth::user()->shop->orders()->where('status','=','processing')->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card bg-gradient-warning text-white text-center card-shadow-warning">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Orders Completed!')}}</h6>
                <h2 class="mb-0">{{Auth::user()->shop->orders()->where('status','=','completed')->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card bg-gradient-info text-white text-center card-shadow-info">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Products!')}}</h6>
                <h2 class="mb-0">{{Auth::user()->shop->products()->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card bg-gradient-info text-white text-center card-shadow-info">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Items Sold!')}}</h6>
                <h2 class="mb-0">{{Auth::user()->shop->orders()->where('status','=','completed')->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
            <div class="card bg-gradient-info text-white text-center card-shadow-info">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Earning!')}}</h6>
                <h2 class="mb-0">Sr. {{ number_format(Auth::user()->shop->current_balance,2)}}</h2>
              </div>
            </div>
          </div>
        </div>
@endsection

