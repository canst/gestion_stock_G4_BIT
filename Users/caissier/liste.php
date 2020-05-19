<?php 
require '../config/connect.php';
$type= empty($_GET['type']) ? 'produit' : $_GET['type'];
global $field;
if ($type === "PRODUCT_NAME")
{
	$field = 'FORMAT';
}
else if($type === "FORMAT")
{
	$field = 'QUANTITY';
}

$req = $bdd->prepare('SELECT '.$field.', ID_PRODUCT FROM gs.products WHERE ID_PRODUCT = ?');
$req->execute(array($_GET['filter']));

$items = $req->fetchAll();
//header(string: 'Content-Type: appliation/json');
echo json_encode(array_map(function ($items)
{
	return 
	[

		'label' => $items[0],
		'value' => $items['ID_PRODUCT']

	];
}

	, $items));

