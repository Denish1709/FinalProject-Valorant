<?php 

$database = connectToDB();

$_SESSION["user"] = $_SESSION['oriinal_user'];

unset( $_SESSION['original_user']);

header("Location: /");
exit;

?>