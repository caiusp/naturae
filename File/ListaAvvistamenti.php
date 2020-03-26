<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lista avvistamenti</title>
    <link rel="stylesheet" type="text/css" href="css/listaAvvistamenti.css">

  </head>
  <body>
    <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>


    <div id="contenitore">
      <h1>Lista avvistamenti</h1><br>


        <div class="testo">
         <?php

     $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

     $result=mysqli_query($db,"SELECT Codice,nomeUtente as Avvistatore,Data,Latitudine,Longitudine,NomeHabitat,NomeLatino FROM AVVISTAMENTO");
      $tabellaavvistamenti = array();  //declare an array for saving habitat from the db

        //showing property
        echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
        while ($info = mysqli_fetch_field($result)) {
          echo '<td>' . $info->name . '</td>';  //get field name for header
          array_push($tabellaavvistamenti, $info->name);  //save those to array
        }
        echo '</tr>'; //end tr tag

        //showing all data
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($tabellaavvistamenti as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
          }
          echo '</tr>';
        }
        echo "</table>";

        ?>
        </div>



      </div>

  </body>
</html>
