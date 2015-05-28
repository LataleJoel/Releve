<?php
defined('__ERELEVE__') or die('Acces interdit');

class Utilisateurs extends DataTable {

	public function listerEnseignants() {
		$sql = 'SELECT * FROM utilisateur WHERE code_type = :type';
	
		$req = $this->db->prepare($sql);
		$req->bindValue(':type',3);
		try {
			$req->execute();
		} 
		catch(PDOException $err){
			throw new Erreur('Erreur SQL ' . $err->getMessage());
		}
		return $req->fetchAll();
	}

	  public function utilisateur($id) {
        $sql = 'SELECT u.*, t.libelle AS libelle FROM utilisateur u INNER JOIN type_user t ON u.code_type=t.code_type WHERE code_utilisateur = :code_utilisateur';

        $req = $this->db->prepare($sql);
        $req->bindValue(':code_utilisateur', $id);
        try {
            $req->execute();
        } catch (PDOException $err) {
            throw new Erreur('Erreur SQL ' . $err->getMessage());
        }
        return $req->fetch();
    }

    /*
     * 	Réalise un UPDATE de "utilisateurs" avec l'[id] passé en parametre
     * 		si [motdepasse] est vide, on ne change pas de mot de passe
     */

    public function modifier($id, $nom, $prenom, $adresse, $email, $telephone, $motdepasse) {
        if ($motdepasse == "") {
            $sql = "UPDATE utilisateur SET  nom=:nom, prenom=:prenom,mail=:email,adresse=:adresse, telephone=:telephone WHERE code_utilisateurd=:id";

            $req = $this->db->prepare($sql);
            $req->bindValue(':nom', $nom, PDO::PARAM_STR);
            $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $req->bindValue(':email', $email, PDO::PARAM_STR);
            $req->bindValue(':adresse', $adresse, PDO::PARAM_STR);
            $req->bindValue(':telephone', $telephone, PDO::PARAM_INT);
            $req->bindValue(':login', $login, PDO::PARAM_STR);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
        } else {
            $sql = "UPDATE utilisateur SET nom=:nom, prenom=:prenom,mail=:email,adresse=:adresse, telephone=:telephone,mdp=:motdepasse WHERE code_utilisateur=:id";

            $req = $this->db->prepare($sql);
            $req->bindValue(':nom', $nom, PDO::PARAM_STR);
            $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $req->bindValue(':email', $email, PDO::PARAM_STR);
            $req->bindValue(':adresse', $adresse, PDO::PARAM_STR);
            $req->bindValue(':telephone', $telephone, PDO::PARAM_INT);
            $req->bindValue(':motdepasse', Authentification::encoder($motdepasse), PDO::PARAM_STR);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
        }

        try {
            $req->execute();
        } catch (PDOException $err) {
            throw new Erreur('Erreur SQL ' . $err->getMessage());
        }
    }

    public function supprimer($id) {
        $sql = "DELETE FROM utilisateur WHERE code_utilisateur=:id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $req->execute();
        } catch (PDOException $err) {
            throw new Erreur('Erreur SQL ' . $err->getMessage());
        }
    }

    public function lister() {
        $sql = 'SELECT u.*, t.libelle AS libelle FROM utilisateur u INNER JOIN type_user t ON u.code_type=t.code_type WHERE u.code_type != 1';
        $req = $this->db->prepare($sql);
        try {
            $req->execute();
        } catch (PDOException $err) {
            throw new Erreur('Erreur SQL ' . $err->getMessage());
        }
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creer($type, $nom, $prenom, $adresse, $email, $telephone, $login, $motdepasse) {
        $sql = "INSERT INTO utilisateur (code_utilisateur,code_type, nom, prenom, adresse, mail,telephone,login,mdp)"
                . " VALUES "
                . "(NULL,:type, :nom, :prenom, :adresse, :mail,:telephone, :login,:motdepasse)";

        $req = $this->db->prepare($sql);
        $req->bindValue(':type', $type, PDO::PARAM_INT);
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $req->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $req->bindValue(':mail', $email, PDO::PARAM_STR);
        $req->bindValue(':telephone', $telephone, PDO::PARAM_INT);
        $req->bindValue(':login', $login, PDO::PARAM_STR);
        $req->bindValue(':motdepasse', Authentification::encoder($motdepasse), PDO::PARAM_STR);

        try {
            $req->execute();
        } catch (PDOException $err) {
            throw new Erreur('Erreur SQL');
        }
    }
	
	public function getType($id){
	      $sql = 'SELECT code_type FROM utilisateur WHERE code_utilisateur = :code_utilisateur';

        $req = $this->db->prepare($sql);
        $req->bindValue(':code_utilisateur', $id);
        try {
            $req->execute();
        } catch (PDOException $err) {
            throw new Erreur('Erreur SQL ' . $err->getMessage());
        }
        return $req->fetch();
	}
	
}
?>