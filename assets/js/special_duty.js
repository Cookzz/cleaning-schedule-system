function insert_back_table(message)
{
	var special_duty_data = JSON.parse(message);
	var table = $('#special_duty_table').DataTable();
	table.clear();
	console.log("ss");
	var i = 1;
	special_duty_data.forEach(function(special_duty_data){
		var newRow = table.row.add( [
			i,
			special_duty_data["special_duty_title"],
			special_duty_data["special_duty_detail"],
			special_duty_data["special_duty_time"],
			special_duty_data["special_duty_date"],
			"<center><button type='button' id='"+special_duty_data["special_duty_id"]+"_modify' class='modify'>Update</button></center>",
			"<center><button type='button' id='"+special_duty_data["special_duty_id"]+"_delete' class='delete'>Delete</button></center>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",special_duty_data["task_id"]);
			
		$("#"+special_duty_data["task_id"]).find('td:eq(1)').attr('id',special_duty_data["task_id"]+"_special_duty_title");			
		$("#"+special_duty_data["task_id"]).find('td:eq(2)').attr('id',special_duty_data["task_id"]+"_special_duty_detail");
		$("#"+special_duty_data["task_id"]).find('td:eq(3)').attr('id',special_duty_data["task_id"]+"_special_duty_time");
		$("#"+special_duty_data["task_id"]).find('td:eq(4)').attr('id',special_duty_data["task_id"]+"_special_duty_date");	
				
	});
	table.draw( false );
}

function delete_task(special_duty_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"specialDutyController/deleteSpecialDuty";		
	var fd = new FormData();
	fd.append('special_duty_id',special_duty_id);

		
	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message)
		{
			insert_back_table(message);
		}	
	});	
}

$(document).ready(function(){
	
	var i =0;
	
	$('#special_duty_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#special_duty_table').DataTable({
		"pageLength": 8,
		"info": false,
		"order": [[ 0, "asc" ]],
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
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete this special duty?"))
		{
			var txt = $(this).attr("id");
			var special_duty_id = txt.match(/\d/g);
			special_duty_id = special_duty_id.join("");
			delete_task(special_duty_id);
		}
		
	});
	
	$(document).on('click','.modify',function(){
		if(confirm("Do you confirm want to update the task?"))
		{
			var txt = $(this).attr("id");
			var task_id = txt.match(/\d/g);
			task_id = task_id.join("");
			update_task(task_id);
		}
		
	});
});













