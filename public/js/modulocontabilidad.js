
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
			console.log("copy data selected");
			//document.getElementById("codigo").value = data.cantidad;
			console.log("copy data succefull");
		},
		error:function(data)
		{
			console.log('Error '+data);
		}  
	});

}




