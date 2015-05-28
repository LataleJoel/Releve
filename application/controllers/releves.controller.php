<?php
defined('__ERELEVE__') or die('Acces interdit');
require_once('application/data/epreuves.data.php');
require_once('application/data/type_epreuves.data.php');
require_once('application/data/matieres.data.php');
require_once('application/data/utilisateurs.data.php');
require_once('application/data/groupes.data.php');
require_once('application/data/eleves.data.php');
require_once('application/data/releves.data.php');
require_once('application/data/evaluations.data.php');

class RelevesController extends Controleur {

	public function __construct(){
		$this->setActionParDefaut("listerEns");
	}

	public function listerEnsAction(){
		if($_SESSION['framework3il.type'] != 3)
			$this->rediriger('index.php');
		$releves = new Releves();
		$statut = strtolower(Requete::get('statut','nouveau'));
		$promotion = strtolower(Requete::get('promotion'));
		//var_dump($statut);
		if(in_array($statut,array('nouveau','brouillon','attente','traite')) === false){
			$statut = 'nouveau';
		}
		$page = Page::getPage();
		$page->setTemplate('application');

		$page->setVue('releves_ens');
		$page->type_user = 'ens';
		if(in_array($promotion,array('I1','I2','I3','M1', 'M2', 'M3', 'B1', 'B2')))
		{
			$page->releve = $releves->listeRelevesEnsPromo($promotion);
		}
		else
		$page->releve = $releves->listeRelevesEns($statut);

		
	}	
	
	public function listerSgpAction(){
		if($_SESSION['framework3il.type'] != 2)
			$this->rediriger('index.php');
		$releves = new Releves();
		$statut = strtolower(Requete::get('statut','nouveau'));
		$promotion = strtolower(Requete::get('promotion'));
		//var_dump($statut);
		if(in_array($statut,array('nouveau','brouillon','attente','traite')) === false){
			$statut = 'nouveau';
		}
		$page = Page::getPage();
		$page->setTemplate('application');

		$page->setVue('releves_sgp');
		$page->type_user = 'sgp';
		if(in_array($promotion,array('I1','I2','I3','M1', 'M2', 'M3', 'B1', 'B2')))
		{
			$page->releve = $releves->listeRelevesSgpPromo($promotion);
		}
		else
		$page->releve = $releves->listeRelevesSgp($statut);

	}
	
	public function editerAction($edition = true){
		if($_SESSION['framework3il.type'] != 2)
			$this->rediriger('index.php');
		$epreuve = new Epreuves();
		$type_epreuve = new Type_epreuves();
		$matiere = new Matieres();
		$enseignants = new Utilisateurs();
		$groupe = new Groupes();
		$eleve = new Eleves();
		$releve = new Releves();
		$evaluation = new Evaluations();
		$page = Page::getPage();
		$page->setTemplate('application');
		$page->setVue('releve');
		$page->ajouterCSS('datepicker');
		$page->ajouterCSS('creation_releves');
		$page->ajouterScript('bootstrap-datepicker');
		$page->ajouterScript('releve_creation');
		$page->id = 0;
		
		$page->epreuve = '';
		$page->type_epreuve = '';
		$page->matiere = '';
		$page->enseignant = '';
		$page->groupe = '';
		
		$page->liste_epreuves = '';
		$page->liste_type_epreuves = '';
		$page->liste_matieres = '';
		$page->liste_enseignants = '';
		$page->liste_groupes = '';
		$page->liste_eleves = '';
		
		if($edition == true)
		{
			$page->id = Requete::get('id', 0);
			$page->action = "editer";
			$page->titre = "Edition du relevé";
		}
		else
		{
			$page->action = "creer";
			$page->titre = "Nouveau relevé";
		}
		
		$page->liste_epreuves = $epreuve->lister();
		$page->liste_type_epreuves = $type_epreuve->lister();
		$page->liste_matieres = $matiere->lister();
		$page->liste_enseignants = $enseignants->listerEnseignants();
		$page->liste_groupes = $groupe->lister();
		$page->liste_eleves = $eleve->lister();
		
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$page->id  =  Requete::post('id', 0);
			if(!filter_var($page->id,FILTER_VALIDATE_INT))
				$page->id = 0;
				
			$page->epreuve = Requete::post('releve_epreuve');
			$page->type_epreuve = Requete::post('releve_epreuve');
			$page->matiere = Requete::post('releve_type_devoir');
			$page->enseignant = Requete::post('releve_enseignant');
			
			$page->date_retour = Requete::post('releve_date_retour');
	
			// Creer le relevé et récupère l'id
			$page->id_releve = $releve->creer($page->enseignant, $page->date_retour);
			
			$page->max_input = Requete::post('max_input');
			
			$page->all_id_eleve = explode(',',$page->max_input);
			
			// Creer une évaluation à vide pour chaque eleve
			foreach((array)$page->all_id_eleve as $id_eleve)
			{
				$evaluation->creer($id_eleve,$page->epreuve,$page->id_releve);
			}
			
		}
		
	}
	
	public function creerAction(){
		$this->editerAction(false);
	}
	
	public function detailAction(){
	
		$epreuve = new Epreuves();
		$page = Page::getPage();
		$page->setTemplate('ajax');
		$page->setVue('releve_ajax');
		$id = Requete::get('id',0);
		if(!filter_var($id,FILTER_VALIDATE_INT)){
			die('');
		}
		
		$page->donnees = $epreuve->epreuve($id);
		
	}
	
	public function ajout_elevesAction(){
		$eleve = new Eleves();
		$page = Page::getPage();
		$page->setTemplate('ajax');
		$page->setVue('releve_ajax');
		
		$id = Requete::get('id',0);
		if(!filter_var($id,FILTER_VALIDATE_INT)){
			die('');
		}
		$page->donnees = $eleve->eleve($id);
	}
	
	public function ajout_groupe_elevesAction(){
		$eleve = new Eleves();
		$page = Page::getPage();
		$page->setTemplate('ajax');
		$page->setVue('releve_ajax');
		
		$id = Requete::get('id','');
		if($id==''){
			die('');
		}
		$page->donnees = $eleve->eleveByGroupe($id);
	}
	
		public function editerEnseignantAction(){
			if($_SESSION['framework3il.type'] != 3)
			$this->rediriger('index.php');
		$releves = new Releves();
		$page = Page::getPage();
		$page->setTemplate('application');
		$page->setVue('releve_enseignant');
		$page->id = 0;
		$page->eleve = array();
		$page->nom = array();
		$page->note = array();
		$page->commentaire = array();
		
		$page->id = filter_var(requete::get('id',0),FILTER_VALIDATE_INT);
		if($page->id != 0){
				$page->eleve = $releves->elevesEpreuve($page->id);
		}
		//recupération des données du formulaire
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
			$page->id = filter_var(requete::post('id',0),FILTER_VALIDATE_INT);
			$eval = new Evaluations();
			if($page->id == 0){
					throw new Erreur("Erreur : id non renseigné !");
			}
				$page->eleve = $releves->elevesEpreuve($page->id);
				foreach($page->eleve as $listeEleve){
					$inc = $listeEleve['code_eleve'];
					// VERIFICATION DES NOTES & COMMENTAIRES
					if(filter_var(trim(Requete::post('commentaire_'.$inc, '')),FILTER_SANITIZE_STRING) === false){
						$page->erreur = "Votre commentaire n'est pas conforme";
						return;
					}
					
					// UPDATE
					$eval->update(Requete::post('note_'.$inc), Requete::post('commentaire_'.$inc), $inc, $page->id);	
				}
				//die;
				$nbNotes = $eval->nbNotesRemplies();
				$nbId = $eval->nbLignes();
				if($nbNotes == $nbId)
					$releves->updateStatut($page->id,'traité');
				else
					$releves->updateStatut($page->id,'en attente');
				$this->rediriger("index.php?controller=releves&action=listerEns","Relevé rempli");
		}
	}
	
	
	public function supprimerEnseignantAction(){
		$page = Page::getPage();
		//$page->ajouterScript('jquery-1.10.2.min');
		//$page->ajouterScript('jquery-1.10.2.min.map');
		$page->ajouterScript('supprimer.epreuve');
		$page->id = filter_var(requete::get('id',0),FILTER_VALIDATE_INT);
		$utilisateur = new Releves;
		$utilisateur->supprimerReleve($page->id); //je supprime l'epreuve
		$utilisateur->supprimerEvaluation($page->id); //je supprime l'évaluation qui va avec;
		$this->rediriger("index.php?controller=releves&action=lister","Epreuve supprimé");
	}
	
	
	
}

?>