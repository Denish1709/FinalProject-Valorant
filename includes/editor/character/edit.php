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
$agent = $_POST["agent"];
$real_name = $_POST["real_name"];
$origin = $_POST["origin"];
$added_on = $_POST["added_on"];
$gender = $_POST["gender"];
$role = $_POST["role"];
$basic_abilities = $_POST["basic_abilities"];
$signature_abilities = $_POST["signature_abilities"];
$ultimate_abilities = $_POST["ultimate_abilities"];
// $front_image = $_POST["front_image"];
// $back_image = $_POST["back_image"];
$describe = $_POST["describe"];
$id = $_POST["id"];

/*
    do error check
    - make sure all the fields are not empty
    - make sure the *new* email entered is not duplicated
*/
if ( empty( $name ) || empty($real_name) || empty($origin) || empty($gender) || empty($role) || empty($basic_abilities) || empty($signature_abilities) || empty($ultimate_abilities) || empty($describe) || empty($id) ) {
    $error = 'Make sure all fills are filled';
}


// if error found, set error message & redirect back to the manage-users-edit page with id in the url
if ( isset( $error ) ) {
    $_SESSION['error'] = $error;
    header("Location: /edit-character?id=$id");
    exit;
}

// if no error found, update the user data based whatever in the $_POST data
$sql = "UPDATE characters SET agent = :agent, real_name = :real_name, origin = :origin, gender = :gender, role = :role, basic_abilities = :basic_abilities, signature_abilities = :signature_abilities, ultimate_abilities = :ultimate_abilities, describe = :describe, modified_by = :modified_by WHERE id = :id";
$query = $database->prepare($sql);
$query->execute([
    'agent' => $agent,
    'real_name' => $real_name,
    'origin' => $origin,
    'gender' => $gender,
    'role' => $role,
    'basic_abilities' => $basic_abilities,
    'signature_abilities' => $signature_abilities,
    'ultimate_abilities' => $ultimate_abilities,
    // 'front_image' => $front_image,
    // 'back_image' => $back_image,
    'describe' => $describe,
    'id' => $id,
    'modified_by' => $_SESSION['user']['id']
]);


// set success message
$_SESSION["success"] = "Successfully Edited.";

// redirect
header("Location: /manage-character");
exit;