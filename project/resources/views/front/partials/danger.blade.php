
@if(session()->has('danger'))
<script type="text/javascript">
	
  	window.load = toastr.error('{{__(session("danger"))}}', 'Danger');
</script>
@endif