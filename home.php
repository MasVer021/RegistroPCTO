<?php
    include "funzioni.php";
    $DB = connessioneDB("localhost","root","","registropcto");

    if(empty($_SESSION["ID"]) or $_SESSION["ID"]==null)
    autenticazioneUtente($DB,$_POST['user'],$_POST['password']);

    $id = $_SESSION["ID"];
    $foto = $_SESSION["Foto"];
    $nome = $_SESSION["Nome"];
    $cognome = $_SESSION["Cognome"];
    $dataNascita = $_SESSION["DataN"];
    $luogoNascita = $_SESSION["LuogoN"];
    $email = $_SESSION["Email"];
    $password = $_SESSION["Password"];
    $tipologiaDiProfilo = $_SESSION["Tipo"];
    $cv = $_SESSION["CV"];
    $scuolaA = $_SESSION["scuolaAppartenenza"];
    $classeA=$_SESSION["classe"];
    
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/Styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Styles.css?ts=<?=time()?>&quot">
    <title>Document</title>
    
</head>
<body>
    <div id="verticalMenu">
        <?php
            if(isset($foto))
                echo '<p><img src="data:image/png;base64,'.$foto.'"></p>';
            else 
                echo '<p><img src="img/avatar-placeholder.gif"></p>';
            
            echo "<p>Nome:<br>".$nome."</p>";
            echo "<p>Cognome:<br>".$cognome."</p>";
            echo "<p>Data nascita:<br>".$dataNascita."</p>";
            echo "<p>Codice fiscale:<br>".$cv."</p>";


            echo "<a href='Login.php'><div id='logout'>Logout</div></a>"
            
        ?>   
    </div>

    <div id="horizontalMenu">


       <?php
            if($tipologiaDiProfilo == "gSis")
            
                echo '
                <ul>
                    <li><a href="inScuola.php">Inserisci Scuola</a></li>
                    <li><a href="inReferente.php">Inserisci referente PCTO</a></li>
                    <li><a href="vScuole.php">Visualizza Scuole</a></li>
                </ul>';
            if($tipologiaDiProfilo =="refPCTO")
                echo '
                <ul>
                    <li><a href="inCorsi.php">Inserisci corsi</a></li>
                    <li><a href="vCorsi.php">visualizza corsi</a></li>
                    <li><a href="infoScuola.php">visualizza dati scuola</a></li>
                </ul>';
            if ($tipologiaDiProfilo == "Std" )
                echo '
                <ul>
                <li><a href="vCorsi.php">visualizza corsi</a></li>
                </ul>';
        ?>
    </div>
</body>
</html>