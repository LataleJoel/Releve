<?php
	define('__ERELEVE__','');

	require_once('framework/application.php');
	
	// Il faut une instance d'application pour que l'index soit OK
	$appli = Application::getApplication('application/config.ini');
	    Application::configurerAuthentification();
	$appli->setControleurParDefaut("index");
	$appli->lancer();
	
	
	
	
?>