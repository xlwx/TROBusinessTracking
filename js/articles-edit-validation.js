$(document).ready(function(){

	$("#articles").validate({
		rules:{
			name: {
				required: true,
				maxlength:50,
            	remote: {
					url: "includes/ajax/articles-checkname.php",
					type: "post",
					data: {
						username: function() {
							if($( "#originalName" ).val() != $( "#name" ).val()){
                            	return $( "#name" ).val();
                            }else{
                            	return "----";
                            }
						}

					}
      			}

			},
			units: {
				required: true,
				number: true
			},
			value : {
				required: true,
				number: true
			}
		},
		messages: {
			name:{
				remote: "Name already in use!"
			},
			units:{
				number: "Not a number."
			},
			value:{
				number: "Not a number."
			}
		}
	});
});
