<?php
    defined('__EAPPEL__') or die('Acces interdit');
    
    class IndexController extends Controleur {
        public function __construct() {
            #$this->setActionParDefaut('index');
			parent::__construct('index');
        }
		
		public function _preAction(){
			if(Authentification::estConnecte())
				$this->rediriger("index.php?controller=accueil","");
		}
  
        public function indexAction(){
            $page = Page::getPage();
            $page->setTemplate('index');
            $page->setVue('index');
            $page->ajouterCSS('index.css');
            $page->message = "";
            $page->login = "";
            $page->motdepasse = "";
            
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $page->login = trim(Requete::post('login',''));
                $page->motdepasse = trim(Requete::post('motdepasse',''));
                
                if($page->login==''){
                    $page->message = "Login manquant";
                    return;
                }
                
                if($page->motdepasse == ''){
                    $page->message = "Mot de passe manquant";
                    return;
                }
                
                /* POINT D'INSERTION */
                if(Authentification::authentifier($page->login,$page->motdepasse))
					$this->rediriger("index.php?controller=accueil&action=accueil","");
				else
					$page->message = "Login / mot de passe incorrect";
               
            }
        }
    }
?>

