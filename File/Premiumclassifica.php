<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>La tua classifica</title>
    <link rel="stylesheet" type="text/css" href="css/Premiumclassifica.css">
  </head>
  <body>
    <div class="col1">
      <div class="top">
        <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
      </div>

      <div class="contenitore1">
           <?php

     $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");
     $nome=$_SESSION['nome'];
     $result=mysqli_query($db,"SELECT ClassificazioniTotali,ClassificazioniCorrette,ClassificazioniErrate,Affidabilita FROM UTENTEPREMIUM WHERE nome='$nome'");
      $tabella = array();  //declare an array for saving habitat from the db

        //showing property
        echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
        while ($info = mysqli_fetch_field($result)) {
          echo '<td>' . $info->name . '</td>';  //get field name for header
          array_push($tabella, $info->name);  //save those to array
        }
        echo '</tr>'; //end tr tag

        //showing all data
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          foreach ($tabella as $item) {
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
