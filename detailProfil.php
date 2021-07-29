<?php
include 'include/db.php';


var_dump($_GET);

// récuperation du parametre passé dans la chaine d'interrogation
$userId = $_GET['user_id'];

$user = getUserById($userId);
var_dump($user);

include 'include/top.php';
?>

<main class="section">
    <div class="container content">
        <h2>Profil de <?=$user['pseudo']?></h2>
        <p> <?= !empty($user['biographie'])?'biographie : '.$user['biographie'] : ""?> </p>






    </div>



</main>































<?php
include 'include/bottom.php';


?>