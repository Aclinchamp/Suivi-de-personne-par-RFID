<?php
session_start();
?>
<!DOCTYPE html>
<html lang="FR">
    <head>
        <meta charset="UTF-8">
        <title>Hospital Tracking</title>
        <link href="../assert/css/bootstrap.css" rel="stylesheet">
        <link href="../assert/css/index.css" rel="stylesheet">  
        
    </head>
    <body>
        <header>
            <?php include("navBar.php"); ?>
        </header>
        <div class="container-fluid" id="page-auth">
            
            <div class="row">
                <div class="col-sm">
                    <h2>Connection</h2>

                    <?php

                        $login = $_POST['loginName'];
                        $password = md5($_POST['password']);
                        $flag_auth;

                        try
                        {
                            // Connexion a la bdd
                            $mysqli = new mysqli("localhost", "boitier", "hospital", "BDD_HospitalTracking");

                            /* Vérification de la connexion */
                            if ($mysqli->connect_errno) {
                                printf("Échec de la connexion : %s\n", $mysqli->connect_error);
                                exit();
                            }

                            $request = "SELECT * FROM Users WHERE Nom ='$login'";
                            //echo("SELECT * FROM Users WHERE Nom ='$login'");
                            $result = $mysqli->query($request);

                            while($data = $result->fetch_array()){
                                
                                if($data['Password'] == $password){
                                    

                                    $_SESSION['lastName'] = $data['Nom'];
                                    $_SESSION['firstName'] = $data['Prenom'];
                                    $_SESSION['age'] = $data['Age'];
                                    $_SESSION['job'] = $data['Poste'];
                                    $_SESSION['group'] = $data['Groupe'];
                                    $_SESSION['isConnected'] = 1;
                                    
                                    $result->close();
                                    $mysqli->close();
                                    //header('Location: home.php');
                                    header('Location :  home.php', true, 301);
                                    exit();
                                }
                            }
                            
                            $result->close();
                            $mysqli->close();

                        }catch(Exception $e){
                                die('Erreur : '.$e->getMessage());
                        }
                    ?>
                    <p>Login information were not correct...</p>
                    <a class="btn btn-danger" href="../index.php">go back</a>
                </div>
            </div> 
            
        </div>
        <footer class="footer">
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>
