<?php
session_start();

$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");
if($_SESSION['tipoUtente']!="PREMIUM") {
  echo "NON TI E' POSSIBILE ACCEDERE A QUESTA PAGINA";
  header("location: Profilo.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Creazione nuova escursione</title>
    <link rel="stylesheet" type="text/css" href="css/Escursione.css">

  </head>
  <body>
    <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>

    <div id="contenitore">


    <h1>Crea una nuova escursione</h1><br>

      <form class="" action="Escursione_Server.php" method="post">

      <label>Titolo: </label><br><input type="text" name="titolo" placeholder="Escursione"><br>
      <label>Data: </label><input type="date" name="data" ><br>
      <label id="partenza">Orario partenza: </label><input type="number" name="orarioP">
      <label id="ritorno">Orario ritorno: </label><input type="number" name="orarioR"><br>
      <label>Tragitto:</label><br>
      <textarea name="tragitto" rows="5" cols="40"></textarea><br>
      <label>Descrizione: </label><br>
      <textarea name="descrizione" rows="5" cols="40"></textarea><br>
      <label>Numero massimo partecipanti: </label><input type="number" name="nrpart"><br><br>



      <input type="submit" name="send_escursione" value="Invia">

      </form>
    </div>

  </body>
</html>
