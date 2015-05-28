<?php
defined('__ERELEVE__') or die('Acces interdit');

class TypeUtilisateurs extends DataTable {
    
        /*
         * 
         *  Cette methode renvoie la liste (code_type_utilisateur et libelle_utilisateur
         * 
         */
    
		public function lister() {
			$sql = 'SELECT code_type, libelle FROM type_user WHERE code_type!=1';
		
			$req = $this->db->prepare($sql);
			
			try {
				$req->execute();
			} 
			catch(PDOException $err){
				throw new Erreur('Erreur SQL ' . $err->getMessage());
			}
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function listerByID($code_type) {
			$sql = 'SELECT  libelle FROM type_user where code_type= :code_type ';
		
			$req = $this->db->prepare($sql);
			$req->bindValue(':code_type',$code_type);
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