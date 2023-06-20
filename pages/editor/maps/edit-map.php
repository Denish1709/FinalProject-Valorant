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
    $sql = "SELECT * FROM maps WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        'id' => $_GET['id']
    ]);

    // fetch
    $maps = $query->fetch();

    // make sure user data is found in database
    if ( !$maps ) {
        // if user don't exists, then we redirect back to manage-users
        header("Location: /manage-map");
        exit;
    }

} else {
    // if $_GET['id'] is not available, then redirect the user back to manage-users
    // header("Location: /manage-map");
    exit;
}

require "parts/header.php";
?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="h1">Edit Map</h1>
        </div>
        <div class="card mb-2 p-4">
            <form method="POST" action="/editor/map/edit" enctype="multipart/form-data">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $maps['name']; ?>" />
                        </div>
                        <div class="col">
                            <label for="img" class="form-label">Map Image</label>
                            <input type="file" class="form-control" id="img" name="img" value="<?= $maps['img']; ?>" />
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <input type="hidden" name="id" value="<?= $maps['id']; ?>" />
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </form>
        </div> 
        <div class="text-center pt-3">
            <a href="/manage-map" class="btn btn-danger btn-md"
            ><i class="bi bi-arrow-left"></i> Back to Manage Maps</a
            >
        </div>
    </div>

<?php
require "parts/footer.php";