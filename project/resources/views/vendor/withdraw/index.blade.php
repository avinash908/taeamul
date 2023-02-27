@extends('layouts.vendor.app')
@section('content')

<div class="card">
<div class="card-body">
  <div class="row">
    <div class="col-12">
      @if(Auth::user()->shop->current_balance  < 1)
      <p style="color:red">{{__('Sorry Not-sufficient funds for withdraw')}}</p>
      <a href="#" class="btn btn-primary float-right disabled" title="{{__('Non-sufficient funds for withdraw')}}"><i class="mdi mdi-plus"></i> Withdraw Now</a>
      @else
      <a href="{{route('v-withdraw.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i>{{__('Withdraw Now')}}</a>
      @endif
    </div>
  </div>
  <h4 class="card-title">{{__('Withdraw')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="withdraw_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Withdraw Date')}}</th>
            <th width="35%">{{__('Method')}}</th>
            <th width="35%">{{__('Amount')}}</th>
            <th width="35%">{{__('Account')}}</th>
            <th width="35%">{{__('Status')}}</th>
          </tr>
         </thead>
        </table>
       </div>
      </div>
    </div>
  </div>
  </div>
</div>
</div>
@endsection
@section('javascript')
       <script>

          var table = $('#withdraw_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('v-withdraws.datatable') }}",
            },
            columns: [
            {
              data: 'withdraw_date',
              name: 'withdraw_date',
             },
            {
              data: 'method',
              name: 'method'
             },
             {
              data: 'amount',
              name: 'amount'
             },
             {
              data: 'account',
              name: 'account'
             },
              {
              data: 'status',
              name: 'status'
             },
            ]
           });
        </script>
@endsection