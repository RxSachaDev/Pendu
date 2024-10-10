<?php
    require_once('header.php');
    
    // Récupération des données de la session
    $player1 = $_SESSION[SessionKey::Player1->value];
    $player2 = $_SESSION[SessionKey::Player2->value];

    // Préparation de la requête en fonction du gagnant
    if ($_SESSION[SessionKey::WordFind->value]){
        echo "<div class='result'>
                <p>Bravo $player2, Vous avez gagné !</p>
            </div>";
    } else {
        echo "<div class='result'>
                <p>Bravo $player1, Vous avez gagné !</p>
            </div>";
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
