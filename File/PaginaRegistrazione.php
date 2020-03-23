<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pagina di registrazione</title>
    <link rel="stylesheet" type="text/css" href="css/registrazione1.css">

  </head>
  <body>
    <input type="button" onclick="location.href='../index.php'" value="Torna alla home">
    <div id="contenitore">
      <h1> Inserisci i tuoi dati:</h1>
      <form action="PaginaRegistrazione.php" method="POST"><br
      
        <label>Nome: </label><br>
        <input type="text" name="nome" placeholder="Mario" required>
        <br>
        <label>Anno di nascita: </label><br>
        <input type="date" name="annoNascita"  placeholder="1980-12-01" required>
        <br>

        <label>Professione: </label><input list="works" name="professione" required>
        <datalist id="works">
          <option value="Impiegato">
          <option value="Ricercatore">
          <option value="Libero professionista">
          <option value="Medico">
          <option value="Amministratore Naturae">
          <option value="Fotografo">
          <option value="Studente">
        </datalist><br><br>

        <label>Email: </label> <br>
        <input type="email" name="email" placeholder="mariorossi@gmail.com" required>
        <br>
        <label>Password: </label> <br>
        <input type="password" name="password" placeholder="" required>
        <br><br>
        <label>Foto: </label>
        <input type="file" name="foto" accept="image/jpeg, image/x-png"><br>


        <input type="submit" name="reg_user" value="Invia" >
      </form>
      </div>


  </body>
</html>
