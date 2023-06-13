<?php

$database = connectToDB();


$sql = 'SELECT * FROM users';
$query = $database->prepare($sql);
$query->execute();
$todo = $query->fetchAll();

require "parts/header.php";
?>
    <section class="top">
      <nav
        class="navbar navbar-expand-lg bg-transparent position-absolute top-0 w-100"
      >
        <div class="container-fluid ps-5">
          <button
            class="navbar-toggler bg-light"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto ps-5">
              <li class="nav-item">
                <a class="nav-link text-white" href="#second"><h5>Agents</h5></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#third"><h5>Guns</h5></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#four"><h5>Gun Editions</h5></a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#five"><h5>Rank Embles</h5></a>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto pe-5">
              <li class="nav-item">
               <?php if(isAdmin()) : ?>
                <a href="/dashboard" class="btn btn-danger btn-md">Dashboard</a>
                <?php endif; ?>
              </li>

              <li class="nav-item">
              <?php if ( isset( $_SESSION["user"] ) ) { ?>
                <a href="/logout" class="btn btn-danger btn-md">Logout</a>
              <?php } else { ?>
                <a href="/login" class="btn btn-danger btn-md">Login</a>
              <?php } ?>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="top1" id="top">
        <div class="overlay"></div>
        <div class="container">
          <div class="box">
            <h3 class="text-danger pt-4 w-50 mx-auto">
              WELCOME TO THE WORLD OF
            </h3>
            <h1 class="text-danger pt-4 w-50 mx-auto">VALORANT!</h1>
            <button
              type="button"
              class="btn btn-danger"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              <h4>Lets Get Started</h4>
            </button>
          </div>
        </div>
      </div>
    </section>
<?php
require "parts/footer.php";