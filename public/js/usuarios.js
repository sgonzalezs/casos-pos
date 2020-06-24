$(document).ready(function(){
	$("#tblUsers").DataTable({
		language: {
	        processing:     "Procesando...",
	        search:         "Buscar&nbsp;:",
	        lengthMenu:    "Ver _MENU_ Elementos",
	        info:           "Mostrando _START_ a _END_ de _TOTAL_ Elementos",
	        infoEmpty:      "Mostrando 0 a 0 de 0 Elementos",
	        infoFiltered:   "(Filtrado de _MAX_ elementos en total)",
	        infoPostFix:    "",
	        loadingRecords: "Cargando datos...",
	        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
	        emptyTable:     "No hay información disponible",
	        paginate: {
	            first:      "Primer",
	            previous:   "Anterior",
	            next:       "Siguente",
	            last:       "Última"
	        },
	        aria: {
	            sortAscending:  ": activer pour trier la colonne par ordre croissant",
	            sortDescending: ": activer pour trier la colonne par ordre décroissant"
	        }
	    },
	    "order": [[ 0, "desc" ]]
	});
})

function SaveUser(){
	var iduser=$("#txt_userId").val();
	var name=$("#txt_nameUser").val();
	var last_name=$("#txt_lastnameUser").val();
	var email=$("#txt_emailUser").val();
	var pass=$("#txt_passUser").val();
	var repass=$("#txt_repassUser").val();
	var rol=$("#slc_RolUser").val();

	if(iduser=="" || name=="" || last_name =="" || email=="" || pass=="" || repass==""){
		swal("","Debes llenar todos los campos","error");
	}else if(pass!==repass){
		swal("","Las claves no coinciden","error");
	}else{
		$.ajax({
			url: "../controller/Usuarios.php?op=save",
			type:"POST",
			data:{
				iduser,
				name,
				last_name,
				email,
				pass,
				rol
			}
		}).done(()=>{
			swal("Usuario Registrado.")
			.then(() => {
				location.reload();
				CleanData();
			});
		});
	}
}

function CleanData(){
	$("#divNewUser input").val("");
}

function ChangeState(id, rol){
	swal("Eliminar este usuario?", {
	  buttons: {
	    cancel: "Cancelar",
	    Aceptar:"Aceptar"
	  },
	})
	.then((value) => {
	  switch (value) {
	 
	    case "Aceptar":
	    	$("#modalChangeAssesor").modal("show");
	    	$("#slcNewUser").empty();
	    	let list="";
	    	if(rol=="Asesor"){
	    		$.ajax({
	    			url:"../controller/UsuariosController.php?changeA=1 & id="+id,
	    			type:"GET",
	    			dataType:"JSON",
	    			success:function(data){
	    				data.forEach((e, i)=>{
	    					list+=`<option value='${e.idUsuario}'>${e.Nombre} ${e.Apellidos}</option>`;
	    				});
	    				$("#slcNewUser").append("<option value=''>Seleccione --</option>"+list);
	    			}
	    		});
	    	}else{
	    		$.ajax({
	    			url:"../controller/UsuariosController.php?changeTec=1 & id="+id,
	    			type:"GET",
	    			dataType:"JSON",
	    			success:function(data){
	    				data.forEach((e, i)=>{
	    					list+=`<option value='${e.idUsuario}'>${e.Nombre} ${e.Apellidos}</option>`;
	    				});
	    				$("#slcNewUser").append("<option value=''>Seleccione --</option>"+list);
	    			}
	    		});
	    	}
	    	$("#btnChangeUser").click(function(){
	    		let newUser=$("#slcNewUser").val();
	    		let bolRol=0;

	    		if(rol=="Asesor"){
	    			bolRol=1;
	    		}

	    		$.ajax({
	    			url:"../controller/UsuariosController.php?changeUser=1&bol_rol="+bolRol,
	    			type:"POST",
	    			data:{
	    				id,
	    				newUser
	    			},
	    			success:function(){
						$.ajax({
							url:"../controller/UsuariosController.php?updt=1",
							type:"POST",
							data:{
								estado:1,
								usuario:id
							},
							success:function(){
								swal("Usuario Eliminado.")
								.then(() => {
									location.reload();
								});
							}
						});
	    			}
	    		});
	    	});

	    break;
	 
	    default:
	    swal("Operacion Cancelada");  
	  }
	});

}

function changeUsers(user, rol){
	$("#modalEditUser").modal('show');
}