<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <title>Index</title>
</head>
<body>
    <h1>Bienvenue dans la gestion de CDthèque 2.0</h1>
    <h2>Liste des albums de la CDthèque</h2>
    <div class="ListAlbum">
        {if isset($AlbumArray)}
            {foreach from=$AlbumArray item=album}
                <p>{$album.title} - {$album.artist}</p>
            {/foreach}
        {else}
            <p>Il n'y a pas d'albums</p>
        {/if}
    </div>
    <div class="FormAddAlbum">
        <h2>Ajouter un album</h2>
        <form action="index.php" method="post">
        <div class="FormInputs">
            <label for="title">Titre de l'album : <input type="text" name="title" id="title"></label>
            <label for="artist">Artiste : <input type="text" name="artist" id="artist"></label>
            <label for="genre">Genre : <input type="text" name="genre" id="genre"></label>
            <button type="submit" class="Btn">Ajouter</button>
        </div>
        </form>
    </div>
</body>
</html>