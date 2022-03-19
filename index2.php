<?php
    include "include/connecteur.inc.php";
    //DB connection
    try
    {
        $connectId =new PDO('mysql:host='.$DataBaseServeur.';dbname='.$DataBaseName.';charset=UTF8',$DataBaseUser,$DataBasePass,array( PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_FOUND_ROWS=>TRUE));
        $connectId->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $connectId->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p>Connexion OK</p>";
    }
    catch(PDOException $e)
    {
       echo "<p>connexion impossible</p>";
    }
    //Display Title
    echo "<h1>Hello World</p>";
    //Getting all albums
    $getAllAlbums='SELECT title, genre, picture, artist FROM album ORDER BY artist,title';
    //Execute request
    $sth=$connectId->prepare($getAllAlbums);
    $sth->execute();
    $result=$sth->fetchAll();
    //var_dump($result);
    foreach($result as $album){
        echo "<p>Album : ".$album['title']."</p>";
    }
?>