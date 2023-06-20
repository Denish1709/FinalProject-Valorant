<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

// make sure the id parameter is available in the url
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
    $character = $query->fetch();

    // make sure user data is found in database
    if ( !$character ) {
        // if user don't exists, then we redirect back to manage-users
        header("Location: /manage-character");
        exit;
    }

} else {
    // if $_GET['id'] is not available, then redirect the user back to manage-users
    header("Location: /manage-character");
    exit;
}

require "parts/header.php";
?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center  mb-2">
            <h1 class="h1 text-danger">Edit Character</h1>
        </div>
        <div class="card bg-dark mb-2 p-4">
            <form method="POST" action="/editor/edit">
                <div class="mb-3">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="agent" class="form-label text-danger"><h4>Agent</h4></label>
                            <input type="text" class="form-control text-danger" id="agent" name="agent" value="<?= $character['agent']; ?>" />
                        </div>
                        <div class="col">
                            <label for="real_name" class="form-label text-danger"><h4>Real Name</h4></label>
                            <input type="text" class="form-control text-danger" id="real_name" name="real_name" value="<?= $character['real_name']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="origin" class="form-label text-danger"><h4>Origin</h4></label>
                            <input type="text" class="form-control text-danger" id="origin" name="origin" value="<?= $character['origin']; ?>"/>
                        </div>
                        <div class="col">
                            <label for="added_on" class="form-label text-danger"><h4>Added Date</h4></label>
                            <input type="date" class="form-control text-danger" id="added_on" name="added_on" value="<?= $character['added_on']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="gender" class="text-danger"><h4>Gender</h4></label>
                            <div class="col-sm-10  mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input text-danger" type="radio" name="gender" id="maler" value="<?= $character['gender']; ?>" required >
                                    <label class="form-check-label text-danger" for="maler"><h4>Male</h4></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input text-danger" type="radio" name="gender" id="femaler" value="<?= $character['gender']; ?>" required>
                                    <label class="form-check-label text-danger" for="femaler"><h4>Female</h4></label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="role" class="form-label text-danger"><h4>Role</h4></label>
                            <select class="form-control text-danger" id="role" name="role" value="<?= $character['role']; ?>">
                                <option value="Controller" <?=  $character['role'] === 'Controller' ? 'selected' : ''; ?>>Controller</option>
                                <option value="Duelist"<?=  $character['role'] === 'Duelist' ? 'selected' : ''; ?>>Duelist</option>
                                <option value="Initiator"<?=  $character['role'] === 'Initiator' ? 'selected' : ''; ?>>Initiator</option>
                                <option value="Sentinel"<?=  $character['role'] === 'Sentinel' ? 'selected' : ''; ?>>Sentinel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-4">
                            <label for="basic_abilities" class="form-label text-danger"><h5>Basic Abilities</h5></label>
                            <input type="text" class="form-control text-danger" id="basic_abilities" name="basic_abilities" value="<?= $character['basic_abilities']; ?>"/>
                        </div>
                        <div class="col-4">
                            <label for="signature_abilities" class="form-label text-danger"><h5>Signature Abilities</h5></label>
                            <input type="text" class="form-control text-danger" id="signature_abilities" name="signature_abilities" value="<?= $character['signature_abilities']; ?>" />
                        </div>
                        <div class="col-4">
                            <label for="ultimate_abilities" class="form-label text-danger"><h5>Ultimate Abilities</h5></label>
                            <input type="text" class="form-control text-danger" id="ultimate_abilities" name="ultimate_abilities" value="<?= $character['ultimate_abilities']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="describe text-danger"><h4>Story</h4></label>
                            <textarea type="text" class="form-control text-danger" id="describe" name="describe" style="height: 100px"><?= $character['describe']; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <input type="hidden" name="id" value="<?= $character['id']; ?>" />
                    <button type="submit" class="btn btn-danger"><h5>Update</h5></button>
                </div>
            </form>
        </div>
        <div class="text-center">
            <a href="/manage-character" class="btn btn-danger btn-md"
            ><i class="bi bi-arrow-left"></i> Back to Character Management</a
            >
        </div>
    </div>

<?php
require "parts/footer.php";