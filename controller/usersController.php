<?php
    session_start();
    require_once('model/class/Manager.php');
    require_once('model/class/UserManager.php');

    function signIn($data, $file)
    {
        UserManager::addUser($data, $file);
    }