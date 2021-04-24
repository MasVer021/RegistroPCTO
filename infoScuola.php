<?php
    include "home.php";
    $sql = "Select areaGeografica,regione,provincia,
    codiceScuola,denominazioneScuola,indirizzoScuola,capScuola,codiceComuneScuola,
    indirizzoEmailScuola,indirizzoPecScuola,sitoWebScuola,obiettivoOre from scuola where scuola.codiceScuola ='".$_GET["CS"]."';";
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
               echo "<tr><th>Denominazione Scuola:</th><td>$scuola[denominazioneScuola]</td><th>Regione:</th><td>$scuola[regione]</td><th>Provincia:</th><td>$scuola[provincia]</td><th>indirizzo:</th><td>$scuola[indirizzoScuola]</td></tr>
                     <tr><th>CAP:</th><td>$scuola[capScuola]</td><th>Codice comune scuola:</th><td>$scuola[codiceComuneScuola]</td><th>Indirizzo email scuola:</th><td>$scuola[indirizzoEmailScuola]</td><th>Indirizzo pec scuola:</th><td>$scuola[indirizzoPecScuola]</td></tr>
                     <tr><th>Sito web scuola</th><td>$scuola[sitoWebScuola]</td><th>Obiettivo ore impostato :</th><td>$scuola[obiettivoOre]</td></tr>";
            ?>
            </table>
        </fieldset>




        <fieldset> <legend>Referenti PCTO</legend>
            <table>
            <tr><th>Cogome</th><th>Nome</th><th>Email</th><th>Data di nascita</th><th>Codice fiscale</th></tr>
        <?php
                
                $Referentisql ="SELECT nome,cognome,dataNascita,codFiscale,email FROM utente WHERE utente.scuolaAppartenenza = '$scuola[codiceScuola]' and utente.tipoProfilo = 1 ORDER BY cognome;"; 
                    $Referentisql = mysqli_query($DB,$Referentisql);
                    while($row =  mysqli_fetch_assoc($Referentisql))
                        echo "<tr><td>$row[cognome]</td><td>$row[nome]</td><td>$row[email]</td><td>$row[dataNascita]</td><td>$row[codFiscale]</td></tr>";
            ?>
            </table>
        </fieldset>

        <fieldset> <legend>Alunni</legend>
            <table>
            <tr><th>Cogome</th><th>Nome</th><th>Data di nascita</th><th>Codice fiscale</th></tr>
        <?php
                
                    $Alunnisql ="SELECT nome,cognome,dataNascita,codFiscale FROM utente WHERE utente.scuolaAppartenenza = '$scuola[codiceScuola]' and utente.tipoProfilo = 0 ORDER BY cognome;"; 
                    $Alunnisql = mysqli_query($DB,$Alunnisql);
                    while($row =  mysqli_fetch_assoc($Alunnisql))
                        echo "<tr><td>$row[cognome]</td><td>$row[nome]</td><td>$row[dataNascita]</td><td>$row[codFiscale]</td></tr>";
                
            ?>
            </table>
        </fieldset>
    </div>
</body>
</html>