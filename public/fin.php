<?php
    ob_start();
    require_once('header.php');
    $player1 = $_SESSION['player1'];
    $player2 = $_SESSION['player2'];
    $word = $_SESSION['word'];
    $shot = $_SESSION['shot'];
    $connection = getConnection();

     if ($_SESSION['wordFind']){
        
        echo "<div class='result'>
                <p>Bravo $player2, Vous avez gagné !</p>
            </div>";
            $sql = "INSERT INTO partie (player1, player2, word, shot, winner) VALUES ($player1, $player2, $word, $shot, $player2)";
    } else {
        echo "<div class='result'>
                <p>Bravo $player1, Vous avez gagné !</p>
            </div>";
            $sql = "INSERT INTO partie (player1,player2, word, shot, winner) VALUES ($player1, $player2, $word, $shot, $player1)";
    }

    

    // Étape 4 : Exécuter la requête
    if ($connection->query($sql) === TRUE) {
        echo "Nouvelle ligne ajoutée avec succès";
    } else {
        echo "Erreur";
    }
?>

<form action="" method="post">
    <button type="submit" name="restart">Recommencer une partie</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        header("Location: index.php");
        exit();
    }
?>