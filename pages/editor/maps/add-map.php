<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

require "parts/header.php";
?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="h1">Add New Map</h1>
        </div>
        <div class="card mb-2 p-4">
            <form
                    method="POST"
                    action="/editor/map/add"
                    enctype="multipart/form-data"
            >
                <?php require "parts/message_error.php";?>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" />
                        </div>
                        <div class="col">
                            <label for="img" class="form-label">Map Image</label>
                            <input type="file" class="form-control" id="img" name="img" />
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
        <div class="text-center pt-3">
            <a href="/manage-map" class="btn btn-danger btn-md"
            ><i class="bi bi-arrow-left"></i> Back to Manage Map</a
            >
        </div>
    </div>

<?php
require "parts/footer.php";