@extends('layouts.admin.app')
@section('content')
<div class="row">
  <div class="col-lg-12" >
      <div class="card px-2" id="withdraw">
          <div class="card-body">
              <div class="container-fluid">
              	<h1 class="text-left my-2">{{__(env('APP_NAME'))}} </h1>
                <p class="text-right" style=" float-right; font-size: 1rem;">( {{__('Payment Withdraw Request')}} <b># {{$withdraw->id}}</b>)</p>
              </div>
              <div class="container-fluid">
                <div class="table-responsive show-table">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>{{__('User Name')}}</th>
                            <td>
                                <a href="{{route('admin.vendors.show',$withdraw->user->id)}}" target="_blank">{{$withdraw->user->name}}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('Withdraw Amount')}}</th>
                            <td>Sr. {{number_format($withdraw->amount,2)}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Withdraw Charge')}}</th>
                            <td>Sr. {{number_format($withdraw->fee,2)}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Withdraw Process Date')}}</th>
                            <td>{{$withdraw->created_at->format('d-M-Y')}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Withdraw Status')}}</th>
                            <td>{{ucfirst($withdraw->status)}}</td>
                        </tr>
                        <tr>
                            <th>{{__('User Email')}}</th>
                            <td>{{$withdraw->user->email}}</td>
                        </tr>
                        <tr>
                            <th>{{__('User Phone')}}</th>
                            <td>{{$withdraw->user->phone}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Withdraw Method')}}</th>
                            <td>{{$withdraw->method}}</td>
                        </tr>
                         
                        <tr>
                            <th>{{__('Bank Account')}}:</th>
                            <td>{{$withdraw->iban}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Account Name')}}:</th>
                            <td>{{$withdraw->acc_name}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Address')}}</th>
                            <td>{{$withdraw->address}}</td>
                        </tr>
                        <tr>
                            <th>{{__('Bank Swift Code')}}:</th>
                            <td>{{$withdraw->swift}}</td>
                        </tr>
                     </tbody>
                 </table>
                </div>
              </div>
              <div class="container-fluid w-100">
                <a href="javascript:void(0)" class="btn btn-primary avoid-this-for-print print_btn float-right mt-4 ml-2"><i class="mdi mdi-printer mr-1"></i>{{__('Print')}}</a>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).on('click','.print_btn',function(){
		$("#withdraw").print({
			noPrintSelector : ".avoid-this-for-print",
		});	
	});
</script>
@endsection