<?php
    include "home.php";

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
    
    if(!empty($_POST['codiceCorso']))
        $codiceCorso = $_POST['codiceCorso'];
    else
        $codiceCorso = null;
    
    if(!empty($_POST['annoCorso']))
        $annoCorso = $_POST['annoCorso'];
    else
        $annoCorso = null;
    
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
    
    if($nomeCorso!=null && $tutorInterno!=null && $tutorEsterno!=null && $codiceCorso!=null && $oreCorso!=null)
        registraCorso($DB,$nomeCorso,$tutorInterno,$tutorEsterno,$codiceCorso,$annoCorso,$nPartecipantiMin,$nPartecipantiMax,$_SESSION['foto'],$oreCorso,$ID);

    
?>
<!DOCTYPE html>
<html lang="en">
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
    <title>Document</title>
</head>
<body>
    <div>
        <form action="inCorsi.php" method="POST">
            <input type="text" placeholder="nome corso" name="nomeCorso"><br>
            <input type="text" placeholder="tutor interno" name="tutorInterno"><br>
            <input type="text" placeholder="tutor esterno" name="tutorEsterno"><br>
            <input type="text" placeholder="codice corso" name="codiceCorso"><br>
            <input type="text" placeholder="annoScolastico" name="annoCorso"><br>
            <input type="number" placeholder="nPartecipanti minimo" name="nPartecipantiMin"><br>
            <input type="number" placeholder="nPartecipanti massimo" name="nPartecipantiMax"><br>
            
                
                    Seleziona immagine corso
                    
                        <input type="file" name="upload_image" id="upload_image" />
                            <br />
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