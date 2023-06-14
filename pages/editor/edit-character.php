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
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="h1">Edit Character</h1>
        </div>
        <div class="card mb-2 p-4">
            <form method="POST" action="/editor/edit">
                <div class="mb-3">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" />
                        </div>
                        <div class="col">
                            <label for="real_name" class="form-label">Real Name</label>
                            <input type="text" class="form-control" id="real_name" name="real_name" value="<?= $user['name']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="origin" class="form-label">Origin</label>
                            <input type="text" class="form-control" id="origin" name="origin" value="<?= $user['name']; ?>"/>
                        </div>
                        <div class="col">
                            <label for="added_on" class="form-label">Added Date</label>
                            <input type="date" class="form-control" id="added_on" name="added_on" value="<?= $user['name']; ?>"/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="email" class="">Gender</label>
                            <div class="col-sm-10  mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="maler" value="<?= $user['name']; ?>" required >
                                    <label class="form-check-label" for="maler">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="femaler" value="<?= $user['name']; ?>" required>
                                    <label class="form-check-label" for="femaler">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" value="<?= $user['name']; ?>">
                                <option value="">Select an option</option>
                                <option value="Controller">Controller</option>
                                <option value="Duelist">Duelist</option>
                                <option value="Initiator">Initiator</option>
                                <option value="Sentinel">Sentinel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-4">
                            <label for="basic_abilities" class="form-label">Basic Abilities</label>
                            <input type="text" class="form-control" id="basic_abilities" name="basic_abilities" value="<?= $user['name']; ?>"/>
                        </div>
                        <div class="col-4">
                            <label for="signature_abilities" class="form-label">Signature Abilities</label>
                            <input type="text" class="form-control" id="signature_abilities" name="signature_abilities" value="<?= $user['name']; ?>" />
                        </div>
                        <div class="col-4">
                            <label for="ultimate_abilities" class="form-label">Ultimate Abilities</label>
                            <input type="text" class="form-control" id="ultimate_abilities" name="ultimate_abilities" value="<?= $user['name']; ?>"/>
                        </div>
                    </div>
                </div>
                <!-- <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="front_image" class="form-label">Front Display Image</label>
                            <input type="file" name="choosefile" value="<?= $user['name']; ?>" class="form-control" id="front_image"/>
                        </div>
                        <div class="col">
                            <label for="back_image" class="form-label">Back Display Image</label>
                            <input type="file" name="choosefile" value="<?= $user['name']; ?>" class="form-control" id="back_image"/>
                        </div>
                    </div>
                </div> -->
                <div class="mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="describe">Story</label>
                            <textarea type="text" class="form-control" id="describe" name="describe" value="<?= $user['name']; ?>" style="height: 100px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <input type="hidden" name="id" value="<?= $character['id']; ?>" />
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        <div class="text-center">
            <a href="/manage-character" class="btn btn-danger btn-md"
            ><i class="bi bi-arrow-left"></i> Back to Users</a
            >
        </div>
    </div>

<?php
require "parts/footer.php";