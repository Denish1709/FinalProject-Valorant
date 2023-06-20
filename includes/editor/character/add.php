<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

$database = connectToDB();

$agent = $_POST["agent"];
// $front_image = $_POST["front_image"];
// $back_image = $_POST["back_image"];
$real_name = $_POST["real_name"];
$origin = $_POST["origin"];
$gender = $_POST["gender"];
$role = $_POST["role"];
$basic_abilities = $_POST["basic_abilities"];
$signature_abilities = $_POST["signature_abilities"];
$ultimate_abilities = $_POST["ultimate_abilities"];
$describe = $_POST["describe"];

// $front_image = $_FILES['front_image'];
// $image_name = $front_image['name'];

// if ( !empty( $image_name) ) {
//     $target_dir = "uploads/";
//     $target_file = $target_dir . basename( $image_name);
//     // chmod( $target_file, 0755 );
//     move_uploaded_file( $front_image["tmp_name"], $target_file );
// }

$sql = "SELECT * FROM characters";
$query = $database->prepare($sql);
$query->execute([
    
]);
$characters = $query->fetch();

if( isset ($error)){ 
    $_SESSION['error'] = $error;
    header("Location: /add-character");
} else {
    $sql = "INSERT INTO characters (`agent,`real_name`, `origin`, `gender`, `role`, `basic_abilities`, `signature_abilities`, `ultimate_abilities`, ` describe` )
        VALUES(:agent, :real_name, :origin, :gender, :role, :basic_abilities, :signatue_abilities, :ultimate_abilities, :describe)";
    $query = $database->prepare( $sql );
    $query->execute([
        'agent' => $agent,
        'real_name' => $real_name,
        'origin' => $origin,
        'gender' => $gender,
        'role' => $role,
        'basic_abilities' => $basic_abilities,
        'signature_abilities' => $signature_abilities,
        'ultimate_abilities' => $ultimate_abilities,
        'describe' => $describe
    ]);

    $_SESSION["success"] = "New Character has been added.";
    header("Location: /manage-character");
    exit;
}