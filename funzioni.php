<?php
  session_start();

    
    
  function autenticazioneUtente($db,$user,$password){

    $_SESSION["ID"] = NULL;
    $_SESSION["Nome"] = NULL;
    $_SESSION["Cognome"] = NULL;
    $_SESSION["Email"] = NULL;
    $_SESSION["Password"] = NULL;
    $_SESSION["DataN"] = NULL;
    $_SESSION["CV"] = NULL;
    $_SESSION["Foto"] = NULL;
    $_SESSION["scuolaAppartenenza"]=NULL;
    $_SESSION["classe"]=NULL;
    $_SESSION["Tipo"] = NULL;
    $_SESSION["percorsoS"]=NULL;
 
    
    $sql = "SELECT  * FROM utente;";
      
    if(isset($user) && isset($password)){
      $result= mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_assoc($result))
            if($row['email']==$user && $row['password']==$password){
              $_SESSION["ID"] = $row['ID'];
              $_SESSION["Nome"] = $row['nome'];
              $_SESSION["Cognome"] = $row['cognome'];
              $_SESSION["Email"] = $row['email'];
              $_SESSION["Password"] = $row['password'];
              $_SESSION["DataN"] = $row['dataNascita'];
              $_SESSION["CV"] = $row['codiceFiscale'];
              $_SESSION["Foto"] = $row['foto'];
              $_SESSION["Tipo"] = $row['tipoProfilo'];
            }
      }else 
        echo "0 results";
    }
      else
        header("Location: index.php?err=1");
     
    if(empty($_SESSION["Email"]))
      header("Location: index.php?err=1");
    else{
      if( $_SESSION["Tipo"]=='Std' or  $_SESSION["Tipo"]=='exUt'){
        $sql="SELECT classe,  annoScolastico,scuola FROM forma,classe,scuola WHERE Utente=$_SESSION[ID] and classe.scuola=scuola.id and forma.classe=classe.id ORDER BY annoScolastico;";
        $result= mysqli_query($db,$sql);
        while($row = mysqli_fetch_assoc($result)){
          $_SESSION["percorsoS"][$row["annoScolastico"]]["classe"]=$row["classe"];
          $_SESSION["percorsoS"][$row["annoScolastico"]]["scuola"]=$row["scuola"];
        }
      }
      elseif ( $_SESSION["Tipo"]=='refPCTO' or $_SESSION["Tipo"]=='gSis'){
        $sql="SELECT annoScolastico,scuola FROM lavora WHERE Utente=$_SESSION[ID] ORDER BY annoScolastico;";
        $result= mysqli_query($db,$sql);
        while($row = mysqli_fetch_assoc($result))
          $_SESSION["percorsoS"][$row["annoScolastico"]]["scuola"]=$row["scuola"];
          
        
      }
        
      }
    }
    
    
     
  

  function connessioneDB($nomeHost,$nomeuser,$password,$nomeDb){

    $conn = new mysqli($nomeHost,$nomeuser ,$password, $nomeDb);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    return $conn;
  }

 


  function registraUtente($db,$nome,$cognome,$email,$password,$dataNascita,$luogoNascita,$codiceFiscale,$foto,$tipoProfilo){


    
    if($foto!=NULL){
      $codImg = base64_encode($foto);
      $sql = "INSERT INTO utente (nome,cognome,email,password,datanascita,luogonascita,codicefiscale,foto,tipoprofilo) 
      VALUES ('$nome','$cognome','$email','$password','$dataNascita','$luogoNascita','$codiceFiscale','$codImg','$tipoProfilo');";
    }

    else{
      $sql = "INSERT INTO utente (nome,cognome,email,password,datanascita,luogonascita,codicefiscale,tipoprofilo) 
      VALUES ('$nome','$cognome','$email','$password','$dataNascita','$luogoNascita','$codiceFiscale','$tipoProfilo');";
    }
    
    $result = mysqli_query($db,$sql);
   
    if($result===TRUE)
      return false;
    else
      echo "Sono stati riscontrati problemi tecnici nell inserimento dei dati dell' utente, contattare supporto tecnico";
  
    $_SESSION["Foto"] = NULL;
    

  }

  function giaRegistrato($db,$email){

    $sql = "SELECT * FROM utente;";
    $result= mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        if($email == $row['email'])
            return $row['tipoProfilo'].",".$row['nome'];
      }
      return NULL;
  }

  function registraScuola($db,$nomeScuola, $regione, $provincia, $capScuola,$indirizzoEmailScuola,$indirizzoPecScuola,$sitoWebScuola,$ObiettivoOrePCTO,$indirizzoScuola){
    
    $sql = "INSERT INTO scuola (nome,regione,provincia,CAP,indirizzoMail,indirizzoPEC,sitoWeb,obiettivoOre,indirizzo) 
    VALUES ('$nomeScuola', '$regione', '$provincia', '$capScuola','$indirizzoEmailScuola','$indirizzoPecScuola','$sitoWebScuola',$ObiettivoOrePCTO,'$indirizzoScuola');";
    $result = mysqli_query($db,$sql);

    if($result===TRUE)
        return false;
    else
        echo "Sono stati riscontrati problemi tecnici nell inserimento dei dati della scuola, contattare supporto tecnico";
  }

  function registraClasse($db,$anno,$sezione,$scuola){

    $sql = "INSERT INTO classe (anno,sezione,scuola) 
    VALUES ('$anno','$sezione','$scuola');";
    $result = mysqli_query($db,$sql);

    if($result===TRUE)
        return false;
    else
        echo "Sono stati riscontrati problemi tecnici nell inserimento dei dati della classe, contattare supporto tecnico";
  }

  function registraCorso($db,$nomeCorso,$tutorEsterno,$nPartecipantiMin,$nPartecipantiMax,$foto,$monteore){
    
    if($foto!=NULL){
      $codImg = base64_encode($foto);
      $sql = "INSERT INTO corso (nome,tutorEsterno,foto,monteOre,nPartecipantiMin,nPartecipantiMax)
      VALUES ('$nomeCorso','$tutorEsterno','$codImg',$monteore,$nPartecipantiMin,$nPartecipantiMax)";
  
    }
    else{
      $sql = "INSERT INTO corso (nome,tutorEsterno,monteOre,nPartecipantiMin,nPartecipantiMax)
      VALUES ('$nomeCorso','$tutorEsterno',$monteore,$nPartecipantiMin,$nPartecipantiMax)";
  
      $codImg ="NULL";
    }
   echo $sql ;
    $result = mysqli_query($db,$sql);

    if($result===TRUE){
        echo "dati inseriti";
   
    }else{
        echo "fallito";
    }
   
    $_SESSION["Foto"] = NULL;
    

  }


  function registraAppuntamento($db,$data,$ora,$luogo,$premioOre,$corso,$annoScolastico){
    $sql = "INSERT INTO appuntamento (data,ora,luogo,premioOre,corso,annoScolastico) VALUES('$data','$ora','$luogo',$premioOre,$corso,$annoScolastico);";
    $result = mysqli_query($db,$sql);

    if($result===TRUE){
        echo "dati inseriti";
    }else{
        echo "fallito";
    }
  }

  function annoScolastico(){
    if(explode("/",date("d/m/Y"))[1]>7)
      return explode("/",date("d/m/Y"))[2].(explode("/",date("d/m/Y"))[2]+1);
    else 
      return (explode("/",date("d/m/Y"))[2]-1).explode("/",date("d/m/Y"))[2];
  }


  function registraPresenza($db,$appuntamento,$utente,$presente,$orePresenza,$up){

    $stato = "'Assente'";
  if($presente == "on")
    $stato = "'Presente'";

    if($up)
      $sql = "UPDATE presente SET `orePresente`=$orePresenza,Stato=$stato WHERE appuntamento=$appuntamento and utente=$utente;";
    else
      $sql = "INSERT INTO presente (appuntamento,utente,orePresente,stato) VALUES($appuntamento,$utente,$orePresenza,$stato);";

    $result = mysqli_query($db,$sql);

     echo $sql;

    if($result===TRUE)
        return false;
    else
        echo "Sono stati riscontrati problemi tecnici nell inserimento dei dati delle presenze, contattare supporto tecnico";

  }

  function arrayProvince(){
    
    return $province = array(
          'AG' => 'Agrigento',
          'AL' => 'Alessandria',
          'AN' => 'Ancona',
          'AO' => 'Aosta',
          'AR' => 'Arezzo',
          'AP' => 'Ascoli Piceno',
          'AT' => 'Asti',
          'AV' => 'Avellino',
          'BA' => 'Bari',
          'BT' => 'Barletta-Andria-Trani',
          'BL' => 'Belluno',
          'BN' => 'Benevento',
          'BG' => 'Bergamo',
          'BI' => 'Biella',
          'BO' => 'Bologna',
          'BZ' => 'Bolzano',
          'BS' => 'Brescia',
          'BR' => 'Brindisi',
          'CA' => 'Cagliari',
          'CL' => 'Caltanissetta',
          'CB' => 'Campobasso',
          'CI' => 'Carbonia-Iglesias',
          'CE' => 'Caserta',
          'CT' => 'Catania',
          'CZ' => 'Catanzaro',
          'CH' => 'Chieti',
          'CO' => 'Como',
          'CS' => 'Cosenza',
          'CR' => 'Cremona',
          'KR' => 'Crotone',
          'CN' => 'Cuneo',
          'EN' => 'Enna',
          'FM' => 'Fermo',
          'FE' => 'Ferrara',
          'FI' => 'Firenze',
          'FG' => 'Foggia',
          'FC' => 'Forlì-Cesena',
          'FR' => 'Frosinone',
          'GE' => 'Genova',
          'GO' => 'Gorizia',
          'GR' => 'Grosseto',
          'IM' => 'Imperia',
          'IS' => 'Isernia',
          'SP' => 'La Spezia',
          'AQ' => 'L\'Aquila',
          'LT' => 'Latina',
          'LE' => 'Lecce',
          'LC' => 'Lecco',
          'LI' => 'Livorno',
          'LO' => 'Lodi',
          'LU' => 'Lucca',
          'MC' => 'Macerata',
          'MN' => 'Mantova',
          'MS' => 'Massa-Carrara',
          'MT' => 'Matera',
          'ME' => 'Messina',
          'MI' => 'Milano',
          'MO' => 'Modena',
          'MB' => 'Monza e della Brianza',
          'NA' => 'Napoli',
          'NO' => 'Novara',
          'NU' => 'Nuoro',
          'OT' => 'Olbia-Tempio',
          'OR' => 'Oristano',
          'PD' => 'Padova',
          'PA' => 'Palermo',
          'PR' => 'Parma',
          'PV' => 'Pavia',
          'PG' => 'Perugia',
          'PU' => 'Pesaro e Urbino',
          'PE' => 'Pescara',
          'PC' => 'Piacenza',
          'PI' => 'Pisa',
          'PT' => 'Pistoia',
          'PN' => 'Pordenone',
          'PZ' => 'Potenza',
          'PO' => 'Prato',
          'RG' => 'Ragusa',
          'RA' => 'Ravenna',
          'RC' => 'Reggio Calabria',
          'RE' => 'Reggio Emilia',
          'RI' => 'Rieti',
          'RN' => 'Rimini',
          'RM' => 'Roma',
          'RO' => 'Rovigo',
          'SA' => 'Salerno',
          'VS' => 'Medio Campidano',
          'SS' => 'Sassari',
          'SV' => 'Savona',
          'SI' => 'Siena',
          'SR' => 'Siracusa',
          'SO' => 'Sondrio',
          'TA' => 'Taranto',
          'TE' => 'Teramo',
          'TR' => 'Terni',
          'TO' => 'Torino',
          'OG' => 'Ogliastra',
          'TP' => 'Trapani',
          'TN' => 'Trento',
          'TV' => 'Treviso',
          'TS' => 'Trieste',
          'UD' => 'Udine',
          'VA' => 'Varese',
          'VE' => 'Venezia',
          'VB' => 'Verbano-Cusio-Ossola',
          'VC' => 'Vercelli',
          'VR' => 'Verona',
          'VV' => 'Vibo Valentia',
          'VI' => 'Vicenza',
          'VT' => 'Viterbo',
      );


    
  }
  
  function arrayRegioni(){
    return $regioni = array(
      'Abruzzo',
      'Basilicata',
      'Calabria' ,
      'Campania',
      'Emilia Romagna',
      'Friuli Venezia Giulia',
      'Lazio',
      'Liguria',
      'Lombardia',
      'Marche',
      'Molise',
      'Piemonte',
      'Puglia',
      'Sardegna',
      'Sicilia',
      'Toscana',
      'Trentino Alto Adige',
      'Umbria',
      "Valle d'Aosta",
      'Veneto'
    );
  }

?>