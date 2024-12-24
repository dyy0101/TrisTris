<form method="POST" action="CreaStanza.php">
stanza: <input type="text" name="tipo" placeholder='crea'> 
nome: <input type="text" name="nome"> 
gioco: <input type="text" name="gioco"> 
num: <input type="text" name="numero"> 
    <input type="submit" value="crea stanza"> 
</form>
<?php
session_start();

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
            if(empty( $stanza['stanza'])){
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