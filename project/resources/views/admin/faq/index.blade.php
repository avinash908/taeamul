@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <div class="row">
      <div class="col-12">
        <a href="{{route('faqs.create')}}" class="btn btn-primary float-right"><i class="mdi mdi-plus"></i> {{__('Add New Faq')}}</a>
      </div>
    </div>
  <h4 class="card-title">{{__('FAQ')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="faq_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Faq Title')}}</th>
            <th width="35%">{{__('Faq Detail')}}</th>
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

          var table = $('#faq_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.faq.datatable') }}",
            },
            columns: [
              {
              data: 'title',
              name: 'title'
             },
             {
              data: 'detail',
              name: 'detail'
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