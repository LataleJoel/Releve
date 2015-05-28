<?php
defined('__ERELEVE__') or die('Acces interdit');

class Eleves extends DataTable {

	
	
	public function lister(){	
		$sql = 'SELECT * FROM eleve
			ORDER BY cursus,niveau,nom,prenom ASC';
		$req = $this->db->prepare($sql);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	public function eleve($id){
		$sql = 'SELECT * FROM eleve 
			WHERE code_eleve = :id';
	
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
	
	public function eleveByGroupe($id){

		$sql = "SELECT DISTINCT e.code_eleve,nom,prenom FROM eleve e
			INNER JOIN affectation_eleve_groupe ae ON ae.code_eleve = e.code_eleve 
			WHERE code_groupe = '".$id."'";
		
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