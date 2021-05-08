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
        header("Location: login.php?err=1");
     
    if(empty($_SESSION["Email"]))
      header("Location: login.php?err=1");
    else{
      $sql="SELECT classe,annoScolastico,scuola FROM forma,classe,scuola WHERE Utente=$_SESSION[ID] and classe.scuola=scuola.id and forma.classe=classe.id;";
      $result= mysqli_query($db,$sql);
      $x=0;
      while($row = mysqli_fetch_assoc($result)){
        $_SESSION["percorsoS"][strval($row["annoScolastico"])]["classe"]=$row["classe"];
        $_SESSION["percorsoS"][strval($row["annoScolastico"])]["scuola"]=$row["scuola"];  
      }
    }
    
    $db->close();  
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

  function registraScuola($db,$nomeScuola, $regione, $provincia, $capScuola,$indirizzoEmailScuola,$indirizzoPecScuola,$sitoWebScuola,$ObiettivoOrePCTO,$indirizzoScuola){
    
    $sql = "INSERT INTO scuola (nome,regione,provincia,CAP,indirizzoMail,indirizzoPEC,sitoWeb,obiettivoOre,indirizzo) 
    VALUES ('$nomeScuola', '$regione', '$provincia', '$capScuola','$indirizzoEmailScuola','$indirizzoPecScuola','$sitoWebScuola',$ObiettivoOrePCTO,'$indirizzoScuola');";
    $result = mysqli_query($db,$sql);

    if($result===TRUE)
        return false;
    else
        echo "Sono stati riscontrati problemi tecnici nell inserimento dei dati della scuola, contattare supporto tecnico";
    

    $db->close();

  }

  function registraClasse($db,$anno,$sezione,$scuola){

    $sql = "INSERT INTO classe (anno,sezione,scuola) 
    VALUES ('$anno','$sezione','$scuola');";
    $result = mysqli_query($db,$sql);

    if($result===TRUE)
        return false;
    else
        echo "Sono stati riscontrati problemi tecnici nell inserimento dei dati della classe, contattare supporto tecnico";
    

    $db->close();



  }
  function registraCorso($db,$nomeCorso,$tutorInterno,$tutorEsterno,$codiceCorso,$annoScolastico,$nPartecipantiMin,$nPartecipantiMax,$foto,$monteore,$codCreatore){
    
    if($foto!=NULL){
      $codImg = base64_encode($foto);
      $sql = "INSERT INTO corso (denominazioneCorso,tutorInterno,tutorEsterno,codiceCorso,annoCorso,nPartecipantiMin,nPartecipantiMax,fotoCorso,monteOreCorso,codCreatore)
      VALUES ('$nomeCorso','$tutorInterno','$tutorEsterno','$codiceCorso','$annoScolastico','$nPartecipantiMin','$nPartecipantiMax','$codImg','$monteore','$codCreatore')";
  
    }
    else{
      $sql = "INSERT INTO corso (denominazioneCorso,tutorInterno,tutorEsterno,codiceCorso,annoCorso,nPartecipantiMin,nPartecipantiMax,monteOreCorso,codCreatore)
      VALUES ('$nomeCorso','$tutorInterno','$tutorEsterno','$codiceCorso','$annoScolastico','$nPartecipantiMin','$nPartecipantiMax','$monteore','$codCreatore')";
  
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


  function registraAppuntamento($db,$data,$ora,$luogo,$premioOre,$corso){
    $sql = "INSERT INTO appuntamento (data,ora,luogo,premioOre,corso) VALUES('$data','$ora','$luogo',$premioOre,$corso);";
    $result = mysqli_query($db,$sql);

    if($result===TRUE){
        echo "dati inseriti";
   
    }else{
        echo "fallito";
    }

    


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