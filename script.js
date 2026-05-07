// Random Number
const btnNumber = document.getElementById('btn-generate-number');
const displayNumber = document.getElementById('number-display');
if (btnNumber && displayNumber) {
    btnNumber.addEventListener('click', () => {
        displayNumber.textContent = Math.floor(Math.random() * 100) + 1;
    });
}

// Random Color
const btnColor = document.getElementById('btn-generate-color');
const colorBox = document.getElementById('color-box');
const colorCode = document.getElementById('color-code');
if (btnColor && colorBox && colorCode) {
    btnColor.addEventListener('click', () => {
        const randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
        colorBox.style.backgroundColor = randomColor;
        colorCode.textContent = randomColor.toUpperCase();
    });
}

// Reaction Time
const reactionBox = document.getElementById('reaction-box');
const reactionResult = document.getElementById('reaction-result');
if (reactionBox && reactionResult) {
    let timeoutId, startTime, gameState = 'waiting';
    reactionBox.addEventListener('click', () => {
        if (gameState === 'waiting') {
            reactionBox.className = 'reaction-ready';
            reactionBox.textContent = 'Așteaptă verde...';
            reactionResult.textContent = '';
            gameState = 'ready';
            timeoutId = setTimeout(() => {
                reactionBox.className = 'reaction-go';
                reactionBox.textContent = 'CLICK ACUM!';
                startTime = Date.now();
                gameState = 'go';
            }, Math.floor(Math.random() * 3000) + 2000);
        } else if (gameState === 'ready') {
            clearTimeout(timeoutId);
            reactionBox.className = 'reaction-waiting';
            reactionBox.textContent = 'Prea devreme! Click pentru a încerca din nou.';
            gameState = 'waiting';
        } else if (gameState === 'go') {
            reactionBox.className = 'reaction-waiting';
            reactionBox.textContent = 'Click pentru a începe';
            reactionResult.textContent = `Timpul tău: ${Date.now() - startTime} ms!`;
            gameState = 'waiting';
        }
    });
}