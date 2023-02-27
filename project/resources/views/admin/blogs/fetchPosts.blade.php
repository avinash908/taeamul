@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Posts')}} </h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="post_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Title')}}</th>
            <th width="35%">{{__('Slug')}}</th>
            <th width="35%">{{__('Status')}}</th>
            <th width="35%">{{__('Category Name')}}</th>
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

     var  table = $('#post_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url: "{{ route('admin.blog.post.datatable') }}",
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
        data: 'status',
        name: 'status'
       },
       {
        data: 'category_name',
        name: 'category_name'
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