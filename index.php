<?php
include_once('model/global.php');
include_once('controller/usersController.php');

if (isset($_GET['action'])) {
    if ($_GET['action']== 'signup') {
        if (!empty($_POST) && !empty($_FILES[ 'profile_picture'])) {
            $data = $_POST;
            $file = $_FILES;
            signIn($data, $file);
        }
        include('view/signupView.php');
    } else {
        # code...
    }
    
} else {
    include('view/signupView.php');
}
