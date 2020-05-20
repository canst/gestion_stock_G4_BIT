<?php /*

require_once('/config/fonctions.php');

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
*/
 ?>


 
 
<!DOCTYPE html>
<html>
  <head>
    <title>
      stockApp
    </title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
     <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="../../css/styles.css" rel="stylesheet" type="text/css">
    </head> 
  <body id="page-top" >
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

      <nav class="navbar navbar-expand-lg bg-dark fixe-top" id="mainNav">
     <a href="index.php"><img class="" src="" id="logo" title="logo"></a>
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#">StockApp :  Vue d'ensemble </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
         <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
        <li>    <a class="nav-link" href="indexOwner.php">Accueil</a></li>
		
             </ul>
        </div>
        </div>
  </nav>    <header id="page-header">
     <!--Vérifier votre panier
        <span class="fa-stack fa-4x">
             <img src="img/hand.png" alt="Direction to cart">
          </span>
      
      <div id="page-cart-icon" onclick="cart.toggle();">
        &#128722; <span id="page-cart-count">0</span>
      </div>-->
        <br>
    </header>

<div class="">
    <div class="row">
        <section id="section1" class="col-md-3">
            <div class="container">
                <div class="card border-success mb-3 text-uppercase" style="max-width: 18rem;">
                  <div class="card-header text-danger bg-success border-success text-center">clients</div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="../../register.php">Creer Utilisateur</a>
                      </div>
                      <div class="card-body text-success">
                          <!--<input type="button" value="Clients" name=""onclick="show()" class="btn btn-info">-->
                        <a class="nav-link active btn btn-info" target="_self" href="caisse.php">Caisse</a>
                      </div>
                     <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="produits.php">Produits</a>

                      </div>
                     <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="livraison.php">Livraisons</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="ventes.php">Ventes</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-warning" target="_self" href="client.php">Clients</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="dettes.php">Dettes</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="retrait.php">Retrait</a>
                      </div>
                  <div class="card-header text-danger bg-success border-success text-center">clients</div>
                </div>
            </div>

        </section>
    
        <section id="section2" class="col-md-8">
            
                <div class="container" id="clients">
                       <table class="table">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nom</th>
                          <th scope="col">Prenom</th>
                          <th scope="col">email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>debit</td>
                          <td>Otto</td>
                          <td>soyotok@g.com</td>
                            <td>bp 23 08 pudag</td>
                            <td>Grossiste</td>
                        </tr>
                       
                      </tbody>
                    </table>
                </div>
                
           
                
                
    </section>
   
    </div>
</div>
      
     
      
<!-- Bootstrap core JavaScript -->
  <script src="../../bootstrap/js/bootstrap.js"></script>
       <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
        

  <!-- Plugin JavaScript -->
	<script src="../../js/jquery-3.5.1.min.js" type="text/javascript"></script>


<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>

     </body>
</html>



 