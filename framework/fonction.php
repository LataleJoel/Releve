<?php
 defined('__FRAMEWORK3IL__') or die('Acces interdit'); 
class Fonction{

	/********************************************************************************** FONCTIONS SUR LES DATES *********************************************************************/
	public static function sqlToDate($date)
	{
		if($date != "" && $date != NULL && $date != 0)
			return substr($date,8,2) . "/" . substr($date,5,2) . "/" . substr($date,0,4);
		return "";
	}
	
	public static function dateToSql($date)
	{
		if($date != "")
			return substr($date,6,4) . "-" . substr($date,3,2) . "-" . substr($date,0,2);
		return "";
	}

}
?>