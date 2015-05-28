// SUPPRIMER 1 LIGNE DU TABLEAU
var liste_add_eleve = [];

function supprimer(id_to_sup,code_eleve_to_sup){
	$("#liste_eleves_releve").dataTable().fnDeleteRow( id_to_sup-1 );
	var index = liste_add_eleve.indexOf(code_eleve_to_sup);
	alert(code_eleve_to_sup);
	alert(index);
	if (index > -1) {
		liste_add_eleve.splice(index, 1);
	}
}

$(document).ready(function() {
	
	var is_present_in = false;

	// AJOUTER LES INFOS DU RELEVE
	var element = $( "#releve_epreuve" );
			element.change(function() {
			//alert( "Handler for .change() called." );
				if(element.val() != 0){
					$.get(
						'index.php',
						{
							controller:'releves',
							action:'detail',
							id:element.val()
						},
						function (data){
						
						var obj = jQuery.parseJSON(data);
				
							// Récupération de l'ajax : infos de l'id passé en param
							$("#releve_matiere").val(obj.code_matiere);
							$("#releve_type_devoir").val(obj.code_type_epreuve);
							$("#releve_enseignant").val(obj.code_utilisateur);
							$("#releve_cursus").val(obj.cursus);
							$("#releve_niveau").val(obj.niveau);
							
							// Créé un Date au format SQL ( yyyy-MM-dd)
							var d=new Date(obj.date_creation);
							var curr_date = d.getDate();
							var curr_month = d.getMonth() + 1; //Months are zero based
							var curr_year = d.getFullYear();
							
							// Formate la date au format : dd/mm/yyyy
							$("#releve_date_devoir").val(curr_date + "/" + curr_month + "/" + curr_year);
						}
					);
				}
				else
				{
					// Si = 0 on fait quoi ?
				}
			});
		
	// AJOUTER L'ELEVE AU TABLEAU
	var button_eleve = $( "#releve_button_add_eleves");
	var liste_eleve = $( "#releve_all_eleves");
	var giCount = 1;
		button_eleve.click(function(){

			if(liste_eleve.val() != 0){
				$.get(
					'index.php',
					{
						controller:'releves',
						action:'ajout_eleves',
						id:liste_eleve.val()
					},
					function (data){
						var obj = jQuery.parseJSON(data);
						is_present_in = false;
						for(var j in liste_add_eleve)
						{
							if(liste_add_eleve[j] == obj.code_eleve)
								is_present_in = true;
						}
								
						if(!is_present_in)
						{
							$('#liste_eleves_releve').dataTable().fnAddData( [
							giCount,
							obj.nom+" "+obj.prenom,
							'<input type="hidden" name="eleve_id_"'+giCount+'" id="eleve_id_"'+giCount+'" value="'+obj.code_eleve+'" />',
							"",
							'<button type="button" id="'+obj.code_eleve+'" name="action" value="supprimer" class="btn btn-primary btn-xs" onClick="supprimer('+giCount+','+obj.code_eleve+')"><span class="glyphicon glyphicon-remove"></span></button>'] );
						 
							giCount++;
							liste_add_eleve.push(obj.code_eleve);
						}
					}
				);
		
			} 
		});
		
	// Ajouter UN GROUPE AU TABLEAU
	var button_groupe = $( "#releve_button_add_groupes");
	var liste_groupe = $( "#releve_all_groupes");
		button_groupe.click(function(){
		
			if(liste_groupe.val() != 0){
				
				$.get(
					'index.php',
					{
						controller:'releves',
						action:'ajout_groupe_eleves',
						id:liste_groupe.val()
					},
					function (data){
						
						var obj = jQuery.parseJSON(data);
						for(var i in obj)
						{
						
							 is_present_in = false;
						
							for(var j in liste_add_eleve)
							{
								if(liste_add_eleve[j] == obj[i].code_eleve)
									is_present_in = true;
							}
								
							if(!is_present_in)
							{
								$('#liste_eleves_releve').dataTable().fnAddData( [
								giCount,
								obj[i].nom+" "+obj[i].prenom,
								'<input type="hidden" name="eleve_id_"'+giCount+'"  id="eleve_id_"'+giCount+'" value="'+obj[i].code_eleve+'" />',
								"",
								'<button type="button" name="action" value="supprimer" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-remove"></span></button>'] );
							 
								giCount++;
								liste_add_eleve.push(obj[i].code_eleve);
							}
						}
					}
				);
			} 
		});
		
	// Datepickers : date du devoir et date de rendu
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	
	$( "#releve_date_devoir" ).datepicker();
	$( "#releve_date_retour" ).datepicker({
			onRender: function(date) {
		return date.valueOf() < now.valueOf() ? 'disabled' : '';
	  }
	});
		
	// SUBMIT
	$("#createReleve").first().submit(function(){
		var retour = true;

		if(retour == true)
		{
			var input = $("<input>").attr("type", "hidden").attr("name", "max_input").val(giCount);
			var input2 = $("<input>").attr("type", "hidden").attr("name", "max_input").val(liste_add_eleve);
			$('#createReleve').append($(input));
			$('#createReleve').append($(input2));
		}
		return retour;
	});

});


