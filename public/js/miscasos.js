$(document).ready(function(){
		ListMysCases();
	
	$("#slcTheme").select2();
 
});

function ListMysCases(){

	$.ajax({
		url: "../controller/MisCasosController.php?list=1",
		type:"get",
		dataType:"JSON"
	}).done((data)=>{
		$("#tbodyMyCases").empty();
		data.forEach((e, i)=>{
			$("#tbodyMyCases").append("<tr><td>"+e.Casos_idCaso+"</td><td>"+e.Nit+"</td><td>"+e.Cliente+"</td><td>"+e.Asunto+"</td><td>"+e.Asesor+"</td><td>"+e.Servicio+"</td>"+
			"<td><a href='#' data-toggle='modal' data-target='#ShowMoreMyCase'  onclick='ShowMoreMyCases("+e.idAsignados+")' title='Ver Más'>"+
			"<i class='fa fa-eye' aria-hidden='true'></i></a>"+
			"<a href='#' title='Solicitar reasignación' onclick='ReassignCase("+e.idAsignados+")'>"+
			"<i class='fa fa-exchange' aria-hidden='true' style='color: white; background: #434343; border-radius: 5px;'></i></a>"+
			"<a href='#' data-toggle='modal' data-target='#' title='Terminar Caso' onclick='EndCase("+e.idAsignados+")'>"+
			"<i class='fa fa-check-circle' aria-hidden='true' style='color: white; background:#36D928; '></i></a></td></tr>");
		});
		//console.log(data);
	});

}

function Notification(){
	var num=0;
	//$("#notfMyCases").text("0");
	$.ajax({
		url: "../controller/MisCasosController.php?notf=1",
		type:"get"
	}).done((data)=>{
		num=parseInt(data);
		$("#notfMyCases").text(" "+data);
		$("#titlePage").text("Casos Pos-Venta ("+data+")");
	});

}

function ListClientH(){
	var cod=$("#txt_nitCaseHead").val();

	$.ajax({
		url:"../controller/MisCasosController.php?clnts="+cod,
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#txt_clientCaseHead").val("");
		$("#slc_AcCaseHead").val();
		request.forEach((e, i)=>{
			if(e.Cliente!=""){
				$("#txt_clientCaseHead").val(e.Cliente);
				$("#slc_AcCaseHead").val(e.Usuarios_idUsuario);
			}
		});
	});
}

function SaveCaseHeader(){

	var nitH=$("#txt_nitCaseHead").val();
	var clienteH=$("#txt_clientCaseHead").val();
	var asuntoH=$("#txt_AsntCaseHead").val();
	var descH=$("#txa_DescCaseHead").val();
	var softH=$("#slc_SoftCaseHead").val();
	var acH=$("#slc_AcCaseHead").val();
	var file=document.getElementById("fileCaseH").files[0];

	var bolH=false;
	var arrNitH=nitH.split("");

	for(var i=0; i<arrNitH.length; i++){
		if(isNaN(arrNitH[i]) && arrNitH[i]!="-"){
			bolH=true;
			break;
		}
    }

	if(nitH=="" ||clienteH=="" ||asuntoH=="" ||descH=="" ||softH=="" ||acH=="" || bolH){
		swal("Revisa que los campos estén bien diligenciados","","error");
	}else if(file && file.size>2097152){
		swal("El archivo adjunto pesa mas del tamaño permitido ("+(file.size/1048576).toFixed(0)+" mb)","","error");
	}
	else{
		var params = new FormData($("#formData")[0]);
		$.ajax({
			url:"../controller/MisCasosController.php?saveCaseH=1",
			type:"POST",
			data:params,
			processData:false,
			contentType:false,
			success: function(request){
				swal("Caso registrado","","success");
				$(".modalNewCaseHeader input, textarea").val("");
				$(".modalNewCaseHeader select").val("");
				$("#NewcaseModalH").modal("hide");
			}
		});
		// console.log(file);
	}
	
}

function CleanDataCaseHeader(){
	$("#divNewCaseHeader input,textarea").val("");
}

function ShowMoreMyCases(id){
	var file="";
	$.ajax({
		url: "../controller/MisCasosController.php?info="+id,
		type:"get",
		dataType:"JSON"
	}).done((request)=>{
		$("#h_nitAsg").text("");
		$("#h_clienteAsg").text("");
		$("#h_fechAsg").text("");
		$("#h_asntAsg").text("");
		$("#h_descAsg").text("");
		$("#titleAssgn").text("");
		request.forEach((e, i)=>{
			if(!e.Archivo){
				$("#divViewDocMyCase").css("display", "none");
			}else{
				file=e.Archivo;
				$("#divViewDocMyCase").css("display", "block");
			}

			$("#h_nitAsg").text(e.Entorno);
			$("#h_clienteAsg").text(e.Tipo);
			$("#h_fechAsg").text(e.Fecha_Asignado);
			$("#h_asntAsg").text(e.Asunto);
			$("#h_descAsg").text(e.Descripcion);
			$("#titleAssgn").text(" Caso N°"+e.Casos_idCaso+"  -  "+e.Nit+" "+e.Cliente);
		});

		$("#aViewDocMyCase").click(function(){
			$(this).attr("href","../Files/"+file);	
		});
	});

	$.ajax({
			url:"../controller/MisCasosController.php?noteView=1&codAsgn="+id,
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
}

function ShowMore_MyAssigned(id){
	var file="";
	$.ajax({
		url: "../controller/MisCasosController.php?infoMyAssg="+id,
		type:"get",
		dataType:"JSON"
	}).done((request)=>{
		$("#h_nitMyAssg").text("");
		$("#h_clienteMyAssg").text("");
		$("#h_fechMyAssg").text("");
		$("#h_asntMyAssg").text("");
		$("#h_descMyAssg").text("");
		$("#titleMyAssgn").text("");
		request.forEach((e, i)=>{

			if(!e.Archivo){
				$("#divViewDocMyAssign").css("display", "none");
			}else{
				file=e.Archivo;
				$("#divViewDocMyAssign").css("display", "block");
			}
			$("#h_nitMyAssg").text(e.Entorno);
			$("#h_clienteMyAssg").text(e.Tipo);
			$("#h_fechMyAssg").text(e.Fecha_reg);
			$("#h_asntMyAssg").text(e.Asunto);
			$("#h_descMyAssg").text(e.Descripcion);
			$("#titleMyAssgn").text(" Caso N°"+e.idCaso+"  -  "+e.Nit+" "+e.Cliente);
		});

		$("#aViewDoc_MyAssign").click(function(){
			$(this).attr("href","../Files/"+file);	
		});
	});
}

function EndCase(id){
	$("#nCaseEnd").text();
	$.ajax({
		url: "../controller/MisCasosController.php?theme=1",
		type:"GET",
		dataType:"JSON"
	}).done((request)=>{
		$("#slcTheme").empty();
		$("#slcTheme").append("<option value=''>Seleccione un tema </option>");
		request.forEach((e, i)=>{
			$("#slcTheme").append("<option value='"+e.idTema+"'>"+e.Tema+"</option>");
		});
	});

	$("#ModalEndCasae").modal("show");
	    	$("#nCaseEnd").text(id);
	    	$("#btnEndCase").click(function(){
	    		
	    		var desc=$("#txaEndcase").val();
	    		var theme=$("#slcTheme").val();

	    		if(desc.length<10){
	    			swal("","Debes agregar una Descripcion mas concreta","error");
	    			$("#txaEndcase").val("");
	    		}else if(theme==""){
	    			swal("", "Debes seleccionar un tema","error");
	    		}else{
	    			$.ajax({
	    				url:"../controller/MisCasosController.php?fin=1",
	    				type:"POST",
	    				data:{
	    					id:$("#nCaseEnd").text(),
	    					desc,
	    					theme
	    				}
	    			}).done(()=>{
	    				swal("","Caso terminado","success")
	    				.then(() => {
							location.reload();
						});
	    			});
	    		}
	    		
	    	});

	// swal("Dar por finalizado este caso?", {
	//   buttons: {
	//     cancel: "Cancelar",
	//     Aceptar:"Aceptar"
	//   },
	// })
	// .then((value) => {
	//   switch (value) {
	 
	//     case "Aceptar":
	    	
	    	

	//     break;
	 
	//     default:
	//     swal("Operacion Cancelada");  
	//   }
	// });
}

var txtDesc="";
function ValCharacter(){
	txtDesc=$("#txt_AsntCaseHead").val();

	if(txtDesc.length>200){
		console.log("has superado el limite");
		$("#txt_AsntCaseHead").css("background", "red");
		$("#txt_AsntCaseHead").hover(function(){
			$(this).attr("title", "Has superado el límite");
		});
	}else{
		$("#txt_AsntCaseHead").css("background", "white");
	}
}

function ReassignCase(id){
	
	swal("Solicitar Reasignacion para este caso?", {
	  buttons: {
	    cancel: "Cancelar",
	    Aceptar:"Aceptar"
	  },
	})
	.then((value)=>{
		switch(value){
			case "Aceptar":
				$("#ModalNoteRA").modal("show");
				
				$("#btnNoteRA").click(function(){
					var txaRa=$("#txaNoteRA").val();

					if(txaRa=="" || txaRa.length<10){
						swal("","Debes agregar una Descripcion mas concreta","error");
						$("#txaNoteRA").val("");
					}else{
						$.ajax({
							url:"../controller/MisCasosController.php?idAsg=1",
							type:"POST",
							data:{
								id,
								txaRa
							},
							success:function(){
								swal("Se ha enviado la solicitud")
								.then(()=>{
									location.reload();
								});
							}
						});	
					}
				});
			break;

			default:
				swal("Operacion Cancelada");

		}
	});
}