$("#provincia_id").change(function(event){
	$.get("getcanton/"+event.target.value+"",function(response, state){
		$("#canton_id").empty();
		for(i=0; i<response.length; i++){
			$("#canton_id").append("<option value='"+response[i].id+"'> "+response[i].canton+"</option>");
		}
	});
});

/*
$("#id_provincia").change(function(event){
	var url = '{{ url("getcanton") }}';
	$.get(url+"/"+event.target.value+"",function(response, state){
		$("#id_canton").empty();
		for(i=0; i<response.length; i++){
			$("#id_canton").append("<option value='"+response[i].id+"'> "+response[i].canton+"</option>");
		}
	});
});
*/

/*$("#provincia_id").change(event=>{
	$.get('getcanton/${event.target.value}', function(res, sta){
		$("#provincia_id").empty();
		res.forEach(element=>{
			$("#canton_id").append('<option value=${element.id}>${element.canton} </option>');
		});
	});
});*/
 $(document).ready(function(){
 	$("#mailsearchbuton").click(function(event){
 		event.preventDefault();
 		var dataId= $("#mailcli").val();
 		var token = $("input[name=_token]").val();
 		var route = '/admin/client/buscarpormail/';
 		var parametros = {
 			"id" :dataId
 		}
 		var dataSting = "id="+dataId;
 		if (dataId == "") {
 			alert('Ingrese datos de busqueda');
 			document.getElementById("mailcli").focus();
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
 				document.getElementById("mailcli").value = "";
 				document.getElementById("tabla").deleteRow(0);
 				console.log('Si '+data.id);
 				var contLin = 3;
 				var tr, td, tabla;
 				tabla = document.getElementById('tabla');
 				tr = tabla.insertRow(tabla.rows.length);
 				td = tr.insertCell(tr.cells.length);
 				td.innerHTML = td.innerHTML = data.nom_cli+' '+data.app_cli+"<input type='hidden' id='idcamp' name='idcamp' value="+data.id+">";
 				td = tr.insertCell(tr.cells.length);
 				td.innerHTML = data.mail+' '
 				+"<input type='hidden' id='nomcamp' name='nomcamp' value="+data.nom_cli+"><input type='hidden' id='appcamp' name='appcamp' value="+data.app_cli+"><input type='hidden' id='cicamp' name='cicamp' value="+data.ci_cli+"><input type='hidden' id='mailcamp' name='mailcamp' value="+data.mail+">";
 				td = tr.insertCell(tr.cells.length);
 				td.innerHTML = data.cel+"<input type='hidden' id='dircamp' name='dircamp' value="+data.dir+"><input type='hidden' id='celcamp' name='celcamp' value="+data.cel+"><input type='hidden' id='mailcamp' name='mailcamp' value="+data.mail+">";
 				td = tr.insertCell(tr.cells.length);
 				td.innerHTML = data.tlfn;
 				td = tr.insertCell(tr.cells.length);
 				td.innerHTML = "<button type='button' id='buscarcliente' onclick='seleccionar();' data-dismiss='modal' class='btn btn-primary'>Seleccionar</button>";
 				//type="button" class="btn btn-default pull-left" data-dismiss="modal"
 				contLin++;
 				//manageRow(data.data);onclick="window.close();"
 			},
 			error:function(data)
 			{
 				console.log('Error '+data);
 			}  
 		});
 	});
 });



