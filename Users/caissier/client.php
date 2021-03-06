<?php 

require ('../../config/fonctions.php');

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
    <title>
      stockApp
    </title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
     <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="/css/owner.css" rel="stylesheet" type="text/css">
    </head> 
  <body id="page-top" >
      <nav class="navbar navbar-expand-md bg-dark fixe-top" id="mainNav">
     <a href="login.php"><img class="w3-border-teal w-25 w-25" src="img/GS.png" id="logo" title="logo"></a>
    <div class="container">
      <a class="navbar-brand js-scroll-trigger text-white" href="#">Golden Store</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
        </div>
  </nav>    <header id="page-header">

        <br>
    </header>

<body>
<div class="container col" id="allblock">
    <div class="row">
        <section id="section1" class="col-md-3">
            <div class="container">
                <div class="card border-success  text-uppercase" style="max-width: 18rem;">
                   <div class="card-header bg-danger border-success text-center">client</div>
                      <div class="card-body text-success">
                        <a class="nav-link active btn btn-info" target="_self" href="caisse.php">Caisse</a>
                      </div>
                     <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="dispo.php">Produits</a>

                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="ventes.php">Ventes</a>
                      </div>

                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-success" target="_self" href="client.php">Clients</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-danger" target="_self" href="dette.php">Dettes</a>
                      </div>
                   <div class="card-header bg-danger border-success text-center">Client</div>
                </div>
            </div>
        </section>
    
        <section id="section2" class="col-md-8 align-self-md-start">              
            <div class="container" id="creer">
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
 		<option value = "Autre">Autre</option>
 	</select><br>
 	<button>Enregistrer</button>
 </form>
 </section>
   
    </div>
</div>
      
      <script type="text/javascript">
          
        $('#myTab a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
          $('#myTab a[href="#profile"]').tab('show') // Select tab by name
$('#myTab li:first-child a').tab('show') // Select first tab
$('#myTab li:last-child a').tab('show') // Select last tab
$('#myTab li:nth-child(3) a').tab('show') // Select third tab
          
          function hide2(){
              document.getElementById('poss').style.display='none';
          }
    function hide(){
      document.getElementById('clients').style.display='none';
      document.getElementById('livraisons').style.display='none';
            document.getElementById('produits').style.display='none';
            document.getElementById('ventes').style.display='none';
            document.getElementById('retraits').style.display='none';
    }

    function show1(){
      document.getElementById('clients').style.display='block';
      document.getElementById('livraisons').style.display='none';
            document.getElementById('produits').style.display='none';
            document.getElementById('ventes').style.display='none';
            document.getElementById('retraits').style.display='none';
    }
    
    
  
</script>
      
      
<!-- Bootstrap core JavaScript -->
  <script src="/bootstrap/js/bootstrap.js"></script>
       <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
        

  <!-- Plugin JavaScript -->
  <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>


<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>

     </body>
</html>



 