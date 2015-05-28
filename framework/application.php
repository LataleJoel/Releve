<?php
	define('__FRAMEWORK3IL__','');

	session_start();

	
	require_once('configuration.php');
	require_once('requete.php');
	require_once('datatable.php');
	require_once('erreur.php');
	require_once('page.php');
	require_once('controleur.php');
	require_once('message.php');
	require_once('authentification.php');
	require_once('fonction.php');


	class Application{
		private static $_application = null;
		private $db = null;
		private $controleurParDefaut;
		private $controleur;
		private $action;
	
	
		/*
		*	CONSTRUCTEUR
		*/
	
		private function __construct($fichierIni){
			
			$config = Configuration::getConfiguration($fichierIni);
			// echo $config->db_database; // TP3 étape 2.1
			
			//TP3 2.2
			// Ouverture de la BD en PDO
			try {
			
				$connection = new PDO('mysql:host=' . $config->db_hostname . ';dbname=' . $config->db_database, $config->db_username, $config->db_password );
				$this->db = $connection;
				$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			}
			catch ( Exception $e ) {
				throw new Erreur("Connection a MySQL impossible");
			}
		}
		
		/*
		*	GETTEURS
		*/
		
		static public function getApplication($fichierIni = ''){
			if(is_null(self::$_application) === true){
				self::$_application = new Application($fichierIni);
			}
			return self::$_application;
		}
		
		public function getDB(){
			return $this->db;
		}
		
		static public function getControleur(){
			if(!isset(self::$_application))
				die("Attention ! L'instance d'application n'existe pas !");
			return self::$_application->controleur;	
		}
		
		static public function getAction(){
			if(!isset(self::$_application))
				die("Attention ! L'instance d'application n'existe pas !");
			return self::$_application->action;
		}
		
		public static function configurerAuthentification(){
			$config = Configuration::getConfiguration();
			
			
			$auth = Authentification::getAuthentification($config->auth_table, $config->auth_identifiant , $config->auth_login , $config->auth_motdepasse );
		}
		
		/*
		*	
		*/
		static public function getURL(){
			if($_SERVER['SERVER_PORT'] == 80)
				return htmlspecialchars("http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['SCRIPT_NAME'] . "?controller=" . Application::getControleur() . "&action=" . Application::getAction());
			else
				return htmlspecialchars("http://" . $_SERVER['HTTP_HOST'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['SCRIPT_NAME'] . "?controller=" . Application::getControleur() . "&action=" . Application::getAction());
		}
		
		/*
		*	SETTEURS
		*/
		
		public function setControleurParDefaut($controleur_dump){
			$this->controleurParDefaut = $controleur_dump;
		}
		
		/*
		*	AUTRES
		*/
		
		public function lancer(){
			$name_ctrl = Requete::get('controller', $this->controleurParDefaut);
			$chemin_ctrl = "application/controllers/" . $name_ctrl . ".controller.php";
		
			
			// Test controleur existant
			if(!file_exists($chemin_ctrl))
				throw new Erreur("Controleur invalide");
			else
				require_once($chemin_ctrl);
				
			if(!class_exists($name_ctrl . "Controller"))
				throw new Erreur("Classe " . $name_ctrl . " non trouvé !");
			else
			{
				$classname = $name_ctrl  . 'Controller';
				$new_class = new $classname();
				
				// Récupération de l'action dans l'url. SI vide : Action par défaut du controleur
				$action_a_exec = Requete::get("action", $new_class->getActionParDefaut());
				
				/*
				* TP5 : Etape 5.3 : Récupérer l'action et le controleur courant
				*/
				$this->controleur = $name_ctrl;
				$this->action = $action_a_exec;

				$new_class->executer($action_a_exec);
				$page = Page::getPage();
				$page->afficher(); 
				
			}
		}
	}
?>