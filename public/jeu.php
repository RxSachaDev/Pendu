<?php
    ob_start();
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
            for ($i = 0; $i < $sizeWord; $i++){
                echo "
                    <td id='$i'>_</td>
                ";
            }
        ?>
    </tr>
</table>

<form method="post">
    <input type="text" maxlength="1" name="letterChoose">
    <button type="submit" class=".button">Continuer</button>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['letterChoose'])){
            if (strpos($_SESSION['word'], $_POST['letterChoose']) !== false){
                
            }
        } else {
            echo "
            <div>
                <p>Vous n'avez pas complété correctement les informations</p>
            </div>";
        }
    }
?>
