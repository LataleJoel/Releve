	$(document).ready(function() {
		$('.datatable_custom').dataTable({
			"oLanguage": {
				"sUrl": "application/javascript/dataTables.french.txt"
			}
		});
	
		// Si l'élément accordion existe
		if($("#accordion").length){

			$( "#accordion" ).accordion({
				collapsible: true
			});
		}
});