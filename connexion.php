<?php
session_start();

include 'include/db.php';
include 'include/top.php';

    // initialisation du tableau d'erreurs
    $errors = [];

    // Controle pour eviter d'entrer en BD via la chaine d'interrogation
    if(!empty($_GET)){
        header("HTTP/1.1 404 Not Found");
        include "404.php";
        die();
    }

    // le formulaire est il soumis

if (!empty($_POST)) {
        $identifiant = strip_tags($_POST['identifiant']);
        $password = $_POST['password'];

        // valider les données //

        // verification si user existe en bdd
        $utilisateur = getUserByIdentifiant($identifiant);
        if (!empty($utilisateur)) {
            // verif du mot de passe
            if (password_verify($password, $utilisateur['password'])) {
                //$_SESSION['user'] = ['id'=>$utilisateur['id'],'email' => $utilisateur['email'], 'pseudo' => $utilisateur['pseudo'], 'bio' => $utilisateur['biographie'], 'date_created' => $utilisateur['date_created']];
                // autre façon de faire
                $_SESSION['user'] = $utilisateur;
                unset($_SESSION['user']['password']);
            }
        }

        if(!isset($_SESSION['user'])){
            $_SESSION['flash'] = ['Les identifiants sont incorrects. Veuillez corriger SVP','danger'];
            $errors['identifiant'] = 'Identifiants incorrects';
        }else{
            $_SESSION['flash'] = ['Bienvenue parmi nous '.$_SESSION['user']['pseudo'],'success'];
            header('Location: index.php');
            die();
        }




}







?>
<main>
    <div class="container">

        <h2 class="title is-4">Connexion</h2>
        <div class="has-text-centered">
            <div><img src="img/imageTweeter.jpg"></div>
        </div>
        <form method="post" class="box">
            <div class="field">
                <label for="identifiant">Identifiant</label>
                <div class="control">
                    <input name="identifiant" value="<?=$identifiant ?? ""?>"  class="input <?=!empty($errors['identifiant'])? "is-danger" : "" ?>" type="identifiant" id="identifiant" placeholder="saisissez votre email ou pseudo">
                </div>
                <?php if(!empty($errors['identifiant'])):?>
                    <p class="help is-danger"><?= $errors['identifiant'] ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label for="password">Mot de passe</label>
                <div class="control">
                    <input name="password" class="input <?=!empty($errors['password'])? "is-danger" : "" ?>" type="password" id="password" placeholder="saisissez votre password">
                </div>
                <?php if(!empty($errors['password'])):?>
                    <p class="help is-danger"><?= $errors['password'] ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button">Valider</button>
                </div>
            </div>

        </form>

    </div>




</main>


















<?php
include 'include/bottom.php';
?>
