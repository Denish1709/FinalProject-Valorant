<?php


require "parts/header.php";
?>
<div class="container my-5 mx-auto" style="max-width: 500px;">
    <h1 class="h1 mb-4 text-center text-danger">Login</h1>
    <?php require "parts/message_error.php"; ?>
    <div class="card p-4">
        <form method="POST" action="auth/login">
            <div class="mb-2">
                <label for="email" class="visually-hidden">Email</label>
                <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="email@example.com"
                />
            </div>
            <div class="mb-2">
                <label for="password" class="visually-hidden">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Password"
                />
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-danger">Login</button>
            </div>
        </form>
    </div>

    <!-- links -->
    <div
        class="d-flex justify-content-between align-items-center gap-3 mx-auto pt-3"
    >
        <a href="/index" class="btn btn-danger text-decoration-none small"
        ><i class="bi bi-arrow-left-circle"></i> Go back</a
        >
        <a href="/signup" class="btn btn-danger text-decoration-none small"
        >Don't have an account? Sign up here
            <i class="bi bi-arrow-right-circle"></i
            ></a>
    </div>
</div>

<?php
require "parts/footer.php";
