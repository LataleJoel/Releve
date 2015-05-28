$("#releveForm form").first().submit(function(){
	retour = true;
	
	// $("#releveForm input").each(function(){
		//console.log(this.value);
		// $(this).removeClass("erreur");
		// if(this.value.trim()===""){
			// setMessage("Veuillez remplir l'élément "+this.attributes.errorLabel.value);
			// console.log("Erreur "+this.id);
			// $(this).addClass("erreur");
			// retour = false;
			// return false;
		// }
	// });
	// if(!retour) return false;
	var nom = $("#nom");
	if(login.val().length < 4){
		setMessage("Votre login doit avoir au moins 4 caractères");
		login.addClass("erreur");
		retour = false;
		return false;
	}
	return retour;
});
			
function setMessage(msg){
	var message = $("#utilisateurForm form > p").get(0);
	if(message===undefined){
		$("<p>"+msg+"</p>").prependTo('#utilisateurForm form');
	}
	else{
		message.innerHTML = msg;
	}
}
