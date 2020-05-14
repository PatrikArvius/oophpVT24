<h1>Movie - filmsök</h1>

<article>

<div class="center" style="width:50%;margin:0 auto;">
<a href="./overview">Överblick</a> | 
<a href="./select">Hantera databasen</a>
</div>

<form method="POST" action="search">
    <p>
        <label>Titel (använd % som wildcard):
            <input type="search" name="searchTitle" value=""/>
        </label>
    </p>
    <p>
        <label>Utgiven mellan: 
            <input type="number" name="year1" value="" min="1900" max="2100" placeholder="1900"/>
            - 
            <input type="number" name="year2" value="" min="1900" max="2100" placeholder="2100"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
</form>

<?php
if (!$res) {
    return;
}
?>

<table style="width:50%;margin:0 auto;">
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="../<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>

</article>
