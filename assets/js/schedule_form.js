function postStuff(stuff,time,week)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"scheduleFormController/checkStuffLocation";
	var fd = new FormData();
	var stuff = stuff;
	var time = time;
	var week = week;
	fd.append('stuff',stuff);
	fd.append('time',time);
	fd.append('week',week);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){		
			if(!validation)
			{
				$("#data_area input,select").prop('value', "");
				$("#data_area input,select").prop('disabled', true);
				$("#save_schedule").prop('disabled', true);
				$("#delete_schedule").prop('disabled', true);
			}
			else
			{
				var schedule_data = JSON.parse(validation);
				$("#data_area input,select").prop('disabled', false);
				$("#save_schedule").prop('disabled', false);
				$("#delete_schedule").prop('disabled', false);
				
				$("#monday").val(schedule_data["monday"]);
				$("#tuesday").val(schedule_data["tuesday"]);
				$("#wednesday").val(schedule_data["wednesday"]);
				$("#thursday").val(schedule_data["thursday"]);
				$("#friday").val(schedule_data["friday"]);
				$("#saturday").val(schedule_data["saturday"]);
				$("#sunday").val(schedule_data["sunday"]);
				$("#remark").val(schedule_data["remark"]);
				
			}
		}
	});	
}

function deleteSchedule()
{			
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"scheduleFormController/deleteSchedule";
	var stuff = $("#stuff").val();
	var fd = new FormData();
	var stuff = stuff;
	var time = $("input[name='time']:checked").val();
	var week = $("input[name='week']:checked").val();
	fd.append('stuff',stuff);
	fd.append('time',time);
	fd.append('week',week);
	
	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){	
			if(!validation)
			{
				$("#data_area input,select").prop('value', "");
				$("#data_area input,select").prop('disabled', true);
				$("#save_schedule").prop('disabled', true);
				$("#delete_schedule").prop('disabled', true);
			}
			else
			{
				alert("Delete Completely");
				var schedule_data = JSON.parse(validation);
				$("#data_area input,select").prop('disabled', false);
				$("#save_schedule").prop('disabled', false);
				$("#delete_schedule").prop('disabled', false);
				
				$("#monday").val(schedule_data["monday"]);
				$("#tuesday").val(schedule_data["tuesday"]);
				$("#wednesday").val(schedule_data["wednesday"]);
				$("#thursday").val(schedule_data["thursday"]);
				$("#friday").val(schedule_data["friday"]);
				$("#saturday").val(schedule_data["saturday"]);
				$("#sunday").val(schedule_data["sunday"]);
				$("#remark").val(schedule_data["remark"]);
				
			}				
		}
	});
}

function saveSchedule()
{			
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"scheduleFormController/saveSchedule";
	
	var scheduleObject = {
			"stuff":$("#stuff").val(),
			"time":$("input[name='time']:checked").val(),
			"monday":$("#monday").val(),
			"tuesday":$("#tuesday").val(),
			"wednesday":$("#wednesday").val(),
			"thursday":$("#thursday").val(),
			"friday":$("#friday").val(),
			"saturday":$("#saturday").val(),
			"sunday":$("#sunday").val(),
			"remark":$("#remark").val(),
			"week":$("input[name='week']:checked").val()
			};	
	var scheduleString = JSON.stringify(scheduleObject);
	var fd = new FormData();
	fd.append('schedule',scheduleString);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(validation){	
			if(validation)
			{
				alert("Save Completely");
			}				
		}
	});
}

$(document).ready(function(){
	
	$("form").submit(function(event){
		event.preventDefault();
	});
	
	 $("#data_area input,select").prop('disabled', true);
	 $("#save_schedule").prop('disabled', true);
	 $("#delete_schedule").prop('disabled', true);
	 
	$("#stuff").keyup(function(){
		var stuff = $(this).val();
		var time = $("input[name='time']:checked").val();
		var week = $("input[name='week']:checked").val();
		postStuff(stuff,time,week);
	});
	
	$("input[name='time']").change(function() {
		var stuff = $("#stuff").val();
		var time = $("input[name='time']:checked").val();
		var week = $("input[name='week']:checked").val();
		postStuff(stuff,time,week);
	});
	
	$("input[name='week']").change(function() {
		var stuff = $("#stuff").val();
		var time = $("input[name='time']:checked").val();
		var week = $("input[name='week']:checked").val();
		postStuff(stuff,time,week);
	});
	
	$("#save_schedule").click(function(){
		if(confirm("The data will be save and may replace some data"))
		{
			saveSchedule();
		}
	});
	
	$("#delete_schedule").click(function(){
		if(confirm("CLICK yes to delete the schedule data"))
		{
			deleteSchedule();
		}
	});
});