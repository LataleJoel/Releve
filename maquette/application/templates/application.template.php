<?php
    defined('__EAPPEL__') or die('Acces interdit');
	require_once 'application/helpers/menu_principal.helper.php';
	$utilisateur = Authentification::getUtilisateur();
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="application/styles/e-appel.css" type="text/css"/>
		<?php $this->linkCSS(); ?>
    </head>
    <body>
        <div class="conteneur">
            <div id="entete">
                
                <div id="utilisateur">
                <p class="nom"><?php echo $utilisateur['nom'].' '.$utilisateur['prenom'] ?></p>
                <form method="post" action="index.php?controller=utilisateurs&action=deconnecter">
                    <input type="submit" value="Déconnexion" class="deconnexion"/>
                </form>
                </div>
                <h1>
					<a href="#">
                        <img src="application/images/e-appel_logo.png" alt="e-appel_logo"/>
                    </a>
                </h1>
                
            </div>
			<?php MenuPrincipal::afficher(); ?>
           
            <section >
				<?php $this->vue() ?>
            </section>
        </div>
		<?php $this->linkScripts();?>
		
    </body>
</html>