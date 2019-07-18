<?php
global $title;
$title = "Admin Area - Users";

$adminUsers = UserManager::getAdminUsers();
ob_start();
include_once(dirname(__DIR__) . "/admin_navbar.php");
?>

<div class="col-md-8 col-md-offset-2">
    <a href="userForm.php" class="btn btn-success">
        <span class="glyphicon glyphicon-plus"></span>
        Create new user
    </a>
    <hr>
    <h1 class="text-center">Admin Users</h1>
    <br />
    <?php if (isset($adminUsers)) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>N</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adminUsers as $key => $value) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['username'] ?></td>
                        <td><?php echo $value['role']; ?></td>
                        <td class="text-center">
                            <a href="index.php?action=userForm&edit_user=<?php echo $value['id'] ?>" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=userForm&delete_user=<?php echo $value['id'] ?>" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h2 class="text-center">No users in database</h2>
    <?php endif; ?>
</div>


<?php
global $content;
$content = ob_get_clean();
getPath('template.php');
?>