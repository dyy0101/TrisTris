var elencoStanze = [];
function fetchStanze(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var risposta = JSON.parse(this.responseText);
          for (var i=0; i <risposta.length; i++){
            if(risposta[i]['numero'] != risposta[i]['giocatore'].length)
                elencoStanze.push(risposta[i]); 
          }
        }
      };
    xhttp.open("GET", "Stanze.json",true);
    xhttp.send();
}

fetchStanze();

function selezionaGioco(){
    var gioco = document.getElementById("nomeGioco").value;
    var stanze = [];

    var stanzeList;
    var myParent = document.getElementById('Stanza');
    var hasChild = myParent.querySelector("#codStanza") != null;

    if(hasChild){
        stanzeList = document.getElementById('codStanza');
        while(stanzeList.hasChildNodes()){
            stanzeList.removeChild(stanzeList.firstChild);
        }
    }
    else{
        stanzeList = document.createElement("select");
        stanzeList.id = "codStanza";
        stanzeList.setAttribute("onchange", 'stanzaSelezionata()');
        myParent.appendChild(stanzeList);
    }

    for(let i = 0; i < elencoStanze.length; i++ ){
        if(elencoStanze[i]['gioco'] === gioco || gioco === "Tutto"){
            stanze.push(elencoStanze[i]['stanza']);
        }
    }
    
    for(let i = 0; i < stanze.length; i++ ){
        var option = document.createElement("option");
        option.value = stanze[i];
        option.text = stanze[i];
        stanzeList.appendChild(option);
    }
}

var stanzaEsistente = false;

function checkStanza(){
    var check = document.getElementById('inputStanza');
    console.log(check);
    var haStanza = false;

    for(let i = 0; i < elencoStanze.length; i++){
        if(elencoStanze[i]['stanza'] === Number(document.getElementById('inputStanza').value))
            haStanza = true;
    }

    console.log(true);
    if(haStanza){
        if(check.innerHTML != ''){
            check.innerHTML = '';
        }
        stanzaEsistente = true;
        console.log(true);
        aggiungiStanza("aggiungiButtonInsert");
    }
    else{
        console.log(false);
        check.innerHTML = 'codice stanza non esistente';
        stanzaEsistente = false;
        if(document.getElementById("aggiungiButtonInsert").hasChildNodes()){
            document.getElementById("aggiungiButtonInsert").removeChild(document.getElementById("aggiungiButtonInsert").firstChild);
        }
    }
}

function aggiungiStanza(padre){
    var p = document.getElementById(padre);
    var button = document.createElement('button');
    button.setAttribute('onclick','cambiaStanza()');
}

function stanzaSelezionata(){
    aggiungiStanza("aggiungiButtonSelect");
}

function cambiaStanza(){
    console.log('aggiunta');
}