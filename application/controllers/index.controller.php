<?php

defined('__ERELEVE__') or die('Acces interdit');

class IndexController extends Controleur {

    public function __construct() {
        $this->setActionParDefaut('index');
    }

    protected function _preAction() {
        // if (Authentification::estConnecte())
            // $this->rediriger('index.php?controller=acceuil');
    }

    public function indexAction() {
        $page = Page::getPage();
        $page->setTemplate('index');
        $page->setVue('index');
        $page->ajouterCSS('bootstrap.min');
        $page->ajouterCSS('index');

        $page->message = "";
        $page->login = "";
        $page->motdepasse = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $page->login = trim(Requete::post('login', ''));
            $page->motdepasse = trim(Requete::post('motdepasse', ''));

            if ($page->login == '') {
                $page->message = "Login manquant";
                return;
            }

            if ($page->motdepasse == '') {
                $page->message = "Mot de passe manquant";
                return;
            }

            /* POINT D'INSERTION */

            if (Authentification::authentifier($page->login, $page->motdepasse)) {
                $this->rediriger("index.php?controller=acceuil");
            }

            $page->message = "Login / mot de passe incorrect";
        }
    }

}
