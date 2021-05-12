<?php
    include "home.php";
    
    $somma = 0;

	$anno = annoScolastico();
   
if(!empty($_POST['numberore'] ))
    foreach($_POST['numberore'] as $valore)
        $somma += $valore;

    $sql= "SELECT   monteore ,SUM(premioOre) as'oreImpostate' FROM corso,appuntamento WHERE corso.ID=$_GET[ID] and appuntamento.corso=$_GET[ID];";
    $result= mysqli_query($DB,$sql);
    $row = mysqli_fetch_array($result);

    

    echo "<h1> il corso ha un totale di $row[monteore] ore </h1>";
    if(!empty($_POST['date']))
        if($somma+$row['oreImpostate']<=$row['monteore']) 
            for($x=1;$x<count($_POST['date'])+1;$x++){
                registraAppuntamento($DB,$_POST['date'][$x],$_POST['time'][$x],$_POST['luogo'][$x],$_POST['numberore'][$x],$_GET['ID'],$anno);
            }
        else
            echo "impostate più ore di quelle del corso";

   


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
                let z = document.getElementById("numApp").value;
                document.getElementById("numApp").value="";
                for(x =0;x<z ;x++){
                   
                    if(j==0){
                        let riga = document.createElement("tr");
                        let th = [document.createElement("th"),document.createElement("th"),document.createElement("th"),document.createElement("th"),document.createElement("th"),];
                        th[0].innerHTML = "N°"; riga.appendChild(th[0]);
                        th[1].innerHTML = "data"; riga.appendChild(th[1]);
                        th[2].innerHTML = "ora"; riga.appendChild(th[2]);
                        th[3].innerHTML = "luogo"; riga.appendChild(th[3]);
                        th[4].innerHTML = "premio Ore"; riga.appendChild(th[4]);
                        document.getElementById("tableform").appendChild(riga);
                    }
                    let td = [document.createElement("td"),document.createElement("td"),document.createElement("td"),document.createElement("td"),document.createElement("td"),];

                    let row = document.createElement("tr");
                    j++;
                    let inDataApp = document.createElement("input") ;
                    inDataApp.setAttribute("type","date");
                    inDataApp.setAttribute("name","date["+j+"]");
                    let inOrarioApp = document.createElement("input"); 
                    inOrarioApp.setAttribute("type","time");
                    inOrarioApp.setAttribute("name","time["+j+"]");
                    let inLuogoApp = document.createElement("input"); 
                    inLuogoApp.setAttribute("type","text");
                    inLuogoApp.setAttribute("name","luogo["+j+"]");
                    let inOreApp = document.createElement("input") ;
                    inOreApp.setAttribute("type","number");
                    inOreApp.setAttribute("name","numberore["+j+"]");
                    
                    td[0].innerHTML = j; row.appendChild(td[0]);
                    td[1].appendChild(inDataApp); row.appendChild(td[1]);
                    td[2].appendChild(inOrarioApp); row.appendChild(td[2]);
                    td[3].appendChild(inLuogoApp); row.appendChild(td[3]);
                    td[4].appendChild(inOreApp); row.appendChild(td[4]);
                  
                    document.getElementById("tableform").appendChild(row);   
                    }

            }
        </script>    

    </head>
    <body onload="noCAnno()">
      <?php
        if($tipologiaDiProfilo =="refPCTO")
                echo '
                <ul>

                <li><a href="inAppuntamento.php?ID='.$_GET['ID'].'">inserisci appuntamenti</a></li>
                
                <li><a href="appuntamento.php?ID='.$_GET['ID'].'">visualizza appuntamenti</a></li>
                    
                </ul>';

        ?>

         <input type="number" id="numApp"> appuntamenti
        <button onclick="inapp()">inserisci</button>
        <form id="formApp" action="#" method="POST">
            <table id="tableform"></table>
        </form>
        
        <button type="submit" form="formApp">invia</button>
        
    </body>
    </html>







   
    