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
        <script src="../assert/js/jquery.js"></script>
        <script src="../assert/js/bootstrap.js"></script>
        
    </head>
    <body>
        <header>
            <?php include("navBar.php"); ?>
        </header>
        <div class="container-fluid">
            
            <div class="row justify-content-center">

                <div class="col col-md-6 align=center">
                   
                        <h2>Patient informations</h2>
                
                    <br>
                    <?php
                        // Connexion a la bdd
                        $mysqli = new mysqli("localhost", "boitier", "hospital", "BDD_HospitalTracking");

                        /* Vérification de la connexion */
                        if ($mysqli->connect_errno) {
                            printf("Échec de la connexion : %s\n", $mysqli->connect_error);
                            exit();
                        }

                        $patientId = $_POST['patientId'];
                        
                        $requestPatient = $mysqli->query("SELECT * FROM Patient WHERE id=".$patientId);
                        $resultPatient = $requestPatient->fetch_array();
						
						
                        $requestPatientTag = $mysqli->query("SELECT * FROM Tag WHERE id=".$resultPatient['idTag']);
                        $resultPatientTag = $requestPatientTag->fetch_array();
                        
                        
                    ?>
                    <form action="editPatient.php" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Id</span>
                            </div>
                            <input type="text" name="id" class="form-control" placeholder="FirstName" aria-label="FirstName" aria-describedby="basic-addon1" value="<?php echo($patientId);?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">First Name</span>
                            </div>
                            <input type="text" name="firstName" class="form-control" placeholder="FirstName" aria-label="FirstName" aria-describedby="basic-addon1" value="<?php echo($resultPatient['firstName']);?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Last Name</span>
                            </div>
                            <input type="text" name="lastName" class="form-control" placeholder="FirstName" aria-label="FirstName" aria-describedby="basic-addon1" value="<?php echo($resultPatient['lastName']);?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Tag</span>
                            </div>
                            <input type="text" name="tag" class="form-control" placeholder="FirstName" aria-label="FirstName" aria-describedby="basic-addon1" value="<?php echo($resultPatientTag['number']);?>">
                        </div>
                        <br>
                        <button class="btn btn-outline-primary btn-lg btn-block" type="submit">Edit</button>
                        <input name="oldTag" type="hidden" value="<?php echo($resultPatientTag['number']);?>">
                    </form>
                        </br>
                        <button class="btn btn-outline-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">Delete patient</button>
                        </br>
                        <a class="btn btn-outline-secondary btn-lg btn-block" href="patient.php">Back</a>  
                    
                </div>
                <div class="col col-md-6 align=center">
                    </br>
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Location</th>
                                    <th scope="col">Date</th>                     
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $requestPatientPos = $mysqli->query("SELECT * FROM Position WHERE idPatient=".$patientId." ORDER BY date DESC");
                                    while($resultPos = $requestPatientPos->fetch_array()){

                                        $requestLocation = $mysqli->query("SELECT * FROM Borne WHERE id=".$resultPos['idBorne']);

                                        $resultLocation = $requestLocation->fetch_array();

                                ?>
                                    <tr>
                                        <td><?php echo($resultLocation['location']);?></td>
                                        <td><?php echo ($resultPos['date']);?></td>
                                    </tr>
                                <?php
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="deletePatient.php" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" name="patientId" value="<?php echo($patientId);?>"/>
                    <input type="hidden" name="patientTagNumber" value="<?php echo($resultPatientTag['number']);?>"/>
                    <p>
                        <bold><?php echo($resultPatient['firstName']);?></bold> will be deleted from the system.
                    </p>
                    <p>
                        Do the action ? 
                    </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </form>
</div>
