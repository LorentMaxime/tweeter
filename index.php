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
            $tweets = selectDixDerniersTweets();

            //var_dump($tweets);

            foreach ($tweets as $tweet) :
                ?>

                <article class="media box">
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img src="https://bulma.io/images/placeholders/128x128.png" alt="image">
                        </p>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <a href="detailProfil.php?user_id=<?= $tweet['author_id'] ?>">
                                <strong><?= $tweet['pseudo'] ?></strong>
                                </a>
                                <br>
                                <?= $tweet['message'] ?>
                            </p>
                        </div>
                        <nav class="level is-mobile">
                            <div class="level-left">
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fas fa-reply"></i></span>
                                </a>
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                                </a>
                                <a class="level-item">
                                    <span class="icon is-small"><i class="fas fa-heart"></i></span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </article>

            <?php
            endforeach;
            ?>
        </div>
    </main>

<?php
include 'include/bottom.php';
?>