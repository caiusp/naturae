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
    <title>Scheda specie animale</title>
    <link rel="stylesheet" type="text/css" href="css/Specieanimale.css">
  </head>
  <body>

          <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    <div id="dati">

    <h1>Crea una nuova scheda per una specie animale</h1><br>

      <form class="" action="inserisciSpecieAnimale_Server.php" method="post">

      <label>Nome latino: </label><br><input type="text" name="nomelat" placeholder="Hystrix cristata"><br>
      <label>Nome italiano: </label><br><input type="text" name="nomeita" placeholder="Istrice"><br>
      <label>Classe: </label><br><input type="text" name="classe" placeholder="MAMMALIA"><br>
      <label>Wikipedia: </label><br><input type="url" name="wiki" placeholder="https://it.wikipedia.org/wiki/Hystrix_cristata"><br>
      <label>Vulnerabilità: </label><br><input type="text" name="vulnerabilita" placeholder="Minimo"><br>
      <label>Anno: </label><br><input type="number" name="anno" placeholder="1758"><br>
      <label>Peso: </label><br><input type="number" name="peso" placeholder="20"><br>
      <label>Altezza: </label><br><input type="number" name="altezza" placeholder="850"><br>
      <label>Prole: </label><br><input type="number" name="prole" placeholder="2"><br>


      <input type="submit" name="send_specieanimale" value="Invia">

      </form>
    </div>

  </body>
</html>
