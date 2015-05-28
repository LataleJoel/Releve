<?php
defined('__ERELEVE__') or die('Acces interdit');

class Evaluations extends DataTable {

	public function update($note, $com, $code_eleve, $code_releve){	
		$sql = 'UPDATE  evaluation SET date_eval=NOW(), note=:note, commentaires=:com WHERE
			code_eleve = :code_eleve AND code_releve= :code_releve';
		
		$req = $this->db->prepare($sql);
		$req->bindValue(':note',$note,PDO::PARAM_INT);
		$req->bindValue(':com',$com,PDO::PARAM_STR);
		$req->bindValue(':code_eleve',$code_eleve,PDO::PARAM_INT);
		$req->bindValue(':code_releve',$code_releve,PDO::PARAM_INT);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
	
	}
	
	public function creer($code_eleve,$code_epreuve, $code_releve){
		$sql = 'INSERT INTO  evaluation(code_eleve, code_epreuve,code_releve) VALUES (:code_eleve,:code_epreuve,:code_releve)';
		
		$req = $this->db->prepare($sql);

		$req->bindValue(':code_eleve',$code_eleve,PDO::PARAM_INT);
		$req->bindValue(':code_epreuve',$code_epreuve,PDO::PARAM_INT);
		$req->bindValue(':code_releve',$code_releve,PDO::PARAM_INT);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
	}
	
	public function nbNotesRemplies(){
		$sql = 'SELECT count(*) FROM evaluation WHERE note is not null';
		$req = $this->db->prepare($sql);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchColumn(0);
	}
	
	public function nbLignes(){
		$sql = 'SELECT count(*) FROM evaluation';
		$req = $this->db->prepare($sql);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchColumn(0);
	}
	
	
	
}
?>