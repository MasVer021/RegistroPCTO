<?php
    include "funzioni.php";

    if($_GET['use']=="reg")
        foreach (arrayRegioni() as $val) 
            echo "<option value=".$val.">".$val."</option>";
    
    if($_GET['use']=="pro")   
        foreach (arrayProvince() as $key =>$val) 
            echo "<option value=".$key.">".$val."</option>";
     
?>