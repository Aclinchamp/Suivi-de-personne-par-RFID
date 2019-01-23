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
                    <ul class="list-group">
                        <li class="list-group-item"><bold>ID</bold> : <?php echo($patientId);?></li>
                        <li class="list-group-item"><bold>First name</bold> : <?php echo($resultPatient['firstName']);?></li>
                        <li class="list-group-item"><bold>Second name</bold> : <?php echo($resultPatient['lastName']);?></li>
                        <li class="list-group-item"><bold>Tag</bold> : <?php echo($resultPatientTag['number']);?></li>
                    </ul>
                    <br>
                </div>
                <div class="col col-md-6 align=center">
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Id</th>
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
                                        <th scope="row"><?php echo ($resultPos['id']);?></th>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</html>

