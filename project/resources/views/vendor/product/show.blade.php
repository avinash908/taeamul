@extends('layouts.vendor.app')
@section('content')

<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Products Table')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="product_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Slug')}}</th>
            <th width="35%">{{__('Name')}}</th>
            <th width="35%">{{__('Description')}}</th>
            <th width="35%">{{__('Price')}}</th>
            <th width="35%">{{__('Old Price')}}</th>
            <th width="35%">{{__('Quantity')}}</th>
            <th width="35%">{{__('short_description')}}</th>
            <th width="35%">{{__('created_at')}}</th>
          </tr>
         </thead>
        </table>
       </div>
       <script>
          $(document).ready(function(){

           $('#product_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('products.index') }}",
            },
            columns: [
             {
              data: 'slug',
              name: 'slug'
             },
             {
              data: 'name',
              name: 'name'
             },
             {
              data: 'description',
              name: 'description'
             },
             {
              data: 'price',
              name: 'price'
             },
             {
              data: 'old_price',
              name: 'old_price'
             },
             {
              data: 'quantity',
              name: 'quantity'
             },
             {
              data: 'short_description',
              name: 'short_description'
             },
             {
              data: 'created_at',
              name: 'created_at'
             },
            ]
           });
           });
          </script>
      </div>
    </div>
  </div>
  </div>
</div>
</div>


@endsection
@section('ajax')

@endsection