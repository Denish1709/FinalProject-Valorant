<?php 

$database = connectToDB();

$sql = 'SELECT * FROM users';
$query = $database->prepare($sql);
$query->execute([
    'id' => $_GET( $_SESSION['user']['id'])
]);
$users = $query->fetchAll();

require "parts/header.php";

?>
<div class="container mx-auto my-5" style="max-width: 700px;">
<?php if ( isset( $_SESSION["user"] ) ) { ?>
        <div class="text-center pb-3 mb-1">
            <h1 class="text-danger">Edit Profile</h1>
        </div>
        <div class="card mb-2 p-4">
            <form
                    method="POST"
                    action="/edit-profile"
                    enctype="multipart/form-data"
            >
                <?php require "parts/message_error.php";?>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['user']['name'] ?>"/>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="phonenumber" class="form-label"> Phone Number</label>
                            <div class="row">
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="+60" disabled readonly>
                                </div>
                                <div class="col">
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= $_SESSION['user']['phonenumber'] ?>" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="address" class="form-label"> Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $_SESSION['user']['email'] ?> ">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card mb-2 p-4">
            <form
                    method="POST"
                    action="/edit-profile"
                    enctype="multipart/form-data"
            >
                <?php require "parts/message_error.php";?>
                <form method="POST" action="admin/changepwd">
                <?php require "parts/message_error.php";?>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" />
                        </div>
                        <div class="col">
                            <label for="confirm-password" class="form-label"
                            >Confirm Password</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                id="confirm_password"
                            />
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <input type="hidden" name="id" value="<?= $users['id']; ?>"/>
                    <button type="submit" class="btn btn-primary">
                        Change Password
                    </button>
                </div>
        </form>
            </form>
        </div>
        <div class="container pt-5">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        <div class="text-center">
            <a href="/" class="btn btn-link btn-sm"
            ><i class="bi bi-arrow-left"></i> Back to Main Page</a
            >
        </div>
        <?php } ?>
</div>