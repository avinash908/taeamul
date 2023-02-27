@if(session()->has('success'))
  <script type="text/javascript">
    window.onload = success('{{__(session("success"))}}');
  </script>
@endif