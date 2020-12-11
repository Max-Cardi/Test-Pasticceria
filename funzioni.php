
<?php

//FUNZIONI  DI UTILITA' GENERALE

//crea una funzione per le operazioni CRUD sul DB
function query($sql){
global $connessione;
return mysqli_query($connessione , $sql);
}

//crea una funzione per la gestione degli errori di connessione
function conferma($risultato){
    global $connessione;
    if(!$risultato){
        die('Richiesta fallita' . mysqli_error($connessione));
        }
}

//crea una funzione per ciclare l'array e ricavare dati dal DB
function fetch_array($risultato){
    return mysqli_fetch_array($risultato);
}

//crea una funzione per la gestione dei messaggi
function creaAvviso($msg){
if(!empty($msg)){
  $_SESSION['messaggio'] = $msg;
}else{
  $msg = " ";
}
}

//crea una funzione per  mostrare un messaggio all'interno di una pagina
function mostraAvviso(){
if(isset($_SESSION['messaggio'])){
echo $_SESSION['messaggio'];
unset ($_SESSION['messaggio']);
}
}

//crea una funzione per mostrare tutti i prodotti in una pagina (pagina negozio.php)
function catalogoProdotti(){
$datsys = date("Y/m/d");
$scadenza = strtotime('-4 day', strtotime($datsys));
$scadenza = date('Y-m-d', $scadenza);
$catalogo = query("SELECT * FROM prodotti WHERE quantita_pdt <> 0");
conferma($catalogo);

while($row = fetch_array($catalogo)){
  $data = strtotime('+3 day', strtotime($row['datainsert']));
  $data = date('Ymd', $data);
  $datsys = date("Ymd");
  if ($datsys < $data) {
    $prezzo = 0;
    $prezzopieno = $row['prezzo'];
    $prezzo80 = $prezzopieno*80/100;
    $prezzo20 = $prezzopieno*20/100;
    $dataOggi = date("Y/m/d");
    $data = $row['datainsert'];
    $differenza = floor((strtotime($data) - strtotime($dataOggi)) / 86400);
    if ($differenza==0) {
      $prezzo = $prezzopieno;
    }
    if ($differenza== -1) {
      $prezzo = $prezzo80;
    }
    if ($differenza== -2) {
      $prezzo = $prezzo20;
    }


  $shopCatalogo = <<<CATALOGO
  <div class="col-lg-3 col-md-6 mb-4">
  <div class="card altezza">
  <img class="card-img-top" src="immagini/{$row['immagine']}" alt="">
  <div class="card-body">
    <h4 class="card-title">{$row['nome_prodotto']}</h4>
    <h5>€{$prezzo}</h5>
    <p class="card-text">{$row['descr_prodotto']}</p>
  </div>
  <div class="card-footer text-center">
    <a href="prodotto.php?id={$row['id_prodotto']}" class="btn btn-info btn-small">Dettagli</a>
  </div>
</div>
</div>

CATALOGO;
echo $shopCatalogo;
}
}
}



  //crea una funzione per la gestione dell'ingresso riservato all'area amministrativa (pagina login.php e logout.php)
  function login(){
   if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = query("SELECT * FROM utenti WHERE username = '{$username}'  AND password = '{$password}' ");
  conferma($query);

  if(mysqli_num_rows($query) == 0){

    creaAvviso('Utente o password Errati');
    header('Location: login.php');
  }else{

    $_SESSION['username'] = $username ;
    header('Location: admin/index.php');
  }
    }
  }


//crea una funzione per i prodotti
function leggereprodotti(){
$mostraPdt = query("SELECT * FROM prodotti");
conferma($mostraPdt);

echo "<table class='table table-stripped table-hover table-condensed table-bordered'>
        <tr>
        <th>Prodotto</th>
        <th>Immagine</th>
        <th>Prezzo</th>
        <th>Quantità</th>
        <th>Modifica</th>
        <th>Cancella</th>
        <th>Ingredienti</th>
        </tr>" ;
while($row = fetch_array($mostraPdt)){

$pdt_in_admin = <<< STRINGA

<tr>
<td>{$row['nome_prodotto']}</td>
 <td><img src="../immagini/{$row['immagine']}" alt="" style="width:75%"></td>
<td>€{$row['prezzo']}</td>
<td>{$row['quantita_pdt']}</td>
<td><a class="btn btn-primary" href="aggiorna-pdt.php?id={$row['id_prodotto']}" role="button">Modifica</a>
<td><a class="btn btn-danger" href="cancella-pdt.php?id={$row['id_prodotto']}" role="button">Cancella</a> </td>
<td><a class="btn btn-success btn-small" href="visualizza-ingr.php?id={$row['id_prodotto']}" role="button">Gestisci Ingredienti</a> </td>
</tr>

STRINGA;
echo  $pdt_in_admin;

}

}


  //crea una funzione per aggiungere nuovi prodotti tramite un form
function aggiungiPdt(){
if(isset($_POST['aggiungi'])){

if ($_POST['nome_pdt']!=' ') {

  $nomePdt = $_POST['nome_pdt'];
  $infoBreve = $_POST['desc_breve'];
  $prezzo = $_POST['prezzo'];
  $quantitaPdt = $_POST['quantita_pdt'];
  $immaginePdt = $_FILES['immagine']['name'];
  $nuovoPdt = query("INSERT INTO prodotti(nome_prodotto , descr_prodotto , prezzo , quantita_pdt , immagine) VALUES('{$nomePdt}' , '{$infoBreve}' , '{$prezzo}' , '{$quantitaPdt}' , '{$immaginePdt}')");
  conferma($nuovoPdt);

  header('Location: visualizza-pdt.php');

} else {

  header('Location: inserisci-pdt.php');
}

}
}


//crea una funzione per modificare prodotti esistenti richiamandoli in un form
function aggiornaProdotto(){
if(isset($_POST['aggiorna'])){

  $nomePdt = $_POST['nome_pdt'];
  $infoBreve = $_POST['desc_breve'];
  $prezzo = $_POST['prezzo'];
  $quantitaPdt = $_POST['quantita_pdt'];
  $immaginePdt = $_POST['immagine'];

  $update = query("UPDATE prodotti SET nome_prodotto = '{$nomePdt}' , descr_prodotto =  '{$infoBreve}' , prezzo =  '{$prezzo}' , quantita_pdt =  '{$quantitaPdt}' , immagine =  '{$immaginePdt}' WHERE  id_prodotto = {$_GET['id']}");

conferma($update);


header('Location: visualizza-pdt.php');

}
}





//crea una funzione per gli ingredienti
function leggereIngr(){
  $mostraIngr = query("SELECT * FROM ingredienti where id_prodotto= {$_GET['id']}");
  conferma($mostraIngr);

  echo "<table class='table table-stripped table-hover table-condensed table-bordered'>
        <tr>

        <th>Prodotto</th>
        <th>Ingrediente</th>
        <th>Quantità</th>
        <th>Misura</th>
        <th>Modifica</th>
        <th>Cancella</th>
        </tr>" ;
  while($row = fetch_array($mostraIngr)){

    $ingr_in_admin = <<< STRINGA

    <tr>
    <td>{$row['prodotto']}</td>
    <td>{$row['ingrediente']}</td>
    <td>{$row['quantita']}</td>
    <td>{$row['misura']}</td>
    <td><a class="btn btn-primary" href="aggiorna-ing.php?id={$row['id']}" role="button">Modifica</a>
    <td><a class="btn btn-danger" href="cancella-ing.php?id={$row['id']}" role="button">Cancella</a> </td>
    </tr>
    STRINGA;
    echo  $ingr_in_admin;

  }

}

function aggiungiIng(){
if(isset($_POST['aggiungi'])){

if ($_POST['nomeIng']!=' ') {
  $idPdt = $_POST['idPdt'];
  $nomePdt = $_POST['nomePdt'];
  $nomeIng = $_POST['nomeIng'];
  $quantita = $_POST['quantita'];
  $misura = $_POST['misura'];

  $nuovoIng = query("INSERT INTO ingredienti(id_prodotto , prodotto , ingrediente , quantita , misura) VALUES('{$idPdt}' , '{$nomePdt}' , '{$nomeIng}' , '{$quantita}' , '{$misura}')");
  conferma($nuovoIng);

  header('Location: visualizza-ingr.php?id='.$idPdt);

} else {

  header('Location: visualizza-ingr.php?id='.$idPdt);
}

}
}




//Aggiorna Ingrediente
function aggiornaIngr(){
if(isset($_POST['aggiorna'])){

  $nomeIng = $_POST['ingrediente'];
  $quantita = $_POST['quantita'];
  $misura= $_POST['misura'];
  $idPdt = $_POST['idPdt'];

  $update = query("UPDATE ingredienti SET ingrediente =  '{$nomeIng}' , quantita =  '{$quantita}' , misura =  '{$misura}' WHERE  id = {$_GET['id']}");

conferma($update);


header('Location: visualizza-ingr.php?id='.$idPdt);

}
}
