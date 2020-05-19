<?php 
require ('../config/fonctions.php');
/*

$req=> resultat de la recherche
$reqformat=>format du produit choisi
$items=> donnees des produits  deja enregistres mais pas valides
$reqformat2=>format du produit choisi pour les produits preenregistres
dupliquer une table
*/
//resulats de la recherche dun produit
if (isset($_POST))
{
	global $req;
	if (isset($_POST['search']))
	{
		extract($_POST);
		$name = strip_tags($name);
		$req = searchProduct($name);
		$reqformat= selectFormat($req['ID_PRODUCT']);
		if (isset($_POST['add']))
		{
			$client = selectAllClients();
			extract($_POST);
			$id = strip_tags($id);
			$product = strip_tags($product);
			$format = strip_tags($format);
			$quantite = strip_tags($quantite);
			$price = strip_tags($price);
			$type = strip_tags($type);
			$add = addToPanner($id, $product, $format, $quantite, $price, $type);
			$items = pannerContent();
			//$command = orderContent(1, $id, $product, $format, $quantite, $price, $type);
		}
	}
	

	if (isset($_POST['save']))
				{	

					foreach ($_POST as $order) 
					{
						$article = setOder(1, $order['id'], ID_CLIENT, $order['quantite'],TYPEPAYEMENT , $order['price']);	
					}
					//doit etre ajoute le type de paiement, la somme payee

				}

	
	
	
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>vendre</title>
 </head>
 <style type="text/css">
 	td input
 	{
 		border: 0px;
 		background: transparent;
 	}
 </style>
 <body>
 
<!--<script type="text/javascript">
 		var parent = document.getElementById('champs');
 		var i = 0;
 		function addInput()
 		{
 			product = document.createElement('input');
 			format = document.createElement('input');
 			quantity = document.createElement('input');
 			
 			inputs.setType = 'text';
 			inputs.Name = 'product'+i;
 			document.getElementById('champs').appendChild(inputs);
 			i++;
 		}
 		function remInput()
 		{
 			//var input = '<input type="text" name="">';
 			document.getElementById('champs').removeChild(document.getElementById('champs').lastChild);
 		}
 	</script>-->
 <form action="#" method="post">

 	<input type="search" name="client">
 	<!--jquery sort-list-->
 	<button name="search">Rechercher</button>
 	<!--<input type="button" name="ajout" value="ajouter" onClick='addInput()'>
 	<input type="button" name="sup" value="suprimerer" onClick='remInput()'>-->
 </form>
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

<h2>PERSONNALISATION DU PRODUIT DE LA COMMANDE</h2>
<form action="#" method="post">
	<table>
		<th>
			<tr>
				<td>ID</td>
				<td>TYPE</td>
				<td>PRODUIT</td>
				<td>FORMAT</td>
				<td>QUANTITE</td>
				<td>PRICE</td>
				<td>SUPPRIMER</td>
			</tr>
		</th>
	
 	<?php if (isset($req) AND !empty($req)) {
 		foreach (array($req) as $req): ?>
 			<tr>
 			<td><input type="text" name="id" value="<?= $req['ID_PRODUCT']?>" readonly></td>
 			<td><input type="text" name="type" value="<?= $req['NAME']?>" required readonly></td>
 			<td><input type="text" name="product" value="<?= $req['PRODUCT_NAME']?>" required readonly></td>
 			<td><input type="text" name="format"></td>
 			<td><input type="number" name="quantite" max="<?= $req['QUANTITY']?>" min=0 value="<?= $req['QUANTITY']?>" required ></td>
 			<td><input type="text" name="price" value="<?= $req['PRICE']?>" required readonly></td>
 			<td><a href="vendre4.php?ID=<?= $req['ID_PRODUCT']?>">supprimer</a></td>
 			</tr>

 	<?php endforeach;
 		echo '<button name="add">Ajouter</button>';
 	 } ?>
 	 </table>
 </form>


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
<!--<h2>CONTENU DE LA COMMANDE</h2>
 <form action="#" method="post">
 	***************************
 	<input type="search" name="client">
 	***************************



 	<?php if (isset($items)) { 
 		$sum = 0; 
 		foreach (array($items) as $item): ?>
 			<input type="text" name="product" value="<?= $item['PRODUCT_NAME']?>" required >

 			<select name="format">
 				<option value="<?= $item['FORMAT']?>" selected><?= $item['FORMAT']?></option>
 				<?php foreach ($formats as $format): ?>

 					<option value="<?= $reqformat['']?>"><?= $reqformat2['']?></option>

 				<?php endforeach ?>
 			</select>

 			<input type="number" name="quantit" max="<?= $item['QUANTITY']?>" value="<?= $item['QUANTITY']?>" min=0 required>

 			<input type="text" name="price" value="<?= $item['PRICE']?>" required >

 			<input type="text" name="type" value="<?= $item['TYPE']?>" required ><a href="vendre4.php?ID=<?= $item['ID_PRODUCT']?>">supprimer</a>
 			<button name='save'>Enregistrer</button>
 	<?php $sum += $item['QUANTITY']*$item['PRICE']; endforeach; } ?>
 </form>
-->
 </body>
 </html>