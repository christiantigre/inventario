
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


function cuentaCuentasVarias(){
	var token = $("input[name=_token]").val();
	var cuenta_id= $("#cuenta_id").val();
	var route = '/admin/extraercontadorcuentasvarias/';
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

function cuentaSubCuentas(){
	var token = $("input[name=_token]").val();
	var subcuenta_id= $("#subcuenta_id").val();
	var route = '/admin/extraercontadorsubcuentas/';
	var parametros = {
		"id" :subcuenta_id
	}
	console.log(parametros);
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
			document.getElementById("subcuenta").value = data.cuenta_codigo;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}


function cuentaSubCuentasVarias(){
	var token = $("input[name=_token]").val();
	var subcuenta_id= $("#subcuenta_id").val();
	var route = '/admin/extraercontadorsubcuentasvarias/';
	var parametros = {
		"id" :subcuenta_id
	}
	console.log(parametros);
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
			document.getElementById("subcuenta").value = data.cuenta_codigo;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}

function cuentaAuxCuentas(){
	var token = $("input[name=_token]").val();
	var auxiliar_id= $("#auxiliar_id").val();
	var route = '/admin/extraercontadorauxcuentas/';
	var parametros = {
		"id" :auxiliar_id
	}
	console.log(parametros);
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
			document.getElementById("auxiliar").value = data.cuenta_codigo;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}

$('.guarda_auxiliar').click(function(){
	var subcuenta_id= $("#subcuenta_id").val();
	var subcuenta= $("#subcuenta").val();
	var secuencia= $("#secuencia").val();
	var auxiliar= $("#auxiliar").val();
	var codigo= $("#codigo").val();
	var token = $("input[name=_token]").val();
	var route = '/admin/saveauxcuenta/';

	var parametros = {
		"subcuenta_id" :subcuenta_id,
		"subcuenta" :subcuenta,
		"auxiliar" :auxiliar,
		"secuencia" :secuencia,
		"codigo" :codigo
	}
	console.log(parametros);
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'post',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			console.log(data);
			console.log("copy data succefull");
			list_auxcuentas();
			reset_input_auxcuentas();
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
});


function cuentaSubAuxCuentas(){
	var token = $("input[name=_token]").val();
	var auxiliar_id= $("#auxiliar_id").val();
	var route = '/admin/extraercontadorsubauxcuentas/';
	var parametros = {
		"id" :auxiliar_id
	}
	console.log(parametros);
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
			document.getElementById("auxiliar").value = data.cuenta_codigo;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}

$('.guarda_subauxiliar').click(function(){
	var auxiliar_id= $("#auxiliar_id").val();
	var auxiliar= $("#auxiliar").val();
	var secuencia= $("#secuencia").val();
	var subauxiliar= $("#subauxiliar").val();
	var codigo= $("#codigo").val();
	var token = $("input[name=_token]").val();
	var route = '/admin/savesubauxcuenta/';

	var parametros = {
		"auxiliar_id" :auxiliar_id,
		"auxiliar" :auxiliar,
		"secuencia" :secuencia,
		"subauxiliar" :subauxiliar,
		"codigo" :codigo
	}
	console.log(parametros);
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'post',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			console.log(data);
			console.log("copy data succefull");
			list_Subauxcuentas();
			reset_input_subauxcuentas();
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
});

function list_Subauxcuentas(){
	console.log('loading items cuentas sub auxiliar');
	$.ajax({
		type:'get',
		url:'/admin/listsubauxcuentas/',
		success: function(data){
			$('#list-cart').empty().html(data);
		}
	});
}

function reset_input_subauxcuentas(){
	console.log('reseting');
	document.getElementById("auxiliar").value = "";
	document.getElementById("subauxiliar").value = "";
	document.getElementById("secuencia").value = "";
	document.getElementById("codigo").value = "";
}

function trashSubAuxCuentas(id){
	console.log(id);
	var token = $("input[name=_token]").val();
	var route = '/admin/trashSubAuxcuentas/';	
	var parametros = {
		"id" :'0'
	}
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'post',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			console.log('correcto '+data.data);
			list_Subauxcuentas();	
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}









function reset_input_trs(){
	console.log('reseting');
	document.getElementById("cod_cuenta").value = "";
	document.getElementById("cuenta").value = "";
	document.getElementById("concepto_detall").value = "";
	document.getElementById("valor").value = "";
}
