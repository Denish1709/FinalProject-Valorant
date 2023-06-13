<?php

// check if the current user is an admin or not
if ( !isAdmin() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

// load the database
$database = connectToDB();

// get all the $_POST data
$name = $_POST['name'];
$email = $_POST['email'];
$roles = $_POST['roles'];
$id = $_POST['id'];

/*
    do error check
    - make sure all the fields are not empty
    - make sure the *new* email entered is not duplicated
*/
if(empty($name) || empty($email) || empty($roles) || empty($id)){
    $error = "Make sure all the fields are filled.";
}

// check if email is already taken by calling the database
$sql = "SELECT * FROM users WHERE email = :email AND id != :id";
$query = $database->prepare($sql);
$query->execute([
    'email' => $email,
    'id' => $id
]);
$user = $query->fetch();

if ( $user ){
    $error = "Please enter different email";
}

// if error found, set error message & redirect back to the manage-users-edit page with id in the url
if ( isset( $error ) ) {
    $_SESSION['error'] = $error;
    header("Location: /manage-edit?id=$id");
    exit;
}

// if no error found, update the user data based whatever in the $_POST data
$sql = "UPDATE users SET name = :name, email = :email, roles = :roles WHERE id = :id";
$query = $database->prepare($sql);
$query->execute([
    'name' => $name,
    'email' => $email,
    'roles' => $roles,
    'id' => $id
]);


// set success message
$_SESSION["success"] = "Successfully Edited.";

// redirect
header("Location: /manage-employees");
exit;