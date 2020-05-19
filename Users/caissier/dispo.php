 <?php 


$rows = dispo();

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Produits disponibles</title>
</head>
<body>
	
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
 	</tr>
 	<?php endforeach; }?>
 </table>
</body>
</html>