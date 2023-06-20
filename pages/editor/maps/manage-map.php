<?php

// check if the current user is an admin or not
if ( !isEditor() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

// load data from database
$database = connectToDB();


// get all the users
$sql = "SELECT * FROM maps";
$query = $database->prepare($sql);
$query->execute();

// fetch the data from query
$maps = $query->fetchAll();

require "parts/header.php";
?>
    <div class="container mx-auto my-5 bg-dark pb-4" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="text-danger">Manage Employees</h1>
            <div class="text-end">
                <a href="/add-map" class="btn btn-danger btn-md"
                >Add New Map</a
                >
            </div>
        </div>
        <div class="card mb-2 p-4 bg-danger">
            <?php require "parts/message_success.php"; ?>
            <table class="table bg-dark">
                <thead>
                <tr>
                    <th scope="col" class="text-danger text-center">Name</th>
                    <th scope="col" class="text-danger text-center">Map</th>
                    <th scope="col" class="text-end text-danger">Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- display out all the users using foreach -->
                <?php foreach ($maps as $map) { ?>
                    <tr class="text-danger<?php
                    if (
                        isset( $_SESSION['new_map'] ) &&
                        $_SESSION['new_map'] == $map['name'] ) {
                        echo "table-success";
                        unset( $_SESSION['new_map'] );
                    }
                    ?>">
                        <td class="text-center pt-5"><?= $map['name']; ?></td>
                        <td class="text-center">
                            <img src="<?= $map['img']; ?>" alt="" class="img-fluid">
                        </td>
                        <td class="text-end">
                            <div class="buttons pt-5">
                                <a
                                        href="/edit-map?id=<?= $map['id']; ?>"
                                        class="btn btn-success btn-md me-2"
                                ><i class="bi bi-pencil"></i
                                    ></a>
                               
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $map['id']; ?>">
                                    <i class="bi bi-trash"></i
                                    >
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="delete-modal-<?= $map['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this map: <?= $map['name']; ?>?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                You're currently deleting <?= $map['name']; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!--
                                                  Delete Form
                                                  1. add action
                                                  2. add method
                                                  3. add input hidden field for id
                                                -->
                                                <form method= "POST" action="/editor/map/delete">
                                                    <input type="hidden" name="id" value= "<?= $map['id']; ?>" />
                                                    <button type="submit" class="btn btn-danger">Yes, please delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="text-center pt-3">
            <a href="/" class="btn btn-danger btn-md"
            ><i class="bi bi-arrow-left"></i> Back to Main Page</a
            >
        </div>
    </div>

<?php
require "parts/footer.php";