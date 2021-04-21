<?php
    include "home.php";
    $sql = "Select denominazioneScuola,provincia,codiceScuola from scuola;";
    $result= mysqli_query($DB,$sql);
    if(!empty($_POST['scuolaApp'])&&!empty($_POST['emailRef']))
        registraUtente($DB,"ToUp","ToUp","2021-03-01","ToUp","ToUp",NULL,$_POST['scuolaApp'],$_POST['emailRef'],"ToUp",1);

    


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
        <form  action="inReferente.php" method="POST">
            <label>scuola di appartenenza<input list="scuole" placeholder="scuola di appartenenza" name='scuolaApp'></label><br><br>
            <label>scuola di appartenenza<input type="email" placeholder="Email referente PCTO" name='emailRef'></label><br><br>


            <datalist id="scuole">
                <?php
                    while($row = mysqli_fetch_assoc($result))
                        echo "<option value=".$row['codiceScuola'].">".str_replace(' ', '_', $row['denominazioneScuola'])."-".$row['provincia']."</option>";
                ?>
            </datalist>
            <p><input type="submit" value="Invia"></p>
        </form>
    </div>
</body>
</html>