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

    if($_GET['use']=="vic"){

        if($_GET['tipologia']=='gSis')
           $sqlclasse = "SELECT classe.id as codiceclasse,CONCAT(classe.anno,classe.sezione) as 'nomeclasse' FROM scuola,classe WHERE classe.Scuola=Scuola.ID and scuola.id=$_GET[sc]";
        else
            $sqlclasse = "SELECT tutorpctoclasse.classe as 'codiceclasse',CONCAT(classe.anno,classe.sezione) as 'nomeclasse' FROM tutorpctoclasse,classe,utente WHERE  tutorpctoclasse.classe=classe.id and tutorpctoclasse.utente=$_GET[utente] and annoscolastico=$_GET[anno] Group BY classe.id;";
        
        $resultclasse= mysqli_query($db,$sqlclasse); 
        if(mysqli_num_rows($resultclasse)>0){
            echo "<select id=\"alunniClasse\" onchange=\"infoAlunniClasse()\">" ;
            while($classe = mysqli_fetch_assoc($resultclasse)){
                echo "<option value=".$classe['codiceclasse'].">".$classe['nomeclasse']."</option>";
            }
            echo "</select> " ;        
        }
        else
            echo "<tr><th>Nessuna classe disponibile per questo anno scolastico</th></tr>";   
    }


    if($_GET['use']=="infAlC"){
            $sqlalunno = "SELECT Utente.id,utente.nome,utente.cognome,utente.email,utente.codiceFiscale FROM Utente,forma,Classe WHERE forma.Classe=Classe.ID AND forma.Utente=Utente.ID and Classe.ID =$_GET[codiceclasse] and forma.annoScolastico=$_GET[anno] GROUP BY (Utente.ID) ORDER BY cognome;";
            $resultalunno= mysqli_query($db,$sqlalunno);
            if(!empty($resultalunno) && mysqli_num_rows($resultalunno)>0){
                echo "<table><tr><th>cognome</th><th>nome</th><th>email</th><th>codice fiscale</th><th>ore PCTO svolte </th></tr>";
                while($alunno = mysqli_fetch_assoc($resultalunno)){
                    $sqlorealunno = "SELECT SUM(presente.orePresente) AS 'orePCTO' from Utente,presente,appuntamento where appuntamento.annoScolastico=$_GET[anno] and presente.Appuntamento=appuntamento.ID and utente.id=$alunno[id] and presente.Stato='Presente' GROUP BY (Utente.ID);";
                    $resultorealunno= mysqli_query($db,$sqlorealunno);
                    if(!empty($resultorealunno) && mysqli_num_rows($resultorealunno)>0)
                        $orealunno=mysqli_fetch_assoc($resultorealunno)['orePCTO'];
                    else
                        $orealunno=0;

                    echo "<tr><td>$alunno[cognome]</td><td>$alunno[nome]</td><td>$alunno[email]</td><td>$alunno[codiceFiscale]</td><td>$orealunno</td></tr>";          
                }
            }
        else
            echo "<tr><th>Nessun alunno disponibile per la classe selezionata</th></tr>"; 
        echo "</table>";
    }

    if($_GET['use']=="infAlCo"){
        $sqliscritto = "SELECT Utente.id,utente.nome,utente.cognome,utente.email,utente.codiceFiscale FROM Utente,iscritto,Corso WHERE iscritto.Corso=Corso.id and iscritto.Utente=Utente.ID and iscritto.annoScolastico=$_GET[anno] and Corso.ID=$_GET[codicecorso] GROUP BY (Utente.ID) ORDER BY cognome;";    
        $resultiscritto= mysqli_query($db,$sqliscritto);
                if(!empty($resultiscritto) && mysqli_num_rows($resultiscritto)>0){
                    echo "<table><tr><th>cognome</th><th>nome</th><th>email</th><th>codice fiscale</th><th>ore PCTO corso attualmente svolte </th></tr>";
                    while($iscritto = mysqli_fetch_assoc($resultiscritto)){
                        $sqloreiscritto = "SELECT SUM(presente.orePresente) AS 'orePCTO' from Utente,presente,appuntamento where appuntamento.annoScolastico=$_GET[anno] and presente.Appuntamento=appuntamento.ID and utente.id=$iscritto[id] and presente.Stato='Presente' and appuntamento.corso = $_GET[codicecorso] GROUP BY (Utente.ID);";
                        $resultoreiscritto= mysqli_query($db,$sqloreiscritto);
                        if(!empty($resultoreiscritto) && mysqli_num_rows($resultoreiscritto)>0)
                            $oreiscritto=mysqli_fetch_assoc($resultoreiscritto)['orePCTO'];
                        else
                            $oreiscritto=0;

                        echo "<tr><td>$iscritto[cognome]</td><td>$iscritto[nome]</td><td>$iscritto[email]</td><td>$iscritto[codiceFiscale]</td><td>$oreiscritto</td></tr>";          
                    }
                }
                else
                    echo "<tr><th>Nessun alunno disponibile per il corso selezionata</th></tr>"; 
                echo "</table>";
}

if($_GET['use']=="vico")  {
    
    if($_GET['tipologia']=='gSis')
        $sqlcorso = "SELECT corso.id as 'codicecorso' ,corso.nome FROM scuola,classe,corso,attivato WHERE attivato.Corso=corso.ID AND attivato.Classe=classe.id AND classe.Scuola=Scuola.ID AND Scuola.ID=$_GET[sc] and attivato.annoScolastico=$_GET[anno] GROUP by corso.ID;";
    else   
        $sqlcorso = "SELECT corso.id,tutorcorso.Corso as 'codicecorso', corso.nome FROM tutorcorso,corso,utente WHERE tutorcorso.Corso=corso.ID and tutorcorso.Utente=$_GET[utente] and tutorcorso.annoScolastico=$_GET[anno] GROUP by corso.id;";

        $resultcorso= mysqli_query($db,$sqlcorso);
        if(mysqli_num_rows($resultcorso)>0){
            echo "<select id=\"alunniCorso\" onchange=\"infoAlunniCorso()\">" ;
            while($corso = mysqli_fetch_assoc($resultcorso)){
                echo "<option value=".$corso['codicecorso'].">".$corso['nome']."</option>";
            } 
            echo "</select>";       
        }
        else
            echo "<tr><th>Nessun corso disponibile per questo anno scolastico</th></tr>";   
    }


    if($_GET['use']=="esameOre5")  {
    
        
            $sqlesame5 = 
            "SELECT Utente.nome,utente.cognome,Utente.codiceFiscale,Utente.email,SUM(presente.orePresente) as 'oresvolte',scuola.obiettivoOre, IF(SUM(presente.orePresente)>=scuola.obiettivoOre,\"ha svolto tutte le ore di PCTO per accedere all'esame \",\"non ha svolto tutte le ore di PCTO per accedere all'esame \")as 'accessoesame'
            from Utente,forma,Classe,scuola,presente,appuntamento 
            WHERE forma.Classe=Classe.ID and forma.Utente=Utente.ID and Classe.Scuola=scuola.ID and Classe.anno=5 and scuola.id =$_GET[sc] and forma.annoScolastico=$_GET[anno] and presente.Appuntamento=appuntamento.ID and presente.Utente=Utente.id AND presente.Stato=\"Presente\"
            GROUP BY Utente.ID
            order by cognome;";
            $resultesame5= mysqli_query($db,$sqlesame5);
            if(mysqli_num_rows($resultesame5)>0){
                echo "<table><tr><th>cognome</th><th>nome</th><th>codice fiscale</th><th>email</th><th>ore PCTO attualmente svolte </th><th>ore PCTO da svolgere per accedere all'esame </th><th>stato attuale accesso esame </th></tr>";
                while($alunniPesame = mysqli_fetch_assoc($resultesame5)){
                    echo "<tr><td>$alunniPesame[cognome]</td><td>$alunniPesame[nome]</td><td>$alunniPesame[codiceFiscale]</td><td>$alunniPesame[email]</td><td>$alunniPesame[oresvolte]</td><td>$alunniPesame[obiettivoOre]</td><td>$alunniPesame[accessoesame]</td><tr>";
                } 
                     
            }
            else
                echo "<tr><th>Nessun alunno ha svolto le ore necessarie per svolgere l'esame</th></tr>";   
        }

    

?>