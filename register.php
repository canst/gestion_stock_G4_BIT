


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
   <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-secondary" id="mainNav">
     <a href="index.php"><img class="w3-border-teal" src="img/logos/agriProofLogo.png" id="logo" title="logo"></a>
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">StockApp</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
        
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php">acceuil</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="login.php">Connexion</a>
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
             

            
                <div align="center"><a href="#"><font size="+1" face="Bradley Hand ITC"><strong>formulaire d'enregistrements </strong></font></a></div>
            
            <form action="#registration" method="POST" id="user-login" accept-charset="UTF-8">
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                <h1 align="center text-center" style="margin-left:10px;">S'ENREGISTRER</h1>
                
                <input type="text" placeholder="Nom et prenom(s)" name="name" id='name'  required>
                
                
                <input type="text" placeholder="Homme/femme" name="gen" id='gen'required>
                
                <input type="email" placeholder="tonmail@gmail.com" id='mail' name="mail" required style="width:339px; height:50px; padding-top:5px;">
                
                <select style="width:339px; height:50px;">
                    <optgroup>
                        <option>Homme</option>
                        <option>Femme</option>
                    </optgroup>
                </select>
                
                <input type="tel" placeholder="Numero de phone" name="phone" id='phone' required style="width:339px; height:50px;">
                
                <input type="text" placeholder="ajouter une adresse" id='addres' name="addres" required>
                
                <input type="text" placeholder="Entrer la ville" id='city' name="city" required>
                	
                <input type="submit" id='submit' value="s'enregistrer" name="valider" >
                <input type="reset" id="submit" value="effacer" style="width:339px; height:50px;">
                
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



 
  


 

</body>

</html>
