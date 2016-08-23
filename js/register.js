//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(document).ready(function(){
	$("#msform").validate({
		rules:{
			username: {
				required: true,
				maxlength:100,
            	remote: {
        			url: "includes/ajax/register-checkname.php",
        			type: "post",
        			data: {
          				username: function() {
            				return $( "#username" ).val();
          				}
        			}  
      			}
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
	jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
		phone_number = phone_number.replace(/\s+/g, "");
		return this.optional(element) || phone_number.length > 9 &&
			phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
	}, "Please specify a valid phone number");
});


$('.next').click(function(){
	var form = $('#msform');
	if (form.valid() == true){
		if(animating) return false;
		animating = true;
		
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();
		
		//activate next step on progressbar using the index of next_fs
		$('#progressbar li').eq($('fieldset').index(next_fs)).addClass('active');
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now, mx) {
				//as the opacity of current_fs reduces to 0 - stored in 'now'
				//1. scale current_fs down to 80%
				scale = 1 - (1 - now) * 0.2;
				//2. bring next_fs from the right(50%)
				left = (now * 50)+'%';
				//3. increase opacity of next_fs to 1 as it moves in
				opacity = 1 - now;
				current_fs.css({'transform': 'scale('+scale+')'});
				next_fs.css({'left': left, 'opacity': opacity});
			}, 
			duration: 800, 
			complete: function(){
				current_fs.hide();
				animating = false;
			}, 
			//this comes from the custom easing plugin
			easing: 'easeInOutBack'
		});
	}
});

$('.previous').click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$('#progressbar li').eq($('fieldset').index(current_fs)).removeClass('active');
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in 'now'
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+'%';
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

//$('.submit').click(function(){
//	$('#msform').submit();
//});