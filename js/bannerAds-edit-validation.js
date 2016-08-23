$(document).ready(function(){

	$("#bannerAds").validate({
		rules:{
			name: {
				required: true,
				maxlength:50,
				remote: {
					url: "includes/ajax/bannerAds-checkname.php",
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
			value: {
				required: true,
				min: 0,
				number: true
			},
			customPeriod : {
				required: true,
				min: 0,
				number: true
			},
			availableUnits: {
				required: true,
				min: 0,
				number: true
			}
		},
		messages: {
        	name:{
				remote: "Name already in use!"
			},
			value:{
				number: "Not a valid number."
			},
			customPeriod:{
				number: "Not a valid number."
			},
			availableUnits:{
				number: "Not a valid number."
			}
		}
	});
});
