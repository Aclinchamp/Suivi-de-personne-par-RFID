<?php
session_start();

if(!isset($_SESSION['isConnected'])){
    header('Location: ../index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="FR">
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tracking</title>
        <link href="../assert/css/bootstrap.css" rel="stylesheet">
        <link href="../assert/css/home.css" rel="stylesheet">
        <script src="../assert/css/chart.bundle.js"></script>
        <script type="text/javascript" src="../script/chart.js"></script>
        
    </head>
    <body>
        <header>
            <?php include("navBar.php"); ?>
        </header>
        <div class="container-fluid">
            
            <div class="row">

                <div class="col-6">
                    <h2>Welcome <?php echo($_SESSION['prenom']); ?></h2>
                    </br>
                    <ul class="list-group">
                        <li class="list-group-item">First name : <?php echo$_SESSION['nom'];?></li>
                        <li class="list-group-item">Second name : <?php echo$_SESSION['prenom'];?></li>
                        <li class="list-group-item">Age : <?php echo$_SESSION['age'];?></li>
                        <li class="list-group-item">Poste : <?php echo$_SESSION['poste'];?></li>
                        <li class="list-group-item">Group : <?php echo$_SESSION['groupe'];?></li>
                        </br>
                    <a class="btn btn-primary" href="disconnect.php">Disconnect</a>
                </div>

                <div class="col-6">
                <h2>Overview</h2>
                <figcaption class="figure-caption">Number of patient per room</figcaption>
                <canvas id="chart-bornes">
                    <script>drawBornesChart()</script>
                </canvas>
                </div>
            </div> 
            
        </div>
        <footer class="footer">
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>