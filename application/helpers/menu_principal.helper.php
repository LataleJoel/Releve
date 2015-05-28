<?php
defined('__ERELEVE__') or die('Acces interdit');
abstract class MenuPrincipal {
	public static function afficher(){
		if(Requete::get('action')=='listerEns'){
			$type = 'Ens';
		
			$menu = Array(
				Array(
					'titre' => 'Nouveaux',
					'controleur' => 'releves',
					'action' => 'listerEns',
					'statut' => 'nouveau'
				),

				Array(
					'titre' => 'Traité',
					'controleur' => 'releves',
					'action' => 'listerEns',
					'statut' => 'traite'
				)
			);
		}
		else
		{
			$type = 'Sgp';
		
			$menu = Array(
				Array(
					'titre' => 'Nouveaux',
					'controleur' => 'releves',
					'action' => 'listerSgp',
					'statut' => 'nouveau'
				),
				
				Array(
					'titre' => 'Brouillons',
					'controleur' => 'releves',
					'action' => 'listerSgp',
					'statut' => 'brouillon'
				),
				
				Array(
					'titre' => 'En attente',
					'controleur' => 'releves',
					'action' => 'listerSgp',
					'statut' => 'attente'
				),
				
				Array(
					'titre' => 'Traité',
					'controleur' => 'releves',
					'action' => 'listerSgp',
					'statut' => 'traite'
				)
			);
		}
		$menuPromotion = Array(
				Array(
					'titre' => 'I1',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				),
				
				Array(
					'titre' => 'I2',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				),
				
				Array(
					'titre' => 'I3',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				),
				
				Array(
					'titre' => 'B1',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				),
				
				Array(
					'titre' => 'B2',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				),
				
				Array(
					'titre' => 'B3',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				),
				
				Array(
					'titre' => 'M1',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				),
				
				Array(
					'titre' => 'M2',
					'controleur' => 'releves',
					'action' => 'lister'.$type
				)
			);		
			
		$controleur = Application::getControleur();
		$action = Application::getAction();
		$releves = new Releves();
		?>	
	
	
					<ul class="nav nav-pills nav-stacked">
						<?php
			foreach($menu as $ligne_menu=>$titre_ligne_menu)
			{
				$active = '';
			
				if($titre_ligne_menu['statut'] == Requete::get('statut'))
				{
					$active = ' class="active" ';
				}
			?>
					<li <?php echo $active; ?>><a href="index.php?controller=<?php echo $titre_ligne_menu['controleur']?>&action=<?php echo $titre_ligne_menu['action'];?>&statut=<?php echo $titre_ligne_menu['statut'];?>"><?php echo $titre_ligne_menu['titre']?> <span class="badge pull-right"><?php echo $releves->countRelevesByStatut($type,$titre_ligne_menu['statut'],(int)$_SESSION['framework3il.authentification']);?><span></a></li>
			<?php	
			}
			?>
					<li class="divider"></li>
					<li id="accordion-promotions"> 
						<a data-toggle="collapse" data-parent="#accordion" href="#all_promotions" class="accordion-toggle">
						  Promotions
						</a>
						<ul id="all_promotions" class="nav nav-list collapse">
						<?php
						foreach($menuPromotion as $ligne_menupromotion=>$titre_ligne_menuPromotion)
						{
							$active = '';
							$icone = 'close';
							if($titre_ligne_menuPromotion['controleur'] == $controleur && $titre_ligne_menuPromotion['action'] == $action)
							{
								$active = ' class="active" ';	
								$icone = 'open';
							}
								?>
								<li <?php echo $active; ?>><a href="index.php?controller=<?php echo $titre_ligne_menuPromotion['controleur']?>&action=<?php echo $titre_ligne_menuPromotion['action']?>&promotion=<?php echo $titre_ligne_menuPromotion['titre']?>"><span class="glyphicon glyphicon-folder-<?php echo $icone;?>"></span> <?php echo $titre_ligne_menuPromotion['titre']?></a></li>
								<?php	
						}
						?>
						</ul>
						</li>			
					</ul>
			
		<?php
	}
	
	public static function filAriane($type_user = ''){
	
		$controleur = Application::getControleur();
		$action = Application::getAction();

		
		// Creer une classe du controleur
		
		$chemin_ctrl = "application/controllers/" . $controleur . ".controller.php";

			// Test controleur existant
			if(!file_exists($chemin_ctrl))
				throw new Erreur("Controleur invalide");
			else
				require_once($chemin_ctrl);
				
			if(!class_exists($controleur . "Controller"))
				throw new Erreur("Classe " . $controleur . " non trouvé !");
			else
			{
				$classname = $controleur  . 'Controller';
				$new_class = new $classname();

				// Recuperer sa méthode par défaut
				$action_default = $new_class->getActionParDefaut();
				// La tester si on est sur la méthode par défaut ou non
				// Si action par défaut : On affiche que Index > actionpardefaut
				// Sinon : Index > actionpardefaut > actionencours
				if($action_default == $action)
				{
					$breadcrumb = Array(
						Array(
							'titre' => ucfirst($action_default) ." ". $controleur,
							'controleur' => $controleur,
							'action' => $action_default
						)
					);
				}
				else
				{
					$breadcrumb = Array(
						Array(
							'titre' => ucfirst($action_default) ." ". $controleur,
							'controleur' => $controleur,
							'action' => $action_default
						),
						
						Array(
							'titre' => ucfirst($action) ." ". $controleur,
							'controleur' => $controleur,
							'action' => $action
						)
					);
				}
				?>
				<ol class="breadcrumb centered" id="fil_ariane">
					<span class="glyphicon glyphicon-home"></span>
					<li><a href="index.php"> Index</a></li>
					<?php
					foreach($breadcrumb as $ligne_breadcrumb=>$titre_ligne_breadcrumb)
					{
						$active = '';
					
						if($titre_ligne_breadcrumb['controleur'] == $controleur && $titre_ligne_breadcrumb['action'] == $action)
						{
							?>
								<li class="active"><?php echo $titre_ligne_breadcrumb['titre']?></li>
							<?php
						}
						else
						{
						?>
							<li <?php echo $active; ?>><a href="index.php?controller=<?php echo $titre_ligne_breadcrumb['controleur']?>&action=<?php echo $titre_ligne_breadcrumb['action']?>"><?php echo $titre_ligne_breadcrumb['titre']?></a></li>
						<?php
						}
					}
					?>
					
				</ol>
			<?php
			}

	}
}
?>