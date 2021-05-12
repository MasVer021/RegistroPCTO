<?php
    include "funzioni.php";
    $db = connessioneDB("localhost","root","","registropcto");

    if($_GET['use']=="reg")
        foreach (arrayRegioni() as $val) 
            echo "<option value=".$val.">".$val."</option>";
    
    if($_GET['use']=="pro")   
        foreach (arrayProvince() as $key =>$val) 
            echo "<option value=".$key.">".$val."</option>";
    
    if($_GET['use']=="cla")   {
        $sql = "Select  concat(anno,sezione) as nClasse,ID from classe where scuola=$_GET[sc];";
        $result= mysqli_query($db,$sql);
        while($row = mysqli_fetch_assoc($result))
            echo "<option  value="."$row[ID]".">".$row['nClasse']."</option>";
    }
    if($_GET['use']=="ans")  {
        $_SESSION['annoS'] = $_GET['an'];
    }

    if($_GET['use']=="vco")  {
        $sql = "SELECT corso.ID,corso.nome, tutorEsterno,monteore,CONCAT(utente.cognome,utente.nome) as tutorInterno FROM corso,attivato,classe,utente,tutorcorso WHERE tutorcorso.utente=utente.id and tutorcorso.corso=corso.id and tutorcorso.annoscolastico=$_GET[anno] and attivato.corso=corso.id and attivato.classe=classe.id and classe.scuola=$_GET[sc] and attivato.annoscolastico=$_GET[anno] group by corso.id,utente.id;";
        $result= mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0)
            echo'<tr><th>Nome corso</th><th>tutor interno</th><th>tutor esterno</th><th>monte ore </th></tr>';
        else
            echo'<tr><th>Nessun Corso attualmente presente per questo anno scolastico</th></tr>';
        
        while($row = mysqli_fetch_assoc($result))
            echo "<tr><td><a href=appuntamento.php?ID=$row[ID]>$row[nome]</a></td><td>$row[tutorInterno]</td><td>$row[tutorEsterno]</td><td>".$row['monteore']."</td></tr>";
            
    }

    if($_GET['use']=="ins")  {
        $sql = "Select nome,regione,provincia,CAP,indirizzomail,indirizzoPec,sitoWeb,obiettivoOre,indirizzo from scuola,lavora where lavora.scuola=$_GET[sc] and lavora.utente=$_GET[utente] and lavora.scuola=scuola.id and lavora.annoscolastico=$_GET[anno];";
        $result= mysqli_query($db,$sql);
        $scuola =mysqli_fetch_assoc($result);
        echo "<tr><th>Denominazione Scuola:</th><td>$scuola[nome]</td><th>Regione:</th><td>$scuola[regione]</td><th>Provincia:</th><td>$scuola[provincia]</td><th>indirizzo:</th><td>$scuola[indirizzo]</td></tr>
        <tr><th>CAP:</th><td>$scuola[CAP]</td><th>Indirizzo email scuola:</th><td>$scuola[indirizzomail]</td><th>Indirizzo pec scuola:</th><td>$scuola[indirizzoPec]</td><th>Sito web scuola</th><td>$scuola[sitoWeb]</td></tr>
        <tr><th>Obiettivo ore impostato :</th><td>$scuola[obiettivoOre]</td></tr>";
    }

    if($_GET['use']=="vic")  {
        $sqlclasse = "SELECT tutorpctoclasse.classe as 'codiceclasse',CONCAT(classe.anno,classe.sezione) as 'nomeclasse' FROM tutorpctoclasse,classe WHERE  tutorpctoclasse.classe=classe.id and tutorpctoclasse.utente=$_GET[utente] and annoscolastico=$_GET[anno];";
        $resultclasse= mysqli_query($db,$sqlclasse);
        if(mysqli_num_rows($resultclasse)>0)
            while($classe = mysqli_fetch_assoc($resultclasse)){
                echo "<tr><th>$classe[nomeclasse]</th></tr>";
                $sqlalunno = "SELECT Utente.id,utente.nome,utente.cognome,utente.email,utente.codiceFiscale FROM Utente,forma,Classe WHERE forma.Classe=Classe.ID AND forma.Utente=Utente.ID and Classe.ID =$classe[codiceclasse] and forma.annoScolastico=$_GET[anno] GROUP BY (Utente.ID) ORDER BY cognome;";
                $resultalunno= mysqli_query($db,$sqlalunno);
                $alunno = mysqli_fetch_assoc($resultalunno);
                $sqlorealunno = "SELECT SUM(presente.orePresente) AS 'orePCTO' from Utente,presente,appuntamento where appuntamento.annoScolastico=$_GET[anno] and presente.Appuntamento=appuntamento.ID and utente.id=$alunno[id] GROUP BY (Utente.ID);";
                $resultorealunno= mysqli_query($db,$sqlorealunno);
                if(!empty($resultorealunno) && mysqli_num_rows($resultorealunno)>0)
                    $orealunno=mysqli_fetch_assoc($resultorealunno)['orePCTO'];
                else
                    $orealunno=0;
                if(!empty($resultalunno) && mysqli_num_rows($resultalunno)>0)
                    echo "<tr><td>$alunno[cognome]</td><td>$alunno[nome]</td><td>$alunno[email]</td><td>$alunno[codiceFiscale]</td><td>$orealunno</td></tr>";
                else
                    echo "<tr><td>$alunno[cognome]</td><td>$alunno[nome]</td><td>$alunno[email]</td><td>$alunno[codiceFiscale]</td><td>$orealunno</td></tr>"; 



            }
        else
            echo "<tr><th>Nessuna classe disponibile per questo anno scolastico</th></tr>";
        
    }



?>