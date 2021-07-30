<?php

function connect()
{
    //todo: insérer le message en bdd si le message saisi est valide
    $dbName = "tweeter"; //nom de la base de donnée
    $dbUser = "root"; //nom d'utilisateur MySQL
    $dbPass = ""; //son mot de passe
    $dbHost = "localhost"; //l'adresse ip du serveur mysql

//ajoutez ;port=8989 à la fin si vous devez spécifier le port de MySQL
    $dsn = "mysql:dbname=$dbName;host=$dbHost;charset=utf8";

//cette variable $pdo contient notre connexion à la bdd \o/
    $cnx = new PDO($dsn, $dbUser, $dbPass, [
        //affiche les messages d'erreurs SQL
        //repasser à ERRMODE_SILENT en prod !!!!
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        //pour récupérer les données uniquement sous forme de tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
return $cnx;
}

/*
function selectTweetById($id)
{
    $sql = 'SELECT * FROM tweets WHERE id= :id';
    $cnx = connect();
    $pStmt = $cnx->prepare($sql);
    //$pStmt->bindValue(':id', $id);
    $pStmt->execute([
        ':id'=>$id,
    ]);
    return $pStmt->fetch(); // tableau associatif

}

function selectAllTweet()
{
    $sql = 'SELECT * FROM tweets;';
    $cnx = connect();
    $pStmt = $cnx->prepare($sql);
    $pStmt->execute();
    return $pStmt->fetchAll(); // tableau associatif dans un tableau indicé numérique



}*/

function insertTweet(string $tweet)
{
    $sql = "INSERT INTO tweets (id, author_id, message, likes_quantity, date_created) VALUES(null,1,:tweet,0,now());";
    $cnx = connect();
    $pStmt = $cnx-> prepare($sql);
    $pStmt->execute([
        ':tweet'=>$tweet,
    ]);

}


function insertUser($email, $pseudo, $password, $bio)
{
    $sql = "INSERT INTO users (email, pseudo, password, biographie, date_created) VALUES(:email,:pseudo,:password,:bio,now());";
    $cnx = connect();
    $pStmt = $cnx->prepare($sql);
    $pStmt->execute([
        ':email' => $email,
        ':pseudo' => $pseudo,
        ':password' => $password,
        ':bio' => $bio,
    ]);
}

function selectUserByEmail($email)
{
    $sql = 'SELECT * FROM users WHERE email= :email';
    $cnx = connect();
    $pStmt = $cnx->prepare($sql);
    //$pStmt->bindValue(':id', $id);
    $pStmt->execute([
        ':email'=>$email,
    ]);
    return $pStmt->fetch(); // tableau associatif

}

function selectUserByPseudo($pseudo)
{
    $sql = 'SELECT * FROM users WHERE pseudo= :pseudo';
    $cnx = connect();
    $pStmt = $cnx->prepare($sql);
    $pStmt->execute([
        ':pseudo'=>$pseudo,
    ]);
    return $pStmt->fetch();
}

function selectDixDerniersTweets()
{
    $sql = "SELECT tweets.*, users.pseudo FROM tweets JOIN users ON tweets.author_id = users.id ORDER BY date_created DESC LIMIT 10;";
    $cnx = connect();
    $pStmt = $cnx->prepare($sql); // à la place d'un prepare, je pouvais faire un query
    $pStmt->execute();
    return $pStmt->fetchAll();
}

function getUserById($userId){
    $sql = "SELECT * FROM users WHERE id = :id";
    $cnx = connect();
    $pStmt = $cnx->prepare($sql);
    $pStmt->execute([
        ':id'=>$userId,
    ]);
    $result = $pStmt->fetch();
    return $result ? $result : null;
}

function getTweetById($userId){
    $sql = "SELECT u.*, t.id as id_tweet, t.author_id , likes_quantity, t.message, t.date_created as date_tweet FROM users as u JOIN tweets as t ON u.id = t.author_id WHERE u.id = :userId ORDER BY date_created DESC;";
    //$sql = "SELECT tweets.*, users.username FROM tweets JOIN users ON tweets.author_id"
    $cnx = connect();
    $pStmt = $cnx->prepare($sql);
    $pStmt->execute([
        'userId' =>$userId,
    ]);
    return $pStmt->fetchAll();
}

function incrementLikesQuantity($tweetId)
{
    $pdo = connect();
    $sql = "UPDATE tweets SET likes_quantity = likes_quantity + 1 WHERE id = :id";
    $Stmt = $pdo->prepare($sql);
    return $Stmt->execute([":id" =>$tweetId]);
}

function getUserByIdentifiant($identifiant)
{
    $sql = "SELECT * FROM users WHERE email = :login OR pseudo = :login;";
    $cnx = connect();
    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ':login'=>$identifiant
    ]);
    $result = $stmt->fetch();
    return $result ? $result: null;
}
