<?php 
session_start();
//fonction dinsertion de client
function addClient($nom, $prenom, $email, $contact, $type)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT INTO gs.clients (NAME, LASTNAME, EMAIL, CONTACTS, TYPE) VALUES(?,?,?,?,?)');
	$req->execute(array($prenom, $nom, $email, $contact, $type));
	$req->closeCursor();
}
//fonction de recherche de client en fonction de son nom
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
	$clients = $req->fetchAll(PDO::FETCH_OBJ);
	return $clients;
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
	else
	{
		echo "TYPE DE PRODUIT DEJA EXISTANT";
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
	$req = $bdd->prepare('SELECT * FROM gs.products p, gs.type t WHERE p.PRODUCT_NAME = ? AND T.ID_TYPE = p.ID_TYPE AND p.QUANTITY > 0');
	$req->execute(array($name));
	$formats = $req->fetch();
	if ($req->rowCount()>0)
	{
		return $formats;
	}
	else
	{
		echo "Produit en rupture de stock ou inexistant";
	}
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
//fonction de cretaion de la commande
function createCommand($idcashbox, $idclient)
{
	require('connect.php'); 
	$req0 = $bdd->prepare('SELECT * FROM gs.orders WHERE DATE = NULL AND ID_CASHBOX = ?');
	$req0->execute(array($idcashbox));
	if ($req0->rowCount()==0)
	{
		$req = $bdd->prepare('INSERT INTO gs.orders (ID_CASHBOX, PAID, ID_CLIENT) VALUES(?, 0, ?)');
		$req->execute(array($idcashbox, $idclient));
		//return $idcommande->ID_COMMANDE;
		$req->closeCursor();
		echo "PANNIER CREEE";	
	}
	else
	{
		echo "CE PANNIER EXISTE DEJA";
	}

	$req0->closeCursor();
}
//fonction de suppession de commande
function delCommand($idcommande)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE gs.content WHERE ID_COMMANDE = ? LIMIT 1)');
	$req->execute(array($idcommande));
	$req->closeCursor();
}
// fonction dajout de produit au pannier sun client
function addToPanner($produit, $quantite)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT INTO gs.content (ID_COMMANDE, ID_PRODUCT, QUANTITY) VALUES((SELECT ID_COMMANDE FROM gs.orders WHERE ID_CASHBOX = 5 ORDER BY ID_COMMANDE DESC LIMIT 1),?,?)');
	$req->execute(array($produit, $quantite));
	$req1= $bdd->prepare('UPDATE gs.products SET QUANTITY = QUANTITY - ? WHERE ID_PRODUCT = ?');
	$req1->execute(array($quantite, $produit));
	$req->closeCursor();
	$req1->closeCursor();
}
//fonction daffichage du contenu du panier

function pannerContent($idcashbox)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.products p, gs.content c, gs.type t WHERE t.ID_TYPE = p.ID_TYPE AND  c.ID_PRODUCT = p.ID_PRODUCT AND c.ID_COMMANDE = (SELECT ID_COMMANDE FROM gs.orders WHERE ID_CASHBOX = ? ORDER BY ID_COMMANDE DESC LIMIT 1)');
	$req->execute(array($idcashbox));
	$panner = $req->fetchAll(PDO::FETCH_OBJ);
	return $panner;
}
// supprimer un produit du panier
function removeProductFromPanner($id, $quantite)
{
	require('connect.php');
	$req = $bdd->prepare('DELETE FROM gs.content WHERE ID_PRODUCT = ? AND ID_COMMANDE = (SELECT ID_COMMANDE FROM gs.orders WHERE ID_CASHBOX = 5 ORDER BY ID_COMMANDE DESC LIMIT 1)  LIMIT 1');
	$req->execute(array($id));
	$req1 = $bdd->prepare('UPDATE gs.products SET QUANTITY = QUANTITY + ? WHERE ID_PRODUCT = ?');
	$req1->execute(array($quantite, $id));
	$req1->closeCursor();
	$req->closeCursor();
}
//fonction denregistrement de la commande facon definitive
function saveOrder($idcashbox, $idprod, $quantity)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE gs.content SET QUANTITY = ?, ID_PRODUCT = ? WHERE ID_COMMANDE = (SELECT ID_COMMANDE FROM gs.orders WHERE ID_CASHBOX = ? ORDER BY ID_COMMANDE DESC LIMIT 1)');
	$req->execute(array($quantity, $idprod, $idcashbox));
	//$panner = $req->fetchAll(PDO::FETCH_OBJ);
	//return $panner;
}
//fonction denregistrement des donnees du client et denregistrement de la commande facon definitive
function defOrder($idcashbox, $type, $amount)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE gs.orders SET PAYMENT_TYPE = ?, PAID = ?, DATE=NOW() WHERE ID_CASHBOX = ? ORDER BY ID_COMMANDE DESC LIMIT 1');
	$req->execute(array($type, $amount, $idcashbox));
	
	$req1 = $bdd->prepare('UPDATE gs.cashbox SET AMOUNT = AMOUNT + ? WHERE ID_CASHBOX = ? ');
	$req1->execute(array($amount, $idcashbox));

	$req->closeCursor();
	$req1->closeCursor();
}
//fonction d verification de luser
/*
die();
function checkUser($username, $password)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT gs.users WHERE USERNAME = ? AND PASSWORD = ?)');
	$req->execute(array($username, $password));
	$user = $req->fetch();
	if ($req->rowCount()==1)
	{
		if ($user->TYPE == 1) 
		{
			header('Location : ');
		}
		elseif ($user->TYPE == 2)
		{
			header('Location : ');
		}
		else
		{
			header('Location : ');
		}
	}
	else
	{
		echo "MOT DE PASSE OU USERNAME INCORRECT";
	}
	$req->closeCursor();
}
*/
//foction de retrait de montant dans une caisse
function withdraw($idproprio, $idcashbox, $amount)
{
	require('connect.php');
	$req = $bdd->prepare('INSERT INTO gs.withdrawals (ID_USER, ID_CASHBOX, DATE, AMOUNT) VALUES(?,?,NOW(),?)');
	$req->execute(array($idproprio, $idcashbox, $amount));
	$req1 = $bdd->prepare('UPDATE gs.cashbox SET AMOUNT = AMOUNT - ? WHERE ID_CASHBOX = ? ');
	$req1->execute(array($amount, $idcashbox));
	$req->closeCursor();
	$req1->closeCursor();
}

function lookSupply($id_supply)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.supply_content c, gs.supply s WHERE c.ID_SUPPLY = ? AND c.STATUS = "Attente" AND c.ID_SUPPLY = s.ID_SUPPLY  ');
	$req->execute(array($id_supply));
	$panner = $req->fetchAll(PDO::FETCH_OBJ);
	return $panner;
}
//fonction dinsertion de produits livres
function insertDelivery($ID,$SUPP,$PRODUCT,$QUANTITY,$FORMAT)
{
	require('connect.php');
	$req0 = $bdd->prepare('SELECT * FROM gs.deliveries WHERE ID_SUPPLIER = ?  AND ID_SUPPLY = ?');
	$req0->execute(array($SUPP, $ID));
	if ($req0->rowCount()==0) 
	{
		$req = $bdd->prepare('INSERT INTO gs.deliveries (ID_SUPPLIER, ID_SUPPLY) VALUES(?,?)');
		$req->execute(array($ID,$SUPP));
		$req->closeCursor();
	}
	$req0->closeCursor();
	$req2 = $bdd->prepare('INSERT INTO gs.delivery_content (PRODUCT_NAME, QUANTITY, FORMAT, ID_DELIVERY) VALUES(?,?,?, (SELECT ID_DELIVERY FROM gs.deliveries WHERE ID_SUPPLY = ?))');
	$req2->execute(array($PRODUCT,$QUANTITY,$FORMAT,$ID));
	//
	$req1 = $bdd->prepare('SELECT * FROM gs.products WHERE PRODUCT_NAME = ? AND FORMAT = ?');
	$req1->execute(array($PRODUCT,$QUANTITY,$FORMAT));
	if ($req0->rowCount()==0) 
	{
		$req3 = $bdd->prepare('INSERT INTO gs.products (PRODUCT_NAME, QUANTITY, FORMAT, ID_DELIVERY) VALUES(?,?,?, (SELECT ID_DELIVERY gs.deliveries FROM WHERE ID_SUPPLY = ?))');
		$req3->execute(array($PRODUCT,$QUANTITY,$FORMAT,$ID));
		$req3->closeCursor();
	}
	else
	{
		$req4 = $bdd->prepare('UPDATE gs.products SET QUANTITY = QUANTITY + ? WHERE PRODUCT_NAME = ? AND FORMAT = ?');
		$req4->execute(array($PRODUCT,$FORMAT,$QUANTITY));
		$req4->closeCursor();
	}
	

}
//////////SUPER FONCTION 
function querySelect($table, $field, $status)
{
		require('connect.php');
        $SQL = "SELECT ".$field." FROM ". $table. " WHERE ". $status;
        $req = $bdd->query("$SQL");
        //var_dump($SQL);
        if ($req->rowCount()==1)
        {
        	 $result = $req->fetch(PDO::FETCH_OBJ);
        }
        elseif ($req->rowCount()>1)
        {
        	$result = $req->fetchAll(PDO::FETCH_OBJ);
        }
        else
        {
        	echo "PAS DE CORRESPONDANCE";
        }
       
        return $result;

}

///////////////////////////////////////////////////////////////
function regUser($name ,$lastname, $gender, $username, $type, $phone,$password)
{
	require ('connect.php');
	$req0=$bdd->prepare('SELECT * FROM gs.users WHERE USERNAME=?');
	$req0->execute(array($username));
	if ($req0->rowCount()==0)
	{
		$req=$bdd->prepare('INSERT INTO gs.users (NAME, FIRSTNAME, GENDER, USERNAME, TYPE, CONTACTS, PASSWORD) VALUES(?,?,?,?,?,?,?) ');
		$req->execute(array($name,$lastname,$gender,$username,$type,$phone,$password));
			$req->closeCursor();	
	}
	else
	{
		echo "existant";
	}
	
}
 // Fonction de verification de l'utilisateur

 function checkUser($username, $password){
 	require ('connect.php');
 	$req0 = $bdd->prepare('SELECT * FROM gs.users WHERE USERNAME=? AND PASSWORD=?');
 	$req0->execute(array($username,$password));
 	$user = $req0->fetch();

 	if($req0->rowCount()==1)
 	{
 		if ($user['TYPE']=="Caissier") 
 		{
 			$_SESSION['id'] = $user['ID_USER'];
 			header('Location:Users/caissier/vendre.php');
 		}
 		elseif ($user['TYPE']=="Superviseur") {

 			$_SESSION['id'] = $user['ID_USER'];
 			header('Location:Users/superviseur/dispo.php');
 		}
 			else
 		{

 			$_SESSION['id'] = $user['ID_USER'];
 			header('Location:Users/proprio/passer_com.php');
 		}
 		

 	}

 }
////fonction de creation de la commande

 function createSup($iduser, $supplier)
 {
 	require ('connect.php');
 	$req0 = $bdd->prepare('INSERT INTO gs.supply (ID_USER, ID_SUPPLIER, DATE) VALUES(?,?, NOW())');
 	$req0->execute(array($iduser, $supplier));
 	echo 'COMMAND CREEE AVEC SUCCES';
 }

 function selectAllSupplier()
 {
 	require ('connect.php');
 	$req0 = $bdd->query('SELECT * FROM gs.suppliers');
 	$user = $req0->fetchAll(PDO::FETCH_OBJ);
 	return $user;
 }
// fonction d'insertion d'un produit d'une commande
 function prod_insert($product,$quantity,$format,$iduser)
 {
 	require ('connect.php');
 	$req0 = $bdd->prepare('INSERT INTO gs.supply_content (PRODUCT_NAME, QUANTITY,FORMAT,ID_SUPPLY) VALUES(?,?,?,(SELECT ID_SUPPLY FROM gs.supply WHERE ID_USER = ? ORDER BY DATE ASC LIMIT 1))');
 	$req0->execute(array($product,$quantity,$format,$iduser));
 }

 /// Fonction d'affichage du contenu d'une commande


 function showSupplyContent($iduser)
 {
 	require ('connect.php');
 	$req0 = $bdd->prepare('SELECT * FROM gs.supply_content WHERE ID_SUPPLY=(SELECT ID_SUPPLY FROM gs.supply WHERE ID_USER = ? ORDER BY DATE ASC
 	 LIMIT 1)');

 	$req0->execute(array($iduser));
 	$content = $req0->fetchAll(PDO::FETCH_OBJ);
 	return $content;
 }
 //// fonction de suppression d'un produit de la commande
 function removeFromContent($idsupp, $produit)
 {
        require ('connect.php');
 	     $req0 = $bdd->prepare('DELETE FROM gs.supply_content
 	     WHERE ID_SUPPLY=? AND PRODUCT_NAME=? LIMIT 1');
 	$req0->execute(array($idsupp, $produit));
 

 }
 //fonction de selection de tout les utilisateurs-->
 function selectAllUsers()
 {
 	require ('connect.php');
 	     $req0 = $bdd->query('SELECT * FROM gs.users');
 	$users = $req0->fetchAll(PDO::FETCH_OBJ);
 	return $users; 
 }

// supprimer un utilisateur
function delUser($id)
{
	require ('connect.php');
 	     $req0 = $bdd->prepare('DELETE FROM gs.users WHERE ID_USER=?');
 	 	$req0->execute(array($id));

}
function selectUser($id)
 {
 	require ('connect.php');
 	     $req0 = $bdd->prepare('SELECT * FROM gs.users WHERE ID_USER=?');
 	 	$req0->execute(array($id));
 	$users = $req0->fetch(PDO::FETCH_OBJ);
 	return $users; 
 }

//fonction de mise a jour des utilisateurs
 function saveUser($id,$nom,$prenom,$cnib,$sexe,$username,$type,$contact,$mdp)
 {
 	require ('connect.php');
 	     $req0 = $bdd->prepare('UPDATE gs.users SET NAME=?, FIRSTNAME=?, CNIB=?, GENDER=?, USERNAME=?, TYPE=?, CONTACTS=?, PASSWORD=? WHERE ID_USER=?');
 	 	$req0->execute(array($nom,$prenom,$cnib,$sexe,$username,$type,$contact,$mdp,$id));
 }

 //liste de tous les produits manquants
function lack()
{
	require('connect.php');
	$req = $bdd->query('SELECT * FROM gs.products p, gs.type t WHERE p.QUANTITY = 0 AND p.ID_TYPE = t.ID_TYPE ');
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
function sortdate($date)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.supply where DATE="?"');
	$req->execute(array($date));
	$row = $req->fetchAll(PDO::FETCH_OBJ);
	return $row;
}
function sortinfdate($date)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT * FROM gs.supply where DATE<"?"');
		$req->execute(array($date));
	$row = $req->fetchAll(PDO::FETCH_ASSOC);
	return $row;
}

function sortsupdate($date)
{
	require('connect.php');
 $req = $bdd->prepare('SELECT * FROM gs.supply where DATE > "?"');
 	$req->execute(array($date));
	$row = $req->fetchAll(PDO::FETCH_ASSOC);
	return $row;
}
function sortbetweendate($date, $date2)
{
 require('connect.php');
 $req = $bdd->prepare('SELECT * FROM gs.supply where DATE= "?" AND DATE="?"');
 	$req->execute(array($date));
	$row = $req->fetchAll(PDO::FETCH_ASSOC);
	return $row;
}
//fonction de selection de toutes les commandes
function selectsupply()
{
	require('connect.php');
 $req = $bdd->query('SELECT * FROM gs.supply s, gs.users u, gs.suppliers sup WHERE s.ID_SUPPLIER = sup.ID_SUPPLIER AND u.ID_USER = s.ID_USER');
 $row = $req->fetchAll(PDO::FETCH_ASSOC);
 return $row;
}
//fonction de recherche des ventes avec des dettes
function lookUnpaids()
{
	require('connect.php');
	$req = $bdd->query('SELECT *, (SELECT SUM(co.QUANTITY*p.PRICE) FROM gs.content co, gs.products p WHERE co.ID_PRODUCT = p.ID_PRODUCT) AS TOTAL FROM gs.orders o, gs.clients c WHERE c.ID_CLIENT = o.ID_CLIENT AND o.PAID < (SELECT SUM(co.QUANTITY*p.PRICE) AS TOTAL FROM gs.content co, gs.products p WHERE co.ID_PRODUCT = p.ID_PRODUCT)');
	$row = $req->fetchAll(PDO::FETCH_OBJ);
	if ($req->rowCount()>0)
	{
		return $row;
	}
	else
	{
		echo "Aucun produit disponible pour le moment ...<br>";
	}
	
}
// SOLDER UNE DETTE
function eraseDoubt($idorder, $amount)
{
	require('connect.php');
	$req = $bdd->prepare('UPDATE gs.orders SET PAID = PAID + ?, DATE = NOW() WHERE ID_COMMANDE = ?');
	$req->execute(array($amount, $idorder));
	echo "MIS A JOUR AVEC SUCCES";
}
//fonction de selection dune dette specifique
function lookUnpaid($idcommande)
{
	require('connect.php');
	$req = $bdd->prepare('SELECT *, (SELECT SUM(co.QUANTITY*p.PRICE) FROM gs.content co, gs.products p WHERE co.ID_PRODUCT = p.ID_PRODUCT) AS TOTAL 
FROM gs.orders o, gs.clients c WHERE c.ID_CLIENT = o.ID_CLIENT AND o.ID_COMMANDE = ?
AND o.PAID < (SELECT SUM(co.QUANTITY*p.PRICE) AS TOTAL
              FROM gs.content co, gs.products p
              WHERE co.ID_PRODUCT = p.ID_PRODUCT )');
	$req->execute(array($idcommande));
	$row = $req->fetch(PDO::FETCH_OBJ);
	return $row;
}


 ?>