jQuery(document).ready(function(){
	
	jQuery('#price-range-submit').hide();

	jQuery("#min_price,#max_price").on('change', function () {

	  jQuery('#price-range-submit').show();

	  var min_price_range = parseInt(jQuery("#min_price").val());

	  var max_price_range = parseInt(jQuery("#max_price").val());

	  if (min_price_range > max_price_range) {
		jQuery('#max_price').val(min_price_range);
	  }

	  jQuery("#slider-range").slider({
		values: [min_price_range, max_price_range]
	  });
	  
	});


	jQuery("#min_price,#max_price").on("paste keyup", function () {                                        

	  jQuery('#price-range-submit').show();

	  var min_price_range = parseInt(jQuery("#min_price").val());

	  var max_price_range = parseInt(jQuery("#max_price").val());
	  
	  if(min_price_range == max_price_range){

			max_price_range = min_price_range + 100;
			
			jQuery("#min_price").val(min_price_range);		
			jQuery("#max_price").val(max_price_range);
	  }

	  jQuery("#slider-range").slider({
		values: [min_price_range, max_price_range]
	  });

	});


	jQuery(function () {

	  jQuery("#slider-range").slider({
		range: true,
		orientation: "horizontal",
		min: 0,
		max: 100000,
		values: [0, 100000],
		step: 100,

		slide: function (event, ui) {
		  if (ui.values[0] == ui.values[1]) {
			  return false;
		  }
		  
		jQuery("#min_price").val(ui.values[0]);
		jQuery("#max_price").val(ui.values[1]);

		jQuery(".price-from").html(ui.values[0]);
       	jQuery(".price-to").html(ui.values[1]);

       	// jQuery("#min_price").attr('name','min_price');
       	// jQuery("#max_price").attr('name','max_price');

		}
	  });

	  jQuery("#min_price").val(jQuery("#slider-range").slider("values", 0));
	  jQuery("#max_price").val(jQuery("#slider-range").slider("values", 1));

	});

	jQuery("#slider-range,#price-range-submit").click(function () {

	  var min_price = jQuery('#min_price').val();
	  var max_price = jQuery('#max_price').val();

	  jQuery("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
	});

});