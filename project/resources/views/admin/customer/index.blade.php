@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Customers')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="customer_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Name')}}</th>
            <th width="35%">{{__('Email')}}</th>
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

          var table = $('#customer_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.customers.datatable') }}",
            },
            columns: [
             {
              data: 'name',
              name: 'name'
             },
              {
              data: 'email',
              name: 'email'
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