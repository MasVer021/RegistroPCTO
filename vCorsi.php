<?php
    include "home.php";
    $anno = annoScolastico();
    $sql =     "SELECT corso.ID,corso.nome, tutorEsterno,monteore,CONCAT(utente.cognome,utente.nome) as tutorInterno FROM corso,attivato,classe,utente,tutorcorso WHERE tutorcorso.utente=utente.id and tutorcorso.corso=corso.id and tutorcorso.annoscolastico=$anno and attivato.corso=corso.id and attivato.classe=classe.id and classe.scuola='$scuolaA' and attivato.annoscolastico=$anno group by corso.id,utente.id;";

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