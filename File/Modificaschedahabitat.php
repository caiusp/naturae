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
    <title>Modifica scheda habitat </title>
    <link rel="stylesheet" type="text/css" href="css/Modificaschedahabitat.css">



  </head>
  <body>
    <div id="inserimento">
      <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    </div>
    

    <div id="dati">


    <h1>Modifica di HABITAT</h1><br>

    <form class="" action="Modificaschedahabitat_Server.php" method="post">

    <label>Nome habitat: </label><br><input type="text" name="habitat" placeholder="Laguna"><br>
    <label>Descrizione: </label><br><input type="url" name="descrizione" placeholder="http://vnr.unipg.it/habitat/cerca.do?formato=stampa&idSegnalazione=69"><br>

    <input type="submit" name="send_habitat" value="Invia">

    </form>
    </div>


  </body>
</html>
