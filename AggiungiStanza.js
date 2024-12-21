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
    stanzaSelezionata();
}

var stanzaEsistente = false;

var input = document.getElementById('inputStanza');
console.log(input);
input.addEventListener("input", function(event) {
    var check = document.getElementById('checkStanza');
    var value = input.value;

    var haStanza = false;
    
    for(let i = 0; i < elencoStanze.length; i++){
        if(elencoStanze[i]['stanza'] === Number(value)){
            haStanza = true;
        }
    }
    if(haStanza){
        if(check.innerHTML != ''){
            check.innerHTML = '';
        }
        stanzaEsistente = true;
        if(!document.getElementById('aggiungiButtonInsert').hasChildNodes()){
            aggiungiStanza("aggiungiButtonInsert",value);
        }
    }
    else{
        if(value != ''){
            check.innerHTML = 'codice stanza non esistente';
        }
        else{
            check.innerHTML = '';
        }
        removeChildNode('aggiungiButtonInsert');
        stanzaEsistente = false;
    }
});

function aggiungiStanza(padre, stanza){
    console.log(stanza);
    var p = document.getElementById(padre);
    var button = document.createElement('input');
    button.setAttribute('type','button');
    button.setAttribute('value', 'AggiungiStanza');
    button.stanza = stanza;
    button.setAttribute('onclick','cambiaStanza(this.stanza)');
    p.appendChild(button);
}

function stanzaSelezionata(){
    if(document.getElementById('codStanza').length > 0){
        removeChildNode('aggiungiButtonSelect');
        var st = $("#codStanza")[0];
        aggiungiStanza("aggiungiButtonSelect",st.value);
    }
    else{
        removeChildNode("aggiungiButtonSelect");
    }
}

function cambiaStanza(value){
    var parametri = {
        tipo:'aggiunta',
        nome:'dyy',
        stanza:Number(value)
    };
    post('CreaStanza.php',parametri);
}

function removeChildNode(padre){
    if(document.getElementById(padre).hasChildNodes()){
        document.getElementById(padre).removeChild(document.getElementById(padre).firstChild);
    }
}

function post(path, params, method='post') {

    const form = document.createElement('form');
    form.method = method;
    form.action = path;
  
    for (const key in params) {
      if (params.hasOwnProperty(key)) {
        const hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = key;
        hiddenField.value = params[key];
  
        form.appendChild(hiddenField);
      }
    }
  
    document.body.appendChild(form);
    form.submit();
}
  