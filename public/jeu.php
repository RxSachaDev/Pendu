<?php
    require_once('header.php');

    echo'
    <div class="containerLetter">';
    $ASCII = 65;
    for ($cpt = 0; $cpt<26; $cpt++){
        $LETTRE = chr($ASCII);
        echo"<p class='letter'>$LETTRE</p>";
        $ASCII++;
    }
    echo'</div>';
?>
<table id="word">
    <tr>
        <?php
            $sizeWord = strlen($_SESSION['word']);
            $mot = $_SESSION['word'];
            for ($i = 0; $i < $sizeWord; $i++){
                if (!empty($_SESSION['letter']) && in_array($mot[$i], $_SESSION['letter']))
                {
                    echo "
                        <td id='$i'>$mot[$i]</td>
                    ";
                } else {
                    echo "
                        <td id='$i'>_</td>
                    ";
                }
                
            }
        ?>
    </tr>
</table>

<form method="post">
    <input type="text" maxlength="1" name="letterChoose">
    <button type="submit" class=".button">Continuer</button>
</form>

<?php
    $shot = $_SESSION['shot'];
    $connection = getConnection();
    $_SESSION['wordFind'] = true;
    echo"<p>$shot</p>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (!empty($_POST['letterChoose'])){

            if (!in_array(strtoupper($_POST['letterChoose']), $_SESSION['letter'])){
                array_push($_SESSION['letter'], strtoupper($_POST['letterChoose']));
                if(strpos(($_SESSION['word']), strtoupper($_POST['letterChoose'])) === false){
                    $_SESSION['shot']--;
                }
                
                foreach(str_split($_SESSION['word']) as $letter){
                    if (!in_array($letter, $_SESSION['letter'])){
                        $_SESSION['wordFind'] = false;
                        break;
                    }
                }

                if (!$_SESSION['wordFind'] && $_SESSION['shot'] > 0){
                    header('Location: jeu.php?traitement=OK');
                    exit();
                } else {
                                    // Préparation de la requête SQL en utilisant des requêtes préparées
                    $sql = "INSERT INTO partie (player1, player2, word, shot, winner) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    
                    // Liaison des paramètres avec les valeurs
                    $stmt->bindParam(1, $_SESSION['player1']);
                    $stmt->bindParam(2, $_SESSION['player2']);
                    $stmt->bindParam(3, $_SESSION['word']);
                    $stmt->bindParam(4, $_SESSION['shot']);
                    if($_SESSION['wordFind']===false){
                        $stmt->bindParam(5, $_SESSION['player1']);
                    } else {
                        $stmt->bindParam(5, $_SESSION['player2']);
                    }
                    echo"<div>";

                    // Exécution de la requête
                    $stmt ->execute();
                    header('Location: fin.php?traitement=OK');
                    exit();
                }
                
            } else {
                echo "
                    <div>
                        <p>Vous avez déjà choisi cette lettre</p>
                    </div>";
            }

        } else {
            echo "
            <div>
                <p>Vous n'avez pas complété correctement les informations</p>
            </div>";
        }
    }
?>
