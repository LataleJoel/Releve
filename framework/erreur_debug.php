<!DOCTYPE html>
<?php defined('__FRAMEWORK3IL__') or die('Acces interdit'); ?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Erreur</h1>
		<p><?php echo $this->message; ?></p>
		<p>Fichier : <?php echo $this->file; ?></p>
		<p>Ligne : <?php echo $this->line; ?></p>
		<p>Fonction : <?php echo $trace[0]['function']; ?></p>
		<pre><?php echo $this->getTraceAsString(); ?></pre>
	</body>
</html>