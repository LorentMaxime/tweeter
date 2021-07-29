<?php
include 'include/db.php';

// initialisation tableau d'erreurs
    $errors = [];

// Je ne dois pas pouvoir envoyer des attaques html en GET via l'url
    header("HTTP/1.1 404 Not Found");


// le formulaire est il soumis
    var_dump($_POST);
    if (!empty($_POST)){
    // recuperer les données
    $message = $_POST['message'];
    var_dump($_POST);

    // valider les données
    // message non renseigné /
    if(empty($message)){
        $errors['message']= 'Veuillez écrire un message SVP !';
    }

    // longueur du message >255 caracteres?
    if (mb_strlen($message)>255){
        $errors['message']='maximum 255 caracteres !';
    }

    var_dump($errors);

    // est ce qu'il y a des erreurs ?
    // si non
    if (empty($errors)){
    // todo : envoyer le message en BDD
        insertTweet($message);


/*
        $results = selectAllTweet();
        var_dump($results);
        foreach ($results as $result){
            echo $result['message'].'<br>';
        }

        $results = selectTweetById(1);
        var_dump($results);
        echo $results['message'];

        // redirection vers la page d'accueil
        //header('Location: index.php');
        //die();*/
    }

}

include 'include/top.php';
?>


<main>
    <div class="container">
        <h2 class="title is-4">Postez un message !</h2>
        <div>
            <div class="has-text-centered">
                <div><img src="img/imageTweeter.jpg"></div>
            </div>
            <form method="post" class="box" novalidate>
                <div class="field">
                    <label for="message">Postez votre message</label>
                    <div class="control">
                        <textarea name="message" class="textarea <?=!empty($errors['message'])? "is-danger" : "" ?>"  type="message" id="message" placeholder="saisissez votre message"><?=$message ?? ""?></textarea>
                    </div>
                    <?php if(!empty($errors['message'])):?>
                        <p class="help is-danger"><?= $errors['message'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button">Poster le message</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

</main>













<?php
include 'include/bottom.php';
?>
