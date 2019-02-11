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
        <script src="../assert/snap/dist/snap.svg.js"></script>
        
        
        
    </head>
    <body>
        <header>
            <?php include("navBar.php"); ?>
        </header>

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
                          
                                        if($lastPos['location'] == "Bloc opératoire"){
                                            echo '<div class="bloc" nom="'.$data["lastName"].'" prenom="'.$data["firstName"].'"></div>';

                                        }else if($lastPos['location'] == "Imagerie"){
                                            echo '<div class="scan" nom="'.$data["lastName"].'" prenom="'.$data["firstName"].'"></div>';

                                        }else if($lastPos['location'] == "Salle d'examen"){
                                            echo '<div class="exam" nom="'.$data["lastName"].'" prenom="'.$data["firstName"].'"></div>';
                                            
                                        }else{
                                            echo '<div class="hall" nom="'.$data["lastName"].'" prenom="'.$data["firstName"].'"></div>';
                                        }
                                    }
                                ?>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col col-md-6" align="center">
                    <svg id="plan" style="min-height:500px;min-width:500px;"></svg> 
                </div>
                <div class="col col-md-5" align="center">
                    <div id="zone">
                        <h2 id="nomPiece">Passer votre curseur sur les pièces</h2>
                        <div id="informations">
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        <footer class="footer">
            <?php include("footer.php"); ?>
        </footer>
    </body>
</div>
</html>
<script src="../script/map.js"></script>
