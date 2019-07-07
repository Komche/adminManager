<?php
$folder = '';

define ('HOST', "http://" . $_SERVER ['HTTP_HOST']); // get the hostname

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $folder = '/adminManager';
}

define('ROOT_PATH', HOST . "$folder");
define('API_ROOT_PATH', HOST . "$folder/api/object");