<?php $title = "Inscription";
if (!empty($_POST)) {
   extract($_POST);
} else {
    $username = '';
    $email = '';
}
global $errors;
ob_start();
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form class="form" action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center">Sign up</h2>
                <hr>
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
                <div class="form-group <?php echo isset($errors['password']) ? 'has-error' : '' ?>">
                    <label class="control-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <?php if (isset($errors['password'])) : ?>
                        <span class="help-block"><?php echo $errors['password'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo isset($errors['passwordConf']) ? 'has-error' : '' ?>">
                    <label class="control-label">Password confirmation</label>
                    <input type="password" name="passwordConf" class="form-control">
                    <?php if (isset($errors['passwordConf'])) : ?>
                        <span class="help-block"><?php echo $errors['passwordConf'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group" style="text-align: center;">
                    <img src="http://via.placeholder.com/150x150" id="profile_img" style="height: 100px; border-radius: 50%" alt="">
                    <!-- hidden file input to trigger with JQuery  -->
                    <input type="file" name="profile_picture" id="profile_input" value="" style="display: none;">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Sign up</button>
                </div>
                <p>Aready have an account? <a href="login.php">Sign in</a></p>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require('template.php');
?>