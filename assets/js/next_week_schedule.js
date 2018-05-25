function getSchedule(time)
{			
	var numberOfTask = $("#numberOfTask").val();
	var tasks = [];
	var tasks_id = [];	
	
	var ii=0;
	for(var i = 1; i<=numberOfTask;i++)
	{
		tasks[ii] = $("#task"+i.toString()).val();
		tasks_id[ii] = $("#task_id"+i.toString()).val();
		ii++;
	}
	
	var scheduleObject = {
			"task":[],
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
	
	
	for(var i=1;i<=numberOfTask;i++)
	{
		scheduleObject.task[ii] = tasks[ii];
		scheduleObject.monday[ii] = $("#"+tasks_id[ii]+"_"+"1_"+time+" option:selected").val();
		scheduleObject.tuesday[ii] = $("#"+tasks_id[ii]+"_"+"2_"+time+" option:selected").val();
		scheduleObject.wednesday[ii] = $("#"+tasks_id[ii]+"_"+"3_"+time+" option:selected").val();
		scheduleObject.thursday[ii] = $("#"+tasks_id[ii]+"_"+"4_"+time+" option:selected").val();
		scheduleObject.friday[ii] = $("#"+tasks_id[ii]+"_"+"5_"+time+" option:selected").val();
		scheduleObject.saturday[ii] = $("#"+tasks_id[ii]+"_"+"6_"+time+" option:selected").val();
		scheduleObject.sunday[ii] = $("#"+tasks_id[ii]+"_"+"7_"+time+" option:selected").val();
		scheduleObject.remark[ii] = $("#"+tasks_id[ii]+"_remark_"+time+" option:selected").val();
		ii++;
	}
	
	var scheduleString = JSON.stringify(scheduleObject);
	return scheduleString;
}

function postMorningSchedule(time)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"nextWeekScheduleController/setMorningSchedule";
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
			alert("The new schedule will be use in next week");
			
		}
	});	
}

function postAfternoonSchedule(time)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"nextWeekScheduleController/setAfternoonSchedule";
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
			alert("The new schedule will be use in next week");
			
		}
	});	
}

function deleteMorningSchedule()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"nextWeekScheduleController/deleteMorningSchedule";

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
	var url = baseUrl+"nextWeekScheduleController/deleteAfternoonSchedule";

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

function copyMorningSchedule()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"nextWeekScheduleController/copyMorningSchedule";

	$.ajax({
		url: url,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){
			if(validation == true)
			{
				alert("The schedule have been copied");
				location.reload();
			}
		}
	});	
}

function copyAfternoonSchedule()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"nextWeekScheduleController/copyAfternoonSchedule";

	$.ajax({
		url: url,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){
			if(validation == true)
			{
				alert("The schedule have been copied");
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
	
	$("#copyMorningSchedule").click(function(){
		if(confirm("Click ok to confirm to copy the schedule"))
		{
			copyMorningSchedule();
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
	
	$("#copyAfternoonSchedule").click(function(){
		if(confirm("Click ok to confirm to copy the schedule"))
		{
			copyAfternoonSchedule();
		}
	});
});