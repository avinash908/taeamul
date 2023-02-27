@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <div class="row">
      <div class="col-12">
        <a href="{{route('roles.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> {{__('Add New Role')}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__('Roles')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="role_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Role')}}</th>
            <th width="35%">{{__('Permissions')}}</th>
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

          var table = $('#role_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.role.datatable') }}",
            },
            columns: [
              {
              data: 'name',
              name: 'name'
             },
             {
              data: 'permissions',
              name: 'permissions'
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