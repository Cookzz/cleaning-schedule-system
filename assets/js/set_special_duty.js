function insert_cleaner_dropdown(i)
{
	$( "#cleaners_area" ).prepend("<tr><td>Cleaner :</td>"+
								"<td><input id='cleaner_"+i+"' type='text' list='cleaners'>");
	
	$("#addCleaner").click(function(){
		i++;
		$( "#cleaners_area" ).append("<tr><td>Cleaner :</td>"+
								"<td><input id='cleaner_"+i+"' type='text' list='cleaners'>");
		
	});
	
	$("#addSpecialDuty").click(function(){
		if(confirm("Do you confrim to add the new special duty?"))
		{
			var cleaners = [];
			for(var ii=1 ; ii<=i;ii++)
			{
				cleaners.push($("#cleaner_"+ii).val());
			}
			postSpecialDutyData(cleaners);
		}
		
	});
}

function postSpecialDutyData(cleaners)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"specialDutyController/setSpecialDuty";

	var fd = new FormData();
	fd.append('cleaners',cleaners);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == false)
			{
				alert("Insert Uncompleted,Invalid or Duplicate Stuff");
			}
			else
			{
				alert("Insert Success");
				insert_back_table(message);
				$("#newStuffField").val("");
			}
		}
	});	
}

$(document).ready(function(){
	
	var i = 1;
	
	$("form").submit(function(event){
		event.preventDefault();
	});
	
	insert_cleaner_dropdown(i);
	
/**	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the stuff?"))
		{
			var txt = $(this).attr("id");
			var stuff_id = txt.match(/\d/g);
			stuff_id = stuff_id.join("");
			update_stuff(stuff_id);
		}
		
	});**/
});













