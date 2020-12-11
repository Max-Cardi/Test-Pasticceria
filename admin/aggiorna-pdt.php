<?php require_once("../config.php"); ?>
<?php require_once("../funzioni.php"); ?>
 <?php include("header-pdt.php"); ?>

<?php
if(isset($_GET['id'])){

$query = query("SELECT * FROM prodotti WHERE id_prodotto= {$_GET['id']} ");
conferma($query);
while($row = fetch_array($query)){

    $nomePdt =   $row['nome_prodotto'];
    $infoBreve = $row['descr_prodotto'];
    $prezzo =    $row['prezzo'];
    $quantitaPdt = $row['quantita_pdt'];
    $immaginePdt = $row['immagine'];

}
aggiornaProdotto();
}


?>
<div id="page-wrapper">

  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">
             Modifica Prodotto
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
        <label for="nome">Nome </label>
        <input type="text" name="nome_pdt" class="form-control" value="<?php echo $nomePdt; ?>" >
      </div>

      <div class="form-group">
        <label for="info">Info</label>
        <textarea name="desc_breve" cols="30" rows="3" class="form-control" type="text" id="editor2"><?php echo $infoBreve; ?></textarea>
      </div>
</div><!--fine col-8-->

<div class="col-md-4">

    <div class="form-group">
        <label for="prezzo">Prezzo</label>
        <input type="number"  name="prezzo" class="form-control"  step=".01" min="0" value="<?php echo $prezzo; ?>">
    </div>

    <div class="form-group">
        <label for="quantita">Quantità</label>
        <input type="number" name="quantita_pdt" class="form-control" min="0" value="<?php echo $quantitaPdt; ?>">
    </div>

    <div class="form-group">
        <label for="immagine">Immagine</label>
        <input type="text" name="immagine" class="form-control" value="<?php echo $immaginePdt; ?>">
        <img width="100" src="../immagini/<?php echo $immaginePdt; ?> " alt="">
    </div>

    <div class="form-group">
     <input type="submit" name="aggiorna" class="btn btn-success btn-lg" value="Aggiorna">
    </div>

</div><!--fine col-4-->
</div>
</form>

</div><!--contenuto-->

</div>
<!-- /#page-wrapper -->


<?php include("footer.php"); ?>
