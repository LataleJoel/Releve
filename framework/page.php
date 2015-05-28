<?php
defined('__FRAMEWORK3IL__') or die('Acces interdit');

class Page{

	private static $_page = null;
	
	protected $vue = "";
	protected $template = "";
	protected $css = "";
	protected $scripts = "";
	
	

		public function __construct() {
	
		}
		
		public static function getPage() {
 
			if(is_null(self::$_page)) {
				self::$_page = new Page();  
			}
	 
		 return self::$_page;
	   }
		
		public function setVue($vue){
			$filename = $vue . ".view.php";
		
			if(file_exists("./application/views/" . $filename))
				$this->vue = $filename;
			else
				throw new Erreur('Erreur : Fichier vue inexistant');
		}
		
		public function setTemplate($template){
			$filename = $template . ".template.php";
			
			if(file_exists("./application/templates/". $filename))
				$this->template = $filename;
			else
				throw new Erreur('Erreur : Fichier template inexistant');
		}
		
		public function vue(){
			if($this->vue == "")
				throw new Erreur("Erreur : vue non renseigné !");
			require_once("./application/views/" . $this->vue);			
		}
		
		public function afficher(){
			if($this->template == "")
				throw new Erreur("Erreur : template non renseigné !");
			require_once("./application/templates/" . $this->template);			
		}
		
		public function ajouterCSS($nom_css){
			if(!file_exists("./application/styles/" . $nom_css . ".css"))
				throw new Erreur("Erreur : fichier CSS : " . $nom_css . " inexistant au chemin ./application/styles/" . $nom_css . ".css !");
			$this->css[] = $nom_css;
		}
		
		public function ajouterScript($nom_js){
			if(!file_exists("./application/javascript/" . $nom_js . ".js"))
				throw new Erreur("Erreur : fichier JS : " . $nom_js . " inexistant au chemin ./application/javascript/" . $nom_js . ".js !");
			$this->scripts[] = $nom_js;
		}
		
		public function linkCSS(){
			foreach((array)$this->css as $fichier_css)
			{
				echo '<link rel="stylesheet" type="text/css" href="application/styles/' . $fichier_css . '.css">
				';
			}
		}	
		
		public function linkScripts(){
			foreach((array)$this->scripts as $fichier_js)
			{
				echo ' <script type="text/javascript" src="application/javascript/' . $fichier_js . '.js"> </script>
				';
			}
		}	
}

?>



