<?php
    include "home.php";
    $sql = "SELECT corso.ID,corso.nome, tutorEsterno,anno,monteore, CONCAT(utente.cognome,' ',utente.nome)as 'tutorInterno' FROM corso,utente WHERE  utente.scuola =$scuolaA and corso.tutorcorso=utente.id ORDER BY corso.nome;";
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
                echo "<tr><td><a href=appuntamento.php?ID=$row[ID]>$row[nome]</a></td><td>$row[tutorInterno]</td><td>$row[tutorEsterno]</td><td>".$row['monteore']."</td>'</tr>";
            }
        ?>
        </table>
    </div>
</body>