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
    console.log(nCorsi);
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
    console.log(nCorsi);
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