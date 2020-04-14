<?php

namespace Anax\View;

/**
 * Debug view that shows session, post and get
 */

?>
<hr>
<pre>
SESSION
<?= var_dump($_SESSION) ?>
POST
<?= var_dump($_POST) ?>
GET
<?= var_dump($_GET) ?>
</pre>
<hr>
</article>