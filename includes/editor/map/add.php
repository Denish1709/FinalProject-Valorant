<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

$database = connectToDB();

$name = $_POST["name"];
$img = $_POST["img"];

$sql = "SELECT * FROM maps";
$query = $database->prepare($sql);
$query->execute([
    
]);
$user = $query->fetch();

if ( empty( $name ) || empty($img)  ) {
    $error = 'All fields are required';
}

if( isset ($error)){ 
    $_SESSION['error'] = $error;
    header("Location: /add-map");
} else {
    $sql = "INSERT INTO maps (`name`, `img` )
        VALUES(:name, :img)";
    $query = $database->prepare( $sql );
    $query->execute([
        'name' => $name,
        'img' => $img
    ]);

    $_SESSION["success"] = "New Map has been added.";
    header("Location: /manage-map");
    exit;
}