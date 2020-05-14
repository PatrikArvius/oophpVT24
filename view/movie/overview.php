<h1>Movie - överblick</h1>

<?php
if (!$res) {
    return;
}
?>
<article>

<div class="center" style="width:50%;margin:0 auto;">
<a href="../movie">Tillbaka</a> | 
<a href="./search">Sök i databasen</a> | 
<a href="./select">Hantera databasen</a>
</div>

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
