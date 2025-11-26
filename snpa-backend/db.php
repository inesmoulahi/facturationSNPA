<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "snpa_db"; // Mets ici le vrai nom de ta base

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}
?>
