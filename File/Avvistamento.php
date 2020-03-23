<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pagina invio avvistamento</title>
    <link rel="stylesheet" type="text/css" href="css/Segnalazione.css">

  </head>
  <body>
    <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    <div id="contenitore">
      <h1>Avvistamento: </h1><br>
      <form class="" action="Avvistamento_Server.php" method="post">
        <label>Data avvistamento: </label><input type="date" name="data" required ><br><br>
        <label>Latitudine</label><br>
        <input type="number" name="latitudine" placeholder="43.961314" required><br>
        <label>Longitudine</label><br>
        <input type="number" name="longitudine" placeholder="74.902334" required>
        <label>Foto:</label><input type="file" name="foto" required><br><br>
        <label>Habitat: </label>
      <?php
      
        $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

        $result=mysqli_query($db,"SELECT nome FROM habitat");
        echo "<select name='habitat'>";
        while($riga=mysqli_fetch_array($result)){
        echo "<option>".$riga["nome"]."</option>";
        }
        echo "</select>";

      ?>  

        <input type="submit" name="send_avvistamento" value="Invia"></a>

      </form>
      </div>


  </body>
</html>
