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
                   <h2>Patient list</h2>
                   <br>
                   

                   <div class="row">
                    <div class="col col-md-9">
                        <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0">Search</button>  
                            </form>
                        </div>
                        <div class="col col-md-2">
                            <!--<a class="btn btn-secondary my-2 my-sm-0" href="addPatientPage.php">Add patient</a> -->
                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal"<?php 
                                                                    if($_SESSION['group'] == "médecin"){
                                                                        echo('disabled" disabled="disabled" data-toggle="tooltip" data-placement="top" title="Operation not permitted');
                                                                    }
                                                                ?>">Add patient</button>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <!-- <th scope="col">Tag</th> -->
                                    <th scope="col">Last Position</th> 
                                    <th scope="col">Action</th>                         
                                </tr>
                            </thead>
                            <tbody>
                            <?php 

                                // Connexion a la bdd
                                $mysqli = new mysqli("localhost", "boitier", "hospital", "BDD_HospitalTracking");

                                /* Vérification de la connexion */
                                if ($mysqli->connect_errno) {
                                    printf("Échec de la connexion : %s\n", $mysqli->connect_error);
                                    exit();
                                }

                                $requestPatient = "SELECT * FROM Patient";
                                $resultPatient = $mysqli->query($requestPatient);


                                while($data = $resultPatient->fetch_array()){

									$requestLastPos = $mysqli->prepare("SELECT location FROM Borne WHERE id =(SELECT idBorne FROM Position WHERE idPatient=? ORDER BY date DESC LIMIT 1)");

								$requestLastPos =  $mysqli->query("SELECT * FROM Borne WHERE id=(SELECT idBorne FROM Position WHERE idPatient=".$data['id']." ORDER BY date DESC LIMIT 1);");
                                //echo("SELECT * FROM Borne WHERE id=(SELECT idBorne FROM Position WHERE idPatient=".$data['id']." ORDER BY date DESC LIMIT 1);");
                                
                                $lastPos = $requestLastPos->fetch_array();
                                
                                $requestTag =  $mysqli->query("SELECT number FROM Tag WHERE id=".$data["idTag"]);
                                //echo("SELECT * FROM Borne WHERE id=(SELECT idBorne FROM Position WHERE idPatient=".$data['id']." ORDER BY date DESC LIMIT 1);");
                                
                                $tagNumber = $requestTag->fetch_array();
                            ?>
                                    <tr>
                                        <form action="fichePatient.php" method="post"> 
                                            
                                            <td><?php echo($data["firstName"]); ?></td>
                                            <td><?php echo($data["lastName"]); ?></td>
                                            <!--<td><?php //echo($tagNumber['number']); ?></td>-->
                                            <td><?php echo($lastPos['location']); ?></td>
                                        
                                            <input type="hidden" name="patientId" value="<?php echo($data["id"]);  ?>">
                                            <td><button type="submit" class="btn btn-outline-primary 
                                                                <?php 
                                                                    if($_SESSION['group'] == "accueil"){
                                                                        echo('disabled" disabled="disabled" data-toggle="tooltip" data-placement="top" title="Operation not permitted');
                                                                    }
                                                                ?>">Consult</button></td>
                                        </form>
                                        
                                    </tr>

                                <?php
									//$requestLastPos->close();
									//$requestTag->close();
                                    }
                                
                                ?>

                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            
        </div>
        <footer class="footer">
            <?php include("footer.php"); ?>
        </footer>
    </body>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="addPatient.php" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Patient informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <label for="basic-url">First Name</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Patient's first name" name="patientFirstName" required/>
                    </div>
                    <label for="basic-url">Last Name</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Patient's last name" name="patientLastName" required/>
                    </div>
                    <label for="basic-url">Tag Number</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Patient's  tag number" name="patientTag" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </form>
</div>
