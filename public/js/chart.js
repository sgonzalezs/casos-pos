$(document).ready(function(){

		var role=2;

		$("#slc_report").change(function(){
			role=$("#slc_report").val();
			$.ajax({
				url:'../controller/HistorialController.php?graphics=true&role='+role,
				type:'GET',
				dataType:'JSON',
				success:(response)=>{
					var users=[];
					response.forEach((e,i)=>{
						users.push({"name":e.nombre, "data":[parseInt(e.n_casos)]})
					});

					$("#report").highcharts({
						chart: {
				            type: 'bar'
				        },
				        title: {
				            text: ''
				        },
				        xAxis: {
				            categories: ['Casos Resueltos']
				        },
				        yAxis: {
				            title: {
				                text: 'Escala'
				            }
				        },
				        series: users
					});
					
				},error:(err)=>{
					console.log(err);
				}
			});
		});

		$.ajax({
			url:'../controller/HistorialController.php?pie_themes=true',
			type:'GET',
			dataType:'JSON',
			success:(response)=>{
				var themes=[];
				response.forEach((e, i)=>{
					themes.push({
						"name":e.Nombre,
						"y":parseInt(e.n_casos),
					});
				});
				console.log(themes);
				$("#graphic-theme").highcharts({
					chart: {
					    type: 'pie',
					    options3d: {
					      enabled: true,
					      alpha: 45,
					      beta: 0
					    }
					  },
					  title: {
					    text: ''
					  },
					  tooltip: {
					    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					  },
					  accessibility: {
					    point: {
					      valueSuffix: '%'
					    }
					  },
					  plotOptions: {
					    pie: {
					      allowPointSelect: true,
					      cursor: 'pointer',
					      dataLabels: {
					        enabled: true,
					        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
					      }
					    }
					  },
					  series: [{
					    name: '',
					    colorByPoint: true,
					    data:themes
					  }]
				});
			},error:(error)=>{
				console.log(error);
			}
		});


	});