function update_user_data(complete_duty_id)
{
	if(confirm("Do you confirm want to update?"))
	{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"adminCompleteDutyController/updateCompleteDuty";
	
		var completeDutyObject = {
			"complete_duty_id":complete_duty_id,
			"complete_duty_task":$("#"+complete_duty_id+"_complete_duty_task").text().trim(),
			"complete_duty_subtask":$("#"+complete_duty_id+"_complete_duty_subtask").text().trim(),
			"complete_duty_cleaner":$("#"+complete_duty_id+"_complete_duty_cleaner").text().trim(),
			"complete_duty_comment":$("#"+complete_duty_id+"_complete_duty_comment").text().trim(),
			"complete_duty_schedule":$("#"+complete_duty_id+"_complete_duty_schedule").text().trim(),
			"complete_duty_time":$("#"+complete_duty_id+"_complete_duty_time").text().trim(),
			"complete_duty_date":$("#"+complete_duty_id+"_complete_duty_date").text().trim()
			};	
	
		var completeDutyString = JSON.stringify(completeDutyObject);
		var fd = new FormData();
	
		fd.append('completeDutyString',completeDutyString);

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
}

$(document).ready(function(){
	
	var d= new Date();
	var i =0;
	
	$('#complete_duty_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#complete_duty_table').DataTable({
		"pageLength": 8,
		"order": [[ 0, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1,2,3,4,5,6,7'},
				title:'Complete Duty Table',
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
	
	$(document).on('click','.delete',function(){
		var txt = $(this).attr("id");
		var complete_duty_id = txt.match(/\d/g);
		complete_duty_id = complete_duty_id.join("");
		if(confirm("Do you confirm want to delete user data?"))
		{
			var table = $('#complete_duty_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
						
			var baseUrl = $("#baseURL").val();
			var url = baseUrl+"adminCompleteDutyController/deleteCompleteDutyData";
					
			var fd = new FormData();
			fd.append('complete_duty_id',complete_duty_id);

			$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message){
				alert("Delete Success");
				//insert_back_table(message);
			}
					
			});	
		}
	});
	
	$(document).on('click','.update',function(){
		var txt = $(this).attr("id");
		var complete_duty_id = txt.match(/\d/g);
		complete_duty_id = complete_duty_id.join("");
		update_user_data(complete_duty_id);
	});
});











