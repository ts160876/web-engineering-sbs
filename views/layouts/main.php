<?php

use Bukubuku\Core\Application;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title><?= $this->title ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BukuBuku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/web-engineering-sbs/public/index.php/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/web-engineering-sbs/public/index.php/users/create">Create User</a></li>
                            <li><a class="dropdown-item" href="/web-engineering-sbs/public/index.php/users/edit">Edit User</a></li>
                            <li><a class="dropdown-item" href="/web-engineering-sbs/public/index.php/users/list">List Users</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/web-engineering-sbs/public/index.php/contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/web-engineering-sbs/public/index.php/registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/web-engineering-sbs/public/index.php/login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Here we display the flash messages. -->
    <div class="container">
        <?php if (Application::$app->session->getFlashMemory('success')): ?>
            <div class="alert alert-success"><?= htmlspecialchars(Application::$app->session->getFlashMemory('success')) ?></div>
        <?php elseif (Application::$app->session->getFlashMemory('error')): ?>
            <div class="alert alert-danger"><?= htmlspecialchars(Application::$app->session->getFlashMemory('error')) ?></div>
        <?php endif; ?>
    </div>

    <!-- This is the placeholder where the content of the view is injected. -->
    <div class="container">
        {{content}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>