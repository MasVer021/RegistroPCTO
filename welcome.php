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

        $sql = "UPDATE utente SET nome='$_POST[nome]',cognome='$_POST[cognome]',dataNascita='$_POST[dataN]',luogoNascita='$_POST[luogoN]',codiceFiscale='$_POST[cv]',password='$_POST[Password]' ,foto= '$codImg' WHERE utente.email='$_POST[email]';";
        mysqli_query($db,$sql);
    }
    else 
        if($val[0]==""){
            if(!empty($_POST['nome']) && !empty($_POST['cognome']) && !empty($_POST['dataN']) && !empty($_POST['luogoN'])&& !empty($_POST['cv']) && !empty($_POST['scuolaApp'])&& !empty($_POST['email']) && !empty($_POST['Password']))
                registraUtente($db,$_POST['nome'],$_POST['cognome'],$_POST['dataN'],$_POST['luogoN'],$_POST['cv'],$file,$_POST['scuolaApp'],$_POST['email'],$_POST['Password'],0) ;
            else
                echo "non set";
        }
        else
            echo "utente già presente";
        
    




?>