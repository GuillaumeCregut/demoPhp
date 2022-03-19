<?php
    include "include/connecteur.inc.php";
    include "include/Smarty.class.php";
    //Template connection
    $templateGenerator=new Smarty();

    //DB connection
    try
    {
        $connectId =new PDO('mysql:host='.$DataBaseServeur.';dbname='.$DataBaseName.';charset=UTF8',$DataBaseUser,$DataBasePass,array( PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_FOUND_ROWS=>TRUE));
        $connectId->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $connectId->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
       echo "<p>connexion impossible</p>";
    }
    //Getting all albums
    $getAllAlbums='SELECT title, genre, picture, artist FROM album ORDER BY artist,title';
    //Execute request
    $sth=$connectId->prepare($getAllAlbums);
    $sth->execute();
    $result=$sth->fetchAll();
    $templateGenerator->assign('AlbumArray',$result);
    $templateGenerator->display('templates/index.tpl');
?>