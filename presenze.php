<?php
    include "home.php";
    
    $sql = "Select foto,cognome,nome,email,codiceFiscale from iscritto,utente where utente=utente.id and corso=$_GET[IDC]";
    $result= mysqli_query($DB,$sql);

    $sqli = "Select data,premioOre from appuntamento where id=$_GET[ID]";
    $resulti= mysqli_query($DB,$sqli);
    $data = mysqli_fetch_assoc($resulti);
   

    $pre = false;
    if($data['data']<=date("Y-m-d"))
        $pre = true;
   
       
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
    <table>
    <tr><th>Presente</th><th>Ore di presenza</th><th>Foto</th><th>Cognome</th><th>Nome</th><th>Email</th><th>Codice fiscale</th></tr>
        <?php  
            if($pre)
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr><td><input type='checkbox'></input></td><td><input type='number' min='1' max=$data[premioOre]></input></td><td>$row[foto]</td><td>$row[cognome]</td><td>$row[nome]</td><td>$row[email]</td><td>$row[codiceFiscale]</td></tr>"; 
                }
            else 
                while($row = mysqli_fetch_assoc($result)){
                    echo "non è possibile prendere le presenze di un appuntamento ancora da svolgere";
                    echo "<tr><td><input type='checkbox' disabled></input></td></td><td><input type='number' min='1' max=$data[premioOre] disabled></input></td><td>$row[foto]</td><td>$row[cognome]</td><td>$row[nome]</td><td>$row[email]</td><td>$row[codiceFiscale]</td></tr>"; 
                }

         ?>
    </table>
    
</body>
</html>