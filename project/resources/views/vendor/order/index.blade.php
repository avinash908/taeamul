@extends('layouts.vendor.app')
@section('content')

<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Orders')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="order_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Customer Email')}}</th>
            <th width="35%">{{__('Order Number')}}</th>
            <th width="35%">{{__('Total Quantity')}}</th>
            <th width="35%">{{__('Total Amount')}}</th>
            <th width="35%">{{__('Order Status')}}</th>
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
<div class="modal" id="order_status_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content" style="cursor: pointer;">
      <div class="modal-header">
        <h3 class="modal-heading">{{__('DELIVERY STATUS')}}</h3>
      </div>
      <div id="status_data" style="padding: 20px;">

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

          var table = $('#order_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('v-order.datatable') }}",
            },
            columns: [
            {
              data: 'customer_email',
              name: 'customer_email'
             },
            {
              data: 'order_number',
              name: 'order_number'
             },
             {
              data: 'total_qty',
              name: 'total_qty'
             },
             {
              data: 'total_amount',
              name: 'total_amount'
             },
             {
              data: 'order_status',
              name: 'order_status'
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

          $(document).on('click','.t_status',function(){
            var url = $(this).attr('data-url');
            $.ajax({
              url:url,
              type:'GET',
              success:function(data){
                $("#status_data").html(data.html);
                $("#order_status_modal").modal("show");
              }
            })
          });
          $(document).on('submit','#orderstatusform',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            $.ajax({
              url:url,
              type:'POST',
              data:{
                order_status     : $('#order_status').val(),
                payment_status   : $('#payment_status').val(),
                '_token'        : $('#Newtoken').val(),
              },
              success:function(data){
                $("#order_status_modal").modal("hide");
                table.ajax.reload();
                success(data.success);
              }
            })
          })
        });
        </script>
@endsection