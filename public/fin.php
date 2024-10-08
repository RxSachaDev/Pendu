<?php
    ob_start();
    require_once('header.php');
    $player1 = $_SESSION['player1'];
    $player2 = $_SESSION['player2'];

     if ($_SESSION['wordFind']){
        
        echo "<div class='result'>
                <p>Bravo $player2, Vous avez gagné !</p>
            </div>";
    } else {
        echo "<div class='result'>
                <p>Bravo $player1, Vous avez gagné !</p>
            </div>";
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