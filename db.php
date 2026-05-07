<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "tw_proiect";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) { die("Conexiune eșuată: " . mysqli_connect_error()); }
?>