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
		}	
	});	
}

$(document).ready(function(){
	
	var d= new Date();
	var i =0;
	
	$('#admin_duty_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#admin_duty_table').DataTable({
		"pageLength": 10,
		"order": [[ 1, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1,2'},
				title:'Duty Table',
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
			var duty_id = txt.match(/\d/g);
			duty_id = duty_id.join("");
			
			var table = $('#duty_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
				
			delete_duty(duty_id);
		}
		
	});
});
