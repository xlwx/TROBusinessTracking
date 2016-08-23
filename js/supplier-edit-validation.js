$(document).ready(function(){
	jQuery.validator.addClassRules('cpname', {
        required: true,
		maxlength:50
    });
	jQuery.validator.addClassRules('cpemail', {
        required: true,
		email: true
    });
	jQuery.validator.addClassRules('cpphone', {
        required: true,
		phoneUS: true
    });
	jQuery.validator.addClassRules('cpfax', {
        maxlength:20
    });

	$("#formID").validate({
		rules:{
			name: {
				required: true,
				maxlength:50,
            	remote: {
					url: "includes/ajax/supplier-checkname.php",
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
			street: {
				required: true,
				maxlength:200
			},
			city : {
				required: true,
				maxlength:50
			},
			zip : {
				required: true,
				maxlength:10
			},
			state : {
				required: true,
				maxlength:20
			},
			country : {
				required: true,
				maxlength:50
			},
			phone : {
				required: true,
				phoneUS: true
			},
			fax : {
				phoneUS: true
			},
			email: {
				required: true,
				email: true,
			},
			website: {
				required: true,
				url: true,
				maxlength:200
			},
			facebook: {
				url: true,
				maxlength:200
			},
			twitter: {
				url: true,
				maxlength:200
			},
			linkedin: {
				url: true,
				maxlength:200
			},
			youtube: {
				url: true,
				maxlength:200
			},
			pinterest: {
				url: true,
				maxlength:200
			}
		},
		messages: {
        	name:{
				remote: "Name already in use!"
			},
			eamil:{
				required: 'Please enter an email address.',
				email: 'Please enter a <em>valid</em> email addess.'
			}
		}
	});
});
jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
	return this.optional(element) || phone_number.length > 9 &&
		phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");
