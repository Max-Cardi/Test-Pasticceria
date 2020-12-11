<?php  require_once("../config.php"); ?>
<?php require_once("../funzioni.php"); ?>

<?php
if(isset($_GET['id'])){

  $query = query("SELECT * FROM ingredienti WHERE id= {$_GET['id']} ");
  conferma($query);
  $row = fetch_array($query);
  $idPdt =  $row['id_prodotto'];

  $cancellaIng = query("DELETE FROM ingredienti WHERE id = $_GET[id] ");
  conferma($cancellaIng);

  header('Location: visualizza-ingr.php?id='.$idPdt);
}else{

  header('Location: visualizza-ingr.php?id='.$idPdt);
}
