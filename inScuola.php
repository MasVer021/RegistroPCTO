<?php
    include "home.php";

     
    $formComp =  !empty($_POST['nomeScuola']) && !empty($_POST['indirizzoScuola']) && 
                !empty($_POST['areaGeografica']) && !empty($_POST['regione']) && !empty($_POST['provincia']) && !empty($_POST['codiceScuola']) && 
                !empty($_POST['codiceComuneScuola']) && !empty($_POST['capScuola']) && !empty($_POST['indirizzoEmailScuola']) 
                && !empty($_POST['indirizzoPecScuola']) && !empty($_POST['sitoWebScuola']) && !empty($_POST['ObiettivoOrePCTO']);

 
    if($formComp){
        
        if(explode("/",date("d/m/Y"))[1]>6)
            $annoS=explode("/",date("d/m/Y"))[2]."/".(explode("/",date("d/m/Y"))[2]+1);
        else 
            $annoS=(explode("/",date("d/m/Y"))[2]-1)."/".explode("/",date("d/m/Y"))[2];

        registraScuola($DB,$_POST['nomeScuola'],$_POST['indirizzoScuola'],$annoS,
        $_POST['areaGeografica'],$_POST['regione'],$_POST['provincia'],$_POST['codiceScuola'],$_POST['codiceComuneScuola'],$_POST['capScuola'],
        $_POST['indirizzoEmailScuola'],$_POST['indirizzoPecScuola'],$_POST['sitoWebScuola'],$_POST['ObiettivoOrePCTO'],$id);
        
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
    <div>
        <fieldset>
            <form action="inScuola.php" method="POST">
                <label><input type="text" name="nomeScuola" placeholder="nomeScuola"></label><br><br>
                <label><input type="text" name="indirizzoScuola" placeholder="indirizzo(via,numero)"></label><br><br>
                <label><input type="text" name="areaGeografica" placeholder="areaGeografica"></label><br><br>
                <select name="regione">
                    <?php
                        foreach (arrayRegioni() as $val) {
                            echo "<option value=".$val.">".$val."</option>";
                         }  
                    ?>
                </select><br><br>
                <select name="provincia">
                    <?php
                        foreach (arrayProvince() as $key =>$val) {
                            echo "<option value=".$key.">".$val."</option>";
                         }  
                    ?>
                </select><br><br>
                <label><input type="text" name="codiceScuola" placeholder="codiceScuola"></label><br><br>
                <label><input type="text" name="codiceComuneScuola" placeholder="codiceComuneScuola"></label><br><br>
                <label><input type="text" name="capScuola" placeholder="CAP"></label><br><br>
                <label><input type="email" name="indirizzoEmailScuola" placeholder="indirizzoEmailScuola"></label><br><br>
                <label><input type="email" name="indirizzoPecScuola" placeholder="indirizzoPecScuola"></label><br><br>
                <label><input type="url" name="sitoWebScuola" placeholder="sitoWebScuola"></label><br><br>
                <label><input type="number" name="ObiettivoOrePCTO" placeholder="ObiettivoOrePCTO" ></label><br><br>
                <label><input type="submit" value="Inserisci"></label>
        
        
        
            </form>
    
        
        
        
        </fieldset>
        
    </div>
</body>
</html>