<?php
 defined('__FRAMEWORK3IL__') or die('Acces interdit'); 

	class Configuration {
		private $data = null;
		private static $_configuration = null;
		
		private function __construct($fichier) {
			$this->data = $fichier;
			
			if(!file_exists($this->data))
				die('le fichier de ' . $this->data . ' n\'existe pas !');
			else
			{
				$this->data = parse_ini_file($this->data);
				
				if(!$this->data)
					die(' Erreur ! la lecture du fichier passé a échoué ! ');
			}
		}
		
		public function __get($propriete)
		{
			if(isset($this->data[$propriete]))
				return $this->data[$propriete];
			else
				die(' Erreur ! la propriete : ' . $propriete . ' n\'existe pas ! ');
				
		}
		
		static public function getConfiguration($fichier = ''){
			if(is_null(self::$_configuration) == true)
				self::$_configuration  = new Configuration($fichier);
				
			return self::$_configuration;
		}
			
		/*
 		public function demo(){
			return $this->data;
		} */
		
	}
?>