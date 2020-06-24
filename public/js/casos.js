$(document).ready(function(){

	ListTypeTheme();
	ListServices();
	listTheme();
	// $.ajax({
	// 	url: "../controller/CasosController.php?notf=1",
	// 	type:"get"
	// }).done((data)=>{
	// 	$("#notfCases").text(" "+data);
	// });
	var bol=true;

});


function SlcEnv(){
	var idEnv=$("#slc_EnvCase").val();
	
	//var list='';
	$.ajax({
        url:"../controller/CasosController.php?cod="+idEnv,
        type:"get",
        dataType:"JSON",
        success: function(data){
        	$("#slc_SoftCase").empty();
        	$("#slc_SoftCase").append("<option value=''>Seleccione --</option>");
        	data.forEach((e, i)=>{
        		$("#slc_SoftCase").append("<option value='"+e.idTipo+"'>"+e.Nombre+"</option>");
        	});
        },
        error: function(err, pet){
        	console.log("error "+err);
        }
    });
 	
}

function SlcEnvHead(){
	var idEnvH=$("#slc_EnvCaseHead").val();
	//var list='';
	$.ajax({
        url:"../controller/CasosController.php?cod="+idEnvH,
        type:"get",
        dataType:"JSON",
        success: function(data){
        	$("#slc_SoftCaseHead").empty();
        	$("#slc_SoftCaseHead").append("<option value=''>Seleccione --</option>");
        	data.forEach((e, i)=>{
        		$("#slc_SoftCaseHead").append("<option value='"+e.idTipo+"'>"+e.Nombre+"</option>");
        	});
        },
        error: function(err, pet){
        	console.log("error "+err);
        }
    });
 	
}

function SaveCase(){
	var nit=$("#txt_nitCase").val();
	var clnt=$("#txt_clientCase").val();
	var asnt=$("#txt_AsntCase").val();
	var desc=$("#txa_DescCase").val();
	var ac=$("#slc_AcCase").val();
	var soft=$("#slc_SoftCase").val();
	var file=document.getElementById("file_Case").files[0];
	var paramsCase=new FormData($("#formCase")[0]);
	var bol=false;
	var arrNit=nit.split("");

	for(var i=0; i<arrNit.length; i++){
		if(isNaN(arrNit[i]) && arrNit[i]!="-"){
			bol=true;
			break;
		}
    }
    

	if(file && file.size>2097152){
		swal("El archivo adjunto pesa mas del tamaño permitido ("+(file.size/1048576).toFixed(0)+" mb)","","error");
	}else if(nit=="" || clnt=="" || asnt =="" || desc=="" || ac=="" || bol){
		swal("Revisa que los campos estén bien diligenciados","","error");	
	}else{
		$("#btnSaveCase").attr("disabled", true);
		$.ajax({
			url:"../controller/CasosController.php?op=SaveCase",
			type: "POST",
			data:paramsCase,
			processData:false,
			contentType:false,
			success:function(request){
				swal(request,"","success")
				.then(() => {
					$("#btnSaveCase").attr("disabled", false);
					location.reload();
					CleanDataCase();
				});
			},
			error:function(err, req){
				swal("error");
				console.log(err);
			}
		});
	}
}

function CleanDataCase(){
	$("#divNewCase input,textarea").val("");
}

function ShowMore(id){
	var file="";
	$.ajax({
		url: "../controller/CasosController.php?VerMasid="+id,
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#h_nit").text("");
		$("#h_cliente").text("");
		$("#h_fech").text("");
		$("#h_asnt").text("");
		$("#h_desc").text("");
		$("#titleCase").text("");
		request.forEach((e, i)=>{

			if(!e.Archivo){
				$("#divViewDoc").css("display", "none");
			}else{
				file=e.Archivo;
				$("#divViewDoc").css("display", "block");
			}
			

			$("#h_nit").text(e.Nit);
			$("#h_cliente").text(e.Cliente);
			$("#h_fech").text(e.Fecha_reg);
			$("#h_asnt").text(e.Asunto);
			$("#h_desc").text(e.Descripcion);
			$("#titleCase").text(e.Nit+" "+e.Cliente);
		});

		$("#aViewDoc").click(function(){
			$(this).attr("href","../Files/"+file);	
		});
		
	});	
}

function AssignCase(id, ac, nomAc){
	$.ajax({
		url: "../controller/CasosController.php?VerMasid="+id,
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#h4Assign").text("");
		request.forEach((e, i)=>{
			$("#h4Assign").text(e.Nit+" "+e.Cliente);
		});
	});	

	$("#slcTecCase").css("display", "none");
		$("#h4_Assgn").text("");
		var user="";
		var service="";
		var typeService="";

		$("#slcServiceCase").change(function(){
			service=$("#slcServiceCase").val();
			typeService=$("#slcServiceCase option:selected").attr('class');
			$("#slcTecCase").val();
			if(typeService=='Area Comercial'){
				$("#slcTecCase").css("display", "none");
				$("#h4_Assgn").css("display", "block");
				$("#h4_Assgn").text(nomAc);
				
			}else{
				$("#slcTecCase").css("display", "block");
				$("#h4_Assgn").css("display", "none");
			}
		});

		$("#btnSaveAssign").click(function(){

			if(typeService=='Area Comercial'){
				user=ac;
			}else{
				user=$("#slcTecCase").val();
			}
			
			var note=$("#txaNoteCase").val();
			if(service==""){
				swal("","Debes seleccionar ambos datos","error");
			}else if(user==""){
				swal("","Debes seleccionar ambos datos","error");
			}else{
				$.ajax({
					url: "../controller/CasosController.php?AsignarCaso=1",
					type:"POST",
					data:{
						id,
						user,
						service
					},
					success:function(){
						if(note!=""){
							$.ajax({
								url: "../controller/CasosController.php?Note=1",
								type:"POST",
								data:{
									note,
									typeN:1
								},
								success: function(){
									swal("Caso Asignado exitosamente. Se agregó la nota")
									.then(() => {
										location.reload();
									});	
								} 
							});
						}else{
							swal("Caso Asignado exitosamente.")
							.then(() => {
								location.reload();
							});
						}
					} 
				});
			}
		});
}

function ListTypeTheme(){
	$.ajax({
		url: "../controller/CasosController.php?Type=1",
		type:"GET",
		dataType:"JSON"
	}).done((resp)=>{
		$("#slcTypeTheme").empty();
		$("#slcTypeTheme").append("<option value=''>Seleccione --</option>");
		resp.forEach((e, i)=>{
			$("#slcTypeTheme").append("<option value='"+e.idTipo+"'>"+e.Nombre+"</option>")
		});	
	});
}

function listTheme(){
	$.ajax({
		url: "../controller/CasosController.php?infothemes=1",
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#tableThemes tbody").empty();
		request.forEach((e, i)=>{
			$("#tableThemes tbody").append("<tr><td>"+e.Nombre+"</td><td>"+e.Tipo+"</td></tr>");
		});
	});
}

function SaveTheme(){

	var theme = $("#txt_theme").val();
	var type =  $("#slcTypeTheme").val();

	if(theme=="" || type==""){
		swal("", "Debes llenar los campos","error");
	}else{
		$.ajax({
			url: "../controller/CasosController.php?NewTheme=1",
			type:"POST",
			data:{
				theme,
				type
			}
		}).done(()=>{
			listTheme();
			swal("Nuevo tema agregado")
				.then(()=>{
					$("#txt_theme").val("");
					$("#slcTypeTheme").val("");
				});
		});
	}
}

function SaveService(){
	var service = $("#txt_service").val();
	var typeServ =  $("#slcTypeService").val();

	if(service=="" || typeServ==""){
		swal("", "Debes llenar los campos","error");
	}else{
		$.ajax({
			url: "../controller/MisCasosController.php?service=1",
			type:"POST",
			data:{
				service,
				typeServ
			}
		}).done(()=>{
			ListServices();
			swal("Nuevo Servicio agregado")
				.then(()=>{
					$("#txt_service").val("");
					$("#slcTypeService").val("");
					// $("#ModalNewService").modal("hide");
				});
		});
	}
}

function CleanComponentsAssign(){
	$("#slcTecCase").val("");
	$("#h4_Assgn").text("");
	$("#slcServiceCase").val("");
}

function ListClient(){
	var cod=$("#txt_nitCase").val();

	$.ajax({
		url:"../controller/MisCasosController.php?clnts="+cod,
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#txt_clientCase").val("");
		$("#slc_AcCase").val();
		request.forEach((e, i)=>{
			if(e.Cliente!=""){
				$("#txt_clientCase").val(e.Cliente);
				$("#slc_AcCase").val(e.Usuarios_idUsuario);
			}
		});
	});
}

function ListServices(){
	$("#tableServices").empty();
	$.ajax({
		url:"../controller/MisCasosController.php?serviceList=1",
		type:"GET",
		dataType:"JSON"
	}).done((data)=>{
		
		data.forEach((e, i)=>{
			$("#tableServices").append("<tr><td>"+e.Nombre+"</td><td>"+e.Tipo+"</td></tr>");
		});
	});
}