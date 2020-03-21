<?php 

session_start();
//LOGIN USER
$db=mysqli_connect('localhost','root','Nico1998','progetto') or die("Impossibile connettersi al database");

if(isset($_POST['nome'])) {
  $nome=$_POST['nome'];
  $password=$_POST['password'];

  $sql="SELECT * FROM UTENTE WHERE nome='".$nome."'AND password='".$password."' LIMIT 1";

  $result=mysqli_query($db,$sql);

  if(mysqli_num_rows($result)==1){
    $_SESSION['nome']=$nome;
    $_SESSION['eseguita']="Adesso sei connesso";
    header('location:File/Profilo.php');
    while ($row=mysqli_fetch_assoc($result)) {
      $_SESSION['email']=$row['email'];
      $_SESSION['annoNascita']=$row['annoNascita'];
      $_SESSION['professione']=$row['professione'];
      $_SESSION['tipoUtente']=$row['tipoUtente'];
    }
  }
  else {
    $message = "ERRORE: Nome o password sbagliati";
    echo "<script type='text/javascript'>alert('$message');</script>";
  }
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>NATURAE</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/coming-soon.min.css" rel="stylesheet">

</head>

<body>



  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="Video/Pexels Videos 2437257.mp4" type="video/mp4">
  </video>

  <div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-12 my-auto">
          <div class="masthead-content text-white py-5 py-md-0">
            <h1 class="mb-3">Benvenuto!</h1>
            <p class="mb-5">Inserisci le tue credenziali qua sotto!
              <br> <strong>Accedi anche tu a NATURAE</strong>!</p>
            <div class="input-group-newsletter">
                 <form class="" action="index.php" method="POST"> 
                <input type="text" class="form-control" name="nome" placeholder="Enter your nickname" required >
                <br>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required><br><br>
                <div class="input-group">
                  <button class="btn-secondary" type="submit" name="login_user" value="Submit" >Login</button> <br><br>
                  <p id="Registrazione">Non sei registrato? </p> <a href="File/PaginaRegistrazione.php"> Clicca qui</a>

              </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/coming-soon.min.js"></script>

</body>

</html>
