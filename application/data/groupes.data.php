<?php
defined('__ERELEVE__') or die('Acces interdit');

class Groupes extends DataTable {


	public function lister(){	
		$sql = 'SELECT * FROM groupe
			ORDER BY code_groupe ASC';
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