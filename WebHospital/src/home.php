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
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            
            <div class="row justify-content-center">

                <div class="col col-md-5 col-sm-10" align="center">
                    <h2>Welcome <?php echo($_SESSION['prenom']); ?></h2>
                    </br>
                    <ul class="list-group">
                        <li class="list-group-item">First name : <?php echo$_SESSION['lastName'];?></li>
                        <li class="list-group-item">Second name : <?php echo$_SESSION['firstName'];?></li>
                        <li class="list-group-item">Age : <?php echo$_SESSION['age'];?></li>
                        <li class="list-group-item">Poste : <?php echo$_SESSION['job'];?></li>
                        <li class="list-group-item">Group : <?php echo$_SESSION['group'];?></li>
                    </ul>
                        </br>
                    <a class="btn btn-primary" href="disconnect.php">Disconnect</a>
                </div>

                <div class="col col-md-5 col-sm-10" align="center">
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