<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac-Toe</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        #board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-gap: 5px;
            text-align: center;
        }

        .cell {
            width: 100px;
            height: 100px;
            font-size: 24px;
            font-weight: bold;
            background-color: #ddd;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cell:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <h1>Tic-Tac-Toe</h1>

    <div id="board"></div>

    <script>
        const board = document.getElementById('board');
        const cells = [];

        let currentPlayer = 'X';
        let gameActive = true;

        function initializeBoard() {
            for (let i = 0; i < 3; i++) {
                for (let j = 0; j < 3; j++) {
                    const cell = document.createElement('div');
                    cell.className = 'cell';
                    cell.dataset.row = i;
                    cell.dataset.col = j;
                    cell.addEventListener('click', handleCellClick);
                    board.appendChild(cell);
                    cells.push(cell);
                }
            }
        }

        function handleCellClick() {
            if (!gameActive) return;

            const clickedCell = this;
            const row = clickedCell.dataset.row;
            const col = clickedCell.dataset.col;

            if (isEmptyCell(row, col)) {
                clickedCell.textContent = currentPlayer;
                if (checkWinner()) {
                    alert(`Player ${currentPlayer} wins!`);
                    gameActive = false;
                } else if (isBoardFull()) {
                    alert("It's a tie!");
                    gameActive = false;
                } else {
                    currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
                }
            }
        }

        function isEmptyCell(row, col) {
            return cells.find(cell => cell.dataset.row == row && cell.dataset.col == col).textContent === '';
        }

        function checkWinner() {
            const linesToCheck = [
                // Rows
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8],
                // Columns
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8],
                // Diagonals
                [0, 4, 8],
                [2, 4, 6],
            ];

            return linesToCheck.some(line => {
                const [a, b, c] = line;
                return cells[a].textContent !== '' && cells[a].textContent === cells[b].textContent && cells[a].textContent === cells[c].textContent;
            });
        }

        function isBoardFull() {
            return cells.every(cell => cell.textContent !== '');
        }

        initializeBoard();
    </script>
</body>
</html>
