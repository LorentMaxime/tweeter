<?php
include 'include/db.php';

include 'include/top.php';
?>

    <section>
        <div class="container has-text-centered">
            <img src="img/imageTweeter.jpg" class="imgTop" alt="image principale de site">
            <h1 class="title">
                Rejoignez notre communauté Tweeter!
            </h1>
            <p class="subtitle mt-2">
                <a href="inscription.php" class="is-uppercase">
                    <span class="icon"><i class="fas fa-star"></i></span>
                    Créez votre compte maintenant
                    <span class="icon"><i class="fas fa-star"></i></span>
                </a>
            </p>
        </div>

    </section>
    <main class="section">
        <div class="container">
            <h3 class="title is-3">Les derniers tweets</h3>

            <?php
            // la liste des dix derniers tweets et utilisation de l'include
            $tweets = selectDixDerniersTweets();
            include 'include/tweet_list.php'; ?>

        </div>
    </main>

<?php
include 'include/bottom.php';
?>