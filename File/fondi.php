<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Effettua donazione</title>
  <link rel="stylesheet" type="text/css" href="css/Effettuadonazione.css">

</head>
<body>
  <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
  <div id="contenitore">
    <h1>Effettua la tua donazione! </h1><br>
    <form class="" action="Effettuadonazione_Server.php" method="post">

      <?php
        $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

        //get results from database
        $result = mysqli_query($db,"SELECT nrProgr as ID,saldoAttuale as Raccolti,stato,importoObiettivo as totale,descrizione FROM campagnafondi");
        $tabellacampagna = array();  //declare an array for saving habitat from the db

        //showing property
        echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
        while ($info = mysqli_fetch_field($result)) {
          echo '<td>' . $info->name . '</td>';  //get field name for header
          array_push($tabellacampagna, $info->name);  //save those to array
        }
        echo '</tr>'; //end tr tag

        //showing all data
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($tabellacampagna as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
              }
              echo '</tr>';
            }
        echo "</table>";

        $result=mysqli_query($db,"SELECT nrProgr FROM campagnafondi");
        //echo "seleziona campagna fondi";

        echo "Seleziona la campagna a cui sei interessato:";
        echo "<select name='campagna'>";
          while($riga=mysqli_fetch_array($result)){
            echo "<option>".$riga["nrProgr"]."</option>";
          }
        echo "</select>";
    ?>

    <label>Importo:</label><input type="number" name="importo"><label> €</label><br>
    <label for="note">Note: </label><br>
    <textarea name="note" rows="8" cols="50" maxlength="50"></textarea><br>

    <input type="submit" name="send_donazione" value="Invia">
  </form>
</div>

</body>
</html>
