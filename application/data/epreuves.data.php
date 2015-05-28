<?php
defined('__ERELEVE__') or die('Acces interdit');

class Epreuves extends DataTable {
	
	public function lister(){	
		$sql = 'SELECT * FROM epreuve e
			INNER JOIN matiere m ON m.code_matiere = e.code_matiere
			INNER JOIN type_epreuve t ON t.code_type_epreuve = e.code_type_epreuve
			ORDER BY date_creation DESC';
		$req = $this->db->prepare($sql);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function epreuve($id){
		$sql = 'SELECT * FROM epreuve e  
			INNER JOIN matiere m ON m.code_matiere = e.code_matiere
			INNER JOIN type_epreuve t ON t.code_type_epreuve = e.code_type_epreuve 	
			WHERE e.code_epreuve = :id';
	
		$req = $this->db->prepare($sql);
		$req->bindValue(':id',$id);
		try {
			$req->execute();
		} 
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetch();
	}
	
	
	
}
?>