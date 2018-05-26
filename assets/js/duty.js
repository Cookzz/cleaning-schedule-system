/**function insert_back_table(message)
{
	var duty_data = JSON.parse(message);
	$("#duty_table").empty();
				
	$( "#duty_table" ).append("<td>No.</td><td>Duty Task</td><td>Duty Sub Task</td>");		
				
	var i =1;
	duty_data.forEach(function(duty_data){
		$( "#duty_table" ).append("<tr><td>"+i+"</td>"+
		"<td id='"+duty_data["duty_id"]+"_task' contenteditable='true'>"+duty_data["duty_task"]+"</td>"+
		"<td id='"+duty_data["duty_id"]+"_task' contenteditable='true'>"+duty_data["duty_sub_task"]+"</td>"+
		"<td><button type='button' id='"+duty_data["duty_id"]+"_delete' class='delete'>Delete</button></td>/tr>");
		i++;
	});
}**/

function insert_back_table(message)
{
	var duty_data = JSON.parse(message);
	var table = $('#duty_table').DataTable();
	table.clear();
	var i = 1;
	duty_data.forEach(function(duty_data){
		var newRow = table.row.add( [
			i,
			duty_data["duty_task"],
			duty_data["duty_sub_task"],
			"<center><button style='width:80px;height:30px' type='button' id='"+duty_data["duty_id"]+"_delete' class='w3-text-red fa fa-trash delete'></button></center>"
		]).draw( false ).node();
		i++;
		
		$(newRow).attr("id",duty_data["duty_id"]);
					
		$("#"+duty_data["duty_id"]).find('td:eq(1)').attr('id',duty_data["duty_id"]+"_task");			
		$("#"+duty_data["duty_id"]).find('td:eq(1)').attr('contenteditable',true);
		
		$("#"+duty_data["duty_id"]).find('td:eq(2)').attr('id',duty_data["duty_id"]+"_sub_task");			
		$("#"+duty_data["duty_id"]).find('td:eq(2)').attr('contenteditable',true);
			
		table.draw( false );
				
	});
}

function postDuty()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"dutyController/setNewDuty";
	var newDuty_task = $("#newDuty_task").val();
	var newDuty_sub_task = $("#newDuty_sub_task").val();
	var fd = new FormData();
	fd.append('newDuty_task',newDuty_task);
	fd.append('newDuty_sub_task',newDuty_sub_task);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message == false)
			{
				alert("Insert Uncompleted,Invalid or Duplicate Duty");
			}
			else
			{
				alert("Insert Success");
				insert_back_table(message);
				$("#newDuty_sub_task").val("");
			}
		}
	});	
	
}

function delete_duty(duty_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"dutyController/deleteDuty";		
	var fd = new FormData();
	fd.append('duty_id',duty_id);

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
	
	var i =0;
	
	$('#duty_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#duty_table').DataTable({
		"pageLength": 8,
		"info": false,
		"order": [[ 1, "asc" ]],
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
		
		postDuty();
	
	});
	
	$(document).on('click','.delete',function(){
		if(confirm("Do you confirm want to delete the task?"))
		{
			var txt = $(this).attr("id");
			var duty_id = txt.match(/\d/g);
			duty_id = duty_id.join("");
			delete_duty(duty_id);
		}
		
	});
});
