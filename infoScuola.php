<?php
    include "home.php";

    if(!empty($_GET["CS"]))
        $scuola = $_GET["CS"];
    else    
        $scuolapp = $scuolaA;    







    $sql = "Select indirizzo,regione,provincia,nome,codiceScuola,CAP,
    indirizzomail,indirizzoPec,sitoWeb,obiettivoOre from scuola where scuola.id=".$scuolapp.";";
    $result= mysqli_query($DB,$sql);
    $scuola =mysqli_fetch_assoc($result);


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
        <fieldset> <legend>Dati scuola</legend>
       
            <table style="margin-left: 0 auto;"> 
            <?php
               echo "<tr><th>Denominazione Scuola:</th><td>$scuola[nome]</td><th>Regione:</th><td>$scuola[regione]</td><th>Provincia:</th><td>$scuola[provincia]</td><th>indirizzo:</th><td>$scuola[indirizzo]</td></tr>
                     <tr><th>CAP:</th><td>$scuola[CAP]</td><th>Indirizzo email scuola:</th><td>$scuola[indirizzomail]</td><th>Indirizzo pec scuola:</th><td>$scuola[indirizzoPec]</td><th>Sito web scuola</th><td>$scuola[sitoWeb]</td></tr>
                     <tr><th>Obiettivo ore impostato :</th><td>$scuola[obiettivoOre]</td></tr>";
            ?>
            </table>
        </fieldset>




        <fieldset> <legend>Referenti PCTO</legend>
            <table>
            <tr><th>Cogome</th><th>Nome</th><th>Email</th><th>Data di nascita</th><th>Codice fiscale</th></tr>
        <?php
                
                $Referentisql ="SELECT nome,cognome,dataNascita,codiceFiscale,email FROM utente WHERE utente.scuola = $scuolapp and utente.tipoProfilo = 'refPCTO' ORDER BY cognome;"; 
                    $Referentisql = mysqli_query($DB,$Referentisql);
                    while($row =  mysqli_fetch_assoc($Referentisql))
                        echo "<tr><td>$row[cognome]</td><td>$row[nome]</td><td>$row[email]</td><td>$row[dataNascita]</td><td>$row[codiceFiscale]</td></tr>";
            ?>
            </table>
        </fieldset>

        <fieldset> <legend>Alunni</legend>
            <table>
            <tr><th>Cogome</th><th>Nome</th><th>Data di nascita</th><th>Codice fiscale</th><th>Classe</th></tr>
        <?php
                
                    $Alunnisql ="SELECT nome,cognome,dataNascita,codiceFiscale,sezioneAnno FROM utente,classe WHERE utente.scuola = $scuolapp and utente.tipoProfilo = 'Std' and utente.Classe = Classe.id ORDER BY cognome;";
                    $Alunnisql = mysqli_query($DB,$Alunnisql);
                    while($row =  mysqli_fetch_assoc($Alunnisql))
                        echo "<tr><td>$row[cognome]</td><td>$row[nome]</td><td>$row[dataNascita]</td><td>$row[codiceFiscale]</td><td>$row[sezioneAnno]</td></tr>";
                
            ?>
            </table>
        </fieldset>

        <fieldset> <legend>Corsi</legend>
            <table>
            <tr><th>Anno scolastico corso</th><th>Nome Corso</th><th>Tutor interno</th><th>tutor esterno</th><th>monte ore</th></tr>
        <?php
                
                    $corsisql ="SELECT corso.nome, tutorEsterno,anno,monteore, CONCAT(utente.cognome,' ',utente.nome)as 'tutorInterno' FROM corso,utente WHERE  utente.scuola =$scuolapp and corso.tutorcorso=utente.id ORDER BY corso.nome;";
                    $corsisql = mysqli_query($DB,$corsisql);
                    while($row =  mysqli_fetch_assoc($corsisql))
                        echo "<tr><td>$row[anno]</td><td>$row[nome]</td><td>$row[tutorInterno]</td><td>$row[tutorEsterno]</td><td>$row[monteore]</td></tr>";
                
            ?>
            </table>
        </fieldset>
    </div>
</body>
</html>