<?php
    ob_start();
    require_once('header.php');
?>
<form method="post">
    <label for="joueur1">Joueur qui décide le mot :</label>
    <input type="text" placeholder="Joueur 1" name="player1">
    <label for="joueur2">Joueur qui devine le mot :</label>
    <input type="text" placeholder="Joueur 2" name="player2">
    <button type="submit" class="button">Continuer</button>
</form>
<?php
    $_SESSION['letter'] = [];
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST['player1']) && !empty($_POST['player2'])){
        $_SESSION['player1'] = $_POST['player1'];
        $_SESSION['player2'] = $_POST['player2'];
        header('Location: choixmot.php?traitement=OK');
        exit();
    } else {
        echo "
        <div>
            <p>Vous n'avez pas complété correctement les informations</p>
        </div>";
    }
   }
   ob_end_flush();
?>