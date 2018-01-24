
/*
Extrae el contador de clases para crear un grupo
*/

function evento(){
	var token = $("input[name=_token]").val();
	var id_clase= $("#clase_id").val();
	var route = '/admin/extraercontadorclases/';
	var parametros = {
		"id" :id_clase
	}
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'get',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			console.log(data);
			document.getElementById("secuencia").value = data;
			document.getElementById("codigo").value = id_clase+'.'+data;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});

}



function cuentaGrupos(){
	var token = $("input[name=_token]").val();
	var id_grupo= $("#grupo_id").val();
	var route = '/admin/extraercontadorgrupos/';
	var parametros = {
		"id" :id_grupo
	}
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'get',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			console.log(data);
			document.getElementById("secuencia").value = data.cantidad;
			document.getElementById("codigo").value = data.grupo_codigo+'.'+data.cantidad;
			document.getElementById("grupo").value = data.grupo_codigo;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}



function cuentaCuentas(){
	var token = $("input[name=_token]").val();
	var cuenta_id= $("#cuenta_id").val();
	var route = '/admin/extraercontadorcuentas/';
	var parametros = {
		"id" :cuenta_id
	}
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'get',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			console.log(data);
			document.getElementById("secuencia").value = data.cantidad;
			document.getElementById("codigo").value = data.cuenta_codigo+'.'+data.cantidad;
			document.getElementById("cuenta").value = data.cuenta_codigo;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}
