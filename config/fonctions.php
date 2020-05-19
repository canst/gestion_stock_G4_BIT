<?php 

//fonction dinsertion de client
function addClient($nom, $prenom, $email, $contact, $type)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT INTO gs.clients (NAME, LASTNAME, EMAIL, CONTACTS, TYPE) VALUES(?,?,?,?,?)');
	$req->execute(array($prenom, $nom, $email, $contact, $type));
	$req->closeCursor();
}
//fonctio n de recherche de client en fonction de son nom
function selectClient($name, $lastname)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.clients WHERE NAME = ?, LASTNAME = ?');
	$req->execute(array($nom, $lastname));
	$req->fetchAll();
	return $req;
	$req->closeCursor();
}
//fonction de selection de tous les clients
function selectAllClients()
{
	require('connect.php');
	$req = $bdd->query('SELECT * FROM gs.clients');
	$client = $req->fetch();
	return $client;
	$req->closeCursor();
}
//liste de tous les produits disponinles
function dispo()
{
	require('connect.php');
	$req = $bdd->query('SELECT * FROM gs.products p, gs.type t WHERE p.QUANTITY > 0 AND p.ID_TYPE = t.ID_TYPE ');
	$row = $req->fetchAll(PDO::FETCH_OBJ);
	if ($req->rowCount()>0)
	{
		return $row;
	}
	else
	{
		echo "Aucun produit disponible pour le moment ...<br>";
	}
	$req->closeCursor();
}
//afficher un produit specifique (a modifier ou non) par le proprietaire ou le superviseur
function modifierProduit($id, $format, $name)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.products p, gs.type t WHERE p.ID_PRODUCT = ? AND p.FORMAT = ? AND t.NAME = ? AND p.ID_TYPE = t.ID_TYPE');
	$req->execute(array($id, $format, $name));
	$produit = $req->fetch(PDO::FETCH_OBJ);
	return $produit;
}
//modifier un produit specifique par le proprietaire ou le superviseur
function applyModifications($id, $nom, $format, $expiration, $reduction, $type)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE gs.products SET PRODUCT_NAME = ?, FORMAT = ?, REDUCTION_RATE = ?, EXPIRATION = ?,  ID_TYPE = ? WHERE ID_PRODUCT = ?');
	$req2 = $bdd->prepare('SELECT ID_TYPE FROM gs.type WHERE NAME = ?');
	$req2->execute(array($type));
	$idType = $req2->fetch(PDO::FETCH_OBJ);
	$req->execute(array($nom, $format, $reduction, $expiration, $idType->ID_TYPE, $id));
}

//fonction pour afficher les differents type de produit
function showTypes()
{
	require('connect.php');
	$req = $bdd->query('SELECT * FROM gs.type');
	$toustypes = $req->fetchAll(PDO::FETCH_OBJ);
	return $toustypes;
	$req->closeCursor();
}
function typeProduit($id)
{
	require('connect.php');
	/*$req = $bdd->prepare('SELECT ID_TYPE FROM gs.products WHERE ID_PRODUCT = ?');
	$req->execute(array($id));
	$typeProd = $req->fetch(PDO::FETCH_OBJ);
	$req2 = $bdd->prepare('SELECT NAME FROM gs.type WHERE ID_TYPE != ?'); 
	$req2->execute($typeProd->ID_TYPE);
	$types = $req2->fetchAll(PDO::FETCH_OBJ);*/
	$req = $bdd->prepare('SELECT * FROM gs.type t, gs.products p WHERE p.ID_PRODUCT = ? AND p.ID_TYPE != t.ID_TYPE');
	$req->execute(array($id));
	$types = $req->fetchAll(PDO::FETCH_OBJ);
	return $types;
	$req->closeCursor();
	//$req2->closeCursor();

}
//fonction pour  ajoueter un produit
function addProduct($nom, $format, $expiration, $reduction, $quantite, $prix, $type)
{
	require('connect.php');
	$req0 = $bdd->prepare('SELECT * FROM gs.products WHERE PRODUCT_NAME = ? AND FORMAT = ?');
	$req0->execute(array($nom, $format));
	if ($req0->rowCount()==0)
	{
		$req = $bdd->prepare('INSERT INTO gs.products (PRODUCT_NAME, FORMAT, EXPIRATION, REDUCTION_RATE, QUANTITY, PRICE, ID_TYPE) VALUES(?, ?, ?, ?, ?, ?, ( SELECT ID_TYPE FROM gs.type WHERE NAME = ?))');
		$req->execute(array($nom, $format, $expiration, $reduction, $quantite, $prix, $type));
		echo "Enresistrements reussis";
		$req->closeCursor();
	}
	else
	{
		echo "Produit existant";
	}
	
}
//fonction de suppression de produit
function deleteProduct($id)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM gs.products WHERE ID_PRODUCT = ? LIMIT 1');
	$req->execute(array($id));
}
//creation dun nouveau type
function newTtype($type)
{
	require('connect.php');
	$req0 = $bdd->prepare('SELECT * FROM gs.type WHERE NAME = ?');
	$req0->execute(array($type));
	if ($req0->rowCount()==0)
	{
		$req = $bdd->prepare('INSERT INTO gs.type(NAME) VALUES (?)');
		$req->execute(array($type));
		$req->closeCursor();
	}
	
}
//mise a jour des modifications sur les types de produits
function updateType($type, $id)
{
	require('connect.php');
	$req2 = $bdd->prepare('UPDATE gs.type SET NAME = ? WHERE ID_TYPE = ?');
	$req2->execute(array($type, $id));
}

//fonction pour supprimer un type
function deleteType($id)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM gs.type WHERE ID_TYPE = ? LIMIT 1');
	$req->execute(array($id));
}
//fonction de recherche dun type
function searchType($type)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.type WHERE NAME LIKE "%?%"');
	$req->execute(array($type));
	$toustypes = $req->fetchAll(PDO::FETCH_ASSOC);
	if ($req->rowCount()>0)
	{	
		echo "RESULTATS DE RECHERCHE POUR '".$type."'";
		return $toustypes;
	}
	else
	{
		echo "RESULTATS DE RECHERCHE POUR '".$type."'<br>";
		echo "Pas de correspondance...";
	}
	$req->closeCursor();
}
//fonction de recherche dun type de produit bien defini
function searchIdType($id)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.type WHERE ID_TYPE = ?');
	$req->execute(array($id));
	$type = $req->fetch(PDO::FETCH_ASSOC);
	return $type;
	$req->closeCursor();

}

//fonction de recherche de tous les users pour des caisses
function usersCashbox()
{
	require('connect.php');
	$req = $bdd->query('SELECT * FROM gs.users u, gs.cashbox c WHERE u.ID_USER = c.ID_USER');
	$users = $req->fetchAll(PDO::FETCH_ASSOC);
	return $users;
	$req->closeCursor();
}
//fonction de recherche des UTILISATEURs non assignes a une caisse
function userCashbox()
{
	require('connect.php');
	$req = $bdd->query('SELECT * FROM gs.users LEFT JOIN gs.cashbox ON gs.users.ID_USER WHERE gs.cashbox.ID_USER IS NULL AND gs.users.TYPE = \'Caissier\'');
	$user = $req->fetchAll(PDO::FETCH_ASSOC);
	return $user;
	$req->closeCursor();
}
//fonction de recherche de LUTILISATEUR dune caisse en fonction du numero de la caisse
function lookCashier($id)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.cashbox c, gs.users u WHERE ID_CASHBOX = ? AND u.ID_USER = c.ID_USER');
	$req->execute(array($id));
	$users = $req->fetch();
	return $users;
	$req->closeCursor();
}


//fonction de creation de nvelle caisse
function newCashbox($no, $cashier)
{
	require('connect.php');
	require('connect.php');
	$req0 = $bdd->prepare('SELECT * FROM gs.cashbox c, gs.users u WHERE c.No = ? AND u.NAME = ?');
	$req0->execute(array($no, $cashier));
	if ($req0->rowCount()==0)
	{
		$req = $bdd->prepare('INSERT INTO gs.cashbox (No, ID_USER) VALUES(?, (SELECT ID_USER FROM gs.users WHERE NAME = ?))');
		$req->execute(array($no, $cashier));
		$req->closeCursor();
	}
	else
	{
		echo "Individu deja assigne a une caisse...";
	}
	$req0->closeCursor();
}

//suprimer une caisse
function deleteCashbox($id)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM gs.cashbox WHERE No = ? LIMIT 1');
	$req->execute(array($id));
	$req->closeCursor();
	
}
//mettre a jour les donnees dune caisse
function setCashboxUser($no, $cashier)
{
	require('connect.php');
	require('connect.php');
	$req0 = $bdd->prepare('SELECT * FROM gs.cashbox c, gs.users u WHERE c.No = ? AND u.NAME = ?');
	$req0->execute(array($no, $cashier));
	if ($req0->rowCount()==0)
	{
		$req = $bdd->prepare('UPDATE gs.cashbox SET No = ?, ID_USER = (SELECT ID_USER FROM gs.users WHERE NAME = ? )');
		$req->execute(array($no, $cashier));
		echo "Modifications effectuees";
	}
	else
	{
		echo "Caissier ou Numero de caisse deja definit(s)";
	}
}

//fonction de selection du format
function selectFormat($id)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.products WHERE ID_PRODUCT = ?');
	$req->execute(array($id));
	$formats = $req->fetch();
	return $formats;
	$req->closeCursor();
}
//chercher un produit specifique pour la vente
function searchProduct($name)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.products, gs.type WHERE PRODUCT_NAME = ?');
	$req->execute(array($name));
	$formats = $req->fetch();
	return $formats;
	$req->closeCursor();	
}
//fonction denregistrement des ventes
function setOrder($cashier, $client, $payment, $quantity, $paid)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT INTO gs.orders (ID_CASHBOX, ID_CLIENT, PAYMENT_TYPE, QUANTITY, PAID, DATE) VALUES(?,?,?,?,?)');
	$req->execute(array($cashier, $client, $payment, $quantity, $paid,NOW()));
	$req->closeCursor();		
}
// fonction dajout de produit au pannier sun client
function addToPanner($id, $produit, $format, $quantite, $price, $type)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT INTO gs.panner (No, ID_PRODUCT, PRODUCT_NAME, FORMAT, QUANTITY, PRICE, TYPE) VALUES(?,?,?,?,?,?,?)');
	$req->execute(array(1, $id, $produit, $format, $quantite, $price, $type));
	$req->closeCursor();
}
//donctiom daffichage du contenu du panier
/*
function pannerContent($no)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.panner WHERE No = ?');
	$req->execute(array($no));
	$panner = $req->fetchAll();
	return $panner;
	$req->closeCursor();
}
*/
function pannerContent($no)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.panner WHERE No = ?');
	$req->execute(array($no));
	$panner = $req->fetchAll();
	return $panner;
}
// supprimer un produit du panier
function removeProductFromPanner($id)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM gs.panner WHERE ID_PRODUCT = ? LIMIT 1');
	$req->execute(array($id));
	$req->closeCursor();
}

 ?>