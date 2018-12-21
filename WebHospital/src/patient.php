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
            
            <div class="row">

                <div class="col">
                   <h2>Patient list</h2>
                   <br>
                   <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-light table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Last Position</th>                         
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

                                    if($requestTag = $mysqli->prepare("SELECT number FROM Tag WHERE id=?")){
                                        $requestTag->bind_param("i", $data["idTag"]);
                                        $requestTag->execute();
                                        $requestTag->bind_result($tagNumber);
                                        $requestTag->fetch();
                                    }else{
                                        $tagNumer="xxxxxxxx";
                                    }

                                    if($requestLastPos = $mysqli->prepare("SELECT name FROM Borne WHERE id = (SELECT idBorne FROM Position WHERE idPatient=? ORDER BY date DESC LIMIT 1)")){
                                        $requestLastPos->bind_param("i", $data["id"]);
                                        $requestLastPos->execute();
                                        $requestLastPos->bind_result($lastPos);
                                        $requestLastPos->fetch();
                                    }else{
                                        $lastPos = "XXXX";
                                    }
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo($data["id"]); ?></th>
                                        <td><?php echo($data["firstName"]); ?></td>
                                        <td><?php echo($data["lastName"]); ?></td>
                                        <td><?php echo($tagNumber); ?></td>
                                        <td><?php echo($lastPos); ?></td>
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

