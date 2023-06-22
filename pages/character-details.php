<?php

// check if the current user is an editor or not

if ( isset( $_GET['id'] ) ) {
  // load database
  $database = connectToDB();

  // load the user data based on the id
  $sql = "SELECT * FROM characters WHERE id = :id";
  $query = $database->prepare( $sql );
  $query->execute([
      'id' => $_GET['id']
  ]);

  // fetch
  $characters = $query->fetchAll();

  // make sure user data is found in database
  if ( !$characters ) {
      // if user don't exists, then we redirect back to manage-users
      header("Location: /");
      exit;
  }

} else {
  // if $_GET['id'] is not available, then redirect the user back to manage-users
  header("Location: /");
  exit;
}

require "parts/header.php";

?>

<section class="back">
      <div class="container">
        <form>
          <input
            type="button"
            value=" < Back We Go"
            onclick="history.back()"
            class="bg-dark text-danger"
          />
        </form>
        <div class="row">
        <?php foreach ($characters as $character) { ?>
          <div class="col-lg-6 pt-5">
            <img
              src=<?= $character['back_image']; ?>
              alt=""
              class="img-fluid"
            />
          </div>
          <div class="col-lg-6 justify-content-center align-items-center pt-5">
            <h1 class="text-white text-center pb-5"><?= $character['agent']; ?></h1>
            <div
              class="accordion accordion-flush w-100"
              id="accordionFlushExample"
            >
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed text-danger bg-dark"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne"
                    aria-expanded="false"
                    aria-controls="flush-collapseOne"
                  >
                    Biography
                  </button>
                </h2>
                <div
                  id="flush-collapseOne"
                  class="accordion-collapse collapse text-light bg-dark"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body">
                    <table>
                      <tr>
                        <th class="text-end">Real Name :</th>
                        <td class="ps-3"><?= $character['real_name']; ?></td>
                      </tr>
                      <!-- <tr>
                        <th class="text-end">Aliases :</th>
                        <td class="ps-3">Breachy</td>
                      </tr> -->
                      <tr>
                        <th class="text-end">Origin :</th>
                        <td class="ps-3"><?= $character['origin']; ?></td>
                      </tr>
                      <!-- <tr>
                        <th class="text-end">Race :</th>
                        <td class="ps-3">Human</td>
                      </tr> -->
                      <tr>
                        <th class="text-end">Gender :</th>
                        <td class="ps-3"><?= $character['gender']; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed text-danger bg-dark"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo"
                    aria-expanded="false"
                    aria-controls="flush-collapseTwo"
                  >
                    Game Details
                  </button>
                </h2>
                <div
                  id="flush-collapseTwo"
                  class="accordion-collapse collapse text-light bg-dark"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body">
                    <table>
                      <tr>
                        <th class="text-end">Role :</th>
                        <td class="ps-3"><?= $character['role']; ?></td>
                      </tr>
                      <tr>
                        <th class="text-end">Basic Ability :</th>
                        <td>
                          <ol>
                            <li class="ps-3"><?= $character['basic_abilities']; ?></li>
                            <!-- <li class="ps-3">Flashpoint</li> -->
                          </ol>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-end">Signature Ability :</th>
                        <td class="ps-3"><?= $character['signature_abilities']; ?></td>
                      </tr>
                      <tr>
                        <th class="text-end">Ultimate Ability :</th>
                        <td class="ps-3"><?= $character['ultimate_abilities']; ?></td>
                      </tr>
                      <!-- <tr>
                        <th class="text-end">Ultimate Points :</th>
                        <td class="ps-3">
                          <i class="bi bi-diamond"></i>
                          <i class="bi bi-diamond"></i>
                          <i class="bi bi-diamond"></i>
                          <i class="bi bi-diamond"></i>
                          <i class="bi bi-diamond"></i>
                          <i class="bi bi-diamond"></i>
                          <i class="bi bi-diamond"></i>
                          <i class="bi bi-diamond"></i>
                          8
                        </td>
                      </tr> -->
                    </table>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed text-danger bg-dark"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree"
                    aria-expanded="false"
                    aria-controls="flush-collapseThree"
                  >
                    Out Of Universe
                  </button>
                </h2>
                <div
                  id="flush-collapseThree"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionFlushExample"
                >
                  <div class="accordion-body text-light bg-dark">
                    <table>
                      <!-- <tr>
                        <th class="text-end">Codenames :</th>
                        <td class="ps-3">Breach</td>
                      </tr>
                      <tr>
                        <th class="text-end">Appearances :</th>
                        <td class="ps-3">Valorant</td>
                      </tr> -->
                      <tr>
                        <th class="text-end">Added :</th>
                        <td class="ps-3"><?= $character['added_on']; ?></td>
                      </tr>
                      <!-- <tr>
                        <th class="text-end">Voice Actor :</th>
                        <td class="ps-3">David Menkin</td>
                      </tr> -->
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row pt-5 text-light">
              <div class="col-lg-6">
                <h1>Story :</h1>
              </div>
              <div class="col-lg-6 w-100">
                <h5>
                <?= $character['story']; ?>
                </h5>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>

<?php

require "parts/footer.php";

?>