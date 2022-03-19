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
    //checking if post datas
    //var_dump($_POST);
    if(!empty($_POST)){
        if(isset($_POST['title'])){
            $albumTitle=htmlspecialchars($_POST['title'],ENT_NOQUOTES,'UTF-8');
        }
        else
            $albumTitle='';
        if(isset($_POST['artist'])){
            $artistName=htmlspecialchars($_POST['artist'],ENT_NOQUOTES,'UTF-8');
        }
        else
            $artistName='';
        if(isset($_POST['genre']))
            $genre=htmlspecialchars($_POST['genre'],ENT_NOQUOTES,'UTF-8');
        else
            $genre='';
        if($albumTitle==='' or $genre==='' or $artistName==='')
        {
            echo "Veuillez saisir tous les champs";
        }
        else{
            //Adding album to DB
            $SQL="INSERT INTO album (title,genre,artist) VALUES (:title,:genre,:artist)";
            $arrayValues=array(':title'=>$albumTitle,':genre'=>$genre,':artist'=>$artistName);
            $sth=$connectId->prepare($SQL);
            $result=$sth->execute($arrayValues);
            if(!$result){
                echo "<p>Ajout impossible</p>";
            }
        }
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