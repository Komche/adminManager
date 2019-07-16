<?php $title = "Admin";
if (!empty($_POST)) {
    extract($_POST);
} else {
    $username = '';
    $email = '';
}
global $errors;
ob_start();
include('admin_navbar.php');
?>

<div class="col-md-4 col-md-offset-4">
    <h1 class="text-center">Admin</h1>
    <br />
    <ul class="list-group">
        <a href="<?php echo  'admin/posts/postList.php' ?>" class="list-group-item">Manage Posts</a>
        <a href="<?php echo  'admin/users/userList.php' ?>" class="list-group-item">Manage Users</a>
        <a href="<?php echo  'admin/roles/roleList.php' ?>" class="list-group-item">Manage Roles</a>
    </ul>
</div>


<?php
$content = ob_get_clean();
require('../template.php');
?>