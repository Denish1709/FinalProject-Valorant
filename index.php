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
  case 'admin/add':
    require "includes/admin/add.php";
    break;
  case 'admin/delete':
    require "includes/admin/delete.php";
    break;
  case 'admin/changepwd':
    require "includes/admin/changepwd.php";
    break;

// admin
  case 'dashboard':
    require "pages/admin/dashboard.php";
    break;
  case 'manage-employees':
    require "pages/admin/manage-employees.php";
    break;
    case 'manage-add':
      require "pages/admin/manage-add.php";
      break;
    case 'manage-changepwd':
      require "pages/admin/manage-changepwd.php";
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