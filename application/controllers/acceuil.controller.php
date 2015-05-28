<?php
defined('__ERELEVE__') or die('Acces interdit');
require_once('application/data/utilisateurs.data.php');
class AcceuilController extends Controleur {
	public function __construct(){
		$this->setActionParDefaut("acceuil");
	}
	
	protected function _preAction(){
		if(!Authentification::estConnecte())
			$this->rediriger('index.php');
	}

	public function acceuilAction(){
		$page = Page::getPage();
		$page->setTemplate('application');
		$page->setVue('acceuil');
		$page->message = 'Coucou depuis un controleur';
		$util = new Utilisateurs();
		
		$type = $util->getType($_SESSION['framework3il.authentification']);


		
		switch($type['code_type']){
			case '1':
			$_SESSION['framework3il.type'] = 1;
			$this->rediriger('index.php?controller=utilisateurs');
			break;
			case '2':
			$_SESSION['framework3il.type'] = 2;
			$this->rediriger('index.php?controller=releves&action=listerSgp');
			break;
			case '3':
			$_SESSION['framework3il.type'] = 3;
			$this->rediriger('index.php?controller=releves&action=listerEns');
			break;
			default:
			$this->rediriger('index.php');
			break;
			
		}
	
		
	}
	
}

?>