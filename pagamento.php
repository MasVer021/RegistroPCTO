<?php
    include "funzioni.php";
    echo "<h1>Parte di pagamento da implementare</h1>";
    $inserimento = true;
    $db = connessioneDB("localhost","root","","registropcto");

    

        if(empty($_POST['nomeScuola']) || empty($_POST['regione']) || empty($_POST['provincia']) || empty($_POST['CAP']) ||empty($_POST['email'])||empty($_POST['obieOre'])||empty($_POST['indirizzo']) || empty($_POST["letteraC"]) || empty($_POST["emailRPCTO"])){
            $inserimento = false;
            echo "<h2>Dati inseriti non sufficienti si prega di reinserire i dati mancanti</h2>";
    }
    
    if($inserimento){
        
        if(empty($_POST['PEC']))
            $pec = null;
        else
            $pec=$_POST['PEC'];
   
        if(empty($_POST['sitoWeb']))
            $sitoW = null;
        else
            $sitoW=$_POST['PEC'];

       $anno = annoScolastico();
        
       $errS= registraScuola($db,$_POST['nomeScuola'],$_POST['regione'],$_POST['provincia'],$_POST['CAP'],$_POST['email'],$pec, $sitoW,$_POST['obieOre'],$_POST['indirizzo']);
       if($errS != false);
            echo $errS;

        $ids= mysqli_fetch_assoc(mysqli_query($db,"SELECT id from scuola where nome='$_POST[nomeScuola]' and cap='$_POST[CAP]';"))["id"];
        
        foreach($_POST["letteraC"] as $corso)
            for($i=1;$i<=5;$i++)
                $errC[$i]= registraClasse($db,$i,$corso,$ids);
            
        foreach($_POST["emailRPCTO"] as $emailR){
                $errR[$i]=  registraUtente($db,"ToUp","ToUp",$emailR,"ToUp","2020-10-10","ToUp","ToUp",NULL,"refPCTO");
                $idr= mysqli_fetch_assoc(mysqli_query($db,"SELECT id from utente where email='$emailR';"))["id"];
                $RinS="INSERT INTO lavora (scuola,utente,annoscolastico)VALUES('$ids','$idr','$anno');";
                mysqli_query($db,$RinS);
        }

        print_r($errC);
        print_r($errR);
        
    }
    $_POST=NULL;







?>