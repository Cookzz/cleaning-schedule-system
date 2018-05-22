function post_rating(mark)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"ratingController/ratingMark";
	var stuff = $("#stuff").val();
	var fd = new FormData();
	fd.append('stuff',stuff);
	fd.append('mark',mark);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){

		}
	});	
}

function post_staff_id()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"ratingController/check_staff_id";
	var staff_id = $("#staff_id").val();
	var fd = new FormData();
	fd.append('staff_id',staff_id);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == true)
			{
				if($('#stuff').prop('disabled'))
				{
					$("#stuff").prop("disabled",false);
				}
				else
				{
					$("#stuff").prop("disabled",true);
				}
				
				$("#staff_id").val("");
			}
		}
	});	
}

$(document).ready(function(){
	
	$("#rating").submit(function(event){
		event.preventDefault();
	
	});
	
	$("#bad").click(function(){
		var mark = -2;
		post_rating(mark);
		
	});
	
	$("#normal").click(function(){
		var mark = 1;
		post_rating(mark);
		
	});
	
	$("#good").click(function(){
		var mark = 2;
		post_rating(mark);
		
	});
	
	$("#fixStuff").click(function(){
		post_staff_id();
		
	});
});













