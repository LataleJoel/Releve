<?php
 defined('__FRAMEWORK3IL__') or die('Acces interdit'); 

	class Config {
		private $data = null;
		private static $_config = null;
		
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
		
		static public function getConfig($fichier = ''){
			if(is_null(self::$_config) == true)
				self::$_config = new Config($fichier);
				
			return self::$_config;
		}
			
		/*
 		public function demo(){
			return $this->data;
		} */
		
	}
?>