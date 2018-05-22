function insert_cleaner_dropdown(numberOfCleaner)
{
	$( "#cleaners_area" ).prepend("<tr><td class='cleanerLabel'><center>"+numberOfCleaner+"</center></td>"+
								"<td><input id='cleaner_"+numberOfCleaner+"' type='text' list='cleaners'></td>");
	
	$("#addCleaner").click(function(){
		numberOfCleaner++;
		$( "#cleaners_area" ).append("<tr><td class='cleanerLabel'><center>"+numberOfCleaner+"</center></td>"+
								"<td><input id='cleaner_"+numberOfCleaner+"' type='text' list='cleaners'></td>");
		
	});
	
	$("#newSpecialDutyForm").submit(function(event){
		event.preventDefault();
		validateDate(cleaners,numberOfCleaner);		
	});
}

function validateDate(cleaners,numberOfCleaner)
{
	var d = new Date();
    var TodayDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
	var special_d = new Date(Date.parse($("#special_duty_date").val()));
    var special_duty_date = special_d.getFullYear() + "-" + (special_d.getMonth()+1) + "-" +                               special_d.getDate();
    
	if(!($("#special_duty_dutyTitle").val().trim().match(/^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/)))
	{
		$("#special_duty_dutyDetail_error").hide();
		$("#special_duty_date_error").hide();
		$("#special_duty_dutyTitle_error").show();
		$("#special_duty_dutyTitle_error").text("Invalid Title");
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
		$("#special_duty_date_error").val("");
		$("#special_duty_dutyTitle_error").val("");
		$("#special_duty_dutyDetail_error").val("");
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
	
	var special_duty_dutyTitle = $("#special_duty_dutyTitle").val().trim();
	var special_duty_dutyDetail = $("#special_duty_dutyDetail").val().trim();
	var special_duty_date = $("#special_duty_date").val();
	var special_duty_time = $("#special_duty_time").val();
	
	var newSpecialDutyObject = {
			"special_duty_dutyTitle":special_duty_dutyTitle,
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

	
	$("#newSpecialDutyForm").submit(function(event){
		event.preventDefault();
	});
	
	insert_cleaner_dropdown(numberOfCleaner);
});













