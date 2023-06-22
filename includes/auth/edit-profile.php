<?php

// load the database
$database = connectToDB();

// get all the $_POST data
$name = $_POST['name'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber'];
$address = $_POST['address'];
$id = $_SESSION['user']['id'];

/*
    do error check
    - make sure all the fields are not empty
    - make sure the *new* email entered is not duplicated
*/
if(empty($name) || empty($email) || empty($phonenumber) || empty($address) || empty($id)){
    $error = "Make sure all the fields are filled.";
}

// check if email is already taken by calling the database
$sql = "SELECT * FROM users WHERE email = :email AND id != :id";
$query = $database->prepare($sql);
$query->execute([
    'email' => $email,
    'id' => $id
]);
$user = $query->fetchAll();

if ( $user ){
    $error = "Please enter different email";
}

// if error found, set error message & redirect back to the manage-users-edit page with id in the url
if ( isset( $error ) ) {
    $_SESSION['error'] = $error;
    // header("Location: /profile?id=$id");
    exit;
}

// if no error found, update the user data based whatever in the $_POST data
$sql = "UPDATE users SET name = :name, email = :email, phonenumber = :phonenumber, address = :address WHERE id = :id";
$query = $database->prepare($sql);
$query->execute([
    'name' => $name,
    'email' => $email,
    'phonenumber' => $phonenumber,
    'address' => $address,
    'id' => $_SESSION['user']['id']
]);


// set success message
$_SESSION["success"] = "Successfully Edited.";

// redirect
header("Location: /profile");
exit;