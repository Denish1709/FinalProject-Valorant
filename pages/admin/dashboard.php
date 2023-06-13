<?php

if ( !isAdmin() ) {
    // if current user is not an admin, redirect to dashboard
    header("Location: /");
    exit;
}

require "parts/header.php";

?>
<div class="container mx-auto my-5" style="max-width: 800px;">
    <h1 class="h1 mb-4 text-center text-danger">Dashboard</h1>
    <div class="row">
        <div class="col">
            <div class="card mb-2">
                <div class="card-body bg-danger">
                    <h5 class="card-title text-center">
                        <div class="mb-1">
                            <i class="bi bi-pencil-square" style="font-size: 3rem;"></i>
                        </div>
                        <p>Editor Mode</p>
                    </h5>
                    <div class="text-center mt-3">
                        <a href="/manage-posts" class="btn btn-danger btn-lg"
                        >Access</a
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-2">
                <div class="card-body bg-danger">
                    <h5 class="card-title text-center">
                        <div class="mb-1">
                            <i class="bi bi-pencil-square" style="font-size: 3rem;"></i>
                        </div>
                        <p>User Mode</p>
                    </h5>
                    <div class="text-center mt-3">
                        <a href="/manage-posts" class="btn btn-danger btn-lg"
                        >Access</a
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-2">
                <div class="card-body bg-danger">
                    <h5 class="card-title text-center">
                        <div class="mb-1">
                            <i class="bi bi-people" style="font-size: 3rem;"></i>
                        </div>
                        <p>Manage Employees</p>
                    </h5>
                    <div class="text-center mt-3">
                        <a href="/manage-employees" class="btn btn-primary btn-lg"
                        >Access</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 text-center">
        <a href="/" class="btn btn-danger btn-lg"
        ><i class="bi bi-arrow-left"></i> Main Page</a
        >
    </div>
</div>

<?php 

require "parts/footer.php";

?>