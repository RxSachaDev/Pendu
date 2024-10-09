<?php
    require_once('header.php');
    
    // Récupération des données de la session
    $player1 = $_SESSION['player1'];
    $player2 = $_SESSION['player2'];
    $word = $_SESSION['word'];
    $shot = $_SESSION['shot'];

    // Préparation de la requête en fonction du gagnant
    if ($_SESSION['wordFind']){
        echo "<div class='result'>
                <p>Bravo $player2, Vous avez gagné !</p>
            </div>";
        $winner = $player2; // Le joueur 2 a gagné
    } else {
        echo "<div class='result'>
                <p>Bravo $player1, Vous avez gagné !</p>
            </div>";
        $winner = $player1; // Le joueur 1 a gagné
    }

    
?>

<div class='restart'>
    <form action="" method="post">
        <button type="submit" name="restart">Recommencer une partie</button>
    </form>
</div>


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        header("Location: index.php");
        exit();
    }
?>
