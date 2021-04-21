<?php
    include "funzioni.php";
    $db = connessioneDB("localhost","root","","registropcto");
    

    if(!empty($_SESSION['foto']))
        $file =$_SESSION['foto'];
    else    
        $file = NULL;

    $val = explode(",",giaRegistrato($db,$_POST['email']));
    var_dump($val);

    if($val[0]=="1" && $val[1]=="ToUp"){
        $sql = "UPDATE utente SET nome='$_POST[nome]',cognome='$_POST[cognome]',dataNascita='$_POST[dataN]',luogoNascita='$_POST[luogoN]',codFiscale='$_POST[cv]',password='$_POST[Password]' WHERE utente.email='$_POST[email]';";
        echo $sql;
        $result = mysqli_query($db,$sql);
        //echo "io entro";
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