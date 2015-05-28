<?php
 defined('__FRAMEWORK3IL__') or die('Acces interdit'); 
class Message{

	public static function deposer($message){
		$_SESSION['framework3il.message'] = htmlspecialchars($message);	
	}
	
	public static function retirer(){
		if(isset($_SESSION['framework3il.message']))
		{
			$message = $_SESSION['framework3il.message'];
			unset($_SESSION['framework3il.message']);
		}
		else
			$message = '';
	
		
		return $message;
	}

}
?>