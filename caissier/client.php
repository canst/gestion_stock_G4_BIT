<?php 

require_once('../config/fonctions.php');

if(!empty($_POST))
{
	$messages = array();
	extract($_POST);
	$nom = strip_tags($nom);
	$prenom = strip_tags($prenom);
	$email = strip_tags($email);
	$contact = strip_tags($contact);
	$type = strip_tags($type);

	if(empty($nom))
	{
		array_push($messages, "Entrez un nom");
	}
	if(empty($prenom))
	{
		array_push($messages, "Entrez un prenom");
	}
	if(empty($email))
	{
		array_push($messages, "Entrez une adresse mail");
	}
	if(empty($contact))
	{
		array_push($messages, "Entrez un contact");
	}
	if(count($messages)==0)
	{
		$client = addClient($nom, $prenom, $email, $contact, $type);
		$success = "Client enregistre";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Client</title>
 </head>
 <body>
 <h2>Creation de nouveau client</h2>

 <?php 

	if(isset($success))
	{
		echo $success;
		//on pourra utiliser une style de succes ici
	}
	if(!empty($messages))
	{
		foreach ($messages as $message) 
		{
			echo $message;
			//on pourra utiliser une style de warning ici
		}
	}

  ?>

 <form action="#" method="post">
 	<label>Nom</label><br>
 	<input type="text" name="nom" required><br>
 	<label>Prenom</label><br>
 	<input type="text" name="prenom" required><br>
 	<label>Email</label><br>
 	<input type="mail" name="email" required><br>
 	<label>Contact</label><br>
 	<input type="text" name="contact" required><br>
 	<label>Choisir le type du client</label><br>
 	<select required name = "type">
 		<option value = "grossiste">Grossiste</option>
 		<option value = "complementaire">Complementaire</option>
 	</select><br>
 	<button>Enregistrer</button>
 </form>
 </body>
 </html>
