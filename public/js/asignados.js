$(document).ready(function(){
	//$("#notfAssigned").text("");
	// $.ajax({
	// 	url: "../controller/ReasignadosController.php?notf=1",
	// 	type:"get"
	// }).done((data)=>{
	// 	$("#notfAssigned").text(" "+data);
	// });

	// $.ajax({
	// 	url: "../controller/ReReasignadosController.php?notf=1",
	// 	type:"get"
	// }).done((data)=>{
	// 	$("#notfReassigned").text(" "+data);
	// });

});

function ShowMoreAssigned(id){
	var file="";
	$.ajax({
		url: "../controller/ReasignadosController.php?info="+id,
		type:"get",
		dataType:"JSON"
	}).done((request)=>{
		$("#h_envAsg").text("");
		$("#h_softAsg").text("");
		$("#h_fechAsg").text("");
		$("#h_asntAsg").text("");
		$("#h_descAsg").text("");
		$("#titleAssgn").text("");
		request.forEach((e, i)=>{

			if(!e.Archivo){
				$("#divViewDocAssign").css("display", "none");
			}else{
				file=e.Archivo;
				$("#divViewDocAssign").css("display", "block");
			}

			$("#h_envAsg").text(e.Entorno);
			$("#h_softAsg").text(e.Tipo);
			$("#h_fechAsg").text(e.Fecha_reg);
			$("#h_fech_Asg").text(e.Fecha_Asignado);
			$("#h_asntAsg").text(e.Asunto);
			$("#h_descAsg").text(e.Descripcion);
			$("#titleAssgn").text(" Caso N°"+e.Casos_idCaso+"  -  "+e.Nit+" "+e.Cliente);
		});
		
		$("#aViewDocAssign").click(function(){
			$(this).attr("href","../Files/"+file);	
		});
		
		$.ajax({
			url:"../controller/ReasignadosController.php?noteView=1&codAsgn="+id,
			type:"GET",
			dataType:"JSON"
		}).done((request)=>{
			$("#divNote").css("display", "none");
			$("#descNote").text("");
			request.forEach((e, i)=>{
				if(e.nota==""){
					$("#divNote").css("display", "none");
				}else{
					$("#divNote").css("display", "block");
					$("#descNote").text(e.Nota);
				}
			});
		})
	});

}

function ShowMoreCaseEnd(id){
	var timeH="";
	var timeM="";
	var timeD="";
	$.ajax({
		url: "../controller/ReasignadosController.php?id="+id,
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#h4fIng").text("");
		$("#h4fin").text("");
		$("#h4Time").text("");
		$("#h4_Theme").text("");
		$("#descSolution").text("");
		request.forEach((e, i)=>{
			$("#h4_Theme").text(e.Tema+": ");
			$("#h4fIng").text(e.Registro);
			$("#h4fin").text(e.Fin);
			$("#descSolution").text(e.Nota);

			timeH=e.diffHour;
			timeM=e.diffMin;
			timeD=e.diffDay;
		});
		if(timeH<=1){
			$("#h4Time").text(timeM+ " Minutos");
		}else if(timeH>1 && timeH<=24){
			$("#h4Time").text(timeH+ " Horas");
		}else{
			$("#h4Time").text(timeD+ " Dias");
		}
	});
}


function AssingAgain(id, nomAc,codAc){

	$.ajax({
		url:"../controller/ReasignadosController.php?valAssg="+id,
		type:"GET",
		dataType:"JSON",
		success:function(data){
			var list="";
			$("#slcTecReAssign").empty();
			data.forEach((e, i)=>{
				list+="<option value='"+e.idUsuario+"'>"+e.Nombre+" "+e.Apellidos+"</option>"
			});
			$("#slcTecReAssign").append("<option value=''>Seleccione --</option>"+list);
		}
	});
	var descs="";
	$("#p_MotRA").text("");
	$.ajax({
		url:"../controller/ReasignadosController.php?noteRA=1&idAdsgNote="+id,
		type:"GET",
		dataType:"JSON",
		success:function(info){
			info.forEach((e, i)=>{
				descs+=e.Nota+" \n";
			});
			$("#p_MotRA").text(descs);
		}
	});

	var newAssigned="";
	var type_service="";
	var serviceRA="";
	$("#slcTecReAssign").css("display", "none");

	$("#slcserviceReAssign").change(function(){
		serviceRA=$(this).val();
		type_service=$("#slcserviceReAssign option:selected").attr('class');

		if(type_service=="Area Comercial"){
			$("#slcTecReAssign").css("display", "none");
			$("#h4_reAssign").css("display", "block");
			$("#h4_reAssign").text("");
			$("#h4_reAssign").text(nomAc);
		}else{
			$("#slcTecReAssign").css("display", "block");
			$("#h4_reAssign").css("display", "none");
		}
	});

	$("#btn_reAssign").click(function(){
		if(type_service=="Area Comercial"){
			newAssigned=codAc;
		}else{
			newAssigned=$("#slcTecReAssign").val();
		}

		if(serviceRA=="" || newAssigned==""){
			swal("Revisa los campos", "", "error");
		}else{
			$.ajax({
				url:"../controller/ReasignadosController.php?newAssgn=1",
				type:"POST",
				data:{
					newAssigned,
					serviceRA,
					id
				},
				success:function(){
					swal("Caso Reasignado","","success")
					.then(()=>{
						location.reload();
					});
				}
			});
		}
	});
	// alert(id+" "+ nomAc+" "+codAc);
}

function updateAsessor(nit, cliente, asesor, last_asesor, idAc){
	$("#titleUpdtAssesor").text("");
	$("#h4_oldAssesor").text("");
	$("#modalUpdateAssesor").modal("show");
	$("#titleUpdtAssesor").text(`Cambiar ejecutivo para ${nit} ${cliente}`);
	$("#h4_oldAssesor").text(`${asesor} ${last_asesor}`);
	$("#slcNewAssesor").empty();
	var assesors='';
	$.ajax({
		type:'GET',
		dataType:'JSON',
		url: '../controller/ReasignadosController.php?validateAssesor=1&idAssesor='+idAc,
		success:function(request){

			request.forEach((e, i)=>{
				assesors+='<option value="'+e.idUsuario+'">'+e.Nombre+" "+e.Apellidos+'</option>';
			});
			$("#slcNewAssesor").append('<option value="">Seleccione --</option>'+assesors);
		},
		error:function(err){
			console.log(err);
		}
	});

	$("#btn_UpdtAssesor").click(function(){
		$.ajax({
			url:'../controller/ReasignadosController.php?UpdateAss=1',
			type:'POST',
			data:{
				user:$("#slcNewAssesor").val(),
				nit
			},
			success:function(response){
				swal("Ejecutivo modificado");
			}
		});
	});
}


