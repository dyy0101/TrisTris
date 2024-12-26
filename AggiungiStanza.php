<?php

if(!empty($_SESSION['gioco'])){
    
    $string = file_get_contents("Stanze.json");
    $json = json_decode($string,true);
    foreach($json as $indice => $stanza){
        if($stanza['stanza'] === $_SESSION['gioco']['stanza']){
            foreach($stanza['giocatore'] as $ind => $giocatore){
                if($stanza['giocatore'][$ind]['nome'] === $_SESSION['gioco']['nome']){
                    unset($json[$indice]['giocatore'][$ind]);
                    break;
                }
            }
            if(empty( $stanza['stanza']['giocatore'])){
                unset($json[$indice]);
                break;
            }
            break;
        }
    }
    $json = array_values($json);
    
    $newJson = json_encode($json);
    file_put_contents('Stanze.json', $newJson);
}

session_unset();
$_SESSION['gioco'] = [];
?>

<html>
<head>
<script type="text/javascript" src="AggiungiStanza.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="myStyle.css">
</head>
<body>
    <div class = 'container due-parti verticale grandezza-0'>
        <div class="top main container">
            <div class="content testo-stanza" id="stanza">INSERISCI COD STANZA: </div>
            <input type="text" id="inputStanza" name="inputStanza">
            <div id = "checkStanza"></div>
            <div id = "aggiungiButtonInsert"></div>
        </div>
        <div class="bottom main container">
            <select id="nomeGioco" onchange="selezionaGioco()" >
                <option value="Tutto">Tutto</option>
                <option value="TrisTris">TrisTris</option>
                <option value="Sasso-carta-forbice">Sasso-carta-forbice</option>
            </select>
            <div id="Stanza"></div>
            <div id = "aggiungiButtonSelect"></div>
        </div>
    </div>
</body>
</html>
