<?php
    session_start();
    include('bd.php');

    enum SessionKey: string {
        case Player1 = 'player1';
        case Player2 = 'player2';
        case Shot = 'shot';
        case LetterChoose = 'letterChoose';
        case WordFind = 'wordFind';
        case ShotBase = 'shotBase';
        case Word = 'word';
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Jeu du Pendu</title>
</head>
<body>
    <header>
        <h1>Jeu du Pendu</h1>
    </header>
    
    