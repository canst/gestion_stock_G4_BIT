<?php 

require('../config/fonctions.php');
$caisses = usersCashbox();
$cashier = userCashbox();
if (isset($_GET) AND !empty($_GET))
{
	$del = deleteCashbox($_GET['ID']);
	$caisses = usersCashbox();
	$cashier = userCashbox();
	echo "Caisse supprimee avec succes...";
}
if (isset($_POST) AND !empty($_POST))
		{
		//creation de la caisse
			if (isset($_POST['creation'])) 
			{
				extract($_POST);
				$numero = strip_tags($numero);
				$caissier = strip_tags($caissier);
				$newCaisse = newCashbox($numero, $caissier);
				$caisses = usersCashbox();
				echo "Nouvelle caisse creee...";
			}
		}

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Caisses</title>
 </head>
 <body>
 <form action="#" method="post">
 	<input type="numeric" name="numero" required>
 	<select name="caissier">
 		<?php foreach ($cashier as $cashier): ?>
 			<option value = "<?= $cashier['NAME']?>"><?= $cashier['NAME']?></option>
 		<?php endforeach ?>
 	</select><br>
 	<button name="creation">Nouvelle caisse</button>
			
 </form>

<!--AFFICHAGE DES CAISSES-->
<table>
	<th>
		<tr>
			<td>No.</td>
			<td>CAISSIER</td>
			<td colspan="2">ACTION</td>
			<td></td>
		</tr>
	</th>
<?php foreach($caisses as $caisse): ?>
	<tr>
		<td><?= $caisse['No'] ?></td>
		<td><?= $caisse['NAME'] ?></td>
		<td><a href="creer_caisse.php?ID=<?= $caisse['ID_CASHBOX'] ?>">supprimer</a></td>
		<td><a href="assigner_caisse.php?ID=<?= $caisse['ID_CASHBOX'] ?>">modifier</a></td>
	</tr>
<?php endforeach ?>

</table>



 </body>
 </html>