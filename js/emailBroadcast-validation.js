$(document).ready(function(){

	$("#emailBroadcast").validate({
		rules:{
			campaignName: {
				required: true,
				maxlength:50
          
			},
			supplierName: {
				required: true
			},
			broadcastType : {
				required: true
			},
			serverAccount: {
				required: true		
			},
			broadcastDate: {
				required: true
			}
		},
		messages: {
        	
		}
	});
});
