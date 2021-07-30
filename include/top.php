<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Max Maximum!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.png">
</head>
<body>


<header class="section">
    <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php">
                    <img src="img/logo.png">
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu has-text-centered">
                <div class="navbar-start">
                    <a class="navbar-item" href="index.php">
                        Home
                    </a>

                    <a class="navbar-item" href="tweet.php">
                        Postez un message !
                    </a>
                </div>

                <div class="navbar-end">
                    <a class="navbar-item button is-info is-light" href="inscription.php">
                        <strong>Inscription</strong>
                    </a>
                    <a class="navbar-item button is-light button is-success" href="connexion.php">Connexion</a>
                </div>

            </div>
        </nav>
    </div>
</header>

<?php    if (!empty($_SESSION['flash'])) : ?>
    <div class="container content">
        <div class="notification is-<?= $_SESSION['flash'][1] ?> has-text-centered">
            <?=$_SESSION['flash'][0] ?>
        </div>
        <?php
        unset($_SESSION['flash']);
        ?>
    </div>
<?php endif; ?>