
	
function ShowMoreCaseEndAsg(id){
	var timeH="";
	var timeM="";
	var timeD="";
	$.ajax({
		url: "../controller/HistorialController.php?id="+id,
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#h4fIngAsg").text("");
		$("#h4finAsg").text("");
		$("#h4TimeAsg").text("");
		$("#descSolutionAsg").text("");
		$("#h3Theme").text("");
		request.forEach((e, i)=>{
			$("#h3Theme").text(e.Tipo+" - "+e.Tema+": ");
			$("#h4fIngAsg").text(e.Registro);
			$("#h4finAsg").text(e.Fin);
			$("#descSolutionAsg").text(e.Nota);

			timeH=e.diffHour;
			timeM=e.diffMin;
			timeD=e.diffDay;
		});
		if(timeH<=1){
			$("#h4TimeAsg").text(timeM+ " Minutos");
		}
		if(timeH>1 && timeH<=24){
			$("#h4TimeAsg").text(timeH+ " Horas");
		}
		if(timeH>24){
			$("#h4TimeAsg").text(timeD+ " Dias");
		}
	});
}