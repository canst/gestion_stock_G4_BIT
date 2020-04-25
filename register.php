<?php

session_start();

	if(isset($_SESSION['id'])){
		
		header("Location: index.php");
        exit();
	}

//require_once 'scriptsdb/config.php';

//preaparetion des champ d'insertion dans  la base de donnee



if(isset($_POST['valider'])){
	
	$nom = $_POST['name'];
	 $gender = isset ($_POST['gen']) ? $_POST['gen']:'';
	$mail = $_POST['mail'];
    $username = $_POST['pseudo'];
	$pwd = isset($_POST['pass']) ? $_POST['pass']:'' ;
	$phone = $_POST['phone'] ;
	$adress = $_POST['addres'];
	 $ville = $_POST['city'];
    
    
    if(empty($_POST['pseudo']) || !preg_match("/^[a-zA-Z0-9_]+$/", $_POST['pseudo'])){
            
             $erreur = "Tous les champs doivent Ãªtre renseignés. Les espaces et les ponctuations ne sont pas autorisées pour le nom d'utilisateur. Excepter les traits d'union et tirets bas.";
    }else{
        
        
      if(empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            
             $erreur = "Veuillez renseigner un email valide."; 
            
    
          }else{

                $req =$bdd->prepare("SELECT user_id FROM register WHERE pseudo=?");
                $req->execute([$username]);
                $user = $req->fetch();


                if($user){

                    $erreur="Ce d'utilisateur existe déja";

                }else{

                $reqs =$bdd->prepare("SELECT user_id FROM register WHERE mail=?");
                $reqs->execute([$mail]);
                $usermail = $reqs->fetch();


                if($usermail){

                    $erreur="Email exist déja  utilisé";
                    
                     //header("Location: login.php?id=".$_SESSION['id']);

                }
                else{
                
                    $req = $bdd->prepare ( "INSERT into register SET  name = ?, gen = ?, mail = ?, pseudo =?, pass =?, phone = ?, addres = ?, city = ?, confirmation_token = ?");
                   $pwd = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                    $token = str_random(60);
                    $req->execute([$nom, $gender,$mail, $username, $pwd, $phone, $adress, $ville, $token ]);
                    
                    $user_id = $bdd-> lastInsertId();
                    
                   // mail($_POST['mail'], 'Confirmation de votre compte', "afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://local.dev/lab/comptes/confirm.php?id=&token=$token")
                    
                        header('Location: login.php');
                                        
                    $ok = "Bienvenu dans la famille Agrimarket !!!";
                    $ok2=" Votre compte a bien été créé. ";
                    $ok3="Cliquer en bas pour vous connectez";
                    
                   
                   

$email = $mail; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|gmail).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Merci de vous être enregistré sur www.Agrimarket-bf.com ";
$message_html ="<html><head></head><body><b>Bonjour $nom</b>,<br/><br/>
 Merci de vous être enregistré sur <b>Agrimarket-bf.com</b>. <br/><br/>
identifiant : $username<br/>
mot de passe : Celui que vous avez renseigné.<br/><br/>
L'équipe de agrimarket bf<br/><br/>
PS: Ceci est un email automatique, merci de ne pas y répondre.
</body></html>";
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Création de compte !";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Agrimarket bf\"<contact@agrimarket-bf.com>".$passage_ligne;
$header.= "Reply-to: \"Agrimarket\" <contact@agrimarket-bf.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($email,$sujet,$message,$header, $token);
//==========    
                     exit();
	
                }
             }
                }
		  
        
    }
	
    
		


}



?>





















<!DOCTYPE html>
<html lang="fr-FR">

<head>
   <title>formulaireEnregistrement?</title>

  <!-- Custom fonts for this theme -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
 <link href="css/responsive.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
         


</head>

<body id="page-top">
<header>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg bg-dark text-uppercase fixed-top" id="mainNav">
    <div class="container">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">AgriMarket</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <p style="color:yellow;padding-left:80px;">Veuillez vous enregister pour acceder a notre marcher </p>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          
          <li class="nav-item">
            <a class="nav-link js-scroll-t btn btn-info btn-lg-block ames-btn" href="index.php">Retour acceuil</a>
          </li>
        </ul>
    </div>
    </div>
  </nav>
</header>
 

  <!-- register Section -->

<div id="registration">
  <section class="page-section py-5" id="ref">
    <div class="container">
      
      <div class="row">
        	   <img class="img-fluid" src="img/agriProofLogoR.png" alt="">
        
		  	<div id="tcontainer">
            <?php if(isset($erreur)) echo '<span style="color:red;"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  '.$erreur.'</span>'; ?><?php if(isset($ok)) echo '<span style="color:yellow;"> '.$ok.'</span>'; ?> 
            <br/><?php if(isset($ok2)) echo '<span style="color:#008c00;"> '.$ok2.'</span>'; ?><br /><?php if(isset($ok3)) echo '<span style="color:#008c00;"> '.$ok3.'</span>'; ?>  

            
                <div align="center"><a href="#"><font size="+1" face="Bradley Hand ITC"><strong>formulaire d'enregistrements </strong></font></a></div>
            
            <form action="#registration" method="POST" id="user-login" accept-charset="UTF-8">
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                <h1 align="center text-center">S'ENREGISTRER</h1>
                
                <input type="text" placeholder="Nom et prenom(s)" name="name" id='name'  required>
                
                
                <input type="text" placeholder="Homme/femme" name="gen" id='gen'required>
                
                <input type="email" placeholder="tonmail@gmail.com" id='mail' name="mail" required style="width:339px; height:50px; padding-top:5px;">
                
                <input type="text" placeholder="Nom d'utlisateur" id='pseudo' name="pseudo" required>
                
              <input type="password" placeholder="Entrer le mot de passe" id='pass'  name="pass" required>
                
                <input type="tel" placeholder="Numero de phone" name="phone" id='phone' required style="width:339px; height:50px;">
                
                <input type="text" placeholder="ajouter une adresse" id='addres' name="addres" required>
                
                <input type="text" placeholder="Entrer la ville" id='city' name="city" required>
                	
                <input type="submit" id='submit' value="s'enregistrer" name="valider" >
                
                <div align="center"><a href="login.php"  style="color:yellow;"><font size="+1" face="Bradley Hand ITC"><strong>cliquez ici pour vous connecter </strong></font></a></div>
                	
            </form>
       
         </div>


		</div></div>
  </section>

</div>
 

   <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
            <span class="copyright">Copyright &copy;</span> AgriMarket <span class="tm-current-year">2020</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://web.facebook.com/AgriMarketBusiness/">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="list-inline quicklinks">
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
	<!--Footer-->



  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <!--<div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>-->
	

 
  

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
   <script src="gulpfile.js"></script>


  <!-- Contact Form JavaScript -->
  <script src="js/Validation.js"></script>
  <script src="js/contact_me.js"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/responsive.min.js"></script>
		

 

</body>

</html>
