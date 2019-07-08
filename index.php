<?php
include_once('model/global.php');
if (isset($_GET['action'])) {
    if ($_GET['action']== 'signup') {
        include('view/signupView.php');
    } else {
        # code...
    }
    
} else {
    include('view/signupView.php');
}
