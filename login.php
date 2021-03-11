<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW"/>
    <title>Halaman Login</title>
    <link href="assets/css/simplex-bootstrap.min.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>     
    <link href="assets/css/general.css" rel="stylesheet"/>
</head>
<body>
<div class="bg c">
    <div class="container">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Diagnosis Dempster-Shafer Penyakit Kambing</h3>
                </div>
                <div class="panel-body">
                    <form class="form-signin" action="?act=login" method="post">            
                    <?php if($_POST) include 'aksi.php';  ?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="user" autofocus />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="pass" />  
                    </div>    
                    <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button>
                    </div> 
                    <p>username : user , password : user</p>                         
                    </form> 
                </div>     
            </div>
        </div>
    </div>
</div>
</html>
