<?php $title = "UserAccounts - Home";
ob_start();
?>

<?php include("messages.php") ?>
<h1>Home page</h1>

<?php
$content = ob_get_clean();
require('template.php');
?>