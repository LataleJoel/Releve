<?php
defined('__ERELEVE__') or die('Acces interdit');
?>


<form action="index.php?controller=utilisateurs&action=editer" method="POST" class="form-horizontal" role="form" >
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="titre">&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-user'></span>&nbsp;&nbsp;&nbsp;&nbsp;Ajout d'un utilisateur<?php if (isset($this->titre)) echo $this->titre; ?></h2>
    </div>

    <div class="modal-body"  id="responsive" tabindex="-1" data-width="760">  
        <div class="row-fluid">
            <div class="form-group" id="addmodal"><div id="titre"></div>
                &nbsp;&nbsp;&nbsp;&nbsp;<?php if (isset($this->message)) echo $this->message; ?>
                <label for="nom" class="col-sm-2 control-label">Nom  </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php if (isset($this->nom)) echo $this->nom; ?>" <?php if (isset($this->codeAttribut)) echo $this->codeAttribut; ?>><br>
                </div>

                <label for="prenom" class="col-sm-2 control-label">Prenom  </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" value="<?php if (isset($this->prenom)) echo $this->prenom; ?>" <?php if (isset($this->codeAttribut)) echo $this->codeAttribut; ?>><br>
                </div>

                <label for="adresse" class="col-sm-2 control-label">Adresse </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php if (isset($this->adresse)) echo $this->adresse; ?>" <?php if (isset($this->codeAttribut)) echo $this->codeAttribut; ?>><br>
                </div>

                <label for="mail" class="col-sm-2 control-label">Email  </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mail" name="email"  placeholder="Email" value="<?php if (isset($this->mail)) echo $this->mail; ?>" <?php if (isset($this->codeAttribut)) echo $this->codeAttribut; ?>><br>
                </div>

                <label for="telephone" class="col-sm-2 control-label">Telephone </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone" value="<?php if (isset($this->telephone)) echo $this->telephone; ?>" <?php if (isset($this->codeAttribut)) echo $this->codeAttribut; ?>><br>
                </div>


                <label for="pseudonyme" class="col-sm-2 control-label">Pseudonyme </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pseudonyme" name="login" placeholder="Pseudonyme" value="<?php if (isset($this->login)) echo $this->login; ?>" <?php if (isset($this->codeAttribute)) echo $this->codeAttribute; ?> <?php if (isset($this->codeAttribut)) echo $this->codeAttribut; ?> ><br>
                </div>

                <label for="mdp" class="col-sm-2 control-label">Password  </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Password" value="<?php if (isset($this->mdp)) echo $this->mdp; ?>" <?php if (isset($this->codeAttribut)) echo $this->codeAttribut; ?>><br>
                </div>

                <input type="hidden"  name="id" value="<?php if (isset($this->code_utilisateur)) echo $this->code_utilisateur; ?>" > 

                <label for="type_utilisateur" class="col-sm-2 control-label">Categorie  </label>
                <div class="col-sm-10"> 

				<?php
                    if ($this->etatSelectList === false) {

                        echo '<input type="text" class="form-control" id="statut" name="statut" placeholder="statut" value="' . $this->listeTypeUser['libelle'] . '" ' . $this->codeAttribute . ' ><br>';
                    }
                    if ($this->etatSelectList === true) {

                        echo'<select class="form-control" name="type_utilisateur" id="type_utilisateur">';

                        foreach ($this->listeTypeUser as $value) {
                            echo '<option value="' . $value['code_type'] . '" name="code_type">' . $value['libelle'] . '</option>';
                        }

                        echo'</select>';
                    }
                    ?>
                    

                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <div id="AfficheBtn">
            <?php
			 
            //$this->button renvoi les buttons adaptés à l'action
            if (isset($this->button)){
                echo $this->button;
				
			}
            ?>
        </div>
    </div>
</form>