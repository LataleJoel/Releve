<?php

defined('__ERELEVE__') or die('Acces interdit');
require_once 'application/data/typeUtilisateur.data.php';

//session_start();
class UtilisateursController extends Controleur {

    public function __construct() {
        $this->setActionParDefaut("lister");
    }

    protected function _preAction() {
        if (!Authentification::estConnecte())
            $this->rediriger('index.php');
    }

    public function demoAction() {
        $page = Page::getPage();
        $page->setTemplate('application');
        $page->setVue('utilisateurs');
        $page->message = '</br>Coucou depuis un controleur';
    }

    public function listerAction() {

		if($_SESSION['framework3il.type'] != 1)
			$this->rediriger('index.php');
        require_once 'application/data/utilisateurs.data.php';
        $utilisateur = new Utilisateurs();
        $page = Page::getPage();
        $page->ajouterScript('afficherIdUtilisateur');
       // $page->ajouterScript('confirmation_supp_utilisateur');
        $page->message = Message::retirer();
        $tutilisateur = new TypeUtilisateurs();
        $page->listeTypeUser = $tutilisateur->lister();
		$page->etatSelectList = true;
         
        $page->code_utilisateur = Requete::post('id');
        $order = strtolower(Requete::get('order'));

		$page->button = '<a href="index.php?controller=utilisateurs&action=lister" class="btn btn-default">Retour</a><button type="submit" class="btn btn-primary" id="BtnEnreg">Enregistrer</button>';
		
        if (!in_array($order, array('login', 'nom', 'prenom', 'mail', 'type'))) {
            $order = 'login';
        }
        $page->order = $order;

        $dir = strtolower(Requete::get('dir'));

        if (!in_array($dir, array('asc', 'desc'))) {
            $dir = 'asc';
        }
        $page->dir = $dir;
        $page->tri = array("order" => $order, "dir" => $dir);

        $page->setTemplate('application');
        $page->setVue('utilisateurs');
        $page->liste = $utilisateur->lister($page->tri);
    }

    public function testAction() {
        $page = Page::getPage();
        $page->setTemplate('application');
        $page->setVue('utilisateurs');
        $page->message = '</br>Test Etape 4 : Testons';
    }

    public function editerAction($edition = true) {
		if($_SESSION['framework3il.type'] != 1)
			$this->rediriger('index.php');
        require_once("application/data/utilisateurs.data.php");
        $page = Page::getPage();
        $page->setTemplate('application');
        $page->setVue('utilisateur');
        $page->button = '<a href="index.php?controller=utilisateurs&action=lister" class="btn btn-default">Retour</a><button type="submit" class="btn btn-primary" >Enregistrer</button>';
        $u = new Utilisateurs();
        $t = new TypeUtilisateurs();
        $page->code_utilisateur = 0;
		

        if ($edition == true){
            $page->code_utilisateur = filter_var(trim(Requete::get('id')), FILTER_VALIDATE_INT);
            $page->titre="";
        }

        if ($page->code_utilisateur != 0) {
            $page->liste1 = $u->utilisateur(Requete::get('id'));
            $page->code_utilisateur = $page->liste1['code_utilisateur'];
            $page->nom = $page->liste1['nom'];
            $page->prenom = $page->liste1['prenom'];
            $page->adresse = $page->liste1['adresse'];
            $page->mail = $page->liste1['mail'];
            $page->telephone = $page->liste1['telephone'];
            $page->login = $page->liste1['login'];
            $page->mdp = $page->liste1['mdp'];
            $page->codeAttribute = "readonly";
            $page->etatSelectList = false;
            $page->listeTypeUser = $t->listerByID($page->liste1['code_type']);
            $page->boutton = '<a href="index.php?controller=utilisateurs&action=lister" class="btn btn-default">Retour</a><button type="submit" class="btn btn-primary" >Mettre à jour</button>';
            $page->code_type = $page->liste1['code_type'];

            $page->listeTypeUser = $t->listerByID($page->code_type);
        }

        if ($edition == false) {
            $page->codeAttribute = "";
            $page->codeAttribut = "";
            
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $page->listeTypeUser = $t->lister();
            
            $page->code_utilisateur = Requete::post('id', 0);

            $page->type_utilisateur = intval(Requete::post('type_utilisateur', 0));

            $dump = trim(Requete::post('nom'));
            
            if (empty($dump)) {
                $page->message = 'Nom incorrect';
                return;
            } else {
                $page->nom = filter_var(trim(Requete::post('nom')), FILTER_SANITIZE_STRING);
            }

            $dump = trim(Requete::post('prenom'));

            if (empty($dump)) {
                $page->message = 'Prenom incorrect';
                return;
            } else {
                $page->prenom = filter_var(trim(Requete::post('prenom')), FILTER_SANITIZE_STRING);
            }

            $dump = trim(Requete::post('adresse'));

            if (empty($dump)) {
                $page->message = 'Adresse incorrecte';
                return;
            } else {
                $page->adresse = filter_var(trim(Requete::post('adresse')), FILTER_SANITIZE_STRING);
            }

            $dump = trim(Requete::post('email'));

            if (!empty($dump)) {
                $dump = filter_var(trim(Requete::post('email')), FILTER_SANITIZE_EMAIL);
                if (filter_var($dump, FILTER_VALIDATE_EMAIL) === false) {
                    $page->message = "votre adresse mail n'est pas valide";
                    return;
                } else
                    $page->mail = $dump;
            }else {
                $page->message = 'Email incorrect';
                return;
            }


            $dump = trim(Requete::post('telephone'));

            if (empty($dump) || strlen($dump < 10)) {
                $page->message = 'Numéro de telephone incorrect';
                return;
            } else {
                $page->telephone = trim(Requete::post('telephone'));
            }


            $dump = trim(Requete::post('login'));

            if (strlen($dump) < 4) {
                $page->message = 'Login incorrect';
                return;
            } else {
                $page->login = filter_var(trim(Requete::post('login')), FILTER_SANITIZE_STRING);
            }


            $mdp = trim(Requete::post('mdp'));

            if ($mdp != '') {

                $page->mdp = filter_var(trim(Requete::post('mdp')), FILTER_SANITIZE_STRING);
                if ($page->code_utilisateur != 0) {
                    $u->modifier(intval($page->code_utilisateur), $page->nom, $page->prenom, $page->adresse, $page->mail, $page->telephone, $page->mdp);
                    $this->rediriger('index.php?controller=utilisateurs&action=lister', 'Utilisateur modifié');
                } else {

                    $u->creer($page->type_utilisateur, $page->nom, $page->prenom, $page->adresse, $page->mail, $page->telephone, $page->login, $page->mdp);
                    $this->rediriger('index.php?controller=utilisateurs&action=lister', 'Utilisateur enregistré');
                }
            } else {
                $page->message = 'Mot de passe incorrect';
                return;
            }
        }
    }

    public function afficherAction($edition = true) {
		if($_SESSION['framework3il.type'] != 1)
			$this->rediriger('index.php');
        $page = Page::getPage();
		
		$page->liste1 = '';
		$page->code_utilisateur = '';
		$page->nom = '';
		$page->prenom = '';
		$page->adresse = '';
		$page->mail = '';
		$page->telephone = '';
		$page->login = '';
		$page->mdp = '';
		$page->etatSelectList = false;
		$page->code_type = '';
		$page->listeTypeUser = '';
		
        $page->setTemplate('application');
        $page->setVue('utilisateur');
        $u = new Utilisateurs();
        $t = new TypeUtilisateurs();
        $page->code_utilisateur = 0;
        $page->titre = "";
		


        if ($edition == true)
            $page->code_utilisateur = filter_var(trim(Requete::get('id')), FILTER_VALIDATE_INT);

        if ($page->code_utilisateur != 0) {
            $page->liste1 = $u->utilisateur(Requete::get('id'));
            $page->code_utilisateur = $page->liste1['code_utilisateur'];
            $page->nom = $page->liste1['nom'];
            $page->prenom = $page->liste1['prenom'];
            $page->adresse = $page->liste1['adresse'];
            $page->mail = $page->liste1['mail'];
            $page->telephone = $page->liste1['telephone'];
            $page->login = $page->liste1['login'];
            $page->mdp = $page->liste1['mdp'];
            $page->etatSelectList = false;
            $page->code_type = $page->liste1['code_type'];
            $page->listeTypeUser = $t->listerByID($page->code_type);
        }
    }

    public function deconnecterAction() {
        Authentification::deconnecter();
        $this->rediriger("index.php");
    }

    public function creerAction() {
        $this->editerAction(false);
    }

    public function supprimerAction() {
        require_once("application/data/utilisateurs.data.php");
        $page = Page::getPage();
        $page->setTemplate('application');
        $page->setVue('utilisateur');
        $page->code_utilisateur = Requete::get('id');

        $u = new Utilisateurs();

        $u->supprimer($page->code_utilisateur);
        $this->rediriger('index.php?controller=utilisateurs&action=lister', 'Utilisateur supprimé');
    }

}

?>
