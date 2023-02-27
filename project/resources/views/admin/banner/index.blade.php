@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <div class="row">
      <div class="col-12">
        <a href="{{route('banners.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i>{{__(' Add New Banner')}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__('Banners')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="banner_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Title')}}</th>
            <th width="35%">{{__('Offer')}}</th>
            <th width="35%">{{__('Image')}}</th>
            <th width="35%">{{__('Position')}}</th>
            <th width="35%">{{__('Link')}}</th>
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
          var table = $('#banner_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.banner.datatable') }}",
            },
            columns: [
              {
              data: 'title',
              name: 'title'
             },
             {
              data: 'offer',
              name: 'offer'
             },
             {
              data: 'image',
              name: 'image'
             },
             {
              data: 'position',
              name: 'position'
             },
             {
              data: 'link',
              name: 'link'
             },

             {
              data: 'action',
              name: 'action'
             },
            ]
           });
        </script>
@endsection