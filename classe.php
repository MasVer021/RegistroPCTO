<?php
    include "funzioni.php";
    $db = connessioneDB("localhost","root","","registropcto");
    
    $sql = "Select  sezioneAnno, ID from classe where scuola=$_GET[sc];";
    $result= mysqli_query($db,$sql);

    while($row = mysqli_fetch_assoc($result))
    echo "<option  value="."$row[ID]".">".$row['sezioneAnno']."</option>";
?>