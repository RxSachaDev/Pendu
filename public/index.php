<?php
    include('header.php');

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
<div class='mainContainer'>
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
                $i = 0;
                $rows = $connection->query($sql)->fetchAll();
                $rowCount = count($rows);
                if ($rowCount > 0){
                    for ($i = 0; $i < 10 && $i < $rowCount; $i++) {
                        echo "<tr>
                                <td>{$rows[$i]['player1']}</td>
                                <td>{$rows[$i]['player2']}</td>
                                <td>{$rows[$i]['word']}</td>
                                <td>{$rows[$i]['shot']}</td>
                                <td>{$rows[$i]['winner']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr>
                            <td colspan = 5>Aucune partie n'a été lancée</td>
                        </tr>";
                }
                
            ?>
        </table>
    </div>
</div>


<?php
    $_SESSION[SessionKey::LetterChoose->value] = [];

   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST['player1']) && !empty($_POST['player2'])){
        $_SESSION[SessionKey::Player1->value] = $_POST['player1'];
        $_SESSION[SessionKey::Player2->value] = $_POST['player2'];
        header('Location: choixmot.php?traitement=OK');
        exit();
    } else {
        echo "
        <div class='inputError'>
            <p>Vous n'avez pas complété correctement les informations !</p>
        </div>";
    }
   }
?>