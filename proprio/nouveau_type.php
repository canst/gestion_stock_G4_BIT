<?php 
require('../config/fonctions.php');
//affichage des differents types dans des input

$row = showTypes();

if (isset($_POST) AND !empty($_POST)) 
{
	if(isset($_POST['creer']))
	{
		$nvType = newTtype($_POST['type']);
		$row = showTypes();
	}
	
}

//suppression dun type
if (isset($_GET) AND !empty($_GET))
{
	$del = deleteType($_GET['ID']);
	header('location: nouveau_type.php');
}

//recherche et modifications de type de produits
	if (isset($_POST['lookup']))
	{
		$rechercheType = searchType($_POST['lookup']);
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>CREER NOUVEAU TYPE DE PRODUIT</title>
</head>
<body>
<h2>CREER UN NOUVEAU TYPE DE PRODUIT</h2>

<form action="#" method="post">
	<label>Nom du nouveau type de produit</label><br>
	<input type="text" name="type"><br>
	<button name = "creer">Creer</button>
</form>

<h2>RECHERCHER UN TYPE</h2>
<form action="#" method="post">
	<input type="search" name="lookup">
	<button name='look'>Rechercher</button>
</form>

<table>
		<thead>
			<tr>
				<td>Type</td>
				<td>Supprimer</td>
				<td>Modifier</td>
			</tr>
		</thead>
<?php foreach ($row as $type):?>
		<tr>
			<td><?= $type->NAME?></td>
			<td><a href="nouveau_type.php?ID=<?php if(isset($_POST['lookup'])){ echo $rechercheType['NAME'];} else{ echo $type->ID_TYPE; }?>">supprimer</a></td>
			<td><a href="modifierType.php?ID=<?php if(isset($_POST['lookup'])){ echo $rechercheType['NAME'];} else{ echo $type->ID_TYPE; }?>">modifier</a></td>
		</tr>
<?php endforeach ?>
</table>
</body>
</html>