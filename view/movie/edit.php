<h1>Edit</h1>

<article>

<div class="center" style="width:50%;margin:0 auto;">
<a href="../movie">Överblick</a> | 
<a href="./search">Sök i databasen</a> | 
<a href="./select">Hantera databasen</a>
</div>

<form method="post" action="edit">
    <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>
    <p>
        <label>Title:<br> 
        <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
        </label>
    </p>
    <p>
        <label>Year:<br> 
        <input type="number" name="movieYear" value="<?= $movie->year ?>"/>
    </p>
    <p>
        <label>Image:<br> 
        <input type="text" name="movieImage" value="<?= $movie->image ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSave" value="Save">
        <input type="reset" value="Reset">
    </p>
</form>

</article>
