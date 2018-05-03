function insert_cleaner_dropdown(numberOfCleaner)
{
	$( "#cleaners_area" ).prepend("<tr><td>"+numberOfCleaner+"</td>"+
								"<td><input id='cleaner_"+numberOfCleaner+"' type='text' list='cleaners'>");
	
	$("#addCleaner").click(function(){
		numberOfCleaner++;
		$( "#cleaners_area" ).append("<tr><td>"+numberOfCleaner+"</td>"+
								"<td><input id='cleaner_"+numberOfCleaner+"' type='text' list='cleaners'>");
		
	});
	
	$("#newSpecialDutyForm").submit(function(event){
		event.preventDefault();
		validateDate(cleaners,numberOfCleaner);		
	});
}

function validateDate(cleaners,numberOfCleaner)
{
	var TodayDate = new Date();
	var special_duty_date = new Date(Date.parse($("#special_duty_date").val()));
	
	if(!($("#special_duty_dutyDetail").val().trim().match(/^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/)))
	{
		$("#special_duty_dutyDetail_error").show();
		$("#special_duty_dutyDetail_error").text("Invalid Location");
	}
	else if (special_duty_date < TodayDate) 
	{
		$("#special_duty_dutyDetail_error").hide();
		$("#special_duty_date_error").show();
		$("#special_duty_date_error").text("You cannot assign the special to previous day");
	}
	else
	{
		$("#special_duty_date_error").hide();
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
				if(cleaners.length > 0)
				{
					postSpecialDutyData(cleaners);
				}
				else
				{
					alert("Please assign at least one cleaner for this special duty");
				}
			}
			
		}
	}
	
}

function postSpecialDutyData(cleaners)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"specialDutyController/setSpecialDuty";
	
	var special_duty_dutyDetail = $("#special_duty_dutyDetail").val().trim();
	var special_duty_date = $("#special_duty_date").val();
	var special_duty_time = $("#special_duty_time").val();
	
	var newSpecialDutyObject = {
			"special_duty_dutyDetail":special_duty_dutyDetail,
			"special_duty_date":special_duty_date,
			"special_duty_time":special_duty_time,
			"cleaners":cleaners,
			};
			
	var newSpecialDutyString = JSON.stringify(newSpecialDutyObject);
	
	var fd = new FormData();
	fd.append('newSpecialDutyString',newSpecialDutyString);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == true)
			{
				alert("Success to create the new special duty");
				location.reload();
			}
		}
	});	
}

$(document).ready(function(){
	
	var numberOfCleaner = 1;
	$("#special_duty_dutyDetail_error").hide();
	$("#special_duty_date_error").hide();
	
	$("newSpecialDutyForm").submit(function(event){
		event.preventDefault();
	});
	
	insert_cleaner_dropdown(numberOfCleaner);
});













