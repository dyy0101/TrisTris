<form method="POST" action="CreaStanza.php">
stanza: <input type="text" name="stanza" placeholder='crea'> 
nome: <input type="text" name="nome"> 
gioco: <input type="text" name="gioco"> 
num: <input type="text" name="numero"> 
    <input type="submit" value="crea stanza"> 
</form>
<?php
session_start();
session_unset();
$_SESSION['gioco'] = [];
?>