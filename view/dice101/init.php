<?php

namespace Anax\View;

?>
<article>
<div style="width:40%;margin:0 auto;text-align:center;">
<h1>Dice101, next gen!</h1>
<br>
<h4>Välj antal tärningar</h4>
<form method="POST" action="init-process" style="width:100%;margin: 0 auto;">
<label for="nrOfDice">Tärningar</label>
<br>
<input type="range" id="nrOfDiceRange" name="nrOfDiceRange" min="1" max="6" value="1" oninput="this.form.diceText.value=this.value">
<br>
<input type="text" name="diceText" disabled="true" value="" style="text-align:center;" placeholder="1">
<br>
<input type="submit" name="start" value="Starta spelet!" style="margin-top:24px;padding:12px;">
</form>
</div>
</article>