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
  case 'auth/edit-profile':
    require "includes/auth/edit-profile.php";
    break;
  case 'auth/changepwd-profile':
    require "includes/auth/changepwd-profile.php";
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
  case 'admin/edit':
    require "includes/admin/edit.php";
    break;
  case 'admin/act_as_user':
    require "includes/admin/act_as_user.php";
    break;
  case 'admin/stop_acting':
    require "includes/admin/stop_acting.php";
    break;

  // editor
    // character
  case 'editor/add':
    require "includes/editor/character/add.php";
    break;
  case 'editor/edit':
    require "includes/editor/character/edit.php";
    break;
  case 'editor/delete':
    require "includes/editor/character/delete.php";
    break;

    // map
    case 'editor/map/edit':
      require "includes/editor/map/edit.php";
      break;
    case 'editor/map/add':
      require "includes/editor/map/add.php";
      break;
    case 'editor/map/delete':
      require "includes/editor/map/delete.php";
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
    case 'manage-edit':
      require "pages/admin/manage-edit.php";
      break;

// editor
  //character 
case 'manage-character':
  require "pages/editor/characters/manage-character.php";
  break;
case 'add-character':
  require "pages/editor/characters/add-character.php";
  break;
case 'edit-character':
  require "pages/editor/characters/edit-character.php";
  break;

  // map
  case 'manage-map':
    require "pages/editor/maps/manage-map.php";
    break;
  case 'edit-map':
    require "pages/editor/maps/edit-map.php";
    break;
  case 'add-map':
    require "pages/editor/maps/add-map.php";
    break;

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
  case 'profile':
    require "pages/profile.php";
    break;
  case 'details':
    require "pages/character-details.php";
    break;

  default:
    require "pages/home.php";
    break;
}
?>