<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

$database = connectToDB();

$map = $_POST["map"];

$sql = "SELECT * FROM maps";
$query = $database->prepare($sql);
$query->execute([
    
]);
$maps = $query->fetch();

if ( empty( $map )  ) {
    $error = 'All fields are required';
}

if( isset ($error)){ 
    $_SESSION['error'] = $error;
    header("Location: /add-map");
} else {
    $sql = "INSERT INTO maps (`map`)
        VALUES(:map)";
    $query = $database->prepare( $sql );
    $query->execute([
        'map' => $map
    ]);

    $_SESSION["success"] = "New Map has been added.";
    header("Location: /manage-map");
    exit;
}