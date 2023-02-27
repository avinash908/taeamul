@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
   <div class="row">
      <div class="col-12">
        <a href="{{route('subscriber.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> {{__('Add New Subscriber')}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__('All Subscribers')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="comment_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Email')}}</th>
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

     var  table = $('#comment_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url: "{{ route('subscriber.datatable') }}",
      },
      columns: [
       {
        data: 'email',
        name: 'email'
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