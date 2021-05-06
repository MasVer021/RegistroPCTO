<?php
    include "home.php";
    
    $sql = "SELECT data,ora,luogo,premioore,id FROM appuntamento WHERE corso=$_GET[ID];";
    $result= mysqli_query($DB,$sql);


   


?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>


        

    </head>
    <body>
      <?php
        if($tipologiaDiProfilo =="refPCTO")
                echo '
                <ul>
                <li><a href="inAppuntamento.php?ID='.$_GET['ID'].'">inserisci appuntamenti</a></li>
                <li><a href="appuntamento.php?ID='.$_GET['ID'].'">visualizza appuntamenti</a></li>
                    
                </ul>';
        else{
            $sqli = "SELECT  corso,utente FROM iscritto WHERE corso=$_GET[ID] and utente=$id;";
            $resulti= mysqli_query($DB,$sqli);
            $row = mysqli_fetch_assoc($resulti);
    
            if($row!=NULL)
                echo '<form method="POST" action=# ><input type="submit" value="Iscritto" disabled></input></form>';
            else
                echo '<form method="POST" action=# ><input type="submit" value="Iscriviti" ></input></form>';
        }

            //echo "<form method='POST' action=#><button>Iscriviti</button></form>";

            
        ?>
         <table>
        <tr><th>Data appuntamento</th><th>ora appuntamento</th><th>luogo appuntamento</th><th>premio ore appuntamento</th></tr>
        
       <?php
            if($tipologiaDiProfilo =="refPCTO")
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td><a href='presenze.php?ID=$row[id]&&IDC=$_GET[ID]'>$row[data]</a></td><td>$row[ora]</td><td>$row[luogo]</td><td>$row[premioore]</td></tr>";
                }
            else
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td>$row[data]</td><td>$row[ora]</td><td>$row[luogo]</td><td>$row[premioore]</td></tr>";
                }
        ?>
        </table>

       
    </body>
    </html>







   
    