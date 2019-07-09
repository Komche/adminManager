<?php
session_start();
require_once('model/class/Manager.php');
require_once('model/class/UserManager.php');

function signIn($data, $file)
{
   return UserManager::addUser($data, $file);
}

/**
 * @param string $page
 * @return void
 */
function getPath($page)
{
   require_once('view/' . $page);
}
