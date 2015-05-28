<?php defined('__ERELEVE__') or die('Acces interdit'); 
// Mettre dans le template un booléen pour tester si action==lister ou non pour enlever le menu
// Changement
// 	- releves.view.php(changement du bouton en form+input) 
// menu_principal.helper
// template.application
	$faute = '';
    if(isset($this->erreur)){
        $faute = $this->erreur;
	}
?>

<div id="releveForm">
	<form method="POST" action="index.php?controller=releves&action=editerEnseignant" id="createReleve">
	 
			
	<h2>Edition de relevé</h2>
	<p><?php echo $faute; ?></p>
	<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable_custom" id="liste_eleves_releve">
	<thead>
			<tr>
				<th>N°</th>
				<th>NOM</th>
				<th>NOTE</th>
				<th>COMMENTAIRE</th>
			</tr>
		</thead>
		<tbody>
		<?php for($i = 0;$i < count($this->eleve); $i++){?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $this->eleve[$i]['nom'].' '.$this->eleve[$i]['prenom'];?></td>
				<td>
					<input type="text" name="note_<?php echo $this->eleve[$i]['code_eleve']; ?>" id="nom" placeholder="Ex: 20" value="<?php echo $this->eleve[$i]['note'];?>"/>

				</td>
				<td>
					<input type="text" name="commentaire_<?php echo $this->eleve[$i]['code_eleve']; ?>" placeholder="Ex: étudiant très intélligent!" size="40" value="<?php echo $this->eleve[$i]['commentaires'];?>"/>
				</td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<th>N°</th>
			<th>NOM</th>
			<th>NOTE</th>
			<th>COMMENTAIRE</th>
			</tr>
		</tfoot>
	</table>
			
			
			<input type="submit" value="Enregistrer" class="btn btn-primary btn-lg pull-right"/>
			
			<input type="submit" value="Annuler" class="btn btn-lg btn-default pull-right"/>
			
			<input type="hidden" name="id" value="<?php echo $this->id; ?>"  />
		</form>
	</form>
</div>