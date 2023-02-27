@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Deactive Products')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="product_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Name')}}</th>
            <th width="35%">{{__('Sku')}}</th>
            <th width="35%">{{__('Price')}}</th>
            <th width="35%">{{__('Old Price')}}</th>
            <th width="35%">{{__('Stock')}}</th>
            <th width="35%">{{__('Status')}}</th>
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
<div class="modal" id="product_highlight_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content" style="cursor: pointer;">
      <div class="modal-header">
        <h3 class="modal-heading">{{__('PRODUCT HIGHLIGHT')}}</h3>
      </div>
      <div id="hightlight_data">

      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">{{__('Close')}}</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
       <script>
           var table = $('#product_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.products.deactivedatatables') }}",
            },
            columns: [
             {
              data: 'name',
              name: 'name'
             },
              {
              data: 'sku',
              name: 'sku'
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
              data: 'stock',
              name: 'stock'
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
        <script type="text/javascript">
        $(document).ready(function ($) {
           $(document).on('click','.switch',function(){  
               $(this).toggleClass("switchOn");
          });
          $(document).on('click','.t_highlight',function(){
            var url = $(this).attr('data-url');
            $.ajax({
              url:url,
              type:'GET',
              success:function(data){
                $("#hightlight_data").html(data.html);
                $("#product_highlight_modal").modal("show");
              }
            })
          });
          $(document).on('submit','#highlightform',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            $.ajax({
              url:url,
              type:'POST',
              data:{
                is_featured     : $('#is_featured:checked').val(),
                is_bestSeller   : $('#is_bestSeller:checked').val(),
                is_topRated     : $('#is_topRated:checked').val(),
                is_bestDeals    : $('#is_bestDeals:checked').val(),
                is_hot          : $('#is_hot:checked').val(),
                is_new          : $('#is_new:checked').val(),
                is_trending     : $('#is_trending:checked').val(),
                is_sale         : $('#is_sale:checked').val(),
                '_token'        : $('#Newtoken').val(),
              },
              success:function(data){
                $("#product_highlight_modal").modal("hide");
                table.ajax.reload();
                success(data.success);
              }
            })
          })
        });
        </script>
@endsection