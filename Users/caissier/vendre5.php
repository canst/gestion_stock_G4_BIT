<?php 
require ('../config/fonctions.php');
if (isset($_POST['search'])) 
{
	extract($_POST);
	$article_name = strip_tags($article_name);
	$details_article = searchProduct($article_name);
	$article_format= selectFormat($details_article['ID_PRODUCT']);
}
if (isset($_POST['add']))
{
	extract($_POST);
	$id = strip_tags($id);
	$product = strip_tags($product);
	$format = strip_tags($format);
	$quantite = strip_tags($quantite);
	$price = strip_tags($price);
	$type = strip_tags($type);
	$add = addToPanner($id, $product, $format, $quantite, $price, $type);
	$no = 1;
	//var_dump($order_content);
	echo "Produit enregistrer dans le pannier<br>";
	/*if ($_GET['ID'] AND !empty($_GET['ID'])) 
	{
		$rem = removeProductFromPanner($ID);
		echo "Produit supprime du pannier avec succes<br>";
	}*/
}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <style type="text/css">
 	td input
 	{
 		border: 0px;
 		background: transparent;
 	}
 </style>
 <body>



<form action="#" method="post">

 	<input type="search" name="article_name">

 	<button name="search">Rechercher</button>
 	
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
			</tr>
		</th>
	
 	<?php if (isset($details_article) AND !empty($details_article)) {
 		foreach (array($details_article) as $details_article): ?>
 			<tr>
 			<td><input type="text" name="id" value="<?= $details_article['ID_PRODUCT']?>" readonly></td>
 			<td><input type="text" name="type" value="<?= $details_article['NAME']?>" required readonly></td>
 			<td><input type="text" name="product" value="<?= $details_article['PRODUCT_NAME']?>" required readonly></td>
 			<td><input type="text" name="format"></td>
 			<td><input type="number" name="quantite" max="<?= $details_article['QUANTITY']?>" min=0 value="<?= $details_article['QUANTITY']?>" required ></td>
 			<td><input type="text" name="price" value="<?= $details_article['PRICE']?>" required readonly></td>
 			</tr>

 	<?php endforeach;
 		echo '<button name="add">Ajouter</button>';
 	 } ?>
 	 </table>
 </form>

<?php 
if (isset($_POST['add'])) 
{
	echo '<a href="commande.php?No=1">CONTENU DE LA COMMANDE</a>';
}
 ?>
 
 </body>
 </html>