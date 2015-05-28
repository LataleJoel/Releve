<?php defined('__ERELEVE__') or die('Acces interdit');
?>

<div class="container">
    <div id="form-login">

        <div id="loginTabContent" class="tab-content form-login-content">
            <div class="tab-pane fade active in" id="login">

                <h3 id="titre"><span class="image"><su><img src="application/images/logo3il.png"/></su></span>E-releve : Authentification</h3> 

                <?php if ($this->message != ""): ?>
                    <p><?php echo $this->message; ?></p>
                <?php endif; ?>
                <form role="form" name="connexion" action="index.php?controller=index&action=index" method="post">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <label for="login"></label>
                        <input type="text" name="login" class="form-control" id="login" placeholder="Identifiant" autofocus value="<?php echo $this->login; ?>">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <label for="motdepasse"></label>
                        <input type="password"  name="motdepasse" class="form-control" id="motdepasse" placeholder="Mot de passe" value="<?php echo $this->motdepasse; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Se Connecter</button>
                </form>
            </div>
        </div>
    </div> <!-- /form-login -->
</div> <!-- /container -->

