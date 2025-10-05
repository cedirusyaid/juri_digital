<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Juri Digital</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
<nav class="navbar navbar-expand-lg bg-success navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">Juri Digital</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('users'); ?>">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('users'); ?>">Users</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === TRUE): ?>
                    <span class="navbar-text me-3">
                        Welcome, <?php echo $_SESSION['username']; ?>
                    </span>
                    <a class="btn btn-outline-light" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                <?php else: ?>
                    <a class="btn btn-outline-light" href="<?php echo base_url('auth/login'); ?>">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container mt-4">
