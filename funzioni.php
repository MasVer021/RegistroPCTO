<?php
  session_start();

    
    
  function autenticazioneUtente($db,$user,$password){

    $_SESSION["ID"] = null;
    $_SESSION["Foto"] = null;
    $_SESSION["Nome"] = null;
    $_SESSION["Cognome"] = null;
    $_SESSION["DataN"] = null;
    $_SESSION["LuogoN"] = null;
    $_SESSION["Email"] = null;
    $_SESSION["Password"] = null;
    $_SESSION["CV"] = null;
    $_SESSION["scuolaAppartenenza"] = null;

 
    
    $sql = "SELECT  * FROM utente;";
    
    
    
    
    if(isset($user) && isset($password)){
      $result= mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_assoc($result))
            if($row['email']==$user && $row['password']==$password){
              $_SESSION["ID"] = $row['ID'];
              $_SESSION["Foto"] = $row['fotoProfilo'];
              $_SESSION["Nome"] = $row['nome'];
              $_SESSION["CV"] = $row['codFiscale'];
              $_SESSION["Cognome"] = $row['cognome'];
              $_SESSION["DataN"] = $row['dataNascita'];
              $_SESSION["LuogoN"] = $row['luogoNascita'];
              $_SESSION["Email"] = $row['email'];
              $_SESSION["Password"] = $row['password'];
              $_SESSION["Tipo"] = $row['tipoProfilo'];
              $_SESSION["scuolaAppartenenza"]=$row['scuolaAppartenenza'];
            }
      }else 
        echo "0 results";
    }
      else
        header("Location: login.php?err=1");
     
    if(empty($_SESSION["Email"]))
      header("Location: login.php?err=1");
      
    
    $db->close();  
  }

  function connessioneDB($nomeHost,$nomeuser,$password,$nomeDb){

    $conn = new mysqli($nomeHost,$nomeuser ,$password, $nomeDb);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    return $conn;
  }



  function registraUtente($db,$nome,$cognome,$dataNascita,$luogoNascita,$cv,$fotoProfilo,$scuolaAppartenenza,$email,$password,$tipoProfilo){


    
    if($fotoProfilo!=NULL){
      $codImg = base64_encode($fotoProfilo);
      $sql = "INSERT INTO utente (ID,nome,cognome,dataNascita,luogoNascita,codFiscale,email,password,tipoProfilo,fotoProfilo,oreAccumulate,scuolaAppartenenza) 
      VALUES (NULL,'$nome','$cognome','$dataNascita','$luogoNascita','$cv','$email','$password',$tipoProfilo,'$codImg',0,'$scuolaAppartenenza');";
    }
    else{
      $sql = "INSERT INTO utente (ID,nome,cognome,dataNascita,luogoNascita,codFiscale,email,password,tipoProfilo,oreAccumulate,scuolaAppartenenza) 
      VALUES (NULL,'$nome','$cognome','$dataNascita','$luogoNascita','$cv','$email','$password',$tipoProfilo,0,'$scuolaAppartenenza');";
      $codImg ="NULL";
    }
    

   
    $result = mysqli_query($db,$sql);

    if($result===TRUE){
        echo "dati inseriti";
   
    }else{
        echo "fallito";
    }

    $db->close();

  }

  function giaRegistrato($db,$email){

    $sql = "SELECT email,tipoProfilo,nome FROM utente;";
    $result= mysqli_query($db,$sql);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        if($email == $row['email'])
            return $row['tipoProfilo'].",".$row['nome'];
      }
      return NULL;
  }

  function registraScuola($db,   $nomeScuola, $indirizzoScuola, $annoScolastico, $areaGeografica, $regione, $provincia, $codiceScuola, $codiceComuneScuola, $capScuola, $indirizzoEmailScuola, $indirizzoPecScuola, $sitoWebScuola ,$ObiettivoOrePCTO,$codiceCreatore){



    $sql = "INSERT INTO scuola (annoScolastico,areaGeografica,regione,provincia,codiceScuola,denominazioneScuola,indirizzoScuola,capScuola,codiceComuneScuola,indirizzoEmailScuola,indirizzoPecScuola,sitoWebScuola,obiettivoOre,codCreatore) 
    VALUES ('$annoScolastico','$areaGeografica','$regione','$provincia','$codiceScuola','$nomeScuola','$indirizzoScuola','$capScuola','$codiceComuneScuola','$indirizzoEmailScuola','$indirizzoPecScuola','$sitoWebScuola','$ObiettivoOrePCTO','$codiceCreatore');";

    $result = mysqli_query($db,$sql);

    if($result===TRUE){
        echo "dati inseriti";
   
    }else{
        echo "fallito";
    }

    $db->close();

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