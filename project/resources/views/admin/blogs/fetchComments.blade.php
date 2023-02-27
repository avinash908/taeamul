@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Post Comments')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="comment_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Comment')}}</th>
            <th width="35%">{{__('Name')}}</th>
            <th width="35%">{{__('Email')}}</th>
            <th width="35%">{{__('Post Title')}}</th>
            <th width="35%">{{__('Status')}}</th>
            <th width="35%">{{__('created_at')}}</th>
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

     var  table = $('#comment_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url: "{{ route('admin.blog.comment.datatable') }}",
      },
      columns: [
       {
        data: 'comment',
        name: 'comment'
       },
       {
        data: 'name',
        name: 'name'
       },
       {
        data: 'email',
        name: 'email'
       },
       {
        data: 'post_title',
        name: 'post_title'
       },
       {
        data: 'status',
        name: 'status'
       },
       {
        data: 'created_at',
        name: 'created_at'
       },
      ]
     });
  </script>
@endsection