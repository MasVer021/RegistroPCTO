<?php
    include "funzioni.php";
    $db = connessioneDB("localhost","root","","registropcto");
    

    if(!empty($_SESSION['foto']))
        $file =$_SESSION['foto'];
    else    
        $file = NULL;

    $val = explode(",",giaRegistrato($db,$_POST['email']));

    if($val[0]=="refPCTO" && $val[1]=="ToUp"){
        
        if($file!=NULL)
            $codImg = base64_encode($file);
        else 
            $codImg = null;

        $sql = "UPDATE utente SET nome='$_POST[nome]',cognome='$_POST[cognome]',dataNascita='$_POST[dataN]',luogoNascita='$_POST[luogoN]',codiceFiscale='$_POST[cv]',password='$_POST[password]' ,foto= '$codImg' WHERE utente.email='$_POST[email]';";
        mysqli_query($db,$sql);
    }
    else 
        if($val[0]==""){
            if(!empty($_POST['nome']) && !empty($_POST['cognome']) && !empty($_POST['dataN']) && !empty($_POST['luogoN'])&& !empty($_POST['cv']) && !empty($_POST['classe'])&& !empty($_POST['email']) && !empty($_POST['password'])){
                registraUtente($db,$_POST['nome'],$_POST['cognome'],$_POST['email'],$_POST['password'],$_POST['dataN'],$_POST['luogoN'],$_POST['cv'],$file,'Std');
                $anno = annoScolastico();
                $ids = mysqli_fetch_assoc(mysqli_query($db,"SELECT id from utente where email='$_POST[email]';"))["id"];;
                $SinC="INSERT INTO forma (classe,utente,annoscolastico)VALUES($_POST[classe],'$ids','$anno');";
                mysqli_query($db,$SinC);
            }
            else
                echo "non set";
        }
        else
            echo "utente già presente";

            header( "refresh:5; url=index.php" ); 
        
    




?>