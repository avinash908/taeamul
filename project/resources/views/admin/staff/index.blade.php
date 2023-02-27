@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <div class="row">
      <div class="col-12">
        <a href="{{route('staffs.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> {{__('Add New Member')}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__('Staff')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="staff_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Name')}}</th>
            <th width="35%">{{__('Email')}}</th>
            <th width="35%">{{__('Phone')}}</th>
            <th width="35%">{{__('Role')}}</th>
            <th width="35%">{{__('Created_at')}}</th>
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

          var table = $('#staff_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.staff.datatable') }}",
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
              data: 'phone',
              name: 'phone'
             },
             {
              data: 'role',
              name: 'role'
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