function delete_sub_stuff(sub_stuff_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"subStuffController/deleteSubStuff";		
	var fd = new FormData();
	fd.append('sub_stuff_id',sub_stuff_id);

		
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

function update_sub_stuff(sub_stuff_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"subStuffController/updateSubStuffData";
		var update_sub_stuff = $("#"+sub_stuff_id+"_sub_stuff").text().trim();
		var fd = new FormData();
		
		fd.append('update_sub_stuff',update_sub_stuff);
		fd.append('sub_stuff_id',sub_stuff_id);

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
				else
				{
					var data = message;
					alert("Update Incomplete, Duplicate or Invalid Data Appear");
					$("#"+sub_stuff_id+"_sub_stuff").text(message);
				}
				
			}
		});
}

$(document).ready(function(){
	
	var d= new Date();
	
	$('#sub_stuff_table').DataTable({
		"pageLength": 10,
		"order": [[ 1, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1'},
				title:'Substuff Table',
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
			var sub_stuff_id = txt.match(/\d/g);
			sub_stuff_id = sub_stuff_id.join("");
			
			var table = $('#sub_stuff_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
				
			delete_sub_stuff(sub_stuff_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the stuff?"))
		{
			var txt = $(this).attr("id");
			var sub_stuff_id = txt.match(/\d/g);
			sub_stuff_id = sub_stuff_id.join("");
			update_sub_stuff(sub_stuff_id);
		}
		
	});
});













