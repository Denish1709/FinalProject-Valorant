<?php 

$database = connectToDB();

$_SESSION["user"] = $_SESSION['original_user'];

unset( $_SESSION['original_user']);

header("Location: /");
exit;

?>