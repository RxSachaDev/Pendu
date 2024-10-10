<?php
    require_once('header.php');

    echo'
    <div class="containerLetter">';
    $ASCII = 65;
    for ($cpt = 0; $cpt<26; $cpt++){
        $LETTRE = chr($ASCII);
        echo"<p id='$LETTRE'>$LETTRE</p>";
        $ASCII++;
    }
    echo'</div>';
?>
<div class='word'>
    <table id="word">
        <tr>
            <?php
                $sizeWord = strlen($_SESSION[SessionKey::Word->value]);
                $mot = $_SESSION[SessionKey::Word->value];
                for ($i = 0; $i < $sizeWord; $i++){
                    if (!empty($_SESSION[SessionKey::LetterChoose->value]) && in_array($mot[$i], $_SESSION[SessionKey::LetterChoose->value]))
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
</div>

<div class='researchForm'>
    <form method="post">
        <input type="text" maxlength="1" name="letterChoose">
        <button type="submit" class=".button">Continuer</button>
    </form>
</div>


<?php
    $shot = $_SESSION[SessionKey::Shot->value];
    $connection = getConnection();
    $_SESSION[SessionKey::WordFind->value] = true;
    echo"<div class='nbShot'><p>Nombre de coups : $shot</p></div>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (!empty($_POST['letterChoose']) && strlen($_POST['letterChoose']) === 1){

            if (!in_array(strtoupper($_POST['letterChoose']), $_SESSION[SessionKey::LetterChoose->value])){
                array_push($_SESSION[SessionKey::LetterChoose->value], strtoupper($_POST['letterChoose']));
                if(strpos(($_SESSION[SessionKey::Word->value]), strtoupper($_POST['letterChoose'])) === false){
                    $_SESSION[SessionKey::Shot->value]--;
                }
                
                foreach(str_split($_SESSION[SessionKey::Word->value]) as $letter){
                    if (!in_array($letter, $_SESSION[SessionKey::LetterChoose->value])){
                        $_SESSION[SessionKey::WordFind->value] = false;
                        break;
                    }
                }

                if (!$_SESSION[SessionKey::WordFind->value] && $_SESSION[SessionKey::Shot->value] > 0){
                    header('Location: jeu.php?traitement=OK');
                    exit();
                } else {
                                    // Préparation de la requête SQL en utilisant des requêtes préparées
                    $sql = "INSERT INTO partie (player1, player2, word, shot, winner) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $connection->prepare($sql);
                    
                    // Liaison des paramètres avec les valeurs
                    $stmt->bindParam(1, $_SESSION[SessionKey::Player1->value]);
                    $stmt->bindParam(2, $_SESSION[SessionKey::Player2->value]);
                    $stmt->bindParam(3, $_SESSION[SessionKey::Word->value]);
                    $stmt->bindParam(4, $_SESSION[SessionKey::ShotBase->value]);
                    if($_SESSION[SessionKey::WordFind->value]===false){
                        $stmt->bindParam(5, $_SESSION[SessionKey::Player1->value]);
                    } else {
                        $stmt->bindParam(5, $_SESSION[SessionKey::Player2->value]);
                    }

                    // Exécution de la requête
                    $stmt ->execute();
                    header('Location: fin.php?traitement=OK');
                    exit();
                }
                
            } else {
                echo "
                    <div class='inputError'>
                        <p>Vous avez déjà choisi cette lettre !</p>
                    </div>";
            }

        } else {
            echo "
            <div class='inputError'>
                <p>Vous n'avez pas complété correctement les informations !</p>
            </div>";
        }
    }
?>
<script>
    let letterTable = <?php echo json_encode($_SESSION[SessionKey::LetterChoose->value]); ?>;
    let wordToFind = <?php echo json_encode($_SESSION[SessionKey::Word->value]); ?>;

    letterTable.forEach(element => {
        let lettre = document.getElementById(element);
        if (wordToFind.includes(element)) {
                lettre.classList.add('true');
        } else {
            lettre.classList.add('false');
        }
    });
</script>
