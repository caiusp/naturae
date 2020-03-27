<?php
session_start();

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");
if($_SESSION['tipoUtente']!="AMMINISTRATORE") {
  echo "NON TI E' POSSIBILE ACCEDERE A QUESTA PAGINA";
  header("location: Profilo.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modifica scheda vegetale</title>
    <link rel="stylesheet" type="text/css" href="css/Modificaspecieveg.css">

  </head>
  <body>
    <div id="inserimento">
      <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    </div>
    

    <div id="dati">


    <h1>Modifica di SPECIE VEGETALE</h1><br>

    <form class="" action="Modificaspecieveg_Server.php" method="post">

    <label>Inserisci il nome latino della specie che vuoi aggiornare: </label><br><input type="text" name="nomelat" placeholder="Marsilea quadrifolia"><br>
    <label>Nuova lunghezza: </label><br><input type="number" name="lunghezza" placeholder="30"><br>
    <label>Nuovo diametro: </label><br><input type="number" name="diametro" placeholder="40"><br><br>

    <input type="submit" name="send_specievegetale" value="Invia">

    </form>
    </div>

  </body>
</html>
