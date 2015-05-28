<?php
defined('__FRAMEWORK3IL__') or die('Acces interdit');

abstract class Controleur{

	protected $actionParDefaut = "";
	
	public function setActionParDefaut($action){
		$this->actionParDefaut = $action;
	}
	
	public function getActionParDefaut(){
		return $this->actionParDefaut;
	}
	
	
	
	public function executer($action=''){
		$methode = $action.'Action';
		if(method_exists($this,$methode)){
			$this->$methode();
		} else {
			throw new Erreur('Méthode inexistante !');
		}
	}
	
	public function rediriger($url, $message = '') {
		if($message != '')
			Message::deposer($message); // TP5 Etape 6.2
		if (!headers_sent())
			header('Location:' . $url);
		else
		{
			?>
			<script type="text/javascript">
				window.location = '<?php echo $url; ?>';
			</script>
			<?php
		}
	}
	
		protected function _preAction(){
	
	}
	
}
?>