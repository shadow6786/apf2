function get_actividades(gestion)
{
	var url="../ajax/activity.php?gestion="+gestion;
	$.ajax({
		type : "POST",
		url : url,
		data : {},
		success : function(datos) {
			$('#actividades').html('');
			$('#actividades').html(datos);
			$('#actividades').show();
		}
	}); 
}
function get_circulares(gestion, tipo)
{
	var url = "../ajax/circulares.php";
	$.ajax({
		type: "POST",
		url: url,
		data: {ges: gestion, tip: tipo},
		success: function(datos){
			$('#circulares_lista').html("");
			$('#circulares_lista').html(datos);
			$('#circulares_lista').show();
		}
	});
}