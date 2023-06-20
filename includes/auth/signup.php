<?php

$database = connectToDB();

$sql = 'SELECT * FROM users';
$query = $database->prepare($sql);
$query->execute();
$todo = $query->fetchAll();

require "parts/header.php";

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// 1. make sure all fields are not empty
if ( empty( $name ) || empty ( $email ) || empty ( $password ) || empty ( $confirm_password )) {
    $error =  'All fields are required';
} else if ( $password !== $confirm_password ){
    // 2. make sure password is match
    $error = 'The password is not match';
} else if ( strlen( $password ) < 8 ) {
    // 3. make sure password is atleast 8 chars
    $error =  "Your password must be at least 8 character";
} else {
    // recipe
    $sql = "INSERT INTO users ( `name`, `email`, `password`)
        VALUES (:name, :email, :password)";
    // prepare
    $query = $database->prepare( $sql );
    // execute
    $query->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash( $password, PASSWORD_DEFAULT ), //convert user's password to random string
    ]);

    // redirect user back to /
    header("Location: /login");
    exit;
}

// do error checking
if ( isset( $error ) ) {
    // store the error message in session
    $_SESSION['error'] = $error;
    // redirect the user back to /login
    header("Location: /signup");
    exit;
}
?>