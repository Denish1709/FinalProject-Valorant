<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

// load the database
$database = connectToDB();

// get all the $_POST data
$name = $_POST['name'];
$img = $_POST['img'];
$id = $_POST['id'];

/*
    do error check
    - make sure all the fields are not empty
    - make sure the *new* email entered is not duplicated
*/
if(empty($name) || empty($img) || empty($id)){
    $error = "Make sure all the fields are filled.";
}

// check if email is already taken by calling the database
$sql = "SELECT * FROM maps WHERE id != :id";
$query = $database->prepare($sql);
$query->execute([
    'id' => $id
]);
$maps = $query->fetch();

if ( $maps ){
    $error = "Please enter different email";
}

// if error found, set error message & redirect back to the manage-users-edit page with id in the url
if ( isset( $error ) ) {
    $_SESSION['error'] = $error;
    header("Location: /edit-map?id=$id");
    exit;
}

// if no error found, update the user data based whatever in the $_POST data
$sql = "UPDATE maps SET name = :name, img = :img WHERE id = :id";
$query = $database->prepare($sql);
$query->execute([
    'name' => $name,
    'img' => $img,
    'id' => $id
]);


// set success message
$_SESSION["success"] = "Successfully Edited.";

// redirect
header("Location: /manage-map");
exit;