<?php
    include "home.php";

   $somma = 0;

    foreach($_POST['numberore'] as $valore)
        $somma += $valore;

    echo $somma;
    

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script>
            var  j=0;
            function inapp(){
                for(x =0;x<document.getElementById("numApp").value ;x++){
                    j++;
                    let inDataApp = document.createElement("input") 
                    inDataApp.setAttribute("type","date")
                    inDataApp.setAttribute("name","date["+j+"]")
                    let inLuogoApp = document.createElement("input") 
                    inLuogoApp.setAttribute("type","text")
                    inLuogoApp.setAttribute("name","luogo["+j+"]")
                    let inOreApp = document.createElement("input") 
                    inOreApp.setAttribute("type","number")
                    inOreApp.setAttribute("name","numberore["+j+"]")
                    document.getElementById("formApp").appendChild(document.createTextNode(j));
                    document.getElementById("formApp").appendChild(inDataApp);
                    document.getElementById("formApp").appendChild(inLuogoApp);
                    document.getElementById("formApp").appendChild(inOreApp);
                    document.getElementById("formApp").appendChild(document.createElement("br"));
                        
                    }

            }
        </script>
    </head>
    <body>
        
    </body>
    </html>







    <input type="number" id="numApp"> appuntamenti
    <button onclick="inapp()">inserisci</button>
    <form id="formApp" action="inAppuntamento.php" method="POST">
        
        
    </form>
    
    <button type="submit" form="formApp">invia</button>
    
    