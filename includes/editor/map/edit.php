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
$map = $_POST['map'];
$id = $_POST['id'];

/*
    do error check
    - make sure all the fields are not empty
    - make sure the *new* email entered is not duplicated
*/
if(empty($map) || empty($id)){
    $error = "Make sure all the fields are filled.";
}

// if error found, set error message & redirect back to the manage-users-edit page with id in the url
if ( isset( $error ) ) {
    $_SESSION['error'] = $error;
    header("Location: /edit-map?id=$id");
    exit;
}

// if no error found, update the user data based whatever in the $_POST data
$sql = "UPDATE maps SET map = :map, modified_by = :modified_by WHERE id = :id";
$query = $database->prepare($sql);
$query->execute([
    'map' => $map,
    'id' => $id,
    'modified_by' => $_SESSION['user']['id']
]);


// set success message
$_SESSION["success"] = "Successfully Edited.";

// redirect
header("Location: /manage-map");
exit;