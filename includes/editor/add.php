<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

$database = connectToDB();

$name = $_POST["name"];
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

$sql = "SELECT * FROM characters";
$query = $database->prepare($sql);
$query->execute([
    // 'email'=>$email
    // 'name' => $name,
    // 'real_name' => $real_name,
    // 'origin'=> $origin,
    // 'added_on' => $added_on,
    // 'gender' => $gender,
    // 'role' => $role,
    // 'basic_abilities' => $basic_abilities,
    // 'signature_abilities' => $signature_abilities,
    // 'ultimate_abilities' => $ultimate_abilities,
    // 'describe' => $describe
]);
$characters = $query->fetchAll();

if ( empty( $name ) || empty($real_name) || empty($origin) || empty($gender) || empty($role) || empty($basic_abilities) || empty($signature_abilities) || empty($ultimate_abilities) || empty($describe) ) {
    $error = 'All fields are required';
}

if( isset ($error)){ 
    $_SESSION['error'] = $error;
    header("Location: /add-character");
} else {
    $sql = "INSERT INTO characters (`name`, `real_name`, `origin`, `gender` ,`role`, `basic_abilities`, `signature_abilities`, `ultimate_abilities`, `describe` )
        VALUES(:name, :real_name, :origin, :gender, :role, :basic_abilities, :signature_abilities, :ultimate_abilities, :describe)";
    $query = $database->prepare( $sql );
    $query->execute([
        'name' => $name,
        'real_name' => $real_name,
        'origin' => $origin,
        'gender' => $gender,
        'role' => $role,
        'basic_abilities' => $basic_abilities,
        'signature_abilities' => $signature_abilities,
        'ultimate_abilities' => $ultimate_abilities,
        // 'front_image' => $front_image,
        // 'back_image' => $back_image,
        'describe' => $describe
    ]);

    $_SESSION["success"] = "New Employee has been added.";
    header("Location: /manage-character");
    exit;
}