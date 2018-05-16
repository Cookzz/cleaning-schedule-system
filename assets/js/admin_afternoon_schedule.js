function delete_afternoon_schedule(afternoon_schedule_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"adminScheduleController/deleteAfternoonSchedule";		
	var fd = new FormData();
	fd.append('afternoon_schedule_id',afternoon_schedule_id);
		
	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message)
		{
			alert("Delete Success");
		}	
	});	
}

function update_afternoon_schedule(afternoon_schedule_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"adminScheduleController/updateAfternoonSchedule";
		
		var afternoonScheduleObject = {
			"afternoon_schedule_id":afternoon_schedule_id,
			"stuff":$("#"+afternoon_schedule_id+"_stuff").text().trim(),
			"monday":$("#"+afternoon_schedule_id+"_monday").text().trim(),
			"tuesday":$("#"+afternoon_schedule_id+"_tuesday").text().trim(),
			"wednesday":$("#"+afternoon_schedule_id+"_wednesday").text().trim(),
			"thursday":$("#"+afternoon_schedule_id+"_thursday").text().trim(),
			"friday":$("#"+afternoon_schedule_id+"_friday").text().trim(),
			"saturday":$("#"+afternoon_schedule_id+"_saturday").text().trim(),
			"sunday":$("#"+afternoon_schedule_id+"_sunday").text().trim(),
			"remark":$("#"+afternoon_schedule_id+"_remark").text().trim(),
			"week_number":$("#"+afternoon_schedule_id+"_week_number").text().trim()
			};	
	
		var afternoonScheduleString = JSON.stringify(afternoonScheduleObject);
			
		var fd = new FormData();

		fd.append('afternoonScheduleString',afternoonScheduleString);

		$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message){
				if(message === "Update Success")
				{
					alert(message);
				}
			}
		});
}

$(document).ready(function(){
	
	var d= new Date();
	
	$('#afternoon_schedule_table').DataTable({
		"pageLength": 8,
		"order": [[ 0, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1,2,3,4,5,6,7,8,9,10'},
				title:'Afternoon Schedule Table',
				messageTop:"Print Date : " + d.getDate() + " / " + (d.getMonth()+1) +' / '+ d.getFullYear(),
				customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '12pt' );

 
                    $(win.document.body).find( 'table' )
                        .addClass('compact')
                        .css( 'font-size', 'inherit' );
                }
			}
		]
	});
	
	$("form").submit(function(event){
		event.preventDefault();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the stuff?"))
		{
			var txt = $(this).attr("id");
			var afternoon_schedule_id = txt.match(/\d/g);
			afternoon_schedule_id = afternoon_schedule_id.join("");
			
			var table = $('#afternoon_schedule_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
				
			delete_afternoon_schedule(afternoon_schedule_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the stuff?"))
		{
			var txt = $(this).attr("id");
			var afternoon_schedule_id = txt.match(/\d/g);
			afternoon_schedule_id = afternoon_schedule_id.join("");
			update_afternoon_schedule(afternoon_schedule_id);
		}
		
	});
});











