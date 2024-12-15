
<?php
    session_start();
    $nome = $_POST['nome'];
    $gioco = $_POST['gioco'];
    $num = $_POST['numero'];
    $string = file_get_contents("Stanze.json");
    $json = json_decode($string,true);
    $stanza = 1;

    $st = array_column($json, 'Stanza');
    array_multisort($st, SORT_ASC, $json);

    for ($i = 0 ; $i < sizeof($json); $i++){
        if($stanza == $json[$i]['Stanza']){
            $stanza ++;
        }
    }

    $giocatore = array(array("Nome"=>$nome,"Img"=>"https://avatars.githubusercontent.com/u/131394105?v=4"));
    $newStanza = array("Stanza"=>$stanza, "Gioco"=>$gioco, "Numero"=>(int)$num, "Giocatore"=>$giocatore);
    $json[] = $newStanza;

    $newJson = json_encode($json);
    file_put_contents('Stanze.json', $newJson);
?>
<html>
    <head>
        <link rel="stylesheet" href="myStyle.css">
    </head>
    <body>

        <div class="main container">
            <?php
                
                echo '<div class="content testo" id="gioco">';
                echo 'gioco : '. $gioco;
                echo '</div>';
                echo '<div class="content testo-stanza" id="stanza">';
                echo 'CODICE STANZA : '. $stanza;
                echo '</div>';
                echo '<div class="content testo" id="giocatori">';
                echo 'giocatori restanti : '. $num - sizeOf($giocatore);
                echo '</div>';
            ?>
        </div>

        <div class="content-bottom">
            
            <div class="esc-button" onclick="escCheck()"> ESC </div>
            <div class="player-container">
            <?php                
                for($i = 0; $i < sizeOf($giocatore); $i ++){
                    echo '<div class="player-img" id="'.$i.'">';
                    echo "<img src = '".$giocatore[$i]["Img"]."'>";
                    echo '</div>';
                }
                for($i = 0; $i < $num - sizeOf($giocatore); $i ++){
                    echo '<div class="player-img" id="'.$i.'">';
                    echo '<img src = "https://cdn.pixabay.com/animation/2022/07/29/03/42/03-42-05-37_512.gif">';
                    echo '</div>';
                }
            ?>
            </div>

        </div>

    </body>
</html>