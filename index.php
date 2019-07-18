<?php
include_once('model/global.php');
include_once('controller/usersController.php');

if (isset($_GET['action'])) {
    if ($_GET['action']== 'signin') {
        if (!empty($_POST) && !empty($_FILES[ 'profile_picture'])) {
            $data = $_POST;
            $file = $_FILES;
            $errors = signIn($data, $file);
           // return $errors;
        }
        getPath('signupView.php');
    } elseif ($_GET['action'] == 'login') {
        if (!empty($_POST)) {
            $data = $_POST;
            $errors = signUp($data);
            //die(print_r($data));
            // return $errors;
        }
        getPath('loginView.php');
    } elseif ($_GET['action'] == 'logout') {
        getPath('logout.php');
    } elseif ($_GET['action'] == 'userForm') {
        $user_id = 0;
        $role_id = NULL;
        $username = "";
        $email = "";
        $password = "";
        $passwordConf = "";
        $profile_picture = "";
        $isEditing = false;
        $users = array();
        $errors = array();
        //echo($_GET['action']); die($isEditing);
        if (isset($isEditing)) {
            if ($isEditing === true) {
                if (!empty($_POST) && !empty($_FILES['profile_picture'])) { // if user clicked update_user button ...
                    $user_id = $_POST['user_id'];
                    unset($_POST['user_id']);
                    $data = $_POST;
                    $file = $_FILES;
                    UserManager::updateUser($user_id, $data, $file);
                }
            } else {
                if (!empty($_POST) && !empty($_FILES['profile_picture'])) { // if user clicked update_user button ...
                    
                    $data = $_POST;
                    $file = $_FILES;
                    UserManager::saveUser($data, $file);
                }
             }
        }
        getPath('userFormView.php', 'admin/users/');
    } elseif ($_GET['action'] == 'UserList') {
        getPath('userListView.php', 'admin/users/');
    }
    
} else {
    getPath('homeView.php');
}
