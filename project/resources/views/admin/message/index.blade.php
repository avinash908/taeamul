@extends('layouts.admin.app')
@section('content')
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="email-wrapper wrapper">
            <div class="row align-items-stretch">
             
              <div class="mail-list-container col-md-4 pt-4 pb-4 border-right bg-white" style="height: 60rem;max-height: 65rem;overflow: scroll">
                <div class="border-bottom pb-4 mb-3 px-3">
                  <div class="form-group">
                    <input class="form-control w-100" type="search" placeholder="Search mail" id="Mail-rearch">
                  </div>
                </div>
                @foreach($msg as $row)
                <div class="mail-list">
                  <div class="form-check"> <label class="form-check-label"> <input type="checkbox" class="form-check-input"> </label></div>
                  <div class="content">
                    <a href="javascript:void(0)" data-url='{{route("admin.msg.ajax",$row->email)}}' data-email='{{$row->email}}' class="text-dark msgUser">
                      <p class="sender-name">{{__($row->name)}}</p>
                      <p class="message_text">{{$row->subject}}</p>
                    </a>
                  </div>
                </div>
                @endforeach
                
              </div>
              <div class="mail-view d-none d-md-block col-md-6 col-lg-8 bg-white">
                <!-- <div class="row">
                  <div class="col-lg-12 mb-4 mt-4">
                    <div class="btn-toolbar">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-attachment text-primary"></i>Attach</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="mdi mdi-delete text-primary"></i>Delete</button>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="message-body">
                  <div class="sender-details">
                    <div class="details">
                      <p class="sender-email" >
                        &nbsp;<i class="mdi mdi-account-multiple-plus"></i>
                        <span id="nameInsert" class="text-capitalize"></span>
                        <span>&nbsp;:&nbsp;</span>
                        <span id="emailInsert"></span>
                      </p>
                    </div>
                  </div>
                  <div class="message-content row" id="msgShow" style="height: 25rem;max-height: 30rem;overflow-y: scroll;">
                   
                   
                  </div>
                  <div class="attachments-sections">
                    <!-- <ul>
                      <li>
                        <div class="thumb"><i class="mdi mdi-file-pdf"></i></div>
                        <div class="details">
                          <p class="file-name">Seminar Reports.pdf</p>
                          <div class="buttons">
                            <p class="file-size">678Kb</p>
                            <a href="#" class="view">View</a>
                            <a href="#" class="download">Download</a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="thumb"><i class="mdi mdi-file-image"></i></div>
                        <div class="details">
                          <p class="file-name">Product Design.jpg</p>
                          <div class="buttons">
                            <p class="file-size">1.96Mb</p>
                            <a href="#" class="view">View</a>
                            <a href="#" class="download">Download</a>
                          </div>
                        </div>
                      </li>
                    </ul> -->
                  </div>
                  <div style="margin:3rem 0px;"><hr></div>
              <div class="reply-section">
                <form action="javascript:void(0)" id="adminMsg" method="post">
                  @csrf
                  <div class="form-group">
                    <label for="subBox">{{__('Subject')}}</label>
                    <input type="text" placeholder="Subject" id="subBox" class="form-control">
                  </div>
                    <input type="hidden" name="email" id="msgEmail" value="">
                  <div class="form-group">
                    <label for="replyBox">{{__('Reply')}}</label>
                    <textarea class="form-control rounded-0" id="replyBox" cols="10" rows="6" placeholder="Write Reply"></textarea>
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-info">{{__('Send')}}</button>
                  </div>
                </form>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{__('Copyright')}} &copy; 2020
               <a href="https://www.urbanui.com/" target="_blank">{{__('Taemul')}}</a>. 
               {{__('All rights reserved.')}}
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">{{__('Hand-crafted & made with')}} <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
      </div>
<script type="text/javascript">
  $(document).ready(function () {
     
      $('#msgEmail').val('');
      $('#adminMsg')[0].reset();


      $(document).on('click','.msgUser',function () {
        var url = $(this).attr('data-url');
        var emaildas = $(this).attr('data-email');
        var rslt  =  $('#msgEmail').val(emaildas);
        
        ajax_get(url);
      
      });
      $(document).on('submit','#adminMsg',function () {
        var form = $(this);
        var url = "{{route('msg.admin')}}";
        $.ajax({
          url:url,
          type:'POST',
          data:{
            '_token':'<?=csrf_token()?>',
            subject:$('#subBox').val(),
            msg:$('#replyBox').val(),
            email:$('#msgEmail').val(),
          },
          success:function (data) {
            success(data.success);
            form[0].reset();
            var nurl = $('#emailSpan').attr('data-url');

            ajax_get(nurl);
          }
        });
      });
      function ajax_get(url) {
          $.ajax({
            url:url,
            type:'get',
            success:function (data) {
              $('#msgShow').empty();
              $('#msgShow').html(data.html);
              $('#nameInsert').empty();
              $('#nameInsert').html(data.userName);
              $('#emailInsert').empty();
              $('#emailInsert').html(data.userEmail);

            },
          });
        }
  });
</script>
@endsection
@section('javascript')

@endsection