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
    <title>Modifica scheda animale</title>
    <link rel="stylesheet" type="text/css" href="css/Modificaspeciean.css">

  </head>
  <body>
    <div id="inserimento">
      <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    </div>
    
    <div id="dati">


    <h1>Modifica di SPECIE ANIMALE</h1><br>

    <form class="" action="Modificaspeciean_Server.php" method="post">

    <label>Inserisci il nome latino della specie che vuoi aggiornare: </label><br><input type="text" name="nomelat" placeholder="Hystrix cristata"><br>
    <label>Nuovo peso: </label><br><input type="number" name="peso" placeholder="20"><br>
    <label>Nuova altezza: </label><br><input type="number" name="altezza" placeholder="850"><br>
    <label>Nuova prole:</label><br><input type="number" name="prole" placeholder="2"><br><br>

    <input type="submit" name="send_specieanimale" value="Invia">

    </form>
    </div>

  </body>
</html>
