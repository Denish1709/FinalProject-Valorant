<?php

// check if the current user is an admin or not
if ( !isAdmin() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

$database = connectToDB();


$sql = 'SELECT * FROM users';
$query = $database->prepare($sql);
$query->execute();
$users = $query->fetch();

require "parts/header.php";
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Change Password</h1>
    </div>
    <div class="card mb-2 p-4">
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
    </div>
    <div class="text-center">
        <a href="/manage-employees" class="btn btn-danger btn-sm"
        ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
    </div>
</div>

<?php

require "parts/footer.php";

?>
