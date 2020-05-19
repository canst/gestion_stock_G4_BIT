<?php 


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Ventes</title>
 </head>
 <body>
 	<script type="text/javascript">
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
 	</script>
 <form action="#" method="post">
 	<div id="champs">
 		<input type="text" name="">
 	</div>
 	<input type="button" name="ajout" value="ajouter" onClick='addInput()'>
 	<input type="button" name="sup" value="suprimerer" onClick='remInput()'>
 </form>
 </body>
 </html>