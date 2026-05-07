<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Aim Trainer</title>
    <link rel="stylesheet" href="../site.css">
    <style>
        #aim-area { width: 100%; height: 400px; background: #f1f3f4; position: relative; overflow: hidden; border-radius: 12px; cursor: crosshair; }
        .target { width: 50px; height: 50px; background: #ce2636; border-radius: 50%; position: absolute; display: none; border: 4px solid white; box-shadow: 0 0 0 2px #ce2636; }
        #start-btn { display: block; margin: 150px auto; padding: 15px 30px; font-size: 1.2rem; cursor: pointer; }
    </style>
</head>
<body>
    <main>
        <h2>Aim Trainer (<span id="attempt-count">0</span>/5)</h2>
        <div id="aim-area">
            <button id="start-btn">Începe Testul</button>
            <div class="target" id="target"></div>
        </div>
    </main>

    <script>
        const target = document.getElementById('target');
        const startBtn = document.getElementById('start-btn');
        const aimArea = document.getElementById('aim-area');
        let attempts = [];
        let startTime;

        startBtn.addEventListener('click', () => {
            startBtn.style.display = 'none';
            spawnTarget();
        });

        function spawnTarget() {
            if (attempts.length === 5) {
                finishGame();
                return;
            }
            
            // Calculăm poziții random în interiorul div-ului (ținând cont de mărimea țintei)
            let maxX = aimArea.clientWidth - 50;
            let maxY = aimArea.clientHeight - 50;
            
            target.style.left = Math.floor(Math.random() * maxX) + 'px';
            target.style.top = Math.floor(Math.random() * maxY) + 'px';
            target.style.display = 'block';
            
            startTime = Date.now();
        }

        target.addEventListener('mousedown', () => {
            let reactionTime = Date.now() - startTime;
            attempts.push(reactionTime);
            document.getElementById('attempt-count').textContent = attempts.length;
            target.style.display = 'none';
            
            // Așteptăm o scurtă perioadă random înainte de a afișa următoarea țintă
            setTimeout(spawnTarget, Math.floor(Math.random() * 500) + 200);
        });

        function finishGame() {
            let best = Math.min(...attempts);
            let avg = (attempts.reduce((a, b) => a + b, 0) / attempts.length).toFixed(2);
            let name = prompt(`Gata! Cel mai bun: ${best}ms | Media: ${avg}ms.\nIntrodu numele tău pentru clasament:`);
            
            if (name) {
                let formData = new FormData();
                formData.append('name', name);
                formData.append('game', 'Aim Trainer');
                formData.append('best', best);
                formData.append('avg', avg);

                fetch('../save_score.php', { method: 'POST', body: formData })
                .then(() => window.location.href = '../index.php');
            } else {
                window.location.href = '../index.php';
            }
        }
    </script>
</body>
</html>