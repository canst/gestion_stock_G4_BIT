<?php 
require('../config/fonctions.php');
$users = userCashbox();
if (isset($_GET) AND !empty($_GET))
{
	$User = lookCashier($_GET['ID']);
	//var_dump($User); 
	//echo $User['NAME'];die();
		if (isset($_POST) AND !empty($_POST))
		{
			extract($_POST);
			$numero = strip_tags($numero);
			$user = strip_tags($user);
			$mod = setCashboxUser($numero, $user);
			$users = usersCashbox();
			$User = lookCashier($_GET['ID']);
		}
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>MODIFICATIONS DES PROPRIETES DUNE CAISSE</title>
 </head>
 <body>
 	<form action="#" method="post">
 		<input type="text" name="numero" value="<?= $User['No'] ?>" required><br>
 		<label>Choisir l'utilisateur</label>
 		<select name="user">
 			<option value="<?= $User['NAME'] ?>"><?= $User['NAME'] ?></option>
 			<?php foreach($users as $user) : ?>
 				<option value="<?= $user['NAME']?>"><?= $user['NAME'] ?></option>
 			<?php endforeach ?> 
 		</select>
 		<br><button>Enregister</button>
 	</form>
 	<a href="creer_caisse.php">RETOUR</a>
 </body>
 </html>