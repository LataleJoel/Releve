<?php
defined('__ERELEVE__') or die('Acces interdit');

class Type_epreuves extends DataTable {

	
	
	public function lister(){	
		$sql = 'SELECT * FROM type_epreuve e
			ORDER BY code_type_epreuve ASC';
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