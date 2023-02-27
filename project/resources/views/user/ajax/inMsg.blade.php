@foreach($data as $row)

@if($row->message_from == 'admin')
<div class="msgfrom col-lg-9" style="margin:10px 10px;background-color: #eee;padding: 10px; border-radius:10px;">
<span style="font-size: 1rem"><span style="font-weight: bold">Subject&nbsp;:&nbsp;</span>{{__($row->subject)}}</span>

<p><span style="font-weight: bold">Message&nbsp;:&nbsp;</span>{{__($row->message)}}</p>
</div>
@endif
@if($row->message_from == 'customer')
   
 <div class="msgto col-lg-10 " style="margin:10px 10px;float:right;background-color: #fed700;padding: 10px; border-radius:10px;margin-left: 0px 20px">
  <span style="font-size: 1rem"><span style="font-weight: bold">Subject&nbsp;:&nbsp;</span>{{__($row->subject)}}</span>

  <p><span style="font-weight: bold">Message&nbsp;:&nbsp;</span>{{__($row->message)}}</p>
</div>
@endif
@endforeach