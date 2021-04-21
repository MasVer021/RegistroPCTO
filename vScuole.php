<?php
    include "home.php";
    $sql = "Select denominazioneScuola,provincia,codiceScuola from scuola;";
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
    <div>
        <table>
        <tr><th>Nome scuola</th><th>Provincia</th><th>Codice scuola</th><th>Alunni</th></tr>
       <?php
            
            while($row = mysqli_fetch_assoc($result)){
                $nAlunnisql ="SELECT COUNT(*) FROM utente WHERE utente.scuolaAppartenenza = '$row[codiceScuola]';"; 
                $nAlunnisql = mysqli_query($DB,$nAlunnisql);
                $nAlunnisql = mysqli_fetch_assoc($nAlunnisql);
                echo "<tr><td>$row[denominazioneScuola]</td><td>$row[provincia]</td><td><a href=infoScuola.php?CS=$row[codiceScuola]>$row[codiceScuola]</a></td><td>".$nAlunnisql["COUNT(*)"]."</td></tr>";
            }
        ?>
        </table>
    </div>
</body>
</html>