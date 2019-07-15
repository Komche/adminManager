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
    } elseif ($_GET['action'] == 'signup') {
        if (!empty($_POST)) {
            $data = $_POST;
            $errors = signUp($data);
            //die(print_r($data));
            // return $errors;
        }
        getPath('loginView.php');
    } {
        # code...
    }
    
} else {
    getPath('homeView.php');
}
