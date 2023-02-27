@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <div class="row">
      <div class="col-12">
        <a href="{{route('pages.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> {{__('Add New Page')}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__('Pages')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="page_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Page Title')}}</th>
            <th width="35%">{{__('Page Slug (url)')}}</th>
            <th width="35%">{{__('Created')}} at</th>
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

          var table = $('#page_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.page.datatable') }}",
            },
            columns: [
              {
              data: 'title',
              name: 'title'
             },
             {
              data: 'slug',
              name: 'slug'
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