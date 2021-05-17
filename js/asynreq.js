function regioni() {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("regione").innerHTML="<option>selezione regione</option>"+ris;   
    }
    let service = "serverA.php?use=reg";
    request.open("GET",service,true);
    request.send(); 
}

function provincie() {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("provincia").innerHTML="<option>selezione provincia</option>"+ris;   
    }
    let service = "serverA.php?use=pro";
    request.open("GET",service,true);
    request.send(); 
}

function inReferenti(){
    document.getElementById("fReferenti").innerHTML="";
    let nCorsi= document.getElementById("nReferenti").value;
    for(let x=0;x<nCorsi;x++){
        let inputEmail = document.createElement("input");
        let labelEmail = document.createElement("label");
        labelEmail.innerHTML="Inserire email del "+(x+1)+"° Referente PCTO";
        inputEmail.setAttribute("type","email");
        inputEmail.setAttribute("name","emailRPCTO["+x+"]");
        document.getElementById("fReferenti").appendChild(labelEmail);
        document.getElementById("fReferenti").appendChild(inputEmail);
        document.getElementById("fReferenti").appendChild(document.createElement("br"));
    }
    
}

function inClassi(){
    document.getElementById("fClassi").innerHTML="";
    let nCorsi= document.getElementById("nCorsi").value;
    for(let x=0;x<nCorsi;x++){
        let inputLettera = document.createElement("input");
        let labelLettera = document.createElement("label");
        labelLettera.innerHTML="Inserire lettera "+(x+1)+"° corso";
        inputLettera.setAttribute("type","text");
        inputLettera.setAttribute("maxlength",1);
        inputLettera.setAttribute("value",String.fromCharCode(x+65));
        inputLettera.setAttribute("name","letteraC["+x+"]");
        document.getElementById("fClassi").appendChild(labelLettera);
        document.getElementById("fClassi").appendChild(inputLettera);
        document.getElementById("fClassi").appendChild(document.createElement("br"));
    }
    
}

function annoS() {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
    }
    let service = "serverA.php?use=ans&&an="+document.getElementById("annoScol").value; 
    request.open("GET",service,true);
    request.send();






   
}

function infoScuola(scuola,id) {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("datiscuola").innerHTML=ris;
    }
    let service = "serverA.php?use=ins&&sc="+scuola+"&&anno="+document.getElementById("annoScol").value+"&&utente="+id+"";
    request.open("GET",service,true);
    request.send();
}

function Vcorsi(id,tipologia,scuola) {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("corsi").innerHTML=ris;
    }
    let service = "serverA.php?use=vco&&sc="+scuola+"&&anno="+document.getElementById("annoScol").value+"&&utente="+id+"&&tipologia="+tipologia;
    request.open("GET",service,true);
    request.send();
}

function mySchool() {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("classe").innerHTML="<option>selezione classe</option>"+ris;  
    }
    let service = "serverA.php?use=cla&&sc="+document.getElementById("scuola").value;
    request.open("GET",service,true);
    request.send();
}

function noCAnno(){
    document.getElementById("annoScol").disabled = true;
}

function classiRef(id,tipologia,scuola){
    
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("classiRefPCTO").innerHTML=ris;  
    }
    let service = "serverA.php?use=vic&&anno="+document.getElementById("annoScol").value+"&&utente="+id+"&&tipologia="+tipologia+"&&sc="+scuola+"";
    console.log(service);
    request.open("GET",service,true);
    request.send();
}
function infoAlunniClasse(){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("divAlunni").innerHTML=ris;          
    }
    let service = "serverA.php?use=infAlC&&anno="+document.getElementById("annoScol").value+"&&codiceclasse="+document.getElementById("alunniClasse").value+"";
    console.log(service);
    request.open("GET",service,true);
    request.send();
}

function corsoRef(id,tipologia,scuola){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("corsoRefPCTO").innerHTML=ris;  
    }
    let service = "serverA.php?use=vico&&anno="+document.getElementById("annoScol").value+"&&utente="+id+"&&tipologia="+tipologia+"&&sc="+scuola+"";
    console.log(service);
    request.open("GET",service,true);
    request.send();
    
}

function infoAlunniCorso(){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("divAlunnic").innerHTML=ris;  
    }
    let service = "serverA.php?use=infAlCo&&anno="+document.getElementById("annoScol").value+"&&codicecorso="+document.getElementById("alunniCorso").value+"";
    console.log(document.getElementById("alunniCorso").value);
    console.log(service);
    request.open("GET",service,true);
    request.send();
}

function esameOre5(scuola){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("alunniPerEsame").innerHTML=ris;  
    }
    let service = "serverA.php?use=esameOre5&&anno="+document.getElementById("annoScol").value+"&&sc="+scuola+"";
    console.log(service);
    request.open("GET",service,true);
    request.send();
}


function corsiNonCompletatiDaNessuno(scuola){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        let ris = this.responseText;
        document.getElementById("corsiNonCompletati").innerHTML=ris;  
    }
    let service = "serverA.php?use=CorsoNonCompetato&&anno="+document.getElementById("annoScol").value+"&&sc="+scuola+"";
    console.log(service);
    request.open("GET",service,true);
    request.send();
}