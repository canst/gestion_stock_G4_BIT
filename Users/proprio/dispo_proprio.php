 <?php 

require('../config/fonctions.php');
$rows = dispo();
$types = showTypes();

if (isset($_POST) AND !empty($_POST))
{
	if (isset($_POST['nvProduit']))
	{
		extract($_POST);
		$nom = strip_tags($nom);
		$format = strip_tags($format);
		$reduction = strip_tags($reduction);
		$expiration = strip_tags($expiration);
		$type = strip_tags($type);
		$quantite = strip_tags($quantite);
		$prix = strip_tags($prix);
		$modifications = addProduct($nom, $format, $expiration, $reduction, $quantite, $prix, $type);
		$rows = dispo();
	}
}

if (isset($_GET) AND !empty($_GET))
{
	$del = deleteProduct($_GET['ID']);
	$rows = dispo();
}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Produits disponibles</title>
</head>
<body>
	<h2>NOUVEAU PRODUIT</h2>
//////////////////////////////////////////////////////////////////

<form action="#" method="post">
 		<label>Nom du prouit</label><br>
 	<input type="text" name="nom" required><br>
 	<label>format</label><br>
 	<input type="text" name="format" required><br>
 	<label>Taux de reduction</label><br>
 	<input type="text" name="reduction" required><br>
 	<label>Date dexpiration</label><br>
 	<input type="date" name="expiration" required><br>
 	<label>Quantite</label><br>
 	<input type="text" name="quantite" required><br>
 	<label>Prix</label><br>
 	<input type="text" name="prix" required><br>
 	<label>Type du produit</label><br>

 	<select name="type">
 		<?php
 		foreach($types as $type): ?>
 			<option value="<?= $type->NAME?>"><?= $type->NAME?></option>
 		<?php endforeach ?>
 	</select>

 	<button name="nvProduit">Enregistrer</button>
 </form>



//////////////////////////////////////////////////////////////////
 <h2>Produits disponibles</h2>
 <table>
 	<thead>
 		<td>NOM</td>
 		<td>FORMAT</td>
 		<td>PRIX</td>
 		<td>TAUX DE REDUCTION</td>
 		<td>EXPIRATION</td>
 		<td>QUANTITE</td>
 		<td>TYPE</td>
 		<td>SUPPRIMER</td>
 		<td>MODIFIER</td>
 	</thead>
 	<?php if(isset($rows) AND !empty($rows)){ foreach ($rows as $row): ?>
 		<tr>
 		<td><?= $row->PRODUCT_NAME?></td>
 		<td><?= $row->FORMAT?></td>
 		<td><?= $row->PRICE?></td>
 		<td><?= $row->REDUCTION_RATE?></td>
 		<td><?= $row->EXPIRATION?></td>
 		<td><?= $row->QUANTITY?></td>
 		<td><?= $row->NAME?></td>
 		<td><a href="dispo_proprio.php?ID=<?=$row->ID_PRODUCT?>&amp;FORMAT=<?=$row->FORMAT?>&amp;NAME=<?=$row->NAME?>">Supprimer</a></td>
 		<td><a href="modifier_produit.php?ID=<?=$row->ID_PRODUCT?>&amp;FORMAT=<?=$row->FORMAT?>&amp;NAME=<?=$row->NAME?>">Modifier</a></td>
 	</tr>
 	<?php endforeach; } ?>
 </table>
</body>
</html>