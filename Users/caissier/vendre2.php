<?php 


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>VENDRE</title>
 </head>
 <body>
<table>
	<thead>
		<tr>
			<td>PRODUIT</td>
			<td>FORMAT</td>
			<td>QUANTITE</td>
			<td colspan="2">ACTION</td>
			<td></td>
		</tr>
		<?php //foreach ($variable as $key => $value): ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<?php //endforeach ?>
	</thead>
</table> 

<form>


	<select id="produit" data-target = "#format" data-source = "liste.php/type=PRODUCT_NAME&filter=$id" class="linked-select">
		<option value='0'>Selectionner un produit</option>
		<?php 
		require '../config/connect.php';
		$products = $bdd->query('SELECT ID_PRODUCT, PRODUCT_NAME FROM gs.products');
		foreach ($products as $product) 
			{ ?>
				<option value="<?= $product['ID_PRODUCT']?>"><?= $product['PRODUCT_NAME']?></option>
			<?php	}
		 ?>
	</select>


	<select id="format" data-target = "#format" data-source = "liste.php/type=FORMAT&filter=$id" class="linked-select">
		<option value='0'>Selectionner un produit</option>
		
	</select>


	<select id="quantite" data-source = "liste.php/type=QUATITY&filter=$id">
		<option value='0'>Selectionner un produit</option>
		<?php 
		require '../config/connect.php';
		$products = $bdd->query('SELECT ID_PRODUCT, PRODUCT_NAME FROM gs.products');
		foreach ($products as $product) 
			{ ?>
				<option value="<?= $product['ID_PRODUCT']?>"><?= $product['PRODUCT_NAME']?></option>
			<?php	}
		 ?>
	</select>












	<!--<input type="text" name="produit" placeholder="Nom du produit" required>
	<input type="text" name="format" placeholder="Format du produit" required>
	<input type="numeric" name="qty" placeholder="Quantite" required>
	<br>-->
	<button>Ajouter</button>
	<button>Valider la commande</button>
</form>	

<script type="text/javascript" src="main.js"></script>
 </body>
 </html>