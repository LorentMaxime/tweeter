<?php
include("include/db.php");

    // si mon tableau associatif $_GET est vide, ce n'est pas normale et je redirige vers une 404
    if (count($_GET)!=1 || !isset($_GET['tweet_id'])){
        header("HTTP/1.1 404 Not Found");
        include ("404.php");
        die();
    }

    // récupère l'id du tweet à liker
    $tweetId = $_GET['tweet_id'];

    // increment le nombre de likes que ce tweet !
    incrementLikesQuantity($tweetId);

    //var_dump($_SERVER);

    // redirige à tous les coups !
    // la variable contient l'URL d'ou provient l'utilisateur
    header("Location: " .$_SERVER['HTTP_REFERER']);
    die();

?>