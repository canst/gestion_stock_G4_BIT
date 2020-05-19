
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
        <li>    <a class="nav-link" href="#">Accueil</a></li>
		
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

<div class="container" id="allblock">
    <div class="row">
        <section id="section1" class="col-md-3">
            <div class="container">
                <div class="card border-success mb-3 text-uppercase" style="max-width: 18rem;">
                  <div class="card-header text-danger bg-success border-success text-center">Dashboard</div>
                      <div class="card-body text-success">
                          <!--<input type="button" value="Clients" name=""onclick="show()" class="btn btn-info">-->
                        <a class="nav-link active btn btn-warning" target="_self" href="caisse.php">Caisse</a>
                      </div>
                     <div class="card-body text-success">
                         <a class="nav-link active btn btn-secondary" target="_self" href="produits.php">Produits</a>

                      </div>
                     <div class="card-body text-success">
                         <a class="nav-link active btn btn-light" target="_self" href="livraison.php">Livraisons</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-dark" target="_self" href="ventes.php">Ventes</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-success" target="_self" href="client.php">Clients</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-danger" target="_self" href="dettes.php">Dettes</a>
                      </div>
                    <div class="card-body text-success">
                         <a class="nav-link active btn btn-info" target="_self" href="retrait.php">Retrait</a>
                      </div>
                  <div class="card-header text-danger bg-success border-success text-center">Dashboard</div>
                </div>
            </div>

        </section>
    
        <section id="section2" class="col-md-9">
           <!-- 
            <div onload="hide()" id="poss">
            <nav class="border-success">
              <div class="nav nav-tabs" id="myTab" role="tablist">
                <a class="nav-item nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                <a class="nav-item nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                <a class="nav-item nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
              </div>
            </nav>              
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.</div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna consequat voluptate minim amet aliquip ipsum aute laboris nisi. Labore labore veniam irure irure ipsum pariatur mollit magna in cupidatat dolore magna irure esse tempor ad mollit. Dolore commodo nulla minim amet ipsum officia consectetur amet ullamco voluptate nisi commodo ea sit eu.</div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Sint sit mollit irure quis est nostrud cillum consequat Lorem esse do quis dolor esse fugiat sunt do. Eu ex commodo veniam Lorem aliquip laborum occaecat qui Lorem esse mollit dolore anim cupidatat. Deserunt officia id Lorem nostrud aute id commodo elit eiusmod enim irure amet eiusmod qui reprehenderit nostrud tempor. Fugiat ipsum excepteur in aliqua non et quis aliquip ad irure in labore cillum elit enim. Consequat aliquip incididunt ipsum et minim laborum laborum laborum et cillum labore. Deserunt adipisicing cillum id nulla minim nostrud labore eiusmod et amet. Laboris consequat consequat commodo non ut non aliquip reprehenderit nulla anim occaecat. Sunt sit ullamco reprehenderit irure ea ullamco Lorem aute nostrud magna.</div>
            </div>
        </div>-->
            <section class="py-5 bg-yellow">
      <div class="container">
          <div class=" text-center">
              <h2 class="section-heading text-uppercase"><font size="+3" face="Comic Sans MS">Les Stocks</font></h2>
                  <h3 class="section-subheading text-muted"></h3>
           </div>
            <div id="carousel1_indicator" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carousel1_indicator" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel1_indicator" data-slide-to="1"></li>
                    <li data-target="#carousel1_indicator" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="/img/stockimg1.jpg" alt="First slide">
                </div>
                    <div class="carousel-item">
                    <img class="d-block w-100" src="/img/stockimg2.jpg" alt="Second slide">
                        <div class="carousel-caption d-none d-md-block">
                        <h5>Lorem Ipsom</h5>
                        <p>Lorem ipsum thsi y the reak tell meead gh  liisoios</p>
                      </div>
                    </div>
                    <div class="carousel-item">
                  <img class="d-block w-100" src="/img/stockimg3.jpg" alt="Third slide">
                     <div class="carousel-caption d-none d-md-block">
                        <h5>Lorem Ipsom</h5>
                        <p>Lorem ipsum thsi y the reak tell meead gh  liisoios</p>
                      </div> 
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="/img/stockimg1.jpg" alt="Third slide">
                      <div class="carousel-caption d-none d-md-block">
                        <h5>Lorem Ipsom</h5>
                        <p>Lorem ipsum thsi y the reak tell meead gh  liisoios</p>
                      </div>
                </div>
          </div>
                <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="false"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </div>
</section>
    </section>
   
    </div>
       
</div>
       
            
      
      <script type="text/javascript">
          
          $('.carousel').carousel('cycle')
          
        $('.carousel').carousel({
  interval: 2000
})
		
		
	
</script>
      
      
<!-- Bootstrap core JavaScript -->
  <script src="/bootstrap/js/bootstrap.js"></script>
       <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
        

  <!-- Plugin JavaScript -->
	<script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>


<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script type="text/javascript" src="/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>


     </body>
</html>