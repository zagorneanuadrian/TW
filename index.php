<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Human Benchmark RO - Proiect TW</title>
    <link rel="stylesheet" href="site.css">
</head>
<body>
    <header>
        <h1>Human Benchmark & Games</h1>
        <p>Proiect Laborator (PHP + AJAX)</p>
    </header>
    <main class="dashboard-menu">
        <a href="Jocuri/reaction.php" class="game-link"><h2>Reaction Time</h2></a>
        <a href="Jocuri/aim.php" class="game-link"><h2>Aim Trainer</h2></a>
        <a href="Jocuri/sequence.php" class="game-link"><h2>Sequence Memory</h2></a>
        <a href="Jocuri/chimp.php" class="game-link"><h2>Chimp Test</h2></a>
        <a href="Jocuri/visual.php" class="game-link"><h2>Visual Memory</h2></a>
        <a href="Jocuri/2048.php" class="game-link"><h2>2048 Game</h2></a>
    </main>
    
    <section class="leaderboard" style="max-width: 650px; margin: 40px auto; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <h2>Top Scoruri</h2>
        <table border="1" style="width:100%; margin-top:20px; border-collapse: collapse; text-align: center;">
            <tr style="background: #f1f3f4; padding: 10px;">
                <th>Jucător</th><th>Joc</th><th>Cel mai bun</th><th>Medie (5)</th>
            </tr>
            <?php
            // Aici vom prelua scorurile din baza de date
            $res = mysqli_query($conn, "SELECT * FROM scores ORDER BY created_at DESC LIMIT 10");
            if($res && mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    echo "<tr><td style='padding:8px;'>{$row['username']}</td><td>{$row['game_name']}</td><td>{$row['score_best']}</td><td>{$row['score_avg']}</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='padding:8px;'>Nu există scoruri încă. Joacă un joc!</td></tr>";
            }
            ?>
        </table>
    </section>
</body>
</html>