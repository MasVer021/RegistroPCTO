<?php
    include "home.php";
    $sql = "SELECT denominazioneCorso,tutorInterno,tutorEsterno,monteOreCorso FROM corso,utente WHERE corso.codCreatore = utente.id and utente.scuolaAppartenenza ='". $scuolaA."';";
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
        <tr><th>Nome corso</th><th>tutor interno</th><th>tutor esterno</th><th>monte ore </th></tr>
       <?php
            
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>$row[denominazioneCorso]</td><td>$row[tutorInterno]</td><td>$row[tutorEsterno]</td><td>".$row['monteOreCorso']."</td>'</tr>";
            }
        ?>
        </table>
    </div>
</body>