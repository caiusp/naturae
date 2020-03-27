    <?php
    $db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");
    ?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Lista specie vegetali</title>
        <link rel="stylesheet" type="text/css" href="css/listaspecieveg.css">

    </head>
    <body>

        <div class="col1">
            <input type="button" onclick="location.href='Profilo.php'" value="Torna alla home"/>
            <div id="contenitore">
                <h1>Lista schede Vegetali: </h1><br>
                <div class="cont1a">

                    <?php
                    $listaveg = mysqli_query($db,"SELECT * FROM specievegetale");
                    $all_vegetali = array();

                    echo '<table class="data-table">
                    <tr class="data-heading">';  
                    while ($habitat = mysqli_fetch_field($listaveg)) {
                        echo '<td>' . $habitat->name . '</td>';  //printa nomelatino
                        array_push($all_vegetali, $habitat->name);
                        }
                    echo '</tr>';

                    //showing all data
                    while ($row = mysqli_fetch_array($listaveg)) {
                        echo "<tr>";
                        foreach ($all_vegetali as $item) {
                            echo '<td>' . $row[$item] . '</td>'; //get items using property value
                        }
                        echo '</tr>';
                    }
                    echo "</table>";

                    ?>


</div>

</div>
</div>

<div class="col2">
  <div id="contenitore">
    <h1>Lista schede animali: </h1><br>



    <div class="cont1a">

        <?php
                    $listaanimali = mysqli_query($db,"SELECT * FROM specieanimale");
                    $all_animali = array();

                    echo '<table class="data-table">
                    <tr class="data-heading">';  //initialize table tag
                    while ($habitat = mysqli_fetch_field($listaanimali)) {
                        echo '<td>' . $habitat->name . '</td>';  //get field name for header
                        array_push($all_animali, $habitat->name);  //save those to array
                        }
                    echo '</tr>'; //end tr tag

                    //showing all data
                    while ($rows = mysqli_fetch_array($listaanimali)) {
                        echo "<tr>";
                        foreach ($all_animali as $items) {
                            echo '<td>' . $rows[$items] . '</td>'; //get items using property value
                        }
                        echo '</tr>';
                    }
                    echo "</table>";

        ?>

    </div>

</div>
</div>




</body>
</html>
