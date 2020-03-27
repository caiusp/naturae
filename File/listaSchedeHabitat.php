<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Lista schede habitat</title>
    <link rel="stylesheet" type="text/css" href="css/listaschedehabitat.css">

  </head>
  <body>
    <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
    <div id="contenitore">
      <h1>Lista schede habitat: </h1><br>
        <div class="testo">

          <?php
            $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");
            $listahabitat = mysqli_query($db,"SELECT Nome,Descrizione FROM habitat");
            $all_habit = array();

            echo '<table class="data-table">
            <tr class="data-heading">';  
            while ($habitat = mysqli_fetch_field($listahabitat)) {
              echo '<td>' . $habitat->name . '</td>';  //printa nomelatino
                array_push($all_habit, $habitat->name);
              }
              echo '</tr>';

              //showing all data
            while ($row = mysqli_fetch_array($listahabitat)) {
              echo "<tr>";
              foreach ($all_habit as $item) {
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
