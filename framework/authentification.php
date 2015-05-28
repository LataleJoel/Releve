<?php

defined('__FRAMEWORK3IL__') or die('Acces interdit');
    class Authentification {
        protected static $_authentification = null;
        protected $utilisateur = null;
        protected $table;
        protected $colLogin;
        protected $colIdentifiant;
        protected $colMotdepasse;
        
        private function __construct($table,$colIdentifiant,$colLogin,$colMotdepasse) {
            $this->table = $table;
            $this->colIdentifiant = $colIdentifiant;
            $this->colLogin = $colLogin;
            $this->colMotdepasse = $colMotdepasse;
			
			if(isset($_SESSION['framework3il.authentification'])){
		
				$this->chargerUtilisateur();	
			}
        }
        public static function getAuthentification($table=null,$colIdentifiant=null,$colLogin=null,$colMotdepasse=null) {
            
            if($table == null || $colIdentifiant == null || $colLogin == null || $colMotdepasse == null)
				die(" Impossible de récupérer l'authentification !");
		
			if(is_null(self::$_authentification) === true)
				self::$_authentification = new Authentification($table, $colIdentifiant, $colLogin, $colMotdepasse);
			
			return self::$_authentification;
           
        }
        
        public static function authentifier($login,$motdepasse=null) {
            $appli = Application::getApplication();

			$sql = "SELECT ".self::$_authentification->colIdentifiant.
				" FROM ".self::$_authentification->table.
				" WHERE ".self::$_authentification->colLogin."=:login AND ".
				self::$_authentification->colMotdepasse."=:motdepasse LIMIT 1";
			
			$req = $appli->getDB()->prepare($sql);
			$req->bindValue(':login',$login);
			$req->bindValue(':motdepasse',Authentification::encoder($motdepasse));
			//$req->bindValue(':motdepasse',$motdepasse);
			try {
				$req->execute();
			} 
			catch(PDOException $err){
				throw new Erreur('Erreur SQL ' . $err->getMessage());
			}
			
			$id_temp = $req->fetchColumn();
		
			
			if($id_temp === false)
				return false;
				
			$_SESSION['framework3il.authentification'] = $id_temp;
			
			self::$_authentification->chargerUtilisateur();	
			return true;
        }
        protected function chargerUtilisateur(){
            $appli = Application::getApplication();

			$sql = "SELECT *  FROM utilisateur WHERE code_utilisateur =:id";
			$req = $appli->getDB()->prepare($sql);
			$req->bindValue(':id',$_SESSION['framework3il.authentification']);

			try {
				$req->execute();
			} 
			catch(PDOException $err){
				throw new Erreur('Erreur SQL ' . $err->getMessage());
			}
			
			$this->utilisateur = $req->fetch();
			
			// Par sécurité mettre le mot de passe à ““, cela évitera qu’il soit exposé par accident.
			$this->utilisateur['motdepasse'] = "";
        }
        public static function deconnecter(){
            if(self::$_authentification->utilisateur != null)
				self::$_authentification->utilisateur = null;
			unset($_SESSION['framework3il.authentification']);
			unset($_SESSION['framework3il.type']);
        }
         public static function estConnecte(){
            $valeur = true;
            if(self::$_authentification->utilisateur==null)
                $valeur = false;
            
            return $valeur;
        }
        public static function getUtilisateur(){
            return self::$_authentification->utilisateur;
        }
         public function getUtilisateurID(){
            return self::$_authentification->utilisateur[$colIdentifiant];
        }
        
        public static function encoder($motdepasse){
            return md5(Authentification::saler($motdepasse));
        }
         public static function saler($str){
            $config = Configuration::getConfiguration();
			$temp =  str_split($config->auth_secret . $str);	
			return implode("", $temp);
        }
        
        
    }
?>