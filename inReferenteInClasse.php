<?php
    include "home.php";
    $sql = "Select  concat(anno,sezione) as nClasse,ID from classe where scuola=$scuolaA;";
    $result= mysqli_query($DB,$sql);

    if(!empty($_POST['classe']) && !empty($_POST['referente']) && $_POST['referente']!="Seleziona Tutor interno corso"){
        mysqli_query($DB,"INSERT INTO tutorpctoclasse (classe,utente,annoscolastico)VALUES($_POST[classe],$_POST[referente],".annoScolastico().") ;");
        echo "INSERT INTO tutorpctoclasse (classe,utente,annoscolastico)VALUES($_POST[classe],$_POST[referente]".annoScolastico().");";
    }   


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
    <form action="#" method="POST">
    <select name="classe">
    <?php while($row = mysqli_fetch_assoc($result)) echo "<option  value="."$row[ID]".">".$row['nClasse']."</option>"; ?>
    </select>
    
    <select name="referente">
    <?php
                    $referenti =mysqli_query($DB, "SELECT nome, cognome, ID from utente, lavora where utente.tipoProfilo='refPCTO' and lavora.scuola='$scuolaA' and lavora.utente=utente.id and annoScolastico='$anno' and utente.nome!='ToUp';");
                    echo "<option>Seleziona Tutor interno corso</option>";
                    while($ref = mysqli_fetch_assoc($referenti))
                        echo "<option  value="."$ref[ID]".">".$ref['cognome']." ".$ref['nome']."</option>";


                ?>
    
    </select>
    <input type="submit" value="Salva">
    
    
    </form>
</body>
</html>