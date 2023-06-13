<?php 
session_start();

require "includes/functions.php";

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$path = trim( $path, '/');

switch($path) {
  case 'auth/login':
    require "includes/auth/login.php";
    break;
  case 'auth/signup':
    require "includes/auth/signup.php";
    break;

// admin
  case 'dashboard':
    require "pages/admin/dashboard.php";
    break;

// editor

// user
  case 'signup':
    require "pages/signup.php";
    break;
  case 'login':
    require "pages/login.php";
    break;
  case 'logout':
    require "pages/logout.php";
    break;
  default:
    require "pages/home.php";
    break;
}
?>