@extends('layouts.admin.app')
@section('content')
<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Reviews')}} </h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="rev_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Review')}}</th>
            <th width="35%">{{__('Product')}}</th>
            <th width="35%">{{__('By User')}}</th>
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
<div class="modal fade" id="modalEditRev" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-2">{{__('Update Review')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="dataRev">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">{{__('Cancel')}}</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
   <script>

     var  table = $('#rev_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url: "{{ route('admin.review.datatable') }}",
      },
      columns: [
       {
        data: 'review',
        name: 'review'
       },
       {
        data: 'product',
        name: 'product'
       },
       {
        data: 'user',
        name: 'user'
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
    $(document).on('click','.editRev',function () {
      var url = $(this).attr('data-url');
      $.ajax({
        url:url,
        type:'GET',
        success:function (data) {
          $('#dataRev').html(data.html);
          $('#modalEditRev').modal('show');
        },
      });
    })
    $(document).on('submit','#formSubmitReev',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            $.ajax({
              url:url,
              type:'POST',
              data:{
                revText         : $('#textareaRev').val(),
                '_token'        : $('#Newtoken').val(),
              },
              success:function(data){
                $("#modalEditRev").modal("hide");
                table.ajax.reload();
                success(data.success);
              }
            })
          })
  </script>
@endsection