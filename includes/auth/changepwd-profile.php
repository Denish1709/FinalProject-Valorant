<?php

// load the databse
$database = connectToDB();

// get all the $_POST data
$password = $_POST['password'];
$confirm_password = $_POST["confirm_password"];
$id  = $_SESSION['user']['id'];

/*
    do error checking
    - make sure all the fields are not empty
    - make sure password is match
*/
if(empty($password) || empty($confirm_password) || empty($id)){
    $error = "Make sure all the fields are filled.";
} else if ( $password !== $confirm_password ) {

    $error = 'The password is not match.';
}else if ( strlen( $password ) < 8 ) {
    // 3. make sure password is at least 8 chars.
    $error = "Your password must be at least 8 characters";

}

    // if error found, set error message & redirect back to the manage-users-changepwd page with id in the url
    if (isset($error)) {
        $_SESSION['error'] = $error;
        header("Location: /profiles?id=$id");
        exit;
    }

    // if no error found, update the user's password in the database
    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'id' => $_SESSION['user']['id']
    ]);


    // set success message
    $_SESSION["success"] = "Password has been changed.";

    // redirect
    header("Location: /profile");
    exit;
