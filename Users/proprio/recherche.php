<?php 
require('../config/fonctions.php');
if (isset($_POST) AND !empty($_POST))
{	
	//recherche et modifications de type de produits
	global $rechercheType;
	if (isset($_POST['lookup']))
	{
		$rechercheType = searchType($_POST['lookup']);
	}
	$id = $rechercheType['ID_TYPE'];
	if (isset($_POST['UdtType'])) 
	{
		$type = strip_tags($_POST['udtType']);
		$mod = updateType($type, $id);
		$rechercheType = searchType($_POST['udtType']);
	}
	//fin du script de recherches et modifiction de type
}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>RECHERCHE</title>
 </head>
 <body>
 	<!--AFFICHAGE DES RESULTATS DE RECHERCHE-->
 <?php if (isset($rechercheType) AND !empty($rechercheType)): ?>
 	<form action="#" method="post">
 		<input type="text" name="udtType" required value="<?= $rechercheType['NAME']?>">
 		<button name="UdtType">Enregistrer les Modifications</button>
 	</form>
 <?php endif ?>
 </body>
 </html>