<?php
defined('__FRAMEWORK3IL__') or die('Acces interdit');
final class Requete{

	static public function get($item, $defaut = null){
		return Requete::fetch($_GET, $item, $defaut);
	}
	
	static public function post($item, $defaut = null){
		return Requete::fetch($_POST, $item, $defaut);
	}
	
	static private function fetch($tab, $item, $defaut = null){
		if(isset($tab[$item]))
			return $tab[$item];
		else
			return $defaut;
	}

}

?>