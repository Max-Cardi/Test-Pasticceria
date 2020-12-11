<?php require_once("../config.php"); ?>
<?php require_once("../funzioni.php"); ?>
 <?php include("header-ingr.php"); ?>

<?php
if(isset($_GET['id'])){

$query = query("SELECT * FROM ingredienti WHERE id= {$_GET['id']} ");
conferma($query);
while($row = fetch_array($query)){

    $idPdt =  $row['id_prodotto'];
    $nomePdt =   $row['prodotto'];
    $nomeIng = $row['ingrediente'];
    $quantita = $row['quantita'];
    $misura =    $row['misura'];


}
aggiornaIngr();
}


?>
<div id="page-wrapper">

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
             Modifica Ingrediente
          </h1>
          <ol class="breadcrumb">
              <li class="active">
                  <i class="material-icons">dashboard</i> Dashboard
              </li>
          </ol>
      </div>
  </div>
<div class="container">

<form action="" method="post" enctype="multipart/form-data">
<div class="row">
<div class="col-md-8">
      <div class="form-group">
          <label for="nome">Id Prodotto</label>
          <input readonly="readonly" name="idPdt" class="form-control" value="<?php echo $idPdt; ?>" >
      </div>

      <div class="form-group">
        <label for="nome">Nome Prodotto</label>
        <input readonly="readonly" name="nome_pdt" class="form-control" value="<?php echo $nomePdt; ?>" >
      </div>

      <div class="form-group">
        <label for="info">Ingrediente</label>
        <input type="text" name="ingrediente" class="form-control" value="<?php echo $nomeIng; ?>">
      </div>


    <div class="form-group">
        <label for="quantita">Quantità</label>
        <input type="number" name="quantita" class="form-control" min="0" value="<?php echo $quantita; ?>">
    </div>

    <div class="form-group">
            <label for="prezzo">Misura</label>
            <input type="text"  name="misura" class="form-control"  step=".01" min="0" value="<?php echo $misura; ?>">
    </div>

    <div class="form-group">
     <input type="submit" name="aggiorna" class="btn btn-success btn-lg" value="Aggiorna">
    </div>

</div>
</div>
</form>

</div><!--contenuto-->

</div>
<!-- /#page-wrapper -->


<?php include("footer.php"); ?>
