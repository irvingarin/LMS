$(document).ready(function(){
	$("body").on("click","a, input[type=submit]", function(e){
		var activity = $(this).attr("data-activity");
		var page_source = window.location.href;
		
		
		/*var getall = chrome.windows.getAll({
				populate:'true',
				windowsType:["normal"]
			});

		*/
		if(activity!="null"||activity!=undefined){
			jQuery.ajax({
				url:'lms_activity_ajax.php',
				type:'post',
				dataType:'text',
				data:'ac=true&act='+activity+'&pg='+page_source,
				success:function(f){
					//alert(f);
				}
		    });
		}
		

	});
});