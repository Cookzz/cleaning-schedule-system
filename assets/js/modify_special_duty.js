function insert_cleaner_dropdown(numberOfCleaner)
{
	
	numberOfCleaner++;
	$( "#new_cleaners_area" ).append("<tr><td>"+numberOfCleaner+"</td>"+
								"<td><input id='cleaner_"+numberOfCleaner+"' type='text' list='cleaners'></td>");	

	
	
	
	$("#addCleaner").click(function(){
		numberOfCleaner++;
		$( "#new_cleaners_area" ).append("<tr><td>"+numberOfCleaner+"</td>"+
								"<td><input id='cleaner_"+numberOfCleaner+"' type='text' list='cleaners'>");
		
	});
	
	$('form').submit(function(event){
		event.preventDefault();
		var txt = $(this).attr("id");
		console.log(txt);
		var special_duty_id = txt.match(/\d/g);
		console.log(special_duty_id);
		special_duty_id = special_duty_id.join("");
		console.log(special_duty_id);
		validateDate(special_duty_id,cleaners,numberOfCleaner);		
	});
}

function validateDate(special_duty_id,cleaners,numberOfCleaner)
{
	var TodayDate = new Date();
	var special_duty_date = new Date(Date.parse($("#special_duty_date").val()));
	
	if(!($("#special_duty_dutyDetail").val().trim().match(/^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/)))
	{
		$("#special_duty_dutyTitle_error").hide();
		$("#special_duty_date_error").hide();
		$("#special_duty_dutyDetail_error").show();
		$("#special_duty_dutyDetail_error").text("Invalid Location");
	}
	else if (special_duty_date < TodayDate) 
	{
		$("#special_duty_dutyDetail_error").hide();
		$("#special_duty_dutyTitle_error").hide();
		$("#special_duty_date_error").show();
		$("#special_duty_date_error").text("You cannot assign the special duty to previous day");
	}
	else
	{
		$("#special_duty_date_error").hide();
		$("#special_duty_dutyTitle_error").hide();
		$("#special_duty_dutyDetail_error").hide();
		if(confirm("Do you confrim to add the new special duty?"))
		{
			var allCleaners = $("#cleaners_string").val();
			var cleanersObject = JSON.parse(allCleaners);
			var invalidCleaner = false;
			
			for(var ii=1 ; ii<=numberOfCleaner ;ii++)
			{
				for(var iii=0 ; iii < cleanersObject.length;iii++)
				{
					if(($("#cleaner_"+ii).val() == (cleanersObject[iii]["user_id"]+"_"+cleanersObject[iii]["user_name"])) || ($("#cleaner_"+ii).val().length == 0))
					{
						invalidCleaner = false;
						break;	
					}
					else
					{
						invalidCleaner = true;
					}
				}	
				if(invalidCleaner == true)
				{
					break;
				}
			}
				
			if(invalidCleaner == true)
			{
				alert("Invalid cleaner is appear");
			}
			else
			{
				var cleaners = [];
				for(var ii=1 ; ii<=numberOfCleaner ;ii++)
				{
					if($("#cleaner_"+ii).val().length > 0)
					{
						cleaners.push($("#cleaner_"+ii).val());
					}		
							
				}

				postSpecialDutyData(special_duty_id,cleaners);

			}
			
		}
	}
	
}

function postSpecialDutyData(special_duty_id,cleaners)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"specialDutyController/modifySpecialDuty";
	
	var special_duty_dutyDetail = $("#special_duty_dutyDetail").val().trim();
	var special_duty_date = $("#special_duty_date").val();
	var special_duty_time = $("#special_duty_time").val();
	
	var SpecialDutyObject = {
			"special_duty_id":special_duty_id,
			"special_duty_dutyDetail":special_duty_dutyDetail,
			"special_duty_date":special_duty_date,
			"special_duty_time":special_duty_time,
			"cleaners":cleaners,
			};
			
	var SpecialDutyString = JSON.stringify(SpecialDutyObject);
	
	var fd = new FormData();
	fd.append('SpecialDutyString',SpecialDutyString);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == true)
			{
				alert("Success to update special duty");
				location.reload();
			}
		}
	});	
}

function insert_back_table(message)
{
	var special_duty_cleaners = JSON.parse(message);
	$("#original_cleaners_area").empty();
	console.log("sss");
				
	var i =1;
	special_duty_cleaners.forEach(function(special_duty_cleaners){
		console.log("sss");
		$("#original_cleaners_area").append("<tr><td>"+i+"</td>"+
		"<td><input value='" +special_duty_cleaners["special_duty_cleaner"]+"' list='cleaners'></td>"+
		"<td><button type='button' id='"+special_duty_cleaners["special_duty_cleaner_id"]+"_delete' class='delete'>Delete</button></td>/tr>");
		i++;
	});
}

function delete_cleaner(special_duty_cleaner_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"specialDutyController/deleteCleaner";		
	var fd = new FormData();
	fd.append('special_duty_cleaner_id',special_duty_cleaner_id);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message)
		{
			alert("Delete Success");
			insert_back_table(message);
		}	
	});	
}

$(document).ready(function(){
	
	var numberOfCleaner = 0;
	$("#special_duty_dutyTitle_error").hide();
	$("#special_duty_dutyDetail_error").hide();
	$("#special_duty_date_error").hide();
	
	$("modifySpecialDutyForm").submit(function(event){
		event.preventDefault();
	});
	
	insert_cleaner_dropdown(numberOfCleaner);
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the cleaner?"))
		{
			var txt = $(this).attr("id");
			var special_duty_cleaner_id = txt.match(/\d/g);
			special_duty_cleaner_id = special_duty_cleaner_id.join("");
			delete_cleaner(special_duty_cleaner_id);
		}
		
	});
});













