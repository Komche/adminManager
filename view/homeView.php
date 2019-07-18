<?php
global $title;
$title = "UserAccounts - Home";
ob_start();
include('navbar.php');
?>

<?php include("messages.php") ?>
<h1>Home page</h1>

<?php
global $content;
$content = ob_get_clean();
require('template.php');
?>