function update_user_data(pending_duty_id)
{
	if(confirm("Do you confirm want to update?"))
	{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"adminPendingDutyController/updatePendingDuty";
	
		var pendingDutyObject = {
			"pending_duty_id":pending_duty_id,
			"pending_duty_task":$("#"+pending_duty_id+"_pending_duty_task").text().trim(),
			"pending_duty_subtask":$("#"+pending_duty_id+"_pending_duty_subtask").text().trim(),
			"pending_duty_cleaner":$("#"+pending_duty_id+"_pending_duty_cleaner").text().trim(),
			"pending_duty_comment":$("#"+pending_duty_id+"_pending_duty_comment").text().trim(),
			"pending_duty_schedule":$("#"+pending_duty_id+"_pending_duty_schedule").text().trim(),
			"pending_duty_date":$("#"+pending_duty_id+"_pending_duty_date").text().trim()
			};	
	
		var pendingDutyString = JSON.stringify(pendingDutyObject);
		console.log(pendingDutyString);
		var fd = new FormData();
	
		fd.append('pendingDutyString',pendingDutyString);

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
	
	$('#pending_duty_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#pending_duty_table').DataTable({
		"pageLength": 8,
		"order": [[ 0, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1,2,3,4,5,6'},
				title:'Pending Duty Table',
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
		var pending_duty_id = txt.match(/\d/g);
		pending_duty_id = pending_duty_id.join("");
		if(confirm("Do you confirm want to delete user data?"))
		{
			var table = $('#pending_duty_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
						
			var baseUrl = $("#baseURL").val();
			var url = baseUrl+"adminPendingDutyController/deletePendingDutyData";
					
			var fd = new FormData();
			fd.append('pending_duty_id',pending_duty_id);

			$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message){
				alert("Delete Success");
			}
					
			});	
		}
	});
	
	$(document).on('click','.update',function(){
		var txt = $(this).attr("id");
		var pending_duty_id = txt.match(/\d/g);
		pending_duty_id = pending_duty_id.join("");
		update_user_data(pending_duty_id);
	});
});











