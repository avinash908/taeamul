@foreach($fetch as $msg)
@if($msg->message_from != 'admin')
<div class="col-lg-7 mb-5" style="background-color: #eee!important;opacity: 0.9;padding: 30px;border-radius: 10px">
     <p><span style="font-weight: bold">{{__('Subject')}} :</span> {{$msg->subject}}</p>
     <p><span style="font-weight: bold">{{__('Message')}} :</span> {{$msg->message}}</p>
</div>
@endif
@if($msg->message_from == 'admin')
<div style="background-color: #eee!important;padding: 30px;border-radius: 10px" class="col-lg-7 offset-5 mt-5 mb-5">
     <p><span style="font-weight: bold">{{__('Subject')}} :</span> {{$msg->subject}}</p>
     <p><span style="font-weight: bold">{{__('Message')}} :</span> {{$msg->message}}</p>
</div>
@endif
@endforeach
<span data-url="{{route('admin.msg.ajax',$user->email)}}" id="emailSpan"></span>