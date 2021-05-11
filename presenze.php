<?php
    include "home.php";
	$anno = annoScolastico();
    
    $sql = "Select id,foto,cognome,nome,email,codiceFiscale from iscritto,utente where utente=utente.id and corso=$_GET[IDC] and annoscolastico='$anno'";
    $result= mysqli_query($DB,$sql);

    $sqli = "Select data,premioOre from appuntamento where id=$_GET[ID]";
    $resulti= mysqli_query($DB,$sqli);
    $data = mysqli_fetch_assoc($resulti);

    if(!empty($_POST))
        foreach($_POST as $utente =>$key){
            if(empty($key['presente']))
                $key['presente']="off";
        if(mysqli_fetch_assoc(mysqli_query($DB,"SELECT CONCAT(appuntamento,utente) as 'aput' from presente;"))['aput']==($_GET['ID'].$utente))
            registraPresenza($DB,$_GET['ID'],$utente,$key['presente'],$key['orePres'],true);
        else
            registraPresenza($DB,$_GET['ID'],$utente,$key['presente'],$key['orePres'],false);
         
            

           
        }


    $pre = false;
    if($data['data']<=date("Y-m-d"))
        $pre = true;    
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="#">
    <table>
    
    <tr><th>Presente</th><th>Ore di presenza</th><th>Foto</th><th>Cognome</th><th>Nome</th><th>Email</th><th>Codice fiscale</th></tr>
    
        <?php  
            if($pre){
                $value=0;
                while($row = mysqli_fetch_assoc($result)){
                    $presUtente = mysqli_fetch_assoc(mysqli_query($DB,"SELECT stato,orePresente from presente where appuntamento=$_GET[ID] and utente = $row[id] ;"));
                    if($presUtente['stato']=="Presente")
                    echo "<tr><td><input type='checkbox' name='$row[id][".'presente'."]' checked ></input></td><td><input type='number' min='1' max=$data[premioOre] value=$presUtente[orePresente] name='$row[id][".'orePres'."]'></input></td><td>$row[foto]</td><td>$row[cognome]</td><td>$row[nome]</td><td>$row[email]</td><td>$row[codiceFiscale]</td></tr>"; 
                    else
                    echo "<tr><td><input type='checkbox' name='$row[id][".'presente'."]'  ></input></td><td><input type='number' min='1' max=$data[premioOre] value=$data[premioOre] name='$row[id][".'orePres'."]'></input></td><td>$row[foto]</td><td>$row[cognome]</td><td>$row[nome]</td><td>$row[email]</td><td>$row[codiceFiscale]</td></tr>";                   
                }

            }
            else 
                while($row = mysqli_fetch_assoc($result)){
                    echo "non è possibile prendere le presenze di un appuntamento ancora da svolgere";
                    echo "<tr><td><input type='checkbox' disabled></input></td></td><td><input type='number' min='1' max=$data[premioOre] value=$data[premioOre] disabled></input></td><td>$row[foto]</td><td>$row[cognome]</td><td>$row[nome]</td><td>$row[email]</td><td>$row[codiceFiscale]</td></tr>"; 
                }

         ?>
     
    
    </table>
        <input type="submit" value="Salva">
    </form>

        


       






</body>

</html>