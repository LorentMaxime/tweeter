<?php
session_start();

include 'include/db.php';


// récuperation du parametre passé dans la chaine d'interrogation
$userId = $_GET['user_id'];

$user = getUserById($userId);

$tweets = getTweetById($userId);

include 'include/top.php';
?>

<main class="section">

    <div class="container content">
        <h2>Profil de <?=$user['pseudo']?></h2>

        <p> <?= !empty($user['biographie'])?'biographie : '.$user['biographie'] : ""?> </p>

        <?php include 'include/tweet_list.php';?>
    </div>

</main>































<?php
include 'include/bottom.php';


?>