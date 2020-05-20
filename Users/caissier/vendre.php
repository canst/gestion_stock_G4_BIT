
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
    <?php 
require ('../../config/fonctions.php');
global $idcommande, $montant;
$idcashbox = 5;
$clients = selectAllClients();

if (isset($_POST['search'])) 
{
  extract($_POST);
  $article_name = strip_tags($article_name);
  $details_article = searchProduct($article_name);
}
//creation du pannier
if (isset($_POST['neworder'])) 
{
  extract($_POST);
  $idcommande = createCommand($idcashbox, $client);
}

if (isset($_POST['add']))
  {
    extract($_POST);
    $id = strip_tags($id);
    $quantite = strip_tags($quantite);
    $add = addToPanner($id, $quantite);
    $rows = pannerContent($idcashbox);
    echo "Produit enregistré dans le pannier<br>";
  }
//suppression dun produit du contenu de la commande
if (isset($_GET['ID'])) 
{
  
  $rem = removeProductFromPanner($_GET['ID'], $_GET['QTY']);
  $rows = pannerContent($idcashbox);

}
//enregistrement de la commande
//session
if (isset($_POST['save']))
{
  $comm = defOrder($idcashbox, $_POST['type'], $_POST['amount']);
  $idcashbox = 16;
  /*header('Location: pdf.php?ID=<?= $i ?>');*/
}

 ?>

<div class="container" id="allblock">
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
              //////////
              <form action="#" method="post">
  <h2>INFORMATIONS CLIENT</h2>
   <select name="client" required>
    <option>client</option>
    <?php foreach ($clients as $client): ?>
      <option  value="<?= $client->ID_CLIENT?>"><?= $client->NAME.' '.$client->LASTNAME?></option>
    <?php endforeach; ?>
  </select>
  <button name="neworder">NOUVELLE COMMANDE</button>
 </form>
              ///////////

            ///////////////
<form action="#" method="post">
  <input type="search" name="article_name">
  <button name="search">Rechercher</button>
 </form>
//////////////////////////////
///////////////
<?php if (isset($details_article) AND !empty($details_article)) { ?>
<h2>PERSONNALISATION DU PRODUIT DE LA COMMANDE</h2>
<form action="#" method="post">
  <table>
    <th>
      <tr>
        <td>ID</td>
        <td>TYPE</td>
        <td>PRODUIT</td>
        <td>FORMAT</td>
        <td>QUANTITE</td>
        <td>PRICE</td>
      </tr>
    </th>
  <?php } ?>
  <?php if (isset($details_article) AND !empty($details_article)) {
    foreach (array($details_article) as $details_article): ?>
      <tr>
      <td><input type="text" name="id" value="<?= $details_article['ID_PRODUCT']?>" readonly></td>
      <td><input type="text" name="type" value="<?= $details_article['NAME']?>" required readonly></td>
      <td><input type="text" name="product" value="<?= $details_article['PRODUCT_NAME']?>" required readonly></td>
      <td><input type="text" name="format" value="<?= $details_article['FORMAT']?>"></td>
      <td><input type="number" name="quantite" max="<?= $details_article['QUANTITY']?>" min=1 value="<?= $details_article['QUANTITY']?>" required ></td>
      <td><input type="text" name="price" value="<?= $details_article['PRICE']?>" required readonly></td>
      </tr>

  <?php endforeach;
    echo '<button name="add">Ajouter</button>';
   } ?>
   </table>
 </form>


//////////////////////////////////////////////////////////////////
 <h2>Produits disponibles</h2>
 <form action="#" method = "post">
 <table>
  <thead>
    <th>ID</th>
    <th>NOM</th>
    <th>FORMAT</th>
    <th>PRIX</th>
    <th>TAUX DE REDUCTION</th>
    <th>EXPIRATION</th>
    <th>QUANTITE</th>
    <th>TYPE</th>
    <th>SUPPRIMER</th>
  </thead>
  <?php if(isset($rows) AND !empty($rows)){ $montant = 0; foreach ($rows as $row): ?>
    <tr>
    <td><input type="text" name="id" readonly required value="<?= $row->ID_PRODUCT?>"></td>
    <td><input type="text" name="product" readonly required value="<?= $row->PRODUCT_NAME?>"></td>
    <td><input type="text" name="format" readonly required value="<?= $row->FORMAT?>"></td>
    <td><input type="text" name="price" readonly required value="<?= $row->PRICE?>"></td>
    <td><input type="text" name="reduction" readonly required value="<?= $row->REDUCTION_RATE?>"></td>
    <td><input type="text" name="expiration" readonly required value="<?= $row->EXPIRATION?>"></td>
    <td><input type="text" name="quantity" readonly required value="<?= $row->QUANTITY?>" min=1 max="$details_article"></td>
    <td><input type="text" name="type" readonly required value="<?= $row->NAME?>"></td>
    <td><a href="vendre10.php?ID=<?=$row->ID_PRODUCT?>&amp;QTY=<?= $row->QUANTITY?>">Supprimer</a></td>
    </tr>
  <?php $montant +=$row->QUANTITY*$row->PRICE*(1-$row->REDUCTION_RATE/100); endforeach; } ?>
 </table>
  <fieldset>
    <input type="text" value="<?= $montant?>">
    <input type="text" name="amount" placeholder="Montant paye" required>
    <select required name="type">
      <option>Type de paiement</option>
      <option value="Cash">Cash</option>
      <option value="Mobile Money">Mobile Money</option>
    </select>
  </fieldset>
  <button name='save'>ENREGISTRER</button>
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



 