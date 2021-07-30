<?php

session_start();

unset($_SESSION['user']);

$_SESSION['flash'] = ['Vous etes déconnecté.', 'success'];

header("Location: connexion.php");
die();