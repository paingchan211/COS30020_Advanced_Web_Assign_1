<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Define upload directories
    $uploadDir = 'img/plants/';
    $descriptionDir = 'descriptions/';

    // Collect form data
    $species = $_POST['species'];
    $scientificName = $species; // Set scientific name to be the same as species
    $commonName = $_POST['common_name'];
    $family = $_POST['family'];
    $genus = $_POST['genus'];

    // File uploads
    $photoFile = $_FILES['herbarium_photo'];

    $photoFileName = basename($photoFile['name']);

    // Move uploaded files
    move_uploaded_file($photoFile['tmp_name'], $uploadDir . $photoFileName);

    // Generate a unique ID for the contribution
    $contributions = file('data/herbarium.txt', FILE_IGNORE_NEW_LINES);
    $lastId = 0;
    if (!empty($contributions)) {
        $lastLine = end($contributions);
        $lastId = intval(explode(',', $lastLine)[0]);
    }
    $newId = $lastId + 1;

    // Append new contribution to the file
    $newContribution = "$newId,$scientificName,$commonName,$family,$genus,$species,$photoFileName\n";
    file_put_contents('data/herbarium.txt', $newContribution, FILE_APPEND);

    // Redirect or provide feedback
    header('Location: contribute.php');
    exit;
}
