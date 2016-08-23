$(document).ready(function(){

	$("#troCruiseNews").validate({
		rules:{
			name: {
				required: true,
				maxlength:50,
			},
			supplierName: {
				required: true
			},
			bannerType : {
				required: true
			},
			startDate: {
				required: true
			},
			endDate: {
				required: true
			}
		},
		messages: {
        	
		}
	});
});
