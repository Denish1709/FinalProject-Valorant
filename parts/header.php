<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Website Of Intererst</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body class="bg-dark">
    <?php 
    if( isset( $_SESSION['original_user'] ) && isset($_SESSION['user']) ) : ?>
    <div class="container">
      <div class="alert  text-center text-danger">
        <h3>
          You are acting as <?= $_SESSION['user']['name']; ?>
        </h3>
        <form method="POST" action="admin_stop_acting" class="pt-3">
          <button type="submit" class="btn btn-info btn-md text-white">
            <i class="bi bi-stop-circle"></i> Stop acting as <?= $_SESSION['user']['name']; ?>
          </button>
        </form>
      </div>
    </div>
    <?php endif; 