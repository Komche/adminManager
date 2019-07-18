<?php
global $title, $isEditing;
$title = "Admin";
if (!empty($_POST)) {
    extract($_POST);
} elseif (isset($_GET["edit_user"])) {
    $user_id = $_GET["edit_user"];
    $user = UserManager::editUser($user_id);
    if (!empty($user)) {
        //print_r($user);
        extract($user);
    }
}
global $errors;
 $roles = getAllRoles();
ob_start();
include_once(dirname(__DIR__)."/admin_navbar.php");
?>

<div class="container" style="margin-bottom: 150px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <a href="userList.php" class="btn btn-primary" style="margin-bottom: 5px;">
                <span class="glyphicon glyphicon-chevron-left"></span>
                Users
            </a>
            <br>

            <form class="form" action="" method="post" enctype="multipart/form-data">
                <?php if ($isEditing === true) : ?>
                    <h2 class="text-center">Update Admin user</h2>
                <?php else : ?>
                    <h2 class="text-center">Create Admin user</h2>
                <?php endif; ?>
                <hr>
                <!-- if editting user, we need that user's id -->
                <?php if ($isEditing === true) : ?>
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <?php endif; ?>
                <div class="form-group <?php echo isset($errors['username']) ? 'has-error' : '' ?>">
                    <label class="control-label">Username</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
                    <?php if (isset($errors['username'])) : ?>
                        <span class="help-block"><?php echo $errors['username'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo isset($errors['email']) ? 'has-error' : '' ?>">
                    <label class="control-label">Email Address</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control">
                    <?php if (isset($errors['email'])) : ?>
                        <span class="help-block"><?php echo $errors['email'] ?></span>
                    <?php endif; ?>
                </div>
                <?php if ($isEditing === true) : ?>
                    <div class="form-group <?php echo isset($errors['passwordOld']) ? 'has-error' : '' ?>">
                        <label class="control-label">Old Password</label>
                        <input type="password" name="passwordOld" class="form-control">
                        <?php if (isset($errors['passwordOld'])) : ?>
                            <span class="help-block"><?php echo $errors['passwordOld'] ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group <?php echo isset($errors['password_']) ? 'has-error' : '' ?>">
                    <label class="control-label">Your Password</label>
                    <input type="password" name="password_" class="form-control">
                    <?php if (isset($errors['password'])) : ?>
                        <span class="help-block"><?php echo $errors['password_'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo isset($errors['role_id']) ? 'has-error' : '' ?>">
                    <label class="control-label">User Role</label>
                    <select class="form-control" name="role_id">
                        <option value="">Choisir un rôle</option>
                        <?php foreach ($roles as $role) : ?>
                            <?php if ($role['id'] === $role_id) : ?>
                                <option value="<?php echo $role['id'] ?>" selected><?php echo $role['name'] ?></option>
                            <?php else : ?>
                                <option value="<?php echo $role['id'] ?>"><?php echo $role['name'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['role_id'])) : ?>
                        <span class="help-block"><?php echo $errors['role_id'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group" style="text-align: center;">
                    <?php if (!empty($profile_picture)) : ?>
                        <img src="<?php echo 'public/img/' . $profile_picture; ?>" id="profile_img" style="height: 100px; border-radius: 50%" alt="">
                    <?php else : ?>
                        <img src="http://via.placeholder.com/150x150" id="profile_img" style="height: 100px; border-radius: 50%" alt="">
                    <?php endif; ?>
                    <input type="file" name="profile_picture" id="profile_input" value="" style="display: none;">
                </div>
                <div class="form-group">
                    <?php if ($isEditing === true) : ?>
                        <button type="submit" class="btn btn-success btn-block btn-lg">Update user</button>
                    <?php else : ?>
                        <button type="submit" class="btn btn-success btn-block btn-lg">Save user</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
global $content;
$content = ob_get_clean();
getPath('template.php');
?>