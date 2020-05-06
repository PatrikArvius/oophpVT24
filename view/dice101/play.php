<?php

namespace Anax\View;

?>
<article>
<h1>Dice101, next gen</h1>
<table style="width:30%;margin:0 auto;border:2px solid;">
<th>Player score: </th>
<th>Computer score: </th>
<tr style="text-align:center;">
<td><?= $pScore ?></td>
<td><?= $cScore ?></td>
</tr>
</table>
<p style="margin-bottom:0;"><b>Histogram</b></p>
<div style="width:30%;margin:0 auto;">
<pre style="margin-bottom:0;">
<?= $dice101->getHistogramAsText(); ?>
</pre>
<p style="margin-bottom:0;"><b>Avg value:</b> <?= $dice101->getHistogramAvgDiceValue(); ?></p>
</div>
<div style="width:50%;margin:0 auto;">
<form method="POST" action="play-process">
<?php if ($winner) : ?>
    <p><b>WINNER WINNER CHICKEN DINNER</b></p>
    <p><b><?= $winner ?></b></p>
    <input type="submit" name="newGame" value="New Game">
<?php else : ?>
    <?php if ($playerTurn) : ?>
    <h3><b>Players turn!</b></h3>
        <?php if ($dice101->player->hasRolled()) : ?>
        <p><b>You rolled: </b><?= $dice101->player->getLastRoll() ?></p>
        <p><b>Current score: </b><?= $currentScore ?></p>
        <input type="submit" name="save" value="Save Score">
        <?php endif; ?>
    <input type="submit" name="nextRound" value="Roll Dice">
    <input type="submit" name="newGame" value="New Game">
    <?php else : ?>
    <h3><b>Computers turn!</b></h3>
    <input type="submit" name="compRoll" value="Simulate Computer">
    <input type="submit" name="newGame" value="New Game">
    <?php endif; ?>
<?php endif; ?>
</div>
