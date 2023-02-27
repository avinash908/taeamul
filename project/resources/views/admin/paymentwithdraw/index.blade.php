@extends('layouts.admin.app')
@section('content')

<div class="card">
<div class="card-body">
  <h4 class="card-title">{{__('Withdraw Requests')}}</h4>
  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table id="payment_withdraw_table" class="table table-bordered table-striped">
         <thead>
          <tr>
            <th width="35%">{{__('Email')}}</th>
            <th width="35%">{{__('Phone')}}</th>
            <th width="35%">{{__('Amount')}}</th>
            <th width="35%">{{__('Method')}}</th>
            <th width="35%">{{__('Status')}}</th>
            <th width="35%">{{__('Withdraw Date')}}</th>
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

          var table = $('#payment_withdraw_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
             url: "{{ route('admin.vendor.payment.datatable') }}",
            },
            columns: [
            {
              data: 'email',
              name: 'email'
             },
            {
              data: 'phone',
              name: 'phone'
             },
             {
              data: 'amount',
              name: 'amount'
             },
             {
              data: 'method',
              name: 'method'
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
           $(document).on('click','.t_withdraw_status',function(){

              var url = $(this).attr('data-url');
              var msg = $(this).attr('data-msg');

              swal({
                title: 'Are you sure?',
                text: msg + " Do you want to proceed?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3f51b5',
                cancelButtonColor: '#ff4081',
                confirmButtonText: 'Great ',
                buttons: {
                  cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                  },
                  confirm: {
                    text: "YES",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                  }
                }
              }).then(function(isConfirm) {
                if (isConfirm) {
                  $.ajax({
                    url:url,
                    type:'GET',
                    success:function(data){
                      if(data.msg == 'success'){
                        table.ajax.reload();
                        swal({
                          title: 'Done!',
                          text: data.success,
                          icon: 'success',
                          timer: 3000
                        });
                      }else{
                        if(data.msg == 'danger'){
                          swal({
                            title: 'Alert!',
                            text: data.danger,
                            icon: 'warning',
                          });
                        }else{
                          swal({
                            title: 'Opps!',
                            text: 'Something went wrong!',
                            icon: 'info',
                          });
                        }
                      }
                    }
                  });
                }
              })
            });
        </script>
@endsection