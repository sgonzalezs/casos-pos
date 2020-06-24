$(document).ready(function(){
	$(".monthRange").css("display", "none");

	$("#aModalreports").click(function(){
		if($("#slc_typeReport").val()==""){
			$("#btnReport").attr("disabled", true);
		}else{
			$("#btnReport").attr("disabled", false);
		}

		typeReport();
	});
});

function typeReport(){
	var slc=$("#slc_typeReport").val();

	if(slc==""){
		$("#btnReport").attr("disabled", true);
	}else{
		$("#btnReport").attr("disabled", false);
	}

	if(slc=="rango"){
		$(".monthRange").css("display", "block");
	}else{
		$(".monthRange").css("display", "none");
	}
}

function validateMonth(){
	var slcInitial=$("#slc_mesInicial").val();

	$("#slc_mesFinal option").each(function(){
		if(parseInt($(this).val())<parseInt(slcInitial)){
			$(this).css("display", "none");
			$("#slc_mesFinal").val("");
		}else{
			$(this).css("display", "block");
		}
	});
	
}

function cleanSelects(){
	$(".divslcreports select").val("");
}