<?php require_once("../config.php"); ?>
<?php require_once("../funzioni.php"); ?>
<?php include("header-ingr.php"); ?>


<?php

$query = query("SELECT * FROM prodotti WHERE id_prodotto= {$_GET['id']} ");
conferma($query);
$row = fetch_array($query);
$idPdt =  $row['id_prodotto'];
$nomePdt = $row['nome_prodotto'];

aggiungiIng(); ?>

<div id="page-wrapper">

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
             Pannello di amministrazione
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
      <input readonly="readonly" name="nomePdt" class="form-control" value="<?php echo $nomePdt; ?>" >
    </div>

    <div class="form-group">
        <label for="nome">Ingrediente </label>
        <input type="text" name="nomeIng" class="form-control">
    </div>

    <div class="form-group">
        <label for="quantita">Quantità</label>
        <input type="number" name="quantita" class="form-control" min="0">
    </div>

    <div class="form-group">
          <label for="prezzo">Misura</label>
          <input type="text" name="misura" class="form-control">
    </div>

    <div class="form-group">
      <input type="submit" name="aggiungi" class="btn btn-success btn-lg" value="Aggiungi">
    </div>

</div>
</div>
</form>

</div><!--contenuto-->

</div>
<!-- /#page-wrapper -->

<?php include("footer.php"); ?>
