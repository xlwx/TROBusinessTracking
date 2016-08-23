$(document).ready(function(){

	$("#msform").validate({
		rules:{
			username: {
				
			},
			pass: {
				required: true,
				minlength: 5
			},
			cpass: {
				required: true,
				minlength: 5,
				equalTo: "#pass"
			},
			firstname: {
				required: true,
				maxlength:50,
			},
			lastname: {
				required: true,
				maxlength:50,
			},
			street: {
				required: true,
				maxlength:100
			},
			city : {
				required: true,
				maxlength:20
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
				maxlength:20
			},
			cellphone : {
				required: true,
				phoneUS: true
			},
			homephone: {
				phoneUS: true
			},
			fax : {
				phoneUS: true
			},
			email: {
				required: true,
				email: true,
			}
		},
		messages: {
        	username:{
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
