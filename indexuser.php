<?php
include'functions.php';
if(empty($_SESSION['login']))
    header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="favicon.ico"/>

    <title>Dempster-Shafer</title>
    <link href="assets/css/simplex-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>         
  </head>
  <body>
  <div class="bg2">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="?">Menu Utama</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="?m=diagnosauser"><span class="glyphicon glyphicon-list-alt"></span> Penyakit</a></li>
          <li><a href="?m=gejalauser"><span class="glyphicon glyphicon-tags"></span> Gejala</a></li>
          <li><a href="?m=relasiuser"><span class="glyphicon glyphicon-random"></span> Relasi</a></li>
          <li><a href="?m=konsultasiuser"><span class="glyphicon glyphicon-search"></span> Diagnosis</a></li>    
          <li><a href="?m=pengobatanuser"><span class="glyphicon glyphicon-heart"></span> Pengobatan</a></li> 
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>     
        </ul>
      </div>
    </nav>

      <div class="container">
        <?php
            if(file_exists($mod.'.php'))
                include $mod.'.php';
            else
                include 'homeuser.php';
        ?>
      </div>
    

    <br><br><br><br><br><br></div>

  <footer class="fluid bg-footer text-center">
      <p>&copy;Institut Teknik PLN - M. Muhson Alfarisy</a></p> 
  </footer>
</html>