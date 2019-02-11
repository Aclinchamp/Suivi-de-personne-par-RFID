<?php

    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $tag = $_POST['tag'];
    $oldTag = $_POST['oldTag'];

    // Connexion a la bdd
    $mysqli = new mysqli("localhost", "boitier", "hospital", "BDD_HospitalTracking");

    /* Vérification de la connexion */
    if ($mysqli->connect_errno) {
        printf("Échec de la connexion : %s\n", $mysqli->connect_error);
        exit();
    }

    //echo('UPDATE Patient SET firstName="'.$firstName.'",lastName="'.$lastName.'"WHERE id='.$id.'');
    $mysqli->query('UPDATE Patient SET firstName="'.$firstName.'",lastName="'.$lastName.'"WHERE id='.$id.'');

    $requestTagId = $mysqli->query('SELECT id FROM Tag WHERE number="'.$oldTag.'"');
    $tagId = $requestTagId->fetch_array();

    //echo('UPDATE Tag SET number="'.$tag.'" WHERE id='.$tagId.'');

    $mysqli->query('UPDATE Tag SET number="'.$tag.'" WHERE id='.$tagId['id'].'');

    header('Location: patient.php');
    exit();

?>