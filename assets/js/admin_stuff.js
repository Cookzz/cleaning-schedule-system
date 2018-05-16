function delete_stuff(stuff_id)
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"stuffController/deleteStuff";		
	var fd = new FormData();
	fd.append('stuff_id',stuff_id);

		
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

function update_stuff(stuff_id)
{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"stuffController/updateStuffData";
		var update_stuff = $("#"+stuff_id+"_stuff").text().trim();
		var test_update_stuff = $("#"+stuff_id+"_stuff").text();
		console.log(update_stuff);
		console.log(test_update_stuff);
		var fd = new FormData();

		fd.append('update_stuff',update_stuff);
		fd.append('stuff_id',stuff_id);

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
					$("#"+stuff_id+"_stuff").text(message);
				}
				
			}
		});
}

$(document).ready(function(){
	
	var d= new Date();
	
	$('#stuff_table').DataTable({
		"pageLength": 10,
		"order": [[ 1, "asc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1'},
				title:'Stuff Location Table',
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
			var stuff_id = txt.match(/\d/g);
			stuff_id = stuff_id.join("");
			
			var table = $('#stuff_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
				
			delete_stuff(stuff_id);
		}
		
	});
	
	$(document).on('click','.update',function(){
		if(confirm("Do you confirm want to update the stuff?"))
		{
			var txt = $(this).attr("id");
			var stuff_id = txt.match(/\d/g);
			stuff_id = stuff_id.join("");
			update_stuff(stuff_id);
		}
		
	});
});











