<?php
    include "home.php";
  
    if(!empty($_POST['emailRef'])){
        if(empty(giaRegistrato($DB,$_POST['emailRef']))){      
            registraUtente($DB,"ToUp","ToUp",$_POST['emailRef'],"ToUp","2020-10-10","ToUp","ToUp",NULL,"refPCTO");
            $idr= mysqli_fetch_assoc(mysqli_query($DB,"SELECT id from utente where email='".$_POST['emailRef']."';"))["id"];
            $RinS="INSERT INTO lavora (scuola,utente,annoscolastico)VALUES($scuolaA,'$idr',".annoScolastico().");";
            mysqli_query($DB,$RinS);
        }
        else
            echo "Email già registrato";
    }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="noCAnno()">
<br>
<br>
    <div>
        <form  action="inReferente.php" method="POST">
            <label>email referente<input type="email" placeholder="Email referente PCTO" name='emailRef'></label><br><br>

            <p><input type="submit" value="salva"></p>
        </form>
    </div>
</body>
</html>