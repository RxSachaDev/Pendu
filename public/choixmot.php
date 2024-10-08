<?php
    ob_start();
    require_once('header.php');
?>
<form method="post">
    <label for="word">Entrez le mot à deviner :</label>
    <input type="text" name="word">
    <label for="joueur2">Nombre de coups :</label>
    <input type="number" name="shot">
    <button type="submit" class="button">Continuer</button>
</form>
<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST['word']) && !empty($_POST['shot'])){
        $_SESSION['word'] = strtoupper($_POST['word']);
        $_SESSION['shot'] = intval($_POST['shot']);
        header('Location: jeu.php?traitement=OK');
        exit(0);
    } else {
        echo "
        <div>
            <p>Vous n'avez pas complété correctement les informations</p>
        </div>";
    }
   }
   ob_end_flush();
?>