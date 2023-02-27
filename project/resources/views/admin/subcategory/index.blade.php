@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
    <div class="row">
      <div class="col-12">
        <a href="{{route('subcategories.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> {{__('Add New Sub Category')}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__('Sub Categories')}}</h4>

  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="subcat_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Category')}}</th>
            <th width="35%">{{__('Name')}}</th>
            <th width="35%">{{__('Slug')}}</th>
            <th width="35%">{{__('Attributes')}}</th>
            <th width="35%">{{__('Status')}}</th>
            <th width="35%">{{__('created_at')}}</th>
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

     var  table = $('#subcat_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url: "{{ route('admin.subcategories.datatable') }}",
      },
      columns: [
       {
        data: 'category',
        name: 'category'
       },
       {
        data: 'name',
        name: 'name'
       },
       {
        data: 'slug',
        name: 'slug'
       },
       {
        data: 'attributes',
        name: 'attributes'
       },
       {
        data: 'status',
        name: 'status'
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