<?php

session_start();

// remove user session
unset( $_SESSION['user'] );

unset( $_SESSION['original_user']);


// redirect the user back to /
header("Location: /");
exit;