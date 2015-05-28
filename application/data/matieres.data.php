<?php
defined('__ERELEVE__') or die('Acces interdit');

class Matieres extends DataTable {

	public function lister(){	
		$sql = 'SELECT * FROM matiere m
			ORDER BY code_matiere ASC';
		$req = $this->db->prepare($sql);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	
}
?>