<?php
    include "home.php";

    if(!empty($_GET["CS"]))
        $scuola = $_GET["CS"];
    else    
        $scuolapp = $scuolaA;    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/asynreq.js"></script>
    <title>Document</title>
</head>
<body onload="infoScuola(<?php echo $scuolaA.','.$id?>)">
    <div>
        <fieldset > <legend>Dati scuola</legend>
       
            <table id="datiscuola" style="margin-left: 0 auto;"> 
            
            </table>
        </fieldset>


    
        
    </div>
</body>
</html>