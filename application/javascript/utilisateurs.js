$("#utilisateurForm form").first().submit(function(){
	var retour = true;
	
	var previous = null;
	var isCreation = true;
	if($("input[name=id]").attr('value')!=0){
		isCreation = false;
	}

	// Enleve le texte dans la balise correspondante au message
	cleanMessage();
	// Actuellement, on n'affiche qu'un seul message d'erreur 
	$("#utilisateurForm dl input").each(function(){

		// Enleve la classe erreur de l'élement en cours, si elle existe
		if($(this).attr('class')=="erreur"){
			$(this).removeClass("erreur");
		}
		
	
		
		// Test sur login : seulement en création
		if($(this).attr('name')=='login'){
			if(isCreation){
				if(this.value.trim().length<4){
					setMessage("L’élément : "+this.attributes.errorLabel.nodeValue+" doit être de plus de 4 caractères !");
					$(this).addClass("erreur");
					retour = false;
				}
			}
		}
		
		// Test sur nom & prenom
		if(($(this).attr('name')=='nom') || ($(this).attr('name')=='prenom')){
			if(this.value.trim()===""){
				if(($(this).attr('name')!='motdepasse') && ($(this).attr('name')!='confirmation'))
				setMessage("L’élément : "+this.attributes.errorLabel.nodeValue+" ne doit pas être vide !");
				$(this).addClass("erreur");
				retour = false;
			}
		}
		
		// Test sur email
		if($(this).attr('name')=='email'){
			if(!isValidEmailAddress(this.value.trim())){
				setMessage("L’élément : "+this.attributes.errorLabel.nodeValue+" n'est pas valide !");
				$(this).addClass("erreur");
				retour = false;
			}
		}
		
		if($(this).attr('name')=='password'){
			// Test sur mot de passe : en création
			if(isCreation){
				if(this.value.trim().length<7){
					setMessage("L’élément : "+this.attributes.errorLabel.nodeValue+" doit être de plus de 7 caractères !");
					$(this).addClass("erreur");
					retour = false;
				}	
			}// Test sur mot de passe : en édition
			else{
				if(this.value.trim().length!=0){
					if(this.value.trim().length<7){
						setMessage("L’élément : "+this.attributes.errorLabel.nodeValue+" doit être de plus de 7 caractères !");
						$(this).addClass("erreur");
						retour = false;
					}	
				}
			}
			previous = this;
		}
		
		// Test sur la confirmation
		if($(this).attr('name')=='confirmation'){
			if(previous != null){
				if(this.value.trim() != previous.value.trim())
				{
					setMessage("L’élément : "+this.attributes.errorLabel.nodeValue+" n'est pas conforme avec le mot de passe saisi !");
					$(this).addClass("erreur");
					retour = false;
				}
			}
		}
		
		/* TEST INUTILE : "AMELIORATION" : On réalise les test fait en php ci dessus
		// Teste si l'élément en cours est vide
			if(this.value.trim()===""){
				
				setMessage("Veuillez remplir l’élément : "+this.attributes.errorLabel.nodeValue+" !");
				$(this).addClass("erreur");
				retour = false;
			}
		}
		*/
	});
	return retour;
});

function setMessage(msg){
	var message = $("#utilisateurForm form > p").get(0);
	if(message===undefined){
		$("<p>"+msg+"</p>").prependTo('#utilisateurForm form');
	} else {
		message.innerHTML += msg+"<br>";
	}
}

function cleanMessage(){
var message = $("#utilisateurForm form > p").get(0);
	if(message===undefined){
		$("<p></p>").prependTo('#utilisateurForm form');
	} else {
		message.innerHTML = "";
	}
}

// http://stackoverflow.com/questions/2855865/jquery-regex-validation-of-e-mail-address
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};