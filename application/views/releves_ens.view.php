<?php defined('__ERELEVE__') or die('Acces interdit'); ?>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable_custom" id="liste_releve">
	<thead>
			<tr>
				<th>Année</th>
				<th>Promotion</th>
				<th>Enseignant</th>
				<th>Matière</th>
				<th>Date</th>
				<th>Type d'epreuve</th>
				<th>Statut</th>
				<th>Action</th>
				
			</tr>
		</thead>
		<tbody>
		<?php foreach($this->releve as $tab){?>
			<tr>
				<td><?php echo $tab['niveau'];?></td>
				<td>
					<?php 
						if($tab['cursus'] == "3IL" && $tab['niveau'] == 1)
							echo 'I1';
						if($tab['cursus'] == "3IL" && $tab['niveau'] == 2)
							echo 'I2';
						if($tab['cursus'] == "3IL" && $tab['niveau'] == 3)
							echo 'I3';
						if($tab['cursus'] == "CS2I" && $tab['niveau'] == 1)
							echo 'B1';  
						if($tab['cursus'] == "CS2I" && $tab['niveau'] == 2)
							echo 'B2';
						if($tab['cursus'] == "CS2I" && $tab['niveau'] == 3)
							echo 'B3';
						if($tab['cursus'] == "CS2I" && $tab['niveau'] == 4)
							echo 'M1';
						if($tab['cursus'] == "CS2I" && $tab['niveau'] == 5)
							echo 'M2';
					?>
				</td>
				<td><?php echo $tab['nom'];?></td>
				<td><?php echo $tab['lib_matiere'];?></td>
				<td><?php echo Fonction::sqlToDate($tab['date_creation']);?></td>
				<td><?php echo $tab['code_type_epreuve'];?></td>
				<td><?php echo $tab['statut_enseignant'];?></td>		
				<td class="text-center">
					<form action="index.php" method="GET">
						<input type="hidden" name="controller" value="releves"/>
						<button type="submit" name="action" value="editerEnseignant" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil datatables_action"></span></button>
						<input type="hidden" name="id" value="<?php echo $tab['code_releve'];?>"/>
						<input type="hidden" name="epreuve" value="<?php echo $tab['code_epreuve']; ?>" />
					</form>	
				</td>
			</tr>
		<?php } ?>

		</tbody>
		<tfoot>
			<tr>
			<th>Année</th>
				<th>Promotion</th>
				<th>Enseignant</th>
				<th>Matière</th>
				<th>Date</th>
				<th>Type de devoir</th>
				<th>Statut</th>
				<th>Action</th>
			</tr>
		</tfoot>
</table>