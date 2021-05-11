<?php
    include "home.php";

    if(!empty($_GET["CS"]))
        $scuola = $_GET["CS"];
    else    
        $scuolapp = $scuolaA;    


    $sql = "Select nome,regione,provincia,CAP,indirizzomail,indirizzoPec,sitoWeb,obiettivoOre,indirizzo from scuola,lavora where lavora.scuola=".$scuolapp." and lavora.utente=$id;";
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


        <fieldset> <legend>Classe</legend>
            <?php 
                    $classesql ="SELECT id,concat(anno,sezione)as nomeC FROM classe WHERE scuola='$scuolapp';";
                    $classesql = mysqli_query($DB,$classesql);
                    while($row =  mysqli_fetch_assoc($classesql)){
                        echo "<fieldset><legend>$row[nomeC]</legend>";
                        $referetesql ="SELECT nome,cognome,email,codicefiscale FROM utente,tutorpctoclasse WHERE utente.tipoProfilo = 'refPCTO' and tutorpctoclasse.classe='$row[id]' and tutorpctoclasse.utente=utente.id and annoscolastico=".annoScolastico()." ORDER BY cognome;";
                        $referetesql = mysqli_query($DB,$referetesql);
                        if(mysqli_num_rows($referetesql) ==0)
                            echo "<table><tr><th>Non presenti referenti PCTO in questa classe durante il corrente anno scolastico</th></tr>";
                        else
                            echo "<table><tr><th>Cognome</th><th>Nome</th><th>Email</th><th>Codice fiscale</th><th>Ruolo</th></tr>";
                        while($referentiClasse =  mysqli_fetch_assoc($referetesql)){
                            echo "<tr><td>$referentiClasse[cognome]</td><td>$referentiClasse[nome]</td><td>$referentiClasse[email]</td><td>$referentiClasse[codicefiscale]</td><td>Referente PCTO classe</td></tr>";
                        
                            
                        }
                        $alunnisql ="SELECT nome,cognome,email,codicefiscale FROM utente,forma WHERE utente.tipoProfilo = 'Std' and forma.classe='$row[id]' and forma.utente=utente.id and annoscolastico=".annoScolastico()." ORDER BY cognome;";
                        $alunnisql = mysqli_query($DB,$alunnisql);
                        if(mysqli_num_rows($alunnisql) ==0)
                            echo "<table><tr><th>Non presenti alunni in quest classe durante il corrente anno scolastico</th></tr>";
                        else
                            echo "<table><tr><th>Cognome</th><th>Nome</th><th>Email</th><th>Codice fiscale</th><th>Ruolo</th></tr>";
                        while($alunniClasse =  mysqli_fetch_assoc($alunnisql)){
                            echo "<tr><td>$alunniClasse[cognome]</td><td>$alunniClasse[nome]</td><td>$alunniClasse[email]</td><td>$alunniClasse[codicefiscale]</td><td>Studente</td></tr>";
                        
                            
                        }
                        echo "</table>";
                        echo "</fieldset>";
                    }
                
            ?>
        </fieldset>    
        
    </div>
</body>
</html>