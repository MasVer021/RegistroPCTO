<?php
    session_start();
    $_SESSION["ID"] = null;
    $_SESSION["Foto"] = null;
    $_SESSION["Nome"] = null;
    $_SESSION["Cognome"] = null;
    $_SESSION["DataN"] = null;
    $_SESSION["LuogoN"] = null;
    $_SESSION["Email"] = null;
    $_SESSION["Password"] = null;
    $_SESSION["CV"] = null;
    $_SESSION["scuolaAppartenenza"]=null;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BibliotecaL</title>
    <link rel="stylesheet" href="css/Styles.css">

</head>
<body>
     
    <div id="Div_Login">
      
        <fieldset>
            <form action="home.php" method="POST">
                <p><h1>Log in</h1></p>
                <label><img src="img/letter.png"><input type="text" placeholder="Email" name="user"></label><br><br>
                <label><img src="img/padlock.png"><input type="password" placeholder="Password" name="password"></label>
                <?php if(isset($_GET['err']) && $_GET['err']==1) echo "<label style=color:red><h2>Email o password non corretti</h2></label>";?>
                <p id="btnReg">Non registrato?<a href="signin.php">Registrati qui</a></p>
                <p >Scuola non registrata?<a href="datiS.html">Registrati qui</a></p>
                <p id="btnLog"><input type="submit" value="Log In"></p>  
            </form>    
        </fieldset>
        
    </div>
   

</body>

</html>