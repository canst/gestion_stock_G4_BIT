<?php 
require ('../../config/fonctions.php');
$dettes = lookUnpaids();



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
      <a class="navbar-brand js-scroll-trigger text-white" href="#">APPStock</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
        </div>
  </nav>    <header id="page-header">

        <br>
    </header>


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
    
        <section id="section2" class="col-offset-sm-3 col-md-9">              
            <div class="container" id="creer">
          <table>
            <tr>
              <th>NO.COMMANDE</th>
              <th>No. CAISSE</th>
              <th>CLIENT</th>
              <th>DATE</th>
              <th></th>
              <th>TYPE DE PAIEMENT</th>
              <th>MONTANT PAYE</th>
              <th>DEPENSE TOTALLE</th>
              <th>RESTE A PAYER</th>
              <th>CONTACT CLIENT</th>
              <th>SOLDER</th>
            </tr>

            
            <?php foreach ($dettes as $dette):?>
              <tr>
            <td><?= $dette->ID_COMMANDE?></td>
            <td><?= $dette->ID_CASHBOX?></td>
            <td><?= $dette->NAME?></td>
            <td><?= $dette->DATE?><td>
            <td><?= $dette->PAYMENT_TYPE?></td>
            <td><?= $dette->PAID?>
            <td><?= $dette->TOTAL?></td>
            <td><?= $dette->TOTAL - $dette->PAID?></td>
            <td><?= $dette->CONTACTS?></td>
            <td><a href="gerer_dette.php?ID=<?= $dette->ID_COMMANDE?>">Solder</a></td>
          </tr>
          <?php endforeach ?>  
            
          </table>


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



 