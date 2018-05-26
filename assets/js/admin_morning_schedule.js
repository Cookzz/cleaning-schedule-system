function delete_morning_schedule(morning_schedule_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"adminScheduleController/deleteMorningSchedule";		
	var fd = new FormData();
	fd.append('morning_schedule_id',morning_schedule_id);
		
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

function update_morning_schedule(morning_schedule_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"adminScheduleController/updateMorningSchedule";
		
		var mondayScheduleObject = {
			"morning_schedule_id":morning_schedule_id,
			"task":$("#"+morning_schedule_id+"_task").text().trim(),
			"monday":$("#"+morning_schedule_id+"_monday").text().trim(),
			"tuesday":$("#"+morning_schedule_id+"_tuesday").text().trim(),
			"wednesday":$("#"+morning_schedule_id+"_wednesday").text().trim(),
			"thursday":$("#"+morning_schedule_id+"_thursday").text().trim(),
			"friday":$("#"+morning_schedule_id+"_friday").text().trim(),
			"saturday":$("#"+morning_schedule_id+"_saturday").text().trim(),
			"sunday":$("#"+morning_schedule_id+"_sunday").text().trim(),
			"remark":$("#"+morning_schedule_id+"_remark").text().trim(),
			"week_number":$("#"+morning_schedule_id+"_week_number").text().trim()
			};	
	
		var mondayScheduleString = JSON.stringify(mondayScheduleObject);
		
		var fd = new FormData();

		fd.append('mondayScheduleString',mondayScheduleString);

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
	var i =0;
	
	$('#morning_schedule_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#morning_schedule_table').DataTable({
		"pageLength": 8,
		"order": [[ 0, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1,2,3,4,5,6,7,8,9,10'},
				title:'Morning Schedule Table',
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
	
	table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
	
	$("form").submit(function(event){
		event.preventDefault();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the task?"))
		{
			var txt = $(this).attr("id");
			var morning_schedule_id = txt.match(/\d/g);
			morning_schedule_id = morning_schedule_id.join("");
			
			var table = $('#morning_schedule_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
				
			delete_morning_schedule(morning_schedule_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the task?"))
		{
			var txt = $(this).attr("id");
			var morning_schedule_id = txt.match(/\d/g);
			morning_schedule_id = morning_schedule_id.join("");
			update_morning_schedule(morning_schedule_id);
		}
		
	});
});











