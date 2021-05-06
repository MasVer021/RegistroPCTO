<?php
    include "funzioni.php";
    $db = connessioneDB("localhost","root","","registropcto");

    $sql = "Select denominazioneScuola,provincia,codiceScuola from scuola;";
    $result= mysqli_query($db,$sql);
    $_SESSION['foto'] = null;
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery.min.js"></script>  
	<script src="js/bootstrap.min.js"></script>
    <script src="js/crop.js"></script>
	<script src="js/croppie.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/croppie.css" />
    <title>Signin</title>
    

</head>
<body>
     
    <div id="Div_Login">
      
        <fieldset>
            <form action="welcome.php" method="POST" enctype="multipart/form-data">
                <p><h1>Sign in</h1></p>
                <label>Nome:<input type="text" placeholder="nome" name="nome"></label><br><br>
                <label>Cognome:<input type="text" placeholder="Cognome" name="cognome"></label><br><br>
                <label>Data nascita:<input type="date" placeholder="Data nascita" name="dataN"></label><br><br>
                <label>Luogo nascita:<input type="text" placeholder="Luogo nascita" name="luogoN"></label><br><br>
                <label>Codice fiscale:<input type="text" placeholder="codice fisclae" name="cv"></label><br><br>
                <label>scuola di appartenenza<input list="scuole" placeholder="scuola di appartenenza" name='scuolaApp'></label><br><br>
                <label>Email:<input type="text" placeholder="Email" name="email"></label><br><br>
                <datalist id="scuole">
                    <?php
                        while($row = mysqli_fetch_assoc($result))
                        echo "<option value=".$row['codiceScuola'].">".str_replace(' ', '_', $row['denominazioneScuola'])."-".$row['provincia']."</option>";
                    ?>
                </datalist>

                <label>Password:<input type="password" placeholder="Password" name="Password"></label><br><br>
                <!--<label>Conferma password:<input type="text" placeholder="Conferma password" name="user"></label><br><br>
                    
                <?php if(isset($_GET['err']) && $_GET['err']==1) echo "<label style=color:red><h2>Email o password non corretti</h2></label>";?>-->
                
               
            
                    Seleziona immagine di profilo
                    <div class="panel-body">
                        <input type="file" name="upload_image" id="upload_image" />
                            <br />
                            <div id="uploaded_image"></div>
                    </div>
             
    

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
        
                <p><input type="submit" value="Sign up"></p>
                <p id="btnReg">Gia registrato?<a href="Login.php">Accedi qui</a></p>
            </form> 
        

        </fieldset >
        
    </div>  
</body>

</html>