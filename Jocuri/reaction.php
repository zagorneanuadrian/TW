<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Reaction Time Test</title>
    <link rel="stylesheet" href="../site.css">
    <style>
        #reaction-area { width: 100%; height: 300px; border-radius: 12px; display: flex; justify-content: center; align-items: center; font-size: 2rem; font-weight: bold; color: white; cursor: pointer; user-select: none; background-color: #1a73e8; }
        .ready { background-color: #ce2636 !important; }
        .go { background-color: #4caf50 !important; }
    </style>
</head>
<body>
    <main>
        <h2>Reaction Time Test (<span id="attempt-count">0</span>/5)</h2>
        <div id="reaction-area">Click pentru a începe</div>
        <p id="message"></p>
    </main>

    <script>
        const area = document.getElementById('reaction-area');
        let attempts = [];
        let state = 'waiting'; // waiting, ready, go
        let timeout, startTime;

        area.addEventListener('click', () => {
            if (state === 'waiting') {
                area.className = 'ready';
                area.textContent = 'Așteaptă culoarea verde...';
                state = 'ready';
                timeout = setTimeout(() => {
                    area.className = 'go';
                    area.textContent = 'CLICK!';
                    startTime = Date.now();
                    state = 'go';
                }, Math.floor(Math.random() * 3000) + 2000);
            } else if (state === 'ready') {
                clearTimeout(timeout);
                area.className = '';
                area.textContent = 'Prea devreme! Click pentru a încerca din nou.';
                state = 'waiting';
            } else if (state === 'go') {
                let reactionTime = Date.now() - startTime;
                attempts.push(reactionTime);
                document.getElementById('attempt-count').textContent = attempts.length;
                
                if (attempts.length === 5) {
                    finishGame();
                } else {
                    area.className = '';
                    area.textContent = `${reactionTime} ms. Click pentru a continua.`;
                    state = 'waiting';
                }
            }
        });

        function finishGame() {
            let best = Math.min(...attempts);
            let avg = (attempts.reduce((a, b) => a + b, 0) / attempts.length).toFixed(2);
            let name = prompt(`Gata! Cel mai bun: ${best}ms | Media: ${avg}ms.\nIntrodu numele tău pentru clasament:`);
            
            if (name) {
                let formData = new FormData();
                formData.append('name', name);
                formData.append('game', 'Reaction Time');
                formData.append('best', best);
                formData.append('avg', avg);

                fetch('../save_score.php', { method: 'POST', body: formData })
                .then(() => window.location.href = '../index.php');
            } else {
                window.location.href = '../index.php'; // Dacă dă cancel, doar îl întoarce la meniu
            }
        }
    </script>
</body>
</html>