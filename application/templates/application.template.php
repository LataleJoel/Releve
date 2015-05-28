<?php defined('__ERELEVE__') or die('Acces interdit');
require_once 'application/helpers/menu_principal.helper.php';
$donnes_user = Authentification::getUtilisateur();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gestion des relevés de notes</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			
			<link rel="stylesheet" type="text/css" href="application/styles/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="application/styles/dataTables.bootstrap.css">
			<link rel="stylesheet" type="text/css" href="application/styles/e-releve.css">
			
		 <?php $this->linkCSS(); ?>
	</head>
	<body class="center">
		<div class="conteneur">	
			<div class="row" id="header">
			
				<div class="col-md-2" >
					<img alt="logo 3IL" id="logo3il" src="application/images/logo3il.png"/>
				</div>
				
				<h1 class="col-md-7" id="titre_header">
					Gestion des relevés de notes
				</h1>
				
			<div id="login">
					<form method="POST" action="index.php?controller=utilisateurs&action=deconnecter" >
						<button type="button" class="btn btn-primary" disabled="disabled"><span class="glyphicon glyphicon-user"></span> <?php $pieces = explode(" ", $donnes_user['nom']);  echo $pieces[0] . " " . substr($donnes_user['prenom'], 0, 1). ". ";?> </button>
						<button  type="submit" value="Déconnexion" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-off"></span> </button>
					</form>
				</div>	
				
			</div>
			<div class="row">
			<?php 
				MenuPrincipal::filAriane(); 
			?>
				
					
			</div>
			<div class="row">		
				<div class="col-md-2"  id="menu_principal">
				<?php 
				if((Requete::get('action') == 'listerEns') || (Requete::get('action') == 'listerSgp')){
				
					MenuPrincipal::afficher(); 
				}
				?>
				</div>
				
				<div class="col-md-9">
					<?php $this->vue(); ?>	
				</div>
				
				</div>
		</div>	
			<script type="text/javascript" language="javascript" src="application/javascript/jquery-1.10.2.min.js"></script>
			<script type="text/javascript" language="javascript" src="application/javascript/bootstrap.min.js"></script>
			<script type="text/javascript" language="javascript" src="application/javascript/jquery.dataTables.min.js"></script>
			<script type="text/javascript" language="javascript" src="application/javascript/dataTables.bootstrap.js"></script>
			<script type="text/javascript" language="javascript" src="application/javascript/template_index.js"></script>
				<script type="text/javascript" language="javascript" src="application/javascript/afficherIdUtilisateur.js"></script>
				<?php $this->linkScripts(); ?>
				
	</body>
</html>