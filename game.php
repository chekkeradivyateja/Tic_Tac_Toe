<?php
session_start();

// Initialize the game board
if (!isset($_SESSION['board'])) {
    $_SESSION['board'] = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];
    $_SESSION['currentPlayer'] = 'X';
}

// Handle user's move
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['row']) && isset($_POST['col'])) {
    $row = $_POST['row'];
    $col = $_POST['col'];

    // Check if the selected cell is empty
    if ($_SESSION['board'][$row][$col] === '') {
        // Make the move
        $_SESSION['board'][$row][$col] = $_SESSION['currentPlayer'];

        // Switch to the next player
        $_SESSION['currentPlayer'] = ($_SESSION['currentPlayer'] === 'X') ? 'O' : 'X';
    }
}

// Display the game board
echo '<h2>Tic-Tac-Toe</h2>';
echo '<form method="post">';
echo '<table border="1" cellpadding="10">';

for ($i = 0; $i < 3; $i++) {
    echo '<tr>';
    for ($j = 0; $j < 3; $j++) {
        echo '<td>';
        echo '<button type="submit" name="row" value="' . $i . '"
                       name="col" value="' . $j . '"
                       style="width: 50px; height: 50px; font-size: 20px;">';
        echo $_SESSION['board'][$i][$j];
        echo '</button>';
        echo '</td>';
    }
    echo '</tr>';
}

echo '</table>';
echo '</form>';
?>