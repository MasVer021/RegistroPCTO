<?php
    include "home.php";

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
<body   onload="classiRef(<?php echo $id.',\''.$tipologiaDiProfilo.'\','.$scuolaA;?>)">
    <br>
    <br>
    <div id="classiRefPCTO"></div>
    <div id="divAlunni"></div>
</body > 
</html>