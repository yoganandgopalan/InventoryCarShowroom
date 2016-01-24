$(document).ready(function() 
{
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID

	var x = 1; //initlal text box count
	$(add_button).click(function(e)
	{ //on add input button click
		e.preventDefault();
		if(x < max_fields)
		{ //max input box allowed
			x++; //text box increment
			var append_content = '<div><label for="spares_id" class="awesome">Select Spar</label><select id="spares_id_'+x+'" name="spares_id[]"></select><label for="quantity">Qty:</label><input class="" name="quantity[]" type="text"><a href="#" class="remove_field">Remove</a></div>';
			$(wrapper).append(append_content); //add input box
			$select = $('#spares_id_'+x);
			$select.html('');
			//iterate over the data and append a select option
			$.each(spares, function(key, val)
			{
				$select.append('<option value="' + key + '">' + val + '</option>');
			})
		}
	});

	$(wrapper).on("click",".remove_field", function(e)
	{ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
