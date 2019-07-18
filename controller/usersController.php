<?php
session_start();
require_once('model/class/Manager.php');
require_once('model/class/UserManager.php');

function signIn($data, $file)
{
   return UserManager::addUser($data, $file);
}

function signUp($data)
{
   //print_r($data);
   return UserManager::connectUser($data);
}

/**
 * @param string $page
 * @return void
 */
function getPath($page, $folder=null)
{
   require_once("view/$folder" . $page);
}


function getAllRoles()
{
   $url = API_ROOT_PATH.'/roles';
   $data = Manager::file_get_data($url);
   if (!$data['error']) {
      $data = $data['data'];
      return $data;
   } else {
      $errors['message'] = $data['message'];
      return $errors;
   }
   
}