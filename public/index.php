<?php
    include('header.php');
?>
<div class='playerForm'>
    <h2>Participants</h2>
    <form method="post">
        <label for="joueur1">Joueur qui décide le mot :</label>
        <input type="text" placeholder="Joueur 1" name="player1">
        <label for="joueur2">Joueur qui devine le mot :</label>
        <input type="text" placeholder="Joueur 2" name="player2">
        <button type="submit" class="button">Continuer</button>
    </form>
</div>

<div class ='scoreBoard'>
    <h2>Tableau des anciennes parties</h2>
    <table>
        <tr>
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
        <div class='inputError'>
            <p>Vous n'avez pas complété correctement les informations</p>
        </div>";
    }
   }
?>