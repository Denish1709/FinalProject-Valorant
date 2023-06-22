<?php

$database = connectToDB();

if ( isset( $_SESSION["user"] ) ) { 
  $sql = 'SELECT * FROM users WHERE id = :id';
  $query = $database->prepare($sql);
  $query->execute([
      'id' => $_SESSION['user']['id']
    
  ]);
  $users = $query->fetch();
}

$sql = 'SELECT * FROM characters';
$query = $database->prepare($sql);
$query->execute();
$characters = $query->fetchAll();

$sql = 'SELECT * FROM guns';
$query = $database->prepare($sql);
$query->execute();
$guns = $query->fetchAll();

$sql = "SELECT ranks.*, users.name AS user_name FROM ranks JOIN users ON ranks.modified_by = users.id";
$query = $database->prepare($sql);
$query->execute();
$ranks = $query->fetchAll();

$sql = 'SELECT * FROM editions';
$query = $database->prepare($sql);
$query->execute();
$editions = $query->fetchAll();

$sql = 'SELECT * FROM maps';
$query = $database->prepare($sql);
$query->execute();
$maps = $query->fetchAll();

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
          <ul class="navbar-nav">
          <li class="nav-item text-danger">
                <?php if ( isset( $_SESSION["user"] ) ) { ?>
                <a href="/profile" class="btn btn-danger btn-md">
                  <i class="bi bi-person-circle pe-2"></i> <?= $users['name'] ?>
                </a>
                <?php } ?>
              </li>
          </ul>
          <div class="collapse navbar-collapse" id="navbarNav">
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
            <!-- <button
              type="button"
              class="btn btn-danger"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              <h4>Lets Get Started</h4>
            </button> -->
          </div>
        </div>
      </div>
    </section>

    <section class="second pt-5 pb-5" id="second">
      <div class="container pt-5 pb-5">
      <ul class="navbar-nav ms-auto pe-5">
              <li class="nav-item">
               <?php if(isEditor()) : ?>
                <a href="/manage-character" class="btn btn-danger btn-md">Manage Character</a>
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
                <?php if($character["role"] == "Controller"){ ?>
                <div class="col-lg-4 pt-5 pb-5">
                    <div class="agent">
                      <img
                        src="<?= $character['front_image']; ?>"
                        alt=""
                        class="img-fluid"
                      />
                      <div class="text">
                        <div class="content text-center text-white">
                          <p>
                          <?= $character['story']; ?>
                          </p>

                          <a
                            class="btn btn-danger"
                            href="/details?id=<?= $character['id']; ?>"
                            role="button"
                            ><?= $character['agent'] ?></a
                          >
                        </div>
                      </div>
                    </div>
                </div>
                  <?php } ?>
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
              <?php
                if($character["role"] == "Duelist"){ ?>
              <div class="col-lg-4 pt-5 pb-5">
                <div class="agent">
                  <img
                    src=<?= $character['front_image']; ?>
                    alt=""
                    class="img-fluid"
                  />
                  <div class="text">
                    <div class="content text-center text-white">
                      <p>
                      <?= $character['story']; ?>
                      </p>

                      <a
                        class="btn btn-danger"
                        href="/details?id=<?= $character['id']; ?>"
                        role="button"
                        ><?= $character['agent']; ?></a
                      >
                    </div>
                  </div>
                </div>
              </div>
                <?php } ?>
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
              <?php
                if($character["role"] == "Initiator"){ ?>
              <div class="col-lg-4 pt-5 pb-5">
                <div class="agent">
                  <img
                    src="<?= $character['front_image']; ?>"
                    alt=""
                    class="img-fluid"
                  />
                  <div class="text">
                    <div class="content text-center text-white">
                      <p>
                      <?= $character['story']; ?>
                      </p>

                      <a
                        class="btn btn-danger"
                        href="/details?id=<?= $character['id']; ?>"
                        role="button"
                        ><?= $character['agent']; ?></a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <?php } 
              ?>
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
              <?php
                if($character["role"] == "Sentinel"){ ?>
              <div class="col-lg-4 pt-5 pb-5">
                <div class="agent">
                  <img
                    src="<?= $character['front_image']; ?>"
                    alt=""
                    class="img-fluid"
                  />
                  <div class="text">
                    <div class="content text-center text-white">
                      <p>
                      <?= $character['story']; ?>
                      </p>

                      <a
                        class="btn btn-danger"
                        href="/details?id=<?= $character['id']; ?>"
                        role="button"
                        ><?= $character['agent']; ?></a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <?php } 
              ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="third pt-5 pb-5" id="third">
      <div class="container">
        <h1 class="text-center text-danger pt-3 pb-5">Valorant Guns</h1>
        <!-- <div class="row">
          <div class="col-lg-3 text-center text-danger">
            <h3>SIDEARMS</h3>
          </div>
          <div class="col-lg-3 text-center text-danger">
            <h3>SMGS</h3>
          </div>
          <div class="col-lg-3 text-center text-danger">
            <h3>RIFLES</h3>
          </div>
          <div class="col-lg-3 text-center text-danger">
            <h3>SNIPER RIFLES</h3>
          </div>
        </div> -->
        
        <div class="row">
          <?php foreach ($guns as $gun) { ?>
            <div class="col-3 p-3">
              <div class="card-body p-3">
                <img
                  src="<?= $gun['img']; ?>"
                  class=""
                  alt=""
                  style="height:110px; width:270px;"
                />
                
                <p class="card-text text-danger bg-dark text-center"><?= $gun['name']; ?></p>
                </div>
            </div>
          <?php }?>
        </div>
        <div class="text-center">
          <a href="https://valorant.fandom.com/wiki/Weapon_Skins"
            ><button class="btn bg-danger mt-5">SKINS</button></a
          >
        </div>
      </div>
    </section>
    <section class="five pt-5 pb-5" id="five">
      <div class="container">
        <h1 class="text-center text-danger pt-5 pb-5">Valorant Ranks</h1>        
          <div class="row">
            <div class="col-3">
              <h4 class="iron pt-5">IRON</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "iron"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3">
              <h4 class="bronze pt-5">Bronze</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "bronze"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3">
              <h4 class="silver pt-5">Silver</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "silver"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3">
              <h4 class="gold pt-5">Gold</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "gold"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3"> 
              <h4 class="platinum pt-5">Platinum</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "platinum"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3">
              <h4 class="diamond pt-5">Diamond</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "diamond"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3">
            <h4 class="ascendant pt-5">Ascendant</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "ascendant"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3">
              <h4 class="immortal  pt-5">Immortal</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "immortal"){ ?>
              <div class="col-3">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-3">
              <h4 class="radiant pt-5">Radiant</h4>
            </div>
            <?php foreach ($ranks as $rank) { ?>
              <?php
                if($rank["name"] == "radiant"){ ?>
              <div class="col-9">
                <div class="card-body text-center p-3">
                  <img
                    src="<?= $rank['img']; ?>"
                    class="card-img-top"
                    alt=""
                    style="height:100px; width:100px;"
                  />
                  
                </div>
              </div>
              <?php } 
              ?>
            <?php } ?>
          </div>
          <?php if(isEditor()) : ?>
            <div class="text-danger text-center">
              <h5 class="pt-5">Modified By : <?= $rank['user_name']; ?></h5>
            </div>
          <?php endif; ?>
      </div>
    </section>
    <section class="third bg-dark pt-5 pb-5" id="six">
      <div class="container">
       <h1 class="text-center text-danger pt-5">Maps</h1> 
       <ul class="navbar-nav ms-auto pe-5">
              <li class="nav-item">
               <?php if(isEditor()) : ?>
                <a href="/manage-map" class="btn btn-danger btn-md">Manage Maps</a>
                <?php endif; ?>
              </li>
      </ul>
        <div class="d-flex justify-content-center align-items-center text-danger pt-5 pb-5">
          <div class="row">
                <?php foreach ($maps as $map) { ?>
                  <div class="col-4 pt-5 pb-5">
                      <div class="agent">
                        <img
                          src="<?= $map['img']; ?>"
                          alt=""
                          class="img-fluid"
                        />
                        <h3 class="text-danger text-center"><?= $map['map']; ?></h3>
                      </div>
                  </div>
                <?php } ?>
          </div>
          </div>
        </div>
    </section>
    </section>
    <section class="four bg-dark pt-5 pb-5" id="four">
      <h1 class="text-center text-danger">Gun Editions</h1>
      <div
        class="container d-flex justify-content-center align-items-center text-danger pt-5 pb-5"
      >
        <div class="table-responsive">
          <table class="table text-danger">
            <tr>
              <th class="ps-5 pe-5" rowspan="2">
                <h4 class="text-center pt-5">Edition</h4>
              </th>
              <th class="ps-5 pe-5" colspan="2">
                <h4 class="text-center">Price</h4>
                <div class="text-center text-danger bg-danger">
                <img
                    src="../assets/img/vpoint.png"
                    alt=""
                    class="img-fluid"
                    style="height: 50px; width:100px;"
                  />
                </div>
              </th>
            </tr>
            <tr>
              <th class="ps-5 pe-5">
                <h4 class="text-center">Guns</h4>
              </th>
              <th class="ps-5 pe-5">
                <h4 class="text-center">Melee</h4>
              </th>
            </tr>
            <?php foreach ($editions as $edition) { ?>
            <tr>
              <th class="ps-5 pe-5">
                <p>
                <?php if ($edition['img']) : ?>
                  <div class="text-center text-danger ">
                  <div>
                  <img
                    src="<?= $edition['img']; ?>"
                    alt=""
                    class="img-fluid "
                    style="height:30px; width:30px;"
                  />
                  </div>
                  <?php endif; ?>
                  <?= $edition['edition']; ?>
                  </div>
                </p>
              </th>
              <td class="text-center ps-5 pe-5">
                <p class="pt-4">
                  <?= $edition['gun']; ?>
                </p>
              </td>
              <td class="text-center ps-5 pe-5">
                <p class="pt-4">
                  <?= $edition['melee']; ?>
                </p>
              </td>
            </tr>
            <?php }?>
          </table>
          
        </div>
      </div>
    </section>
<?php
require "parts/footer.php";
?>