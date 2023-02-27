@extends('layouts.admin.app')
@section('content')
<style type="text/css">
  .t_content_boxd {
    border: 1px solid #d6d6d6;
    box-shadow: 0 0 1px 1px #0000001f;
    border-radius: 10px;
    padding: 20px;
}
</style>
<div class="container">
  <div class="bg-white p-5 col-xl-12 col-lg-12 col-md-12 col-sm-12 shadow-lg">
    <h1 class="pb-4">{{__('Staff Member Profile')}}</h1>
    <div class="row">
    	<div class="col-md-3">
        <div class="t_content_boxd">
      		<div class=" p-2">
      			<img src="{{asset($user->avatar)}}" class="img-thumnbnail rounded-circle" style="width: 100%">
      		</div>
        </div>
    	</div>
    	<div class="col-md-9">
        <div class="t_content_boxd">  
      		<table class="table">
      			<tr>
      				<td>{{__('Name')}}</td>
      				<td>{{__($user->name)}}</td>
      			</tr>
      			<tr>
      				<td>{{__('Email')}}</td>
      				<td>{{$user->email}}</td>
      			</tr>
      			<tr>
      				<td>{{__('Phone')}}</td>
      				<td>{{$user->phone}}</td>
      			</tr>
            <tr>
              <td>{{__('Role')}}</td>
              <td>
                @foreach ($user->getRoleNames() as $rn)
                   {{__(ucfirst($rn))}}
                @endforeach
              </td>
            </tr>
      		</table>
        </div>
    	</div>
    </div>
  </div>
</div>
@endsection