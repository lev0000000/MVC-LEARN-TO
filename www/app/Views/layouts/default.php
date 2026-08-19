<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= get_csrf_meta() ?>
    <title>PHPFramework : <?= $title ?></title>
    <link rel="icon" href="<?= base_url('/favicon/favicon.png') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.min.css') ?>">

</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?= cache()->get('menu') ?>
            </div>
        </div>
    </nav>
    <h1></h1>
    <?= get_alerts() ?>
    <?= $this->content ?>
    <?= app()->get('test') ?>

    <script src="<?= base_url('/assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>