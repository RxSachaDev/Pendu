<?php
    require_once('header.php');
?>
<div class='mainContainer'>
    <div class ='playerForm'>
        <h2>Paramètres</h2>
        <form method="post">
            <label for="word">Entrez le mot à deviner :</label>
            <input type="text" name="word">
            <label for="joueur2">Nombre de coups :</label>
            <input type="number" name="shot">
            <button type="submit" class="button">Continuer</button>
        </form>
    </div>
    <div class='scoreBoard'>
        <h2>Tableau des anciennes parties</h2>
        <table>
            <tr class='defaultLine'>
                <td>Joueur1</td>
                <td>Joueur2</td>
                <td>Mot à trouver</td>
                <td>Nombre de coups</td>
                <td>Gagnant</td>
            </tr>
            <?php
                $connection = getConnection();
                $sql = "Select * from partie order by id_game desc";
                foreach ($connection ->query($sql) as $row) {
                    echo"<tr>
                            <td>{$row['player1']}</td>
                            <td>{$row['player2']}</td>
                            <td>{$row['word']}</td>
                            <td>{$row['shot']}</td>
                            <td>{$row['winner']}</td>
                        </tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST['word']) && !empty($_POST['shot'])){
        $_SESSION['word'] = strtoupper($_POST['word']);
        $_SESSION['shot'] = intval($_POST['shot']);
        $_SESSION['shotBase'] = intval($_POST['shot']);
        header('Location: jeu.php?traitement=OK');
        exit(0);
    } else {
        echo "
        <div class='inputError'>
            <p>Vous n'avez pas complété correctement les informations !</p>
        </div>";
    }
   }
   ob_end_flush();
?>