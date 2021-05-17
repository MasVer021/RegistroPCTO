<?php
    include "home.php";
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
    
<table border="1px solid black">
    <?php

    $x=0;

    //print_r($percorsoS);
    foreach($percorsoS as $anno => $Sc){
        
        $annoS= substr($anno,0,4)."/".substr($anno,4,4);
        $classe= mysqli_fetch_assoc(mysqli_query($DB,"SELECT CONCAT(anno,sezione) as nomec from classe where id = $Sc[classe]   ;"))['nomec'];
        $scuola= mysqli_fetch_assoc(mysqli_query($DB,"SELECT CONCAT(nome,'-',provincia) as nomes from scuola where id = $Sc[scuola]   ;"))['nomes'];

        echo '<tr><th colspan="6">Anno scolastico'.$annoS.','.$scuola.','.$classe.'</th></tr>';
        echo '<tr><th colspan="4">Corso</th><th rowspan="2">Percentuale Presenza</th><th rowspan="2">Ore guadagnate</th></tr>';
        echo '<tr><th>Nome corso</th><th>tutor interno</th><th>tutor esterno</th><th>monte ore </th></tr>';

        $corsi =  "SELECT corso.ID,corso.nome, tutorEsterno,monteore,CONCAT(utente.cognome,' ',utente.nome) as tutorInterno FROM corso,attivato,classe,utente,tutorcorso,iscritto WHERE  iscritto.utente=$id and iscritto.corso=corso.id and tutorcorso.utente=utente.id and tutorcorso.corso=corso.id and tutorcorso.annoscolastico=$anno and attivato.corso=corso.id and attivato.classe=classe.id and classe.scuola='$Sc[scuola]' and attivato.annoscolastico=$anno group by corso.id,utente.id;";
        $corsiR= mysqli_query($DB,$corsi);

        $somma [$x]=0;
        while($row = mysqli_fetch_assoc($corsiR)){
            $presenze = "SELECT SUM(orePresente) as oreP from presente,appuntamento where utente = $id and stato='Presente' and annoscolastico =$anno and presente.appuntamento=appuntamento.id and appuntamento.corso=$row[ID] ;";
            $oreG= mysqli_query($DB,$presenze);
            $oreG = mysqli_fetch_assoc($oreG)['oreP'];
            echo "<tr><td><a href=appuntamento.php?ID=$row[ID]>$row[nome]</a></td><td>$row[tutorInterno]</td><td>$row[tutorEsterno]</td><td>".$row['monteore']."</td><td>".(($oreG/$row['monteore'])*100)."%</td><td>$oreG</td></tr>";
            $somma[$x]+=$oreG;
            
        }
        
        echo '<tr><th colspan="5">Totale, Classe '.$classe.'</th><td>'.$somma[$x].'</td></tr>';    
        
        echo '<br>';
    }

    echo '<tr><th colspan="5">Totale ore accumulate</th><td>'.array_sum($somma).'</td></tr>';
    ?>

    

        
    </table>





   
</body>
</html>