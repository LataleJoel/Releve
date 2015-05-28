<?php defined('__ERELEVE__') or die('Acces interdit'); 
// Mettre dans le template un booléen pour tester si action==lister ou non pour enlever le menu
// Changement
// 	- releves.view.php(changement du bouton en form+input) 
// menu_principal.helper
// template.application
?>

<div id="releveForm">
	<form method="POST" action="index.php?controller=releves&action=<?php echo $this->action; ?>" id="createReleve">
	 <fieldset>
        <legend><?php echo $this->titre; ?></legend>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='form-group'>
                    <label for="releve_epreuve">Epreuve</label>
                 
					<select class="form-control" name="releve_epreuve" id="releve_epreuve" >
					<option value="0" selected></option>
					<?php foreach((array)$this->liste_epreuves as $epreuve){
					?>
					  <option value="<?php echo $epreuve['code_epreuve']; ;?>"><?php echo $epreuve['libelle_epreuve'] . " " . $epreuve['lib_matiere'] . " " . Fonction::sqlToDate($epreuve['date_creation']); ?></option>
					<?php 
					}
					?>
					</select>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="releve_cursus">Cursus</label>
             
					<select class="form-control" name="releve_cursus" id="releve_cursus">
					  <option value="3IL">3IL</option> 
					  <option value="CS2I">CS2I</option>
					
					</select>
                </div>
            </div>
			<div class='col-sm-4'>
				 <div class='form-group'>
                    <label for="releve_niveau">Niveau</label>
					<select class="form-control" name="releve_niveau" id="releve_niveau">
					  <option value="1">1</option> 
					  <option value="2">2</option>
					  <option value="3">3</option>
					</select>
                </div>
			</div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="releve_matiere">Matière</label>
					<select class="form-control" name="releve_matiere" id="releve_matiere" >
						<option value="0" selected></option>
						<?php foreach((array)$this->liste_matieres as $matiere){
						?>
						  <option value="<?php echo $matiere['code_matiere']; ;?>"><?php echo $matiere['lib_matiere'];?></option>
						<?php 
						}
						?>
					</select>
                </div>
            </div>
        </div>
		<div class='row'>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="releve_libelle">Libellé</label>
                    <input class="form-control" id="releve_libelle" name="releve_libelle" size="30" type="text" />
                </div>
            </div>
			<div class='col-sm-4'>
			</div>
            <div class='col-sm-4'>
                <div class='form-group'>
				 <label for="releve_date_devoir">Date du devoir</label>
					<div class='input-group'>
					    <input id="releve_date_devoir" type="text" class="date-picker form-control" data-date-format="dd/mm/yyyy"/>
                <label for="releve_date_devoir" class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </label>
					</div>
				</div>
  
            </div>
        </div>
    
      
		<div class='row'>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="releve_enseignant">Enseignant principal</label>
						<select class="form-control" name="releve_enseignant" id="releve_enseignant" >
						<option value="0" selected></option>
						<?php foreach((array)$this->liste_enseignants as $enseignant){
						?>
						  <option value="<?php echo $enseignant['code_utilisateur']; ;?>"><?php echo $enseignant['nom'] . " " . $enseignant['prenom'];?></option>
						<?php 
						}
						?>
					</select>
                </div>
            </div>
			<div class='col-sm-4'>
			</div>
            <div class='col-sm-4'>
                <div class='form-group'>
                    <label for="releve_type_devoir">Type du devoir</label>
					<select class="form-control" name="releve_type_devoir" id="releve_type_devoir" >
						<option value="0" selected></option>
						<?php foreach((array)$this->liste_type_epreuves as $type_epreuve){
						?>
						  <option value="<?php echo $type_epreuve['code_type_epreuve']; ;?>"><?php echo $type_epreuve['code_type_epreuve'];?></option>
						<?php 
						}
						?>
					</select>
                </div>
            </div>
        </div>
		<div class='row'>
            <div class='col-sm-12'>
			<div class='form-group'>
				<label for="releve_date_retour">A rendre pour le :</label>
				<div class='input-group'>
					<input name="releve_date_retour" id="releve_date_retour" type="text" class="date-picker form-control" data-date-format="dd/mm/yyyy"/>
					<label for="releve_date_retour" class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </label>
				</div>
			</div>
              
            </div>
        </div>
	</fieldset>
	
	<fieldset>
		  <legend>Ajouter des élèves</legend>
	</fieldset>
			
	<div class='row'>
	<div class='col-sm-4'>
		<div class='form-group'>
			<label for="releve_all_groupes">Ajouter un groupe</label>
				<select class="form-control" name="releve_all_groupes" id="releve_all_groupes" >
				<option value="0" selected></option>
				<?php foreach((array)$this->liste_groupes as $groupes){
				?>
				  <option value="<?php echo $groupes['code_groupe']; ;?>"><?php echo $groupes['libelle_groupe'];?></option>
				<?php 
				}
				?>
			</select>
		</div>
	</div>
	<div class='col-sm-4'>
		<div class='form-group'>
		<label for="releve_button_view_groupes"></label>
			<button name="releve_button_view_groupes" id="releve_button_view_groupes" type="button" class="btn btn-info form-control" ><span class="glyphicon glyphicon-search"></span> Visualiser la liste des élèves</button>
		</div>
	</div>
	<div class='col-sm-4'>
			<div class='form-group'>
		<label for="releve_button_add_groupes"> </label>
			<button name="releve_button_add_groupes" id="releve_button_add_groupes" type="button" class="btn btn-primary form-control" ><span class="glyphicon glyphicon-plus"></span> Ajouter le groupe</button>
		</div>
	</div>
	</div>	
			
	<div class='row'>
	<div class='col-sm-4'>
		<div class='form-group'>
			<label for="releve_all_eleves">Ajouter un élève</label>
				<select class="form-control" name="releve_all_eleves" id="releve_all_eleves" >
				<option value="0" selected></option>
				<?php foreach((array)$this->liste_eleves as $eleve){
				?>
				  <option value="<?php echo $eleve['code_eleve']; ;?>"><?php echo $eleve['cursus'] . $eleve['niveau'] . " : " . $eleve['nom'] . " " . $eleve['prenom'];?></option>
				<?php 
				}
				?>
			</select>
		</div>
	</div>
	<div class='col-sm-4'>
		
	</div>
	<div class='col-sm-4'>
			<div class='form-group'>
				<label for="releve_button_add_eleves"> </label>
			<button name="releve_button_add_eleves" id="releve_button_add_eleves" type="button" class="btn btn-primary form-control" ><span class="glyphicon glyphicon-plus"></span> Ajouter l'élève</button>
		</div>
	</div>
	</div>			
			
			
			
	<fieldset>
		 <legend>Liste des élèves</legend>
	</fieldset>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable_custom" id="liste_eleves_releve">
	<thead>
			<tr>
				<th>N°</th>
				<th>NOM PRENOM</th>
				<th>NOTE</th>
				<th>COMMENTAIRE</th>
				<th>Supprimer ?</th>
			</tr>
		</thead>
		<tbody>
		
			
		</tbody>
		<tfoot>
			<tr>
			<th>N°</th>
			<th>NOM PRENOM</th>
			<th>NOTE</th>
			<th>COMMENTAIRE</th>
			<th>Supprimer ?</th>
			</tr>
		</tfoot>
	</table>
			
			
			<input type="submit" value="Enregistrer" class="btn btn-primary btn-lg pull-right"/>
			
			<input type="submit" value="Annuler" class="btn btn-lg btn-default pull-right"/>
			
			<input type="hidden" name="id" value="<?php echo $this->id; ?>"  />
		</form>
	</form>
</div>