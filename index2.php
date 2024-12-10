<?php
    session_start();
    $nome = $_POST['nome'];
    $gioco = $_POST['gioco'];
    $num = $_POST['numero'];
    $string = file_get_contents("prova.json");
    $json = json_decode($string,true);
    $stanza = 1;

    for ($i = 0 ; $i < sizeof($json); $i++){
        if($stanza == $json[$i]['Stanza']){
            $stanza ++;
        }
    }
    $giocatore = array(array("Nome"=>$nome));
    $newStanza = array("Stanza"=>$stanza, "Gioco"=>$gioco, "Numero"=>(int)$num, "Giocatore"=>$giocatore);
    $json[] = $newStanza;

    $newJson = json_encode($json);
    file_put_contents('prova.json', $newJson);
?>