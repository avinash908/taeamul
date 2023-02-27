@if(session()->has('success'))
<script type="text/javascript">
	
  	window.load = toastr.success('{{__(session("success"))}}', 'Success');
</script>
    
@endif