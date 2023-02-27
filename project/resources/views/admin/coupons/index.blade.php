@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
   <div class="row">
      <div class="col-12">
        <a href="{{route('coupon.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> {{__("Add New Coupon")}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__("Coupons")}} </h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="coupon_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__("Code")}}</th>
            <th width="35%">{{__("Price")}}</th>
            <th width="35%">{{__("Times")}}</th>
            <th width="35%">{{__("Used")}}</th>
            <th width="35%">{{__("Status")}}</th>
            <th width="35%">{{__("End Date")}}</th>
            <th width="35%">{{__("Created_at")}}</th>
            <th width="35%">{{__("Action")}}</th>
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

     var  table = $('#coupon_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url: "{{ route('admin.coupon.datatable') }}",
      },
      columns: [
       {
        data: 'code',
        name: 'code'
       },
       {
        data: 'price',
        name: 'price'
       },
       {
        data: 'times',
        name: 'times'
       },
       {
        data: 'used',
        name: 'used'
       },
       {
        data: 'status',
        name: 'status'
       },
       {
        data: 'end_date',
        name: 'end_date'
       },
       {
        data: 'created_at',
        name: 'created_at'
       },
       {
        data: 'action',
        name: 'action'
       },
      ]
     });
  </script>
@endsection