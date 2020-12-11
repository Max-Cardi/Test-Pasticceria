<?php  require_once("../config.php"); ?>
<?php require_once("../funzioni.php"); ?>

<?php
if(isset($_GET['id'])){

    $cancellaPdt = query("DELETE FROM prodotti WHERE id_prodotto = $_GET[id] ");
    conferma($cancellaPdt);

    $cancellaPdt = query("DELETE FROM ingredienti WHERE id_prodotto = $_GET[id] ");
    conferma($cancellaPdt);


    header('Location: visualizza-pdt.php');
}else{

    header('Location: index.php');

}
