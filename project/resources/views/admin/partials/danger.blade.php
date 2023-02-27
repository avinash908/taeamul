@if(session()->has('danger'))
  <script type="text/javascript">
    window.onload = error('{{__(session("danger"))}}');
  </script>
@endif