<?php
    include "funzioni.php";  
    $DB = connessioneDB("localhost","root","","registropcto");

    if(empty($_SESSION["ID"]) or $_SESSION["ID"]==null){
        autenticazioneUtente($DB,$_POST['user'],$_POST['password']);
        $_SESSION['Fotop'] = $_SESSION["Foto"];
    }

    $id = $_SESSION["ID"];
    $foto = $_SESSION["Fotop"];
    $nome = $_SESSION["Nome"];
    $cognome = $_SESSION["Cognome"];
    $dataNascita = $_SESSION["DataN"];
    $luogoNascita = $_SESSION["LuogoN"];
    $email = $_SESSION["Email"];
    $password = $_SESSION["Password"];
    $tipologiaDiProfilo = $_SESSION["Tipo"];
    $cv = $_SESSION["CV"];
    $percorsoS=$_SESSION["percorsoS"];
    $max=0;
    
    foreach($percorsoS as $valore =>$key)
        if($valore>$max)
            $max=$valore;

	$scuolaA= $percorsoS[$max]['scuola']; 
	 
    foreach($percorsoS as $anno => $Sc)
        $annoS[]= substr($anno,0,4)."/".substr($anno,4,4);
    
        arsort($annoS);
        
    $annoScolastico=null;
    $annoS=array_unique($annoS);
    
    if($tipologiaDiProfilo == "Std"){
        $OrePCTO = mysqli_fetch_assoc(mysqli_query($DB,"SELECT SUM(orePresente) as oreP from presente where utente = $id and stato='Presente' ;"))['oreP'];
        if($OrePCTO==NULL)
            $OrePCTO=0;
        $classeA=$percorsoS[$max]['classe'];
    }
   



?>

<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="stylesheet" href="css/Styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Styles.css?ts=<?=time()?>&quot">
    <script src="js/asynreq.js"></script>
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
            if($tipologiaDiProfilo == "Std")
                echo "<p>Ore di PCTO svolte :<br>".$OrePCTO."</p>";
            echo "<a href='Login.php'><div id='logout'>Logout</div></a>";
            
        ?>   
    </div>
<?php
    
?>




    <div id="horizontalMenu">
   

       <?php
        foreach($annoS as $a) {
            $codanno=substr($a,0,4).substr($a,5,4);
            if (!empty($_SESSION['annoS']) && $codanno == $_SESSION['annoS'])
                $annoScolastico= $annoScolastico."<option selected  value=$codanno>$a</option>";
            else 
                $annoScolastico= $annoScolastico."<option value=$codanno>$a</option>";

        }
            if($tipologiaDiProfilo == "gSis"){
            
                echo '
                    <ul>
                        <li><a href="inCorsi.php">Inserisci corsi</a</li>
                        <li><a href="inReferente.php">Inserisci referente PCTO</a></li>
                        <li><a href="inReferenteInClasse.php">Inserisci referente PCTO in una classe</a></li>
                        <li><a href="vCorsi.php">visualizza corsi</a></li>
                        <li><a href="infoOreCorso.php">visualizza ore PCTO corsi</a></li>
                        <li><a href="infoOreClasse.php">visualizza ore PCTO classe</a></li>
                        <li><a href="infoScuola.php">visualizza dati scuola</a></li>
                        <li><a href="esame5.php">Alunni di 5a pronti per esame di stato</a></li>
                        <li><label>Anno scolastico:</label><select  id="annoScol" onchange="esameOre5('.$scuolaA.'),annoS(),corsoRef('.$id.',\'gSis\','.$scuolaA.'),Vcorsi('.$scuolaA.'),infoScuola('.$scuolaA.','.$id.'),classiRef('.$id.',\'gSis\','.$scuolaA.')">'.$annoScolastico.'</select></li>
                                         
                    </ul>';
            }
                
            if($tipologiaDiProfilo =="refPCTO"){
                echo '
                    <ul>
                        <li><a href="vCorsi.php">Appello corsi</a></li>
                        <li><a href="infoOreCorso.php">visualizza ore PCTO corsi</a></li>
                        <li><a href="infoOreClasse.php">visualizza ore PCTO classe</a></li>
                        <li><a href="infoScuola.php">visualizza dati scuola</a></li>
                        <li><a href="infoScuola.php">Alunni di 5a pronti per esame di stato</a></li>
                        <li><label>Anno scolastico:</label><select  id="annoScol" onchange="annoS(),corsoRef('.$id.',\'refPCTO\','.$scuolaA.'),Vcorsi('.$scuolaA.'),infoScuola('.$scuolaA.','.$id.'),classiRef('.$id.',\'refPCTO\','.$scuolaA.')">'.$annoScolastico.'</select></li>
                                        
                </ul>';
            }

            if ($tipologiaDiProfilo == "Std" ){
                echo '
                    <ul>
                        <li><a href="vCorsi.php">visualizza corsi</a></li>
                        <li><a href="infoOrePCTO.php">visualizza dettagli ore PCTO</a></li>
                        <li>
                        <label>Anno scolastico:</label>
                        <select  id="annoScol" onchange="annoS(),Vcorsi('.$scuolaA.')">'.$annoScolastico.'</select>
                    </li>                    
                </ul>';
            }

            
        ?>
    </div>
</body>
</html>