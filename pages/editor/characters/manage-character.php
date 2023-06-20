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
$sql = "SELECT
characters.*, 
users.name
FROM characters
JOIN users
ON characters.modified_by = users.id";
$query = $database->prepare($sql);
$query->execute();

// fetch the data from query
$characters = $query->fetchAll();

require "parts/header.php";
?>
    <div class="container mx-auto my-5 bg-dark pb-4" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="text-danger">Manage Characters</h1>
            <div class="text-end">
                <a href="/add-character" class="btn btn-danger btn-md"
                >Add New Character</a
                >
            </div>
        </div>
        <div class="card mb-2 p-4 bg-danger">
            <?php require "parts/message_success.php"; ?>
        <table class="table bg-dark">
                <thead>
                <tr>
                    <th scope="col" class="text-danger">Name</th>
                    <th scope="col" class="text-danger">Role</th>
                    <th scope="col" class="text-danger">Last Modified By</th>
                    <th scope="col" class="text-end text-danger">Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- display out all the users using foreach -->
                <?php foreach ($characters as $character) { ?>
                    <tr class="text-danger<?php
                    if (
                        isset( $_SESSION['new_character'] ) &&
                        $_SESSION['new_character'] == $character['agent'] ) {
                        echo "table-success";
                        unset( $_SESSION['new_character'] );
                    }
                    ?>">
                        <td><?= $character['agent']; ?></td>                        
                        <td>
                            <span class="
                            <?php
                            if($character["role"] == "Controller"){
                                echo "badge bg-secondary";
                            } else if($character["role"] == "Duelist"){
                                echo "badge bg-danger";
                            } else if($character["role"] == "Initiator"){
                                echo "badge bg-primary";
                            } else if($character["role"] == "Sentinel"){
                                echo "badge bg-info";
                            } 
                            ?>"><?= $character['role']; ?></span>
                        </td>
                        <td class="text-center"><?= $character['name']; ?></td> 
                        <td class="text-end">
                            <div class="buttons">
                                <a
                                        href="/edit-character?id=<?= $character['id']; ?>"
                                        class="btn btn-success btn-md me-2"
                                ><i class="bi bi-pencil"></i
                                    ></a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#delete-modal-<?= $character['id']; ?>">
                                    <i class="bi bi-trash"></i
                                    >
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="delete-modal-<?= $character['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to remove <?= $character['name']; ?>?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                You're currently removing <?= $character['name']; ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <!--
                                                  Delete Form
                                                  1. add action
                                                  2. add method
                                                  3. add input hidden field for id
                                                -->
                                                <form method= "POST" action="/editor/delete">
                                                    <input type="hidden" name="id" value= "<?= $character['id']; ?>" />
                                                    <button type="submit" class="btn btn-danger">Yes, please remove</button>
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