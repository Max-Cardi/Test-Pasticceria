<?php require_once("config.php"); ?>
<?php require_once("header.php"); ?>
    <!-- Page Content -->
<div class="container my-5">
    <div class="row">


      <?php
      $pdtSingolo = query("SELECT * FROM prodotti WHERE id_prodotto = {$_GET['id']}");
      conferma($pdtSingolo);

      while($row = fetch_array($pdtSingolo)):

        ?>
        <div class="col-lg-9">

          <div class="card mt-4">
            <img class="card-img-top img-fluid" src="immagini/<?php  echo $row['immagine']; ?>" alt="">
            <div class="card-body">
              <h3 class="card-title text-center mb-5"><?php  echo $row['nome_prodotto']; ?></h3>
              <h4 class="mb-5">Prezzo €
                <?php
                $prezzopieno = $row['prezzo'];
                $prezzo80 = $prezzopieno*80/100;
                $prezzo20 = $prezzopieno*20/100;
                $dataOggi = date("Y/m/d");
                $data = $row['datainsert'];
                $differenza = floor((strtotime($data) - strtotime($dataOggi)) / 86400);
                if ($differenza==0) {
                  echo $prezzopieno;
                }
                if ($differenza== -1) {
                  echo $prezzo80;
                }
                if ($differenza== -2) {
                  echo $prezzo20;
                }

                ?>
              </h4>
              <div class="container my-4" >
                <h3 class="card-title text-center mb-3">
                  Ingredienti</h3>
                  <?php
                    $pdtIngr = query("SELECT * FROM ingredienti WHERE id_prodotto = {$_GET['id']}");
                    conferma($pdtIngr);

                    while($row1 = fetch_array($pdtIngr)):

                  ?>
                  <h5 class="card-title mb-5"><?php  echo $row1['ingrediente'].' '.$row1['quantita'].' '.$row1['misura']; ?></h3>

          <!-- /.col-lg-9 -->
                <?php endwhile ?>
              </div>
            </div>
          </div>
          <!-- /.card -->


        </div>
        <!-- /.col-lg-9 -->
        <?php endwhile ?>

</div>
<!-- /.card -->
</div>




    <!-- Footer -->
    <?php require_once("footer.php"); ?>
