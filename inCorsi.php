<?php
    include "home.php";
    
    $sql = "Select  concat(anno,sezione) as nClasse,ID from classe where scuola=$scuolaA;";
    $result= mysqli_query($DB,$sql);
    
                

    if(!empty($_POST['nomeCorso']))
        $nomeCorso = $_POST['nomeCorso'];
    else
        $nomeCorso = null;
    
    if(!empty($_POST['tutorInterno']))
        $tutorInterno = $_POST['tutorInterno'];
    else
        $tutorInterno = null;
    
    if(!empty($_POST['tutorEsterno']))
        $tutorEsterno = $_POST['tutorEsterno'];
    else
        $tutorEsterno = null;
    
   
    
    
    if(!empty($_POST['nPartecipantiMin']))
        $nPartecipantiMin = $_POST['nPartecipantiMin'];
    else
        $nPartecipantiMin = null;
    
    if(!empty($_POST['nPartecipantiMax']))
        $nPartecipantiMax = $_POST['nPartecipantiMax'];
    else
        $nPartecipantiMax = null;

    if(!empty($_POST['oreCorso']))
        $oreCorso = $_POST['oreCorso'];
    else
        $oreCorso = null;
    
    $anno = annoScolastico();

    if($nomeCorso!=null && $tutorInterno!=null && $oreCorso!=null){
        registraCorso($DB,$nomeCorso,$tutorEsterno,$nPartecipantiMin,$nPartecipantiMax,$_SESSION['foto'],$oreCorso);
        $idc1="SELECT id from corso where nome='$nomeCorso' and tutorEsterno='$tutorEsterno' and monteore=$oreCorso;";
        
        $idc2=mysqli_query($DB,$idc1);
        $idc3=mysqli_fetch_assoc($idc2);
        
        $idc4= $idc3['id'];
        
       
        $RinS="INSERT INTO tutorcorso (corso,utente,annoscolastico)VALUES($idc4,$tutorInterno,'$anno');";
        mysqli_query($DB,$RinS);

        foreach($_POST['classe'] as $classe){
            $CinA="INSERT INTO attivato (classe,corso,annoscolastico) VALUES($classe,$idc4,'$anno');";
            mysqli_query($DB,$CinA);
        }

    }
?>
<!DOCTYPE html>

<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>  
	<script src="js/bootstrap.min.js"></script>
    <script src="js/crop.js"></script>
	<script src="js/croppie.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/croppie.css" />
    <script>
        function CorsiPClassi(){
            document.getElementById("classi").innerHTML="";
            let nClassi = document.getElementById("nClassiCorso").value;
        
                for(let x=0;x<nClassi;x++)  
                    document.getElementById("classi").innerHTML+="<select name=classe["+x+"]> <?php while($row = mysqli_fetch_assoc($result)) echo "<option  value="."$row[ID]".">".$row['nClasse']."</option>"; ?></select>";
                   
                        
                            
                        
                   
                    
                    
                
        
                
         
        }
    
    
    </script>









    <title>Document</title>
</head>
<body>
    <div>
        <form action="inCorsi.php" method="POST">
            <input type="text" placeholder="nome corso" name="nomeCorso"><br>
            <select name="tutorInterno" >
                <?php
                    $referenti =mysqli_query($DB, "SELECT nome, cognome, ID from utente, lavora where utente.tipoProfilo='refPCTO' and lavora.scuola='$scuolaA' and lavora.utente=utente.id and annoScolastico='$anno';");
                    echo "<option>Seleziona Tutor interno corso</option>";
                    while($ref = mysqli_fetch_assoc($referenti))
                        echo "<option  value="."$ref[ID]".">".$ref['cognome']." ".$ref['nome']."</option>";


                ?>
            </select><br>
            <label>numero di classi che posso accedere a questo corso</label>
            <input type="number" id="nClassiCorso">
            <button type="button" onclick="CorsiPClassi()"> avanti</button><br>
            <div id="classi"></div>



            <input type="text" placeholder="tutor esterno" name="tutorEsterno"><br>
            <input type="number" placeholder="nPartecipanti minimo" name="nPartecipantiMin"><br>
            <input type="number" placeholder="nPartecipanti massimo" name="nPartecipantiMax"><br>
            Seleziona immagine corso
            <input type="file" name="upload_image" id="upload_image" /><br />
            <div id="uploaded_image"></div>                
                            
            <div id="uploadimageModal" class="modal" role="dialog">
            
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload & Crop Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 text-center">
                                <div id="image_demo" style="width:350px; margin-top:30px"></div>
                            </div>
                            <div class="col-md-4">
                                <br />
                                <br />
                                <br/>
                                <button type="button" class="btn btn-success crop_image">Crop & Upload Image</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
            <input type="number" placeholder="monte ore corso" name="oreCorso"><br>
            <input type="submit" value="Inserisci"><br>
            
        
        
        </form>
    
    </div>

        










</body>
</html>