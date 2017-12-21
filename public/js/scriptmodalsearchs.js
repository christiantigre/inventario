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