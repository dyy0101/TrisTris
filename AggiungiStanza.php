<html>
<header>
<script type="text/javascript" src="AggiungiStanza.js"></script>
<link rel="stylesheet" href="myStyle.css">
</header>
<body>
    <div class = 'container due-parti verticale grandezza-0'>
        <div class="top main container">
            <div class="content testo-stanza" id="stanza">INSERISCI COD STANZA: </div>
            <div class="content testo">
                <input type="text" id="inputStanza" name="inputStanza" onchange="checkStanza()">
            </div>
            <div id = "checkStanza">
            </div>
            <div id = "aggiungiButton">
            </div>
        </div>
        <div class="bottom main container">
            <select id="nomeGioco" onchange="selezionaGioco()" >
                <option value="Tutto">Tutto</option>
                <option value="TrisTris">TrisTris</option>
                <option value="Sasso-carta-forbice">Sasso-carta-forbice</option>
            </select>
            <div id="Stanza"></div>
        </div>
    </div>
</body>
</html>
