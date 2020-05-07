<?php 
require('../config/fonctions.php');
if (isset($_GET) AND !empty($_GET))
{	
	/*//recherche et modifications de type de produits
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
	//fin du script de recherches et modifiction de type*/
	$rechercheType = searchType($_GET['ID_TYPE']);
	$id = $rechercheType['NAME'];
	echo $id;
	if (isset($_POST) AND !empty($_POST))
	{
		extract($_POST);
		$udtType = strip_tags($udtType);
		$mod = updateType($udtType, $id);
	}

}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>MODIFIER TYPE</title>
 </head>
 <body>
 	<!--AFFICHAGE DES RESULTATS DE RECHERCHE-->
 <?php if (isset($rechercheType) AND !empty($rechercheType)): ?>
 	<form action="#" method="post">
 		<input type="text" name="udtType" required value="<?= $rechercheType['NAME']?>">
 		<button>Enregistrer les Modifications</button>
 	</form>
 <?php endif ?>
 <a href="creer_caisse.php">RETOUR</a>
 </body>
 </html>