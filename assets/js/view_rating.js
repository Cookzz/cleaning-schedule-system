function renderBarChart()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"ratingController/getRating";

	$.ajax({
		url: url,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(ratingData){
			
			console.log(ratingData);
			var ratingData = JSON.parse(ratingData);
			var dataPoint = [];
			
			var i = 0;
			
			ratingData.forEach(function(ratingData){	
				var ratingDataObject = {
					'label': ratingData['rating_task'],
					"y": parseInt(ratingData['rating_mark'])
				};
				
				console.log(ratingData['rating_task'] +"____" + ratingData['rating_mark']);
				dataPoint.push(ratingDataObject);
			});
			
			console.log(ratingData);
			
			var chart = new CanvasJS.Chart("barRating", {
				animationEnabled: true,
				theme: "light1",
				axisX:{
					interval: 1,
					title: "Location",
					labelFontSize: 15,
					labelFontColor: "black",
					titleFontSize : 20,
					titleFontColor : "black"
				},
				axisY2:{
					interlacedColor: "rgba(77, 77, 255,.2)",
					gridColor: "rgba(1,77,101,.1)",
					title: "Mark",
					labelFontSize: 15,
					labelFontColor: "black",
					titleFontSize : 20,
					titleFontColor : "black"
				},
				data: [{
					type: "bar",
					name: "Rating",
					axisYType: "secondary",
					color: "rgb(77, 77, 255)",
					dataPoints: dataPoint
				}]
			});
			chart.render();
			 
		}
	});	
}

window.onload = function () {
	
	renderBarChart();
	
};













