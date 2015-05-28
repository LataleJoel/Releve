<?php
defined('__ERELEVE__') or die('Acces interdit ');

if (isset($this->message))
    echo '<p class="message">' . $this->message . '</p>';
?>

<section id="section">
    <!-- Modal -->
    <div class="modal fade" id="creer1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php require_once 'utilisateur.view.php'; ?>
            </div> 
        </div> 
    </div>
    <a class="btn btn-primary btn-custom" data-toggle="modal"  data-target="#creer1" id="test1">
        <span class="glyphicon glyphicon-plus"></span> Créer un utilisateur
    </a>

    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable_custom" id="liste_releve">
    <thead>
            <tr>
                <th>Numéro</th>
                <th>Login</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Télephone</th>
                <th>Actions</th>
            </tr>
    </thead>
    <tbody> 
        <?php
            $i = 1;
            if(count($this->liste)>0){
                foreach ($this->liste as $value) {
            ?>
                    <tr>
                        <td><?php if (isset($value)) echo $i++; ?></td>
                        <td id="login"><?php if (isset($value)) echo $value['login']; ?></td>
                        <td id="nom"><?php if (isset($value)) echo $value['nom']; ?> </td>
                        <td id="prenom"><?php if (isset($value)) echo $value['prenom']; ?></td>
                        <td id="mail"><?php if (isset($value)) echo $value['mail']; ?></td>
                        <td id="code"><?php if (isset($value)) echo $value['libelle']; ?></td>
                        <td id="telephone"><?php if (isset($value)) echo $value['telephone']; ?></td>
                        <td class="text-center">
                                <form  action="index.php" method="get">
                                    <button type="button" name="action" value="afficher" class="btn btn-primary" id="test"> 
                                        <span class="glyphicon glyphicon-search datatables_action"></span>
                                    </button> 
                                    <button type="submit" name="action" value="editer" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil datatables_action"></span>
                                    </button>
                                    <button type="submit" name="action" value="supprimer" class="btn btn-primary" id="test3" onclick="">
                                        <span class="glyphicon glyphicon-trash datatables_action"></span>
                                    </button>
                                    <input type="hidden" name="controller" value="utilisateurs"/>
                                    <input type="hidden" id="adres"  name="adresse" value="<?php echo $value['adresse']; ?>"/>
                                    <input type="hidden" id="typeUtilisateur"  name="typeUtilisateur" value="<?php echo $value['libelle']; ?>"/>
                                    <input type="hidden" id="identifiant"  name="id" value="<?php echo $value['code_utilisateur']; ?>"/>
                                    
                                </form>   
                        </td>
                   </tr>
            <?php }
            
          }else
              echo 'Liste des enregistrements vides';?>

        </tbody>
        <tfoot>
            <tr>
                <th>Numéro</th>
                <th>Login</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Type</th>
                <th>Libelle</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>     
</section>

