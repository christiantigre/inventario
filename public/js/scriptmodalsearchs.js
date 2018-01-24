//buscar proveedor por ruc
$(document).ready(function(){
	$("#proveedorrucchbuton").click(function(event){
		event.preventDefault();
		var dataId= $("#rucprv").val();
		var token = $("input[name=_token]").val();
		var route = '/admin/products/buscaproveedorruc/';
		var parametros = {
			"id" :dataId
		}
		var dataSting = "id="+dataId;
		if (dataId == "") {
			alert('Ingrese datos de busqueda');
			document.getElementById("rucprv").focus();
			return false;
		}
		$.ajax({
			url:route,
			headers:{'X-CSRF-TOKEN':token},
			type:'get',
			dataType: 'json',
			data:parametros,
			success:function(data)
			{
				document.getElementById("rucprv").value = "";
				document.getElementById("tabla_proveedor").deleteRow(0);
				var contLin = 3;
				var tr, td, tabla;
				tabla = document.getElementById('tabla_proveedor');
				tr = tabla.insertRow(tabla.rows.length);
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = td.innerHTML = data.mail+"<input type='hidden' id='cel_movicamp' name='cel_movi' value="+data.cel_movi+"><input type='hidden' id='cel_clarocamp' name='cel_claro' value="+data.cel_claro+"><input type='hidden' id='proveedorcamp' name='proveedor' value="+data.proveedor+"><input type='hidden' id='mailcamp' name='mail' value="+data.mail+"><input type='hidden' id='representantecamp' name='representante' value="+data.representante+"><input type='hidden' id='proveedoridcamp' name='id' value="+data.id+">";
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = data.cel_movi+' '+data.cel_claro;
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = data.representante;
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = "<button type='button' id='buscarcliente' onclick='seleccionar_proveedor();' data-dismiss='modal' class='btn btn-primary'>Seleccionar</button>";
				contLin++;
			},
			error:function(data)
			{
				console.log('Error '+data);
			}  
		});
	});
});
//buscar proveedor por nombre de empresa
$(document).ready(function(){
	$("#proveedorempchbuton").click(function(event){
		event.preventDefault();
		var dataId= $("#nompro").val();
		var token = $("input[name=_token]").val();
		var route = '/admin/products/buscaproveedorempresa/';
		var parametros = {
			"id" :dataId
		}
		var dataSting = "id="+dataId;
		if (dataId == "") {
			alert('Ingrese datos de busqueda');
			document.getElementById("rucprv").focus();
			return false;
		}
		$.ajax({
			url:route,
			headers:{'X-CSRF-TOKEN':token},
			type:'get',
			dataType: 'json',
			data:parametros,
			success:function(data)
			{
				document.getElementById("rucprv").value = "";
				document.getElementById("tabla_proveedor").deleteRow(0);
				var contLin = 3;
				var tr, td, tabla;
				tabla = document.getElementById('tabla_proveedor');
				tr = tabla.insertRow(tabla.rows.length);
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = td.innerHTML = data.mail+"<input type='hidden' id='cel_movicamp' name='cel_movi' value="+data.cel_movi+"><input type='hidden' id='cel_clarocamp' name='cel_claro' value="+data.cel_claro+"><input type='hidden' id='proveedorcamp' name='proveedor' value="+data.proveedor+"><input type='hidden' id='mailcamp' name='mail' value="+data.mail+"><input type='hidden' id='representantecamp' name='representante' value="+data.representante+"><input type='hidden' id='proveedoridcamp' name='id' value="+data.id+">";
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = data.cel_movi+' '+data.cel_claro;
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = data.representante;
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = "<button type='button' id='buscarcliente' onclick='seleccionar_proveedor();' data-dismiss='modal' class='btn btn-primary'>Seleccionar</button>";
				contLin++;
			},
			error:function(data)
			{
				console.log('Error '+data);
			}  
		});
	});
});
//buscar proveedor por mail
$(document).ready(function(){
	$("#proveedormailchbuton").click(function(event){
		event.preventDefault();
		var dataId= $("#mailpro").val();
		var token = $("input[name=_token]").val();
		var route = '/admin/products/buscaproveedormail/';
		var parametros = {
			"id" :dataId
		}
		var dataSting = "id="+dataId;
		if (dataId == "") {
			alert('Ingrese datos de busqueda');
			document.getElementById("rucprv").focus();
			return false;
		}
		$.ajax({
			url:route,
			headers:{'X-CSRF-TOKEN':token},
			type:'get',
			dataType: 'json',
			data:parametros,
			success:function(data)
			{
				document.getElementById("rucprv").value = "";
				document.getElementById("tabla_proveedor").deleteRow(0);
				var contLin = 3;
				var tr, td, tabla;
				tabla = document.getElementById('tabla_proveedor');
				tr = tabla.insertRow(tabla.rows.length);
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = td.innerHTML = data.mail+"<input type='hidden' id='cel_movicamp' name='cel_movi' value="+data.cel_movi+"><input type='hidden' id='cel_clarocamp' name='cel_claro' value="+data.cel_claro+"><input type='hidden' id='proveedorcamp' name='proveedor' value="+data.proveedor+"><input type='hidden' id='mailcamp' name='mail' value="+data.mail+"><input type='hidden' id='representantecamp' name='representante' value="+data.representante+"><input type='hidden' id='proveedoridcamp' name='id' value="+data.id+">";
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = data.cel_movi+' '+data.cel_claro;
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = data.representante;
				td = tr.insertCell(tr.cells.length);
				td.innerHTML = "<button type='button' id='buscarcliente' onclick='seleccionar_proveedor();' data-dismiss='modal' class='btn btn-primary'>Seleccionar</button>";
				contLin++;
			},
			error:function(data)
			{
				console.log('Error '+data);
			}  
		});
	});
});


function seleccionar_proveedor(){
	resetproveedor();
	var empresa = document.getElementById("representantecamp").value;
	var id = document.getElementById("proveedoridcamp").value;
	var nom = document.getElementById("proveedorcamp").value;
	var mail = document.getElementById("mailcamp").value;
	var celmovi = document.getElementById("cel_movicamp").value;
	var celclaro = document.getElementById("cel_clarocamp").value;
	document.getElementById("id_proveedor").value = id;
	document.getElementById("nom_pro").value = empresa;
	document.getElementById("mail").value = mail;
	document.getElementById("empresa").value = nom;
	document.getElementById("contactos").value = celmovi+' '+celclaro;
}

function resetproveedor(){	
	document.getElementById("id_proveedor").value = "";
	document.getElementById("nom_pro").value = "";
	document.getElementById("mail").value = "";
	document.getElementById("empresa").value = "";
	document.getElementById("contactos").value = "";
}

$(document).ready(function(){
	$("#resetproveedor").click(function(event){
		resetproveedor();
	});
});
//Selecciona cliente en el modal y envia datos a los campos midleware:admin
$('.select_cli').click(function(){
			reset_input();
	var dataId = this.id;
	var token = $("input[name=_token]").val();
	var route = '/admin/extraerdatoscli/';
	var parametros = {
		"id" :dataId
	}
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'get',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			//data.cel_movi
			console.log(data.id);
			console.log("copy data selected");
			document.getElementById("cliente").value = data.nom_cli+' '+data.app_cli;
			document.getElementById("ruc_cli").value = data.ruc_cli;
			document.getElementById("ced_cli").value = data.ced_cli;
			document.getElementById("cel_cli").value = data.tlf_cli+' '+data.wts_cli;
			document.getElementById("dir_cli").value = data.dir_cli;
			document.getElementById("mail_cli").value = data.mail_cli;
			document.getElementById("id_cliente").value = data.id;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
});

//Selecciona cliente en el modal y envia datos a los campos midleware:person
$('.select_cli_person').click(function(){
			reset_input();
	var dataId = this.id;
	var token = $("input[name=_token]").val();
	var route = '/person/extraerdatoscli/';
	var parametros = {
		"id" :dataId
	}
	$.ajax({
		url:route,
		headers:{'X-CSRF-TOKEN':token},
		type:'get',
		dataType: 'json',
		data:parametros,
		success:function(data)
		{
			//data.cel_movi
			console.log(data.id);
			console.log("copy data selected");
			document.getElementById("cliente").value = data.nom_cli+' '+data.app_cli;
			document.getElementById("ruc_cli").value = data.ruc_cli;
			document.getElementById("ced_cli").value = data.ced_cli;
			document.getElementById("cel_cli").value = data.tlf_cli+' '+data.wts_cli;
			document.getElementById("dir_cli").value = data.dir_cli;
			document.getElementById("mail_cli").value = data.mail_cli;
			document.getElementById("id_cliente").value = data.id;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
});

$('.reset_cli').click(function(){
	
	console.log('loading ... reset');
	document.getElementById("cliente").value = "";
	document.getElementById("ruc_cli").value = "";
	document.getElementById("ced_cli").value = "";
	document.getElementById("cel_cli").value = "";
	document.getElementById("dir_cli").value = "";
	document.getElementById("mail_cli").value = "";
	document.getElementById("id_cliente").value = "";
	console.log('reset finally');
});

/*$('.cliente-final').click(function(){
			console.log('loading ... cliente final');
			document.getElementById("cliente").value = "CONSUMIDOR FINAL";
			document.getElementById("ruc_cli").value = "00000000000000";
			document.getElementById("cc_cli").value = "00000000000";
			document.getElementById("cel_cli").value = "";
			document.getElementById("dir_cli").value = "";
			document.getElementById("mail_cli").value = "";
			document.getElementById("id_cliente").value = "1";
			console.log('cliente final finally');
		});*/

		function reset_input(){
			console.log('reseting');
			document.getElementById("cliente").value = "";
			document.getElementById("ruc_cli").value = "";
			document.getElementById("ced_cli").value = "";
			document.getElementById("cel_cli").value = "";
			document.getElementById("dir_cli").value = "";
			document.getElementById("mail_cli").value = "";
			document.getElementById("id_cliente").value = "";
		}

		$(".cliente-final").click(function(event){
			event.preventDefault();
			reset_input();
			var dataId= "1";
			var token = $("input[name=_token]").val();
			var route = '/admin/getClienteId/';
			var parametros = {
				"id" :dataId
			}
			$.ajax({
				url:route,
				headers:{'X-CSRF-TOKEN':token},
				type:'post',
				dataType: 'json',
				data:parametros,
				success:function(data)
				{
					console.log('loading ... cliente final');
					document.getElementById("cliente").value = data.nom_cli;
					document.getElementById("ruc_cli").value = data.ruc_cli;
					document.getElementById("ced_cli").value = data.ced_cli;
					document.getElementById("cel_cli").value = data.tlf_cli;
					document.getElementById("dir_cli").value = data.dir_cli;
					document.getElementById("mail_cli").value = data.mail_cli;
					document.getElementById("id_cliente").value = data.id;
				},
				error:function(data)
				{
					console.log('Error '+data);
				}  
			});
		});
//Registra un nuevo cliente desde el modal admin
$(".save_cli").click(function(event){
			event.preventDefault();
			reset_input();
			var nom_cli= $("#nom_cli").val();
			var app_cli= $("#app_cli").val();
			var ced_cli= $("#ced_cli").val();
			var ruc_cli= $("#ruc_cli").val();
			var dir_cli= $("#dir_cli").val();
			var mail_cli= $("#mail_cli").val();
			var tlf_cli= $("#tlf_cli").val();
			var token = $("input[name=_token]").val();
			var route = '/admin/savecli/';
			var parametros = {
				"nom_cli" :nom_cli,
				"app_cli" :app_cli,
				"ced_cli" :ced_cli,
				"ruc_cli" :ruc_cli,
				"dir_cli" :dir_cli,
				"mail_cli" :mail_cli,
				"tlf_cli" :tlf_cli
			}
			$.ajax({
				url:route,
				headers:{'X-CSRF-TOKEN':token},
				type:'post',
				dataType: 'json',
				data:parametros,
				success:function(data)
				{
					console.log('loading ... cliente final');
					document.getElementById("cliente").value = data.nom_cli;
					document.getElementById("ruc_cli").value = data.ruc_cli;
					document.getElementById("ced_cli").value = data.ced_cli;
					document.getElementById("cel_cli").value = data.tlf_cli;
					document.getElementById("dir_cli").value = data.dir_cli;
					document.getElementById("mail_cli").value = data.mail_cli;
					document.getElementById("id_cliente").value = data.id;
				},
				error:function(data)
				{
					console.log('Error '+data);
				}  
			});
		});
//Registra un nuevo cliente desde el modal person
$(".save_cli_person").click(function(event){
	console.log("operacion guardar cliente");
			event.preventDefault();
			reset_input();
			var nom_cli= $("#nom_cli").val();
			var app_cli= $("#app_cli").val();
			var ced_cli= $("#ced_cli").val();
			var ruc_cli= $("#ruc_cli").val();
			var dir_cli= $("#dir_cli").val();
			var mail_cli= $("#mail_cli").val();
			var tlf_cli= $("#tlf_cli").val();
			var token = $("input[name=_token]").val();
			var route = '/person/savecli/';
			var parametros = {
				"nom_cli" :nom_cli,
				"app_cli" :app_cli,
				"ced_cli" :ced_cli,
				"ruc_cli" :ruc_cli,
				"dir_cli" :dir_cli,
				"mail_cli" :mail_cli,
				"tlf_cli" :tlf_cli
			}
			$.ajax({
				url:route,
				headers:{'X-CSRF-TOKEN':token},
				type:'post',
				dataType: 'json',
				data:parametros,
				success:function(data)
				{
					console.log('loading ... cliente final');
					document.getElementById("cliente").value = data.nom_cli;
					document.getElementById("ruc_cli").value = data.ruc_cli;
					document.getElementById("ced_cli").value = data.ced_cli;
					document.getElementById("cel_cli").value = data.tlf_cli;
					document.getElementById("dir_cli").value = data.dir_cli;
					document.getElementById("mail_cli").value = data.mail_cli;
					document.getElementById("id_cliente").value = data.id;
				},
				error:function(data)
				{
					console.log('Error '+data);
				}  
			});
		});
//Boton id=select_prod de la modalselect_prod obtiene los datos de la fila seleccionada envia por ajax al controlador ComponetController funcion addItem y guarda en la tabla item_ventas
$('.select_prod').click(function(){
	var dataId = this.id;
	var idventa= $("#idventa").val();
	var token = $("input[name=_token]").val();
	var route = '/admin/saveprod/';	
	var id = $(this).parents("tr").find("td")[0].innerHTML;
	var prod = $(this).parents("tr").find("td")[2].innerHTML;
	var codbarra = $(this).parents("tr").find("td")[4].innerHTML;
	var precio = $(this).parents("tr").find("td")[5].innerHTML;
	var stock = $(this).parents("tr").find("td")[6].innerHTML;
	var cantidad = $(this).parents("tr").find('#cant_prod').val();
	var total = cantidad*precio;
	/*if(cantidad>stock){
		alert("Error!!!...La cantidad seleccionada supera al stock actual. No se puede agregar esta cantidad");
		return false;
	}*/
	//console.log(nombre);
	var parametros = {
		"id" :dataId,
		"idproducto" :id,
		"nombre" :prod,
		"codbarra" :codbarra,
		"precio" :precio,
		"cantidad" :cantidad,
		"total" :total,
		"idventa": idventa
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
			console.log("copy data selected");
			console.log("copy data succefull");
		    items_cart();
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
});

//llena de datos tabla productos en la modal
function items_cart(){
	console.log('loading items cart');
	$.ajax({
		type:'get',
		url:'/admin/listcartitems/',
		success: function(data){
			$('#list-cart').empty().html(data);
		}
	});
}

//llena de datos tabla productos en la modal
function items_cart_person(){
	console.log('loading items cart');
	$.ajax({
		type:'get',
		url:'/person/listcartitems/',
		success: function(data){
			$('#list-cart').empty().html(data);
		}
	});
}

function delete_item(id){
	var token = $("input[name=_token]").val();
	var route = '/admin/deleteItem/';	
	var parametros = {
		"id" :id
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
			items_cart();	
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}

function trash(id){
	console.log(id);
	var token = $("input[name=_token]").val();
	var route = '/admin/trashItem/';	
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
			items_cart();	
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}

//llena de datos tabla temporal subcuentas en modulo contable
function list_subcuentas(){
	console.log('loading items subcuentas');
	$.ajax({
		type:'get',
		url:'/admin/listsubcuentas/',
		success: function(data){
			$('#list-cart').empty().html(data);
		}
	});
}

//Guardar datos de sub-cuenta en la tabla temporal
$('.guarda_subcuenta').click(function(){
	var cuenta_id= $("#cuenta_id").val();
	var cuenta= $("#cuenta").val();
	var secuencia= $("#secuencia").val();
	var subcuenta= $("#subcuenta").val();
	var codigo= $("#codigo").val();
	var token = $("input[name=_token]").val();
	var route = '/admin/savesubcuenta/';

	/*var codigo = $(this).parents("tr").find("td")[0].innerHTML;
	var subcuenta = $(this).parents("tr").find("td")[1].innerHTML;
	var cuenta_id = $(this).parents("tr").find("td")[2].innerHTML;
	var secuencia = $(this).parents("tr").find("td")[3].innerHTML;
	*/

	var parametros = {
		"subcuenta" :subcuenta,
		"cuenta" :cuenta,
		"cuenta_id" :cuenta_id,
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
		    list_subcuentas();
		    reset_input_subcuentas();
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
});

function trashSubCuentas(id){
	console.log(id);
	var token = $("input[name=_token]").val();
	var route = '/admin/trashSubcuentas/';	
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
			list_subcuentas();	
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});
}

function reset_input_subcuentas(){
			console.log('reseting');
			document.getElementById("subcuenta").value = "";
			document.getElementById("cuenta").value = "";
			document.getElementById("secuencia").value = "";
			document.getElementById("codigo").value = "";
		}