<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $game = $_POST['game'];
    $best = $_POST['best'];
    $avg = isset($_POST['avg']) ? $_POST['avg'] : 0;

    $sql = "INSERT INTO scores (username, game_name, score_best, score_avg) VALUES ('$name', '$game', '$best', '$avg')";
    if (mysqli_query($conn, $sql)) { 
        echo "Succes"; 
    } else { 
        echo "Eroare"; 
    }
}
?>