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
			$('#actividades').show(1500);
		}
	}); 
}
