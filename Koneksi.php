<?php 
//Konfigurasi dengan Database 
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpustakaan"; //nama database yang dipakai

//Coba konek ke database
$connect = mysqli_connect($host, $user, $pass, $db);

if(!$connect){
    die("Failed Connect to database: " .  mysqli_connect_error());
}
?>