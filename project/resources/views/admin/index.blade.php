@extends('layouts.admin.app')
@section('content')
    @if(auth()->guard('admin')->user()->can('can view earning status'))
        <div class="row grid-margin">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{__('Earnings')}}</h4>
                
              </div>
            </div>
          </div>
        </div>
    @endif
        <div class="row">
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Orders Pending!')}}</h6>
                <h2 class="mb-0">{{App\Order::where('status','=','pending')->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Orders Processing!')}}</h6>
                <h2 class="mb-0">{{App\Order::where('status','=','processing')->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-warning text-white text-center card-shadow-success">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Orders Completed!')}}</h6>
                <h2 class="mb-0">{{App\Order::where('status','=','completed')->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-info text-white text-center card-shadow-info">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Sales!')}}</h6>
                <h2 class="mb-0">{{App\Order::where('payment_status','=',1)->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Products!')}}</h6>
                <h2 class="mb-0">{{App\Product::all()->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-warning text-white text-center card-shadow-warning">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Customers!')}}</h6>
                <h2 class="mb-0">{{App\User::where('is_vendor','!=',1)->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-info text-white text-center card-shadow-info">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Vendors!')}}</h6>
                <h2 class="mb-0">{{App\User::where('is_vendor','=',1)->count()}}</h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 grid-margin stretch-card">
            <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
              <div class="card-body">
                <h6 class="font-weight-normal">{{__('Total Posts!')}}</h6>
                <h2 class="mb-0">{{App\Post::all()->count()}}</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row grid-margin">
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{__('Recent Orders')}}</h4>
                <div class="table-responsive mt-2">
                  <table class="datatable table mt-3 border-top">
                    <thead>
                      <tr>
                        <th>{{__('Order Number')}}</th>
                        <th>{{__('Order Date')}}</th>
                        <th>{{__('Order Status')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach(App\Order::orderBy('id','desc')->take(5)->get() as $r_order)
                      <tr>
                        <td>{{$r_order->order_number}}</td>
                        <td>{{($r_order->created_at != null) ? $r_order->created_at->format('Y-m-d') : '----'}}</td>
                        <td>
                          <div class="badge order-{{$r_order->status}} badge-fw">{{ucwords($r_order->status)}}</div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{__('Recent Customer')}}</h4>
                <div class="table-responsive mt-2">
                  <table class="datatable table mt-3 border-top">
                    <thead>
                      <tr>
                        <th>{{__('Customer Email')}}</th>
                        <th>{{__('Joined')}}</th>
                        <th>{{__('Action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach(App\User::where('is_vendor','!=',1)->orderBy('id','desc')->take(5)->get() as $customer)
                      <tr>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->created_at}}</td>
                        <td><a href="{{route('admin.customers.show',$customer->id)}}" class="btn btn-info btn-sm">View</td></a>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row grid-margin">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{__('Recent Products')}}</h4>
                <div class="table-responsive mt-2">
                  <table class="datatable table mt-3 border-top">
                    <thead>
                        <tr>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(App\Product::where('status','!=',0)->orderBy('id','desc')->take(5)->get() as $r_product)
                        <tr>
                        <td>
                          <img src="{{asset($r_product->thumbnail)}}">
                        </td>
                        <td>{{__($r_product->name)}}</td>
                        <td>
                          {{__(ucfirst($r_product->category->name))}}
                        </td>
                        <td>{{number_format($r_product->price,2)}}</td>
                          <td>
                              <a href="" class="badge badge-dark">
                                <i class="mdi mi-eye"></i> {{ __('View') }}
                              </a>
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
        <div class="row">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h1 class="card-title">{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}
              </div>
            </div>
          </div>
        </div>
@endsection
@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection