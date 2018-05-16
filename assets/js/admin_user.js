/**function insert_back_table(message)
{
	var data = JSON.parse(message);
	user_data= data[0];
	position_data= data[1];
			
	user_data.forEach(function(user_data){
		$( "#user_table_body" ).prepend("<tr><td contenteditable='true' id='"+user_data["id"]+"_user_i1d'>"+user_data["user_id"]+"</td>"+
		"<td contenteditable='true' id='"+user_data["id"]+"_user_name'>"+user_data["user_name"]+"</td>"+
		"<td contenteditable='true' id='"+user_data["id"]+"_user_password'>"+user_data["user_password"]+"</td>"+
		"<td contenteditable='true' id='"+user_data["id"]+"_user_IC'>"+user_data["user_IC"]+"</td>"+
		"<td contenteditable='true' id='"+user_data["id"]+"_user_email'>"+user_data["user_email"]+"</td>"+
		"<td><select id='"+user_data["id"]+"_user_position'><option value='"+user_data["user_position"]+"'>"+user_data["user_position"]+"</option></td>"+
		"<td id='"+user_data["id"]+"_user_access_level'>"+user_data["user_access_level"]+"</td>"+
		"<td id='"+user_data["id"]+"_join_date'>"+user_data["join_date"]+"</td>"+
		"<td><button id='"+user_data["id"]+"update' class='update btn btn-default' type='button'>Update</button></td>"+
		"<td><button id='"+user_data["id"]+"delete' class='delete btn btn-default' type='button'>Delete</button></td></tr>");				
		
		position_data.forEach(function(position_data){
			$( "#"+user_data["id"]+"_user_position" ).prepend("<option value='"+position_data["position_name"]+"'>"+position_data["position_name"]+"</option>");
		});
	});
	//var table = $('#user_table').DataTable();
	//table.draw(true);
}**/

function insert_user_data()
{
	var newUsername = $("#newUserNameField").val();
	var newUserIC = $("#newUserICField").val();
	var newUserPosition = $("#newUserPositionField").val();
	var IcOrPassport = $("input[name='IcOrPassport']:checked").val();
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"userController/addNewUser";
	
	var fd = new FormData();
	fd.append('newUsername',newUsername);
	fd.append('newUserIC',newUserIC);
	fd.append('newUserPosition',newUserPosition);
	fd.append('IcOrPassport',IcOrPassport);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message){
			if(message)
			{
				alert("Insert Success");
				$("#newUserNameField").val("");
				$("#newUserICField").val("");
				
				//insert_back_table(message);
				var data = JSON.parse(message);
				user_data= data[0];
				position_data= data[1];	
				
				var table = $('#user_table').DataTable();
				
				user_data.forEach(function(user_data){
				var newRow = table.row.add( [
					user_data["user_id"],
					user_data["user_name"],
					user_data["user_password"],
					user_data["user_IC"],
					user_data["user_email"],
					user_data["user_position"],
					"<select id='"+user_data["id"]+"_user_position_selector'><option value='"+user_data["user_position"]+"'>"+user_data["user_position"]+"</option>",
					user_data["user_access_level"],
					user_data["join_date"],
					"<center><button id='"+user_data["id"]+"update' class='update btn btn-default' type='button'>Update</button></center>",
					"<center><button style='width:80px;height:30px' id='"+user_data["id"]+"delete' class='w3-text-red fa fa-trash delete' type='button'></button></center>"
				]).draw( false ).node();
				
					$(newRow).attr("id",user_data["id"]);
					
					$("#"+user_data["id"]).find('td:eq(0)').attr('id',user_data["id"]+"_user_id");
					$("#"+user_data["id"]).find('td:eq(0)').attr('contenteditable',true);
					$("#"+user_data["id"]).find('td:eq(1)').attr('id',user_data["id"]+"_user_name");
					$("#"+user_data["id"]).find('td:eq(1)').attr('contenteditable',true);
					$("#"+user_data["id"]).find('td:eq(2)').attr('id',user_data["id"]+"_user_password");
					$("#"+user_data["id"]).find('td:eq(2)').attr('contenteditable',true);
					$("#"+user_data["id"]).find('td:eq(3)').attr('id',user_data["id"]+"_user_IC");
					$("#"+user_data["id"]).find('td:eq(3)').attr('contenteditable',true);
					$("#"+user_data["id"]).find('td:eq(4)').attr('id',user_data["id"]+"_user_email");
					$("#"+user_data["id"]).find('td:eq(4)').attr('contenteditable',true);
					$("#"+user_data["id"]).find('td:eq(5)').attr('id',user_data["id"]+"_user_position");
					$("#"+user_data["id"]).find('td:eq(5)').attr('contenteditable',true);
					$("#"+user_data["id"]).find('td:eq(7)').attr('id',user_data["id"]+"_user_access_level");
					$("#"+user_data["id"]).find('td:eq(8)').attr('id',user_data["id"]+"_join_date");
					
					position_data.forEach(function(position_data){
					$( "#"+user_data["id"]+"_user_position_selector" ).prepend("<option value='"+position_data["position_name"]+"'>"+position_data["position_name"]+"</option>");
					});
					
				});
				
				table.draw( false );
		
				
			}
		}
	});	
}

function post_user_IC()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"userController/addNewUser";
	var newUserIC = $("#newUserICField").val();
	var IcOrPassport = $("input[name='IcOrPassport']:checked").val();	
	var fd = new FormData();
	fd.append('newUserIC',newUserIC);
	fd.append('IcOrPassport',IcOrPassport);
	
	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message)
		{
			$("#UserICErrorMessage").html(message);
			
		}
	});	
}

function post_user_name()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"userController/addNewUser";
	var newUsername = $("#newUserNameField").val();
	var fd = new FormData();
	fd.append('newUsername',newUsername);

	$.ajax({
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(message)
		{
			$("#UsernameErrorMessage").html(message);
		}
	});	
}

function update_user_data(id)
{
	if(confirm("Do you confirm want to update user data?"))
	{
		var baseUrl = $("#baseURL").val();
		var url = baseUrl+"userController/updateUserData";
		var user_data_object = {
				"id"				:id,
				"user_id"			:$("#"+id+"_user_id").text(),
				"user_name"			:$("#"+id+"_user_name").text(),
				"user_password"		:$("#"+id+"_user_password").text(),
				"user_IC"			:$("#"+id+"_user_IC").text(),
				"user_email"		:$("#"+id+"_user_email").text(),
				"user_position"		:$("#"+id+"_user_position_selector").val(),
				"user_access_level"	:$("#"+id+"_user_access_level").text(),
				"join_date"			:$("#"+id+"_join_date").text()
				};	
	
		var fd = new FormData();
	
		var user_data_string = JSON.stringify(user_data_object);
	
		fd.append('user_data_string',user_data_string);

		$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message){
				
				var data = JSON.parse(message);
				var final_message = data[0];
				var access_level = data[1];
				if(final_message === "Update Success")
				{
					
					alert(final_message);
					$("#"+id+"_user_position").text($("#"+id+"_user_position_selector").val());
					$("#"+id+"_user_access_level").text(access_level);
				}
				else
				{
					var data = JSON.parse(message);
					
					alert("Update Incomplete, Duplicate or Invalid Data Appear");
					$("#"+id+"_user_id").text(data[0]["user_id"]);
					$("#"+id+"_user_name").text(data[0]["user_name"]);
					$("#"+id+"_user_password").text(data[0]["user_password"]);
					$("#"+id+"_user_email").text(data[0]["user_email"]);
					$("#"+id+"_user_position_selector").val(data[0]["user_position"]);
					$("#"+id+"_user_IC").text(data[0]["user_IC"]);
					$("#"+id+"_user_access_level").text(data[0]["user_access_level"]);
				}
				
			}
		});
	}
}

$(document).ready(function(){
	
	var d= new Date();
	
	$("#IC").click(function(){
		 $('#newUserICField').attr('maxlength', '12');
	});
	
	$("#Passport").click(function(){
		 $('#newUserICField').attr('maxlength', '20');
	});
	
	var table = $('#user_table').DataTable({
		"pageLength": 10,
		"order": [[ 8, "desc" ]],
		"dom": 'Bfrtip',
        "buttons": [
            {
				extend: 'print',
				autoPrint: true,
                exportOptions: {columns: '0,1,2,3,4,5,7,8'},
				title:'User Table',
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
	table.column( 5 ).visible( false );
	
	$("form").submit(function(event){
		event.preventDefault();
		
		post_user_IC();
		post_user_name();
		insert_user_data();
		
	});
	
	$(document).on('click','.delete',function(){
		var txt = $(this).attr("id");
		var id = txt.match(/\d/g);
		id = id.join("");
		if(confirm("Do you confirm want to delete user data?"))
		{
			var table = $('#user_table').DataTable();
			table
				.row( $(this).parents('tr') )
				.remove()
				.draw(false);
						

			var baseUrl = $("#baseURL").val();
			var url = baseUrl+"userController/deleteUserData";
			
			var fd = new FormData();
			fd.append('id',id);
		
			$.ajax({
			url: url,
			data: fd,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(message)
			{
				if(message)
				{
					alert("Delete Success");
				}
			}
			
			});	
		}
		else
		{}
	});
	
	$(document).on('click','.update',function(){
		var txt = $(this).attr("id");
		var id = txt.match(/\d/g);
		id = id.join("");
		update_user_data(id);
	});

});











