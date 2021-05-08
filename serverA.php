<?php
    include "funzioni.php";

    if($_GET['use']=="reg")
        foreach (arrayRegioni() as $val) 
            echo "<option value=".$val.">".$val."</option>";
    
    if($_GET['use']=="pro")   
        foreach (arrayProvince() as $key =>$val) 
            echo "<option value=".$key.">".$val."</option>";
    
    if($_GET['use']=="cla")   {
        
        $db = connessioneDB("localhost","root","","registropcto");
        
        $sql = "Select  concat(anno,sezione) as nClasse,ID from classe where scuola=$_GET[sc];";
        $result= mysqli_query($db,$sql);

        while($row = mysqli_fetch_assoc($result))
            echo "<option  value="."$row[ID]".">".$row['nClasse']."</option>";
    }
?>