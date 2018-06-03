function renderBarChart()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"graphController/getRating";

	$.ajax({
		url: url,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(ratingData){
			
			var ratingData = JSON.parse(ratingData);
			var dataPoint = [];
			
			var i = 0;
			
			ratingData.forEach(function(ratingData){	
				var ratingDataObject = {
					'label': ratingData['rating_task'],
					"y": parseInt(ratingData['rating_mark'])
				};
				
				dataPoint.push(ratingDataObject);
			});
			
			var chart = new CanvasJS.Chart("barRating", {
				animationEnabled: true,
				theme: "light1",
				title: {
					text: "Customer Rating"
				},
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

function renderPieChart()
{
	var baseUrl = $("#baseURL").val();
	var url = baseUrl+"graphController/getDuty";

	$.ajax({
		url: url,
		processData: false,
		contentType: false,
		type: 'POST',
		success: function(dutyDataArray){
			
			var dutyData = JSON.parse(dutyDataArray);
			var dataPoint = [];
			
			var i = 0;
			
			var ratingDataObject = {
				'label': "Pending Duty",
				"y": parseInt(dutyData['pendingDutyPercent'])
			};
				
			dataPoint.push(ratingDataObject);
			
			var ratingDataObject = {
				'label': "Complete Duty",
				"y": parseInt(dutyData['completeDutyPercent'])
			};
				
			dataPoint.push(ratingDataObject);
			
			var chart = new CanvasJS.Chart("pieDuty", {
				animationEnabled: true,
				title: {
					text: "Completion Of Duty"
				},
				data: [{
					type: "pie",
					startAngle: 240,
					yValueFormatString: "##0.00\"%\"",
					indexLabel: "{label} {y}",
					dataPoints: dataPoint
					}]
				});
				
			chart.render();
		}
			
	});	
}

window.onload = function () {
	
	renderBarChart();
	renderPieChart();
	
};













