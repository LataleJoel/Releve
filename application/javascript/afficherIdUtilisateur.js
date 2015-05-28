//Il s'agit de reactualiser tous les champs du modal bouton Fermer
$("#test2").click(function() {
    
   
    //Remplissage de la vue utilisateur.view

    $("#addmodal #nom")
            .val('').removeAttr("disabled"); //on vide le champ

    $(".modal-header #titre").text(''); //On efface le titre precedemment affiche

     $('#type_utilisateur1').replaceWith();

    //On ajoute un nouveau titre
    $(".modal-header #titre")
            .append("&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-user'></span>&nbsp;&nbsp;&nbsp;&nbsp;Création d'utilisateur"); //On ajoute un titre au modal lors de la consultation d'une fiche

    // On vide les input en leur ajoutant une chaine vide
    $("#addmodal #prenom").val('').removeAttr("disabled");
    ;
    $("#addmodal #mail").val('').removeAttr("disabled");
    $("#addmodal #pseudonyme").val('').removeAttr("disabled");
    $("#addmodal #telephone").val('').removeAttr("disabled");
    $("#addmodal #mdp").empty().val('').removeAttr("disabled");
    $("#addmodal #adresse").empty().val('').removeAttr("disabled");
    $("#addmodal #type_utilisateur").removeAttr("disabled");
    
    $("#creer1").modal("hide");
    $("#btnEnreg").show();
    //alert($(this).parent().find("#identifiant").val());
    return false;
});


//Il s'agit de charger tous les champs du modal bouton Afficher
$("td #test").click(function() {
     
    var adresse = $("#adres").attr("value");
        typeUtilisateur = $("#typeUtilisateur").attr("value");
    
	//On cache le bouton enregistrer
    $(".modal-footer *9*zzzzAfficheBtn #btnEnreg").hide();
   
   //On remplace le select par un input contenant le type utilisateur
    $('#type_utilisateur').replaceWith('<input type="text" class="form-control" value='+typeUtilisateur   +' disabled>').attr("disabled","disabled");
   
    //Remplissage de la vue utilisateur.view

    $("#addmodal #nom")
            .empty() //on vide le champ
            .val(//on va affecter la valeur entre parenthèse
                    $(this).parent().parent().parent() //on monte de balise en balise pour arriver dans la balise où se trouve la valeur qui nous interesse
                    //==> button>td>tr , dans le tr nous avons la balise qui nous interesse
                    .find("#nom").text() //on recupère le text dans la balise ayant l'identifiant "nom"
                    )
            .attr("disabled", "disabled");//on desactive le champ 

    $(".modal-header #titre").text(''); //On efface le titre precedemment affiche

    $(".modal-header #titre")
            .append("&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-user'></span>&nbsp;&nbsp;&nbsp;&nbsp;Fiche utilisateur"); //On ajoute un titre au modal lors de la consultation d'une fiche


    

    $("#addmodal #prenom").empty().val($(this).parent().parent().parent().find("#prenom").text()).attr("disabled", "disabled");
    $("#addmodal #mail").empty().val($(this).parent().parent().parent().find("#mail").text()).attr("disabled", "disabled");
    $("#addmodal #pseudonyme").empty().val($(this).parent().parent().parent().find("#login").text()).attr("disabled", "disabled");
    $("#addmodal #telephone").empty().val($(this).parent().parent().parent().find("#telephone").text()).attr("disabled", "disabled");
    $("#addmodal #mdp").empty().val("******************").attr("disabled", "disabled");
    $("#addmodal #adresse").empty().val(adresse).attr("disabled", "disabled");
    $("#addmodal #type_utilisateur").val($(this).parent().parent().parent().find("#type_utilisateur").text()).attr("disabled", "disabled");
   
    
  
    $("#creer1").modal("show");
    //alert($(this).parent().find("#identifiant").val());
    return false;
});


$("td #test3").click(function() {
// AJOUTER L'ELEVE AU TABLEAU
var idUtilisateur = $( "#identifiant");
    alert('son id est '+idUtilisateur.val());
   
});