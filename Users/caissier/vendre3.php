<?php 
//require('../config/fonctions.php');
require('data.php');
$articles = dispo();


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>COMMANDES</title>
 </head>
 <script type="text/javascript" src="jquery/jquery-3.5.1.min"></script>
 <script type="text/javascript">
 	$(document).ready(function()
	 		{ $('#products').change(function()
	 			{ var pid = $('#products').val();
				 $.ajax
				 ({
	 				url : 'data.php',
	 				method : 'post',
	 				data : 'pid = ' + pid
	 			}).done(function(format)
		 			{
		 				console.log(format);
		 			})
	 			})
	 		})
 </script>
 <body>
 
<form>
	<select id="products" name="products">
		<option selected disabled>Selectioner produit</option>
<?php foreach ($articles as $article): ?>
	<option value="<?= $article->PRODUCT_NAME?>"><?= $article->PRODUCT_NAME?></option>
<?php endforeach ?>		
	</select>


	<select id="products" name="products" disabled="" selected="">
		<option>Selectioner format </option>
	</select>


	<select id="products" name="products">
		
	</select>
</form>


 </body>
 </html>