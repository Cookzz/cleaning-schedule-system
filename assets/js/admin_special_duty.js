function update_user_data(special_duty_id)
{
	if(confirm("Do you confirm want to update?"))
	{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"adminSpecialDutyController/updateSpecialDuty";
	
		var specialDutyObject = {
			"special_duty_id":special_duty_id,
			"special_duty_title":$("#"+special_duty_id+"_special_duty_title").text().trim(),
			"special_duty_detail":$("#"+special_duty_id+"_special_duty_detail").text().trim(),
			"special_duty_time":$("#"+special_duty_id+"_special_duty_time").text().trim(),
			"special_duty_date":$("#"+special_duty_id+"_special_duty_date").text().trim(),
			};	
	
		var specialDutyString = JSON.stringify(specialDutyObject);
		var fd = new FormData();
	
		fd.append('specialDutyString',specialDutyString);

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
	
	$('#special_duty_table tfoot th').each( function () {

        var title = $(this).text();
        $(this).html( '<input type="text" id="'+"column_search"+i+'" placeholder="Search '+title+'" />' );
		i++;
    } );
	
	var table = $('#special_duty_table').DataTable({
		"pageLength": 8,
		"order": [[ 0, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1,2,3'},
				title:'Special Duty Table',
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
		var special_duty_id = txt.match(/\d/g);
		special_duty_id = special_duty_id.join("");
		if(confirm("Do you confirm want to delete user data?"))
		{
			var table = $('#special_duty_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
						
			var baseUrl = $("#baseURL").val();
			var url = baseUrl+"adminSpecialDutyController/deleteSpecialDutyData";
					
			var fd = new FormData();
			fd.append('special_duty_id',special_duty_id);

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
		var special_duty_id = txt.match(/\d/g);
		special_duty_id = special_duty_id.join("");
		update_user_data(special_duty_id);
	});
});











