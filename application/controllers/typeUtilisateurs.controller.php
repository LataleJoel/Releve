<?php

defined('__ERELEVE__') or die('Acces interdit');
require_once("application/data/typeUtilisateur.data.php");
//session_start();
class TypeUtilisateurs extends Controleur {

    public function __construct() {
       $this->setActionParDefaut("lister");
    }

   
    public function listerAction() {
        
        $utilisateur = new TypeUtilisateurs();
        $page = Page::getPage();
        
        $page->listeTypeUser = $utilisateur->lister();
    }
   

}

?>
