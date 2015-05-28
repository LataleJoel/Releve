<?php
    defined('__EAPPEL__') or die('Acces interdit');
?>
<div id="accueil">
    <h1><img src="application/images/e-appel_main_logo.png" alt="e-appel main logo"/></h1>
    <div>
        <?php if($this->message != ""):?>
        <p><?php echo $this->message;?></p>
        <?php endif;?>
        <form name="connexion" action="index.php?controller=index&action=index" method="post">
            <label for="login">Login : </label>
            <input type="text" name="login" id="login" value="<?php echo $this->login;?>"/>
            <label for="motdepasse">Mot de passe : </label>
            <input type="password" name="motdepasse" id="motdepasse" value="<?php echo $this->motdepasse;?>"/>
            <input type="submit" value="Se Connecter"  />
        </form>
    </div>
</div>

