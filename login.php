<?php

if(isset($_SESSION['id'])){

  header("Location: home.php");
  exit();
}




if(!empty($_POST['pseudo']) && !empty($_POST['pass'])){
            

    require_once 'scriptsdb/config.php';
             $username = htmlspecialchars($_POST['pseudo']);
             $userpass = $_POST['pass'];
            if(!empty($username) AND !empty($userpass)){
             $requser = $bdd->prepare("SELECT * FROM register WHERE pseudo=? AND pass=?");
           //$pwd = password_hash($_POST['pass'], PASSWORD_BCRYPT);
             $requser->execute(array($username,$userpass));
              $userexist = $requser->rowCount();

            if($userexist ==1 ){

             $userinfo= $requser->fetch();
				
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            $_SESSION['pass'] = $userinfo['pass'];
				
			  header("Location: home.php?id=".$_SESSION['id']);

        }else{
          $connecterreur = "Mot de passe et / ou nom d'utilisateur incorrect.";
        }

      }else{
      $connecterreur= "Tous les champs doivent Ãªtre complÃ©tÃ©s";

      }


    }


?>






















<!DOCTYPE html>
<html lang="fr-FR">

<head>
   <title>formulaireauthentification?</title>

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
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-dark text-uppercase fixed-top" id="mainNav">
    <div class="container">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">StockApp</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
         
          <li class="nav-item">
            <a class="nav-link js-scroll- btn btn-info" href="register.php">register</a>
          </li>
        </ul>
    </div>
    </div>
  </nav>
</header>
 

  <!-- Login Section -->
<div id="login-form">
  <section class="page-section py-5" id="ref">
    <div class="container">
      
      <div class="row">
        	            <img class="img-fluid" src="img/agriProofLogoR.png" alt="">

		  	<div id="tcontainer">
                
                <?php if(isset($erreur)) echo '<span style="color:red;"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  '.$erreur.'</span>'; ?><?php if(isset($ok)) echo '<span style="color:yellow;"> '.$ok.'</span>'; ?> 
            <br/><?php if(isset($ok2)) echo '<span style="color:#008c00;"> '.$ok2.'</span>'; ?><br /><?php if(isset($ok3)) echo '<span style="color:#008c00;"> '.$ok3.'</span>'; ?>  

            <!-- zone de connexion -->
            
            <form action="#login-form" method="POST" id="user-login" accept-charset="UTF-8">
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                <h1>Identification</h1>
                
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="pseudo" required>

                <input type="password" placeholder="Entrer le mot de passe" name="pass" required>
			     <font color="red" size="+1" face="Bradley Hand ITC"><strong>
                	<?php
                		if(isset($connecterreur)){
                    	
                        echo $connecterreur;
                				}
                	?>
                     </strong></font>
                
                <input type="submit" id='submit' value='ENTRER' name="entrer">
                
              
                <div align="center">
                    <a href="rest-pwd.php"><font size="+1" face="Bradley Hand ITC"><strong>Mots de pass oublie? </strong></font></a>
                </div>
                
                	
            </form>
       
         </div>
      <!-- /.row -->

		</div></div>
  </section>

 
</div>
  

   <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
            <span class="copyright">Copyright &copy;</span>gh <span class="tm-current-year">2020</span>
        </div>
        <div class="col-md-4">
          <ul class="list-inline social-buttons">
            <li class="list-inline-item">
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
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
