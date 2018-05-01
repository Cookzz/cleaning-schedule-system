function upLoadImage()
{		
	var baseUrl = $("#baseURL").val();
	var userImage = $("#newImage").get(0).files[0];	
	var fd = new FormData();
	
	fd.append('userImage',userImage);

	$.ajax({
		url: baseUrl+'userSettingController/newImageUpload',
		data: fd,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(ErrorMessage){
			var i = ErrorMessage;
			alert(i);
			location.reload();
		}
	});	
}

var loadImage = function(event) 
{
	var output = document.getElementById('output');
	output.src = URL.createObjectURL(event.target.files[0]);
	$("#confirmUpload").prop('style', "display:block");
};

$(document).ready(function(){
	
	$("#confirmUpload").click(function(){		
		upLoadImage();
	});

});