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
        <script src="../script/poppers.js"></script>
        <script src="../assert/css/chart.bundle.js"></script>
        <script type="text/javascript" src="../script/chart.js"></script>
        <script src="../assert/js/jquery.js"></script>
        <script src="../assert/js/bootstrap.js"></script>
        <script src="../assert/js/svg.js"></script>
        
    </head>
    <body>
        <header>
            <?php include("navBar.php"); ?>
        </header>
        <div class="container-fluid">
            
            <div class="row">
                <div class="col">
                <h2>Patient informations</h2>
                <br>
                <div class="row">
                    
                    <div class="col col-md-6">

                    <form action="addPatient.php" method="post">
                        <label for="basic-url">First Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Patient's first name" name="patientFirstName"/>
                        </div>
                        <label for="basic-url">Last Name</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Patient's last name" name="patientLastName"/>
                        </div>
                        <label for="basic-url">Tag Number</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Patient's  tag number" name="patientTag"/>
                        </div>
                        <button class="btn btn-success" type="submit">Add patient</button>
                        <a class="btn btn-danger" href="patient.php">Cancel</a>
                    </form>

                    </div>
                </div>

                </div>
            </div> 
     
        </div>
        <footer class="footer">
            <?php include("footer.php"); ?>
        </footer>
    </body>
    