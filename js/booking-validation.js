$(document).ready(function(){

	$("#booking").validate({
		rules:{
			campaignName: {
				required: true,
				maxlength:50
          
			},
			supplierName: {
				required: true
			},
			salesMember : {
				required: true
			},
			inventoryName: {
				required: true		
			},
        	size: {
            	required: true
            },
        	AdId: {
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
