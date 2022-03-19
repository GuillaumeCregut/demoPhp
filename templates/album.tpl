<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Album</h1>
    {if isset($Album)}
        <p>Titre de l'album : {$Album.title}</p>
        <p>Artiste : {$Album.artist}</p>
        <p>Genre : {$Album.genre}</p>
        <h2>Liste des pistes de l'album</h2>
        {if isset($tracksArray)}
            {foreach from=$tracksArray item=infos}
                <p>{$infos.title}</p>
            {/foreach}
        {else} 
            <p>Pas de titre dans cet album</p>
        {/if}
    {else} 
        <p>Pas d'information sur cet album</p>
    {/if}
    <p><a href="index.php">Retour</a></p>
</body>
</html>