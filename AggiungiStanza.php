<html>
<body>
    <select id="nomeGioco" onchange="selezionaGioco()">
        <option value="Tutto">Tutto</option>
        <option value="TrisTris">TrisTris</option>
        <option value="SCF">Sasso-carta-forbice</option>
    </select>
    <div id="Stanza">
    </div>
    
<input type="button" value="Change option to 2" />
</body>
</html>

<script>

var elencoStanze;

const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
 elencoStanze = this.responseText;
}
xhttp.open("GET", "Stanze.txt");
xhttp.send();

function selezionaGioco(){
    var gioco = document.getElementById("nomeGioco").value;

}

</script>