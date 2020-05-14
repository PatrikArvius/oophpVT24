<h1>Movie - filmhantering</h1>

<article>

<div class="center" style="width:50%;margin:0 auto;">
<a href="./overview">Överblick</a> | 
<a href="./search">Sök i databasen</a>
</div>

<form method="post" action="edit">
    <p>
        <label>Movie:<br>
        <select name="movieId">
            <option value="" selected disabled hidden>Select movie...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
</form>

</article>
