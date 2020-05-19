<?php 
require ('../config/fonctions.php');
global $order_content;
if (isset($_GET) AND !empty($_GET)) 
{
	$order_content = pannerContent($_GET['No']);
}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h2>CONTENU DE LA COMMANDE</h2>
<form action="#" method="post">
	<table>
		<th>
			<tr>
				<td>ID</td>
				<td>TYPE</td>
				<td>PRODUIT</td>
				<td>FORMAT</td>
				<td>QUANTITE</td>
				<td>PRIX</td>
				<td>SUPPRIMER</td>
			</tr>
		</th>
	
 	<?php $SUM=0;  var_dump($order_content); 
 	if (isset($order_content) AND !empty($order_content)) {
 		foreach ($order_content as $order_content): ?>
 			<tr>
 			<td><input type="text" name="id" value="<?= $order_content->ID_PRODUCT?>" readonly></td>
 			<?php die(); ?>
 			<td><input type="text" name="type" value="<?= $order_content->TYPE?>" required readonly></td>
 			<td><input type="text" name="product" value="<?= $order_content->PRODUCT_NAME?>" required readonly></td>
 			<td><input type="text" name="format"></td>
 			<td><input type="number" name="quantite" max="<?= $order_content->QUANTITY?>" min=0 value="<?= $order_content->QUANTITY?>" required ></td>
 			<td><input type="text" name="price" value="<?= $order_content->PRICE?>" required readonly></td>
 			<td><a href="vendre5.php?ID=<?= $order_content->ID_PRODUCT?>">supprimer</a></td>
 			</tr>
 	<?php $SUM += $order_content->QUANTITY*$order_content->PRICE; endforeach;
 		echo '<button name="save">ENREGISTRER</button><br>';
 		echo $SUM;
 	 } ?>
 	 </table>
 </form>



</body>
</html>