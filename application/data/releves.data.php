<?php
defined('__ERELEVE__') or die('Acces interdit');

class Releves extends DataTable {
	
	public function listeRelevesEns($statut){	
		$sql = 'SELECT * FROM releve_note r
				INNER JOIN utilisateur u ON u.code_utilisateur = r.code_utilisateur
				INNER JOIN matiere m ON m.code_utilisateur = u.code_utilisateur
				INNER JOIN epreuve e ON e.code_matiere = m.code_matiere
				WHERE r.statut_enseignant=:statut
				AND u.code_utilisateur = :id';
		$req = $this->db->prepare($sql);
		$req->bindValue(':statut',$statut,PDO::PARAM_STR);
		$req->bindValue(':id',$_SESSION['framework3il.authentification']);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function listeRelevesSgp($statut){	
		$sql = 'SELECT * FROM releve_note r
				INNER JOIN utilisateur u ON u.code_utilisateur = r.code_utilisateur
				INNER JOIN matiere m ON m.code_utilisateur = u.code_utilisateur
				INNER JOIN epreuve e ON e.code_matiere = m.code_matiere
				WHERE r.statut_sgp=:statut';
		$req = $this->db->prepare($sql);
		$req->bindValue(':statut',$statut,PDO::PARAM_STR);

		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function supprimerReleve($code){
		$sql = "DELETE FROM releve_note WHERE code_epreuve = :code ";
		$req = $this->db->prepare($sql);
		$req->bindValue(':code',$code,PDO::PARAM_INT);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
	}
	
	public function supprimerEvaluation($code){
		$sql = "DELETE FROM evaluation WHERE code_epreuve = :code ";
		$req = $this->db->prepare($sql);
		$req->bindValue(':code',$code,PDO::PARAM_INT);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
	}
	
	public function listeRelevesSgpPromo($promo){
		switch($promo){
			case 'I1':
				$cursus = "3IL";
				$niveau = 1;
				break;
			case 'I2':
				$cursus = "3IL";
				$niveau = 2;
				break;
			case 'I3':
				$cursus = "3IL";
				$niveau = 3;
				break;
			case 'B1':
				$cursus = "CS2I";
				$niveau = 1;
			break;
			case 'B2':
				$cursus = "CS2I";
				$niveau = 2;
			break;
			case 'B3':
				$cursus = "CS2I";
				$niveau = 3;
			break;
			case 'M1':
				$cursus = "CS2I";
				$niveau = 4;
			break;
			case 'M2':
				$cursus = "CS2I";
				$niveau = 5;
			break;
			default:
				$cursus = "";
				$niveau = "";
			break;
		}

		$sql = "SELECT * FROM releve_note r
				INNER JOIN utilisateur u ON u.code_utilisateur = r.code_utilisateur
				INNER JOIN matiere m ON m.code_utilisateur = u.code_utilisateur
				INNER JOIN epreuve e ON e.code_matiere = m.code_matiere
				WHERE e.cursus = ':cursus' AND e.niveau = :niveau";
		$req = $this->db->prepare($sql);
		$req->bindValue(':cursus',$cursus);
		$req->bindValue(':niveau',$niveau);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function listeRelevesEnsPromo($promo){
		switch($promo){
			case 'I1':
				$cursus = "3IL";
				$niveau = 1;
				break;
			case 'I2':
				$cursus = "3IL";
				$niveau = 2;
				break;
			case 'I3':
				$cursus = "3IL";
				$niveau = 3;
				break;
			case 'B1':
				$cursus = "CS2I";
				$niveau = 1;
			break;
			case 'B2':
				$cursus = "CS2I";
				$niveau = 2;
			break;
			case 'B3':
				$cursus = "CS2I";
				$niveau = 3;
			break;
			case 'M1':
				$cursus = "CS2I";
				$niveau = 4;
			break;
			case 'M2':
				$cursus = "CS2I";
				$niveau = 5;
			break;
			default:
				$cursus = "";
				$niveau = "";
			break;
		}

		$sql = "SELECT * FROM releve_note r
				INNER JOIN utilisateur u ON u.code_utilisateur = r.code_utilisateur
				INNER JOIN matiere m ON m.code_utilisateur = u.code_utilisateur
				INNER JOIN epreuve e ON e.code_matiere = m.code_matiere
				WHERE e.cursus = :cursus AND e.niveau = :niveau
				AND statut_sgp = 'traite'";
		$req = $this->db->prepare($sql);
		$req->bindValue(':cursus',$cursus);
		$req->bindValue(':niveau',$niveau);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function countRelevesByStatut($type,$statut, $id=0)
	{
		if($type == "ENS")
		{
			$sql="SELECT count(*) FROM releve_note where statut_sgp = 'traite' and statut_enseignant = :statut AND code_utilisateur = :id";
			$req = $this->db->prepare($sql);
			$req->bindValue(':statut',$statut);
			$req->bindValue(':id',$id);
		}
		else
		{
			$sql="SELECT count(*) FROM releve_note where statut_sgp = :statut";
			$req = $this->db->prepare($sql);
			$req->bindValue(':statut',$statut);
		}
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchColumn(0);
	}

	
	
	public function nbNouveauxEns(){
		$sql="SELECT count(*) FROM releve_note where statut_sgp = 'traité' and statut_enseignant = ''";
		$req = $this->db->prepare($sql);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchColumn(0);
	}
	
	public function nbTraiteEns(){
		$sql="SELECT count(*) FROM releve_note WHERE statut_sgp = 'traité' AND statut_enseignant = 'traité'";
		$req = $this->db->prepare($sql);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchColumn(0);
	}
	
	public function elevesEpreuve($code){
		$sql='SELECT * FROM eleve e INNER JOIN evaluation ev ON e.code_eleve = ev.code_eleve
			  WHERE ev.code_releve = :code ORDER BY ev.code_releve';
		$req = $this->db->prepare($sql);
		$req->bindValue(':code',$code);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}
	
	
	
	public function updateStatut($code,$statut){
		$sql = "UPDATE releve_note
				SET statut_enseignant = :statut
				WHERE code_releve = :code";
		$req = $this->db->prepare($sql);
		$req->bindValue(':statut',$statut);
		$req->bindValue(':code',$code,PDO::PARAM_INT);
		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
	}
	
	// Retourne lastInsertId
	public function creer($code_utilisateur, $date_retour){
		$sql = "INSERT INTO releve_note(date_creation, code_utilisateur, date_retour,statut_sgp, statut_enseignant) VALUES(NOW(), :code_util, :date_retour, :statutsgp, :statut_enseignant)";
		$req = $this->db->prepare($sql);

		$req->bindValue(':code_util',$code_utilisateur);
		$req->bindValue(':date_retour',Fonction::dateToSql($date_retour));
		$req->bindValue(':statutsgp',"traite");
		$req->bindValue(':statut_enseignant',"nouveau");

		try {
			$req->execute();
		}
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $this->db->lastInsertId();
	
	}
	

	
}
?>