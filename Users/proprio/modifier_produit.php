<?php 
require('/config/fonctions.php');
if (isset($_GET) and !empty($_GET)) 
{
	$produit = modifierProduit($_GET['ID'], $_GET['FORMAT'], $_GET['NAME']);
	$types = typeProduit($_GET['ID']);

		if(isset($_POST) AND !empty($_POST))
	{
		extract($_POST);
		$nom = strip_tags($nom);
		$format = strip_tags($format);
		$reduction = strip_tags($reduction);
		$expiration = strip_tags($expiration);
		$type = strip_tags($type);
		$prix = strip_tags($prix);
		$modifications = applyModifications($_GET['ID'], $nom, $format, $expiration, $reduction, $type);
		$produit = modifierProduit($_GET['ID'], $_GET['FORMAT'], $_GET['NAME']);
		$types = typeProduit($_GET['ID']);
		echo "Enresistrements reussis";
	}
}
else 
{
	header('location: dispo.php');
}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>MODIFIER LES PROPRIETES DUN PRODUIT</title>
 </head>
 <body>

 <form action="#" method="post">
 	<?php if (isset($produit) AND isset($types)): ?>
 		<label>Nom du prouit</label><br>
 	<input type="text" name="nom" value="<?= $produit->PRODUCT_NAME?>" required><br>
 	<label>format</label><br>
 	<input type="text" name="format" value="<?= $produit->FORMAT?>" required><br>
 	<label>Taux de reduction</label><br>
 	<input type="text" name="reduction" value="<?= $produit->REDUCTION_RATE?>" required><br>
 	<label>Date dexpiration</label><br>
 	<input type="date" name="expiration" value="<?= $produit->EXPIRATION?>" required><br>
 	<label>Prix</label><br>
 	<input type="text" name="prix" value="<?= $produit->PRICE?>" required><br>
 	<label>Type du produit</label><br>

 	<select name="type">
 		<option value="<?= $produit->NAME?>"><?= $produit->NAME?></option>
 		<?php
 		foreach($types as $type): ?>
 			<option value="<?= $type->NAME?>"><?= $type->NAME?></option>
 		<?php endforeach ?>
 	</select>
 	<button>Enregistrer</button>
 	<?php endif ?>


 </form>
     <?php require "modifierType.php";?>
 <a href="dispo_proprio.php">RETOUR</a>
 </body>
 </html>