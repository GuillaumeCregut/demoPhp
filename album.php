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
    if(!empty($_GET)){
        //Get album infos and tracks from album
        if(isset($_GET['id'])){
            $id=intval($_GET['id']);
            $SQL="SELECT id,title, genre, artist FROM album WHERE Id=:id";
            $arrayValue=array(':id'=>$id);
            $sth=$connectId->prepare($SQL);
            $sth->execute($arrayValue);
            //Get one result
            $albumInfo=$sth->fetch(PDO::FETCH_ASSOC);
            if(!empty($albumInfo)){
                $templateGenerator->assign('Album',$albumInfo);
                //Getting all tracks for this album
                $getAllTracks="SELECT id,title FROM track WHERE id_album=:id";
                $sth=$connectId->prepare($getAllTracks);
                $sth->execute($arrayValue);
                $result=$sth->fetchAll();
                if(!empty($result)){
                    $templateGenerator->assign('tracksArray',$result);
                }
            }
            $templateGenerator->display('album.tpl');
        }
        else{
            $templateGenerator->display('index.tpl');
        }
    }
    else{
        $templateGenerator->display('index.tpl');
    }

?>