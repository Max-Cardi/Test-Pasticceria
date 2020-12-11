<?php
ob_start();
session_start();
//configurare database

define('DB_HOST' , 'localhost');
define('DB_UTENTE' , 'root');
define('DB_PASSWORD' , '');
define('DB_NOME' , 'pasticceria');

$connessione = mysqli_connect(DB_HOST , DB_UTENTE , DB_PASSWORD , DB_NOME);

require_once('funzioni.php');
