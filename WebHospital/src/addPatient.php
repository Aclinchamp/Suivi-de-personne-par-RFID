<?php

    $firstName = $_POST['patientFirstName'];
    $lastName = $_POST['patientLastName'];
    $tag = $_POST['patientTag'];
    $idTag = 0;
    $idBorne = 4;
    $idPatient = 0;

    
    // Connexion a la bdd
    $mysqli = new mysqli("localhost", "boitier", "hospital", "BDD_HospitalTracking");

    if ($mysqli->connect_errno) {
        printf("Échec de la connexion : %s\n", $mysqli->connect_error);
        exit();
    }
    
    $mysqli->query('INSERT INTO Tag(number) VALUES ("'.$tag.'")');
    $requestTagId = $mysqli->query('SELECT id FROM Tag WHERE number="'.$tag.'"');
    $tag = $requestTagId->fetch_array();
    
    $mysqli->query('INSERT INTO Patient(firstName, lastName, idTag) VALUES ("'.$firstName.'", "'.$lastName.'", '.$tag['id'].')');
    
    $requestPatient = $mysqli->query('SELECT id FROM Patient WHERE firstName="'.$firstName.'" AND lastName="'.$lastName.'"');
    $idPatient = $requestPatient->fetch_array();
    
    $mysqli->query('INSERT INTO Position (idPatient, idBorne) VALUES ('.$idPatient['id'].', '.$idBorne.')');
    
    header('Location: patient.php');
    exit();
?>