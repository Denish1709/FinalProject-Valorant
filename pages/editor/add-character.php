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
        <div class="text-center pb-3 mb-1">
            <h1 class="text-danger">Add New Character</h1>
        </div>
        <div class="card mb-2 p-4">
            <form
                    method="POST"
                    action="/editor/add"
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
                            <label for="real_name" class="form-label">Real Name</label>
                            <input type="text" class="form-control" id="real_name" name="real_name" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="origin" class="form-label">Origin</label>
                            <input type="text" class="form-control" id="origin" name="origin" />
                        </div>
                        <div class="col">
                            <label for="added_on" class="form-label">Added Date</label>
                            <input type="date" class="form-control" id="added_on" name="added_on" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="email" class="">Gender</label>
                            <div class="col-sm-10  mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="maler" value="M" required>
                                    <label class="form-check-label" for="maler">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="femaler" value="F" required>
                                    <label class="form-check-label" for="femaler">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
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
                            <input type="text" class="form-control" id="basic_abilities" name="basic_abilities" />
                        </div>
                        <div class="col-4">
                            <label for="signature_abilities" class="form-label">Signature Abilities</label>
                            <input type="text" class="form-control" id="signature_abilities" name="signature_abilities" />
                        </div>
                        <div class="col-4">
                            <label for="ultimate_abilities" class="form-label">Ultimate Abilities</label>
                            <input type="text" class="form-control" id="ultimate_abilities" name="ultimate_abilities" />
                        </div>
                    </div>
                </div>
                <!-- <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="front_image" class="form-label">Front Display Image</label>
                            <input type="file" name="choosefile" value="" class="form-control" id="front_image"/>
                        </div>
                        <div class="col">
                            <label for="back_image" class="form-label">Back Display Image</label>
                            <input type="file" name="choosefile" value="" class="form-control" id="back_image"/>
                        </div>
                    </div>
                </div> -->
                <div class="mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="describe">Story</label>
                            <textarea type="text" class="form-control" id="describe" name="describe" style="height: 100px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-danger">Add</button>
                </div>
            </form>
        </div>
        <div class="text-center pt-3">
            <a href="/manage-character" class="btn btn-danger btn-md"
            ><i class="bi bi-arrow-left"></i> Character Management</a
            >
        </div>
    </div>

<?php
require "parts/footer.php";