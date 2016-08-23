$(document).ready(function(){
	$("#account").validate({
		rules:{
			username: {
				required: true,
				maxlength:100,
            	remote: {
        			url: "includes/ajax/register-checkname.php",
        			type: "post",
        			data: {
          				username: function() {
							if($( "#originalName" ).val() != $( "#username" ).val()){
                            	return $( "#username" ).val();
                            }else{
                            	return "----";
                            }								
						}
        			}  
      			}
			},
			password: {
				required: true,
				minlength: 5
			},
			cpassword: {
				required: true,
				minlength: 5,
				equalTo: "#pass"
			}
		},
		messages: {
        	username:{
				remote: "Name already in use!"
			}
		}
	});
	
});