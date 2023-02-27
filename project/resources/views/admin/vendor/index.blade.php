@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Vendors')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="vendor_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Shop Name')}}</th>
            <th width="35%">{{__('Vendor Emai')}}l</th>
            <th width="35%">{{__('Shop Number')}}</th>
            <th width="35%">{{__('Status')}}</th>
            <th width="35%">{{__('Action')}}</th>
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

           var table = $('#vendor_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.vendors.datatable') }}",
            },
            columns: [
             {
              data: 'shop_name',
              name: 'shop_name'
             },
             {
              data: 'email',
              name: 'email'
             },
             {
              data: 'shop_number',
              name: 'shop_number'
             },
              {
              data: 'user_status',
              name: 'user_status'
             },
            {
              data: 'action',
              name: 'action'
             },
            ]
           });
        </script>
@endsection