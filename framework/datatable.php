<?php
defined('__FRAMEWORK3IL__') or die('Acces interdit');

abstract class DataTable {
	protected $db = null;
	public function __construct(){
		$app = Application::getApplication();
		$this->db = $app->getDB();
	}
}
?>