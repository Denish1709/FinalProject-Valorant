<?php

$database = connectToDB();


$sql = 'SELECT * FROM users';
$query = $database->prepare($sql);
$query->execute();
$users = $query->fetchAll();

$sql = 'SELECT * FROM characters';
$query = $database->prepare($sql);
$query->execute();
$characters = $query->fetchAll();

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

    <section class="second pt-5 pb-5" id="second">
      <div class="container pt-5 pb-5">
      <ul class="navbar-nav ms-auto pe-5">
              <li class="nav-item">
               <?php if(isEditor()) : ?>
                <a href="/manage-character" class="btn btn-danger btn-md">Add Character</a>
                <?php endif; ?>
              </li>
      </ul>
        <h1 class="text-center text-light">AGENTS</h1>
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button
              class="nav-link active"
              id="nav-controller-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-controller"
              type="button"
              role="tab"
              aria-controls="nav-controller"
              aria-selected="true"
            >
              Controller
            </button>
            <button
              class="nav-link"
              id="nav-duelist-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-duelist"
              type="button"
              role="tab"
              aria-controls="nav-duelist"
              aria-selected="false"
            >
              Duelists
            </button>
            <button
              class="nav-link"
              id="nav-initiator-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-initiator"
              type="button"
              role="tab"
              aria-controls="nav-initiator"
              aria-selected="false"
            >
              Initiators
            </button>
            <button
              class="nav-link"
              id="nav-sentinel-tab"
              data-bs-toggle="tab"
              data-bs-target="#nav-sentinel"
              type="button"
              role="tab"
              aria-controls="nav-sentinel"
              aria-selected="false"
            >
              Sentinels
            </button>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div
            class="tab-pane fade show active"
            id="nav-controller"
            role="tabpanel"
            aria-labelledby="nav-controller-tab"
            tabindex="0"
          >
            <div class="row">
              <?php foreach ($characters as $character) { ?>
                <div class="col-lg-4 pt-5 pb-5">
                <?php if($character["role"] == "Controller"){ ?>
                    <div class="agent">
                      <img
                        src="<?= $character['front_image']; ?>"
                        alt=""
                        class="img-fluid"
                      />
                      <div class="text">
                        <div class="content text-center text-white">
                          <p>
                          <?= $character['describe']; ?>
                          </p>

                          <a
                            class="btn btn-danger"
                            href="assets/controller/brim.html"
                            role="button"
                            ><?= $character['name']; ?></a
                          >
                        </div>
                      </div>
                    </div>;
                  <?php } ?>
                </div>
                <?php } ?>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-duelist"
            role="tabpanel"
            aria-labelledby="nav-duelist-tab"
            tabindex="0"
          >
          <div class="row">
            <?php foreach ($characters as $character) { ?>
              <div class="col-lg-4 pt-5 pb-5">
              <?php
                if($character["role"] == "Duelist"){ ?>
                <div class="agent">
                  <img
                    src="<?= $character['front_image']; ?>"
                    alt=""
                    class="img-fluid"
                  />
                  <div class="text">
                    <div class="content text-center text-white">
                      <p>
                      <?= $character['describe']; ?>
                      </p>

                      <a
                        class="btn btn-danger"
                        href="assets/controller/brim.html"
                        role="button"
                        ><?= $character['name']; ?></a
                      >
                    </div>
                  </div>
                </div>;
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-initiator"
            role="tabpanel"
            aria-labelledby="nav-initiator-tab"
            tabindex="0"
          >
          <div class="row">
            <?php foreach ($characters as $character) { ?>
              <div class="col-lg-4 pt-5 pb-5">
              <?php
                if($character["role"] == "Initiator"){ ?>
                <div class="agent">
                  <img
                    src="<?= $character['front_image']; ?>"
                    alt=""
                    class="img-fluid"
                  />
                  <div class="text">
                    <div class="content text-center text-white">
                      <p>
                      <?= $character['describe']; ?>
                      </p>

                      <a
                        class="btn btn-danger"
                        href="assets/controller/brim.html"
                        role="button"
                        ><?= $character['name']; ?></a
                      >
                    </div>
                  </div>
                </div>;
              <?php } 
              ?>
              </div>
              <?php } ?>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="nav-sentinel"
            role="tabpanel"
            aria-labelledby="nav-sentinel-tab"
            tabindex="0"
          >
          <div class="row">
            <?php foreach ($characters as $character) { ?>
              <div class="col-lg-4 pt-5 pb-5">
              <?php
                if($character["role"] == "Sentinel"){ ?>
                <div class="agent">
                  <img
                    src="<?= $character['front_image']; ?>"
                    alt=""
                    class="img-fluid"
                  />
                  <div class="text">
                    <div class="content text-center text-white">
                      <p>
                      <?= $character['describe']; ?>
                      </p>

                      <a
                        class="btn btn-danger"
                        href="assets/controller/brim.html"
                        role="button"
                        ><?= $character['name']; ?></a
                      >
                    </div>
                  </div>
                </div>;
              <?php } 
              ?>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php
require "parts/footer.php";