<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/album.css">
    <title>Album</title>
</head>
<body>
    <h1>Album</h1>
    {if isset($Album)}
        <p>Titre de l'album : {$Album.title}</p>
        <p>Artiste : {$Album.artist}</p>
        <p>Genre : {$Album.genre}</p>
        <h2>Liste des pistes de l'album</h2>
        {if isset($tracksArray)}
            <div class="listTracksDiv">
            <ul class="listTracks">
            {foreach from=$tracksArray item=infos}   
                    <li>{$infos.title}</li>    
            {/foreach}
            </ul>
            </div>
        {else} 
            <p>Pas de titre dans cet album</p>
        {/if}
        <div class="FormAddTrack">
            <h3>Ajouter une piste</h3>
            <form action="album.php" method="post">
                <input type="hidden" name="id" value="{$Album.id}">
                <div class="FormAddTrackInputs">
                    <label for="title">Titre : <input type="text" name="title" id="title"></label>
                    <input type="submit" value="Ajouter">
                </div>
            </form>
        </div>
    {else} 
        <p>Pas d'information sur cet album</p>
    {/if}
    <p><a href="index.php">Retour</a></p>
</body>
</html>