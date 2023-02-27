<script type="text/javascript">
jQuery(document).ready(function () {

       var url = '{{url("$data[url]")}}';
        function dataFetch() {
            jQuery.ajax( {
               url: url,
               method:'POST',
               data: { _token:jQuery('#_token').attr('content') },
               beforeSend: function(){
                jQuery('#load_img').show();
                },
               success:function (data) {
                 jQuery('#load_img').hide();
                 jQuery('#async-data').empty()
                 jQuery('#async-data').html(data.html)
               }
            });
        }
        dataFetch();
});
        
</script>