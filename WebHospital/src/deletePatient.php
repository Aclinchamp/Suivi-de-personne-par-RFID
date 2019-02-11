<?php

    $idPatient = $_POST['patientId'];
    $tag = $_POST['patientTagNumber'];
    // Connexion a la bdd
    $mysqli = new mysqli("localhost", "boitier", "hospital", "BDD_HospitalTracking");

    if ($mysqli->connect_errno) {
        printf("Échec de la connexion : %s\n", $mysqli->connect_error);
        exit();
    }
    //echo('DELETE FROM Patient WHERE id='.$idPatient.'');
    //echo('DELETE FROM Tag WHERE number="'.$tag.'"');
    $mysqli->query('DELETE FROM Patient WHERE id='.$idPatient);
    $mysqli->query('DELETE FROM Tag WHERE number="'.$tag.'"');

    header('Location: patient.php');
    exit();

?>