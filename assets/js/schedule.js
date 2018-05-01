function getSchedule(time)
{			
	var numberOfStuff = $("#numberOfStuff").val();
	var stuffs = [];
	var stuffs_id = [];	
	
	var ii=0;
	for(var i = 1; i<=numberOfStuff;i++)
	{
		stuffs[ii] = $("#stuff"+i.toString()).val();
		stuffs_id[ii] = $("#stuff_id"+i.toString()).val();
		ii++;
	}
	
	var scheduleObject = {
			"stuff":[],
			"monday":[],
			"tuesday":[],
			"wednesday":[],
			"thursday":[],
			"friday":[],
			"saturday":[],
			"sunday":[],
			"remark":[]
			};	
			
	var ii=0;
	
	
	for(var i=1;i<=numberOfStuff;i++)
	{
		scheduleObject.stuff[ii] = stuffs[ii];
		scheduleObject.monday[ii] = $("#"+stuffs_id[ii]+"_"+"1_"+time+" option:selected").val();
		scheduleObject.tuesday[ii] = $("#"+stuffs_id[ii]+"_"+"2_"+time+" option:selected").val();
		scheduleObject.wednesday[ii] = $("#"+stuffs_id[ii]+"_"+"3_"+time+" option:selected").val();
		scheduleObject.thursday[ii] = $("#"+stuffs_id[ii]+"_"+"4_"+time+" option:selected").val();
		scheduleObject.friday[ii] = $("#"+stuffs_id[ii]+"_"+"5_"+time+" option:selected").val();
		scheduleObject.saturday[ii] = $("#"+stuffs_id[ii]+"_"+"6_"+time+" option:selected").val();
		scheduleObject.sunday[ii] = $("#"+stuffs_id[ii]+"_"+"7_"+time+" option:selected").val();
		scheduleObject.remark[ii] = $("#"+stuffs_id[ii]+"_remark_"+time+" option:selected").val();
		ii++;
	}
	
	var scheduleString = JSON.stringify(scheduleObject);
	return scheduleString;
}

function postMorningSchedule(time)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"scheduleController/setMorningSchedule";
	var fd = new FormData();
	var scheduleString = getSchedule(time);
	fd.append('schedule',scheduleString);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){
			
			alert("Set Schedule Complete");
			alert("The new schedule will be use start from tomorrow");
			
		}
	});	
}

function postAfternoonSchedule(time)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"scheduleController/setAfternoonSchedule";
	var fd = new FormData();
	var scheduleString = getSchedule(time);
	fd.append('schedule',scheduleString);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){
			
			alert("Set Schedule Complete");
			alert("The new schedule will be use start from tomorrow");
			
		}
	});	
}

function deleteMorningSchedule()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"scheduleController/deleteMorningSchedule";

	$.ajax({
		url: url,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){
			if(validation == true)
			{
				alert("The schedule have been deleted");
				location.reload();
			}
		}
	});	
}

function deleteAfternoonSchedule()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"scheduleController/deleteAfternoonSchedule";

	$.ajax({
		url: url,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){
			if(validation == true)
			{
				alert("The schedule have been deleted");
				location.reload();
			}
		}
	});	
}

$(document).ready(function(){
	
	$("form").submit(function(event){
		event.preventDefault();
	});
	
	$("form2").submit(function(event){
		event.preventDefault();
	});
	
	$("#updateMorningSchedule").click(function(){
		if(confirm("Click ok to confirm the update"))
		{
			postMorningSchedule("morning");
		}
	});

	$("#deleteMorningSchedule").click(function(){
		if(confirm("Click ok to confirm to delete the schedule"))
		{
			deleteMorningSchedule();
		}
	});
	
	$("#updateAfternoonSchedule").click(function(){
		if(confirm("Click ok to confirm the update"))
		{
			postAfternoonSchedule("afternoon");
		}
	});

	$("#deleteAfternoonSchedule").click(function(){
		if(confirm("Click ok to confirm to delete the schedule"))
		{
			deleteMorningSchedule();
		}
	});
});