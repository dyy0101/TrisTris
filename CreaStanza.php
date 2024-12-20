
<?php
    session_start();
    $tipo = $_POST['tipo'];
    if($_SESSION['gioco'] === []){
        
        $string = file_get_contents("Stanze.json");
        $json = json_decode($string,true);

        $nome = $_POST['nome'];

        if($tipo == 'crea'){
            $gioco = $_POST['gioco'];
            $numero = $_POST['numero'];
            $stanza = 1;
        
            $st = array_column($json, 'stanza');
            array_multisort($st, SORT_ASC, $json);
        
            for ($i = 0 ; $i < sizeof($json); $i++){
                if($stanza == $json[$i]['stanza']){
                    $stanza ++;
                }
            }
        
        
            $giocatore = array();

        }
        else{
            $stanza = $_POST['stanza'];
            for($i = 0; $i < sizeof($json); $i++){
                if($json[$i]['stanza'] == $stanza){
                    $partita = $json[$i];
                }
            }
            $giocatore = $partita['giocatore'];
            $numero = $partita['numero'];
            $gioco = $partita['gioco'];
        }

        $newJ = array("Nome"=>$nome,"Img"=>"https://avatars.githubusercontent.com/u/131394105?v=4");
        $giocatore[] = $newJ;
        $newStanza = array("stanza"=>$stanza, "gioco"=>$gioco, "numero"=>(int)$numero, "giocatore"=>$giocatore);
        $json[] = $newStanza;
    
        $newJson = json_encode($json);
        file_put_contents('Stanze.json', $newJson);

        $_SESSION['gioco']['stanza'] = $stanza;
        $_SESSION['gioco']['nome'] = $nome;
        $_SESSION['gioco']['gioco'] = $gioco;
        $_SESSION['gioco']['numero'] = $numero;
        $_SESSION['gioco']['giocatore'] = $giocatore;
    }
    else{
        
        $stanza = $_SESSION['gioco']['stanza'];
        $nome = $_SESSION['gioco']['nome'];
        $gioco = $_SESSION['gioco']['gioco'];
        $numero = $_SESSION['gioco']['numero'];
        $giocatore = $_SESSION['gioco']['giocatore'];
    }
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
                echo 'giocatori restanti : '. $numero - sizeOf($giocatore);
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
                for($i = 0; $i < $numero - sizeOf($giocatore); $i ++){
                    echo '<div class="player-img" id="'.$i.'">';
                    echo '<img src = "https://cdn.pixabay.com/animation/2022/07/29/03/42/03-42-05-37_512.gif">';
                    echo '</div>';
                }
            ?>
            </div>

        </div>

    </body>
</html>
