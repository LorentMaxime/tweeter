<?php
    // initialisation tableau d'erreurs
    $errors = [];

    include 'include/db.php';

    // Controle pour eviter d'entrer en BD via la chaine d'interrogation
    if (!empty($_GET)){
        header("HTTP/1.1 404 Not Found");
        include '404.php';
        die();
    }

    // le formulaire est il soumis ?
    var_dump($_POST);
    if (!empty($_POST)){
        // recuperer les données -- strip_tags enleve les balise html pour contrer le hack
        $email = strip_tags($_POST['email']);
        $pseudo = strip_tags($_POST['username']);
        $password = $_POST['password'];
        $bio = strip_tags($_POST['bio']);
        var_dump($_POST);

        // valider les données //

        // email non renseigné
        if (empty($email)){
            $errors['email']='Veuillez saisir un email SVP !';
        }
        // email respecte t-il le format ?
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email']='Veuillez saisir un email valide SVP !';
        }
        // email est il deja en BDD ?
        elseif (!empty(selectUserByEmail($email))){
            $errors['email']='Cet email est déja utilisé !';
        }


        //** pseudo non renseigné */
        if (empty($pseudo)){
            $errors['username']='Veuillez saisir un pseudo SVP !';
        }
        // longueur du pseudo <3 caracteres?
        elseif (mb_strlen($pseudo)<3){
            $errors['username']='minimum 3 caracteres!';
        }
        // longueur du pseudo >30 caracteres?
        elseif (mb_strlen($pseudo)>30){
            $errors['username']='maximum 30 caracteres!';
        }
        // pseudo est il deja en BDD ?
        elseif (!empty(selectUserByPseudo($pseudo))){
            $errors['pseudo']='Ce pseudo est deja utilisé !';
        }

        // controle mot de passe

        $regex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/";
        if (!preg_match($regex, $password)){
            $errors['password']='au moins une lettre, un chiffre et 6 caracteres minimum SVP !';
        }

        //var_dump($errors);
        // est ce que tout est valide ?
        if (empty($errors)){

            // hasher le mot de passe
            $hash = password_hash($password,PASSWORD_DEFAULT,['cost'=>14,]);

            // Inserer l'utilisateur en BDD
            insertUser($email,$pseudo,$hash,$bio);

            // todo : message flash (session)

            // redirection vers la page d'accueil
            header('Location: index.php');
            die();
        }

    }

    //die();

    include 'include/top.php';
?>

<main>
    <div class="container">

        <h2 class="title is-4">Inscription</h2>
            <div class="has-text-centered">
                <div><img src="img/imageTweeter.jpg"></div>
            </div>
            <form method="post" class="box" novalidate>
                <div class="field">
                    <label for="email">Email</label>
                    <div class="control">
                        <input name="email" value="<?=$email ?? ""?>" required class="input <?=!empty($errors['email'])? "is-danger" : "" ?>" type="email" id="email" placeholder="saisissez votre email">
                    </div>
                    <?php if(!empty($errors['email'])):?>
                    <p class="help is-danger"><?= $errors['email'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <label for="username">Pseudo</label>
                    <div class="control">
                        <input name="username" value="<?=$username ?? ""?>" class="input <?=!empty($errors['email'])? "is-danger" : "" ?>" type="text" id="username" placeholder="saisissez votre pseudo">
                    </div>
                    <?php if(!empty($errors['username'])):?>
                        <p class="help is-danger"><?= $errors['username'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <label for="password">Mot de passe</label>
                    <div class="control">
                        <input name="password" class="input <?=!empty($errors['email'])? "is-danger" : "" ?>" type="password" id="password" placeholder="saisissez votre password">
                    </div>
                    <?php if(!empty($errors['password'])):?>
                        <p class="help is-danger"><?= $errors['password'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <label for="bio">Bio</label>
                    <div class="control">
                        <textarea name="bio" class="textarea <?=!empty($errors['email'])? "is-danger" : "" ?>" type="bio" id="bio" placeholder="saisissez votre password"><?=$bio ?? ""?></textarea>
                    </div>
                    <?php if(!empty($errors['bio'])):?>
                        <p class="help is-danger"><?= $errors['bio'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button">Créer mon compte</button>
                    </div>
                </div>

            </form>

        </div>
    </div>



</main>

<?php
include 'include/bottom.php';
?>



