@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Seo')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="seo_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Title')}}</th>
            <th width="35%">{{__('Slug')}}</th>
            <th width="35%">{{__('Action')}}</th>
            <th width="35%">{{__('Created at')}}</th>
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
          var table = $('#seo_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.seo.datatable') }}",
            },
            columns: [
              {
              data: 'title',
              name: 'title'
             },
             {
              data: 'url',
              name: 'url'
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