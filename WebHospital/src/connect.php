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
                        $password = $_POST['password'];
                        $flag_auth;

                        try
                        {
                            // Connexion a la bdd
                            $bdd = new PDO('mysql:host=localhost;dbname=BDD_HospitalTracking;charset=utf8', 'boitier', 'hospital');

                            $request = "SELECT * FROM Users WHERE Nom ='$login'";
                            //echo("SELECT * FROM Users WHERE Nom ='$login'");
                            $answer = $bdd->query($request);
                            while($data = $answer->fetch()){

                                if($data['Password'] == $password){

                                    session_start();

                                    $_SESSION['nom'] = $data['Nom'];
                                    $_SESSION['prenom'] = $data['Prenom'];
                                    $_SESSION['age'] = $data['Age'];
                                    $_SESSION['poste'] = $data['Poste'];
                                    $_SESSION['groupe'] = $data['Groupe'];
                                    $_SESSION['isConnected'] = 1;
                                    echo("donne");

                                    $answer->closeCursor();
                                    header('Location: home.php');
                                    exit();
                                }
                            }

                            $answer->closeCursor();

                        }catch(Exception $e){
                                die('Erreur : '.$e->getMessage());
                        }
                    ?>
                    <p>Informations were not correct</p>
                    <a class="btn btn-danger" href="../index.php">go back</a>
                </div>
            </div>

        </div>
        <footer class="footer">
            <?php include("footer.php"); ?>
        </footer>
    </body>
</html>
