<?php 

if ( !isAdmin() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

$database = connectToDB();

$id = $_POST['id'];

$sql = "SELECT * FROM users WHERE id = :id";
$query = $database->prepare($sql);
$query->execute([
    'id'=>$id
]);
$act_as_user = $query->fetch();

$_SESSION["original_user"] = $_SESSION["user"];

$_SESSION["user"] = $act_as_user;

header("Location: /");
exit;

?>